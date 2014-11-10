<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TinyTimeTracker</title>
  <!-- javascript/css libraries -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.7.0/underscore-min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/backbone.js/1.1.2/backbone-min.js"></script>
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/2.0.0/handlebars.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.css">
  <!-- specific js/css files -->
  <script type="text/javascript" src="action.js"></script>
  <link rel="stylesheet" type="text/css" href="look.css">
</head>
<body>
  <header class="navbar navbar-inverse navbar-static-top bs-docs-nav" id="top" role="banner">
    <div class="container">
      <div class="navbar-header">
        <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar">&nbsp;</span>
          <span class="icon-bar">&nbsp;</span>
          <span class="icon-bar">&nbsp;</span>
        </button>
        <a href="#" class="navbar-brand">TinyTimeTracker</a>
      </div>
      <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
        <ul class="nav navbar-nav">
          <li><a href="#newProject">Neues Projekt</a></li>
          <li><a href="#filter">Filtern</a></li>
          <li><a href="#catch">Zeit erfassen</a></li>
          <li><a href="#entry">Neuer Eintrag</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a target="_new" href="https://github.com/HoffmannP/TinyTimeTracker"><i class="fa fa-github fa">&nbsp;</i></a></li>
        </ul>
      </nav>
    </div>
  </header>
  <main>
    <table class="container" id="time">
      <thead>
        <tr>
          <th>Projekt</th>
          <th>Einträge</th>
          <th>Summe</th>
      </thead>
      <tbody>
      </tbody>
    </table>
  </main>
</body>
<script>$(start)</script>
</html>
