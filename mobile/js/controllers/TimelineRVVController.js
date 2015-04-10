function TimelineRVVController($scope,$http, $sce){
    $scope.datasource = [
                {index:0,x:0,y:0,lable:"6 Tuổi",tooth:['2 Răng hàm lớn thứ nhất hàm trên 2 bên','2 Răng hàm lớn thứ nhất hàm dưới 2 bên'],rtooth:['2 Răng cửa giữa sữa hàm dưới 2 bên'],ntooth:[]},
                {index:1,x:29,y:72,lable:"6-7 Tuổi",tooth:['2 Răng cửa giữa hàm dưới 2 bên'],rtooth:['2 Răng cửa giữa sữa hàm trên 2 bên'],ntooth:[]},
                {index:2,x:58,y:143,lable:"7-8 Tuổi",tooth:['2 Răng cửa giữa hàm trên 2 bên','2 Răng cửa bên hàm dưới 2 bên'],rtooth:['2 Răng cửa bên sữa hàm trên 2 bên'],ntooth:[]},
                {index:3,x:84,y:213,lable:"8-9 Tuổi",tooth:['2 Răng cửa bên hàm trên 2 bên'],rtooth:[],ntooth:[]},
                {index:4,x:112,y:284,lable:"9 Tuổi",tooth:[],rtooth:['2 Răng nanh sữa hàm dưới 2 bên'],ntooth:[]},
                {index:5,x:140,y:354,lable:"9-10 Tuổi",tooth:['2 Răng nanh hàm dưới 2 bên'],rtooth:['2 Răng hàm sữa thứ nhất hàm dưới 2 bên'],ntooth:[]},
                {index:6,x:168,y:424,lable:"10 Tuổi",tooth:[],rtooth:['2 Răng hàm sữa thứ nhất hàm trên 2 bên'],ntooth:[]},
                {index:7,x:195,y:495,lable:"10-11 Tuổi",tooth:['2 Răng hàm nhỏ thứ nhất hàm trên 2 bên '],rtooth:['2 Răng hàm sữa thứ hai hàm trên 2 bên'],ntooth:[]},
                {index:8,x:223,y:566,lable:"10-12 Tuổi",tooth:['2 Răng hàm nhỏ thứ hai hàm trên 2 bên','2 Răng hàm nhỏ thứ nhất hàm dưới 2 bên'],rtooth:['2 Răng hàm sữa thứ hai hàm dưới 2 bên'],ntooth:[]},
                {index:9,x:252,y:637,lable:"11-12 Tuổi",tooth:['2 Răng hàm nhỏ thứ hai hàm dưới 2 bên'],rtooth:['2 Răng nanh sữa hàm trên 2 bên'],ntooth:[]},
                {index:10,x:279,y:707,lable:"11-13 Tuổi",tooth:['2 Răng nanh hàm trên 2 bên','2 Răng hàm lớn thứ hai hàm dưới 2 bên'],rtooth:[],ntooth:[]},
                {index:11,x:306,y:777,lable:"12-13 Tuổi",tooth:['2 Răng hàm lớn thứ hai hàm trên 2 bên'],rtooth:[],ntooth:[]},
                {index:12,x:390,y:990,lable:"17-21 Tuổi",tooth:['2 Răng số 8 hàm trên 2 bên (răng khôn)'],rtooth:[],ntooth:[]},
                {index:13,x:419,y:1061,lable:"18-25 Tuổi",tooth:['2 Răng số 8 hàm dưới 2 bên (răng khôn) <br/> P/S: Thường mọc lệch, gây biến chứng, thường phải nhổ'],rtooth:[],ntooth:[]},
                {index:14,x:502,y:1273,lable:"Sau 25 Tuổi",tooth:[],rtooth:[],ntooth:["Mọc đầy đủ răng vĩnh viễn"]},
             ];
    
    $scope.displayHtml = function(val){
        val = $sce.trustAsHtml(val);
        return val;
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
TimelineRVVController.$inject = ['$scope','$http','$sce'];