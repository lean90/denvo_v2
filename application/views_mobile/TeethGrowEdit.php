
<div class="profile-box profile-box-add form-horizontal" style="border: none; padding: 0px; margin: 0px;" ng-show="!onCreateNewProfile">
	<div class="form-group col-md-10">
		<label for="inputEmail3" class="col-sm-3 control-label text-left">Họ
			tên <span style="color: red">(*)</span>
		</label>
		<div class="col-sm-9">
			<input id="txtFullName{{selectedHistory.id}}"
				ng-model="selectedHistory.full_name" type="text" required
				aria-required="true" class="form-control"
				placeholder="Họ tên người khám">
		</div>
	</div>

	<div class="form-group col-md-10">
		<label for="inputEmail3" class="col-sm-3 control-label text-left">Ngày
			sinh <span style="color: red">(*)</span>
		</label>
		<div class="col-sm-9">
			<input id="txtDob{{selectedHistory.id}}"
				ng-model="selectedHistory.dob" type="text" required
				aria-required="true" class="form-control validate-date-vn"
				placeholder="Ngày/Tháng/Năm" data-inputmask="'alias': 'dd/mm/yyyy'"
				data-mask="">
		</div>
	</div>


	<div class="form-group col-md-10">
		<label for="inputEmail3" class="col-sm-3 control-label text-left">Ngày
			khám gần nhất </label>
		<div class="col-sm-9">
			<input id="txtExamination{{selectedHistory.id}}"
				ng-model="selectedHistory.examination_at" type="text"
				aria-required="true" class="form-control validate-date-vn"
				placeholder="Ngày/Tháng/Năm" data-inputmask="'alias': 'dd/mm/yyyy'"
				data-mask="">
		</div>
	</div>

	<div class="form-group col-md-10">
		<label for="inputEmail3" class="col-sm-3 control-label">Giới tính</label>
		<div class="col-sm-9">
			<div class="checkbox col-sm-4">
				<label><input ng-model="selectedHistory.gender"
					name="edit-gender{{history.id}}" type="radio" class="simple"
					value="MALE" /> Nam</label>
			</div>
			<div class="checkbox col-sm-4">
				<label><input ng-model="selectedHistory.gender"
					name="edit-gender{{history.id}}" type="radio" class="simple"
					value="FMALE" /> Nữ</label>
			</div>
		</div>
	</div>
	<div class="form-group col-md-10">
		<label for="inputEmail3" class="col-sm-3 control-label text-left">Email
			<span style="color: red">(*)</span>
		</label>
		<div class="col-sm-9">
			<input id="email{{selectedHistory.id}}"
				ng-model="selectedHistory.email" type="email" required
				aria-required="true" class="form-control" placeholder="Nhập email">
			<p class="help-block">Trẻ em có thể lấy theo email của bố mẹ.</p>
		</div>
	</div>
	<div class="col-md-12 " style="margin-top: 15px">
		<div class="profile-title-higlight">Chọn vào răng cụ thể để điền thông
			tin về tuổi mọc răng</div>
		<div class="">Trong trường hợp răng hỗn hợp (có cả răng vĩnh viễn +
			răng sữa) sẽ chọn cả 2 sơ đồ</div>
	</div>
	<div class="col-md-12 " style="margin-top: 15px">
		<div class="schema-conatiner">
			<ul ng-click="selectedTeeth($event, teethChildPosition,true)"
				ng-mousemove="setTootipOnMouseMove($event,teethChildPosition)"
				class="schema child">
				<li style="background: rgba(255, 255, 255, 0.8);"></li>
				<li ng-show="(selectedTeethCode.code.indexOf('RS') != -1)"
					class="feedback-behavior"></li>
				<li
					ng-show="(teeth.code.indexOf('RS') != -1)&& (teeth.current != 0 )"
					ng-repeat="teeth in selectedHistory.history"
					style="background: url(/schema/{{teeth.code}}.png)"></li>
			</ul>
			<div class="schema-description">
				<div ng-click="openToolTip('description-edit-1')"> <span class="profile-title-higlight">Sơ đồ răng sữa</span> <i class="fa fa-question-circle profile-title-higlight"></i></div>
				<div id="description-edit-1" style="display: none;color: #b3b3b3">
    				Chia 4 cung theo chiều kim đồng hồ<br />
    				&nbsp;&nbsp;&nbsp;&nbsp;Cung 5: Hàm trên, bên phải<br />
    				&nbsp;&nbsp;&nbsp;&nbsp;Cung 6: Hàm trên, bên trái<br />
    				&nbsp;&nbsp;&nbsp;&nbsp;Cung 7: Hàm dưới, bên trái<br />
    				&nbsp;&nbsp;&nbsp;&nbsp;Cung 8: Hàm dưới, bên phải<br /> <br /> Tên
    				răng gồm 2 phần<br /> &nbsp;&nbsp;&nbsp;&nbsp;Phần 1: Tên của cung
    				răng<br /> &nbsp;&nbsp;&nbsp;&nbsp;Phần 2: Tên răng, tính từ đường
    				giữa đi về phía ngoại vi, số thứ tự của răng từ 1-5<br />
    				&nbsp;&nbsp;&nbsp;&nbsp;Ví dụ: Răng sữa hàm trên bên phải, gần đường
    				giữa (L) nhất sẽ là Răng 51 (đọc là Năm một, không đọc là Năm mươi
    				mốt)
				</div>
			</div>
			<div class="table-container child-table">
				<table class="table table-striped table-bordered"
					ng-show="getDisplayTimelineTableData(selectedHistory.history,'RS') != 0">
					<thead>
						<tr>
							<th>Tên răng</th>
							<th>Thời gian mọc</th>
							<th>Thời gian mọc tiêu chuẩn</th>
							<th>Thời gian thay</th>
							<th>Thời gian thay tiêu chuẩn</th>
						</tr>
					</thead>
					<tbody>
						<tr
							ng-repeat="teeth in getDisplayTimelineTableData(selectedHistory.history,'RS')">
							<td>{{teeth.code}}</td>
							<td>{{teeth.current}}</td>
							<td>{{teeth.normal}}</td>
							<td>{{teeth.rcurrent}}</td>
							<td>{{teeth.remove}}</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="schema-conatiner">
				<ul ng-click="selectedTeeth($event, teethMenPosition,true)"
					ng-mousemove="setTootipOnMouseMove($event,teethMenPosition)"
					class="schema men">
					<li style="background: rgba(255, 255, 255, 0.8);"></li>
					<li ng-show="(selectedTeethCode.code.indexOf('RVV') != -1)"
						style="" class="feedback-behavior"></li>
					<li
						ng-show="(teeth.code.indexOf('RVV') != -1) && (teeth.current != 0)"
						ng-repeat="teeth in selectedHistory.history"
						style="background: url(/schema/{{teeth.code}}.png)"></li>
				</ul>
				<div class="schema-description">
					<div ng-click="openToolTip('description-edit-2')"> <span class="profile-title-higlight">Sơ đồ răng vĩnh viễn</span> <i class="fa fa-question-circle profile-title-higlight"></i></div>
				    <div id="description-edit-2" style="display: none;color: #b3b3b3">
        				Chia 4 cung, theo chiều kim đồng hồ<br />
        				&nbsp;&nbsp;&nbsp;&nbsp;Cung 1: hàm trên, bên phải<br />
        				&nbsp;&nbsp;&nbsp;&nbsp;Cung 2: hàm trên, bên trái<br />
        				&nbsp;&nbsp;&nbsp;&nbsp;Cung 3: hàm dưới, bên trái<br />
        				&nbsp;&nbsp;&nbsp;&nbsp;Cung 4: hàm dưới, bên phải<br /> <br /> Tên
        				răng gồm 2 phần<br /> &nbsp;&nbsp;&nbsp;&nbsp;Phần 1: tên của cung
        				răng<br /> &nbsp;&nbsp;&nbsp;&nbsp;Phần 2: tên răng, tính từ đường
        				giữa đi về phía ngoại vi, số thứ tự của răng: từ 1-8<br />
        				&nbsp;&nbsp;&nbsp;&nbsp;Ví dụ: : Răng hàm trên bên phải, gần đường
        				giữa (L) nhất sẽ là răng 11 (đọc là Một một, không đọc là Mười một)<br />
				    </div>
				</div>
				<div class="table-container man-table">
					<table class="table table-striped table-bordered"
						ng-show="getDisplayTimelineTableData(selectedHistory.history,'RVV') != 0">
						<thead>
							<tr>
								<th>Tên răng</th>
								<th>Thời gian mọc</th>
								<th>Thời gian mọc tiêu chuẩn</th>
							</tr>
						</thead>
						<tbody>
							<tr
								ng-repeat="teeth in getDisplayTimelineTableData(selectedHistory.history,'RVV')">
								<td>{{teeth.code}}</td>
								<td>{{teeth.current}}</td>
								<td>{{teeth.normal}}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-12 text-left" style="margin: 15px 0px;">
			<a href="javascript:void(0);" ng-click="save()" style="width:520px; margin-bottom:20px"
				class="btn btn-primary"> <i class="glyphicon glyphicon-plus-sign"></i>
				&nbsp; Lưu lại
			</a> <a href="javascript:void(0);" ng-click="saveAndSend()" style="width:520px"
				class="btn btn-primary"> <i class="glyphicon glyphicon-send"></i>
				&nbsp; Lưu lại và gửi yêu cầu tư vấn
			</a>
		</div>
	</div>
</div>	
	<!-- Modal -->
	<div class="modal fade" id="profile-detail-modal-edit-{{history.id}}"
		style="background: transparent url(/img/page-mask-bg.fw.png) repeat top left;"
		tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
		aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content"
				style="box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); padding: 15px">
				<div class="modal-header" style="border: none; padding: 0px;">
					<button type="button" class="close" data-dismiss="modal"
						style="margin-top: -10px">
						<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
					</button>
					<div class="profile-title-higlight">{{getSelectedTeethName()}}</div>
				</div>
				<div class="modal-body" style="display: inline-block; padding: 0px">
					<table class="frm-teethGrow"
						style="width: 470px; margin-top: 10px;">
						<tr>
							<td>Tuổi mọc răng</td>
							<td><select ng-model="editingTeeth.current"
								ng-show="editingTeeth.code.indexOf('RS') != -1">
									<option ng-repeat="item in definedRS " value="{{item}}">{{item}}</option>
							</select> <select ng-model="editingTeeth.current"
								ng-show="editingTeeth.code.indexOf('RVV') != -1">
									<option ng-repeat="item in definedRVV " value="{{item}}">{{item}}</option>
							</select></td>
							<td></td>
						</tr>
						<tr ng-show="editingTeeth.code.indexOf('RS') != -1">
							<td>Tuổi thay răng</td>
							<td>
    							<select ng-model="editingTeeth.rcurrent" ng-show="editingTeeth.code.indexOf('RS') != -1">
    								<option ng-repeat="item in definedRSRemove" value="{{item}}">{{item}}</option>
    							</select>
							</td>
							<td></td>
						</tr>
						<tr>
							<td>Ghi chú</td>
							<td colspan="2"><textarea
									style="height: 50px; width: 100%; padding: 5px;" type="text"
									ng-model="editingTeeth.comment" placeholder="Ghi chú"></textarea></td>
						</tr>
						<tr>
							<td colspan="3">Độ tuổi mọc tiêu chuẩn : {{editingTeeth.normal}}</td>
						</tr>
						<tr>
							<td colspan="3">Độ tuổi thay tiêu chuẩn : {{editingTeeth.remove}}</td>
						</tr>
					</table>
				</div>
				<div class="modal-footer"
					style="padding: 0px; border: none; text-align: center">
					<button ng-click="mergeDetail(true)" type="button"
						class="btn btn-primary">Lưu thay đổi</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
				</div>
			</div>
		</div>
	</div>
