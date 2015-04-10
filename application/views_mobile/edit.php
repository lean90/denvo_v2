<div class="body-content width-960">
    <?php include APPPATH.'views/scrummap.php';?>
    <script type="text/javascript">
         var editPost = <?php echo json_encode($post);?>;
         var editTag = <?php echo json_encode($tags);?>;
         var editCategory = <?php echo json_encode($category);?>;
    </script>
	<div class="detail-view add-post-view width-960"
		ng-controller="EditController">
		<form id="edit-frm" novalidate method="post"
			enctype="multipart/form-data">
			<input id="id" name="post_id" type="hidden" value="{{post.id}}" />
			<div class="form-group col-md-12">
				<label>Danh mục</label> <select class="form-control"
					ng-model="selectedCategory"
					ng-options="i.id as i.name for i in allowCategories"></select> <input
					name="category" type="hidden" value="{{selectedCategory}}" />
			</div>

			<div class="form-group col-md-12">
				<label for="txtTitle">Tiêu đề </label> <input type="text"
					ng-model="post.title" id="txtTitle" name="txtTitle" required
					class="validate-text-only form-control"
					placeholder="Nhập thông tin tiêu đề">
			</div>
			<div ng-include="PostTemplate"></div>
		</form>
	</div>
</div>

<script type="text/ng-template" id="editPost.html">
    <?php include APPPATH.'views/editPost.php'; ?>
</script>
<script type="text/ng-template" id="editVideo.html">
    <?php include APPPATH.'views/editVideo.php'; ?>
</script>
<script type="text/ng-template" id="editGame.html">
    <?php include APPPATH.'views/editGame.php'; ?>
</script>