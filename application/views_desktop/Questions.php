<script type="text/javascript">
$(document).ready(function(){
	$("#add-new-question").on('click',function(){
		 $('html, body').animate({
             scrollTop: $(".create-question").offset().top - 150
         }, 2000);
	});
});
</script>
<div class="body-content width-960">
    <div class="scrum-map width-960px">
		<div class="current-page">Tư vấn hỏi đáp</div>
		<ul class="map">
			<li><a href="/home">Trang chủ</a><span>&gt;</span></li>
			<li><a href="/danh-sach-cau-hoi">Danh sách câu hỏi</a><span>&gt;</span></li>
		</ul>
	</div>
    <div class="detail-view post-view">
    <div class="question left" ng-controller="QuestionsController" style="background: white">
        <a href="javascript:void(0)" id="add-new-question" style="position: absolute;margin-top: 57px;margin-right:15px;margin-left: 524px;"><img alt="" height="25px" src="/img/Dau-cong.jpg"></a>
        <ul class="tab-control">
            <li ng-click="changeList('many-new',1)" ng-class="{'selected':currentTab == 'many-new'}" class="many-new">
                <span><?php echo number_format($all_count);?></span>
            </li>
            <li ng-click="changeList('many-view',1)" ng-class="{'selected':currentTab == 'many-view'}" class="many-view">
                <span><?php echo number_format($most_count);?></span>
            </li>
            <li ng-click="changeList('many-like',1)" ng-class="{'selected':currentTab == 'many-like'}" class="many-like">
                <span><?php echo number_format($have_like_count);?></span>
            </li>
        </ul>
        <div class="tab-title">{{tabtitle}} </div>
        
        <div class="question-item" ng-repeat="question in questions">
            <a ng-cloak style="float: right" ng-show="(me.account_role == 'ADMIN' || me.account_role == 'COLLABORATORS') && question.q_status != 1" ng-href="/question/public/{{question.id}}">Cho phép</a>
            <a ng-href="/cau-hoi/{{question.id}}">
                <table class="q-detail">
                    <tr class="question">
                        <td class="q-icon">
                            <img alt="" ng-src="{{question.user.avartar == undefined && '/img/question-default.png' || question.user.avartar }}" />
                        </td>
                        <td class="q-des">
                            <p class="name">
                                 {{question.question}}
                            </p>
                            <p style="font-size: 11px;color:gray;">
                                {{question.full_name}}
                            </p>
                        </td>
                    </tr>
                    <tr class="answers">
                        <td class="q-icon" style="text-align: center">
                            <img alt="" width="41px" height="41px" src="/img/answers.fw.png" />
                        </td>
                        <td class="q-des">
                            <p class="name">
                                <img src="/img/icon-like-answer.fw.png"/> Câu trả lời hay nhất:
                            </p>
                            <p class="answer-detail">
                                 {{question.answer.answer}}
                            </p>
                            <p class="more-info">
                                {{question.answers_count}} câu trả lời · {{question.answer.friendly_time}}
                            </p>
                        </td>
                    </tr>
                </table>
            </a>
        </div>
        <div class="create-question">
            <br/>
            <p> Đặt câu hỏi  </p>
            <form id ="frm-create-question" method="post" novalidate="novalidate" enctype="multipart/form-data">
                <input name="full_name" required="required" type="text" value="<?php echo Common::getCurrentUser()->full_name;?>" class="form-control" placeholder="Họ và tên" />
                <br/>
                <input name="email" required="required" type="email" value="<?php echo strpos(Common::getCurrentUser()->email,'@') !== false ? Common::getCurrentUser()->email : "";?>" class="form-control" placeholder="Email" />
                <br/>
                <textarea name="question" rows="" cols="" class="form-control" placeholder="Câu hỏi"></textarea>
                <br/>
                <input name="acttachedimage_1" type="file" accept="image/*"/><br/>
                <input name="acttachedimage_2" type="file" accept="image/*"/><br/>
                <input name="acttachedimage_3" type="file" accept="image/*"/><br/>
                <div class="btn-container">
                    <button id ="btn-create-question" class="btn btn-primary">Gửi</button>
                </div>
            </form>
        </div>
        <div class="facebook-comment" >
        	<div class="fb-comments" data-href="<?php echo Common::curPageURL();?>"
        		data-numposts="5" data-colorscheme="light"></div>
        </div>
    </div>
    <div class="right">
        <?php include APPPATH.VIEW_PATH.'/many_view_time.php'; ?>
    </div>
	<div class="right clear-bg">
		<ul class="link-shortcut">
			<li><a href="/timeline/rang-sua"><img alt="" src="/img/link_RS.fw.png"></a></li>
			<li><a href="/timeline/rang-vinh-vien"><img alt="" src="/img/link_RVV.fw.png"></a></li>
			<li style="display: <?php echo  isset(Common::getCurrentUser()->id) ? "block" : 'none'; ?>"><a href="/profile/<?php echo Common::getCurrentUser()->id; ?>/ho-so-rang-mieng"><img alt="" src="/img/link_hsrm.fw.png"></a></li>
			<li style="display: <?php echo  isset(Common::getCurrentUser()->id) ? "block" : 'none'; ?>"><a href="/profile/<?php echo Common::getCurrentUser()->id;?>/tuoi-moc-rang"><img alt="" src="/img/link_tmr.fw.png"></a></li>
		</ul>
	</div>
	<div class="left" style="width:580px;min-height:0px">
		<div class="left-head" style="width:580px">Liên quan</div>
		<div class="post-refer" >
			<ul>
                <?php
    				foreach ( $manyViewPosts as $referPost ) {
    					$referPost->thumbnail = strpos ( $referPost->thumbnail, 'http' ) !== false ? $referPost->thumbnail : '/thumbnail.php' . $referPost->thumbnail . "?140";
    					
    					//if ($referPost->id != $post->id) {
    						$url = "{$referPost->part_url}-{$referPost->id}.html";
    						echo "<li><a href='{$url}'>{$referPost->title}</a></li>";
    					//}
    				}
				?>
            </ul>
		</div>
	</div>
    
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#btn-create-question").click(function(){
		var frm_valid = $("#frm-create-question").validate();
		if(frm_valid.errors.length == 0){
			$("#frm-create-question").submit();
		}
	});
});
</script>