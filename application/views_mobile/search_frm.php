<script type="text/javascript">
    var searchCategories = '<?php echo json_encode($categories); ?>';
</script>
<form id="srch-frm" novalidate action="/search" method="get"
	style="margin: 10px 0px" ng-controller="SearchFromController">
	<input type="hidden" value="0" name="page" /> <input type="hidden"
		value="1" name="show_search_pannel" />
	<div class="form-group col-md-12">
		<label for="client-us">Nội dung</label> <input id="client-us"
			name="key_word" type="text" class="form-control"
			placeholder="Nhập từ cần tìm kiếm">
	</div>
	<div class="form-group col-md-4">
		<label for="client-us">Từ khóa <i ng-show="loadingTag"
			class="glyphicon glyphicon-refresh"></i></label> <input
			id="client-us" type="text" class="form-control"
			placeholder="Nhập từ khóa"
			typeahead="tag as tag.value for tag in getTagsByTagName($viewValue)"
			typeahead-loading="loadingTag" ng-model="SelectedTag" /> <input
			type="hidden" name="tag_id" value="{{SelectedTag.id}}" />
	</div>
	<div class="form-group col-md-4">
		<label for="client-us">Người đăng <i ng-show="loadingUser"
			class="glyphicon glyphicon-refresh"></i></label> <input type="text"
			class="form-control" placeholder="Nhập người đăng"
			typeahead="user as user.full_name for user in getUserByFullname($viewValue)"
			typeahead-loading="loadingUser"
			typeahead-template-url="autoCompleteUserTemplate.html"
			ng-model="SelectedUser" /> <input type="hidden" name="user_id"
			value="{{SelectedUser.id}}" />
	</div>

	<div class="form-group col-md-4">
		<label for="client-us">Danh mục</label> <select class="form-control"
			ng-model="selectedCategory"
			ng-options="i.id as i.name for i in allowCategories"></select> <input
			type="hidden" name="category_id" value="{{selectedCategory}}" />
	</div>

	<div class="form-group col-md-6">
		<label for="client-us">Từ ngày</label> <input id="client-us"
			name="started_date" type="text" class="form-control"
			data-inputmask="'alias': 'dd/mm/yyyy'" data-mask=""
			placeholder="Định dạng : Ngày / tháng / năm">
	</div>

	<div class="form-group col-md-6">
		<label for="client-us">Đến ngày</label> <input id="client-us"
			name="ended_date" type="text" class="form-control"
			data-inputmask="'alias': 'dd/mm/yyyy'" data-mask=""
			placeholder="Định dạng : Ngày / tháng / năm">
	</div>



	<div class="form-group col-md-12 text-center">
		<button id="srch-frm-submit" class="btn btn-info">
			<i class="glyphicon glyphicon-search"></i> &nbsp; Tìm kiếm
		</button>
	</div>
</form>

<script type="text/ng-template" id="autoCompleteUserTemplate.html">
  <a>
      <img ng-src="{{match.model.avartar}}" width="32">
      <span bind-html-unsafe="match.label | typeaheadHighlight:query"></span>
  </a>
</script>

<script type="text/javascript">
    $('#srch-frm-submit').click(function(){
        $('#srch-frm').submit();
    });
</script>
