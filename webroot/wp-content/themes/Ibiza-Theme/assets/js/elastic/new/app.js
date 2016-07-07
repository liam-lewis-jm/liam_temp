var app = angular.module('ibiza', ['elasticui']);

app.constant('euiHost', 'http://ibizaschemas.product/ProductCatalog.Api/api/elastic'); 
app.controller('IndexController', function($scope) {
    $scope.indexName = "product"; 
});


