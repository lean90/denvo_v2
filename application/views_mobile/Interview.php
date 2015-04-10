<form id="send-interview-frm" method="post" novalidate
	enctype="multipart/form-data">
	<div class="form-group col-md-8">
		<label for="">Họ tên đầu đủ </label> <input id="" name="fullname"
			required class="form-control" type="text" value="" />
	</div>
	<div class="form-group col-md-8">
		<label for="">Email </label> <input id="" name="email" required
			class="form-control" type="email" value="" />
	</div>
	<div class="form-group col-md-8">
		<label for="">Mô tả bản thân </label>
		<textarea id="" name="description" required class="form-control"
			type="" value=""></textarea>
	</div>
	<div class="form-group col-md-8">
		<label for="">Sơ yếu lý lịch đính kèm </label> <input id="" name="cv"
			required class="form-control" type="file" value="" />
	</div>
	<div class="box-footer col-xs-12 text-left"
		style="display: inline-block;">
		<button id="send-interview-frm-submit" class="btn btn-primary">Gửi CV</button>
	</div>
</form>
<style type="text/css">
html,body {
	margin: 0px;
	padding: 0px;
	min-width: 100px;
	min-height: 100px !important;
}
</style>
<script type="text/javascript">
    $(document).ready(function(){
        var $sendInterviewFrmValidate = $("#send-interview-frm").validate();
        $("#send-interview-frm-submit").click(function(){
            if($sendInterviewFrmValidate.errorList.length == 0){
                $("#send-interview-frm").submit();
            }
        });
    });
</script>
