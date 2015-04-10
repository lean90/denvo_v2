<?php
$currentUrl = $_SERVER ["REQUEST_URI"];
$isDetailsPage = strpos ( $currentUrl, '.html' ) !== false;
?>
<div class="scrum-map width-960px">

	<div id="addbtn" class="add-button" style="display: <?php echo $isDetailsPage ? 'none' : 'block'; ?>">
		<a
			href="<?php echo $parrentPageCategory[count($parrentPageCategory) - 1]->part_url.'/add.html';?>"
			class="btn btn-primary"> <i class="glyphicon glyphicon-plus-sign"></i>
			&nbsp; Thêm bài viết mới
		</a>
	</div>
	<div class="current-page"><?php echo  $isDetailsPage ? $parrentPageCategory[count($parrentPageCategory) - 1]->name : $view->title;?></div>
	<ul class="map">
		<li><a href="/">Trang chủ</a><span>&gt;</span></li>
        <?php
            foreach ( $parrentPageCategory as $result ) {
                echo "<li><a href='{$result->part_url}'>{$result->name}</a><span>&gt;</span></li>";
            }
        ?>
    </ul>

</div>
<?php
$root = $parrentPageCategory [0];
$leftClass = "";
if ($root->part_url == '/tin-tuc' || strpos ( $root->part_url, '/tin-tuc/' ) != false || $root->part_url == '/ky-thuat' || strpos ( $root->part_url, '/ky-thuat/' ) != false) {
	$leftClass = 'anchor-tab-tin-tuc';
}
if ($root->part_url == '/san-pham' || strpos ( $root->part_url, '/san-pham/' ) != false) {
	$leftClass = 'anchor-tab-san-pham';
}
if ($root->part_url == '/tro-choi' || strpos ( $root->part_url, '/tro-choi/' ) != false) {
	$leftClass = 'anchor-tab-tro-choi';
}
if ($root->part_url == '/profile' || strpos ( $root->part_url, '/profile/' ) != false) {
	$leftClass = 'anchor-tab-tu-van';
}

?>
<div class="anchor-tab <?php echo $leftClass;?>">
	<ul class="text-left">
		<li><a href="/home#banner"></a></li>
		<li><a href="/home#news"></a></li>
		<li><a href="/home#drugs"></a></li>
		<li><a href="/home#games"></a></li>
		<li><a href="/home#support"></a></li>
		<li><a href="/home#footer"></a></li>
	</ul>
</div>

<script type="text/javascript">
    $(document).ready(function(){
       if(me.account_role == undefined || me.account_role == 'USER' ){
           $("#addbtn").hide();
       }
        
        $(window).scroll(function(e){
            var scrollTop = $(window).scrollTop();
            if(scrollTop > 130){
                $('.anchor-tab').show();
                $('.menu-conatiner').hide().fadeOut( "slow" );
                $('body .header').css('min-height','85px');
                $('body .header').css('background-image','none');
            }else{
                $('.anchor-tab').hide().fadeOut( "slow" );
                $('.menu-conatiner').show();
                $('body .header').css('min-height','120px');
                $('body .header').css('background-image','url(/img/Head_bg.fw.png)');
                
            }
        });
    });
</script>