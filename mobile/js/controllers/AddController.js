

function AddController($scope,$http)
{

    $scope.config = addConfig;
    $scope.categoriesId = null;
    $scope.childCategories = [];
    $scope.PostTemplate = 'addPost.html';
    $scope.tags = [];
    $scope.category = addConfig.id;
    $scope.title;
    $scope.description;
    $scope.logo;
    $scope.content;
    $scope.youtubeLink = '';
    $scope.youtubeThumbnailLink = '';
    $scope.templateVideo = "<iframe width='560' height='315' src='//{link}' frameborder='0' allowfullscreen></iframe>";
    switch(addConfig.category_type){
        case 'POST':
            $scope.PostTemplate = 'addPost.html';
        break;
        case 'VIDEO':
            $scope.PostTemplate = 'addVideo.html';
        break;
        case 'GAME':
            $scope.PostTemplate = 'addGame.html';
        break;
    }
    
    
    $http.get('/api/categories/get_child/'+$scope.config.id,
            {headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT"}}
    ).success(function(data){
        $scope.childCategories = data;
        for(var i = 0; i< $scope.childCategories.length; i++){
            var level = $scope.childCategories[i].part_tree.split(",");
            for(var j = 1; j< level.length; j++){
                $scope.childCategories[i].name = ":::"+$scope.childCategories[i].name;
            }
        }
    }).error(function(xhr, status, error){});
    
    $scope.LoadTagResult = function(query){
        return $http.get("/api/tags/search?value="+encodeURIComponent(query), {headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT"}});
    };
    
    $scope.OnAddTag = function(tag){};

    $scope.submit = function(){
        $scope.frm = $("#add-frm").validate();
        if($scope.frm.errorList.length == 0){
            $("#add-frm").submit();
        }
    };
    

    $scope.onChangeYoutubeLink = function(){
        var common = new Common();
        $scope.youtubeThumbnailLink = "http://img.youtube.com/vi/<insert-youtube-video-id-here>/default.jpg".replace('<insert-youtube-video-id-here>', common.getYoutubeVideoId($scope.youtubeLink));;
        
        $id = $scope.category;
        for(var i = 0; i < $scope.childCategories.length ; i++){
            if($scope.childCategories[i].id != $id && $scope.childCategories[i].category_type != 'VIDEO'){
                continue;
            }
            $scope.content = '<iframe width="560px" height="315px" src="http://www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe>'.replace('$1', common.getYoutubeVideoId($scope.youtubeLink));
        }
        
    };
    
    $scope.changeCategory = function(){
        $id = $scope.category;
        for(var i = 0; i < $scope.childCategories.length ; i++){
            if($scope.childCategories[i].id != $id){
                continue;
            }
            switch($scope.childCategories[i].category_type){
                case 'POST':
                    $scope.PostTemplate = 'addPost.html';
                break;
                case 'VIDEO':
                    $scope.PostTemplate = 'addVideo.html';
                break;
                case 'GAME':
                    $scope.PostTemplate = 'addGame.html';
                break;
            }
        }
    };
    
}
AddController.$inject = ['$scope','$http'];