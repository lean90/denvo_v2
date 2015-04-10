
<section class="content-header">
	<h1>
		Tài khoản <small>Quản lý tài khoản</small>
	</h1>
</section>

<!-- Main content -->
<section class="content" ng-controller="AdminAccountController">
	<div class="col-md-8">
		<div class="box box-danger">
			<div class="box-header">
				<i class="glyphicon glyphicon-search"></i>
				<h3 class="box-title">Tìm kiếm tài khoản</h3>
			</div>
			<div class="box-body">
				<form id="frm-banner" action="/__admin/account" method="get">
					<label>Email</label> <input name="email" type="text" /> <label
						style="margin-left: 20px;">Họ và tên</label> <input
						name="full_name" type="text" />
					<button style="margin-left: 20px; margin-top: -5px;"
						class="btn btn-primary btn-sm btn-flat">
						<i class="glyphicon glyphicon-search"></i> &nbsp; Tìm kiếm
					</button>
				</form>
				<table class="table table-bordered" style="margin-top: 20px">
					<tr>
						<th style="width: 10px">ID</th>
						<th>Tài khoản</th>
						<th>Họ tên</th>
						<th>Ngày sinh</th>
						<th style="width: 10px">Trạng thái</th>
						<th style="width: 20px">Phân quyền</th>
						<th>Platform</th>
						<th style="width: 40px"></th>
					</tr>
					<tr ng-repeat="user in searchResults">
						<th style="width: 10px">{{user.id}}</th>
						<th>{{user.us}}</th>
						<th>{{user.full_name}}</th>
						<th>{{user.dob}}</th>
						<th>{{user.account_status}}</th>
						<th>{{user.account_role}}</th>
						<th>{{user.platform}}</th>
						<th style="width: 40px"><a href="javascript:void(0)"
							ng-click="setSelected(user)"><i class="glyphicon glyphicon-edit"></i></a>
						</th>
					</tr>
				</table>
				<a href="{{getExportUrl()}}">Xuất toàn bộ tìm kiếm sang excel/csv</a>
			</div>
			<!-- /.box-body -->
		</div>

	</div>
	<div class="col-md-4">
		<div class="box box-danger" ng-show="selectedUser.id !=  undefined">
			<div class="box-header">
				<i class="glyphicon glyphicon-user"></i>
				<h3 class="box-title">Thông tin tài khoản</h3>
			</div>
			<div class="box-body">
				<form id="frm-permission" method="post"
					enctype="multipart/form-data">
					<input type="hidden" name="user_id" /> <input type="hidden"
						name="permission" /> <input type="hidden" name="callback"
						value="<?php echo Common::curPageURL()?>">
				</form>
				<form id="frm-status" method="post" enctype="multipart/form-data">
					<input type="hidden" name="user_id" /> <input type="hidden"
						name="status" /> <input type="hidden" name="callback"
						value="<?php echo Common::curPageURL()?>">
				</form>
				<span style="font-weight: bold; width: 100px; display: inline-block">Mã
					: </span> {{selectedUser.id}} <br /> <span
					style="font-weight: bold; width: 100px; display: inline-block">Tài
					khoản : </span> {{selectedUser.us}} <br /> <span
					style="font-weight: bold; width: 100px; display: inline-block">Họ
					tên : </span> {{selectedUser.full_name}} <br /> <span
					style="font-weight: bold; width: 100px; display: inline-block">Ngày
					sinh : </span> {{selectedUser.dob}} <br /> <span
					style="font-weight: bold; width: 100px; display: inline-block">Giới
					tính : </span> {{selectedUser.gender}} <br /> <span
					style="font-weight: bold; width: 100px; display: inline-block">Ngày
					tham gia : </span> {{selectedUser.created_at}} <br /> <span
					style="font-weight: bold; width: 100px; display: inline-block">Quyền
					: </span> {{selectedUser.account_role}} <br /> <span
					style="font-weight: bold; width: 100px; display: inline-block">Đã
					xóa : </span> {{selectedUser.delete}} (0 : not deleted | 1 :
				deleted ) <br /> <span
					style="font-weight: bold; width: 100px; display: inline-block">Trạng
					thái : </span> {{selectedUser.account_status}} (-1 : inactive, 0 :
				queue, 1 : actived)<br /> <span
					style="font-weight: bold; width: 100px; display: inline-block">Profile
					page : </span> <a href="/profile/{{selectedUser.id}}">/profile/{{selectedUser.id}}</a>
				<br /> <span
					style="font-weight: bold; width: 100px; display: inline-block">Hồ
					sơ răng : </span> <a
					href="/profile/{{selectedUser.id}}/ho-so-rang-mieng">/profile/{{selectedUser.id}}/ho-so-rang-mieng</a>
				<br /> <span
					style="font-weight: bold; width: 100px; display: inline-block">Tuổi
					mọc : </span> <a
					href="/profile/{{selectedUser.id}}/ho-so-rang-mieng">/profile/{{selectedUser.id}}/tuoi-moc-rang</a>
				<br /> <br /> <a ng-show="selectedUser.account_role != 'ADMIN'"
					ng-click="setPermisson('ADMIN')" class="btn btn-primary btn-sm"
					href="javascript:void(0)">Admin </a> <a
					ng-show="selectedUser.account_role != 'USER'"
					ng-click="setPermisson('USER')" class="btn btn-primary btn-sm"
					href="javascript:void(0)">Người sử dụng </a> <a
					ng-show="selectedUser.account_role != 'COLLABORATORS'"
					ng-click="setPermisson('COLLABORATORS')"
					class="btn btn-primary btn-sm" href="javascript:void(0)">Cộng tác
					viên </a> <a ng-show="selectedUser.account_status == 1"
					ng-click="setStatus(-1)" class="btn btn-danger btn-sm"
					href="javascript:void(0)">Banned</a> <a
					ng-show="selectedUser.account_status == -1" ng-click="setStatus(1)"
					class="btn btn-danger btn-sm" href="javascript:void(0)">Unbanned</a>
			</div>
			<!-- /.box-body -->
		</div>
	</div>
	<div class="col-md-6">
		<div class="box box-danger">
			<div class="box-header">
				<i class="glyphicon glyphicon-list-alt"></i>
				<h3 class="box-title">&nbsp; Lịch sử</h3>
			</div>
			<div class="box-body">
				<table class="table table-bordered" style="margin-top: 20px">
					<tr>
						<th>Nội dung</th>
						<th>Ngày Lưu vết</th>
					</tr>
					<tr ng-repeat="history in histories">
						<th ng-bind-html="getHistoryContent(history)"></th>
						<th>{{history.created_at}}</th>
					</tr>
				</table>
			</div>
			<!-- /.box-body -->
			<div ng-show="historyLoading" class="overlay"></div>
			<div ng-show="historyLoading" class="loading-img"></div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="box box-danger">
			<div class="box-header">
				<i class="glyphicon glyphicon-list-alt"></i>
				<h3 class="box-title">&nbsp; Yêu cầu tư vấn</h3>
			</div>
			<div class="box-body">
				<table class="table table-bordered" style="margin-top: 20px">
					<tr>
						<th style="width: 10px">ID</th>
						<th>Nội dung</th>
						<th>Trả lời</th>
						<th>Ngày tạo</th>
					</tr>
					<tr ng-repeat="ticket in ticketSupports">
						<th style="width: 10px">{{ticket.id}}</th>
						<th ng-bind-html="getTicketContent(ticket)"></th>
						<th>{{ticket.ticket_response}}</th>
						<th>{{ticket.created_at}}</th>

					</tr>
				</table>
			</div>
			<!-- /.box-body -->
			<div ng-show="ticketSupportLoading" class="overlay"></div>
			<div ng-show="ticketSupportLoading" class="loading-img"></div>
		</div>
	</div>
</section>
<script type="text/javascript">
    var searchResults = <?php echo isset($findResults) ? json_encode($findResults) : "[]";?> ;
</script>
<!-- /.content -->

