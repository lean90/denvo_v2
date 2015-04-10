<div class="body-content width-960">
	<div class="scrum-map width-960px">
		<div class="current-page">Trang thông tin cá nhân</div>
	</div>
	<div class="detail-view post-view width-960">
		<div class="left">
			<form id="edit-user-frm" method="post" enctype="multipart/form-data">
				<div class="form-group col-md-4">
					<img height="140px" width="140px" alt=""
						src="<?php echo $me->avartar; ?>">
				</div>
				<div class="form-group col-md-8">
					<label for="thumbnail">Thay đổi ảnh đại diện </label> <input
						id="thumbnail" name="client-avatar"
						accept="image/x-png, image/jpeg, image/png, image/jpg" type="file"
						class="form-control" placeholder="Ảnh đại diện"> <input
						name="client-avatar" type="hidden"
						value="<?php echo $me->avartar; ?>" />
					<p class="help-block">Khuyến cáo : bạn nên up ảnh với tỷ lệ 1x1.</p>
				</div>
				<div class="form-group col-md-8">
					<label for="">Họ tên đầu đủ </label> <input id="" name="fullname"
						required class="form-control" type="text"
						value="<?php echo $me->full_name; ?>" />
				</div>
				<div class="form-group col-md-6">
					<label for="client-pw">Mật khẩu</label> <input id="client-pw"
						name="client-pw" type="password" minlength="6" maxlength="56"
						required aria-required="true" class="form-control"
						placeholder="Mật khẩu">
					<p class="help-block">Mật khẩu từ 6 - 56 ký tự</p>
				</div>
				<div class="form-group col-md-6">
					<label for="re-password">Nhập lại mật khẩu</label> <input
						id="re-password" equalTo="#client-pw" type="password"
						minlength="6" maxlength="56" required aria-required="true"
						class="form-control" placeholder="Nhập lại mật khẩu">
					<p class="help-block">&nbsp;</p>
				</div>
				<div class="form-group col-md-6">
					<label for="">Giới tính </label> <select name="gender"
						class="form-control">
						<option <?php echo $me->gender == 'MALE' ? 'selected' : '';?>
							value="MALE">Nam</option>
						<option <?php echo $me->gender == 'FMALE' ? 'selected' : '';?>
							value="FMALE">Nữ</option>
						<option <?php echo $me->gender == 'OTHER' ? 'selected' : '';?>
							value="OTHER">Khác</option>
					</select>
				</div>
				<div class="form-group col-md-6">
					<label for="">Ngày sinh </label> <input id="dob" name="dob"
						required type="text" class="form-control"
						data-inputmask="'alias': 'dd/mm/yyyy'" data-mask=""
						value="<?php echo DateTime::createFromFormat(DatabaseFixedValue::DEFAULT_FORMAT_DATE, $me->dob)->format('d/m/Y');?>" />
				</div>
				<div class="box-footer col-xs-12 text-center"
					style="display: inline-block;">
					<button id="btnSubmit" class="btn btn-primary">Cập nhật thông tin
						tài khoản</button>
				</div>
			</form>
		</div>
		<div class="right">
                <?php include APPPATH.'views/many_view_time.php';?>
            </div>
	</div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        var $editUserFrm = $("#edit-user-frm").validate();
        $("#btnSubmit").click(function(){
            if($editUserFrm.errorList.length == 0){
                $("#edit-user-frm").submit();
            }
        });
    });
</script>