var app = angular.module('myApp', ['datatables', 'ngRoute', 'ui.bootstrap', 'ngAnimate', 'toaster']);

app.config(['$routeProvider', function ($routeProvider) {
    $routeProvider.when('/login', {
        title: 'Login',
        templateUrl: 'partials/login.html',
        controller: 'authCtrl'
    })
    /*  .when('/logout', {
        title: 'Logout'
        // , templateUrl: 'partials/login.html'
        , controller: 'authCtrl'
    }) */
        .when('/register', {
        title: 'Register',
        templateUrl: 'partials/register.html',
        controller: 'authCtrl'
    })
        .when('/dashboard', {
        title: 'Accounts',
        templateUrl: 'partials/accounts.html',
        controller: 'accountsCtrl'
    })
        .otherwise({
        redirectTo: '/login'
    });

}])
    .run(function ($rootScope, $location, Data) {
        $rootScope.$on("$routeChangeStart", function (event, next, current) {
            $rootScope.authenticated = false;
            Data.get('session').then(function (results) {
                if (results.id) {
                    $rootScope.authenticated = true;
                    $rootScope.id = results.id;
                    $rootScope.name = results.name;
                    $rootScope.email = results.email;
                } else {
                    var nextUrl = next.$$route.originalPath;
                    if (nextUrl == '/register' || nextUrl == '/login') {

                    } else {
                        $location.path("/login");
                    }
                }
            });
        });
    });