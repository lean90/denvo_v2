function TimelineRSController($scope,$http){
    $scope.datasource = [
                  {index:0,x:0,y:0,lable:"Sơ sinh",ntooth:["Chưa mọc chiếc răng nào"],tooth:[]},
                  {index:1,x:76,y:192,lable:"6-10 Tháng",ntooth:[],tooth:['2 Răng cửa giữa sữa hàm dưới 2 bên']},
                  {index:2,x:102,y:255,lable:"8-12 Tháng",ntooth:[],tooth:['2 Răng cửa giữa sữa hàm trên 2 bên']},
                  {index:3,x:126,y:320,lable:"9-13 Tháng",ntooth:[],tooth:['2 Răng cửa bên sữa hàm trên 2 bên']},
                  {index:4,x:151,y:382,lable:"10-16 Tháng",ntooth:[],tooth:['2 Răng cửa bên sữa hàm dưới 2 bên']},
                  {index:5,x:201,y:510,lable:"13-19 Tháng",ntooth:[],tooth:['2 Răng hàm sữa thứ nhất hàm trên 2 bên']},
                  {index:6,x:226,y:574,lable:"14-18 Tháng",ntooth:[],tooth:['2 Răng hàm sữa thứ nhất hàm dưới 2 bên']},
                  {index:7,x:277,y:701,lable:"16-22 Tháng",ntooth:[],tooth:['2 Răng nanh sữa hàm trên 2 bên']},
                  {index:8,x:302,y:763,lable:"17-23 Tháng",ntooth:[],tooth:['2 Răng nanh sữa hàm dưới 2 bên']},
                  {index:9,x:377,y:955,lable:"23-31 Tháng",ntooth:[],tooth:['2 Răng hàm sữa thứ 2 hàm dưới 2 bên']},
                  {index:10,x:427,y:1082,lable:"25-33 Tháng",ntooth:[],tooth:['2 Răng hàm sữa thứ 2 hàm trên 2 bên']},
                  {index:11,x:500,y:1271,lable:"    3 tuổi",ntooth:["Mọc đầy đủ răng sữa"],tooth:[]}
             ];
    $scope.autoSetUp = function(){
        for(var i = 0;i<$scope.datasource.length ; i++)
        {
            
        }
    };
    $scope.getTooltip = function(item){
        text = '';
        for(var i=0;i<item.tooth.length;i++)
        {
            text += (item.tooth.length - 1 != i) ? item.tooth + " ," : item.tooth;
        }
        return text;
    };
    
    $scope.showDialog = function(item){
        $scope.selectedNote = item;
        $('#detail-dialog').modal('show');
    };
}
TimelineRSController.$inject = ['$scope','$http'];