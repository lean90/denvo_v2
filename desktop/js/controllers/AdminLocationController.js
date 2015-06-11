function AdminLocationController($scope,$modal,$http,$cookieStore,$cookies){
	$scope.keyWord = '';
	$scope.locations = [];
	$scope.rootCategory = window.rootCate;
	$scope.allowCategories = [];
	$scope.selectedLocation =  {};
	$scope.selectedCategoryId = "";
	$scope.selectedEditArea = {id:"",name:""};
	$scope.selectedEditParentArea = {};
	$scope.allowCategoriesAssgineForParrent = [];
	$scope.tinh_thanhpho = [];
	$scope.quan_huyen = [];
	$scope.phuong_xa = [];
	$scope.selected_tinh_thanhpho = {};
	$scope.selected_quan_huyen = {};
	$scope.selected_phuong_xa = {};
	$scope.dragableAreaList = [];
	$scope.dumpDragableAreaList = [];
	$scope.current_lat = "";
	$scope.current_long = "";
	
	
	$scope.choiceLogo = function(){
		window.open('/kcfinder/browse.php?type=images', 'kcfinder_single',"width=800, height=600");
		window.KCFinder = {};
		window.KCFinder.callBack = function(url) {
			$scope.selectedLocation.logo = url;
	        window.KCFinder = null;
	        if(!$scope.$$phase) $scope.$apply();
	    };
	}
	
	$scope.onChangeLocation = function(){
		var $location = map.getCenter();
		var lat = $location.k == undefined ? $location.A : $location.k;
		var long = $location.D == undefined ? $location.F : $location.D;
		if($scope.current_lat != lat || $scope.current_long != long){
			map.setCenter(new google.maps.LatLng(parseFloat($scope.current_lat), parseFloat($scope.current_long)));
		}
	};
	
	
	$scope.treeOptions = {
		dropped: function(sourceNodeScope) {
			var scope = sourceNodeScope.source.nodeScope
			var name = scope.$modelValue.name;
			var parentId = sourceNodeScope.dest.nodesScope.$parent.$modelValue == undefined ? 46 : sourceNodeScope.dest.nodesScope.$parent.$modelValue.id;
			parentId = parentId == undefined ? 46 : parentId;
			$scope.updateArea(scope.$modelValue.id,name,parentId,function(data){
		        $scope.reloadCategory();
	        });
           return true;
       },
    };
	
	$scope.getShowAddStatus = function(scope){
		return scope.depth() < 3;
	};
	
	$scope.removeSubArea = function(scope){
		var id = scope.$modelValue.id;
		var r = confirm("Bạn có chắc chắn muốn xóa địa điểm này !");
		if (r == true) {
			$scope.delArea(id,function(data){
				alert('Xóa khu vực thành công');
				scope.remove(scope);
				$scope.reloadCategory();
			});
		}
		
	};
	$scope.addSubArea = function(scope){
		var parentId = scope  == undefined ? 46 : scope.$modelValue.id;
		$modal.open({
		      animation: true,
		      templateUrl: 'edit-dialog.html',
		      controller: 'editDialogController',
		      resolve: {
		        item: function () {
		          return name;
		        }
		      }
		    }).result.then(function (name) {
		        $scope.addArea(name,parentId,function(data){
		        	data.childs = [];
		        	if(scope != undefined){
		        		scope.$modelValue.childs.push(data);
		        	}else{
		        		$scope.dragableAreaList.push(data);
		        	}
		            
		            $scope.reloadCategory();
		        });
		    }, function () {
		        $log.info('Modal dismissed at: ' + new Date());
		    });
		return true;
	};
	
	$scope.edit = function(scope){
		var name = scope.$modelValue.name;
		var parentId = $scope.getParentFromDragableAreaList(scope.$modelValue.id,$scope.dragableAreaList);
		parentId = parentId == undefined ? 46 : parentId;
		$modal.open({
		      animation: true,
		      templateUrl: 'edit-dialog.html',
		      controller: 'editDialogController',
		      resolve: {
		        item: function () {
		          return name;
		        }
		      }
		    }).result.then(function (name) {
		        $scope.updateArea(scope.$modelValue.id,name,parentId,function(data){
		            scope.$modelValue.name = name;
			        $scope.reloadCategory();
		        });
		    }, function () {
		        $log.info('Modal dismissed at: ' + new Date());
		    });
		return true;
	};
	
	$scope.getParentFromDragableAreaList = function(specId,objectList){
		for(var i = 0; i < objectList.length ; i++){
			var currentItem = objectList[i];
			for(var j = 0; j < currentItem.childs.length ; j++){
				if(currentItem.childs[j].id == specId){
					return currentItem.id;
				}else{
					$scope.getParentFromDragableAreaList(specId,currentItem.childs[j].childs);
				}
			}
		}
	};
	
	
	
	$scope.initialDragableArea = function(){
		$scope.dragableAreaList = [];
		$http.get('/api/categories/get_child/46',{headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT"}})
		.success(function(data){
		   $scope.dumpDragableAreaList = data;
	       for(var i = 0; i < $scope.dumpDragableAreaList.length; i++){
	    	   $scope.dumpDragableAreaList[i].childs = [];
	    	   for(var j = 0; j < $scope.dumpDragableAreaList.length; j++){
		    	   if($scope.dumpDragableAreaList[i].id == $scope.dumpDragableAreaList[j].category_id){
		    		   $scope.dumpDragableAreaList[i].childs.push($scope.dumpDragableAreaList[j]);
		    	   }
		       }
	       }
	       for(var i = 0; i < $scope.dumpDragableAreaList.length; i++){
	    	   if($scope.dumpDragableAreaList[i].category_id  ==  46 || $scope.dumpDragableAreaList[i].category_id  ==  '46'){
	    		   $scope.dragableAreaList.push($scope.dumpDragableAreaList[i]);
	    	   }
	       }
	       
	    }).error(function(xhr, status, error){
	    	alert("Lỗi khu vực lỗi !");
	    });
	};
	
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
		//$scope.selectedCategoryId = $scope.selectedLocation.fk_category;
		map.setCenter(new google.maps.LatLng(parseFloat($scope.selectedLocation.latitude), parseFloat($scope.selectedLocation.longitude)));
		CKEDITOR.instances.content.setData($scope.selectedLocation.description);
		//Set location.
		$categoryLocation = {};
		for(var i = 0 ;i < $scope.allowCategories.length;i++){
			$item = $scope.allowCategories[i];
			if($item.id == location.fk_category){
				$categoryLocation = $item;
				break;
			}
			
		}
		var noteList = $categoryLocation.part_tree.split(',');
		$scope.selected_tinh_thanhpho = noteList[1];
		$scope.selected_quan_huyen = noteList[2];
		$scope.selected_phuong_xa = noteList[3];
		
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
				var lat = center.k == undefined ? center.A : center.k;
				var long = center.D == undefined ? center.F : center.D;
				if($scope.current_lat != lat || $scope.current_long != long){
					$scope.current_lat = lat;
					$scope.current_long = long;
					if ($scope.$root.$$phase != '$apply' && $scope.$root.$$phase != '$digest') {
					    $scope.$apply();
					}
				}
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
								fk_category : $scope.selected_phuong_xa,
								name : $scope.selectedLocation.name,
								description : $content,
								website_link : $scope.selectedLocation.website_link,
								logo: $scope.selectedLocation.logo,
								img1 : $scope.selectedLocation.img1,
								img2 : $scope.selectedLocation.img2,
								img3 : $scope.selectedLocation.img3,
								img4 : $scope.selectedLocation.img4,
								detail_address : $scope.selectedLocation.detail_address,
								sort_description : $scope.selectedLocation.sort_description,
								email : $scope.selectedLocation.email,
								working_time : $scope.selectedLocation.working_time,
								hotline : $scope.selectedLocation.hotline,
								lat : $location.k == undefined ? $location.A : $location.k,
								long : $location.D == undefined ? $location.F : $location.D
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
								fk_category : $scope.selected_phuong_xa,
								name : $scope.selectedLocation.name,
								description : $content,
								website_link : $scope.selectedLocation.website_link,
								img1 : $scope.selectedLocation.img1,
								img2 : $scope.selectedLocation.img2,
								img3 : $scope.selectedLocation.img3,
								img4 : $scope.selectedLocation.img4,
								logo: $scope.selectedLocation.logo,
								detail_address : $scope.selectedLocation.detail_address,
								sort_description : $scope.selectedLocation.sort_description,
								lat : $location.k == undefined ? $location.A : $location.k,
								long : $location.D == undefined ? $location.F : $location.D,
								email : $scope.selectedLocation.email,
								working_time : $scope.selectedLocation.working_time,
								hotline : $scope.selectedLocation.hotline
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

	
	$scope.addArea = function(name,parent,callback){
		$http.post('/__admin/add-area',
				$.param({
							data : {
								name : name,
								parent : parent
							}
						}),
                {headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT",'Content-Type':'application/x-www-form-urlencoded;charset=utf-8'}}
        ).success(function(data){
           if(typeof callback == 'function'){
               callback(data);
           }
        }).error(function(xhr, status, error){
            alert("Thêm khu vực thất bại");
            window.reload();
        });
	};
	 
	$scope.delArea = function(selectedEditArea,callback){
		$http.post('/__admin/del-area',
				$.param({
							data : {
								id : selectedEditArea
							}
						}),
                {headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT",'Content-Type':'application/x-www-form-urlencoded;charset=utf-8'}}
        ).success(function(data){
        	if(typeof callback == 'function'){
        		callback(data);
        	}
        }).error(function(xhr, status, error){
            alert("Xóa khu vực thất bại");
            window.reload();
        });
	};
	
	$scope.updateArea = function(id,name,parent,callback){
		$http.post('/__admin/update-area',
				$.param({
							data : {
								id : id,
								name: name,
								parent : parent
							}
						}),
                {headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT",'Content-Type':'application/x-www-form-urlencoded;charset=utf-8'}}
        ).success(function(data){
        	if(typeof callback == 'function'){
        		callback(data);
        	}
        }).error(function(xhr, status, error){
            alert("Cập nhật khu vực thất bại"); 
            window.reload();
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
	
	$scope.openKCFinder = function(imageIndex) {
		window.open('/kcfinder/browse.php?type=images', 'kcfinder_single',"width=800, height=600");
		window.KCFinder = {};
		window.KCFinder.callBack = function(url) {
			switch(imageIndex){
				case 1 :
				    $scope.selectedLocation.img1 = url;
				break;
				case 2 :
				    $scope.selectedLocation.img2 = url;
				break;
				case 3 :
				    $scope.selectedLocation.img3 = url;
				break;
				case 4 :
				    $scope.selectedLocation.img4 = url;
				break;
			}
	        window.KCFinder = null;
	        if(!$scope.$$phase) $scope.$apply();
	    };
	}
	
	$scope.reloadCategory();
	$scope.initialDragableArea();
}

function editDialogController($scope, $modalInstance, item){
	$scope.input = {};
	$scope.input.name = item;
	$scope.ok = function () {
	    $modalInstance.close($scope.input.name);
	};

	$scope.cancel = function () {
	    $modalInstance.dismiss('cancel');
	};
}
editDialogController.$inject = ['$scope','$modalInstance','item'];
AdminLocationController.$inject = ['$scope','$modal','$http','$cookieStore','$cookies'];