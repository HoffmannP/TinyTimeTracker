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
  <script type="text/javascript" src="../moment/moment.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.3/locales.min.js"></script>
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
          <li><a href="#add"><i class="fa fa-plus-circle">&nbsp;</i></a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a target="_new" href="https://github.com/HoffmannP/TinyTimeTracker"><i class="fa fa-github fa">&nbsp;</i></a></li>
        </ul>
      </nav>
    </div>
  </header>
  <div class="container">
    <article class="time">
      <h3>Projekte</h3>
      <table>
        <thead>
          <tr>
            <th>Projekt</th>
            <th>Einträge</th>
            <th>Arbeitszeit</th>
            <th>Erster Eintrag</th>
            <th>Letzter Eintrag</th>
          </tr>
        </thead>
      </table>
    </article>
    <article class="projekt">
      <h3>Projektname</h3>
      <div><a href="#"><i class="fa fa-reply">&nbsp;</i> zur Übersicht</a></div>
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Projekt</th>
            <th>Dauer</th>
            <th>Begin</th>
          </tr>
        </thead>
      </table>
    </article>
    <div class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">neues Projekt</h4>
          </div>
          <div class="modal-body">
            <span class="label">Für: </span>
            <!-- Single button -->
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                Projekt <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Neues Projekt</a></li>
                <li class="divider"></li>
                <li><a href="#">KT</a></li>
                <li><a href="#">GLS</a></li>
                <li><a href="#">SEfU</a></li>
              </ul>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
            <button type="button" class="btn btn-primary">Anlegen</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
<script>$(start)</script>
</html>
