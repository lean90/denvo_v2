function ProfileHomeController($scope,$http){
    
   $scope.histories  = histories;
   $scope.me = me;
   $scope.selectedHistory = "";
   $scope.openProfilePage = function(){
       var item = $scope.selectedHistory;
       if(me.id == undefined){
           window.location = "/login";
           return;
       }
       if(item.id == undefined)
       {
           window.location = "/profile/"+$scope.me.id+"/ho-so-rang-mieng?full_name="+encodeURIComponent(item);
           return;
       }else{
           window.location = "/profile/"+$scope.me.id+"/ho-so-rang-mieng?history="+item.id;
           return;
       }
   };
    
}
ProfileHomeController.$inject = ['$scope','$http'];