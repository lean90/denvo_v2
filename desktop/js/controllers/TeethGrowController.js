function TeethGrowController($scope,$http)
{
    $scope.toothDefined = [{code:"RS_51",name:"Răng cửa giữa hàm trên bên phải"},{code:"RS_52",name:"Răng cửa bên hàm trên bên phải"},{code:"RS_53",name:"Răng nanh hàm trên bên phải"},{code:"RS_54",name:"Răng hàm thứ nhất hàm trên bên phải"},{code:"RS_55",name:"Răng hàm thứ hai hàm trên bên phải"},{code:"RS_61",name:"Răng cửa giữa hàm trên bên trái"},{code:"RS_62",name:"Răng cửa bên hàm trên bên trái"},{code:"RS_63",name:"Răng nanh hàm trên bên trái"},{code:"RS_64",name:"Răng hàm thứ nhất hàm trên bên trái"},{code:"RS_65",name:"Răng hàm thứ hai hàm trên bên trái"},{code:"RS_71",name:"Răng cửa giữa hàm dưới bên trái"},{code:"RS_72",name:"Răng cửa bên hàm dưới bên trái"},{code:"RS_73",name:"Răng nanh hàm dưới bên trái"},{code:"RS_74",name:"Răng hàm thứ nhất hàm dưới bên trái"},{code:"RS_75",name:"Răng hàm thứ hai hàm dưới bên trái"},{code:"RS_81",name:"Răng cửa giữa hàm dưới bên phải"},{code:"RS_82",name:"Răng cửa bên hàm dưới bên phải"},{code:"RS_83",name:"Răng nanh hàm dưới bên phải"},{code:"RS_84",name:"Răng hàm thứ nhất hàm dưới bên phải"},{code:"RS_85",name:"Răng hàm thứ hai hàm dưới bên phải"},{code:"RVV_11",name:"Răng cửa giữa hàm trên bên phải"},{code:"RVV_12",name:"Răng cửa bên hàm trên bên phải"},{code:"RVV_13",name:"Răng nanh hàm trên bên phải"},{code:"RVV_14",name:"Răng hàm nhỏ thứ nhất hàm trên bên phải"},{code:"RVV_15",name:"Răng hàm nhỏ thứ hai hàm trên bên phải"},{code:"RVV_16",name:"Răng hàm lớn thứ nhất hàm trên bên phải"},{code:"RVV_17",name:"Răng hàm lớn thứ hai hàm trên bên phải"},{code:"RVV_18",name:"Răng khôn hàm trên bên phải"},{code:"RVV_21",name:"Răng cửa giữa hàm trên bên trái"},{code:"RVV_22",name:"Răng cửa bên hàm trên bên trái"},{code:"RVV_23",name:"Răng nanh hàm trên bên trái"},{code:"RVV_24",name:"Răng hàm nhỏ thứ nhất hàm trên bên trái"},{code:"RVV_25",name:"Răng hàm nhỏ thứ hai hàm trên bên trái"},{code:"RVV_26",name:"Răng hàm lớn thứ nhất hàm trên bên trái"},{code:"RVV_27",name:"Răng hàm lớn thứ hai hàm trên bên trái"},{code:"RVV_28",name:"Răng khôn hàm trên bên trái"},{code:"RVV_31",name:"Răng cửa giữa hàm dưới bên trái"},{code:"RVV_32",name:"Răng cửa bên hàm dưới bên trái"},{code:"RVV_33",name:"Răng nanh hàm dưới bên trái"},{code:"RVV_34",name:"Răng hàm nhỏ thứ nhất hàm dưới bên trái"},{code:"RVV_35",name:"Răng hàm nhỏ thứ hai hàm dưới bên trái"},{code:"RVV_36",name:"Răng hàm lớn thứ nhất hàm dưới bên trái"},{code:"RVV_37",name:"Răng hàm lớn thứ hai hàm dưới bên trái"},{code:"RVV_38",name:"Răng khôn hàm dưới bên trái"},{code:"RVV_41",name:"Răng cửa giữa hàm dưới bên phải"},{code:"RVV_42",name:"Răng cửa bên hàm dưới bên phải"},{code:"RVV_43",name:"Răng nanh hàm dưới bên phải"},{code:"RVV_44",name:"Răng hàm nhỏ thứ nhất hàm dưới bên phải"},{code:"RVV_45",name:"Răng hàm nhỏ thứ hai hàm dưới bên phải"},{code:"RVV_46",name:"Răng hàm lớn thứ nhất hàm dưới bên phải"},{code:"RVV_47",name:"Răng hàm lớn thứ hai hàm dưới bên phải"},{code:"RVV_48",name:"Răng khôn hàm dưới bên phải"},];
    $scope.definedRS = [];
    $scope.definedRS.push('Không nhớ');
    $scope.definedRS.push("Dưới 6 tháng");
    for(var i=6 ; i <=36 ; i++){
        $scope.definedRS.push(i + " Tháng");
    }
    $scope.definedRS.push('Trên 36 tháng');
    
    $scope.definedRSRmove = [];
    $scope.definedRSRmove.push('Không nhớ');
    $scope.definedRSRmove.push("Dưới 6 Tuổi");
    for(var i=6 ; i <=13 ; i++){
        $scope.definedRSRmove.push(i + " Tuổi");
    }
    $scope.definedRSRmove.push('Trên 13 Tuổi');
    
    $scope.definedRVV = [];
    $scope.definedRVV.push('Không nhớ');
    $scope.definedRVV.push("Dưới 6 tuổi");
    for(var i=6 ; i <=25 ; i++){
        $scope.definedRVV.push(i + " tuổi");
    }
    $scope.definedRVV.push("Trên 25 tuổi");
    
    
    
    $scope.me = me;
    $scope.onCreateNewProfile = false;
    $scope.ngTrueValue = true;
    $scope.ngFalseValue = false;
    $scope.isSendEmail = false;
    $scope.histories = histories;
    $scope.selectedHistoryTemplate = 'view.html';
    $scope.selectedHistory = {};
    $scope.onSumitEdit = false;
    $scope.editingTeeth = {};
    common = new Common();
    var historyId = common.getParameterByName('history');
    if(historyId != undefined && historyId != '')
    {
      for(var i=0;i<$scope.histories.length;i++){
          if($scope.histories[i].id == historyId){
              $scope.selectedHistory = $scope.histories[i];
              $scope.onSumitEdit = true;
              var timmerLoader = setInterval(function(){
                  if($('#collapse' + $scope.selectedHistory.id).length > 0){
                      $('#collapse' + $scope.selectedHistory.id).collapse();
                      clearInterval(timmerLoader);
                  }
              },100);
              
              break;
          }
      }
    }
    
    $scope.createNewProfile = {
        id:"",
        full_name:"",
        dob:"",
        examination_at:"",
        gender:"MALE",
        email:"",
        history:[
                    {code:"RVV_11", current:'', normal:"7-8 tuổi", comment:""}, 
                    {code:"RVV_12", current:'', normal:"8-9 tuổi", comment:""},  
                    {code:"RVV_13", current:'', normal:"11-13 tuổi", comment:""},  
                    {code:"RVV_14", current:'', normal:"10-11 tuổi", comment:""}, 
                    {code:"RVV_15", current:'', normal:"10-12 tuổi", comment:""}, 
                    {code:"RVV_16", current:'', normal:"6-7 tuổi", comment:""}, 
                    {code:"RVV_17", current:'', normal:"12-13 tuổi", comment:""}, 
                    {code:"RVV_18", current:'', normal:"17-21 tuổi", comment:""}, 
                    {code:'RVV_21', current:'', normal:"7-8 tuổi", comment:""}, 
                    {code:'RVV_22', current:'', normal:"8-9 tuổi", comment:""}, 
                    {code:'RVV_23', current:'', normal:"11-13 tuổi", comment:""}, 
                    {code:'RVV_24', current:'', normal:"10-11 tuổi", comment:""}, 
                    {code:'RVV_25', current:'', normal:"10-12 tuổi", comment:""}, 
                    {code:'RVV_26', current:'', normal:"6-7 tuổi", comment:""}, 
                    {code:'RVV_27', current:'', normal:"12-13 tuổi", comment:""}, 
                    {code:'RVV_28', current:'', normal:"17-21 tuổi", comment:""}, 
                    {code:"RVV_31", current:'', normal:"6-7 tuổi", comment:""}, 
                    {code:"RVV_32", current:'', normal:"7-8 tuổi", comment:""}, 
                    {code:"RVV_33", current:'', normal:"9-10 tuổi", comment:""}, 
                    {code:"RVV_34", current:'', normal:"10-12 tuổi", comment:""}, 
                    {code:"RVV_35", current:'', normal:"11-12 tuổi", comment:""}, 
                    {code:"RVV_36", current:'', normal:"6-7 tuổi", comment:""}, 
                    {code:"RVV_37", current:'', normal:"11-13 tuổi", comment:""}, 
                    {code:"RVV_38", current:'', normal:"18-25 tuổi", comment:""}, 
                    {code:"RVV_41", current:'', normal:"6-7 tuổi", comment:""}, 
                    {code:"RVV_42", current:'', normal:"7-8 tuổi", comment:""}, 
                    {code:"RVV_43", current:'', normal:"9-10 tuổi", comment:""}, 
                    {code:"RVV_44", current:'', normal:"10-12 tuổi", comment:""}, 
                    {code:"RVV_45", current:'', normal:"11-12 tuổi", comment:""}, 
                    {code:"RVV_46", current:'', normal:"6-7 tuổi", comment:""}, 
                    {code:"RVV_47", current:'', normal:"11-13 tuổi", comment:""}, 
                    {code:"RVV_48", current:'', normal:"18-25 tuổi", comment:""},
                    {code:"RS_71", current:'', normal:"6-7 tháng",rcurrent : "",remove:"6-7 tuổi", comment:""},
                    {code:"RS_81", current:'', normal:"6-7 tháng",rcurrent : "",remove:"6-7 tuổi", comment:""},
                    {code:"RS_61", current:'', normal:"8-12 tháng",rcurrent : "",remove:"7 tuổi", comment:""},
                    {code:"RS_51", current:'', normal:"8-12 tháng ",rcurrent : "" ,remove:"7 tuổi", comment:""},
                    {code:"RS_62", current:'', normal:"8-12 tháng",rcurrent : "",remove:"7-8 tuổi", comment:""},
                    {code:"RS_52", current:'', normal:"9-13 tháng",rcurrent : "",remove:"7-8 tuổi", comment:""},
                    {code:"RS_63", current:'', normal:"9-13 tháng",rcurrent : "",remove:"11-12 tuổi", comment:""},
                    {code:"RS_72", current:'', normal:"10-16 tháng",rcurrent : "",remove:"7-8 tuổi", comment:""},
                    {code:"RS_82", current:'', normal:"10-16 tháng",rcurrent : "",remove:"7-8 tuổi", comment:""},
                    {code:"RS_54", current:'', normal:"13-19 tháng",rcurrent : "",remove:"10 tuổi", comment:""},
                    {code:"RS_64", current:'', normal:"13-19 tháng",rcurrent : "",remove:"10 tuổi", comment:""},
                    {code:"RS_74", current:'', normal:"14-18 tháng",rcurrent : "",remove:"9-10 tuổi", comment:""},
                    {code:"RS_84", current:'', normal:"14-18 tháng",rcurrent : "",remove:"9-10 tuổi", comment:""},
                    {code:"RS_53", current:'', normal:"16-22 tháng ",rcurrent : "",remove:"11-12 tuổi", comment:""},
                    {code:"RS_73", current:'', normal:"17-23 tháng ",rcurrent : "",remove:"11-12 tuổi", comment:""},
                    {code:"RS_83", current:'', normal:"17-23 tháng ",rcurrent : "",remove:"11-12 tuổi", comment:"11-12 tuổi"},
                    {code:"RS_75", current:'', normal:"23-31 tháng ",rcurrent : "",remove:"10-11 tuổi", comment:""},
                    {code:"RS_55", current:'', normal:"25-33 tháng",rcurrent : "",remove:"10-12 tuổi", comment:""},
                    {code:"RS_65", current:'', normal:"25-33 tháng",rcurrent : "",remove:"10-12 tuổi", comment:"10-12 tuổi"},
                    {code:"RS_85", current:'', normal:"23-31 tháng ",rcurrent : "",remove:"10-11 tuổi", comment:""}
                ],
        ticket_response:""
    };
    
    $scope.selectedTeethCode = "";
    $scope.feedbackBehaviorLayerImage = ""; 
    $scope.teethMenPosition = [
        {code:"RVV_11", x:120, y:58}, {code:"RVV_12", x:97, y:69}, {code:"RVV_13", x:81, y:81},{code:"RVV_14", x:66, y:104},{code:"RVV_15", x:56, y:126},{code:"RVV_16", x:51, y:150},{code:"RVV_17", x:47, y:181},{code:"RVV_18", x:45, y:207},
        {code:'RVV_21', x:148, y:58}, {code:'RVV_22', x:171, y:66}, {code:'RVV_23', x:188, y:83}, {code:'RVV_24', x:203, y:102}, {code:'RVV_25', x:215, y:124}, {code:'RVV_26', x:221, y:153}, {code:'RVV_27', x:224, y:181}, {code:'RVV_28', x:226, y:206},
        {code:"RVV_31", x:147, y:398}, {code:"RVV_32", x:166, y:390}, {code:"RVV_33", x:183, y:380}, {code:"RVV_34", x:193, y:363}, {code:"RVV_35", x:206, y:345}, {code:"RVV_36", x:213, y:316}, {code:"RVV_37", x:222, y:287}, {code:"RVV_38", x:221, y:259}, 
        {code:"RVV_41", x:124, y:396}, {code:"RVV_42", x:103, y:392}, {code:"RVV_43", x:88, y:381}, {code:"RVV_44", x:75, y:366}, {code:"RVV_45", x:61, y:342}, {code:"RVV_46", x:55, y:319}, {code:"RVV_47", x:47, y:287}, {code:"RVV_48", x:41, y:259}
    ];
    
    $scope.teethChildPosition = [
        {code:"RS_51", x:107, y:56}, {code:"RS_52", x:80, y:63}, {code:"RS_53", x:69, y:84}, {code:"RS_54", x:54, y:105}, {code:"RS_55", x:41, y:146}, 
        {code:"RS_61", x:130, y:60}, {code:"RS_62", x:152, y:66}, {code:"RS_63", x:166, y:83}, {code:"RS_64", x:180, y:106}, {code:"RS_65", x:195, y:144},
        {code:"RS_71", x:127, y:298}, {code:"RS_72", x:146, y:293}, {code:"RS_73", x:161, y:278}, {code:"RS_74", x:177, y:251}, {code:"RS_75", x:186, y:212},
        {code:"RS_81", x:107, y:298}, {code:"RS_82", x:88, y:292}, {code:"RS_83", x:74, y:277}, {code:"RS_84", x:57, y:249}, {code:"RS_85", x:46, y:213}
    ];
    
    $scope.getToothName = function(code){
        for(var i=0;i<$scope.toothDefined.length;i++){
            if($scope.toothDefined[i].code == code){
                return $scope.toothDefined[i];
            }
        }
    };
    
    
    $scope.selectedTeeth = function($event,collection, isEdit)
    {   
        $scope.isEdit = isEdit == undefined ? false : isEdit;
        $scope.selectedTeethCode = $scope.getSelectedTeethCodebyMousePosition($event.offsetX,$event.offsetY,collection);
        if($scope.selectedTeethCode.code == undefined){
            return;
        }
        var collection = [];
        collection = isEdit ? $scope.selectedHistory.history : $scope.createNewProfile.history;
        for(var i = 0;i < collection.length ; i++){
            if($scope.selectedTeethCode.code == collection[i].code){
                $scope.editingTeeth = collection[i];
                break;
            }   
        }
        
        $($event.currentTarget)
                .find('.feedback-behavior')
                .css('background-image', 'url(/schema/' + $scope.selectedTeethCode.code + '_clicked.png)');
        
        
        $scope.showDetailDialog( isEdit ? $scope.selectedHistory : $scope.createNewProfile, isEdit);
    };
    $scope.setTootipOnMouseMove = function($event,collection){
        var code = $scope.getSelectedTeethCodebyMousePosition($event.offsetX,$event.offsetY,collection);
        //$scope.selectedTeethCode = code;
        if(code == false) return;
        $($event.currentTarget).attr('title',$scope.getToothName(code.code).name);
    };
    
    $scope.selectedDetailTeeth = function($event,collection)
    {
        $code =  $scope.getSelectedTeethCodebyMousePosition($event.offsetX,$event.offsetY,collection);
        $scope.selectedTeethCode = $code;
        if($code ==  false){
            $scope.selectedTeethCode = {};
            return;
        }
        if($scope.selectedTeethCode.code == undefined){
            return;
        }
        $(".profile-detail-show-tooltip").css('margin-left', $event.offsetX);
        $(".profile-detail-show-tooltip").css('margin-top', $event.offsetY);
    };
    
    $scope.getSelectedTeethCodebyMousePosition = function(x,y,collection){
        for(var i = 0; i < collection.length ; i++)
        {
            var indexTeeth = collection[i];
            var topRange = indexTeeth.x + 10;
            var bottomRange = indexTeeth.x - 10;
            var ritghRange = indexTeeth.y + 10;
            var leftRange = indexTeeth.y - 10;
            if(x <= topRange && x >= bottomRange && y > leftRange && y < ritghRange ){
                //$scope.selectedTeethCode = indexTeeth;
                return indexTeeth;
            }
        }  
        return false;
    };
    
    $scope.getSelectedTeethName = function(){
        if($scope.selectedTeethCode.code == undefined){
            return '';
        }
        var name = $scope.selectedTeethCode.code;
        return $scope.getToothName(name).name;
    };
    
    $scope.showCreateFrm = function(){
        $scope.onCreateNewProfile = !$scope.onCreateNewProfile;
        if($scope.selectedHistory.id != undefined)
        {
            $('#collapse'+$scope.selectedHistory.id).collapse('hide');
        }
        $scope.selectedHistory = {};
        $scope.onSumitEdit = false;
    };
    
    $scope.showDetailDialog = function(collection,isEdit){
        $(isEdit ? "#profile-detail-modal-edit-"+$scope.selectedHistory.id : "#profile-detail-modal" ).modal();
        
    };
    
    $scope.mergeDetail = function(isEdit){
        isEdit = isEdit === undefined ?  false : true;
        $(isEdit ? "#profile-detail-modal-edit-"+$scope.selectedHistory.id : "#profile-detail-modal" ).modal('hide');
    };
    
    
    
    
    $scope.checkTeethHaveProblems = function(arrayDetails){
        for(var i=0;i< arrayDetails.length; i++){
            if(arrayDetails[i].selected == true || arrayDetails[i].selected == 'true'){
               return true;
            }  
        }
        return false;
    };
    
    $scope.submit = function(isSend){
        
        $('input[name=send]').val(isSend);
        $scope.frm = $("#profile-frm").validate();
        if($scope.frm.errorList.length == 0){
            $("#profile-frm").submit();
        }
    };
    $scope.save = function(isEdit){
       $scope.submit(false);
    };
    
    $scope.saveAndSend = function(isEdit){
        $scope.submit(true);
    };
    
    $scope.getPostData = function(){
        return JSON.stringify($scope.onSumitEdit ? $scope.selectedHistory : $scope.createNewProfile);
    };
    $scope.getPostDataForSupport = function(){
        return JSON.stringify($scope.selectedHistory);
    };
    
    $scope.getSupportFrmData = function(){
        return JSON.stringify($scope.selectedHistory.ticket_response);
    };
    
    $scope.changeSelectedProfile = function(history){
        $scope.selectedHistory = history;
        if($scope.onCreateNewProfile) $scope.onCreateNewProfile = false;
        $scope.selectedHistoryTemplate = 'view.html';
        $scope.onSumitEdit = true;
       
    };
    $scope.enableEditProfile = function(){
        $scope.selectedHistoryTemplate = 'edit.html';
    };
    $scope.sendSupport = function(){
        $('#profile-support-frm').submit();
    };
    
    $scope.commitSupportResponse = function(){
      var currentAction = $('#profile-support-response-frm').attr('action');
      $('#profile-support-response-frm').attr('action',currentAction +"?history="+ $scope.selectedHistory.id);
      $('#profile-support-response-frm').submit();
    };
    
    $scope.getDisplayTimelineTableData = function(collection,prefix){
        var ar = [];
        if(collection == undefined){
            return ar;
        }
        for(var i=0;i < collection.length; i++){
            if(collection[i].code.indexOf(prefix) != -1 && collection[i].current != 0){
                ar.push(collection[i]);
            }
        } 
        ar.sort(function(a, b){return a.current - b.current;});
        return ar;
    };
    
    $scope.cloneDetails = function(orgin){
        var target = [];
        for(var i = 0; i < orgin.length; i ++)
        {            
            target.push({});
            jQuery.extend(target[target.length-1],orgin[i]);
        }  
        return target;
    };
    
    
    $scope.debug = function(){
      var i = $scope;   
    };
    
    
}
TeethGrowController.$inject = ['$scope','$http'];