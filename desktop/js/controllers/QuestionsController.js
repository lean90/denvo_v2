function QuestionsController($scope,$http){
	$("#overlap").show();
	$scope.tabtitle = "Câu hỏi được quan tâm nhất";
    $scope.questions = [];
    $scope.total_question = 0;
    $scope.current_page = 1;
    $scope.currentTab = 'many-new';
    $scope.me = window.me;
    
	$scope.changeList = function(name,page){
		$("#overlap").show();
		$scope.currentTab = name;
		switch(name){
		case "many-like":
			$http.get('/questions/get/many-like?page='+page,{headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT"}})
			.success(function(data){
				$scope.tabtitle = "Câu hỏi được quan tâm nhất";
				$scope.questions = data['data']['questions'];
				$scope.current_page = data['page'];
				$("#overlap").hide();
	        }).error(function(xhr, status, error){
	        	$("#overlap").hide();
	        });
			break;
		case "many-view":
			$http.get('/questions/get/MOST?page='+page,{headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT"}})
			.success(function(data){
				$scope.tabtitle = "Câu hỏi thường gặp";
				$scope.questions = data['data']['questions'];
				$scope.current_page = data['page'];
				$("#overlap").hide();
	        }).error(function(xhr, status, error){
	        	$("#overlap").hide();
	        });
			break;
		case "many-new":
			$http.get('/questions/get/fill_all?page='+page ,{headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT"}})
			.success(function(data){
				$scope.tabtitle = "Câu hỏi mới nhất";
				$scope.questions = data['data']['questions'];
				$scope.current_page = data['page'];
				$("#overlap").hide();
	        }).error(function(xhr, status, error){
	        	$("#overlap").hide();
	        });
			break;
		}
    };
    
    
    $scope.changeList('many-new',1);
}
QuestionsController.$inject = ['$scope','$http'];