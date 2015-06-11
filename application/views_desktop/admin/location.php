<script type="text/javascript">
	var staticsService = '<?php echo Common::getStaticHost();?>';
</script>
<section class="content-header">
    <h1>Bản đồ</h1>
</section>

<!-- Main content -->
<section class="content" ng-controller="AdminLocationController">
    <div></div>
    <div class="col-md-6">
        <div class="box box-danger">
            <div class="box-header">
                <i class="fa fa-warning"></i>
                <h3 class="box-title">Bản đồ</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-md-12" style="margin: 0px; padding: 0px; margin-bottom: 10px">
                    <input type="text" class="form-control" ng-model="keyWord" style="width: 200px; float: left" /> <input type="button" class="btn btn-primary" ng-click="searchLocation()" value="Tìm kiếm" />
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tên</th>
                            <th>Mô tả</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="location in locations">
                            <td><b>{{location.position_type}} : </b> {{location.name}}</td>
                            <td>{{location.sort_description}} <br /> <br />

                            </td>
                            <td><a href="javascript:void(0)" ng-click="selectingLocation(location)"> EDIT</a> <a href="javascript:void(0)" ng-click="del(location)" style="color: red"> DELETE</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box box-danger">
            <div class="box-header">
                <i class="fa fa-warning"></i>
                <h3 class="box-title">Khu vực</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <p style="margin: 0 0 10px; display: inline-block; margin-left: 10px;">
                    <a class="pull-left btn btn-primary btn-xs" data-nodrag ng-click="addSubArea()" style="margin-right: 8px;"><span class="glyphicon glyphicon-plus"></span></a>
                </p>
                <div ui-tree="treeOptions" id="tree-root" data-max-depth="3">
                    <ol ui-tree-nodes ng-model="dragableAreaList">
                        <li ng-repeat="item in dragableAreaList" ui-tree-node ng-include="'items_renderer.html'" collapsed="true"></li>
                    </ol>
                </div>

            </div>
        </div>

    </div>
    <div class="col-md-6">
        <div class="box box-danger">
            <div class="box-header">
                <i class="fa fa-warning"></i>
                <h3 class="box-title">Bản đồ</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table style="width: 100%">
                    <tr>
                        <td style="width: 50%">
                            <div class="input-group">
                                <span class="input-group-addon">Kinh Độ</span> <input type="text" ng-model="current_lat" ng-change="onChangeLocation()" class="form-control col-md-6" placeholder="Kinh độ" />
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">Vĩ Độ</span> <input type="text" ng-model="current_long" ng-change="onChangeLocation()" class="form-control col-md-6" placeholder="Vĩ độ" />
                            </div>
                        </td>
                    </tr>
                </table>
                <div id="main-map" style="width: 100%; height: 300px"></div>
                <div style="text-align: center;">
                    <img style="float: none; margin: auto; margin-top: -335px; position: relative;" src="/img/rwanda-plus-icon.png" />
                </div>

                <br /> <label>Tỉnh / Thành phố</label> <select class="form-control" ng-model="selected_tinh_thanhpho" ng-options="i.id as i.name for i in tinh_thanhpho"></select> <br /> <label>Quận / Huyện / Thị Xã</label> <select class="form-control" ng-model="selected_quan_huyen" ng-options="i.id as i.name for i in quan_huyen"></select> <br /> <label>Phường / Xã</label> <select class="form-control" ng-model="selected_phuong_xa" ng-options="i.id as i.name for i in phuong_xa"></select> <br /> <label>Loại địa điểm</label> <select id="position-type" ng-model="selectedLocation.position_type" name="position-type" class="form-control">
                    <option value="PHONG-KHAM">Phòng khám</option>
                    <option value="LABO">Labo</option>
                    <option value="CO-SO-VLNK">Cơ sở VLNK</option>
                    <option value="KHAC">Khác</option>
                </select> <br /> <label>Tên</label> <input type="text" ng-model="selectedLocation.name" class="form-control" /> <br /> <label>Địa chỉ cụ thể</label>
                <textarea ng-model="selectedLocation.detail_address" class="form-control"></textarea>

                <br /> <label>Hotline</label> <input type="text" ng-model="selectedLocation.hotline" class="form-control" /> <br /> <label>Email</label> <input type="text" ng-model="selectedLocation.email" class="form-control" /> <br /> <label>Giờ làm việc</label> <input type="text" ng-model="selectedLocation.working_time" class="form-control" />
                <br /> <label>Websitelink</label>
                <input class="form-control" ng-model="selectedLocation.website_link"/>
                
                <!-- <br/>
                <label>Mô tả ngắn</label> 
                <textarea ng-model="selectedLocation.sort_description" class="form-control"></textarea>
                 -->

                <br /> <label>Mô tả</label>
                <textarea id="content" name="content" rows="50" cols="80"></textarea>
                <br /> <label>Logo</label>
                <img width="75px" height="75px" style="cursor: pointer;" ng-src="{{selectedLocation.logo}}" ng-click="choiceLogo()"/>

                <br /> 
                <label>Images</label> <br /> <img ng-src="{{selectedLocation.img1}}" ng-click="openKCFinder(1)" style="cursor: pointer; width: 125px; height: 125px" /> <img ng-src="{{selectedLocation.img2}}" ng-click="openKCFinder(2)" style="cursor: pointer; width: 125px; height: 125px" /> <img ng-src="{{selectedLocation.img3}}" ng-click="openKCFinder(3)" style="cursor: pointer; width: 125px; height: 125px" /> <img ng-src="{{selectedLocation.img4}}" ng-click="openKCFinder(4)" style="cursor: pointer; width: 125px; height: 125px" /> <br /> <label>Website link</label> <input type="text" ng-model="selectedLocation.website_link" class="form-control" /> 
                <br /> 
                <input type="button" ng-click="Update()" class="btn btn-warning" value="Cập nhật chỉnh sửa" /> 
                <input type="button" ng-click="AddNewLocation()" class="btn btn-primary" value="Thêm mới địa điểm" />
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</section>
<!-- /.content -->

<div class="modal fade" id="edit-dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Chỉnh sửa khu vực</h4>
            </div>
            <div class="modal-body">
                <table style="width: 100%">
                    <tr>
                        <td style="width: 120px">Tên địa điểm</td>
                        <td><input type="text" class="form-control" /></td>
                    </tr>

                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script src="/js/controllers/AdminLocationController.js"></script>
<script src="/js/plugins/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('content',{
        height : '300px',
        language : 'vi'
    });
    var rootCate = <?php echo json_encode($rootCate);?>;
</script>
<!-- Nested node template -->
<script type="text/ng-template" id="items_renderer.html">
<div ui-tree-handle>
    <a class="btn btn-success btn-xs" data-nodrag ng-click="toggle(this)" >
    	<span  class="glyphicon" ng-class="{'glyphicon-chevron-right': collapsed, 'glyphicon-chevron-down': !collapsed, 'glyphicon-pushpin':!getShowAddStatus(this)}"></span>
    </a> 
	{{item.name}}
	<a class="pull-right btn btn-danger btn-xs" data-nodrag ng-click="removeSubArea(this)"><span class="glyphicon glyphicon-remove"></span></a>
	<a class="pull-right btn btn-primary btn-xs" data-nodrag ng-click="edit(this)" style="margin-right: 8px;"><span class="glyphicon glyphicon-edit"></span></a> 
	<a ng-show="getShowAddStatus(this)" class="pull-right btn btn-primary btn-xs" data-nodrag ng-click="addSubArea(this)" style="margin-right: 8px;">
		<span class="glyphicon glyphicon-plus"></span>
	</a>

</div>
<ol ui-tree-nodes ng-model="item.childs" ng-class="{hidden: collapsed}" >
    <li ng-repeat="item in item.childs" ui-tree-node ng-include="'items_renderer.html'" collapsed="true"></li>
</ol>
</script>

<script type="text/ng-template" id="edit-dialog.html">
        <div class="modal-header">
            <h3 class="modal-title">Khu vực</h3>
        </div>
        <div class="modal-body">
			 <table style="width:100%">
        	<tr>
        		<td style="width:120px">Tên địa điểm</td>
        		<td><input type="text" class="form-control" ng-model="input.name"/></td>
        	</tr>
        	
        </table>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" ng-click="ok()">OK</button>
            <button class="btn btn-warning" ng-click="cancel()">Cancel</button>
        </div>
    </script>



