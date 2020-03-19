var app = angular.module('dungeons', []);

app.filter('capitalize', function() {
  return function(x) {
    return x.substr(0,1).toUpperCase() + x.substr(1);
  };
});

app.controller('objectList', function($scope, $http) {
  if((typeof $scope.until) == 'undefined' || $scope.until < Date.now()){
    $http.get("objects/list")
      .then(function(response) {
        $scope.until = response.data.until;
        if(response.data.title)
          $scope.title = response.data.title;
        else
          $scope.title = 'List';
        $scope.content = response.data.list;
        $scope.size = $scope.content.length;
      });
  }
});

app.controller('signup', function($scope, $http) {
  $http.get("auth/signup")
  .then(function(response) {
    $scope.action = response.data.action;
  });
});
