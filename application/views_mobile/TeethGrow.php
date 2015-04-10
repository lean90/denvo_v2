<style type="text/css">
.css-form input.ng-invalid.ng-dirty {
	background-color: #FA787E;
}

.css-form input.ng-valid.ng-dirty {
	background-color: #78FA89;
}
</style>
<script type="text/javascript">
    var histories = <?php echo json_encode($histories);?>;
</script>
<div class="body-content width-960" ng-controller="TeethGrowController">
	<form id="profile-support-frm"
		action="/profile/<?php echo $userid?>/tuoi-moc-rang/send_support"
		novalidate method="post" enctype="multipart/form-data">
		<input name="data" type="hidden" value="{{getPostDataForSupport()}}" />
	</form>

	<form id="profile-support-response-frm"
		action="/profile/<?php echo $userid?>/tuoi-moc-rang/response_support"
		novalidate method="post" enctype="multipart/form-data">
		<input name="data" type="hidden" value="{{getSupportFrmData()}}" />
	</form>


	<form id="profile-frm" novalidate method="post" enctype="multipart/form-data">

		<input name="data" type="hidden" value="{{getPostData()}}" /> <input
			name="send" type="hidden" value="{{isSendEmail}}" />
		<div class="detail-view post-view width-960">
			<div class="left">
				<div class="head">Tuổi mọc răng</div>
				<a href="#" ng-click="showCreateFrm()" class="btn btn-primary"
					ng-show="!onCreateNewProfile"> <i
					class="glyphicon glyphicon-plus-sign"></i> &nbsp; Thêm hồ sơ
				</a>
                    <?php include APPPATH.'views/TeethGrowNew.php'; ?>
                    <div class="panel-group" id="accordion"
					style="margin-top: 15px">
					<div class="panel panel-default" ng-repeat="history in histories">
						<div class="panel-heading" style="border-radius: 0px;">
							<h4 class="panel-title" ng-click="changeSelectedProfile(history)"
								data-toggle="collapse" data-parent="#accordion"
								href="#collapse{{history.id}}" style="cursor: pointer">
								<a> {{history.full_name}} ({{history.dob}}) </a>
							</h4>
						</div>
						<div id="collapse{{history.id}}" class="panel-collapse collapse">
							<div class="panel-body"
								ng-show="selectedHistoryTemplate == 'view.html'"
								style="padding: 10px 0px 10px 0px" ng-include="'view.html'"></div>
							<div class="panel-body"
								ng-show="selectedHistoryTemplate == 'edit.html'"
								style="padding: 10px 0px 10px 0px" ng-include="'edit.html'"></div>
						</div>
					</div>
				</div>

			</div>
			<div class="right">
			    <div class="right-item">
                    <?php include APPPATH.'views/many_view_time.php'; ?>
                </div>
			</div>
		</div>
	</form>
</div>
<script type="text/ng-template" id="view.html">
    <?php include APPPATH.'views/TeethGrowDetail.php'; ?>
</script>
<script type="text/ng-template" id="edit.html">
    <?php include APPPATH.'views/TeethGrowEdit.php'; ?>
</script>

<script type="text/javascript">
    $(document).ready(function(){
       if(me.account_role == undefined || me.account_role == 'USER' ){
           $("#addbtn").hide();
       }
        
    });
</script>



