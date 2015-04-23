
<section class="content-header">
    <h1>Bản đồ</h1>
</section>

<!-- Main content -->
<section class="content" ng-controller = "AdminLocationController">
<div>
</div>
    <div class="col-md-6">
        <div class="box box-danger">
            <div class="box-header">
                <i class="fa fa-warning"></i>
                <h3 class="box-title">Bản đồ</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	<div class="col-md-12" style="margin:0px; padding : 0px;margin-bottom:10px">
            		<input type="text" class="form-control" ng-model="keyWord" style="width: 200px;float:left"/>
            		<input type="button" class="btn btn-primary" ng-click="searchLocation()" value="Tìm kiếm" />
            	</div>
                <table class="table table-bordered">
                	<thead>
                		<tr>
                			<th>Tên phòng khám</th>
                			<th>Mô tả</th>
                			<th></th>
                		</tr>
                	</thead>
                	<tbody>
                		<tr ng-repeat="location in locations">
	                		<td>{{location.name}}</td>
	                		<td>{{location.description}}</td>
	                		<td> 
		                		<a href="javascript:void(0)" ng-click="selectingLocation(location)"> EDIT</a>
		                		<a href="javascript:void(0)" ng-click="del(location)" style="color:red"> DELETE</a> 
	                		</td>
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
            	<select class="form-control" ng-model="selectedEditArea" ng-options="i.id as i.name for i in allowCategories" ></select>
            	<hr/>
            	Khu vực cha
            	<select class="form-control" ng-model="selectedEditParentArea" ng-options="i.id as i.name for i in allowCategories" ></select>
            	<br/>
            	Tên 
            	<input id="areaname" class="form-control" value="{{getSelectedAreaName()}}"/>
            	<br/>
            	<input id="add-area-add" type="button" ng-click="addArea()"  class="btn btn-primary" value="Thêm mới"/>
            	<input id="add-area-update" type="button" ng-click="updateArea(selectedEditArea)"  class="btn btn-warning" value="Cập nhật"/>
                <input id="add-area-del" type="button" ng-click="delArea(selectedEditArea)"  class="btn btn-danger" value="Xóa"/>
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
            
                <br/>
                <label>Bản đồ</label>
                <div id="main-map" style="width:100%;height: 300px"></div>
                <div style="text-align: center;">
                	<img style="float: none;margin: auto;margin-top: -335px;position: relative;" src="/img/rwanda-plus-icon.png"/>
                </div>
                <br/>
                <label>Vùng</label> 
                <select class="form-control" ng-model="selectedLocation.fk_category" ng-options="i.id as i.name for i in allowCategories"></select> 
                <input name="category" type="hidden" value="{{selectedLocation.fk_category}}" />
                <br/>
                <label>Tên</label>
                <input type="text" ng-model="selectedLocation.name" class="form-control"/> 
                
                <br/>
                <label>Mô tả</label> 
                <textarea id="content" name="content"rows="50" cols="80"></textarea>
    
                <br/>
                <label>Website link</label>
                <input type="text" ng-model="selectedLocation.website_link" class="form-control"/> 
                
                
                <br/>
                <input type="button" ng-click="Update()"  class="btn btn-warning" value="Cập nhật"/>
                <input type="button" ng-click="AddNewLocation()"  class="btn btn-primary" value="Thêm mới"/>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</section>
<script type="text/javascript">
	var rootCate = <?php echo json_encode($rootCate);?>;
</script>
<!-- /.content -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script src="/js/controllers/AdminLocationController.js"></script>
<script src="/js/plugins/ckeditor/ckeditor.js"></script>    
<script type="text/javascript">
    CKEDITOR.replace('content',{
        height : '300px',
        language : 'vi'
    });
</script>


