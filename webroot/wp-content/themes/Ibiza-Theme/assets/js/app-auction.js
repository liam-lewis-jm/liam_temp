var auctionApp = angular.module('ibiza-auction', []);

//auctionApp.constant('apiSignalR', api_location + '/ProductCatalog.Api/signalr');
//auctionApp.constant('apiAuction', api_location + '/ProductCatalog.api/api/legacy/auction');
//auctionApp.constant('apiTodayspProducts', api_location + '/ProductCatalog.api/api/legacy/todaysproducts');

auctionApp.controller('AuctionPage', ['$scope', '$http', 'signalRHubProxy', '$window', function ($scope, $http, signalRHubProxy, $window) {
    //$scope.signalR = api_location + "/ProductCatalog.Api/signalr";
    //jQuery.connection.ibizaHubProxy.connection.url =  api_location + "/ProductCatalog.Api/signalr";
    //jQuery.connection.ibizaHubProxy.connection.start();
    //$scope.signalR = jQuery.connection.ibizaHubProxy.connection.url;
    $http.get(api_location + "/ProductCatalog.api/api/legacy/auction").then(function (response) {
      $scope.productData = response.data[0];
    });

    $http.get(api_location + "/ProductCatalog.api/api/legacy/todaysproducts").then(function (response) {
      $scope.todaysProductsData = response;
    });

    $scope.messages = [];

    var auctionClient = signalRHubProxy('ibizaHubProxy', { logging: true });

    auctionClient.on('auctionUpdate', function(auction) {
        $scope.messages.push(auction);
        
        if($scope.productData === undefined || auction.id !== $scope.productData._id)        
        {
            $state.reload();
        }
        else {
            $scope.productData.auction = auction.auction;
        }        
    });

    auctionClient.on('auctionRefresh', function() {
        $state.reload();
    });

    auctionClient.start();

    $window.onload = function() {
        jQuery('.prodThumb').click(function(){
            jQuery('.main-photo img').attr('src', jQuery(this).data('this-src'));
        });
    };

}]);




'use strict';

auctionApp.factory('signalRHubProxy', ['$rootScope', function ($rootScope) {
    function signalRHubProxyFactory(hubName, startOptions, done, fail) {
        var connection = jQuery.hubConnection(api_location + "/ProductCatalog.api/");
        var proxy = connection.createHubProxy(hubName);

        return {
            start: function(done, fail) {
                connection.start(startOptions)
                    .done(function() {
                        if (done) done();
                    })
                    .fail(function() {
                        if (fail) fail();
                    });
            },
            on: function (eventName, callback) {
                proxy.on(eventName, function (result) {
                    $rootScope.$apply(function () {
                        if (callback) {
                            callback(result);
                        }
                    });
                });
            },
            off: function (eventName, callback) {
                proxy.off(eventName, function (result) {
                    $rootScope.$apply(function () {
                        if (callback) {
                            callback(result);
                        }
                    });
                });
            },
            invoke: function (methodName, callback) {
                proxy.invoke(methodName)
                    .done(function (result) {
                        $rootScope.$apply(function () {
                            if (callback) {
                                callback(result);
                            }
                        });
                    });
            },
            connection: connection
        };
    };

    return signalRHubProxyFactory;    
}]);
