<div class="body-content width-960">
    <?php
				$currentPart = $parrentPageCategory [count ( $parrentPageCategory ) - 1]->part_url;
				$post->created_at = DateTime::createFromFormat ( DatabaseFixedValue::DEFAULT_FORMAT_DATE, $post->created_at )->format ( 'd/m/Y' );
				$canbeEdit = Common::getCurrentUser ()->account_role == 'ADMIN' || Common::getCurrentUser ()->id == $post->user_id;
				$showAdminLink = $canbeEdit ? 'inline-block' : 'none';
				$editUrl = Common::curPageURL () . '/edit.html';
				$deleteUrl = Common::curPageURL () . '/remove.html?callback=' . urlencode ($currentPart );
				$isHideRight = $parrentPageCategory [count ( $parrentPageCategory ) - 1]->category_type == "STATIC";
				?>
    <div class="detail-view post-view width-960">
		<div class="left">
            <?php
				$currentCategory = $parrentPageCategory [count ( $parrentPageCategory ) - 1];
				$isShowReferAndComment = $parrentPageCategory [count ( $parrentPageCategory ) - 1]->visible == 1;
				$cssIsShowReferAndComment = $isShowReferAndComment ? 'block' : 'none';
				switch ($parrentPageCategory [count ( $parrentPageCategory ) - 1]->category_type) {
					case 'POST' :
					case 'STATIC' :
						include APPPATH .VIEW_PATH. '/PostDetail.php';
						break;
					case 'VIDEO' :
						include APPPATH .VIEW_PATH. '/VideoDetail.php';
						break;
					case 'GAME' :
						include APPPATH .VIEW_PATH. '/GameDetail.php';
						break;
				}
			?>
        </div>
        <div class="right clear-bg">
			<div class="right-item">
                <?php include APPPATH.VIEW_PATH. '/many_view_time.php'; ?>
            </div>
		</div>
		
		<div class="left" style="width:<?php echo $isHideRight ? '640px' : '' ?>;display:<?php echo $cssIsShowReferAndComment; ?>;min-height:0px;">
			<div class="left-head" style="width:<?php echo $isHideRight ? '960px' : '' ?>">
				Liên quan</div>
			<div class="post-refer" style="display:<?php echo $cssIsShowReferAndComment; ?>">
				<ul>
                    <?php
        				foreach ( $referPosts as $referPost ) {
        					$referPost->thumbnail = strpos ( $referPost->thumbnail, 'http' ) !== false ? $referPost->thumbnail : '/thumbnail.php' . $referPost->thumbnail . "?140";
        					
        					if ($referPost->id != $post->id) {
        						$url = "{$referPost->part_url}-{$referPost->id}.html";
        						echo "<li><a href='{$url}'>{$referPost->title}</a></li>";
        					}
        				}
    				?>
                </ul>
			</div>
		</div>

	</div>
</div>