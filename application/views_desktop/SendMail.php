<style type="text/css">
html,body {
	margin: 0px;
	padding: 0px;
	padding-top: 10px;
	min-width: 100px;
	min-height: 100px !important;
}
</style>
<form id="send-mail-frm" class="col-md-12" method="post" novalidate
	enctype="multipart/form-data" ng-controller="SendMailController">

	<div class="form-group col-md-12">
		<label for="inputEmail3" class="col-md-12 control-label text-left">Gửi
			đến</label>
		<div class="col-md-12">
			<input id="txtTo" name="to" disabled="true" type="email"
				class="form-control"
				value="<?php echo get_instance()->config->item('ContactMailler'); ?>"
				placeholder="Nhập địa chỉ mail">
		</div>
	</div>
	<div class="form-group col-md-12">
		<label for="inputEmail3" class="col-md-12 control-label text-left">Họ
			tên đầy đủ</label>
		<div class="col-md-12">
			<input id="txtFullname" name="fullname" type="text" required
				aria-required="true" class="form-control"
				placeholder="Nhập họ tên đầy đủ">
		</div>
	</div>
	<div class="form-group col-md-12">
		<label for="inputEmail3" class="col-md-12 control-label text-left">Email
			liên hệ</label>
		<div class="col-md-12">
			<input id="txtemail" name="email" type="email" required
				aria-required="true" class="form-control"
				placeholder="Nhập email liên hệ">
		</div>
	</div>
	<div class="form-group col-md-12">
		<label for="inputEmail3" class="col-md-12 control-label text-left">Nội
			dung mail</label>
		<div class="col-md-12">
			<textarea id="txtContent" name="content">
                
            </textarea>
		</div>
	</div>
	<div class="form-group col-md-12">
		<div class="col-md-12 text-center">
			<button id="send-mail-frm-submit" class="btn btn-primary">Gửi email</button>
		</div>
	</div>

</form>
<script type="text/javascript">
    $(document).ready(function(){
        CKEDITOR.replace('txtContent',{
            toolbar : [
			{ name: 'basicstyles', items : [ 'Bold','Italic' ] },
			{ name: 'paragraph', items : [ 'NumberedList','BulletedList' ] },
			{ name: 'tools', items : [ 'Maximize','-' ] }
                    ],
            height : '225px',
            width: '100%',
            language : 'vi'
        });    
        
        $("#send-mail-frm-submit").click(function(){
            var $frm = $("#send-mail-frm").validate();
            if($frm.errorList.length == 0){
                $($frm).submit();
            }
        });
        
    });
    
</script>
