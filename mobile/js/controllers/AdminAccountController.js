
function AdminAccountController($scope,$http,$sce)
{
    $scope.selectedUser = {};
    $scope.searchResults = searchResults;
    $scope.historyLoading = false;
    $scope.ticketSupportLoading = false;
    $scope.histories = [];
    $scope.ticketSupports = [];

    $scope.setSelected = function(user){
        $scope.selectedUser = user;
        $("#frm-permission").attr('action',"/__admin/account/"+$scope.selectedUser.id+"/set_permission");
        $("#frm-status").attr('action',"/__admin/account/"+$scope.selectedUser.id+"/set_banned_status");
        $("input[name=user_id]").val(user.id);
        
        $http.get('/api/__admin/account/'+user.id+'/history',{headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT"}})
             .success(function(data){
                $scope.historyLoading = false;
                $scope.histories = data;
        });
        
        $http.get('/api/__admin/account/'+user.id+'/ticket_support',{headers:{"If-Modified-Since":"Thu,01 Jun 1970 00:00:00 GMT"}})
             .success(function(data){
                $scope.ticketSupportLoading = false;
                $scope.ticketSupports = data;
        });
        
        $scope.historyLoading = true;
        $scope.ticketSupportLoading = true;
    };
    
    $scope.setPermisson = function(permission){
        $("input[name=permission]").val(permission);
        $("#frm-permission").submit();
    };
    
    $scope.setStatus = function(status){
        $("input[name=status]").val(status);
        $("#frm-status").submit();
    };
    $scope.getTicketContent = function(ticket){
        return  $sce.trustAsHtml(ticket.ticket_content);
    };
    $scope.getHistoryContent = function(history){
        return  $sce.trustAsHtml(history.activity);
    };
    
    $scope.getExportUrl = function(){
        var  common = new Common();
        var email = common.getParameterByName('email');
        var full_name =  common.getParameterByName('full_name');
        return "/__admin/account/export?email="+email+"&full_name="+full_name;
        
    };
}
AdminAccountController.$inject = ['$scope','$http','$sce'];