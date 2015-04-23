function PositionController($scope,$http)
{
	var map;
	$scope.mylocation_marker;
	$scope.locationCollection = [];
	$scope.markersCollection = [];
	$scope.initialize = function(lat,long){
		
		//var pos = new google.maps.LatLng(21.044829, 105.757673);
		var pos = new google.maps.LatLng(lat, long);
	    var mapOptions = {
	       zoom: 15,
	       center: pos
	    };
	    if(map == undefined){
	    	map = new google.maps.Map(document.getElementById('mang-luoi-map'), mapOptions);
	    	google.maps.event.addListener(map, 'idle', function() {
				var center = map.getCenter();
				$scope.pressLocation(center.k,center.D)
			});
	    }else{
	    	map.setCenter(lat, long);
	    }
	    
	    //markers
	    $scope.mylocation_marker = new google.maps.Marker({
	        position: pos,
	        map: map,
	        icon:'/img/human.png',
	        animation: google.maps.Animation.BOUNCE,
	        title: "Bạn đang ở đây!"
	    });
	    
	    //Show infor window.
	    var inforMyLocation = new google.maps.InfoWindow({
            map: map,
            position: pos,
            content: '<div class="beau-desc-map">Bạn đang ở đây!</div>'
        });
	    inforMyLocation.open(map,$scope.mylocation_marker);
	};
	
	$scope.appendLocation = function(data){
		for(var j = 0 ; j < data.length; j++){
			var value = data[j];
			var isExits =  false;
			for(var i = 0; i < $scope.locationCollection.length; i++){
				if(value.id == $scope.locationCollection[i].id){
					isExits = true;
					break;
				}
			}
			if(!isExits){
				var pos = new google.maps.LatLng(value.latitude, value.longitude);
				var marker = new google.maps.Marker({
			        position: pos,
			        map: map,
			        icon:'/img/phong-kham-icon.fw.png',
			        animation: google.maps.Animation.DROP,
			        title: "Bạn đang ở đây!",
			        datasource : value
			    }); 
				$scope.locationCollection.push(value);
				$scope.markersCollection.push(marker);
				attachSecretMessage(marker);
			}
		}
	};
	
	// The five markers show a secret message when clicked
	// but that message is not within the marker's instance data
	function attachSecretMessage(marker) {
	  google.maps.event.addListener(marker, 'click', function() {
		  var contentString = '<div id="content">'+
	      '<h4 id="firstHeading" class="firstHeading" style="color:#0F75BB">'+marker.datasource.name+'</h4>'+
	      '<div id="bodyContent">'+
		      '<p>'+ marker.datasource.description +'</p>'+
		      '<p>'+
		        'Website : <a href="'+marker.datasource.website_link+'">'+marker.datasource.website_link+'</a>'+
		      '</p>'+
		  '</div>'+
	      '</div>';

		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});
		
		infowindow.open(map,marker);
	  });
	}
	
	$scope.pressLocation = function(lat,long){
		$http.get('/map/get-near-position/30?lat='+lat+'&long='+long,
				{headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT"}})
		.success(function(data){
			$scope.appendLocation(data);
        }).error(function(xhr, status, error){
        	alert("Load position error");
        });
	};
	
	$scope.getMyLocation = function(){
		  if(navigator.geolocation) {
		    navigator.geolocation.getCurrentPosition(function(position) {
		      $scope.initialize(position.coords.latitude,position.coords.longitude);
		    }, function() {
		      $scope.initialize(21.044829, 105.757673);
		    });
		  }
		  // Browser doesn't support Geolocation
		  else {
		    $scope.initialize(21.044829, 105.757673);
		  }
	  };
	  $scope.getMyLocation();
}
PositionController.$inject = ['$scope','$http'];