var order = angular.module("order", []);

order.controller("orderController", function($scope, $http, $window){

    $scope.checkOrder = function(id) {
        $http({
            method: "POST",
            url: "http://torex2.omnibank.ru/admin/orders/checkOrder",
            data: $.param({id: id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(result){
            alert(result.data.text);
            $window.location.href = '/admin';
        })
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