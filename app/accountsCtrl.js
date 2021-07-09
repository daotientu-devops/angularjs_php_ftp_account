/**
 * Created by Administrator on 04/07/2016.
 */
app.filter('startForm', function() {
    return function(input, start) {
        if(input) {
            start = +start; //parse to int
            return input.slice(start);
        }
        return [];
    }
});

app.controller('accountsCtrl', function($scope, $http, $modal, $filter, Data, $timeout) {
    $scope.account = {};
    Data.get('accounts').then(function(data){ console.log(data);
        $scope.accounts = data.data;
    });
    $scope.deleteAccount = function(account){
        if(confirm("Are you sure to remove this account?")){
            Data.delete("accounts/"+account.id).then(function(result){
                $scope.accounts = _.without($scope.accounts, _.findWhere($scope.accounts, {id:account.id}));
            });
        }
    };
    $scope.open = function (p, size) {
        var modalInstance = $modal.open({
            templateUrl: 'partials/accountEdit.html',
            controller: 'accountEditCtrl',
            size: size,
            resolve: {
                item: function () {
                    return p;
                }
            }
        });
        modalInstance.result.then(function(selectedObject) {
            if (selectedObject.save == "insert") {
                $scope.accounts.push(selectedObject);
                $scope.accounts = $filter('orderBy')($scope.accounts, 'id', 'reverse');
            } else if (selectedObject.save == "update") {
                p.name_p = selectedObject.name_p;
                p.folder = selectedObject.folder;
                p.url = selectedObject.url;
                p.ip_address = selectedObject.ip_address;
                p.dba = selectedObject.dba;
                p.email = selectedObject.email;
                p.username = selectedObject.username;
                p.password = selectedObject.password;
                p.datetime = selectedObject.datetime;
                p.note = selectedObject.note;
            }
        });
    };

    $scope.columns = [
        {text: "ID", predicate: "id", sortable: true, dataType: "number"}
        ,{text: "Name Project", predicate: "name_p", sortable: true}
        ,{text: "Folder", predicate: "folder", sortable: true}
        ,{text: "URL", predicate: "url", sortable: true}
        ,{text: "Database", predicate: "database", sortable: true}
        ,{text: "Email", predicate: "email", sortable: true}
        ,{text: "Username", predicate: "username", sortable: true}
        ,{text: "Password", predicate: "password", sortable: true}
        ,{text: "Date & Time", predicate: "datetime", sortable: true}
        ,{text: "Action", predicate: "", sortable: false}
    ];
});

app.controller('accountEditCtrl', function ($scope, $modalInstance, item, Data) {

    $scope.account = angular.copy(item);
    $scope.cancel = function () {
        $modalInstance.dismiss('Close');
    };
    $scope.title = (item.id > 0) ? 'Edit Account' : 'Add Account';
    $scope.buttonText = (item.id > 0) ? 'Update Account' : 'Add New Account';

    var original = item;
    $scope.isClean = function() {
        return angular.equals(original, $scope.angular);
    }
    $scope.saveAccount = function (account) {
        account.id = item.id;
        if (account.id > 0) { console.log(account.id);
            Data.put('accounts/'+account.id, account).then(function (result) { // dùng kết quả trả về thực thi công việc tiếp
                if (result.status != 'error') {
                    var x = angular.copy(account);
                    x.save = 'update';
                    $modalInstance.close(x);
                } else {
                    console.log(result);
                }
            });
        } else {
            Data.post('accounts', account).then(function (result) {
                if (result.status != 'error') {
                    var x = angular.copy(account);
                    x.save = 'insert';
                    x.id = result.data;
                    $modalInstance.close(x);
                    location.reload(); // reload page
                } else {
                    console.log(result);
                }
            });
        }
    }
});