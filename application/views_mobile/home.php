<?php $supporter = get_instance ()->getRootUser (); ?>
<style type="text/css">
.footer {
	margin-top: 0px;
	z-index: 3;
}
</style>
<div class="banner col-xs-12">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
            <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
        </ol>
        <div style="position: relative; margin-bottom: -100px; z-index: 999; float: right;">
            <a href="/ban-do"><img height="75px" alt="" src="/img/betafinder.png"></a>
        </div>
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
    <div class="region-content text-center">
        <div class="blocks">
            <div class="tags red-tags" style="display: <?php echo $newStatus->chamSocRangMieng ? 'block':'none' ?>"></div>
            <div class="tags blue-tags" style="display: <?php echo $newStatus->cheDoDinhDuong ? 'block':'none' ?>"></div>
            <div class="tags yellow-tags" style="display: <?php echo $newStatus->benhLy ? 'block':'none' ?>"></div>
            <div class="tags gray-tags" style="display: <?php echo $newStatus->capNhat ? 'block':'none' ?>"></div>
            <div class="tags dark-blue-tags" style="display: <?php echo $newStatus->video ? 'block':'none' ?>"></div>
            <div class="tags seablue-tags" style="display: <?php echo $newStatus->kienThucChung ? 'block':'none' ?>"></div>

            <a class="sea-blue block" href="/tin-tuc/kien-thuc-chung-ve-rang-mieng">Kiến thức <br /> về răng miệng
            </a> <a class="red block" href="/tin-tuc/theo-doi-cham-soc-rang-mieng-theo-lua-tuoi">Theo dõi <br /> chăm sóc <br /> răng miệng <br /> theo lứa tuổi
            </a> <a class="blue block" href="/tin-tuc/che-do-dinh-duong-ve-sinh-rang-mieng"> Chế độ <br /> dinh dưỡng, <br /> vệ sinh <br /> răng miệng
            </a> <a class="yellow block" href="/tin-tuc/benh-ly-chung-vung-rang-mieng">Bệnh lý <br /> răng miệng
            </a> <a class="gray block" href="/tin-tuc/cap-nhat-ve-nha-khoa">Cập nhật<br /> về <br /> nha khoa
            </a> <a class="dark-blue block" href="/tin-tuc/video">Video </a>
        </div>
    </div>
</div>
<div class="region drugs col-xs-12 text-center">
    <div class="region-content text-left">
        <ul class="home-products">
            <li class="product toothbrush">
                <div class="drugs-list-container text-right">
                    <a href="/san-pham/ban-chai-danh-rang" class="text-right">Bàn chải đánh răng</a>
                </div>
            </li>
            <li class="product toothpaste">
                <div class="drugs-list-container text-right">
                    <a href="/san-pham/kem-danh-rang" class="text-right">Kem đánh răng</a>
                </div>

            </li>
            <li class="product darkwater">
                <div class="drugs-list-container text-right">
                    <a href="/san-pham/san-pham-khac" class="text-right">Khác</a>
                </div>
            </li>
            <li class="product drug">
                <div class="drugs-list-container text-right">
                    <a href="/san-pham/thuoc" class="text-right">Thuốc</a>
                </div>
            </li>
            <li class="product mouthwash">
                <div class="drugs-list-container text-right">
                    <a href="/san-pham/nuoc-suc-mieng" class="text-right">Nước súc miệng</a>
                </div>
            </li>

        </ul>
    </div>
</div>
<div class="region support col-xs-12 text-center">

    <div class="region-content text-center" style="padding: 20px;">
        <div class="support-title">
            <a class="left" href="/timeline/rang-sua">Tuổi mọc<br />răng sữa
            </a> <a class="right" href="/timeline/rang-vinh-vien">Tuổi mọc<br />răng vĩnh viễn
            </a>
        </div>
        <div class="support-frm">
                <?php
																$user = Common::getCurrentUser ();
																$url = $user->is_authorized ? "/profile/{$user->id}/ho-so-rang-mieng" : Common::getCurrentHost () . '/login';
																?>
                <span class="support-frm-title">Răng của tôi đang trong tình trạng nào nhỉ?</span>
            <div class="support-frm-content" ng-controller="ProfileHomeController">
                <div class="support-content-left">
                    <span class="title">Tuổi mọc răng <br /> của bạn
                    </span> <span class="content"> Nơi lưu trữ tuổi mọc răng của các thành viên<br />
                    <br />
                    </span> <a href="<?php echo $url;?>" class="btn btn-primary">Chi tiết &gt;&gt;</a>
                </div>
                <div class="support-content-right">
                    <span class="title">Hồ sơ răng miệng <br /> cá nhân
                    </span>
                    <div class="content">
                        Nơi lưu trữ tình trạng răng miệng của các thành viên<br />
                        <br />
                    </div>
                    <a ng-click="openProfilePage()" class="btn btn-primary">Tư vấn &gt;&gt;</a>

                </div>
            </div>
        </div>
        <div class="chat-frm">
            <span class="chat-frm-title">Trợ giúp</span>
            <div class="chat-frm-content">
                <ul class="supporter">
                    <li><a href="/dento-chat"></a></li>
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
<script type="text/javascript">
var histories = <?php echo json_encode($histories);?>;
</script>
<script type="text/javascript">
    $(document).ready(function(){
        var hash = window.location.hash;
        hash =  hash.replace('#',".");
        var elemTop = $(hash+":first").offset().top - 80;
        $('html,body').animate({
            scrollTop: elemTop},
        'slow');
    });
</script>