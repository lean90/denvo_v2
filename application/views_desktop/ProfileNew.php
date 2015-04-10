
<div class="profile-box profile-box-add form-horizontal"
	ng-show="onCreateNewProfile">
	<span ng-click="showCreateFrm()" class="close-btn"></span>
	<div class="form-group col-md-10">
		<label for="inputEmail3" class="col-sm-4 control-label text-left">Họ
			và tên <span style="color: red">(*)</span>
		</label>
		<div class="col-sm-8">
			<input id="txtFullName" ng-model="createNewProfile.full_name"
				type="text" required aria-required="true" class="form-control"
				placeholder="Họ tên người khám">
		</div>
	</div>

	<div class="form-group col-md-10">
		<label for="inputEmail3" class="col-sm-4 control-label text-left">Ngày
			sinh <span style="color: red">(*)</span>
		</label>
		<div class="col-sm-8">
			<input id="txtDob" ng-model="createNewProfile.dob" type="text"
				required aria-required="true" class="form-control validate-date-vn"
				placeholder="Ngày/Tháng/Năm" data-inputmask="'alias': 'dd/mm/yyyy'"
				data-mask="">
		</div>
	</div>

	<div class="form-group col-md-10">
		<label for="inputEmail3" class="col-sm-4 control-label text-left">Ngày
			khám gần nhất</label>
		<div class="col-sm-8">
			<input id="txtExamination" ng-model="createNewProfile.examination_at"
				type="text" aria-required="true"
				class="form-control validate-date-vn" placeholder="Ngày/Tháng/Năm"
				data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">
		</div>
	</div>

	<div class="form-group col-md-10">
		<label for="inputEmail3" class="col-sm-4 control-label">Giới tính</label>
		<div class="col-sm-8">
			<div class="checkbox col-sm-4">
				<label><input ng-model="createNewProfile.gender"
					name="created-gender" type="radio" class="simple" value="MALE" />
					Nam</label>
			</div>
			<div class="checkbox col-sm-4">
				<label><input ng-model="createNewProfile.gender"
					name="created-gender" type="radio" class="simple" value="FMALE" />
					Nữ</label>
			</div>
		</div>
	</div>
	<div class="form-group col-md-10">
		<label for="email-add" class="col-sm-4 control-label text-left">Email<span
			style="color: red">(*)</span></label>
		<div class="col-sm-8">
			<input id="email-add" ng-model="createNewProfile.email" type="email"
				required aria-required="true" class="form-control"
				placeholder="Nhập email">
		</div>
	</div>
	<div class="col-md-12 profile-title-higlight">
		Khám răng chung <br />
		<div class="form-group col-md-10">
			<label for="inputEmail3" class="col-sm-4 control-label text-left"
				style="text-align: left; margin-left: 15px">Số lượng răng</label>
			<div class="col-sm-7">
				<input id="txtAmount"
					ng-model="createNewProfile.teeth_status.amount" type="text"
					required aria-required="true" class="form-control"
					placeholder="Nhập số lượng răng" data-inputmask="'mask': '99'"
					data-mask="">
			</div>
		</div>
		<ul class="profile-nomarl-tick">
			<li><div class="checkbox">
					<label><input ng-model="teethStatus[0].selected"
						ng-true-value="true" ng-false-value="false" type="checkbox"
						class="simple"> Cao răng</label>
				</div></li>
			<li><div class="checkbox">
					<label><input ng-model="teethStatus[1].selected"
						ng-true-value="true" ng-false-value="false" type="checkbox"
						class="simple"> Đã lấy cao răng</label>
				</div></li>
			<li><div class="checkbox">
					<label><input ng-model="teethStatus[2].selected"
						ng-true-value="true" ng-false-value="false" type="checkbox"
						class="simple"> Viêm lợi</label>
				</div></li>
			<li><div class="checkbox">
					<label><input ng-model="teethStatus[3].selected"
						ng-true-value="true" ng-false-value="false" type="checkbox"
						class="simple"> Đã điều trị viêm lợi</label>
				</div></li>
			<li><div class="checkbox">
					<label><input ng-model="teethStatus[4].selected"
						ng-true-value="true" ng-false-value="false" type="checkbox"
						class="simple"> Thiểu sản men răng</label>
				</div></li>
			<li><div class="checkbox">
					<label><input ng-model="teethStatus[5].selected"
						ng-true-value="true" ng-false-value="false" type="checkbox"
						class="simple"> Đã làm chụp răng bảo vệ</label>
				</div></li>
			<li><div class="checkbox">
					<label><input ng-model="teethStatus[6].selected"
						ng-true-value="true" ng-false-value="false" type="checkbox"
						class="simple"> Răng khấp khểnh, lệch lạc</label>
				</div></li>
			<li><div class="checkbox">
					<label><input ng-model="teethStatus[7].selected"
						ng-true-value="true" ng-false-value="false" type="checkbox"
						class="simple"> Đã nắn chỉnh nha</label>
				</div></li>
			<li><div class="checkbox">
					<label><input ng-model="teethStatus[8].selected"
						ng-true-value="true" ng-false-value="false" type="checkbox"
						class="simple"> Rối loạn vận động khớp TDH</label>
				</div></li>
			<li><div class="checkbox">
					<label><input ng-model="teethStatus[9].selected"
						ng-true-value="true" ng-false-value="false" type="checkbox"
						class="simple"> Đã tẩy trắng răng </label>
				</div></li>
			<li><div class="checkbox">
					<label><input ng-model="teethStatus[10].selected"
						ng-true-value="true" ng-false-value="false" type="checkbox"
						class="simple" style="margin-top: 7px;"> Khác <input
						ng-model="teethStatus[10].value" type="text" /></label>
				</div></li>
		</ul>
	</div>
	<div class="col-md-12 " style="margin-top: 15px">
		<div class="profile-title-higlight">Khám cụ thể</div>
		<div class="">Trong trường hợp răng hỗn hợp (có cả răng vĩnh viễn +
			răng sữa) sẽ chọn cả 2 sơ đồ Chọn vào răng có vấn đề của bạn để điền
			thông tin chi tiết</div>
		<div class="schema-conatiner">
			<ul ng-click="selectedTeeth($event, teethChildPosition)"
				ng-mousemove="setTootipOnMouseMove($event,teethChildPosition)"
				class="schema child">
				<li ng-show="(selectedTeethCode.code.indexOf('RS') != -1)"
					class="feedback-behavior"></li>
				<li ng-show="(teeth.code.indexOf('RS') != -1)"
					ng-repeat="teeth in createNewProfile.teeth_status_detail"
					style="background: url(/schema/{{teeth.code}}_highlight.png)"></li>
			</ul>
			<div class="schema-description">
				<div class="profile-title-higlight">Sơ đồ răng sữa</div>
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
		<div class="schema-conatiner">

			<ul ng-click="selectedTeeth($event, teethMenPosition)"
				ng-mousemove="setTootipOnMouseMove($event,teethMenPosition)"
				class="schema men">
				<li ng-show="(selectedTeethCode.code.indexOf('RVV') != -1)" style=""
					class="feedback-behavior"></li>
				<li ng-show="(teeth.code.indexOf('RVV') != -1)"
					ng-repeat="teeth in createNewProfile.teeth_status_detail"
					style="background: url(/schema/{{teeth.code}}_highlight.png)"></li>
			</ul>
			<div class="schema-description">
				<div class="profile-title-higlight">Sơ đồ răng vĩnh viễn</div>
				Chia 4 cung, theo chiều kim đồng hồ<br />
				&nbsp;&nbsp;&nbsp;&nbsp;Cung 1: Hàm trên, bên phải<br />
				&nbsp;&nbsp;&nbsp;&nbsp;Cung 2: Hàm trên, bên trái<br />
				&nbsp;&nbsp;&nbsp;&nbsp;Cung 3: Hàm dưới, bên trái<br />
				&nbsp;&nbsp;&nbsp;&nbsp;Cung 4: Hàm dưới, bên phải<br /> <br /> Tên
				răng gồm 2 phần<br /> &nbsp;&nbsp;&nbsp;&nbsp;Phần 1: Tên của cung
				răng<br /> &nbsp;&nbsp;&nbsp;&nbsp;Phần 2: Tên răng, tính từ đường
				giữa đi về phía ngoại vi, số thứ tự của răng: từ 1-8<br />
				&nbsp;&nbsp;&nbsp;&nbsp;Ví dụ: : Răng hàm trên bên phải, gần đường
				giữa (L) nhất sẽ là răng 11 (đọc là Một một, không đọc là Mười một)<br />
			</div>
		</div>
	</div>
	<div class="col-md-12" style="margin-top: 15px;">
		<label class="col-md-12 text-right control-label"
			style="text-align: left">Hiện tại bạn thấy răng của mình</label>
		<div class="col-md-12" style="margin-left: 50px;">
			<div class="checkbox col-sm-4">
				<label><input ng-model="createNewProfile.teeth_status.feed"
					name="overview-teeth-status" type="radio" value="GOOD"
					class="simple"> Tốt</label>
			</div>
			<div class="checkbox col-sm-4">
				<label><input ng-model="createNewProfile.teeth_status.feed"
					name="overview-teeth-status" type="radio" value="NOTGOOD"
					class="simple"> Chưa tốt, có vấn đề</label>
			</div>
		</div>
	</div>
	<div class="col-md-12 text-center" style="margin: 15px 0px;">
		<a href="javascript:void(0);" ng-click="save()"
			class="btn btn-primary"> <i class="glyphicon glyphicon-plus-sign"></i>
			&nbsp; Lưu lại
		</a> <a href="javascript:void(0);" ng-click="saveAndSend()"
			class="btn btn-primary"> <i class="glyphicon glyphicon-send"></i>
			&nbsp; Lưu lại và gửi yêu cầu tư vấn
		</a>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="profile-detail-modal"
	style="background: transparent url(/img/page-mask-bg.fw.png) repeat top left;"
	tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" style="width: 500px">
		<div class="modal-content"
			style="box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); padding: 15px">
			<div class="modal-header" style="border: none; padding: 0px;">
				<button type="button" class="close" data-dismiss="modal"
					style="margin-top: -10px">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<div class="profile-title-higlight">{{getSelectedTeethName()}}-{{getToothName(selectedTeethCode.code).name}}</div>
			</div>
			<div class="modal-body" style="display: inline-block; padding: 0px">
				<ul class="profile-nomarl-tick">
					<li><div class="checkbox">
							<label><input ng-model="teethDetailStatus[0].selected"
								ng-true-value="{{true}}" ng-false-value="false" type="checkbox"
								class="simple"> Sâu răng, mòn răng</label>
						</div></li>
					<li><div class="checkbox">
							<label><input ng-model="teethDetailStatus[1].selected"
								ng-true-value="true" ng-false-value="false" type="checkbox"
								class="simple"> Đã hàn</label>
						</div></li>
					<li><div class="checkbox">
							<label><input ng-model="teethDetailStatus[2].selected"
								ng-true-value="true" ng-false-value="false" type="checkbox"
								class="simple"> Nứt răng, vỡ răng</label>
						</div></li>
					<li><div class="checkbox">
							<label><input ng-model="teethDetailStatus[3].selected"
								ng-true-value="true" ng-false-value="false" type="checkbox"
								class="simple"> Đã nhổ</label>
						</div></li>
					<li><div class="checkbox">
							<label><input ng-model="teethDetailStatus[4].selected"
								ng-true-value="true" ng-false-value="false" type="checkbox"
								class="simple"> Viêm tủy</label>
						</div></li>
					<li><div class="checkbox">
							<label><input ng-model="teethDetailStatus[5].selected"
								ng-true-value="true" ng-false-value="false" type="checkbox"
								class="simple"> Đã điều trị tủy</label>
						</div></li>
					<li><div class="checkbox">
							<label><input ng-model="teethDetailStatus[6].selected"
								ng-true-value="true" ng-false-value="false" type="checkbox"
								class="simple"> Viêm quanh cuống răng</label>
						</div></li>
					<li><div class="checkbox">
							<label><input ng-model="teethDetailStatus[7].selected"
								ng-true-value="true" ng-false-value="false" type="checkbox"
								class="simple"> Đã cắt cuống răng</label>
						</div></li>
					<li><div class="checkbox">
							<label><input ng-model="teethDetailStatus[8].selected"
								ng-true-value="true" ng-false-value="false" type="checkbox"
								class="simple"> Mất răng</label>
						</div></li>
					<li><div class="checkbox">
							<label><input ng-model="teethDetailStatus[9].selected"
								ng-true-value="true" ng-false-value="false" type="checkbox"
								class="simple"> Đã làm Răng giả (cầu răng, chụp răng) </label>
						</div></li>
					<li><div class="checkbox">
							<label><input ng-model="teethDetailStatus[10].selected"
								ng-true-value="true" ng-false-value="false" type="checkbox"
								class="simple"> Thiếu răng </label>
						</div></li>
					<li><div class="checkbox">
							<label><input ng-model="teethDetailStatus[11].selected"
								ng-true-value="true" ng-false-value="false" type="checkbox"
								class="simple"> Đã làm hàm tháo lắp </label>
						</div></li>
					<li><div class="checkbox">
							<label><input ng-model="teethDetailStatus[12].selected"
								ng-true-value="true" ng-false-value="false" type="checkbox"
								class="simple"> Thừa răng </label>
						</div></li>
					<li><div class="checkbox">
							<label><input ng-model="teethDetailStatus[13].selected"
								ng-true-value="true" ng-false-value="false" type="checkbox"
								class="simple"> Cắm ghép Implant </label>
						</div></li>
					<li><div class="checkbox">
							<label><input ng-model="teethDetailStatus[14].selected"
								ng-true-value="true" ng-false-value="false" type="checkbox"
								class="simple"> Còn chân răng </label>
						</div></li>
					<li><div class="checkbox">
							<label><input ng-model="teethDetailStatus[15].selected"
								ng-true-value="true" ng-false-value="false" type="checkbox"
								class="simple"> Khác <input
								ng-model="teethDetailStatus[15].value" type="text" /></label>
						</div></li>
				</ul>
			</div>
			<div class="modal-footer"
				style="padding: 0px; border: none; text-align: center">
				<button ng-click="mergeDetail()" type="button"
					class="btn btn-primary">Lưu thay đổi</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
			</div>
		</div>
	</div>
</div>