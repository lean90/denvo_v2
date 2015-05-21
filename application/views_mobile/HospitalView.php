
    <div style="margin-bottom: 100px" ng-controller="PositionController" class="location-container">
        <div class="filter-on-map">
            <select class="form-control" ng-model="selectedFilterByName" style="width: 115px; float: left;">
                <option value="PHONG-KHAM">Phòng khám</option>
                <option value="LABO">Labo</option>
                <option value="CO-SO-VLNK">Cơ sở VLNK</option>
            </select>
            <div>
                <angucomplete style="width:345px;float:left;margin-left:20px;" id="members" placeholder="Tên phòng khám" pause="400" selectedobject="selected_position" url="/map/search?type={{selectedFilterByName}}&name=" datafield="results" titlefield="name" descriptionfield="detail_address" imagefield="logo" inputclass="form-control" minlength=2> </angucomplete>
            </div>
        </div>
        <div id="mang-luoi-map" style="width:100%;height:820px;"></div>
        <div class="filter-on-map-2">
            <button class="btn btn-primary" style="margin-left: 20px" ng-click="move_to_search_by_localtion()">Tìm theo khu vực</button>
            <button class="btn btn-primary" style="margin-left: 20px" ng-click="show_list_order_by_like_number()">Được yêu thích</button>
        </div>
        <div class="body-content width-960 location-container">
        <!--
	        <div class="fb-like" data-href="http://dento.vn/ban-do" data-layout="box_count" data-action="like" data-show-faces="false" data-share="false"></div>
	        <div class="fb-share-button" data-href="http://dento.vn/ban-do" data-layout="box_count"></div>
	    -->
            <ul class="filter" ng-show="listState == 'by-area'">
                <li class="select">
                    <h4>TỈNH THÀNH</h4> <select class="form-control" ng-model="selected_tinh_thanhpho" ng-options="i.id as i.name for i in tinh_thanhpho"></select>
                </li>
                <li class="select">
                    <h4>QUẬN HUYỆN</h4> <select class="form-control" ng-model="selected_quan_huyen" ng-options="i.id as i.name for i in quan_huyen"></select>
                </li>
                <li class="select">
                    <h4>PHƯỜNG/XÃ</h4> <select class="form-control" ng-model="selected_phuong_xa" ng-options="i.id as i.name for i in phuong_xa"></select>
                </li>
                <li class="select" style="width: 100%;text-align: center;">
                    <h4>&nbsp</h4> <input type="button" style="width: 148px" value="Tìm kiếm" class="btn btn-primary" ng-click="searchLocationArea()" />
                </li>
            </ul>
            <div class="area-container">
                <h3 ng-show="listState == 'by-area'">
                    <img src="/img/phong-kham-icon.fw.png" /> DS PHÒNG KHÁM THEO KHU VỰC
                </h3>
				<h3 ng-show="listState == 'by-like-number'" style="margin-top:20px;  display: inline-block;">
                    <img src="/img/phong-kham-icon.fw.png" /> DS PHÒNG KHÁM ĐƯỢC YÊU THÍCH
                </h3>
                <ul>
                    <li class="localtion_item" ng-repeat="position in listPosition"  ng-click="showLocationOnMap(position)">
                        <table>
                            <tr>
                                <td><img ng-src="{{position.logo}}" /></td>
                                <td><a ng-href="/ban-do/{{position.id}}"><h4>{{position.name}}</h4></a>
                                    <p class="detail-address">{{position.detail_address}}</p>
                                    <p class="detail-address-hightlight">Hotline: {{position.hotline}}</p>
                                    <p class="detail-address">E-Mail: {{position.email}}</p>
                                    <div class="detail-address like-number" ng-show="listState == 'by-like-number'">
                                    	<table>
						            		<tr>
						            			<td><img src="/img/hear.fw.png"> </td>
						            			<td>
						            				<div class="nub"><s></s><i></i></div>
						                			<span>{{getNumberByThoundsand(position.like_number)}}</span>
						            			</td>
						            		</tr>
						            	</table>
                                    </div>
              					</td>
                            </tr>
                        </table>
                    </li>
                </ul>
            </div>
            <div style="width:100%;text-align: center;">
            	<pagination total-items="lastSearchResults.total" items-per-page="30" max-size="5" page="currentPage"  boundary-links="true" rotate="false" direction-links="false" first-text="Trang đầu" last-text="Trang cuối"></pagination>
            </div>
            
        </div>
    </div>