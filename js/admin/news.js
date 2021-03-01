var news = angular.module('news', ['ui.bootstrap']);
news.controller('newsController', function($scope, $http, $uibModal){

    $scope.open = function(id) {
        $http({
            method: "POST",
            url: "http://torex2.omnibank.ru/admin/news/getNewsById",
            data: $.param({id: id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(result){
            if(result.data.success != false) {
                $scope.newsData = result.data;
                var modalWindow = $uibModal.open({
                    animation: true,
                    controller: "modalWindowController",
                    templateUrl: '/application/views/modal.tpl.php', 
                    resolve: {
                        newsData: function() {
                            return $scope.newsData;
                        }
                    }
                });
            }
        })

    }


})

news.controller('modalWindowController', function ($scope, $http, $window, $uibModalInstance, newsData) {
  
    $scope.newsId = newsData.id;
    $scope.newsTitle = newsData.title;
    $scope.newsDescription = newsData.description;

    $scope.save = function() {
        $http({
            method: "POST",
            url: "http://torex2.omnibank.ru/admin/news/save",
            data: $.param({id: $scope.newsId, title: $scope.newsTitle, text: $scope.newsDescription}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(result){
            alert(result.data.text);
            $uibModalInstance.close();
            $window.location.href = '/admin/news';
        })
    }

    $scope.close = function() {
        $uibModalInstance.dismiss('cancel');
    }

});