<div class="profile-box profile-box-add form-horizontal" style="border: none; padding: 0px; margin: 0px;">

    <div class="form-group col-md-10">
        <label for="inputEmail3" class="col-sm-3 control-label text-left">Họ tên</label>
        <div class="col-sm-9" style="margin-top: 5px">{{selectedHistory.full_name}}</div>
    </div>

    <div class="form-group col-md-10">
        <label for="inputEmail3" class="col-sm-3 control-label text-left">Ngày sinh</label>
        <div class="col-sm-9" style="margin-top: 5px">
            <lable>{{selectedHistory.dob}}</lable>
        </div>
    </div>

    <div class="form-group col-md-10">
        <label for="inputEmail3" class="col-sm-3 control-label text-left">Ngày khám gần nhất</label>
        <div class="col-sm-9" style="margin-top: 5px">
            <lable>{{selectedHistory.examination_at}}</lable>
        </div>
    </div>

    <div class="form-group col-md-10">
        <label for="inputEmail3" class="col-sm-3 control-label">Giới tính</label>
        <div class="col-sm-9">
            <div class="checkbox col-sm-4" ng-show="selectedHistory.gender == 'MALE'">
                <label>Nam</label>
            </div>
            <div class="checkbox col-sm-4" ng-show="selectedHistory.gender == 'FMALE'">
                <label>Nữ</label>
            </div>
        </div>
    </div>
    <div class="form-group col-md-10">
        <label for="inputEmail3" class="col-sm-3 control-label text-left">Email</label>
        <div class="col-sm-9" style="margin-top: 5px">{{selectedHistory.email}}</div>
    </div>

    <div class="text-right absolute-profile-button" ng-show='me.id == selectedHistory.user_id'>
        <a href="javascript:void(0);" ng-click="enableEditProfile()" class="btn btn-primary"> <i class="glyphicon glyphicon-edit" style="color: white"></i> &nbsp; Chỉnh sửa
        </a><br /> <br /> <a href="javascript:void(0);" ng-click='sendSupport()' style="width: 113px;" class="btn btn-default"> <i class="glyphicon glyphicon-send" style="color: black"></i> &nbsp; Tư vấn
        </a><br /> <br /> <a ng-href="/profile/{{me.id}}/tuoi-moc-rang/{{selectedHistory.id}}/del" class="btn btn-danger" style="width: 113px;"> <i class="glyphicon glyphicon-floppy-remove" style="color: white"></i> &nbsp; Xóa
        </a>
        
    </div>

    <div class="col-md-12 " style="margin-top: 15px" ng-show="getDisplayTimelineTableData(selectedHistory.history,'RS').length != 0">
        <div class="schema-conatiner">
            <ul ng-click="selectedDetailTeeth($event, teethChildPosition)" ng-mousemove="setTootipOnMouseMove($event,teethChildPosition)" class="schema child">
                <li style="background: rgba(255, 255, 255, 0.8);"></li>
                <li ng-show="(teeth.code.indexOf('RS') != -1) && (teeth.current != '' || teeth.current != 0)" ng-repeat="teeth in selectedHistory.history" style="background: url(/schema/{{teeth.code}}.png)">
                    <div ng-show="teeth.code == selectedTeethCode.code" class="profile-detail-show-tooltip">
                        <span ng-show="(teeth.code.indexOf('RS') != -1) && (teeth.current != '' || teeth.current != 0)"> <span style="font-weight: bold">Tuổi mọc </span>{{teeth.current}} tháng<br /> <span style="font-weight: bold">Tuổi mọc tiêu chuẩn </span>{{teeth.normal}}<br /> <span style="font-weight: bold">Tuổi thay </span>{{teeth.rcurrent}}<br /> <span style="font-weight: bold">Tuổi thay tiêu chuẩn </span>{{teeth.remove}}<br />
                        </span>
                    </div>
                </li>
            </ul>
            <div class="schema-description">
                <div class="profile-title-higlight">Sơ đồ răng sữa</div>
                Chia 4 cung theo chiều kim đồng hồ<br /> &nbsp;&nbsp;&nbsp;&nbsp;Cung 5: Hàm trên, bên phải<br /> &nbsp;&nbsp;&nbsp;&nbsp;Cung 6: Hàm trên, bên trái<br /> &nbsp;&nbsp;&nbsp;&nbsp;Cung 7: Hàm dưới, bên trái<br /> &nbsp;&nbsp;&nbsp;&nbsp;Cung 8: Hàm dưới, bên phải<br /> <br /> Tên răng gồm 2 phần<br /> &nbsp;&nbsp;&nbsp;&nbsp;Phần 1: Tên của cung răng<br /> &nbsp;&nbsp;&nbsp;&nbsp;Phần 2: Tên răng, tính từ đường giữa đi về phía ngoại vi, số thứ tự của răng từ 1-5<br /> &nbsp;&nbsp;&nbsp;&nbsp;Ví dụ: Răng sữa hàm trên bên phải, gần đường giữa (L) nhất sẽ là Răng 51 (đọc là Năm một, không đọc là Năm mươi mốt)
            </div>
            <div class="table-container child-table">
                <table class="table table-striped table-bordered" ng-show="getDisplayTimelineTableData(selectedHistory.history,'RS').length != 0">
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
                        <tr ng-repeat="teeth in getDisplayTimelineTableData(selectedHistory.history,'RS')">
                            <td>{{teeth.code}}</td>
                            <td>{{teeth.current}}</td>
                            <td>{{teeth.normal}}</td>
                            <td>{{teeth.rcurrent}}</td>
                            <td>{{teeth.remove}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-12 " style="margin-top: 15px" ng-show="getDisplayTimelineTableData(selectedHistory.history,'RVV').length != 0">
        <div class="schema-conatiner">
            <ul ng-click="selectedDetailTeeth($event, teethMenPosition)" ng-mousemove="setTootipOnMouseMove($event,teethMenPosition)" class="schema men">
                <li style="background: rgba(255, 255, 255, 0.8);"></li>
                <li ng-show="(teeth.code.indexOf('RVV') != -1) && (teeth.current != '' || teeth.current != 0)" ng-repeat="teeth in selectedHistory.history" style="background: url(/schema/{{teeth.code}}.png)">
                    <div ng-show="teeth.code == selectedTeethCode.code" class="profile-detail-show-tooltip">
                        <span ng-show="(teeth.code.indexOf('RVV') != -1) && (teeth.current != '' || teeth.current != 0)"> <span style="font-weight: bold">Tuổi mọc : </span>{{teeth.current}}<br /> <span style="font-weight: bold">Tuổi mọc tiêu chuẩn : </span>{{teeth.normal}}<br /> <span style="font-weight: bold">Ghi chú : </span>{{teeth.comment}}<br />
                        </span>
                    </div>
                </li>
            </ul>
            <div class="schema-description">
                <div class="profile-title-higlight">Sơ đồ răng vĩnh viễn</div>
                Chia 4 cung, theo chiều kim đồng hồ<br /> &nbsp;&nbsp;&nbsp;&nbsp;Cung 1: hàm trên, bên phải<br /> &nbsp;&nbsp;&nbsp;&nbsp;Cung 2: hàm trên, bên trái<br /> &nbsp;&nbsp;&nbsp;&nbsp;Cung 3: hàm dưới, bên trái<br /> &nbsp;&nbsp;&nbsp;&nbsp;Cung 4: hàm dưới, bên phải<br /> <br /> Tên răng gồm 2 phần<br /> &nbsp;&nbsp;&nbsp;&nbsp;Phần 1: tên của cung răng<br /> &nbsp;&nbsp;&nbsp;&nbsp;Phần 2: tên răng, tính từ đường giữa đi về phía ngoại vi, số thứ tự của răng: từ 1-8<br /> &nbsp;&nbsp;&nbsp;&nbsp;Ví dụ: : Răng hàm trên bên phải, gần đường giữa (L) nhất sẽ là răng 11 (đọc là Một một, không đọc là Mười một)<br />
            </div>
            <div class="table-container man-table">
                <table class="table table-striped table-bordered" ng-show="getDisplayTimelineTableData(selectedHistory.history,'RVV').length != 0">
                    <thead>
                        <tr>
                            <th>Tên răng</th>
                            <th>Thời gian mọc</th>
                            <th>Thời gian mọc tiêu chuẩn</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="teeth in getDisplayTimelineTableData(selectedHistory.history,'RVV')">
                            <td>{{teeth.code}}</td>
                            <td>{{teeth.current}}</td>
                            <td>{{teeth.normal}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-12" style="margin-top: 15px;" ng-show='me.id == selectedHistory.user_id && selectedHistory.ticket_response != undefined'>
            <label class="col-md-12 text-right control-label" style="text-align: left"> Tư vấn từ website : <span>{{selectedHistory.ticket_response.ticket_response}}</span>
            </label>
        </div>

        <div class="col-md-12" ng-show="(me.account_role == 'ADMIN' || me.account_role == 'COLLABORATORS') && me.id != selectedHistory.user_id && selectedHistory.ticket_response != undefined" style="margin-top: 15px;">
            <label class="col-md-12 text-right control-label" style="text-align: left"> Tư vấn từ website : <textarea style="width: 350px;" ng-model='selectedHistory.ticket_response.ticket_response'></textarea><br />
            </label>
            <div class="col-sm-6" style="margin-top: 5px; margin-left: 125px;">
                <a href="javascript:void(0);" ng-click="commitSupportResponse()" class="btn btn-default btn-sm"> <i class="glyphicon glyphicon-edit"></i> &nbsp; Cập nhật tư vấn
                </a><br /> <br />
            </div>
        </div>

        <div class="col-md-12 text-center" style="margin: 15px 0px;" ng-show='me.id == selectedHistory.user_id'>
            <a href="javascript:void(0);" ng-click="enableEditProfile()" class="btn btn-primary"> <i class="glyphicon glyphicon-edit" style="color: white"></i> &nbsp; Chỉnh sửa
            </a> <a href="javascript:void(0);" ng-click='sendSupport()' class="btn btn-default"> <i class="glyphicon glyphicon-send" style="color: black"></i> &nbsp; Yêu cầu tư vấn
            </a> <a ng-href="/profile/{{me.id}}/tuoi-moc-rang/{{selectedHistory.id}}/del" class="btn btn-danger"> <i class="glyphicon glyphicon-floppy-remove" style="color: white"></i> &nbsp; Xóa
            </a>
        </div>
    </div>