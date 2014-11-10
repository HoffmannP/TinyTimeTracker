<?php

$call = explode('?', $_SERVER['REQUEST_URI']);
switch (strtolower(count($call) > 1 ? $call[1] : null)) {
  case 'table':
    echo '<tr><td></td><tr>';
  default:
    require('template.index.php');
}
