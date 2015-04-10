
<section class="content-header">
	<h1>
		Setting <small>Cấu hình hệ thống</small>
	</h1>
</section>

<!-- Main content -->
<section class="content">
	<div class="col-md-6">
		<div class="box box-danger">
			<div class="box-header">
				<i class="fa fa-warning"></i>
				<h3 class="box-title">Banner</h3>
			</div>
			<div class="box-body">
				<form id="frm-banner" action="/__admin/setting/save_banner"
					method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="exampleInputEmail1">Banner Image 1</label> <input
							name="banner-1" type="file" class="form-control"> <input
							name="banner-1-hidden" type="hidden"
							value="<?php echo $banners[0]->value;?>" />
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Banner image 2</label> <input
							name="banner-2" type="file" class="form-control"> <input
							name="banner-2-hidden" type="hidden"
							value="<?php echo $banners[1]->value;?>" />
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Banner image 3</label> <input
							name="banner-3" type="file" class="form-control"> <input
							name="banner-3-hidden" type="hidden"
							value="<?php echo $banners[2]->value;?>" />
					</div>
					
					<div class="form-group">
						<label for="exampleInputEmail1">Banner image 1 ( Mobile )</label> 
						<input name="mobile-banner-1" type="file" class="form-control"> 
						<input name="mobile-banner-1-hidden" type="hidden" value="<?php echo $mobile_banners[0]->value;?>" />
					</div>
					
					<div class="form-group">
						<label for="exampleInputEmail1">Banner image 2 ( Mobile )</label> 
						<input name="mobile-banner-2" type="file" class="form-control"> 
						<input name="mobile-banner-2-hidden" type="hidden" value="<?php echo $mobile_banners[0]->value;?>" />
					</div>
					
					<div class="form-group">
						<label for="exampleInputEmail1">Banner image 3 ( Mobile )</label> 
						<input name="mobile-banner-3" type="file" class="form-control"> 
						<input name="mobile-banner-3-hidden" type="hidden" value="<?php echo $mobile_banners[0]->value;?>" />
					</div>
					
					<div class="form-group">
						<button id="frm-banner-submit" type="button"
							class="btn btn-primary">Cập nhật banner</button>
					</div>
				</form>
			</div>
			<!-- /.box-body -->
		</div>

		<div class="box box-danger">
			<div class="box-header">
				<i class="fa fa-warning"></i>
				<h3 class="box-title">Đường dẫn banner</h3>
			</div>
			<div class="box-body">
				<form id="frm-banner-url" action="/__admin/setting/save_banner_url"
					method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="exampleInputEmail1">Đường dẫn banner 1</label> <input
							name="banner-1" required type="text" class="form-control"
							value="<?php echo $bannerUrls[0]->value; ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Đường dẫn banner 2</label> <input
							name="banner-2" required type="text" class="form-control"
							value="<?php echo $bannerUrls[1]->value; ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Đường dẫn banner 3</label> <input
							name="banner-3" required type="text" class="form-control"
							value="<?php echo $bannerUrls[2]->value; ?>">
					</div>
					<div class="form-group">
						<button id="frm-banner-url-submit" type="button"
							class="btn btn-primary">Cập nhật banner</button>
					</div>
				</form>
			</div>
			<!-- /.box-body -->
		</div>

		<div class="box box-danger">
			<div class="box-header">
				<i class="fa fa-warning"></i>
				<h3 class="box-title">Video home</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<form id="frm-home-video" action="/__admin/setting/save_home_video"
					method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="exampleInputEmail1">Video</label> <input
							name="home-video" type="url" class="form-control"
							id="exampleInputEmail1" value="<?php echo $homeVideo->value; ?>"
							placeholder="Nhập đường dẫn youtube">
					</div>
					<div class="form-group">
						<button id="frm-home-video-submit" type="button"
							class="btn btn-primary">Cập nhật video home</button>
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
				<h3 class="box-title">GAMES</h3>
			</div>
			<div class="box-body">
				<form id="frm-game" action="/__admin/setting/save_game"
					method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="exampleInputEmail1">Game 1</label> <input
							name="game-1" required type="text" class="form-control"
							value="<?php echo $games[0]->value; ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Game 2</label> <input
							name="game-2" required type="text" class="form-control"
							value="<?php echo $games[1]->value; ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Game 3</label> <input
							name="game-3" required type="text" class="form-control"
							value="<?php echo $games[2]->value; ?>">
					</div>
					<div class="form-group">
						<button id="frm-game-submit" type="button" class="btn btn-primary">Cập
							nhật game</button>
					</div>
				</form>
			</div>
			<!-- /.box-body -->
		</div>
	</div>

</section>
<script type="text/javascript">
    $(document).ready(function(){
        $("#frm-banner-submit").click(function(){
            $("#frm-banner").submit();
        });
        $("#frm-banner-url-submit").click(function(){
            $validate = $("#frm-banner-url").validate();
            if($validate.errorList == 0){
                $("#frm-banner-url").submit();
            }
        });
        $("#frm-home-video-submit").click(function(){
            $validate = $("#frm-home-video").validate();
            if($validate.errorList == 0){
                $("#frm-home-video").submit();
            }
        });
        $("#frm-gk-submit").click(function(){
            $validate = $("#frm-gk").validate();
            if($validate.errorList == 0){
                $("#frm-gk").submit();
            }
        });
        
        $("#frm-product-submit").click(function(){
            $validate = $("#frm-product").validate();
            if($validate.errorList == 0){
                $("#frm-product").submit();
            }
        });
        
        $("#frm-game-submit").click(function(){
            $validate = $("#frm-game").validate();
            if($validate.errorList == 0){
                $("#frm-game").submit();
            }
        });
    });
</script>
<!-- /.content -->

