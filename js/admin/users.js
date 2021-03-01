var users = angular.module('users', []);

users.controller("usersController", function($scope, $http, $window){
    
    $scope.getUserData = function(userId) {
        $http({
            method: "POST",
            url: "http://torex2.omnibank.ru/admin/users/getUserById",
            data: $.param({id: userId}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(result){
            $scope.userId = result.data.id;
            $scope.userLogin = result.data.login;
            $scope.userAddress = result.data.address;
            $scope.userPhone = result.data.phone;
            $scope.userEmail = result.data.email;
            $scope.userFullName = result.data.fullName;
            $scope.userRole = result.data.role;
            for(var i=0; i<$scope.roles.length; i++) {
                loc_val = $scope.roles[i];
                if (loc_val.name==result.data.role) {
                    $scope.newRole = loc_val;
                    break;
                }
            }
        })
    }

    $scope.getRoles = function() {
        $http({
            method: "POST",
            url: "http://torex2.omnibank.ru/admin/users/getUsersRoles",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(result){
            $scope.roles = [];
            for(var i=0; i<result.data.length; i++) {
                $scope.roles.push(result.data[i]);
            }
        })
    }
    
    $scope.updateUserData = function() {
        $http({
            method: "POST",
            url: "http://torex2.omnibank.ru/admin/users/updateUserData",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
           // data: $.param({id: $scope.userId, fullName: $scope.userFullName, login: $scope.userLogin, email: $scope.userEmail, role: $scope.newRole})
            data: $.param({id: $scope.userId, fullName: $scope.userFullName, login: $scope.userLogin, email: $scope.userEmail, phone: $scope.userPhone, address: $scope.userAddress, role: $scope.newRole})
        }).then(function(result){
            alert(result.data.text);
            $window.location.reload();
        });
    }

    $scope.deleteUser = function(userId) {
        $http({
            method: "POST",
            url: "http://torex2.omnibank.ru/admin/users/deleteUser",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: $.param({id: userId})
        }).then(function(result){
            alert(result.data.text);
            $window.location.reload();
        });
    }

    $scope.addNewUser = function () {
        $http({
            method: "POST",
            url: "http://torex2.omnibank.ru/admin/users/addNewUser",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: $.param({fullName: $scope.newUser, address: $scope.newAddress, email: $scope.newEmail, phone: $scope.newPhone})
        }).then(function (result) {
            alert(result.data.text);
            $window.location.reload();
        });
    }
    $scope.searchUser = function () {
        $scope.search = angular.element("#search").val();
        $window.location.href = '/admin/users/?search=' + $scope.search + '';

    }

    $scope.getRoles();

})

users.directive('editUser', function(){
    return {
    //    templateUrl: "/application/views/edit-user-tpl.php",
        templateUrl: "/application/views/edit-client-tpl.php",
        restrict: "E",
        replace: true,
        transclude: true,
        controller: "usersController",
        link: function(scope, element, attrs) {
            scope.showEditForm = function() {
                scope.isShowEditForm = true;
            };
        }
    }
})