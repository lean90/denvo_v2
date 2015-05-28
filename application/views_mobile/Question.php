
<script type="text/javascript">
  var question = <?php echo json_encode($question) ?>;
  var answers = <?php echo json_encode($answers) ?>;
</script>
<div class="question body-content width-960" ng-controller="QuestionController">
    <div class="question-item">
        <a ng-cloak style="float: right" ng-show="(me.account_role == 'ADMIN' || me.account_role == 'COLLABORATORS') && question.q_status != 1" ng-href="/question/public/{{question.id}}">Cho phép</a>
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
                <td class="q-icon"></td>
                <td class="q-des">
                    <p class="answer-detail">
                        {{getFullName()}}
                    </p>
                    <p class="more-info">
                        {{answers.length}} câu trả lời · {{question.friendly_time}}
                    </p>
                </td>
            </tr>
            <tr class="image-row">
                <td></td>
                <td class=''>
                    <ul>
                        <li ng-click="showDetailImage('#attached_img_1')" ng-show="question.attached_img_1 != '' && question.attached_img_1 != null && question.attached_img_1 != undefined"><a href="#"><img ng-src="{{question.attached_img_1}}" /></a></li>
                        <li ng-click="showDetailImage('#attached_img_2')" ng-show="question.attached_img_2 != '' && question.attached_img_1 != null && question.attached_img_1 != undefined"><a href="#"><img ng-src="{{question.attached_img_2}}" /></a></li>
                        <li ng-click="showDetailImage('#attached_img_3')" ng-show="question.attached_img_3 != '' && question.attached_img_1 != null && question.attached_img_1 != undefined "><a href="#"><img ng-src="{{question.attached_img_3}}" /></a></li>
                    </ul>
                    
                    <div id='attached_img_1' class="modal fade">
                      <div class="modal-dialog" >
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
                      <div class="modal-dialog" >
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
                      <div class="modal-dialog">
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
    <div class="answer-item" class="left" ng-repeat="answer in answers">
        <table class="a-detail">
            <tr class="answers">
                <td class="a-icon" >
                    <img alt="" ng-src="{{answer.user.avartar}}" />
                </td>
                <td class="a-des">
                    <p class="name">
                       {{answer.answer}}
                    </p>
                    <p style="font-size: 25px;color: #A5A6B2;font-style: italic;">{{answer.user.full_name}}</p> 
                    <p class="more-info">
                        <a ng-href="{{get_like_link(answer)}}"><img src="/img/icon-like-answer.fw.png"/> {{answer.total_like_number}} Lượt thích</a> · {{answer.friendly_time}}
                    </p>
                    
                </td>
            </tr>
        </table>
    </div>
    
    <div class="create-question" ng-show="me.id != undefined" >
        <form id="frm-replay" action="" method="post">
            <textarea name="answer" rows="" cols="" class="form-control" placeholder="Câu trả lời"></textarea>
            <div class="btn-container">
                <button id="btn-replay" class="btn btn-primary">Trả lời</button>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#btn-replay").click(function(){
	    $("#frm-replay").submit();
	});
});
</script>