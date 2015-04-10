
<style type="text/css">
.footer {
	margin-top: 0px;
	z-index: 3;
}
</style>
<div class="banner col-xs-12">
	<div id="carousel-example-generic" class="carousel slide"
		data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carousel-example-generic" data-slide-to="0"
				class="active"></li>
			<li data-target="#carousel-example-generic" data-slide-to="1"
				class=""></li>
			<li data-target="#carousel-example-generic" data-slide-to="2"
				class=""></li>
		</ol>
		<div class="carousel-inner">
                <?php
                
echo "<div id='banner-des-0' class='item text-center active'>
                                <img src='{$banners[0]['BannerImage']}' alt='{$banners[0]['BannerObject']->title}'>
                                <div class='carousel-caption'>
                                    <a style='color:white'  href='#' onclick=\"window.open('/send_mail','Gửi liên hệ','toolbar=1,location=1,directories=0,status=0,menubar=1,scrollbars=1,resizable=1,copyhistory=0,width=550,height=650')\"> Đang trong thời gian chạy thử bản Beta Mọi ý kiến đóng góp xin gửi <span style='text-decoration: underline;color:white;'>tại đây</span></a>
                                </div>
                          </div>";
                ?>
                <?php
                
echo "<div id='banner-des-1' class='item text-center'>
                                <img src='{$banners[1]['BannerImage']}' alt='{$banners[1]['BannerObject']->title}'>
                                <div class='carousel-caption'>
                                    <a style='color:white'  href='https://docs.google.com/forms/d/1tkVvziZ0eBo9_fpLGNtKmgzYGOqMfN0-sgTCHROj87w/viewform?usp=send_form' target='_blank'>Bạn có muốn mua Voucher các dịch vụ nha khoa trên Website Dento? Vui lòng xem <span style='text-decoration: underline;color:white;'>tại đây</span></a>
                                </div>
                          </div>";
                ?>
                <?php
                
echo "<div id='banner-des-2' class='item text-center'>
                                <img src='{$banners[2]['BannerImage']}' alt='{$banners[2]['BannerObject']->title}'>
                                <div class='carousel-caption'>
                                    <a style='color:white'  href='https://docs.google.com/forms/d/1Snsl2dojVfACWNNMAX39S8qHsHoXTsVlTmdUUL9SHeg/viewform?usp=send_form' target='_blank'>Bạn có muốn bán Voucher các dịch vụ nha khoa trên Website Dento? Vui lòng xem <span style='text-decoration: underline;color:white;'>tại đây</span></a>
                                </div>
                          </div>";
                ?>
            </div>
	</div>

</div>

<div class="region news col-xs-12 text-center">
	<div class="region-content  width-840 height-640 text-center">
		<div class="news">
			<a href="/tin-tuc/kien-thuc-chung-ve-rang-mieng" class="title">Kiến
				thức về răng miệng</a>
                <?php
                foreach ( $knowledges as $knowledge ) {
                    $description = substr ( $knowledge->description, 0, 255 ) . ' ... ';
                    $partUrl = "{$knowledge->part_url}-{$knowledge->id}.html";
                    echo " 
                            <div class='news-row text-left'>
                                    <a href='{$partUrl}' class='index'>● {$knowledge->title}</a><br />
                                    <span>  
                                        {$description}
                                            <a href='{$partUrl}'>xem tiếp</a>
                                    </span>
                            </div> ";
                }
                
                ?>
            </div>
		<div class="blocks">
			<div class="tags red-tags" style="display: <?php echo $newStatus->chamSocRangMieng ? 'block':'none' ?>"></div>
			<div class="tags blue-tags" style="display: <?php echo $newStatus->cheDoDinhDuong ? 'block':'none' ?>"></div>
			<div class="tags yellow-tags" style="display: <?php echo $newStatus->benhLy ? 'block':'none' ?>"></div>
			<div class="tags gray-tags" style="display: <?php echo $newStatus->capNhat ? 'block':'none' ?>"></div>
			<div class="tags dark-blue-tags" style="display: <?php echo $newStatus->video ? 'block':'none' ?>"></div>
			<a class="red block"
				href="/tin-tuc/theo-doi-cham-soc-rang-mieng-theo-lua-tuoi">Theo dõi
				chăm sóc răng miệng theo lứa tuổi</a> <a class="blue block"
				href="/tin-tuc/che-do-dinh-duong-ve-sinh-rang-mieng">
				Chế độ </br> dinh dưỡng,</br> vệ sinh </br> răng miệng</a> <a class="yellow block"
				href="/tin-tuc/benh-ly-chung-vung-rang-mieng">Bệnh lý
				răng miệng</a> <a class="gray block"
				href="/tin-tuc/cap-nhat-ve-nha-khoa">Cập nhật về nha khoa</a> <a
				class="dark-blue block" href="/tin-tuc/video">Video </a>
		</div>
	</div>
</div>
<div class="region drugs col-xs-12 text-center">

	<div class="region-content  width-840 height-640 text-left">
		<ul class="home-products">
			<li class="product toothbrush">
				<div class="drugs-list-container text-right">
					<a href="/san-pham/ban-chai-danh-rang" class="text-right">Bàn chải
						đánh răng</a>
					<ul>
                            <?php
                            foreach ( $products->banChaiDanhRang as $item ) {
                                $url = "{$item->part_url}-{$item->id}.html";
                                $title = mb_substr ( $item->title, 0, 20, 'UTF-8' ) . " ... ";
                                echo "<li class='text-right'><a href='{$url}'>{$title}</a></li>";
                            }
                            ?>
                        </ul>
				</div>
			</li>
			<li class="product toothpaste">
				<div class="drugs-list-container text-right">
					<a href="/san-pham/kem-danh-rang" class="text-right">Kem đánh răng</a>
					<ul>
                            <?php
                            foreach ( $products->kemDanhRang as $item ) {
                                $url = "{$item->part_url}-{$item->id}.html";
                                $title = mb_substr ( $item->title, 0, 20 ) . " ... ";
                                echo "<li class='text-right'><a href='{$url}'>{$title}</a></li>";
                            }
                            ?>
                        </ul>
				</div>

			</li>
			<li class="product drug">
				<div class="drugs-list-container text-right">
					<a href="/san-pham/thuoc" class="text-right">Thuốc</a>
					<ul>
                            <?php
                            foreach ( $products->thuoc as $item ) {
                                $url = "{$item->part_url}-{$item->id}.html";
                                $title = mb_substr ( $item->title, 0, 20 ) . " ... ";
                                echo "<li class='text-right'><a href='{$url}'>{$title}</a></li>";
                            }
                            ?>
                        </ul>
				</div>
			</li>
			<li class="product mouthwash">
				<div class="drugs-list-container text-right">
					<a href="/san-pham/nuoc-suc-mieng" class="text-right">Nước súc
						miệng</a>
					<ul>
                            <?php
                            foreach ( $products->nuocSucMieng as $item ) {
                                $url = "{$item->part_url}-{$item->id}.html";
                                $title = mb_substr ( $item->title, 0, 20 ) . " ... ";
                                echo "<li class='text-right'><a href='{$url}'>{$title}</a></li>";
                            }
                            ?>
                        </ul>
				</div>
			</li>
			<li class="product darkwater">
				<div class="drugs-list-container text-right">
					<a href="/san-pham/san-pham-khac" class="text-right">Khác</a>
					<ul>
                            <?php
                            foreach ( $products->khac as $item ) {
                                $url = "{$item->part_url}-{$item->id}.html";
                                $title = mb_substr ( $item->title, 0, 20 ) . " ... ";
                                echo "<li class='text-right'><a href='{$url}'>{$title}</a></li>";
                            }
                            ?>
                        </ul>
				</div>
			</li>
		</ul>
	</div>
</div>
<div class="region games col-xs-12 text-center">

	<div class="region-content width-840 height-640 text-center">
		<a target="__blank" href="<?php echo $games[0]["gameLink"] ?>"
			class="mini-games center"><img
			src="<?php echo $games[0]["gameObject"]->thumbnail; ?>" width="352px"
			height="352px" src="#" /></a> <a target="__blank"
			href="<?php echo $games[1]["gameLink"] ?>" class="mini-games left"><img
			src="<?php echo $games[1]["gameObject"]->thumbnail; ?>" width="160px"
			height="160px" src="#" /></a> <a target="__blank"
			href="<?php echo $games[2]["gameLink"] ?>" class="mini-games right"><img
			src="<?php echo $games[2]["gameObject"]->thumbnail; ?>" width="160px"
			height="160px" src="#" /></a>
	</div>

</div>

<div class="region support col-xs-12 text-center">

	<div class="region-content  width-840 height-640 text-center">
		<div class="support-title">
			<a class="left" href="/timeline/rang-sua">Tuổi mọc<br />răng sữa
			</a> <a class="right" href="/timeline/rang-vinh-vien">Tuổi mọc<br />răng
				vĩnh viễn
			</a>
		</div>
		<div class="support-frm">
            <?php
            $user = Common::getCurrentUser ();
            $url = $user->is_authorized ? "/profile/{$user->id}/ho-so-rang-mieng" : Common::getCurrentHost () . '/login';
            ?>
            <span class="support-frm-title">Răng của tôi đang trong tình trạng nào nhỉ?</span>
			<div class="support-frm-content"
				ng-controller="ProfileHomeController">
				<div class="support-content-left">
					<span class="title">Tuổi mọc răng của bạn</span> 
					<span class="content"> Nơi lưu trữ tuổi mọc răng<br/> của các thành viên<br/><br/></span> 
					<a href="<?php echo $url;?>" class="btn btn-primary">Chi tiết &gt;&gt;</a>
				</div>
				<div class="support-content-right">
					<span class="title">Hồ sơ răng miệng cá nhân</span>
					<span class="content"> Nơi lưu trữ tình trạng răng miệng<br/> của các thành viên<br/><br/></span>
					<a ng-click="openProfilePage()" class="btn btn-primary">Chi tiết &gt;&gt;</a>
				</div>
			</div>
		</div>
		<div class="chat-frm">
			<span class="chat-frm-title">Trợ giúp</span>
			<div class="chat-frm-content" >
			     <ul class="supporter">
			         <li><a href="javascript:jqcc.cometchat.chatWith('<?php echo $supporter->user->id; ?>');"></a></li>
			         <li><a href="<?php echo $supporter->facebookUrl; ?>"></a></li>
			         <li><a href="callto:<?php echo $supporter->viberAccount; ?>"></a></li>
			         <li><a href="skype:<?php echo $supporter->skypeAccount; ?>?chat"></a></li>
			         <li><a href="ymsgr:sendim?<?php echo $supporter->yahooAccount; ?>"></a></li>
			         <li><a href="mailto:<?php echo $supporter->user->email; ?>"></a></li>
			     </ul>
			</div>
		</div>
	</div>
</div>
<div class="anchor-tab">
	<ul class="text-left">
		<li prefer=".banner"><a href="/home#banner"></a></li>
		<li prefer=".news"><a href="/home#news"></a></li>
		<li prefer=".drugs"><a href="/home#drugs"></a></li>
		<li prefer=".games"><a href="/home#games"></a></li>
		<li prefer=".support"><a href="/home#support"></a></li>
		<li prefer=".footer"><a href="/home#footer"></a></li>
	</ul>
</div>

<div id="video-container" class="video-home">
	<span class="close-btn"></span>
	<iframe width="240" height="159" frameborder="0" allowfullscreen> </iframe>
</div>

<script type="text/ng-template" id="profileAutoComplete.html">
    <span style="font-weight:bold;text-align: left;width:100%;display:inline-block;padding:0px 5px">{{match.model.full_name}}</span><br/>
    <span style="text-align: left;width:100%;display:inline-block;padding:0px 5px">{{match.model.dob}}</span>
</script>
<script type="text/javascript">
    var histories = <?php echo json_encode($histories);?>;
    var videoPath = "<?php echo $video->value; ?>";
</script>
<script type="text/javascript">
    $(document).ready(function(){
       var common = new Common();
       var videoId = common.getYoutubeVideoId(videoPath);
       if(me.id == undefined)
       {
           $('#video-container').css('bottom',"-4px");
       }
       $('#video-container iframe').attr('src',"//www.youtube.com/embed/"+videoId);
       $('#video-container .close-btn').click(function(){
           $('#video-container iframe').toggle('slow',function(){
                $('#video-container iframe').attr('src',"");
           });
       });
       
       
        
       if(me.account_role == undefined || me.account_role == 'USER' ){
           $("#addbtn").hide();
       }
       
        $(window).scroll(function(e){
            var scrollTop = $(window).scrollTop();
            if(scrollTop > 640){
                $('.anchor-tab').show();
                $('.menu-conatiner').hide().fadeOut( "slow" );
                $('body .header').css('min-height','85px');
                $('body .header').css('background-image','none');
                onChangeClass();
            }else{
                $('.anchor-tab').hide().fadeOut( "slow" );
                $('.menu-conatiner').show();
                $('body .header').css('min-height','120px');
                $('body .header').css('background-image','url(/img/Head_bg.fw.png)');
                
            }
        });
        
        $(".anchor-tab > ul > li").click(function(){
            var refer =  $(this).attr('prefer');
            var elemTop = $(refer+":first").offset().top - 80;
            $('html,body').animate({
                scrollTop: elemTop},
            'slow');
        });
        
        
        var hash = window.location.hash;
        hash =  hash.replace('#',".");
        var elemTop = $(hash+":first").offset().top - 80;
        $('html,body').animate({
            scrollTop: elemTop},
        'slow');
    });
    
    
    function onChangeClass(){
        var scrollTop = $(window).scrollTop();
        var news = $(".news").height();
        var drugs = $(".drugs").height();
        var games = $(".games").height();
        var support = $(".support").height();
        if(isScrolledIntoView($(".news"))){
            $('.anchor-tab').css("background-image","url(/img/anchor-news.fw.png)");
        }
        if(isScrolledIntoView($(".drugs"))){
            $('.anchor-tab').css("background-image","url(/img/anchor-product.fw.png)");
        }
        if(isScrolledIntoView($(".games"))){
            $('.anchor-tab').css("background-image","url(/img/anchor-game.fw.png)");
        }
        if(isScrolledIntoView($(".support"))){
            $('.anchor-tab').css("background-image","url(/img/anchor-advisory.fw.png)");
        }
        if(isScrolledIntoView($(".footer"))){
            $('.anchor-tab').css("background-image","url(/img/anchor-sitemap.fw.png)");
        }
        
        
    }
    
    function isScrolledIntoView(elem)
    {
        var docViewTop = $(window).scrollTop();
        var docViewBottom = docViewTop + ($(window).height() - 85);

        var elemTop = $(elem).offset().top + $(window).height()/2;
        var elemBottom = elemTop;
        return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
    }
</script>

