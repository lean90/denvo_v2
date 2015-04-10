
<div class="post-content">
	<div class="post-user-content"><?php echo $post->content;?></div>
</div>
<div class="head"> <?php echo $post->title;?></div>
<div class="infor">
    <?php echo $post->created_at;?>   |   Số lần xem: <?php echo $post->view_count;?> lượt 
    <a class='list-admin-tool' style='display:<?php echo $showAdminLink; ?>' href='<?php echo $editUrl; ?>'><i
		class='glyphicon glyphicon-edit'></i> Chỉnh sửa</a> <a class='list-admin-tool' style='display:<?php echo $showAdminLink; ?>' href='<?php echo $deleteUrl; ?>'><i
		class='glyphicon glyphicon-floppy-remove'></i> Xóa </a>
</div>
<div class="social">
	<div class="fb-like" data-href="<?php echo Common::curPageURL();?>"
		data-layout="button_count" data-action="like" data-show-faces="true"
		data-share="true"></div>
</div>
<div class="post-content">

<?php echo nl2br($post->description);?></div>
<div class="facebook-comment">
	<div class="fb-comments" data-href="<?php echo Common::curPageURL();?>"
		data-numposts="5" data-colorscheme="light"></div>
</div>