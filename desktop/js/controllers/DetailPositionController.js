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
	
	$scope.initialize = function(lat,long){
		var pos = new google.maps.LatLng(lat, long);
		$scope.myPosition = pos;
	    var mapOptions = {
	       zoom: 13,
	       center: pos
	    };
	    if(map == undefined){
	    	map = new google.maps.Map(document.getElementById('map'), mapOptions);
	    	directionsDisplay = new google.maps.DirectionsRenderer({suppressMarkers: true});
	    	directionsDisplay.setMap(map);
	    }else{
	    	map.setCenter(lat, long);
	    }
	    
		var icon_path = "/img/icon-map-location.png";
		icon_path = $scope.info.position_type == "LABO" ? '/img/icon-map-labo.png' : icon_path;
		icon_path = $scope.info.position_type == "CO-SO-VLNK" ? '/img/icon-map-cs.png' : icon_path;
	
	    //markers
	    $scope.mylocation_marker = new google.maps.Marker({
	        position: pos,
	        map: map,
	        icon:icon_path,
	        title: "Bạn đang ở đây!"
	    });
	};
	$scope.initialize($scope.info.latitude,$scope.info.longitude);
}
DetailPositionController.$inject = ['$scope','$http'];