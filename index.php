<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
</head>
<body class="w3-container">
  <div ng-app="dungeons">
    <div ng-controller="objectList" ng-if="size > 0">
      <h1>{{title}} - {{size}}</h1>
      <table class="w3-table-all">
        <thead>
          <tr>
            <th ng-repeat="(kk, y) in content[0]">{{kk | capitalize}}</th>
          </tr>
        </thead>
        <tr ng-repeat="(k,x) in content">
          <td ng-repeat="(kk, y) in x">{{y}}</td>
        </tr>
      </table>
    </div>

    <div ng-controller="signup" ng-if="action='signup'">
      <h1>Signup</h1>
      <form>

      </form>
    </div>
    <!-- DEBUG PART -->
  </div>
  <script type="text/javascript" src="dungeons.js"></script>
</body>
</html>
