
<div class="form-group col-md-12">
	<label for="thumbnail">Thumbnail </label> <input id="thumbnail"
		name="thumbnail"
		accept="image/x-png, image/gif, image/jpeg, image/png, image/jpg"
		type="file" required class="form-control" placeholder="Ảnh thumbnail">
	<p class="help-block">Khuyến cáo : bạn nên up ảnh với tỷ lệ 1x1.</p>
</div>

<div class="form-group col-md-12">
	<label>Tag </label>
	<tags-input ng-model="tags" display-property="value"
		on-Tag-Added="OnAddTag($tag)"> <auto-complete
		source="LoadTagResult($query)"></auto-complete> </tags-input>
	<input name="tags" type="hidden" value="{{tags}}" />
</div>

<div class="form-group col-md-12">
	<label for="txtDescription">Mô tả </label>
	<textarea style="height: 140px" id="txtDescription"
		name="txtDescription" required class="form-control"
		placeholder="Nhập mô tả"></textarea>
</div>

<div class="form-group col-md-12">
	<label for="">Nội dung </label>
	<textarea id="content" name="content" rows="10" cols="80">
        Nhập nội dung bài viết
    </textarea>
</div>

<div class="form-group text-center col-md-12">
	<button ng-click="submit()" class="btn btn-primary">
		<i class="glyphicon glyphicon-plus-sign"></i> &nbsp; Thêm mới bài viết</a>

</div>

<script type="text/javascript">
    CKEDITOR.replace('content',{
        height : '500px',
        language : 'vi'
    });
</script>


