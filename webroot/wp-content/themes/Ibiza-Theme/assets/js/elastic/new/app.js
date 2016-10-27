var app = angular.module('ibiza', ['elasticui', 'mm.foundation']);

app.constant('euiHost', api_location + '/ProductCatalog.Api/api/elastic');
app.controller('IndexController', function ($scope) {
    $scope.indexName = "product";
    
    
    $scope.setPage = function (pageNo) {
        $scope.currentPage = pageNo;
    };


    $scope.min = function(val, minVal) {
      var value = Math.min(val, minVal);
      return value;
    };
});

app.filter('makeUppercase', function () {
    return function (item) {
        // make the url lowercase
        var encodedUrl = item.toString().toLowerCase();

        // replace & with and
        encodedUrl = encodedUrl.split(/\&+/).join("-and-");

        // remove invalid characters
        encodedUrl = encodedUrl.split(/[^a-z0-9]/).join("-");

        // remove duplicates
        encodedUrl = encodedUrl.split(/-+/).join("-");

        // trim leading & trailing characters
        encodedUrl = encodedUrl.trim('-');

        return encodedUrl;
    };
});
