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
          <li><a href="#new">Neues Projekt</a></li>
          <li><a href="#catch">Zeit erfassen</a></li>
          <li><a href="#entry">Neuer Eintrag</a></li>
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
    <div class="dialog">
      <dialog class="new">
        <form class="form-horizontal">
          <div class="form-group">
            <h4 class="col-sm-10 col-sm-offset-2">neues Projekt</h4>
          </div>
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name:</label>
            <div style="" class="col-sm-10">
              <input name="name" placeholder="Name" class="form-control" type="text">
            </div>
          </div>
          <div class="form-group">
            <label for="parent" class="col-sm-2 control-label">Eltern:</label>
            <div class="col-sm-10">
              <select>
                <option value="">- ohne -</option>
                <option value="KT">KT</option>
                <option value="GLS">GLS</option>
                <option value="SEfU">SEfU</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button class="btn btn-default">anlegen</button>
            </div>
          </div>
        </form>
      </dialog>
      <dialog class="catch"></dialog>
      <dialog class="entry"></dialog>
    </div>
  </div>
</body>
<script>$(start)</script>
</html>
