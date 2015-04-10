<div class="body-content"
	style="margin-top: 100px; margin-bottom: 100px; width: 500px">
	<div class="box box-primary box-info">
		<div class="box-header" title="">
			<h3 class="box-title">Thiết lập mật khẩu</h3>
		</div>
		<div class="box-body text-left" style="display: inline-block;">
            <form id="frm-send-email" method="post">
                <input type="hidden" name="user-id" value="<?php echo $userId;?>"/>
				<div class="form-group col-xs-12" style="padding: 0px">
					<input style="width: 480px" id="password" minlength="6" maxlength="56" name="password" type="password" required aria-required="true" class="form-control" placeholder="Mật khẩu">
					<br/>
					<input style="width: 480px" equalto="#password" minlength="6" maxlength="56" id="re-password" name="re-password" type="password" required aria-required="true" class="form-control" placeholder="Nhập lại mật khẩu">
				</div>
			</form>
		</div>
		<div class="box-footer text-center">
			<a href="/home" class="btn">Trở về trang chủ</a>
			<button id="btn-send-email" class="btn btn-primary">Xác nhận</button>
		</div>
	</div>
</div>
<script type="text/javascript">
   var error =  <?php echo isset($error) ? "true" : "false"; ?>;
   if(error){
        alert("Yêu cầu thiết lập lại mật khẩu của bạn đã hết hạn hoặc đã được sử dụng.");
        window.location = "/";
   }
   var ok = <?php echo isset($ok) ? "true" : "false"; ?>;
   if(ok){
       alert("Bạn đã thay đổi mật khẩu thành công");
       window.location = "/";
   }
    $(document).ready(function(){
        $("#btn-send-email").on('click',function(){
        var valid =  $("#frm-send-email").validate();
        if(valid.errorList.length == 0){
            $("#frm-send-email").submit();
            }
        });
    });

</script>