<div class="body-content"
	style="margin-top: 100px; margin-bottom: 100px; width: 500px">
	<div class="box box-primary box-info">
		<div class="box-body text-left" style="display: inline-block;">
            <?php if(isset($error)){?>
                <span style="color: red;"><?php echo $error?></span>
            <?php } ?>
            <?php if(isset($ok)){?>
                <span style="color: green;"><?php echo $ok?></span>
            <?php } ?>
            <form id="frm-send-email" method="post">
				<div class="form-group col-xs-12" style="padding: 0px">
					<input style="width: 480px" id="client-us" name="email"
						type="email" required aria-required="true" class="form-control"
						placeholder="Nhập địa chỉ mail">
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
$(document).ready(function(){
    $("#btn-send-email").on('click',function(){
        var valid =  $("#frm-send-email").validate();
        if(valid.errorList.length == 0){
            $("#frm-send-email").submit();
            }
        });
});
</script>