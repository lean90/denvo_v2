<div class="body-content width-960" style="margin-top: 50px"
	ng-controller="FilesController">
	<div class="col-md-8">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Danh sách file</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body" style="display: inline-block;">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th style="width: 40px">#</th>
							<th style="width: 350px">Đường dẫn</th>
							<th style="width: 150px">Ngày đăng</th>
						</tr>
						<tr ng-repeat="item in items" style="cursor: pointer;">
							<td><img widtd="40px" height="40px" ng-src="{{item.url}}" /></td>
							<td><div
									style="word-wrap: break-word; width: 320px; display: inline-block;">{{item.url}}</div></td>
							<td><span class="badge bg-red">{{item.created_at}}</span></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="box-footer clearfix">
				<ul class="pagination pagination-sm no-margin pull-right">
					<li ng-repeat="page in pages"
						ng-class="{'active':page.offset == offset}"><a href="{{page.url}}">
							<span ng-show="$index != 0 && $index != (pages.length - 1)">{{page.offset
								+ 1}}</span> <span
							ng-show="$index == 0 && $index != (pages.length - 1)">«</span> <span
							ng-show="$index != 0 && $index == (pages.length - 1)">»</span>
					</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-md-4">

		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Thêm file mới</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body" style="display: inline-block;">
				<form id="edit-frm" novalidate method="post"
					enctype="multipart/form-data">
					<input id="id" name="file" type="file" required="required" />
				</form>
			</div>
			<div class="box-footer">
				<button class="btn btn-primary" ng-click="upload()">Upload</button>
			</div>
		</div>


	</div>
</div>
<script type="text/javascript">
    var items = <?php echo json_encode($items);?>;
    var itemsCount = <?php echo json_encode($itemsCount);?>;
</script>
