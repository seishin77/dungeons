var data = {token:'', until:0};

var app = angular.module('dungeons', ['ui.router']);

app.directive('checkEmail', function() {
  var EMAIL_REGEXP = /^[\w!#$%&'*+/=?`{|}~^-]+(?:\.[\w!#$%&'*+/=?`{|}~^-]+)*@(?:[A-Z0-9-]+\.)+[A-Z]{2,6}$/i;

  return {
    require: '?ngModel',
    link: function(scope, elm, attrs, ctrl) {
      // only apply the validator if ngModel is present and AngularJS has added the email validator
      console.log('checkEmail');
      if (ctrl && ctrl.$validators.email) {

        // this will overwrite the default AngularJS email validator
        ctrl.$validators.email = function(modelValue) {
          console.log(modelValue);
          console.log(EMAIL_REGEXP.test(modelValue));
          console.log(ctrl.$isEmpty(modelValue));
          return ctrl.$isEmpty(modelValue) || EMAIL_REGEXP.test(modelValue);
        };
      }
    }
  };
});

app.filter('capitalize', function() {
  return function(x) {
    if(x)
      return x.substr(0,1).toUpperCase() + x.substr(1);
    return '';
  };
});

app.filter('ts2date', function() {
  return function(x) {
    var td = new Date(x * 1000);
    return td.getFullYear() + '-' + ('' + (td.getMonth() + 1)).padStart(2, '0') + '-' +
      ('' + td.getDate()).padStart(2, '0') + ' ' + ('' + td.getHours()).padStart(2, '0') + ':' +
      ('' + td.getMinutes()).padStart(2, '0') + ':' + ('' + td.getSeconds()).padStart(2, '0');
  };
});


app.controller('objectsList', function($scope, $http){
    $http.get('objects/list')
      .then(function(response) {
        $scope.until = response.data.until;
        if(response.data.title)
          $scope.title = response.data.title;
        else
          $scope.title = 'List';
        $scope.content = response.data.list;
        $scope.size = $scope.content.length;
      });
});


app.config(function($stateProvider){
  var rootState = {
    name: 'root',
    url: '',
    templateUrl: 'views/welcome.html',
  }

  var signinState = {
    name: 'signin',
    url: '/signin',
    templateUrl: 'views/signin.html',
  }

  var logoutState = {
    name: 'logout',
    url: '/logout',
    templateUrl: 'views/logout.html',
  }

  var signupState = {
    name: 'signup',
    url: '/signup',
    templateUrl: 'views/signup.html'
  }

  var objectsState = {
    name: 'objectsList',
    url: '/objects',
    templateUrl: 'views/objectsList.html',
    controller:'objectsList'
  }

  $stateProvider.state(rootState);
  $stateProvider.state(signinState);
  $stateProvider.state(logoutState);
  $stateProvider.state(signupState);
  $stateProvider.state(objectsState);
});


app.controller('signin', function($scope, $http) {
  angular.element(document.getElementById("loginId")).focus();

  $scope.submit = function (){
    $http.post('auth/login')
    .then(function(response) {
      if(response.data.code == 200){
        console.log(response.data);
        data.token = response.data.token;
        data.until = response.data.until;
      }
      else{
        console.log(response.data);
        $scope.error = response.data.message;
      }
    });
  }
});

app.controller('signup', function($scope, $http) {
  angular.element(document.getElementById("loginId")).focus();
});



app.run(
  [
    '$rootScope', '$state', '$stateParams',
    function ($rootScope, $state, $stateParams){
      $rootScope.$state = $state;
      $rootScope.$stateParams = $stateParams;
    }
  ]
);
