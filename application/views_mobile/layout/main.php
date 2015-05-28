<!DOCTYPE html>
<html ng-app="lynx">
<head>
<meta name="viewport" content="width=640, user-scalable=true, initial-scale=0.5" />
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<title>DENTO | <?php echo $view->title;?></title>
<link rel="shortcut icon" href="/img/dento_icon_fw.ico" />
<link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="/css/ng-tags-input.min.css" rel="stylesheet" />
<link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<link href="/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<link href="/css/autocomplete/angucomplete.css" rel="stylesheet" type="text/css" />
<link href="/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<link href="/css/dento-main.css" rel="stylesheet" type="text/css" />
<link href="/css/dento-main-detail.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="/js/plugins/datepicker/css/datepicker.css" media="all">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script type="text/javascript" src="/js/detect_screen.js" charset="utf-8"></script>
<link type="text/css" href="/dento-chat/cometchatcss.php" rel="stylesheet">
<script type="text/javascript" src="/dento-chat/cometchatjs.php" charset="utf-8"></script>
<script src="/js/plugins/datepicker/js/bootstrap-datepicker.js"></script>
</head>
<body class="skin-blue" style="min-width: 640px">
    <?php $supporter = get_instance ()->getRootUser (); ?>
	<script type="text/javascript">
	   var me =  <?php echo json_encode(Common::getCurrentUser());?>;
    </script>
    <div id="header-container" class="header col-xs-12 text-center">
        <a class="mn-btn" href="#"></a> <a class="logo" href="/home"><img src="/img/Logo-home.png" /></a> <a class="search-btn" href="/search"></a>
    </div>
	<?php require_once APPPATH .VIEW_PATH.'/main_menu.php';?>
    <?php require_once APPPATH .VIEW_PATH. $view->view . '.php'; ?>
    <div class="footer">
        <div class="footer-container width-960">
            <ul class="static-col">
                <li>THÔNG TIN LIÊN HỆ
                    <div style="position: absolute; margin-top: -35px; margin-left: 348px;">
                        <a class="btn btn-primary" style="color: white; font-size: 30px" onclick="window.open('/send_mail','Gửi liên hệ','toolbar=1,location=1,directories=0,status=0,menubar=1,scrollbars=1,resizable=1,copyhistory=0,width=550,height=650')">
                        	<i style="color: white;" class="fa fa-envelope"></i>
                        		<span style="color: white;margin-left:5px; margin-right:5px">|</span> 
                        	<span style="color: white;">Contact us!</span>
                        	</a>
                    </div>
                    <ul>
                        <li><a><img src="/img/footer-icon-phone.fw.png" /> Hotline: 0933.22.8001</a></li>
                        <li><a><img src="/img/footer-icon-mail.fw.png" style="vertical-align: middle;" /> Email: admin@dento.vn</a></li>
                        <li><a><img src="/img/footer-icon-home.fw.png" /> Địa chỉ: Số 6, ngõ 6, tổ 6, tập thể Nhà máy In Quân Đội, Cầu Diễn, Bắc Từ Liêm, Hà Nội</a></li>
                    </ul>
                </li>
                <li class="static-col">
                        Bản đồ <a href="https://www.google.fr/maps/place/21%C2%B002'41.4%22N+105%C2%B045'27.6%22E/@21.044829,105.757673,17z/data=!3m1!4b1!4m2!3m1!1s0x0:0x0" style="text-transform: lowercase;text-decoration: underline;">(Mở bản đồ lớn)<a/>
                        <?php $countResult = get_instance()->getSysUserInformation()?>
                     <ul>
                        <li style="display: inline-block; height: 350px;">
                            <div id="dento-map" style="border: 0; width: 633px; height: 360px; margin-left: -22px; position: absolute;"></div>
                        </li>
                        <li><a>Số lượng thành viên: <?php echo $countResult->usersCount; ?></a></li>
                        <li><a>Số người đang truy cập: <?php echo $countResult->onlineCount; ?></a></li>
                        <li><a>Số lượt truy cập: <?php echo $countResult->sessionCount; ?></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
	<?php include_once APPPATH.VIEW_PATH.'/chat_dialog.php';?>
	<div id="overlap" style="display: none; background: rgba(0, 0, 0, 0.5) url(); position: fixed; top: 0px; left: 0px; width: 100%; height: 100%; z-index: 9999">
        <div class="progress progress-striped active" style="height: 5px">
            <div style="width: 100%;" class="bar"></div>
        </div>
    </div>
    <script type="text/javascript">
          $(document).bind("ajaxSend", function(){
    	     $("#overlap").show();
    	  }).bind("ajaxComplete", function(){
    		 $("#overlap").hide();
    	  });
    </script>
    <script src="/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="/js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="/js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
    <script src="/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <script src="/js/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
    <script src="/js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <script src="/js/plugins/DataTables-1.10.0/media/js/jquery.dataTables.min.js"></script>
    <script src="/js/plugins/DataTables-1.10.0/media/js/custom.dataTables.js"></script>
    <script src="/js/plugins/gritter/js/jquery.gritter.min.js"></script>
    <script src="/js/plugins/validation/jquery.validate.min.js"></script>
    <script src="/js/plugins/config-plugins.js"></script>
    <script src="/js/plugins/validation/additional-methods.min.js"></script>
    <script src="/js/AdminLTE/app.js" type="text/javascript"></script>
    <script src="/js/angular/angular.min.js" type="text/javascript"></script>
    <script src="/js/angular/angular-cookies.js" type="text/javascript"></script>
    <script src="/js/angular/ng-tags-input.min.js" type="text/javascript"></script>
    <script src="/js/angular/angular-route.min.js" type="text/javascript"></script>
    <script src="/js/angular/filters.js" type="text/javascript"></script>
    <script src="/js/angular/ng-grid.min.js" type="text/javascript"></script>
    <script src="/js/angular/ui-bootstrap-tpls-0.10.0.min.js" type="text/javascript"></script>
	<script src="/js/plugins/autocomplete/angucomplete.js" type="text/javascript"></script>
    <script src="/js/controllers/lynx-app.js" type="text/javascript"></script>
    <script src="/js/controllers/LynxCommon.js" type="text/javascript"></script>
    <script src="/js/controllers/LoginController.js" type="text/javascript"></script>
    <script src="/js/controllers/SearchPopController.js" type="text/javascript"></script>
    <script src="/js/controllers/ChatController.js" type="text/javascript"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
	<?php foreach ( $view->javascript as $jsItem ) {echo '<script src="' . $jsItem . '"></script>';}?>
	<script type="text/javascript">
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '<?php echo get_instance()->config->item('facebook_app_id'); ?>',
          xfbml      : true,
          version    : 'v2.0'
        });
      };
    
      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
     </script>
    <script type="text/javascript">
    	var map;
    	function initialize() {
    	  var pos = new google.maps.LatLng(21.044829, 105.757673);
    	  var mapOptions = {
    	    zoom: 17,
    	    center: pos
    	  };
    	  
    	  map = new google.maps.Map(document.getElementById('dento-map'), mapOptions);
    	  var marker = new google.maps.Marker({
              position: pos,
              title: 'Your Location',
              map: map
            });
    	}
    
    	google.maps.event.addDomListener(window, 'load', initialize);
	</script>
    <script type="text/javascript">
            $(document).ready(function(){

                $("[data-mask]").inputmask();

                });
     
            $(document).ready(function(){
                jQuery.validator.addMethod("validate-text-only", function(value, element) {
                    return this.optional(element) || /^[a-zA-Z0-9\ \'\"\?\!\(\)\[\]\:\à\á\ạ\ả\ã\â\ầ\ấ\ậ\ẩ\ẫ\ă\ằ\ắ\ặ\ẳ\ẵ\è\é\ẹ\ẻ\ẽ\ê\ề\ế\ệ\ể\ễ\ì\í\ị\ỉ\ĩ\ò\ó\ọ\ỏ\õ\ô\ồ\ố\ộ\ổ\ỗ\ơ\ờ\ớ\ợ\ở\ỡ\ù\ú\ụ\ủ\ũ\ư\ừ\ứ\ự\ử\ữ\ỳ\ý\ỵ\ỷ\ỹ\đ\À\Á\Ạ\Ả\Ã\Â\Ầ\Ấ\Ậ\Ẩ\Ẫ\Ă\Ằ\Ắ\Ặ\Ẳ\Ẵ\È\É\Ẹ\Ẻ\Ẽ\Ê\Ề\Ế\Ệ\Ể\Ễ\Ì\Í\Ị\Ỉ\Ĩ\Ò\Ó\Ọ\Ỏ\Õ\Ô\Ồ\Ố\Ộ\Ổ\Ỗ\Ơ\Ờ\Ớ\Ợ\Ở\Ỡ\Ù\Ú\Ụ\Ủ\Ũ\Ư\Ừ\Ứ\Ự\Ử\Ữ\Ỳ\Ý\Ỵ\Ỷ\Ỹ\Đ]+$/i.test(value);
                  }, "Trường không thể chứa ký tự đặc biệt"); 
                jQuery.validator.addMethod("validate-date-vn", function(value, element) {
                    return this.optional(element) || /^[0-9]+\/[0-9]+\/[0-9]+$/i.test(value);
                }, "Ngày chưa đúng định dạng"); 
                $(function() {
                    $('[data-type=submit]').click(function() {
                        var $this = $(this);
                        var $form = $this.parents('form:first');
                        if ($this.attr('data-action') != '') {
                            $form.attr('action', $this.attr('data-action'));
                        }
                        $form.validate({
                            submitHandler: function(form) {
                                $(form).submit();
                                return;
                              }
                        });
                    });
                    $('[data-type=reset]').click(function() {
                        var $this = $(this);
                        var $form = $this.parents('form:first');
                        $form[0].reset();
                    });
                });

            });
        </script>
<script type="text/javascript">
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-62181160-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>
