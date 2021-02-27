var admin = angular.module('admin', []);

admin.controller("adminController", function($scope, $window, $http){

    $scope.openOrderDetails = function(orderId) {
        $window.location.href = "admin/orders?orderId=" + orderId;
    }

});