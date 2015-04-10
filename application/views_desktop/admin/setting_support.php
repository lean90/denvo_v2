
<section class="content-header">
	<h1>
		Setting <small>Chỉnh sửa phân quyền cộng tác viên</small>
	</h1>
</section>

<!-- Main content -->
<section class="content">
	<div class="col-md-6">
		<div class="box box-danger">
			<div class="box-header">
				<i class="fa fa-warning"></i>
				<h3 class="box-title">Nhà quản trị 1</h3>
			</div>
			<div class="box-body">
				<form id="frm-banner" action="/__admin/setting_support/17"
					method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="exampleInputEmail1">Tài khoản </label> <input
							name="email" type="text" class="form-control"
							value="<?php echo $setting_support[0]->user->email; ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Đường dẫn Facebook</label> <input
							name="facebook-url" type="url" class="form-control"
							value="<?php echo $setting_support[0]->facebookUrl; ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Tài khoản Viber</label> <input
							name="viber-account" required type="text" class="form-control"
							value="<?php echo $setting_support[0]->viberAccount; ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Tài khoản Skype</label> <input
							name="skype-account" required type="text" class="form-control"
							value="<?php echo $setting_support[0]->skypeAccount; ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Tài khoản Yahoo</label> <input
							name="yahoo-account" required type="text" class="form-control"
							value="<?php echo $setting_support[0]->yahooAccount; ?>">
					</div>
					<div class="form-group">
						<button data-type="btn-submit" type="button"
							class="btn btn-primary">Cập nhật</button>
					</div>
				</form>
			</div>
			<!-- /.box-body -->
		</div>
		<div class="box box-danger">
			<div class="box-header">
				<i class="fa fa-warning"></i>
				<h3 class="box-title">Nhà quản trị 2</h3>
			</div>
			<div class="box-body">
				<form id="frm-banner" action="/__admin/setting_support/18"
					method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="exampleInputEmail1">Tài khoản </label> <input
							name="email" type="text" class="form-control"
							value="<?php echo $setting_support[1]->user->email; ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Đường dẫn Facebook</label> <input
							name="facebook-url" type="url" class="form-control"
							value="<?php echo $setting_support[1]->facebookUrl; ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Tài khoản Viber</label> <input
							name="viber-account" required type="text" class="form-control"
							value="<?php echo $setting_support[1]->viberAccount; ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Tài khoản Skype</label> <input
							name="skype-account" required type="text" class="form-control"
							value="<?php echo $setting_support[1]->skypeAccount; ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Tài khoản Yahoo</label> <input
							name="yahoo-account" required type="text" class="form-control"
							value="<?php echo $setting_support[1]->yahooAccount; ?>">
					</div>
					<div class="form-group">
						<button data-type="btn-submit" type="button"
							class="btn btn-primary">Cập nhật</button>
					</div>
				</form>
			</div>
			<!-- /.box-body -->
		</div>
	</div>

	<div class="col-md-6">
		<div class="box box-danger">
			<div class="box-header">
				<i class="fa fa-warning"></i>
				<h3 class="box-title">Cộng tác viên 1</h3>
			</div>
			<div class="box-body">
				<form id="frm-banner" action="/__admin/setting_support/19"
					method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="exampleInputEmail1">Tài khoản </label> <input
							name="email" type="text" class="form-control"
							value="<?php echo $setting_support[2]->user->email; ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Đường dẫn Facebook</label> <input
							name="facebook-url" type="url" class="form-control"
							value="<?php echo $setting_support[2]->facebookUrl; ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Tài khoản Viber</label> <input
							name="viber-account" required type="text" class="form-control"
							value="<?php echo $setting_support[2]->viberAccount; ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Tài khoản Skype</label> <input
							name="skype-account" required type="text" class="form-control"
							value="<?php echo $setting_support[2]->skypeAccount; ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Tài khoản Yahoo</label> <input
							name="yahoo-account" required type="text" class="form-control"
							value="<?php echo $setting_support[2]->yahooAccount; ?>">
					</div>
					<div class="form-group">
						<button data-type="btn-submit" type="button"
							class="btn btn-primary">Cập nhật</button>
					</div>
				</form>
			</div>
			<!-- /.box-body -->
		</div>
		<div class="box box-danger">
			<div class="box-header">
				<i class="fa fa-warning"></i>
				<h3 class="box-title">Cộng tác viên 2</h3>
			</div>
			<div class="box-body">
				<form id="frm-banner" action="/__admin/setting_support/20"
					method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="exampleInputEmail1">Tài khoản </label> <input
							name="email" type="text" class="form-control"
							value="<?php echo $setting_support[3]->user->email; ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Đường dẫn Facebook</label> <input
							name="facebook-url" type="url" class="form-control"
							value="<?php echo $setting_support[3]->facebookUrl; ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Tài khoản Viber</label> <input
							name="viber-account" required type="text" class="form-control"
							value="<?php echo $setting_support[3]->viberAccount; ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Tài khoản Skype</label> <input
							name="skype-account" required type="text" class="form-control"
							value="<?php echo $setting_support[3]->skypeAccount; ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Tài khoản Yahoo</label> <input
							name="yahoo-account" required type="text" class="form-control"
							value="<?php echo $setting_support[3]->yahooAccount; ?>">
					</div>
					<div class="form-group">
						<button data-type="btn-submit" type="button"
							class="btn btn-primary">Cập nhật</button>
					</div>
				</form>
			</div>
			<!-- /.box-body -->
		</div>
		<div class="box box-danger">
			<div class="box-header">
				<i class="fa fa-warning"></i>
				<h3 class="box-title">Cộng tác viên 3</h3>
			</div>
			<div class="box-body">
				<form id="frm-banner" action="/__admin/setting_support/21"
					method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="exampleInputEmail1">Tài khoản </label> <input
							name="email" type="text" class="form-control"
							value="<?php echo $setting_support[3]->user->email; ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Đường dẫn Facebook</label> <input
							name="facebook-url" type="url" class="form-control"
							value="<?php echo $setting_support[3]->facebookUrl; ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Tài khoản Viber</label> <input
							name="viber-account" required type="text" class="form-control"
							value="<?php echo $setting_support[3]->viberAccount; ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Tài khoản Skype</label> <input
							name="skype-account" required type="text" class="form-control"
							value="<?php echo $setting_support[3]->skypeAccount; ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Tài khoản Yahoo</label> <input
							name="yahoo-account" required type="text" class="form-control"
							value="<?php echo $setting_support[3]->yahooAccount; ?>">
					</div>
					<div class="form-group">
						<button data-type="btn-submit" type="button"
							class="btn btn-primary">Cập nhật</button>
					</div>
				</form>
			</div>
			<!-- /.box-body -->
		</div>
	</div>

</section>
<script type="text/javascript">
    $(document).ready(function(){
        $("button[data-type=btn-submit]").click(function(){
            $validate = $(this).parents("form:first").validate();
            if($validate.errorList.length == 0){
                $(this).parents("form:first").submit();
            }
        });
        $("input[name=email]").autocomplete({
            source: admins
        });
    });
    var admins = <?php echo json_encode($admins) ?>;
</script>
<!-- /.content -->

