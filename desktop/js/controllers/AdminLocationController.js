function AdminLocationController($scope,$http,$cookieStore,$cookies){
	$scope.keyWord = '';
	$scope.locations = [];
	$scope.rootCategory = window.rootCate;
	$scope.allowCategories = [];
	$scope.selectedLocation =  {};
	$scope.selectedCategoryId = "";
	$scope.selectedEditArea = {id:"",name:""};
	$scope.selectedEditParentArea = {};
	$scope.allowCategoriesAssgineForParrent = [];
	var map;
	
	$scope.searchLocation = function(){
		$http.get('/__admin/search-localtion?q='+$scope.keyWord,
				{headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT"}})
		.success(function(data){
			if(typeof data != 'object'){
				alert("searching error");
				return;
			}
			$scope.locations = data;
        }).error(function(xhr, status, error){
        	alert("Load position error");
        });
	};
	
	$scope.selectingLocation = function(location){
		$scope.selectedLocation = location;
		$scope.selectedCategoryId = $scope.selectedLocation.fk_category;
		map.setCenter(new google.maps.LatLng(parseFloat($scope.selectedLocation.latitude), parseFloat($scope.selectedLocation.longitude)));
		CKEDITOR.instances.content.setData($scope.selectedLocation.description);
	};
	
	$scope.initialize_map = function(lat,long){
		
		//var pos = new google.maps.LatLng(21.044829, 105.757673);
		var pos = new google.maps.LatLng(lat, long);
	    var mapOptions = {
	       zoom: 15,
	       center: pos
	    };
	    if(map == undefined){
	    	map = new google.maps.Map(document.getElementById('main-map'), mapOptions);
	    	google.maps.event.addListener(map, 'idle', function() {
				var center = map.getCenter();
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
	
	$scope.getMyLocation = function(){
		  if(navigator.geolocation) {
		    navigator.geolocation.getCurrentPosition(function(position) {
		      $scope.initialize_map(position.coords.latitude,position.coords.longitude);
		    }, function() {
		      $scope.initialize_map(21.044829, 105.757673);
		    });
		  }
		  // Browser doesn't support Geolocation
		  else {
		    $scope.initialize_map(21.044829, 105.757673);
		  }
	  };
	  $scope.getMyLocation();
	
	$scope.AddNewLocation = function(){
		$content = CKEDITOR.instances.content.getData();
		$location = map.getCenter();
		$http.post('/__admin/add-position',
                $.param(
                		{
							data : {
								position_type : $scope.selectedLocation.position_type,
								fk_category : $scope.selectedLocation.fk_category,
								name : $scope.selectedLocation.name,
								description : $content,
								website_link : $scope.selectedLocation.website_link,
								lat : $location.k,
								long : $location.D
								}
							}
                		),
                {headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT",'Content-Type':'application/x-www-form-urlencoded;charset=utf-8'}}
        ).success(function(data){
        	alert("Thêm địa chỉ mới thành công");
        	$scope.searchLocation();
        }).error(function(xhr, status, error){
            alert("Thêm thất bại"); 
        });
	}
	
	$scope.Update = function(){
		if($scope.selectedLocation.id == '' || $scope.selectedLocation.id == undefined){
			alert("Vui lòng chọn địa điểm!");
			return;
		}
		$content = CKEDITOR.instances.content.getData();
		$location = map.getCenter();
		$http.post('/__admin/update-position',
                $.param(
                		{
							data : {
								position_type : $scope.selectedLocation.position_type,
								id:$scope.selectedLocation.id,
								fk_category : $scope.selectedLocation.fk_category,
								name : $scope.selectedLocation.name,
								description : $content,
								website_link : $scope.selectedLocation.website_link,
								lat : $location.k,
								long : $location.D
								}
							}
                		),
                {headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT",'Content-Type':'application/x-www-form-urlencoded;charset=utf-8'}}
        ).success(function(data){
        	alert("Sửa địa chỉ mới thành công");
        	$scope.searchLocation();
        }).error(function(xhr, status, error){
            alert("Sửa thất bại"); 
        });
	};
	$scope.del = function(localtion){
		$http.post('/__admin/del-position',
                $.param({data : {id:localtion.id}}),
                {headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT",'Content-Type':'application/x-www-form-urlencoded;charset=utf-8'}}
        ).success(function(data){
        	alert("Xóa địa chỉ mới thành công");
        	$scope.searchLocation();
        }).error(function(xhr, status, error){
            alert("Xóa thất bại"); 
        });
	};
	
	 $scope.$watch('selectedEditArea', function() {
		 $scope.allowCategoriesAssgineForParrent = [];
		 var parentItem = {};
		 var selectedItem = {};
		 for(var i = 0; i < $scope.allowCategories.length; i++){
			 var expectedItem = {};
			 for(var j = 0; j < $scope.allowCategories.length; j++){
				 if($scope.selectedEditArea == $scope.allowCategories[j].id){
					 expectedItem = $scope.allowCategories[j];
					 selectedItem = expectedItem;
				 }
			 }
			 if(expectedItem.category_id == $scope.allowCategories[i].id){
				 $scope.selectedEditParentArea = $scope.allowCategories[i].id;
				 parentItem = $scope.allowCategories[i];
			 } 
		 }
		 if(selectedItem.category_type == "STATIC"){
			 $("#add-area-del").hide();
			 $("#add-area-update").hide();
		 }else{
			 $("#add-area-del").show();
			 $("#add-area-update").show();
		 }
		 
		 $("#areaname").val($scope.getSelectedAreaName());
	 });
	 $scope.getSelectedAreaName = function(){
		 for(var i = 0; i < $scope.allowCategories.length; i++){
			 var expectedItem = {};
			 for(var j = 0; j < $scope.allowCategories.length; j++){
				 if($scope.selectedEditArea == $scope.allowCategories[j].id){
					 return $scope.allowCategories[j].name.replace(/:/g,"");
				 }
			 }
			 
		 }
	 };

	
	$scope.addArea = function(){
		$http.post('/__admin/add-area',
				$.param({
							data : {
								name : $("#areaname").val(),
								parent : $scope.selectedEditParentArea
							}
						}),
                {headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT",'Content-Type':'application/x-www-form-urlencoded;charset=utf-8'}}
        ).success(function(data){
        	alert("Thêm khu vực mới thành công");
        	$scope.reloadCategory();
        }).error(function(xhr, status, error){
            alert("Thêm khu vực thất bại"); 
        });
	};
	 
	$scope.delArea = function(selectedEditArea){
		$http.post('/__admin/del-area',
				$.param({
							data : {
								id : selectedEditArea
							}
						}),
                {headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT",'Content-Type':'application/x-www-form-urlencoded;charset=utf-8'}}
        ).success(function(data){
        	alert("Xóa khu vực mới thành công");
        	$scope.reloadCategory();
        }).error(function(xhr, status, error){
            alert("Xóa khu vực thất bại"); 
        });
	};
	
	$scope.updateArea = function(){
		$http.post('/__admin/update-area',
				$.param({
							data : {
								id : $scope.selectedEditArea,
								name: $("#areaname").val(),
								parent : $scope.selectedEditParentArea
							}
						}),
                {headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT",'Content-Type':'application/x-www-form-urlencoded;charset=utf-8'}}
        ).success(function(data){
        	alert("Cập nhật khu vực mới thành công");
        	$scope.reloadCategory();
        }).error(function(xhr, status, error){
            alert("Cập nhật khu vực thất bại"); 
        });
	};
	
	$scope.reloadCategory = function(){
	
		$scope.allowCategories = [];
		
		$http.get('/api/categories/get_child/'+$scope.rootCategory.id,{headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT"}})
		.success(function(data){
	        $scope.childCategories = data;
	        $scope.targetCategory = {};
	        for(var i = 0; i< $scope.childCategories.length; i++){
	            var level = $scope.childCategories[i].part_tree.split(",");
	            for(var j = 1; j< level.length; j++){
	                $scope.childCategories[i].name = ":::"+$scope.childCategories[i].name;
	            }
	            $scope.allowCategories.push($scope.childCategories[i]);
	        }
	        if($scope.targetCategory.visible == 0){
	            $scope.allowCategories = [];
	            $scope.allowCategories.push($scope.targetCategory);
	        }
	    }).error(function(xhr, status, error){});
	};
	
	$scope.reloadCategory();
	
	
}
AdminLocationController.$inject = ['$scope','$http','$cookieStore','$cookies'];