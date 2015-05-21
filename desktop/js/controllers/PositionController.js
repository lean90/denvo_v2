function PositionController($scope,$http)
{
	var map;
	var directionsDisplay;
	var directionsService = new google.maps.DirectionsService();
	$scope.mylocation_marker;
	$scope.locationCollection = [];
	$scope.markersCollection = [];
	$scope.allowCategories = [];
	$scope.tinh_thanhpho = [];
	$scope.quan_huyen = [];
	$scope.phuong_xa = [];
	$scope.selected_tinh_thanhpho = null;
	$scope.selected_quan_huyen = null;
	$scope.selected_phuong_xa = null;
	$scope.currentPage = 1;
	$scope.listPosition = [];
	$scope.lastSearchResults = null;
	$scope.selected_position = null;
	$scope.selectedFilterByName = "PHONG-KHAM";
	$scope.myPosition = null;
	$scope.listState = 'by-area';
	$scope.directionDestinationPosition = null;
	
	$scope.$watch('currentPage', function() {
		$scope.pageChanged($scope.currentPage);
	});
	
	$scope.pageChanged = function(page){
		if($scope.lastSearchResults == null || $scope.lastSearchResults == undefined){
			return;
		}
		$scope.callToSearchAPI($scope.lastSearchResults.name,
				$scope.lastSearchResults.cate_id, $scope.lastSearchResults.type,
				$scope.lastSearchResults.order_col, page,
				function(data) {
					$scope.clearMarkers();
					$scope.appendLocation(data.results);
					$scope.listPosition = data.results;
					$scope.lastSearchResults = data;
				});
	}
	
	window.like_position = function(element,id){
		$http.get('map/'+id+'/like',{headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT"}})
		.success(function(data){
			if(data == 'true' || data == true ){
				location.reload();
			}
        }).error(function(xhr, status, error){
        	alert("Load position error");
        });
		return false;
	};
	
	
	$scope.showLocationOnMap = function(position){
		for( i = 0; i< $scope.markersCollection.length; i++){
			if($scope.markersCollection[i].datasource.id == position.id){
				$('html, body').animate({
		            scrollTop: 0
		        }, 1000);
				showInforWindow($scope.markersCollection[i]);
				map.setCenter(new google.maps.LatLng(position.latitude, position.longitude));
			}
		}
	};
	
	$scope.show_list_order_by_like_number = function(){
		if($scope.listState != "by-like-number"){
			$scope.clearMarkers();
			$scope.lastSearchResults = null;
		}
		$scope.listState = "by-like-number";
		 $('html, body').animate({
            scrollTop: 550
        }, 1000);
		 $scope.clearMarkers();
		 $scope.callToSearchAPI("","","","like_number",$scope.currentPage,function(data){
			$scope.clearMarkers();
			$scope.appendLocation(data.results);
			$scope.listPosition = data.results;
			$scope.lastSearchResults = data;
		 });
		 
	};
	
	window.getNearPosition = function(){
		var lat = $scope.myPosition.A;
		var long = $scope.myPosition.F;
		$scope.clearMarkers();
		$http.get('/map/get-near-position?type='+$scope.selectedFilterByName+'&total=50&lat='+lat+'&long='+long,
				{headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT"}})
		.success(function(data){
			if(data.length == 0){
				alert("Không tồn tại địa chỉ phù hợp");
				return;
			}
			var service = new google.maps.DistanceMatrixService();
			var destinations = [];
			var origin = [];
			origin.push(new google.maps.LatLng($scope.myPosition.A, $scope.myPosition.F));
			for(var i = 0 ;i < data.length; i++){
				position = data[i];
				destinations.push(new google.maps.LatLng(position.latitude, position.longitude));
			}
		    service.getDistanceMatrix(
		    {
		      origins: origin,
		      destinations: destinations,
		      travelMode: google.maps.TravelMode.DRIVING,
		      unitSystem: google.maps.UnitSystem.METRIC,
		      avoidHighways: false,
		      avoidTolls: false
		    },function(response, status){
				if (status != google.maps.DistanceMatrixStatus.OK) {
				    alert('Get Matrix error: ' + status);
				    return;
				}
				var index = null;
				var inDis = 99999999;
				for(var i = 0; i < response.rows[0].elements.length;i++){
					 var element = response.rows[0].elements[i];
					 if(element.distance.value < inDis){
						 index = i;
					 }
				}
				var destination = [];
				destination.push(data[index]);
				$scope.appendLocation(destination);
				window.getDirection(data[index].id);
			});
			
        }).error(function(xhr, status, error){
        	alert("Load position error");
        });
	};
	
	window.showNearPositionInnKM = function(n){
		var lat = $scope.myPosition.A;
		var long = $scope.myPosition.F;
		$scope.clearMarkers();
		$http.get('/map/get-near-position?type='+$scope.selectedFilterByName+'&limit='+n+'&lat='+lat+'&long='+long,
				{headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT"}})
		.success(function(data){
			if(data.length == 0){
				alert("Không tồn tại địa chỉ phù hợp");
				return;
			}
			$scope.appendLocation(data);
        }).error(function(xhr, status, error){
        	alert("Load position error");
        });
	};
	
	window.getDirection = function(desId){
		var datasource = null;
		var markers = null;
		for(var i = 0 ; i < $scope.markersCollection.length; i++){
			var position = $scope.markersCollection[i];
			if(position.datasource.id == desId){
				markers = position;
				datasource = position.datasource;
			}
		}
		$scope.directionDestinationPosition = datasource;
		if(datasource == null){
			return;
		}
		var origin = $scope.myPosition.A+','+$scope.myPosition.F;
		var destimation = datasource.latitude+','+datasource.longitude;
		var request = {
		    origin: origin,
		    destination: destimation,
		    travelMode: google.maps.TravelMode.DRIVING
		};
		directionsService.route(request, function(response, status) {
		    if (status == google.maps.DirectionsStatus.OK) {
		      directionsDisplay.setDirections(response);
		      showInforWindow(markers);
		    }
		});
	};
	
	
	$scope.$watch('selected_position', function() {
		if($scope.selected_position == null){
			return;
		}
		$scope.clearMarkers();
		$scope.appendLocation([$scope.selected_position.originalObject]);
		var pos = new google.maps.LatLng($scope.selected_position.originalObject.latitude,$scope.selected_position.originalObject.longitude);
		map.setCenter(pos);
		showInforWindow($scope.markersCollection[0]);
	});
	
	$scope.searchLocationArea = function(){
		var selected_area = $scope.selected_phuong_xa;
		if(selected_area == undefined || selected_area == null || selected_area == ''){
			selected_area = $scope.selected_quan_huyen;
		}
		if(selected_area == undefined || selected_area == null || selected_area == ''){
			selected_area = $scope.selected_tinh_thanhpho;
		}
		$scope.callToSearchAPI("",selected_area,"","",$scope.currentPage,function(data){
			$scope.clearMarkers();
			$scope.appendLocation(data.results);
			$scope.listPosition = data.results;
			$scope.lastSearchResults = data;
		});
	};
	
	$scope.callToSearchAPI = function($name, $cateId, $type, $order_col, $page, $sucessCallback){
		$http.get('map/search?name='+$name+
				  '&cate-id='+$cateId+ 
				  '&type='+$type+
				  '&order-col='+$order_col+
				  '&page='+$page,{headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT"}})
		.success(function(data){
			if(typeof $sucessCallback == 'function'){
				$sucessCallback(data);
			}
	    }).error(function(xhr, status, error){});
	};
	
	$scope.reloadCategory = function(){
		$http.get('/api/categories/get_child/46',{headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT"}})
		.success(function(data){
			$scope.allowCategories = data;
	        $scope.LoadTinhThanh();
	    }).error(function(xhr, status, error){});
	};
	$scope.LoadTinhThanh = function(){
		$scope.tinh_thanhpho = [];
		$scope.quan_huyen = [];
		$scope.phuong_xa = [];
		var phongKhamId = 46 ;//hardcode
		for(var i = 0; i < $scope.allowCategories.length;i++){
			$item = $scope.allowCategories[i];
			if($item.category_id == 46 || $item.category_id == '46'){
				$scope.tinh_thanhpho.push($item);
			}
		}
		if(!$scope.$$phase) $scope.$apply();
	};
	$scope.$watch('selected_tinh_thanhpho', function() {
		$scope.quan_huyen = [];
		$scope.phuong_xa = [];
		for(var i = 0; i < $scope.allowCategories.length;i++){
			$item = $scope.allowCategories[i];
			if($item.category_id == $scope.selected_tinh_thanhpho){
				$scope.quan_huyen.push($item);
			}
		}
	 });
	$scope.$watch('selected_quan_huyen', function() {
		$scope.phuong_xa = [];
		for(var i = 0; i < $scope.allowCategories.length;i++){
			$item = $scope.allowCategories[i];
			if($item.category_id == $scope.selected_quan_huyen){
				$scope.phuong_xa.push($item);
			}
		}
	 });
	
	
	$scope.initialize = function(lat,long){
		//var pos = new google.maps.LatLng(21.044829, 105.757673);
		var pos = new google.maps.LatLng(lat, long);
		$scope.myPosition = pos;
	    var mapOptions = {
	       zoom: 13,
	       center: pos
	    };
	    if(map == undefined){
	    	
	    	map = new google.maps.Map(document.getElementById('mang-luoi-map'), mapOptions);
	    	google.maps.event.addListener(map, 'idle', function() {
				var center = map.getCenter();
				$scope.pressLocation(center.k == undefined ? center.A : center.k, center.D == undefined ? center.F : center.D)
			});
	    	directionsDisplay = new google.maps.DirectionsRenderer({suppressMarkers: true});
	    	directionsDisplay.setMap(map);
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

	    google.maps.event.addListener($scope.mylocation_marker, 'click', function() {
	    	showMyLocationInforWindow($scope.mylocation_marker);
		});
	    showMyLocationInforWindow($scope.mylocation_marker);
	};
	
	$scope.appendLocation = function(data){
		for(var j = 0 ; j < data.length; j++){
			var value = data[j];
			var isExits =  false;
			for(var i = 0; i < $scope.markersCollection.length; i++){
				if(value.id == $scope.markersCollection[i].datasource.id){
					isExits = true;
					break;
				}
			}
			var icon_path = "/img/icon-map-location.png";
			icon_path = value.position_type == "LABO" ? '/img/icon-map-labo.png' : icon_path;
			icon_path = value.position_type == "CO-SO-VLNK" ? '/img/icon-map-cs.png' : icon_path;
			if(!isExits){
				var pos = new google.maps.LatLng(value.latitude, value.longitude);
				var marker = new google.maps.Marker({
			        position: pos,
			        map: map,
			        icon:icon_path,
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
	
	$scope.clearMarkers = function(){
		for(var i= 0 ; i < $scope.markersCollection.length; i++){
			$scope.markersCollection[i].setMap(null);
		}
		$scope.markersCollection = [];
		$scope.listPosition = [];

		directionsDisplay.setMap(null);
		directionsDisplay = new google.maps.DirectionsRenderer({suppressMarkers: true});
		directionsDisplay.setMap(map);
	};
	
	// The five markers show a secret message when clicked
	// but that message is not within the marker's instance data
	function attachSecretMessage(marker) {
	  google.maps.event.addListener(marker, 'click', function() {
		  showInforWindow(marker);
	  });
	}
	
	function showInforWindow(marker){
		
		
		var contentString = '<div id="content" style="margin-right:30px" class="location">'+
	      '<h4 id="firstHeading" class="firstHeading" style="color:#0F75BB"><a href="/ban-do/'+marker.datasource.id+'">'+marker.datasource.name+'</a></h4>'+
	      '<div id="bodyContent">'+
		      '<p>'+ marker.datasource.detail_address +'</p>'+
		      '<p>'+ marker.datasource.hotline +'</p>'+
		      '<p>'+
		        '<a href="javascript:void(0)">'+marker.datasource.website_link+'</a>'+
		      '</p>'+
		      '<div class="like-number" onclick="like_position(this,'+marker.datasource.id+')">'+
			      '<table>'+
		      		'<tr>'+
		      			'<td><img src="/img/hear.fw.png"> </td>'+
		      			'<td>'+
		      				'<div class="nub"><s></s><i></i></div>'+
		          			'<span>'+$scope.getNumberByThoundsand(marker.datasource.like_number)+'</span></span>'+
		      			'</td>'+
		      		'</tr>'+
		      	'</table>'+
	      	 '</div>'+
              '<ul class="position-thubnail">'+
                '<li><img src="'+marker.datasource.img1+'"/></li>'+
                '<li><img src="'+marker.datasource.img2+'"/></li>'+
                '<li><img src="'+marker.datasource.img3+'"/></li>'+
                '<li><img src="'+marker.datasource.img4+'"/></li>'+
              '</ul>'+
              '<hr/>'+
              '<div>'+
                 '<a href="javascript:getDirection('+marker.datasource.id+')">Chỉ đường đến địa chỉ này</a>'
              '</div>'+
		  '</div>'+
	      '</div>';

		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});
		infowindow.open(map,marker);
	}
	
	function showMyLocationInforWindow(marker){
		var contentString = '<div id="content" class="mylocation">'+
	      '<h4 id="firstHeading" class="firstHeading" style="color:#0F75BB">Bạn đang ở đây</h4>'+
	      '<div id="bodyContent">'+
		      '<hr/>'+
		      '<p style="font-weight:bold">Địa điểm trong bán kính:</p>'+
		      '<div>'+
		          '<a href="javascript:getNearPosition(0)" style="font-weight:bold">Gần nhất</a> &nbsp;&nbsp;&nbsp;'+
		          '<a href="javascript:showNearPositionInnKM(5)">5 KM</a>&nbsp;&nbsp;&nbsp;'+
		          '<a href="javascript:showNearPositionInnKM(10)">10 KM</a>&nbsp;&nbsp;&nbsp;'+
		      '</div>'+
		  '</div>'+
	      '</div>';
		var inforMyLocation = new google.maps.InfoWindow({
	          map: map,
	          position: $scope.myPosition,
	          content: contentString
	    });
	    inforMyLocation.open(map,$scope.mylocation_marker);
	}
	
	$scope.pressLocation = function(lat,long){
		if($scope.lastSearchResults != null || $scope.selected_position != null || $scope.directionDestinationPosition != null){
			return;
		}
		$http.get('/map/get-near-position?total=30&lat='+lat+'&long='+long,
				{headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT"}})
		.success(function(data){
			$scope.appendLocation(data);
        }).error(function(xhr, status, error){
        	alert("Load position error");
        });
	};
	
	$scope.move_to_search_by_localtion = function(){
		 //$("html, body").animate({ scrollTop: 0 }, "slow");
		if($scope.listState != "by-area"){
			$scope.clearMarkers();
			$scope.lastSearchResults = null;
		}
		
		$scope.listState = "by-area";
		 $('html, body').animate({
             scrollTop: 550
         }, 1000);
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
	$scope.getNumberByThoundsand = function(x){
		return getNumberByThoundsand(x);
	};
	  $scope.getMyLocation();
	  $scope.reloadCategory();
}
function OtherController($scope) {
  $scope.pageChangeHandler = function(num) {
    console.log('going to page ' + num);
  };
}
function getNumberByThoundsand(x){
	var int = parseInt(x);
	if(int < 1000){
		return int;
	}
	return int/1000 + 'K';
}
PositionController.$inject = ['$scope','$http'];
OtherController.$inject = ['$scope'];