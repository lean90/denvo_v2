<?php 
		  $__controller__ = get_instance();
		  $__controller__ instanceof  BaseController;
		  $__newStatus__ = $__controller__->getNewMenuStatus();
		  $__categoryCollection__ = array();
		  foreach ($__newStatus__->datasource as $source){
		      $source instanceof PostRepository;
		      array_push($__categoryCollection__, $source->category_id);
		  }
?>
<div class="overlay-menu">
    <ul class="mobile-main-menu">
        <?php 
            $current_user = Common::getCurrentUser();
            if(empty($current_user->id)){
        ?>
             <li class="big-item">
             	<a href="/login?cp=<?php echo urlencode(Common::curPageURL());?>"> <img src="/img/mn-icon-login.png" /> ĐĂNG NHẬP</a>  
             </li>
        <?php }else{ ?>
             <li class="user-information-container">
                <a href="/profile/<?php echo $current_user->id;?>">
                    <div class="user-information">
                        <img src="<?php echo $current_user->avartar?>" class="avatar" />
                        <span><?php echo $current_user->full_name?></span>
                    </div>
                </a>
             </li>
             
        <?php } ?>
            <li class="big-item"><a href="/home"> <img src="/img/mn-icon-home.fw.png" /> TRANG CHỦ</a></li>
            <li class="big-item"><a href="#"> GIỚI THIỆU</a></li>
            <li><a href="/gioi-thieu/ve-chung-toi-43.html"> <img src="/img/mn-icon-about-us.png" /> <span> Về chúng tôi </span></a></li>
            <li><a href="/gioi-thieu/dieu-khoan-su-dung-200.html"> <img src="/img/mn-icon-temr-of-us.png" /> <span> Điều khoản sử dụng </span></a></li>
            <li class="big-item"><a href="/dento-chat"> <img src="/img/mn-icon-chat-with-us.fw.png" /> CHAT VỚI BẠN BÈ </a></li>
            <li class="big-item"><a href="/danh-sach-cau-hoi"> <img src="/img/mn-icon-question.png" /> HỎI ĐÁP</a></li>
            
            <li class="big-item"><a href="/tin-tuc">TIN TỨC</a></li>
            <li><a href="/tin-tuc/kien-thuc-chung-ve-rang-mieng"><img src="/img/mn-icon-kien-thuc-ve-rang-mieng.fw.png" /><span>Kiến thức về răng miệng <?php if(in_array(2,$__categoryCollection__)) echo '<img src="/img/menu-new-icon.png" style="height:35px;"/>';?> </span></a></li>
            <li>
                <a href="/tin-tuc/benh-ly-chung-vung-rang-mieng"><img src="/img/mn-icon-benh-ly-vung-rang-mieng.fw.png" /><span>Bệnh lý răng miệng <?php if(in_array(3,$__categoryCollection__)) echo '<img src="/img/menu-new-icon.png" style="height:35px;"/>';?></span></a>
            </li>
            <li>
                <a href="/tin-tuc/theo-doi-cham-soc-rang-mieng-theo-lua-tuoi"><img src="/img/mn-icon-cham-soc-theo-lua-tuoi.fw.png" /><span>Theo dõi chăm sóc răng miệng ...</span></a>
                <div href="javascript:void(0)" style="position: absolute;margin-top: -74px;right: 100px;"><i class="fa fa-fw fa-arrow-circle-down"></i></div>
                <ul>
                    <li><a href="/tin-tuc/tre-em">Trẻ em <?php if(in_array(5,$__categoryCollection__)) echo '<img src="/img/menu-new-icon.png" style="height:35px;"/>';?></a></li>
                    <li><a href="/tin-tuc/nguoi-lon">Người lớn <?php if(in_array(6,$__categoryCollection__)) echo '<img src="/img/menu-new-icon.png" style="height:35px;"/>';?></a></li>
                    <li><a href="/tin-tuc/phu-nu-co-thai">Phụ nữ có thai <?php if(in_array(7,$__categoryCollection__)) echo '<img src="/img/menu-new-icon.png" style="height:35px;"/>';?></a></li>
                    <li><a href="/tin-tuc/nguoi-cao-tuoi">Người cao tuổi <?php if(in_array(8,$__categoryCollection__)) echo '<img src="/img/menu-new-icon.png" style="height:35px;"/>';?></a></li>
                </ul>
            </li>
            <li><a href="/tin-tuc/che-do-dinh-duong-ve-sinh-rang-mieng"><img src="/img/mn-icon-che-do-dinh-duong-ve-sinh-rang-mieng.fw.png" /><span>Chế độ dinh dưỡng, vệ sinh ... <?php if(in_array(9,$__categoryCollection__)) echo '<img src="/img/menu-new-icon.png" style="height:35px;"/>';?></span></a></li>
            <li><a href="/tin-tuc/cap-nhat-ve-nha-khoa"><img src="/img/mn-icon-cap-nhat-ve-nha-khoa.fw.png" /><span>Cập nhật về nha khoa <?php if(in_array(10,$__categoryCollection__)) echo '<img src="/img/menu-new-icon.png" style="height:35px;"/>';?></span></a></li>
            <li><a href="/tin-tuc/video"><img src="/img/mn-icon-video.fw.png" /><span>Video <?php if(in_array(11,$__categoryCollection__)) echo '<img src="/img/menu-new-icon.png" style="height:35px;"/>';?></span></a></li>
            <li><a href="/tin-tuc/tin-khac"><img src="/img/mn-icon-tin-khac.fw.png" /><span>Tin khác <?php if(in_array(44,$__categoryCollection__)) echo '<img src="/img/menu-new-icon.png" style="height:35px;"/>';?></span></a></li>
            
            <li class="big-item"><a href="/home?#support">TƯ VẤN</a></li>
            <li><a href="javascript:openChatDialog()"> <img src="/img/mn-icon-support.png" /> <span>Trợ giúp </span></a>  </li>
            <li><a href="/timeline/rang-sua"> <img src="/img/mn-icon-time-line-rang-sua.fw.png" /> <span>Tuổi mọc răng sữa </span></a>  </li>
            <li><a href="/timeline/rang-vinh-vien"> <img src="/img/mn-icon-time-line-rang-vinh-vien.fw.png" /> <span> Tuổi mọc răng vĩnh viễn </span></a>  </li>
            <li><a href="/login?action=tuoi-moc-rang-ca-nhan"> <img src="/img/mn-icon-teeth-growup.fw.png" /><span> Tuổi mọc răng của bạn</span></a>  </li>
            <li><a href="/login?action=ho-so-rang-mieng"><img src="/img/mn-icon-profiles.fw.png" /><span> Hồ sơ răng miệng của tôi </span></a>  </li>
            <li><a href="/ban-do"><img src="/img/mn-icon-maps.png" /><span> Finder </span></a>  </li>
            
            <li class="big-item"><a href="/san-pham">SẢN PHẨM</a></li>
            <li><a href="/san-pham/ban-chai-danh-rang"><img src="/img/mn-icon-ban-chai-danh-rang.fw.png" /><span>Bàn chải đánh răng <?php if(in_array(13,$__categoryCollection__)) echo '<img src="/img/menu-new-icon.png" style="height:35px;"/>';?></span></a></li>
            <li><a href="/san-pham/kem-danh-rang"><img src="/img/mn-icon-kem-danh-rang.fw.png" /><span>Kem đánh răng <?php if(in_array(14,$__categoryCollection__)) echo '<img src="/img/menu-new-icon.png" style="height:35px;"/>';?></span></a></li>
            <li><a href="/san-pham/thuoc"><img src="/img/mn-icon-thuoc.fw.png" /><span>Thuốc <?php if(in_array(15,$__categoryCollection__)) echo '<img src="/img/menu-new-icon.png" style="height:35px;"/>';?></span></a></li>
            <li><a href="/san-pham/nuoc-suc-mieng"><img src="/img/mn-icon-nuoc-suc-mieng.fw.png" /><span>Nước súc miệng <?php if(in_array(16,$__categoryCollection__)) echo '<img src="/img/menu-new-icon.png" style="height:35px;"/>';?></span></a></li>
            <li><a href="/san-pham/san-pham-khac"><img src="/img/mn-icon-khac.fw.png" /><span>Khác <?php if(in_array(19,$__categoryCollection__)) echo '<img src="/img/menu-new-icon.png" style="height:35px;"/>';?></span></a></li>
            
            <li class="big-item"><a href="/ky-thuat">KỸ THUẬT</a></li>
            <li><a href="/ky-thuat/dieu-tri"><img src="/img/mn-icon-dieu-tri.fw.png" /><span>Điều trị <?php if(in_array(25,$__categoryCollection__)) echo '<img src="/img/menu-new-icon.png" style="height:35px;"/>';?></span></a></li>
            <li><a href="/ky-thuat/phuc-hinh"><img src="/img/mn-icon-phuc-hinh.fw.png" /><span>Phục hình <?php if(in_array(26,$__categoryCollection__)) echo '<img src="/img/menu-new-icon.png" style="height:35px;"/>';?></span></a></li>
            <li><a href="/ky-thuat/nha-chu"><img src="/img/mn-icon-nha-chu.fw.png" /><span>Nha chu <?php if(in_array(27,$__categoryCollection__)) echo '<img src="/img/menu-new-icon.png" style="height:35px;"/>';?></span></a></li>
            <li><a href="/ky-thuat/nan-chinh"><img src="/img/mn-icon-nan-chinh.fw.png" /><span>Nắn chỉnh <?php if(in_array(28,$__categoryCollection__)) echo '<img src="/img/menu-new-icon.png" style="height:35px;"/>';?></span></a></li>
            <li><a href="/ky-thuat/tieu-phau"><img src="/img/mn-icon-tieu-phau.fw.png" /><span>Tiểu phẫu <?php if(in_array(29,$__categoryCollection__)) echo '<img src="/img/menu-new-icon.png" style="height:35px;"/>';?></span></a></li>
            <li><a href="/ky-thuat/ham-mat"><img src="/img/mn-icon-ham-mat.fw.png" /><span>Hàm mặt <?php if(in_array(30,$__categoryCollection__)) echo '<img src="/img/menu-new-icon.png" style="height:35px;"/>';?></span></a></li>
            <li><a href="/ky-thuat/dieu-tri-khac"><img src="/img/mn-icon-tin-khac.fw.png" /><span>Khác <?php if(in_array(31,$__categoryCollection__)) echo '<img src="/img/menu-new-icon.png" style="height:35px;"/>';?></span></a></li>
            
            <li class="big-item"><a href="/tuyen-dung">TUYỂN DỤNG</a></li>
            <li><a href="/tuyen-dung/cong-tac-vien"><img src="/img/mn-icon-cong-tac-vien.fw.png" /><span>Cộng tác viên <?php if(in_array(39,$__categoryCollection__)) echo '<img src="/img/menu-new-icon.png" style="height:35px;"/>';?></span></a></li>
            <li><a href="/tuyen-dung/quan-tri-vien"><img src="/img/mn-icon-quan-tri-vien.fw.png" /><span>Quản trị viên <?php if(in_array(40,$__categoryCollection__)) echo '<img src="/img/menu-new-icon.png" style="height:35px;"/>';?></span></a></li>
            
            <?php if(!empty($current_user->id)){?>
                <li class="big-item"><a href="/logout"><img src="/img/mn-icon-logout.png" /> ĐĂNG XUẤT</a></li>
            <?php }?>
            
            
    </ul>
</div>
<script type="text/javascript">
    window.inital_overlay = function(){
    	var currentHeight =  $("body > .overlay-menu").height();
        var targetHeight = document.getElementsByTagName('body')[0].offsetHeight;
        var height = currentHeight > targetHeight ? currentHeight : targetHeight;
        $("body > .overlay-menu").height(height);
    	$("body > .overlay-menu .mobile-main-menu").height(height);
    }
    $(document).ready(function(){
        $(".header .mn-btn").click(function(){
            if($("body > .overlay-menu").is(":visible")){
            	$("#header-container").removeClass("header-container-on-open-menu");
            	$("body").removeClass("body-on-scroll");
            }else{
            	$("#header-container").addClass("header-container-on-open-menu");
            	$("body").addClass("body-on-scroll");
            }
            window.inital_overlay();
            $("body > .overlay-menu").fadeToggle("slow");
          });
        $("body > .overlay-menu").click(function(){
        	if($("body > .overlay-menu").is(":visible")){
        		$("#header-container").removeClass("header-container-on-open-menu");
            	$("body").removeClass("body-on-scroll");
            }else{
            	$("#header-container").addClass("header-container-on-open-menu");
            	$("body").addClass("body-on-scroll");
            }
        	window.inital_overlay();
            $("body > .overlay-menu").fadeToggle("slow");
         });
        });
</script>