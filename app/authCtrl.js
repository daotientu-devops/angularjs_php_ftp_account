/**
 * Created by Administrator on 11/07/2016.
 */
app.controller('authCtrl', function ($scope, $rootScope, $routeParams, $location, $http, Data) {
    // initially set those objects to null to avoid undefined error
    //$scope.doLogout = function () {
        Data.get('logout').then(function (results) { console.log(results);
            Data.toast(results);
            // $location.path("/login"); // Redirect URLs
        });
    //};
    $scope.login = {};
    $scope.doLogin = function (user) { console.log(user);
        Data.post('login', {
            user: user
        }).then(function (results) { console.log(results);
            Data.toast(results);
            if (results.status == "success") {
                $location.path("/dashboard");
            }
        });
    };
    $scope.register = {email: '', password: '', name: ''};
    $scope.doRegister = function (user) { console.log(user);
        Data.post('register', {
            user: user
        }).then(function (results) { console.log(results);
            Data.toast(results);
            if (results.status == "success") {
                $location.path("/login");
            }
        });
    };
});