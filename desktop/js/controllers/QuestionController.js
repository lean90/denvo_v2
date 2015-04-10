function QuestionController($scope,$http,$cookieStore,$cookies){
	$scope.question = window.question;
	$scope.answers = window.answers;
	$scope.me = window.me;
	$scope.cookie = $cookieStore.get("liked_"+$scope.me.id+"_"+$scope.question.id);
	$scope.getFullName = function(){
		if($scope.question.user != undefined){
			return $scope.question.user.full_name;
		}else{
			return $scope.question.full_name;
		}
	};
	$scope.get_like_link = function($answer){
		
		if($scope.cookie == undefined){
			return "/answer/like/"+$answer.id;
		}
		
		var isExist = $scope.cookie.indexOf($answer.id);
		if(isExist != -1 ){
			return null;
		}
		return "/answer/like/"+$answer.id;
	};
	$scope.showDetailImage = function($id){
		$($id).modal();
		$($id).modal('show');
	};
	
}
QuestionController.$inject = ['$scope','$http','$cookieStore','$cookies'];