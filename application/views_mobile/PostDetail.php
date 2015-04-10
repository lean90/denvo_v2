<?php
?>
<div class="head"> <?php echo $post->title;?></div>
<div class="infor">
    <?php echo $post->created_at;?>   |   Số lần xem: <?php echo $post->view_count;?> lượt
</div>
<div class="social">
	<div class="fb-like" data-href="<?php echo str_replace("http://m.", "http://", Common::curPageURL());?>"
		data-layout="button_count" data-action="like" data-show-faces="true"
		data-share="true"></div>
</div>
<div class="post-content">
	<span class="des"> <img class="thumbnail" alt=""
		src="<?php echo $post->thumbnail;?>"> <?php echo $post->description;?></span>
	<div class="post-user-content"><?php echo $post->content;?></div>
</div>
<?php

if ($rootPath = $parrentPageCategory [0]->id == 38) {
	include APPPATH . 'views/dento_upline_cv.php';
}
?>
<div class="facebook-comment" style="display:<?php echo $cssIsShowReferAndComment; ?>">
	<div class="fb-comments" data-href="<?php echo str_replace("http://m.", "http://", Common::curPageURL());?>"
		data-numposts="5" data-colorscheme="light"></div>
</div>