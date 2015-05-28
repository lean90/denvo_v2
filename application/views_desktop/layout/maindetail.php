<!DOCTYPE html>
<html ng-app="lynx">
<head>
<meta charset="UTF-8">
<title>DENTO | <?php echo $view->title;?></title>
<meta content='width=960px, initial-scale=1, maximum-scale=1' name='viewport'>
<link rel="shortcut icon" href="/img/dento_icon_fw.ico" />
<link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="/css/ng-tags-input.min.css" rel="stylesheet" />
<link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<link href="/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<link href="/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<link href="/css/autocomplete/angucomplete.css" rel="stylesheet" type="text/css" />
<link href="/css/dento-main.css" rel="stylesheet" type="text/css" />
<link href="/css/dento-main-detail.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<link type="text/css" href="/dento-chat/cometchatcss.php" rel="stylesheet" charset="utf-8">
<script type="text/javascript" src="/dento-chat/cometchatjs.php" charset="utf-8"></script>
</head>
<body class="skin-blue">
<?php $supporter = get_instance ()->getRootUser (); ?>
<script type="text/javascript">
     var me =  <?php echo json_encode(Common::getCurrentUser());?>;
</script>
	<div class="header col-xs-12 text-center">
		<div class="header-container width-960">
			<a href="/" class="logo"><img src="/img/Logo-detail.fw.png" /></a>
			<div class="head-tool text-right">
				<div class="header-action">
					<span id="login-btn" class="btn">
					<?php 
    					if(!Common::getCurrentUser ()->is_authorized){
    						echo "Đăng nhập";
    					}else{
    					   $arrFullnames = explode(" ",rtrim(Common::getCurrentUser()->full_name," "));
    					   echo "Chào, {$arrFullnames[count($arrFullnames) - 1]}";
    					}
                      ?>
					 &nbsp; 
					<i class="fa fa-caret-down"></i>
					
					</span>
                        <?php
                        if (Common::getCurrentUser ()->is_authorized) {
                            include APPPATH .VIEW_PATH. '/pop_loggedin.php';
                        } else {
                            include APPPATH .VIEW_PATH. '/pop_login.php';
                        }
                        ?>
                </div>
				<div class="header-search">
                    <?php
                    include APPPATH .VIEW_PATH. '/search_pop.php';
                    ?>
                    <span id="search-pop-btn" class="btn"> <img
						src="/img/btn-search.fw.png" />
					</span>
				</div>
			</div>
		</div>
		<?php 
		  $__controller__ = get_instance();
		  $__controller__ instanceof  BaseController;
		  $__newStatus__ = $__controller__->getNewMenuStatus();
		?>
		<div class="menu-conatiner width-960">
			<ul class="cursor-pointer">
				<li class="child-home text-left" style=""><a href="/home"><img
						src="/img/home.fw.png" /></a></li>
				<li>
				    <ul class="child text-left">
				        <li><a href="/gioi-thieu/ve-chung-toi-43.html">Về chúng tôi</a></li>
				        <li><a href="/gioi-thieu/dieu-khoan-su-dung-200.html">Điều khoản sử dụng</a></li>
				    </ul>
				    <a href="/gioi-thieu/ve-chung-toi-43.html">Giới thiệu</a>
				</li>
				<li>
					<ul class="child text-left">
					   <li class="topMenu-newItem" style="display:<?php echo $__newStatus__->tintuc == false ? "none" : "block;"?>">
                            <div>
                                <p class="newItem-head"><img src="/img/menu-icon-new-top.png"/> Tin Mới</p>
                                <ul class="menu-newlist">
                                    <?php foreach ($__newStatus__->datasource as $item){
                                        if($item->item_type != 'tintuc'){ continue;}
                                        ?>
                                        <li>
                                            <a href="<?php echo $item->part_url.'-'.$item->id.'.html';?>">
                                                <p class="new-title"><?php echo $item->title;?></p>
                                                <p class="new-content"><?php echo mb_substr($item->description, 0,75)."...";?></p>
                                            </a>
                                        </li>
                                    <?php }?>
                                    
                                </ul>
                            </div>
					   </li>
                        <?php
                        $cateRepository = new CategoryRepository ();
                        $cateRepository->category_id = 1; // part: /tin-tuc
                        $results = $cateRepository->getMutilCondition ( T_category::order, "ASC" );
                        foreach ( $results as $result ) {
                            ?>
                            <li><a href='<?php echo $result->part_url;?>'><?php echo $result->name?></a>
                                <?php 
                                $cateRepository2 = new CategoryRepository ();
                                $cateRepository2->category_id = $result->id;
                                $resultsLv2 = $cateRepository2->getMutilCondition ( T_category::order, "ASC" );
                                if(count($resultsLv2) > 0){
                                    echo "<ul>";
                                    foreach ($resultsLv2 as $itemLv2){?>
                                        <li><a href='<?php echo $itemLv2->part_url;?>'><?php echo $itemLv2->name?></a></li>
                                    <?php }
                                    echo "</ul>";
                                }?>
                            </li>
                            <?php 
                        }
                        ?>
                    </ul> 
                    <a href="/tin-tuc">Tin tức
                        <?php if($__newStatus__->tintuc){?>
                            <img alt="" src="/img/menu-new-icon.png">
                        <?php }?>
                    </a>
				</li>
				<li>
					<ul class="child text-left">
					   <li class="topMenu-newItem" style="display:<?php echo $__newStatus__->sanpham == false ? "none" : "block;"?>">
                            <div>
                                <p class="newItem-head"><img src="/img/menu-icon-new-top.png"/> Tin Mới</p>
                                <ul class="menu-newlist">
                                    <?php foreach ($__newStatus__->datasource as $item){
                                        if($item->item_type != 'sanpham'){ continue;}
                                        ?>
                                        <li>
                                            <a href="<?php echo $item->part_url.'-'.$item->id.'.html';?>">
                                                <p class="new-title"><?php echo $item->title;?></p>
                                                <p class="new-content"><?php echo mb_substr($item->description, 0,75)."...";?></p>
                                            </a>
                                        </li>
                                    <?php }?>
                                    
                                </ul>
                            </div>
					   </li>
                        <?php
                        $cateRepository = new CategoryRepository ();
                        $cateRepository->category_id = 12; // part: /san-pham
                        $results = $cateRepository->getMutilCondition ( T_category::order, "ASC" );
                        foreach ( $results as $result ) {
                            echo "<li><a href='{$result->part_url}'>{$result->name}</a></li>";
                        }
                        ?>
                    </ul>
                    <a href="/san-pham">Sản phẩm
                        <?php if($__newStatus__->sanpham){?>
                            <img alt="" src="/img/menu-new-icon.png">
                        <?php }?>
                    </a>
				</li>
				<li>
					<ul class="child text-left">
					   <li class="topMenu-newItem" style="display:<?php echo $__newStatus__->trochoi == false ? "none" : "block;"?>">
                            <div>
                                <p class="newItem-head"><img src="/img/menu-icon-new-top.png"/> Tin Mới</p>
                                <ul class="menu-newlist">
                                    <?php foreach ($__newStatus__->datasource as $item){
                                        if($item->item_type != 'trochoi'){ continue;}
                                        ?>
                                        <li>
                                            <a href="<?php echo $item->part_url.'-'.$item->id.'.html';?>">
                                                <p class="new-title"><?php echo $item->title;?></p>
                                                <p class="new-content"><?php echo mb_substr($item->description, 0,75)."...";?></p>
                                            </a>
                                        </li>
                                    <?php }?>
                                    
                                </ul>
                            </div>
					   </li>
                        <?php
                        $cateRepository = new CategoryRepository ();
                        $cateRepository->category_id = 32; // part: /tro-choi
                        $results = $cateRepository->getMutilCondition ( T_category::order, "ASC" );
                        foreach ( $results as $result ) {
                            echo "<li><a href='{$result->part_url}'>{$result->name}</a></li>";
                        }
                        ?>
                    </ul> <a href="/tro-choi">Trò chơi
                        <?php if($__newStatus__->trochoi){?>
                            <img alt="" src="/img/menu-new-icon.png">
                        <?php }?>
                    </a>
				</li>
				<li>
					<ul class="child text-left">
					   <li class="topMenu-newItem" style="display:<?php echo $__newStatus__->kythuat == false ? "none" : "block;"?>">
                            <div>
                                <p class="newItem-head"><img src="/img/menu-icon-new-top.png"/> Tin Mới</p>
                                <ul class="menu-newlist">
                                    <?php foreach ($__newStatus__->datasource as $item){
                                        if($item->item_type != 'kythuat'){ continue;}
                                        ?>
                                        <li>
                                            <a href="<?php echo $item->part_url.'-'.$item->id.'.html';?>">
                                                <p class="new-title"><?php echo $item->title;?></p>
                                                <p class="new-content"><?php echo mb_substr($item->description, 0,75)."...";?></p>
                                            </a>
                                        </li>
                                    <?php }?>
                                    
                                </ul>
                            </div>
					   </li>
                        <?php
                        $cateRepository = new CategoryRepository ();
                        $cateRepository->category_id = 20; // part: /cac-ky-thuat
                        $results = $cateRepository->getMutilCondition ( T_category::order, "ASC" );
                        foreach ( $results as $result ) {
                            echo "<li><a href='{$result->part_url}'>{$result->name}</a></li>";
                        }
                        ?>
                    </ul> <a href="/ky-thuat"> Kỹ thuật 
                        <?php if($__newStatus__->kythuat){?>
                            <img alt="" src="/img/menu-new-icon.png">
                        <?php }?>
                    </a>
				</li>
				<li>
					<ul class="child text-left">
                        <?php
                        $user = Common::getCurrentUser ();
                        if ($user->is_authorized) {
                            echo "
                                <li><a href='/timeline/rang-sua'>Tuổi mọc răng sữa</a></li>
                                <li><a href='/timeline/rang-vinh-vien'>Tuổi mọc răng vĩnh viễn</a></li>
                                <li><a href='/profile/{$user->id}/tuoi-moc-rang'>Tuổi mọc răng của bạn</a></li>
                                <li><a href='/profile/{$user->id}/ho-so-rang-mieng'>Hồ sơ răng miệng cá nhân</a></li>
                                <li><a href='javascript:openChatDialog()'>Trợ giúp</a></li>
                                <li><a href='/ban-do'>&beta;Finder</a></li>
                                ";
                        } else {
                            echo "
                                <li><a href='/timeline/rang-sua'>Tuổi mọc răng sữa</a></li>
                                <li><a href='/timeline/rang-vinh-vien'>Tuổi mọc răng vĩnh viễn</a></li>
                                <li><a action='callLoginDialog' href='javascript:void(0)'>Tuổi mọc răng của bạn</a></li>
                                <li><a action='callLoginDialog' href='javascript:void(0)'>Hồ sơ răng miệng cá nhân</a></li>
                                <li><a href='javascript:openChatDialog()'>Trợ giúp</a></li>
								<li><a href='/ban-do'>&beta;Finder</a></li>
                                ";
                        }
                        ?>
					</ul> <a href="#">Tư vấn</a>
				</li>
			</ul>
		</div>
	</div>
    <?php require_once APPPATH .VIEW_PATH . $view->view . '.php'; ?>
<div class="footer">
		<div class="footer-container width-960">
			<ul class="dynamic-col">
			     <li>Giới thiệu
					<ul>
				       <li><a href="/gioi-thieu/ve-chung-toi-43.html">Về chúng tôi</a></li>
				       <li><a href="/gioi-thieu/dieu-khoan-su-dung-200.html">Điều khoản sử dụng</a></li>
                    </ul>
				</li>
				<li>Tin tức
					<ul>
                        <li><a href="/tin-tuc/kien-thuc-chung-ve-rang-mieng">Kiến thức về răng miệng</a></li>
                        <li><a href="/tin-tuc/benh-ly-chung-vung-rang-mieng">Bệnh lý răng miệng</a></li>
                        <li><a href="/tin-tuc/theo-doi-cham-soc-rang-mieng-theo-lua-tuoi">Theo dõi chăm sóc răng miệng theo <br/> lứa tuổi</a></li>
                        <li><a href="/tin-tuc/che-do-dinh-duong-ve-sinh-rang-mieng">Chế độ dinh dưỡng, vệ sinh răng miệng</a></li>
                        <li><a href="/tin-tuc/cap-nhat-ve-nha-khoa">Cập nhật về nha khoa</a></li>
                        <li><a href="/tin-tuc/video">Video</a></li>
                        <li><a href="/tin-tuc/tin-khac">Tin khác</a></li>                    
                    </ul>
				</li>
				<li>Kỹ thuật
					<ul>
                        <?php
                        $cateRepository = new CategoryRepository ();
                        $cateRepository->category_id = 20; // part: /tuyen-dung
                        $results = $cateRepository->getMutilCondition ( T_category::order, "ASC" );
                        foreach ( $results as $result ) {
                            echo "<li><a href='{$result->part_url}'>{$result->name}</a></li>";
                        }
                        ?>
                    </ul>
				</li>

			</ul>
			<ul class="dynamic-col">
				<li>Sản phẩm
					<ul>
                        <?php
                        $cateRepository = new CategoryRepository ();
                        $cateRepository->category_id = 12; // part: /san-pham
                        $results = $cateRepository->getMutilCondition ( T_category::order, "ASC" );
                        foreach ( $results as $result ) {
                            echo "<li><a href='{$result->part_url}'>{$result->name}</a></li>";
                        }
                        ?>
                    </ul>
				</li>
				<li>Trò chơi
					<ul>
                        <?php
                        $cateRepository = new CategoryRepository ();
                        $cateRepository->category_id = 32; // part: /tuyen-dung
                        $results = $cateRepository->getMutilCondition ( T_category::order, "ASC" );
                        foreach ( $results as $result ) {
                            echo "<li><a href='{$result->part_url}'>{$result->name}</a></li>";
                        }
                        ?>
                    </ul>
				</li>

				<li>Tuyển dụng
					<ul>
                        <?php
                        $cateRepository = new CategoryRepository ();
                        $cateRepository->category_id = 38; // part: /tuyen-dung
                        $results = $cateRepository->getMutilCondition ( T_category::order, "ASC" );
                        foreach ( $results as $result ) {
                            echo "<li><a href='{$result->part_url}'>{$result->name}</a></li>";
                        }
                        ?>
                    </ul>
				</li>
			</ul>
			<ul class="static-col">
				<li>THÔNG TIN LIÊN HỆ
					<ul>
						<li><a>Hotline: 0933.22.8001</a></li>
						<li><a>Email: admin@dento.vn</a></li>
						<li><a>Địa chỉ: Số 6, ngõ 6, tổ 6, <br/>tập thể Nhà máy In Quân Đội, Cầu Diễn,<br/> Bắc Từ Liêm, Hà Nội</a></li>
						<li><br /></li>
						<li><a class="btn btn-primary"
							style="color: white; font-size: 15px"
							onclick="window.open('/send_mail','Gửi liên hệ','toolbar=1,location=1,directories=0,status=0,menubar=1,scrollbars=1,resizable=1,copyhistory=0,width=550,height=650')"><i
								style="color: white; font-size: 20px" class="fa fa-envelope"></i>
								&nbsp; <span style="color: white; font-size: 20px">|</span>
								&nbsp; Contact us now!</a></li>
					</ul>
				</li>
				<li class="static-col">
                        Bản đồ <a href="https://www.google.fr/maps/place/21%C2%B002'41.4%22N+105%C2%B045'27.6%22E/@21.044829,105.757673,17z/data=!3m1!4b1!4m2!3m1!1s0x0:0x0" style="text-transform: lowercase;text-decoration: underline;">(Mở bản đồ lớn)<a/> 
                        <?php $countResult = get_instance()->getSysUserInformation()?>
                        <ul>
						<li>
						  <a><div id="dento-map" frameborder="0" style="border: 0;width:255px; height:210px"></div></a>
						</li>
						<li><a>Số lượng thành viên: <?php echo $countResult->usersCount; ?></a></li>
						<li><a>Số người đang truy cập: <?php echo $countResult->onlineCount; ?></a></li>
						<li><a>Số lượt truy cập: <?php echo $countResult->sessionCount; ?></a></li>
					</ul>
				</li>
			</ul>
			</ul>
		</div>
	</div>

	<a class="chat-btn" href="/danh-sach-cau-hoi"></a>
	<a class="map-btn" href="/ban-do"></a>
	<?php include_once APPPATH.VIEW_PATH. '/chat_dialog.php';?>
    <div id="fb-root"></div>
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
    <?php foreach ( $view->javascript as $jsItem ) { echo '<script src="' . $jsItem . '"></script>'; }?>
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
    	    zoom: 15,
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
        $('body').click(function(e){
            $(".dento-pop").hide();
        });

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
