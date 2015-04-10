
<div class="form-group col-md-12">
	<label>Tag </label>
	<tags-input ng-model="tags" display-property="value"
		on-Tag-Added="OnAddTag($tag)"> <auto-complete
		source="LoadTagResult($query)"></auto-complete> </tags-input>
	<input name="tags" type="hidden" value="{{tags}}" />
</div>

<div class="form-group col-md-9">
	<label for="">Đường dẫn Youtube </label> <input type="text"
		id="txtYoutubeEmbedCode" ng-model="$parent.youtubeLink"
		ng-blur="onChangeYoutubeLink()" required name="txtYoutubeEmbedCode"
		class="form-control" placeholder="Đường dẫn youtube" /> <input
		type="text" ng-model="content" required name="content"
		style="display: none;" />
</div>

<div class="form-group col-md-3">
	<img width="204px" height="150px"
		ng-src="{{$parent.youtubeThumbnailLink}}" /> <input type="hidden"
		name="thumbnail" value="{{$parent.youtubeThumbnailLink}}" />

</div>
<div class="form-group col-md-12">
	<label for="txtDescription">Mô tả </label>
	<textarea style="height: 300px" id="txtDescription"
		name="txtDescription" required class="form-control"
		placeholder="Nhập mô tả"></textarea>
</div>
<div class="form-group text-center col-md-12">
	<button ng-click="submit()" class="btn btn-primary">
		<i class="glyphicon glyphicon-plus-sign"></i> &nbsp; Thêm mới video</a>

</div>



