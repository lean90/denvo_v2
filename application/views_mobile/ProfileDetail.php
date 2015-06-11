<div class="profile-box profile-box-add form-horizontal" style="border: none; padding: 0px; margin: 0px;">

    <div class="form-group col-md-10">
        <label for="inputEmail3" class="col-sm-3 control-label text-left">Người khám</label>
        <div class="col-sm-9" style="margin-top: 5px">{{selectedHistory.full_name}}</div>
    </div>

    <div class="form-group col-md-10">
        <label for="inputEmail3" class="col-sm-3 control-label text-left">Ngày sinh</label>
        <div class="col-sm-9" style="margin-top: 5px">
            <lable>{{selectedHistory.dob}}</lable>
        </div>
    </div>
    <div class="form-group col-md-10">
        <label for="inputEmail3" class="col-sm-3 control-label text-left">Ngày khám</label>
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
    <div class="form-group col-md-10">
        <label class="col-sm-3 control-label text-left">Khám răng chung</label>
        <div class="col-sm-9" style="margin-top: 5px">
            <span ng-show="status.selected == 'true' || status.selected == true" ng-repeat="status in teethStatus">{{status.value}}, </span>
        </div>
    </div>
    <div class="form-group col-md-10">
        <label for="inputEmail3" class="col-sm-3 control-label text-left">Số lượng răng</label>
        <div class="col-sm-9" style="margin-top: 5px">{{selectedHistory.teeth_status.amount}}</div>
    </div>
    <div class="col-md-12 " style="margin-top: 15px; margin-bottom: 40px;">
        <div class="profile-title-higlight">Hướng dẫn</div>
        <div class="">Click vào răng có màu đỏ, để biết tình trạng răng của bạn</div>
    </div>
    <div class="col-md-12 " style="margin-top: 15px; position: inherit;">
        <div class="profile-title-higlight" style="float: left;">Sơ đồ răng sữa</div>

        <div class="schema-conatiner">
            <ul ng-click="selectedDetailTeeth($event, teethChildPosition)" ng-mousemove="setTootipOnMouseMove($event,teethChildPosition)" class="schema child">
                <li ng-show="(teeth.code.indexOf('RS') != -1)" ng-repeat="teeth in selectedHistory.teeth_status_detail" style="background: url(/schema/{{teeth.code}}_highlight.png)">
                    <div ng-show="teeth.code == selectedTeethCode.code" class="profile-detail-show-tooltip">
                        <span ng-show="detail.selected == 'true' || detail.selected == true" ng-repeat="detail in teeth.status"> {{detail.value}}, </span>
                    </div>
                </li>
            </ul>
            <div class="profile-title-higlight" style="float: left; width: 100%">Sơ đồ răng vĩnh viễn</div>
            <ul ng-click="selectedDetailTeeth($event, teethMenPosition)" ng-mousemove="setTootipOnMouseMove($event,teethMenPosition)" class="schema men" style="margin-bottom: 100px;">
                <li ng-show="(teeth.code.indexOf('RVV') != -1)" ng-repeat="teeth in selectedHistory.teeth_status_detail" style="background: url(/schema/{{teeth.code}}_highlight.png)">
                    <div ng-show="teeth.code == selectedTeethCode.code" class="profile-detail-show-tooltip">
                        <span ng-show="detail.selected == 'true' || detail.selected == true" ng-repeat="detail in teeth.status"> {{detail.value}}, </span>
                    </div>
                </li>
            </ul>
        </div>

    </div>
    <div class="col-md-12" style="margin-top: 15px;">
        <label class="col-md-12 text-right control-label" style="text-align: left"> Hiện tại bạn thấy răng của mình : <span ng-show="selectedHistory.teeth_status.feed == 'GOOD'">Tốt</span> <span ng-show="selectedHistory.teeth_status.feed == 'NOTGOOD'">Chưa tốt, có vấn đề</span>
        </label>
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
        <a href="javascript:void(0);" ng-click="enableEditProfile()" style="width: 540px" class="btn btn-primary col-md-12"> <i class="glyphicon glyphicon-edit" style="color: white"></i> &nbsp; Chỉnh sửa</a> <br /><br /> 
        <a href="javascript:void(0);" ng-click='sendSupport()' style="width: 540px" class="btn btn-default col-md-12"> <i class="glyphicon glyphicon-send " style="color: black"></i> &nbsp; Yêu cầu tư vấn</a><br /><br />
        <a ng-href="/profile/{{me.id}}/ho-so-rang-mieng/{{selectedHistory.id}}/del"  style="width: 540px;" class="btn btn-danger"> <i class="glyphicon glyphicon-floppy-remove" style="color: white"></i> &nbsp; Xóa</a> 
    </div>
</div>