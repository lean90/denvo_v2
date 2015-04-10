function SearchPopController($scope,$http){
    $scope.getTagsByTagName = function(val){
        return $http.get('/api/tags/search?value='+val,{headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT"}})
                    .then(function(data){
                        $scope.TagList = data.data;
                        return $scope.TagList;
                    });
    };
}
SearchPopController.$inject = ['$scope','$http'];