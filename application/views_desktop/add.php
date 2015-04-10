<div class="body-content width-960">
    <script type="text/javascript">
         var addConfig = <?php echo $configCategory;?>;
    </script>
	<div class="detail-view add-post-view width-960"
		ng-controller="AddController">
		<form id="add-frm" novalidate method="post"
			enctype="multipart/form-data">
			<div class="form-group col-md-12">
				<label>Danh mục</label> <select name="category" class="form-control"
					ng-model="category" ng-change="changeCategory()">
					<option ng-show="category.visible == 1"
						ng-repeat="category in childCategories" value="{{category.id}}">{{category.name}}</option>
				</select>
			</div>

			<div class="form-group col-md-12">
				<label for="txtTitle">Tiêu đề </label> <input type="text"
					id="txtTitle" name="txtTitle" required
					class="validate-text-only form-control"
					placeholder="Nhập thông tin tiêu đề">
			</div>
			<div ng-include="PostTemplate"></div>
		</form>
	</div>
</div>

<script type="text/ng-template" id="addPost.html">
    <?php include APPPATH.VIEW_PATH.'/addPost.php'; ?>
</script>
<script type="text/ng-template" id="addVideo.html">
    <?php include APPPATH.VIEW_PATH.'/addVideo.php'; ?>
</script>
<script type="text/ng-template" id="addGame.html">
    <?php include APPPATH.VIEW_PATH.'/addGame.php'; ?>
</script>