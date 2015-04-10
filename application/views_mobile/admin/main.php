
<section class="content-header">
	<h1>
		Dashboard <small>Control panel</small>
	</h1>
</section>

<!-- Main content -->
<section class="content">
	<div class="col-md-6">
		<div class="box box-danger">
			<div class="box-header">
				<i class="fa fa-warning"></i>
				<h3 class="box-title">Lưu lượng yêu cầu tư vấn trong 30 ngày</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div id="chart-support"
					style="height: 300px; padding: 0px; position: relative;"></div>
			</div>
			<!-- /.box-body -->
		</div>
	</div>
	<div class="col-md-6">
		<div class="box box-danger">
			<div class="box-header">
				<i class="fa fa-warning"></i>
				<h3 class="box-title">Lưu lượng bài viết tạo mới trong tháng</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div id="chart-post"
					style="height: 300px; padding: 0px; position: relative;"></div>
			</div>
			<!-- /.box-body -->
		</div>
	</div>
	<div class="col-md-12">
		<div class="box box-danger">
			<div class="box-header">
				<i class="fa fa-warning"></i>
				<h3 class="box-title">Lưu lượng người dùng trong tháng</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div id="chart-request"
					style="height: 500px; padding: 0px; position: relative;"></div>
			</div>
			<!-- /.box-body -->
		</div>
	</div>

</section>
<!-- /.content -->
<script src="/js/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="/js/plugins/flot/jquery.flot.resize.min.js"
	type="text/javascript"></script>
<script src="/js/plugins/flot/jquery.flot.pie.min.js"
	type="text/javascript"></script>
<script src="/js/plugins/flot/jquery.flot.categories.min.js"
	type="text/javascript"></script>
<script src="/js/plugins/flot/jquery.flot.time.min.js"
	type="text/javascript"></script>

<script type="text/javascript">
    var supportTicketByDate = <?php echo json_encode($supportTicketByDate) ?>;
    var supportTicketHaveSupportedByDate = <?php echo json_encode($supportTicketHaveSupportedByDate) ?>;
    var postAddedByDate = <?php echo json_encode($postAddedByDate) ?>;
    var sessionByDate = <?php echo json_encode($sessionByDate) ?>;
    
   /*
    * LINE CHART
    * ----------
    */
   //LINE randomly generated data
   var line_data1 = {
       data: supportTicketByDate,
       label:"Yêu cầu hỗ trợ",
       color: "#3c8dbc"
   };
   var line_data2 = {
       data: supportTicketHaveSupportedByDate,
       label:"Hỗ trợ được",
       color: "#00c0ef"
   };
   $.plot("#chart-support", [line_data1, line_data2], {
        grid: {
           hoverable: true,
           borderColor: "#f3f3f3",
           borderWidth: 1,
           tickColor: "#f3f3f3"
       },
       series: {
           shadowSize: 0,
           lines: {
               show: true
           },
           points: {
               show: true
           }
       },
       lines: {
           fill: false,
           color: ["#3c8dbc", "#f56954"]
       },
       yaxis: {
           show: true
       },
       xaxis: {
           show: true, mode: "time", timeformat: "%d/%m/%Y", minTickSize: [1, "day"]
       }
   });
   //Initialize tooltip on hover
   $("<div class='tooltip-inner' id='line-chart-tooltip'></div>").css({
       position: "absolute",
       display: "none",
       opacity: 0.8
   }).appendTo("body");
   $("#chart-support").bind("plothover", function(event, pos, item) {

       if (item) {
           var x = item.datapoint[0].toFixed(2),
                   y = item.datapoint[1].toFixed(2);
           var date = new Date(x * 1000);
           var month = date.getMonth() + 1;
           var time = date.getDate()+"/"+month+"/"+ date.getFullYear();
           $("#line-chart-tooltip").html(item.series.label + " " + time + " = " + y)
                   .css({top: item.pageY + 5, left: item.pageX + 5})
                   .fadeIn(200);
       } else {
           $("#line-chart-tooltip").hide();
       }

   });
   /* END LINE CHART */
   
   
   /*
    * LINE CHART POST
    * ----------
    */
   //LINE randomly generated data
   var line_post = {
       data: postAddedByDate,
       label:"Bài viết mới",
       color: "#3c8dbc"
   };
   $.plot("#chart-post", [line_post], {
        grid: {
           hoverable: true,
           borderColor: "#f3f3f3",
           borderWidth: 1,
           tickColor: "#f3f3f3"
       },
       series: {
           shadowSize: 0,
           lines: {
               show: true
           },
           points: {
               show: true
           }
       },
       lines: {
           fill: false,
           color: ["#3c8dbc", "#f56954"]
       },
       yaxis: {
           show: true
       },
       xaxis: {
           show: true, mode: "time", timeformat: "%d/%m/%Y", minTickSize: [1, "day"]
       }
   });
   //Initialize tooltip on hover
   $("<div class='tooltip-inner' id='line-chart-tooltip'></div>").css({
       position: "absolute",
       display: "none",
       opacity: 0.8
   }).appendTo("body");
   $("#chart-post").bind("plothover", function(event, pos, item) {

       if (item) {
           var x = item.datapoint[0].toFixed(2),
                   y = item.datapoint[1].toFixed(2);
           var date = new Date(x * 1000);
           var month = date.getMonth() + 1;
           var time = date.getDate()+"/"+month+"/"+ date.getFullYear();
           $("#line-chart-tooltip").html(item.series.label + " " + time + " = " + y)
                   .css({top: item.pageY + 5, left: item.pageX + 5})
                   .fadeIn(200);
       } else {
           $("#line-chart-tooltip").hide();
       }

   });
   /* END LINE CHART POST*/
   
   /*
    * LINE CHART REQUEST
    * ----------
    */
   //LINE randomly generated data
   var line_request = {
       data: sessionByDate,
       label:"Lưu lượng request trong tháng",
       color: "#3c8dbc"
   };
   $.plot("#chart-request", [line_request], {
        grid: {
           hoverable: true,
           borderColor: "#f3f3f3",
           borderWidth: 1,
           tickColor: "#f3f3f3"
       },
       series: {
           shadowSize: 0,
           lines: {
               show: true
           },
           points: {
               show: true
           }
       },
       lines: {
           fill: false,
           color: ["#3c8dbc", "#f56954"]
       },
       yaxis: {
           show: true
       },
       xaxis: {
           show: true, mode: "time", timeformat: "%d/%m/%Y", minTickSize: [1, "day"]
       }
   });
   //Initialize tooltip on hover
   $("<div class='tooltip-inner' id='line-chart-tooltip'></div>").css({
       position: "absolute",
       display: "none",
       opacity: 0.8
   }).appendTo("body");
   $("#chart-request").bind("plothover", function(event, pos, item) {

       if (item) {
           var x = item.datapoint[0].toFixed(2),
                   y = item.datapoint[1].toFixed(2);
           var date = new Date(x * 1000);
           var month = date.getMonth() + 1;
           var time = date.getDate()+"/"+month+"/"+ date.getFullYear();
           $("#line-chart-tooltip").html(item.series.label + " " + time + " = " + y)
                   .css({top: item.pageY + 5, left: item.pageX + 5})
                   .fadeIn(200);
       } else {
           $("#line-chart-tooltip").hide();
       }

   });
   /* END LINE CHART POST*/
</script>
