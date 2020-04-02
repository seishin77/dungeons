<!DOCTYPE html>
<html>
<head>
  <title>Dungeons Explorers</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
  <link rel="manifest" href="favicon/site.webmanifest">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-route.js"></script>
  <script src="js/angular/validate.js"></script>
</head>
<body class="w3-display-container c6">
  <header id="menubar" class="w3-bar w3-display-top w3-display-container c11">
    <a class="w3-bar-item w3-button" href="#!/">Home</a>
    <a class="w3-bar-item w3-button w3-right" href="#!/auth/logout">Logout</a>
    <a class="w3-bar-item w3-button w3-right" href="#!/objects/list">Objects</a>
    <header class="w3-display-middle">DUNGEONS EXPLORERS</header>
  </header>

  <div ng-app="dungeons" class="h100p">
    <div class="w3-display-container ng-view h100p"></div>
  </div>
  <script type="text/javascript" src="dungeons.js"></script>
</body>
</html>
