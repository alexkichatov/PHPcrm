var admin = angular.module('admin', []);

admin.controller("adminController", function($scope, $window, $http){

    $scope.openOrderDetails = function(orderId) {
        $window.location.href = "admin/orders?orderId=" + orderId;
    }
        $scope.editOrder = function(orderId) {
        $window.location.href = "admin/orders/edit?orderId=" + orderId;
    }
        $scope.deleteOrder = function(id) {
        $http({
            method: "POST",
            url: "http://torex2.omnibank.ru/admin/orders/deleteOrder",
            data: $.param({id: id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(result){
            alert(result.data.text);
            $window.location.href = '/admin';
        })
    }

});