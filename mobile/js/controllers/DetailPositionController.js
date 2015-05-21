function DetailPositionController($scope,$http)
{
	$scope.info = window.position_info;
	$scope.selected_img = $scope.info.img1;
	$scope.mylocation_marker = null;
	var map;
	
	$scope.like_position = function(id){
		$http.get('/map/'+id+'/like',{headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT"}})
		.success(function(data){
			if(data == 'true' || data == true ){
				location.reload();
			}
        }).error(function(xhr, status, error){
        	alert("Error");
        });
		return false;
	};
	
	
	$scope.change_img = function(url){
		$scope.selected_img = url;
	};
	
	$scope.getNumberByThoundsand = function(x){
		var int = parseInt(x);
		if(int < 1000){
			return int;
		}
		return int/1000 + 'K';
	}
}
DetailPositionController.$inject = ['$scope','$http'];