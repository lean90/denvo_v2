function FilesController($scope,$http){
    common = new Common();
    $scope.items = items;
    $scope.itemsCount = itemsCount;
    $scope.limit = common.getParameterByName('limit') == "" ? 10 : common.getParameterByName('limit');
    $scope.offset = common.getParameterByName('offset') == "" ? 0 : common.getParameterByName('offset');
    $scope.limit = Number($scope.limit);
    $scope.offset = Number($scope.offset);
    $scope.pages = [];
    $scope.pages[0] = {'url':'/files','limit':$scope.limit,'offset': 0 };
    
    for(var i = 1; i < ($scope.itemsCount / $scope.limit) - 1; i++){
        if(i >= ($scope.offset - 3) && (i <= $scope.offset + 3)){
            $url = '/files?limit='+$scope.limit+"&offset="+i;
            $scope.pages[$scope.pages.length] = {'url':$url,'limit':$scope.limit,'offset':i};
        }
    }
    
    $url = '/files?limit='+$scope.limit+"&offset="+$scope.pages.length;
    $scope.pages[$scope.pages.length] = {'url':$url,'limit':$scope.limit,'offset':$scope.pages.length};
    
    console.log($scope.pages);
    
    $scope.upload = function(){
        var valid = $("#edit-frm").validate();
        if(valid.errorList.length == 0){
            $("#edit-frm").submit();
        }
    };
}
FilesController.$inject = ['$scope','$http'];