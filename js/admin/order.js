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
    $scope.editOrderClick = function(orderId) {
        $window.location.href = "admin/orders/edit?orderId=" + orderId;
    }
    $scope.editOrder = function(id) {
        $scope.productID = angular.element("#productID").val();
        $scope.userId = angular.element("#userId").val();
        $scope.orderStatus = angular.element("#orderStatus").val();
        $scope.orderQuantity = angular.element("#orderQuantity").val();
        $scope.productsInOrders_id = angular.element("#productsInOrders_id").val();
        $http({
            method: "POST",
            url: "http://torex2.omnibank.ru/admin/orders/saveOrder",
            data: $.param({orderID: id, productID: $scope.productID, userId: $scope.userId, orderStatus: $scope.orderStatus, quantity: $scope.orderQuantity, productsInOrders_id: $scope.productsInOrders_id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(result){
            if(result.data.success) {
                $window.location.href = '/admin/';
            }
        })

    }
        $scope.addOrder = function(id) {
        $scope.productID = angular.element("#productID").val();
        $scope.userId = angular.element("#userId").val();
        $scope.orderStatus = angular.element("#orderStatus").val();
        $scope.orderQuantity = angular.element("#orderQuantity").val();
        $http({
            method: "POST",
            url: "http://torex2.omnibank.ru/admin/orders/addOrder",
            data: $.param({productID: $scope.productID, userId: $scope.userId, orderStatus: $scope.orderStatus, quantity: $scope.orderQuantity}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(result){
            if(result.data.success) {
                $window.location.href = '/admin/';
            }
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