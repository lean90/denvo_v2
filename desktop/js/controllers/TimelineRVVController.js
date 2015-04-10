function TimelineRVVController($scope,$http, $sce){
    $scope.datasource = [
                {index:0,x:-14,y:-9,lable:"6 Tuổi",tooth:['2 Răng hàm lớn thứ nhất hàm trên 2 bên','2 Răng hàm lớn thứ nhất hàm dưới 2 bên'],rtooth:['2 Răng cửa giữa sữa hàm dưới 2 bên'],ntooth:[]},
                {index:1,x:8,y:40,lable:"6-7 Tuổi",tooth:['2 Răng cửa giữa hàm dưới 2 bên'],rtooth:['2 Răng cửa giữa sữa hàm trên 2 bên'],ntooth:[]},
                {index:2,x:29,y:89,lable:"7-8 Tuổi",tooth:['2 Răng cửa giữa hàm trên 2 bên','2 Răng cửa bên hàm dưới 2 bên'],rtooth:['2 Răng cửa bên sữa hàm trên 2 bên'],ntooth:[]},
                {index:3,x:73,y:186,lable:"8-9 Tuổi",tooth:['2 Răng cửa bên hàm trên 2 bên'],rtooth:[],ntooth:[]},
                {index:4,x:116,y:284,lable:"9 Tuổi",tooth:[],rtooth:['2 Răng nanh sữa hàm dưới 2 bên'],ntooth:[]},
                {index:5,x:138,y:333,lable:"9-10 Tuổi",tooth:['2 Răng nanh hàm dưới 2 bên'],rtooth:['2 Răng hàm sữa thứ nhất hàm dưới 2 bên'],ntooth:[]},
                {index:6,x:159,y:381,lable:"10 Tuổi",tooth:[],rtooth:['2 Răng hàm sữa thứ nhất hàm trên 2 bên'],ntooth:[]},
                {index:7,x:174,y:414,lable:"10-11 Tuổi",tooth:['2 Răng hàm nhỏ thứ nhất hàm trên 2 bên '],rtooth:['2 Răng hàm sữa thứ hai hàm trên 2 bên'],ntooth:[]},
                {index:8,x:188,y:446,lable:"10-12 Tuổi",tooth:['2 Răng hàm nhỏ thứ hai hàm trên 2 bên','2 Răng hàm nhỏ thứ nhất hàm dưới 2 bên'],rtooth:['2 Răng hàm sữa thứ hai hàm dưới 2 bên'],ntooth:[]},
                {index:9,x:203,y:479,lable:"11-12 Tuổi",tooth:['2 Răng hàm nhỏ thứ hai hàm dưới 2 bên'],rtooth:['2 Răng nanh sữa hàm trên 2 bên'],ntooth:[]},
                {index:10,x:225,y:528,lable:"11-13 Tuổi",tooth:['2 Răng nanh hàm trên 2 bên','2 Răng hàm lớn thứ hai hàm dưới 2 bên'],rtooth:[],ntooth:[]},
                {index:11,x:246,y:576,lable:"12-13 Tuổi",tooth:['2 Răng hàm lớn thứ hai hàm trên 2 bên'],rtooth:[],ntooth:[]},
                {index:12,x:333,y:771,lable:"17-21 Tuổi",tooth:['2 Răng số 8 hàm trên 2 bên (răng khôn)'],rtooth:[],ntooth:[]},
                {index:13,x:376,y:869,lable:"18-25 tuổi",tooth:['2 Răng số 8 hàm dưới 2 bên (răng khôn) <br/> P/S: Thường mọc lệch, gây biến chứng, thường phải nhổ'],rtooth:[],ntooth:[]},
                {index:14,x:505,y:1161,lable:"25 tuổi",tooth:[],rtooth:[],ntooth:["Mọc đầy đủ răng vĩnh viễn"]},
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