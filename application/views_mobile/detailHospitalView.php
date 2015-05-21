<div class="body-content width-960 position-detail" ng-controller="DetailPositionController">
    <div class="detail-view post-view width-960">
    	<div class="head" style="font-size: 25px;font-weight: bold;margin:20px 40px 0px 10px;color:#0F75BB;">Thông tin “{{info.name}}”</div>
        <div class="left">
            <div class="social">
                <div class="fb-like fb_iframe_widget" data-href="<?php echo Common::curPageURL();?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true" fb-xfbml-state="rendered" fb-iframe-plugin-query="action=like&amp;app_id=1526647744225362&amp;container_width=558&amp;href=http%3A%2F%2Flocalhost.dev%2Ftimeline%2Frang-sua&amp;layout=button_count&amp;locale=en_US&amp;sdk=joey&amp;share=true&amp;show_faces=true">
                    <span style="vertical-align: bottom; width: 120px; height: 20px;"><iframe name="f23301dae8" width="1000px" height="1000px" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:like Facebook Social Plugin" src="http://www.facebook.com/v2.0/plugins/like.php?action=like&amp;app_id=1526647744225362&amp;channel=http%3A%2F%2Fstatic.ak.facebook.com%2Fconnect%2Fxd_arbiter%2FNM7BtzAR8RM.js%3Fversion%3D41%23cb%3Df37be3ac4%26domain%3Dlocalhost.dev%26origin%3Dhttp%253A%252F%252Flocalhost.dev%252Ff3e57618f%26relation%3Dparent.parent&amp;container_width=558&amp;href=http%3A%2F%2Flocalhost.dev%2Ftimeline%2Frang-sua&amp;layout=button_count&amp;locale=en_US&amp;sdk=joey&amp;share=true&amp;show_faces=true" style="border: none; visibility: visible; width: 120px; height: 20px;" class=""></iframe></span>
                </div>
            </div>
            <div class="img-info">
                <img ng-src="{{selected_img}}" />
                <ul>
                    <li ng-click="change_img(info.img1)"><img ng-src="{{info.img1}}" /></li>
                    <li ng-click="change_img(info.img2)"><img ng-src="{{info.img2}}" /></li>
                    <li ng-click="change_img(info.img3)"><img ng-src="{{info.img3}}" /></li>
                    <li ng-click="change_img(info.img4)"><img ng-src="{{info.img4}}" /></li>
                </ul>
            </div>
           
        </div>
        <div class="right">
            
            <h4 class="header-hightlight">
            	{{info.name}}
            </h4>
            <div class="like-number" ng-click="like_position(info.id)">
            	<table>
            		<tr>
            			<td><img src="/img/hear.fw.png"> </td>
            			<td>
            				<div class="nub"><s></s><i></i></div>
                			<span>{{getNumberByThoundsand(info.like_number)}}</span>
            			</td>
            		</tr>
            	</table>
            </div>
            <p><b>Hotline : {{info.hotline}}</b></p>
            <p style="color: #656565">Email : {{info.email}}</p>
            <p style="color: #656565">website : <a ng-href="{{info.website_link}}">{{info.website_link}}</a></p>
            <p style="color: #656565">Địa chỉ : {{info.detail_address}}</p>
            <p><b style="color: #0F75BB">Giờ làm việc : {{info.working_time}}</b></p>
        </div>
		<div class="left" style="margin: 0px 20px 0px 20px">
		 	<h4 class="header-hightlight">Giới thiệu về phòng khám</h4>
            <div class="post-user-content">
            	<?php echo $detail->description;?>
            </div>
		</div>
		<div class="right">
            <h4 class="header-hightlight">Nhận xét</h4>
            <div class="facebook-comment">
                <div class="fb-comments" data-href="<?php echo Common::curPageURL();?>" data-width="360px" data-numposts="5" data-colorscheme="light"></div>
            </div>
        </div>
        
    </div>
</div>
<script type="text/javascript">
   var position_info = <?php echo json_encode($detail);?>
</script>