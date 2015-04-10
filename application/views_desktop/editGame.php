<div class="form-group col-md-2">
	<img height="140px" width="140px" alt=""
		ng-src="{{$parent.post.thumbnail}}">
</div>
<div class="form-group col-md-10">
	<label for="thumbnail">Thay đổi thumbnail </label> <input
		id="thumbnail" name="thumbnail"
		accept="image/x-png, image/gif, image/jpeg, image/png" type="file"
		class="form-control" placeholder="Ảnh thumbnail"> <input type="hidden"
		value="$parent.post.thumbnail" />
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
	<label for="txtDescription"> Embed code </label>
	<textarea style="height: 200px" type="text" id="txtLink"
		name='content_static' ng-model="$parent.post.content_static" required
		class="form-control" placeholder="Nhập embed code "></textarea>
</div>

<div class="form-group col-md-12">
	<label for="txtDescription">Mô tả </label>
	<textarea id="txtDescription" ng-model="$parent.post.description"
		name="txtDescription" required class="form-control"
		placeholder="Nhập mô tả"></textarea>
</div>

<div class="form-group col-md-12">
	<label for="">Nội dung </label>
	<textarea ng-model="$parent.post.content" id="content" name="content"
		rows="50" cols="80">
        Nhập nội dung bài viết
    </textarea>
</div>


<div class="form-group text-center col-md-12">
	<button ng-click="submit()" class="btn btn-primary">
		<i class="glyphicon glyphicon-edit"></i> &nbsp; Cập nhật game</a>

</div>

<script type="text/javascript">
    CKEDITOR.replace('content',{
        height : '500px',
        language : 'vi'
    });
</script>

