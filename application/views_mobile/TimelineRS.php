
<div class="body-content width-960" ng-controller="TimelineRSController">
	<div class="detail-view post-view width-960">
		<div class="left">
			<div class="head">Tuổi mọc răng sữa</div>
			<div class="infor">Tuổi mọc răng sữa tiêu chuẩn</div>
			<div class="social">
				<div class="fb-like" data-href="<?php echo str_replace("http://m.", "http://", Common::curPageURL());?>"
					data-layout="button_count" data-action="like"
					data-show-faces="true" data-share="true"></div>
			</div>
			<div class="tuoi-moc-rang rang-s">
				<ul>
					<li ng-style="{'margin-top': item.y+'px','margin-left':+item.x+'px'}" class="timeline-item"
						ng-repeat="item in datasource">
						<div class="note-in-timeline" ng-click="showDialog(item)">
							<img title="{{getTooltip(item)}}"
								src="/img/time-line-rs-note.fw.png" /> 
								<span ng-class="{'last-item':item.index == 11 || item.index == 10}">
								    {{item.lable}}
								</span>
						</div>
					</li>
				</ul>
			</div>
			<div class="facebook-comment">
				<div class="fb-comments"
					data-href="<?php echo str_replace("http://m.", "http://", Common::curPageURL());?>" data-numposts="5"
					data-colorscheme="light"></div>
			</div>
		</div>

		<div class="right">
            <?php include APPPATH.'views/many_view_time.php'; ?>
        </div>
		
	</div>

	
	
	<div id="detail-dialog" class="modal fade timelime-dialog">
		<div class="modal-dialog">
			<div class="modal-content" style="width:620px">
				<div class="modal-body timeline-box" style="display: inline-block; width: 100%">
				    <a class="timeline-dialog-close-btn" href="#" data-dismiss="modal"></a>
				    <h4 class="modal-title" style="font-size: 28px;color: #0F75BB; font-weight: bold;">Hàm răng sữa</h4>
				    <h5 class="model-title" style="font-size: 24px;color: #0F75BB; font-weight: nomarl;">{{selectedNote.lable}}</h5>
				    <span ng-repeat="teeth in selectedNote.tooth"> (+) {{teeth}}<br /></span>
				    <span ng-repeat="teeth in selectedNote.ntooth"> {{teeth}}<br /></span>
				    <div class="col-md-12 timelime-image">
				        <img style="margin-top: 25px;" src="/schema/TL_RS_{{datasource.indexOf(selectedNote)+1}}.png" class="timeline-schema-men" />
				    </div>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

</div>




