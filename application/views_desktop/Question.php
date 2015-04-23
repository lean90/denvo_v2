<script type="text/javascript">
  var question = <?php echo json_encode($question) ?>;
  var answers = <?php echo json_encode($answers) ?>;
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
        <div class="question left" ng-controller="QuestionController" style="background: white">
            <div class="question-item">
                <a ng-cloak style="float:right" ng-show="(me.account_role == 'ADMIN' || me.account_role == 'COLLABORATORS') && question.q_status != 1" ng-href="/question/public/{{question.id}}">Cho phép</a>
                <table class="q-detail">
                    <tr class="question">
                        <td class="q-icon">
                            <img alt="" ng-src="{{question.user.avartar == undefined && '/img/question-default.png' || question.user.avartar }}" />
                        </td>
                        <td class="q-des">
                            <p class="name">
                                {{question.question}}
                                
                            </p>
                        </td>
                    </tr>
                    <tr class="answers">
                        <td class="q-icon" style="text-align: center;">
                            <img alt="" width="41px"  src="/img/answers.fw.png" />
                        </td>
                        <td class="q-des">
                            
                            <p class="answer-detail">
                                {{getFullName()}}
                            </p>
                            <p class="more-info">
                                {{answers.length}} câu trả lời · {{question.friendly_time}}<br/>
                                <a ng-show="me.account_role == 'ADMIN' || me.account_role == 'COLLABORATORS' " ng-href="/question/delete/{{question.id}}">Xóa</a>
                                <a ng-show="me.account_role == 'ADMIN' || me.account_role == 'COLLABORATORS' " ng-href="/questions/set-to-most/{{question.id}}"> | Câu hỏi thường gặp</a>
                                <a ng-show="me.account_role == 'ADMIN' || me.account_role == 'COLLABORATORS' " ng-href="/questions/remove-to-most/{{question.id}}"> | Bỏ câu hỏi thường gặp</a>
                                
                            </p>
                        </td>
                    </tr>
                    <tr class="image-row">
                        <td></td>
                        <td class=''>
                            <ul>
                                <li ng-click="showDetailImage('#attached_img_1')" ng-show="question.attached_img_1 != '' && question.attached_img_1 != null && question.attached_img_1 != undefined"><a href="#"><img ng-src="{{question.attached_img_1}}" /><p>Ảnh đính kèm 1</p></a></li>
                                <li ng-click="showDetailImage('#attached_img_2')" ng-show="question.attached_img_2 != '' && question.attached_img_1 != null && question.attached_img_1 != undefined"><a href="#"><img ng-src="{{question.attached_img_2}}" /><p>Ảnh đính kèm 2</p></a></li>
                                <li ng-click="showDetailImage('#attached_img_3')" ng-show="question.attached_img_3 != '' && question.attached_img_1 != null && question.attached_img_1 != undefined "><a href="#"><img ng-src="{{question.attached_img_3}}" /><p>Ảnh đính kèm 3</p></a></li>
                            </ul>
                            
                            <div id='attached_img_1' class="modal fade">
                              <div class="modal-dialog"  style="width: 80%;">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" style="text-align: center;">Ảnh đính kèm 1</h4>
                                  </div>
                                  <div class="modal-body" style="text-align: center;">
                                     <img style="max-width: 100%" ng-src="{{question.attached_img_1}}" />
                                  </div>
                                </div><!-- /.modal-content -->
                              </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                            
                            <div id='attached_img_2' class="modal fade" >
                              <div class="modal-dialog" style="width: 80%;">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" style="text-align: center;">Ảnh đính kèm 2</h4>
                                  </div>
                                  <div class="modal-body" style="text-align: center;">
                                    <img style="max-width: 100%" ng-src="{{question.attached_img_2}}" />
                                  </div>
                                </div><!-- /.modal-content -->
                              </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                            
                            <div id='attached_img_3' class="modal fade">
                              <div class="modal-dialog" style="width: 80%;">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" style="text-align: center;">Ảnh đính kèm 3</h4>
                                  </div>
                                  <div class="modal-body" style="text-align: center;">
                                    <img style="max-width: 100%" ng-src="{{question.attached_img_3}}" />
                                  </div>
                                </div><!-- /.modal-content -->
                              </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </td>
                    </tr>
                </table>
            </div>
            <div class="answer-item" ng-class="{'left':$index % 2 == 0,'right':$index % 2 != 0}" ng-repeat="answer in answers">
                <table class="a-detail">
                    <tr class="answers">
                        <td class="a-icon">
                            <img alt="" ng-src="{{answer.user.avartar}}" />
                        </td>
                        <td class="a-des" style="padding: 5px">
                            <p class="name">
                               <a href="">{{answer.user.full_name}} : </a> {{answer.answer}}
                            </p>
                            <p class="more-info">
                                <a ng-href="{{get_like_link(answer)}}"><img src="/img/icon-like-answer.fw.png"/> {{answer.total_like_number}} Lượt thích</a> · {{answer.friendly_time}}
                            </p>
                            <a ng-show="me.account_role == 'ADMIN' || me.account_role == 'COLLABORATORS' " ng-href="/answer/remove/{{answer.id}}">Xóa câu trả lời</a>
                        </td>
                    </tr>
                </table>
            </div>
            
            <div class="create-question" ng-show="me.id != undefined" >
                <br/>
                <form id="frm-replay" action="" method="post">
                    <textarea name="answer" rows="" cols="" class="form-control" placeholder="Câu trả lời"></textarea>
                    <div class="btn-container">
                        <button id="btn-replay" class="btn btn-primary">Trả lời</button>
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
    			<li style="display: <?php echo  isset(Common::getCurrentUser()->id) ? "block" : 'none'; ?>">
    			<a href="/profile/<?php echo Common::getCurrentUser()->id; ?>/ho-so-rang-mieng"><img alt="" src="/img/link_hsrm.fw.png"></a></li>
    		</ul>
    	</div>
        <div class="left" style="width:580px;min-height:0px">
        <div class="left-head" style="width:580px">Liên quan</div>
		  <div class="post-refer" >
			<ul>
                <?php
    				foreach ( $manyViewPosts as $referPost ) {
    					$referPost->thumbnail = strpos ( $referPost->thumbnail, 'http' ) !== false ? $referPost->thumbnail : '/thumbnail.php' . $referPost->thumbnail . "?140";
    						$url = "{$referPost->part_url}-{$referPost->id}.html";
    						echo "<li><a href='{$url}'>{$referPost->title}</a></li>";
    				}
				?>
            </ul>
		</div>
	</div>
     </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#btn-replay").click(function(){
	    $("#frm-replay").submit();
	});
});
</script>