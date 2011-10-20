<?php

CONST TABLE_Time = 'Times';
CONST TABLE_Worker = 'Workers';
CONST HOURSaDAY = 8;

$DatabaseDefinition[TABLE_Time] = <<<'EOS'
(
`Project`  VARCHAR( 100 )   NOT NULL ,
`Collegue` VARCHAR( 100 )   NOT NULL ,
`Minutes`  INT UNSIGNED     NOT NULL ,
`Stamp`    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE = MYISAM;
EOS;

$DatabaseDefinition[TABLE_Worker] = <<<'EOS'
(
`Project`  VARCHAR( 100 )        NOT NULL ,
`Collegue` VARCHAR( 100 ) UNIQUE NOT NULL ,
`Stamp`    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE = MYISAM;
EOS;

require_once("config.php");
$mysql = new mysqli($config["host"], $config["user"], $config["password"], $config["database"]);
if ($mysql->connect_errno) {
    printf("Connect failed: %s\n", $mysql->connect_error);
    exit();
}
$mysql->query("CREATE TABLE IF NOT EXISTS `" . TABLE_Time . "` " . $DatabaseDefinition[TABLE_Time]);
if ($mysql->errno) {die("MySQL insert query I failed");}
$mysql->query("CREATE TABLE IF NOT EXISTS `" . TABLE_Worker . "` " . $DatabaseDefinition[TABLE_Worker]);
if ($mysql->errno) {die("MySQL insert query II failed");}

function MinutesToTime($minutes) {
  $hours = floor($minutes/60);
  $minutes -= $hours*60;
  $days = floor($hours/HOURSaDAY);
  $hours -= $days*HOURSaDAY;
  if ($days>0) {
    return sprintf("%dd %d:%02d", $days, $hours, $minutes);
  } else {
    return sprintf("%d:%02d", $hours, $minutes);
  }
}

function show_collegues($mysql) {
  $result = $mysql->query("SELECT DISTINCT `Collegue` FROM `" . TABLE_Time . "` UNION DISTINCT SELECT `Collegue` FROM `" . TABLE_Worker . "` ORDER BY `Collegue` ASC");
  if ($mysql->errno) {die("MySQL project query failed");}
  $n = $result->num_rows;
  for ($i=0; $i<$n; $i++) {
    $c = $result->fetch_row();
    echo "<input class='addTime named' type='button' value='" . htmlspecialchars($c[0]) . "' />\n";
  }
  echo "<input class='addTime free' type='button' value='+' />\n";
}

function show_time($mysql, $categorie) {
  if (!is_null($categorie)) {
    $WHERE = " WHERE `Project` like '" . $mysql->real_escape_string($categorie) . "%'";
  } else {
    $WHER = "";
  }
  $table = TABLE_Time;
  // Fetch collegues
  $result = $mysql->query("SELECT DISTINCT `Collegue` FROM `$table`" . $WHERE);
  if ($mysql->errno) {die("MySQL collegue query failed");}
  $n = $result->num_rows;
  $Collegue = array();
  for ($i=0; $i<$n; $i++) {
    $c = $result->fetch_row();
    $Collegue[] = htmlspecialchars($c[0]);
  }
  
  // Fetch projects
  $result = $mysql->query("SELECT DISTINCT `Project` FROM `$table`" . $WHERE);
  if ($mysql->errno) {die("MySQL project query failed");}
  $n = $result->num_rows;
  $Project = array();
  for ($i=0; $i<$n; $i++) {
    $p = $result->fetch_row();
    $Project[] = htmlspecialchars($p[0]);
  }
  
  // Fetch times
  $result = $mysql->query("SELECT `Project`, `Collegue`, SUM(`Minutes`) as 'Minutes' FROM `$table`" . $WHERE . " GROUP BY `Project`, `Collegue` WITH ROLLUP");
  if ($mysql->errno) {die("MySQL time query failed");}
  $n = $result->num_rows;
  $Minutes = false;
  for ($i=0; $i<$n; $i++) {
    $row = $result->fetch_assoc();
    if (is_null($row['Collegue']) && !is_null($row['Project'])) {
      continue;
    }
    $Minutes[htmlspecialchars($row['Project'])][htmlspecialchars($row['Collegue'])] = $row['Minutes'];
  }

  require_once("template.timetable.php");
}

function edit_time($mysql, $collegue, $project, $minutes) {
  $table = TABLE_Time;
  $collegue = $mysql->real_escape_string($collegue);
  $project = $mysql->real_escape_string($project);
  $minutes = $mysql->real_escape_string($minutes);
  $mysql->query("INSERT `$table` SET `Project` = '$project', `Collegue` = '$collegue', `Minutes` = '$minutes'");
  die($minutes);
  if ($mysql->errno) {die("MySQL insert failed");}
}
function show_workers($mysql) {
  $table = TABLE_Worker;
  $result = $mysql->query("SELECT `Project`, `Collegue`, DATE_FORMAT(`Stamp`, '%k:%i') as `Time` FROM `$table`");
  if ($mysql->errno) {die("MySQL worker query failed");}
  $n = $result->num_rows;
  $Worker = array();
  for ($i=0; $i<$n; $i++) {
    $row = $result->fetch_assoc();
    $Worker[] = array(
      "Project"  => htmlspecialchars($row["Project"]),
      "Collegue" => htmlspecialchars($row["Collegue"]),
      "Time"     => htmlspecialchars($row["Time"])
    );
  }
  require_once("template.working.php");
}
function add_worker($mysql, $collegue, $project) {
  $table = TABLE_Worker;
  $collegue = $mysql->real_escape_string($collegue);
  $project = $mysql->real_escape_string($project);
  $mysql->query("INSERT `$table` SET `Project` = '$project', `Collegue` = '$collegue'");
  if ($mysql->errno) {
    die($mysql->error);
  }
}
function abort_worker($mysql, $collegue) {
  $table = TABLE_Worker;
  $collegue = $mysql->real_escape_string($collegue);
  $mysql->query("DELETE FROM `$table` WHERE `Collegue` = '$collegue' LIMIT 1");
  if ($mysql->errno) {
    die($mysql->error);
  }
}
function save_worker($mysql, $collegue) {
  $table = TABLE_Worker;
  $collegue = $mysql->real_escape_string($collegue);
  $result = $mysql->query("SELECT `Project`, TIMESTAMPDIFF(MINUTE, `Stamp`, CURRENT_TIMESTAMP) as `Minutes` FROM `$table` WHERE `Collegue` = '$collegue'");
  if ($mysql->errno) {
    die($mysql->error);
  }
  $row = $result->fetch_assoc();
  $project = $row["Project"];
  $minutes = $row["Minutes"];
  if ($minutes > 0) {
    edit_time($mysql, $collegue, $project, $minutes);  
    echo "Added $minutes minutes to $project by $collegue";
  }
  abort_worker($mysql, $collegue);
}


//* Base Reaction *//
if (key_exists("collegue", $_POST) && key_exists("project", $_POST) && key_exists("minutes", $_POST)) {
  $time = explode(":", $_POST["minutes"]);
  edit_time($mysql, $_POST["collegue"], $_POST["project"], $time[0]*60+$time[1]);
  exit();
} else if (key_exists("collegue", $_POST) && key_exists("project", $_POST) && key_exists("start", $_POST)) {
  add_worker($mysql, $_POST["collegue"], $_POST["project"]);
} else if (key_exists("table", $_POST)) {
  show_time($mysql, $_POST["table"]);
  exit();
} else if (key_exists("whatDo", $_POST)) {
  if ($_POST["whatDo"] == "abort") {
    abort_worker($mysql, $_POST["collegue"]);
  } else if ($_POST["whatDo"] == "save") {
    save_worker($mysql, $_POST["collegue"]);
  }
  exit();
} else if (key_exists("collegues", $_POST)) {
  show_collegues($mysql);
  exit();
} else if (key_exists("working", $_POST)) {
  show_workers($mysql);
  exit();
}
require_once("template.html.php");
//* END *//
