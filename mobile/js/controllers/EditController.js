

function EditController($scope,$http)
{
    $scope.post = editPost;
    $scope.tags = editTag;
    $scope.allowCategories = [];
    $scope.selectedCategory = 0;
    $scope.youtubeLink = '';
    $scope.youtubeThumbnailLink = '';
    $scope.description = '';
    
    $scope.initalVideo = function(){
        if(editCategory.category_type != 'VIDEO'){
            return;
        }
        $scope.youtubeLink = $scope.post.content.replace('<iframe width="560px" height="315px" src="http://www.youtube.com/embed/',"");
        $scope.youtubeLink = $scope.youtubeLink.replace('" frameborder="0" allowfullscreen></iframe>',"");
        $scope.youtubeLink = 'http://www.youtube.com/watch?v='+$scope.youtubeLink;
        $scope.description = $scope.post.description;
        $scope.onChangeYoutubeLink();
    };
    
    $scope.initalPost = function(){
        if(editCategory.category_type != 'POST'){
            return;
        }
        $scope.description = $scope.post.description;
        $scope.content = $scope.post.content;
    };
    
    $http.get('/api/categories/get_child/all',
            {headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT"}}
    ).success(function(data){
        $scope.childCategories = data;
        $scope.targetCategory = {};
        for(var i = 0; i< $scope.childCategories.length; i++){
            var level = $scope.childCategories[i].part_tree.split(",");
            for(var j = 1; j< level.length; j++){
                $scope.childCategories[i].name = ":::"+$scope.childCategories[i].name;
            }
            if($scope.childCategories[i].category_type == editCategory.category_type && $scope.childCategories[i].visible == '1'){
                $scope.allowCategories.push($scope.childCategories[i]);
                
            }
            if($scope.childCategories[i].id == editPost.category_id){
                    $scope.targetCategory = $scope.childCategories[i];
            }
        }
        if($scope.targetCategory.visible == 0){
            $scope.allowCategories = [];
            $scope.allowCategories.push($scope.targetCategory);
        }
        $scope.selectedCategory = editPost.category_id;
        $scope.changeCategory();
        $scope.initalVideo();
        $scope.initalPost();
    }).error(function(xhr, status, error){});
    
    
    $scope.LoadTagResult = function(query){
        return $http.get("/api/tags/search?value="+encodeURIComponent(query), {headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT"}});
    };
    
    $scope.OnAddTag = function(tag){};

    $scope.submit = function(){
        $scope.frm = $("#edit-frm").validate();
        if($scope.frm.errorList.length == 0){
            $("#edit-frm").submit();
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
    $scope.getSelectedCategory = function(){
        
        return $scope.allowCategories[$scope.selectedCategory].id;
    };
    $scope.changeCategory = function(){
        $id = $scope.selectedCategory;
        for(var i = 0; i < $scope.allowCategories.length ; i++){
            if($scope.allowCategories[i].id != $id){
                continue;
            }
            switch($scope.allowCategories[i].category_type){
                case 'POST':
                case 'STATIC':
                    $scope.PostTemplate = 'editPost.html';
                break;
                case 'VIDEO':
                    $scope.PostTemplate = 'editVideo.html';
                break;
                case 'GAME':
                    $scope.PostTemplate = 'editGame.html';
                break;
            }
        }
    };
}
EditController.$inject = ['$scope','$http'];