
<form id="resgitor-window-frm" action="/register/pf" method="post"
	enctype="multipart/form-data">
	<input id="url" name="url" type="hidden" />
	<div class="model-dialog resg-window">
		<div class="box box-primary" style="display: inline-block;">
			<div class="box-header" title="">
			</div>
			<div class="box-body col-xs-12" style="display: inline-block;">
				<div id="alert-email-exist"
					class="alert alert-danger alert-dismissable" style="display: none">
					<i class="fa fa-ban"></i>
					<button type="button" class="close" data-dismiss="alert"
						aria-hidden="true">×</button>
					Địa chỉ mail đã được sử dụng.
				</div>
				<div class="form-group col-xs-12">
					<label for="client-us">Email address</label> <input id="client-us"
						name="client-us" type="email" required aria-required="true"
						class="form-control" placeholder="Enter email">
				</div>
				<div class="form-group col-xs-12">
					<label for="client-pw">Mật khẩu</label> <input id="client-pw"
						name="client-pw" type="password" minlength="6" maxlength="56"
						required aria-required="true" class="form-control"
						placeholder="Mật khẩu">
					<p class="help-block">Mật khẩu từ 6 - 56 ký tự</p>
				</div>
				<div class="form-group col-xs-12">
					<label for="re-password">Nhập lại mật khẩu</label> <input
						id="re-password" equalTo="#client-pw" type="password"
						minlength="6" maxlength="56" required aria-required="true"
						class="form-control" placeholder="Nhập lại mật khẩu">
				</div>
				<div class="form-group col-xs-12"></div>
				<div class="form-group col-xs-12">
					<label for="fullname">Họ và tên</label> <input id="fullname"
						name="fullname" type="text" class="form-control" required
						aria-required="true" placeholder="Họ và tên" />
				</div>
				<div class="form-group col-xs-12">
					<label for="dob">Ngày sinh</label> <input id="dob" name="dob"
						required type="text" class="form-control"
						data-inputmask="'alias': 'dd/mm/yyyy'" data-mask=""
						placeholder="Ngày/Tháng/Năm" />
				</div>
				<div class="form-group col-xs-12">
					<label for="dob">Giới tính</label> 
					<select name="gender" class="form-control">
						<option value="MALE">Nam</option>
						<option value="FMALE">Nữ</option>
						<option value="OTHER">Khác</option>
					</select>
				</div>
				<div class="form-group col-xs-12">
					<label for="avatar">Ảnh đại diện</label> 
					<input name="client-avatar" accept="image/*" type="file" id="avatar" />
				</div>

				<div class="form-group col-xs-12">
					<input id="chkagree" name="chkagree" type="checkbox" class="simple" style="width:" required />
						<label for="chkagree">
							Tôi đồng ý với <a href="/gioi-thieu/dieu-khoan-su-dung-200.html">điều
								khoản sử dùng <a /> của website. 
						</label>
                </div>
				<div>
			</div>
			<div class="box-footer col-xs-12 text-right"
				style="display: inline-block;">
				<button id="btn-registor" data-type="submit"
					class="btn btn-primary">Đăng ký</button>
			</div>
		</div>
	</div>
</form>
<script type="text/javascript">
$(document).ready(function(){
    $("#btn-registor").on('click',function(){
        var validResult = $('#resgitor-window-frm').validate();
        if(validResult.errorList.length == 0){
            $("#resgitor-window-frm").submit();
            }
    });
});
</script>
