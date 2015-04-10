function SearchFromController($scope,$http)
{
    $scope.UserList = [];
    $scope.TagList = [];
    $scope.SelectedUser = '';
    $scope.SelectedTag = '';
    $scope.allowCategories = [];
    $scope.selectedCategory = {};
    
    $http.get('/api/categories/get_child/all',
            {headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT"}}
    ).success(function(data){
        $scope.childCategories = data;
        for(var i = 0; i< $scope.childCategories.length; i++){
            var level = $scope.childCategories[i].part_tree.split(",");
            for(var j = 1; j< level.length; j++){
                $scope.childCategories[i].name = ":::"+$scope.childCategories[i].name;
            }
            if($scope.childCategories[i].visible == '1'){
                $scope.allowCategories.push($scope.childCategories[i]); 
            }
        }
        $scope.selectedCategory = '';
    }).error(function(xhr, status, error){});
    
    $scope.getUserByFullname = function(val){
        return $http.get('/api/search/user/by_full_name?full_name='+val,{headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT"}})
                    .then(function(data){
                        $scope.UserList = data.data;
                        return $scope.UserList;
                    });
    };
    
    $scope.getTagsByTagName = function(val){
        return $http.get('/api/tags/search?value='+val,{headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT"}})
                    .then(function(data){
                        $scope.TagList = data.data;
                        return $scope.TagList;
                    });
    };
}
SearchFromController.$inject = ['$scope','$http'];