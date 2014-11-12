<?php

ini_set('default_charset', 'utf-8');
mb_internal_encoding('UTF-8');

switch (array_key_exists('action', $_GET) ? $_GET['action'] : null) {
  case 'time':
    echo json_encode(array('data' => fetchEntriesTimewise()));
    break;
  case 'projekt':
    echo json_encode(array('data' => fetchProjekt($_GET['name'])));
    break;
  default:
    require('template.index.php');
}

function fetchEntriesTimewise() {
  return fetchResult('SELECT Project, COUNT(*), SUM(Minutes), MIN(Stamp), MAX(Stamp) FROM Times GROUP BY Project');
}

function fetchProjekt($name) {
  return fetchResult('SELECT Collegue, Project, Minutes, Stamp FROM Times WHERE Project LIKE "' . $name . '%"');
}

function fetchResult($query) {
  $db = dbConnection();
  $result = $db->query($query);
  if (!$result) {
    return array(
      'error' => $db->error,
      'id' => $db->errno,
      'query' => $query);
  }
  $projekte = array();
  while ($row = $result->fetch_row()) {
    array_push($projekte, $row);
  }
  return $projekte;
}

function dbConnection() {
    include('config.php');
    extract($config);
    $connection = new mysqli($host, $user, $password, $database, $port);
    if ($connection->connect_errno) {
      printf("Connection failed: %s\n", $connection->connect_error);
      exit();
    }
    $connection->set_charset('utf8');
    return $connection;
}
