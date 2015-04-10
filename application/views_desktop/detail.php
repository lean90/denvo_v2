<div class="body-content width-960">
    <?php include APPPATH.VIEW_PATH.'/scrummap.php';?>
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
		<div class="left" style="width:<?php echo $isHideRight ? '960px' : '' ?>">
            <?php
				$currentCategory = $parrentPageCategory [count ( $parrentPageCategory ) - 1];
				$isShowReferAndComment = $parrentPageCategory [count ( $parrentPageCategory ) - 1]->visible == 1;
				$cssIsShowReferAndComment = $isShowReferAndComment ? 'block' : 'none';
				switch ($parrentPageCategory [count ( $parrentPageCategory ) - 1]->category_type) {
					case 'POST' :
					case 'STATIC' :
						include APPPATH .VIEW_PATH.'/PostDetail.php';
						break;
					case 'VIDEO' :
						include APPPATH .VIEW_PATH.'/VideoDetail.php';
						break;
					case 'GAME' :
						include APPPATH .VIEW_PATH.'/GameDetail.php';
						break;
				}
			?>
        </div>


		<div class="right clear-bg" style="display:<?php echo $isHideRight ? 'none' : 'block';?>">
			<div class="right">
                <?php if(!$isHideRight){include APPPATH.VIEW_PATH.'/many_view_time.php';}?>
            </div>
			<div class="right clear-bg" style="display:<?php echo $isHideRight ? 'none' : 'block';?>">
				<ul class="link-shortcut">
					<li><a href="/timeline/rang-sua"><img alt=""
							src="/img/link_RS.fw.png"></a></li>
					<li><a href="/timeline/rang-vinh-vien"><img alt=""
							src="/img/link_RVV.fw.png"></a></li>
					<li style="display: <?php echo  isset(Common::getCurrentUser()->id) ? "block" : 'none'; ?>"><a
						href="/profile/<?php echo Common::getCurrentUser()->id; ?>/ho-so-rang-mieng"><img
							alt="" src="/img/link_hsrm.fw.png"></a></li>
					<li style="display: <?php echo  isset(Common::getCurrentUser()->id) ? "block" : 'none'; ?>"><a
						href="/profile/<?php echo Common::getCurrentUser()->id;?>/tuoi-moc-rang"><img
							alt="" src="/img/link_tmr.fw.png"></a></li>
				</ul>
			</div>
		</div>


		<div class="left" style="width:<?php echo $isHideRight ? '960px' : '' ?>;display:<?php echo $cssIsShowReferAndComment; ?>;min-height:0px">
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