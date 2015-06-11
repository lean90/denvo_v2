<script type="text/javascript">
$(document).ready(function(){
	$("#add-new-question").on('click',function(){
		 $('html, body').animate({
             scrollTop: $(".create-question").offset().top - 150
         }, 2000);
	});
});
</script>
<div class="question body-content width-960" ng-controller="QuestionsController">
    <a id="add-new-question" style="position: fixed;bottom: 20px;right: 20px;">
        <img alt="" src="/img/add.png">
    </a>
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
    <div class="tab-title">{{tabtitle}}</div>
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
                        <p class="answers">
                            {{question.full_name}}
                        </p>
                    </td>
                </tr>
                <tr class="answers">
                    <td class="q-icon">
                        <img alt="" src="/img/answers.fw.png" />
                    </td>
                    <td class="q-des">
                        <p class="name">
                            <img style="width: 36px;" src="/img/icon-like-answer.fw.png"/> Câu trả lời hay nhất:
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
        <p> Đặt câu hỏi  </p>
        <form id ="frm-create-question" method="post" novalidate="novalidate" enctype="multipart/form-data">
            <input name="full_name" required="required" type="text" value="<?php echo Common::getCurrentUser()->full_name;?>" class="form-control" placeholder="Họ và tên" />
            <input name="email" required="required" type="email" value="<?php echo strpos(Common::getCurrentUser()->email,'@') !== false ? Common::getCurrentUser()->email : "";?>" class="form-control" placeholder="Email" />
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