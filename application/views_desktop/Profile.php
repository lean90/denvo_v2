<style type="text/css">
.css-form input.ng-invalid.ng-dirty {
	background-color: #FA787E;
}

.css-form input.ng-valid.ng-dirty {
	background-color: #78FA89;
}
</style>
<script type="text/javascript">
    var histories = <?php echo json_encode($histories);?>;
</script>
<div class="anchor-tab anchor-tab-tu-van">
    <ul class="text-left">
        <li><a href="/home#banner"></a></li>
        <li><a href="/home#news"></a></li>
        <li><a href="/home#drugs"></a></li>
        <li><a href="/home#games"></a></li>
        <li><a href="/home#support"></a></li>
        <li><a href="/home#footer"></a></li>
    </ul>
</div>
<div class="body-content width-960" ng-controller="ProfileController">
    <form id="profile-support-frm" action="/profile/<?php echo $userid?>/ho-so-rang-mieng/send_support" novalidate method="post" enctype="multipart/form-data">
        <input name="data" type="hidden" value="{{getPostDataForSupport()}}" />
    </form>
    <form id="profile-support-response-frm" action="/profile/<?php echo $userid?>/ho-so-rang-mieng/response_support" novalidate method="post" enctype="multipart/form-data">
        <input name="data" type="hidden" value="{{getSupportFrmData()}}" />
    </form>
    <form id="profile-frm" novalidate method="post" enctype="multipart/form-data">
        <div class="scrum-map width-960px">
            <div class="current-page"><?php echo $view->title;?></div>
            <ul class="map">
                <li><a href="/home">Trang chủ</a><span>&gt;</span></li>
                <li><a href="/home">Tư vấn</a><span>&gt;</span></li>
                <li><a href="/">Hồ sơ răng miệng</a><span>&gt;</span></li>
            </ul>
        </div>
        <input name="data" type="hidden" value="{{getPostData()}}" /> <input name="send" type="hidden" ng-model="isSendEmail" />
        <div class="detail-view post-view width-960">
            <div class="left">
                <div class="head">Hồ sơ răng miệng</div>
                <a href="#" ng-click="showCreateFrm()" class="btn btn-primary" ng-show="!onCreateNewProfile"> <i class="glyphicon glyphicon-plus-sign"></i> &nbsp; Thêm hồ sơ
                </a>
                    <?php include APPPATH.VIEW_PATH.'/ProfileNew.php'; ?>
                    <div class="panel-group" id="accordion" style="margin-top: 15px">
                    <div class="panel panel-default" ng-repeat="history in histories">
                        <div class="panel-heading" style="border-radius: 0px;">
                            <h4 class="panel-title" ng-click="changeSelectedProfile(history)" data-toggle="collapse" data-parent="#accordion" href="#collapse{{history.id}}" style="cursor: pointer">
                                <a> {{history.full_name}} ({{history.dob}}) </a>
                            </h4>
                        </div>
                        <div id="collapse{{history.id}}" class="panel-collapse collapse">
                            <div class="panel-body" ng-show="selectedHistoryTemplate == 'view.html'" style="padding: 10px 0px 10px 0px" ng-include="'view.html'"></div>
                            <div class="panel-body" ng-show="selectedHistoryTemplate == 'edit.html'" style="padding: 10px 0px 10px 0px" ng-include="'edit.html'"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right clear-bg">
                <div class="right">
                        <?php include APPPATH.VIEW_PATH.'/many_view_time.php'; ?>
                        
                    </div>
                <div class="right clear-bg">
                    <ul class="link-shortcut">
                        <li><a href="/timeline/rang-sua"><img alt="" src="/img/link_RS.fw.png"></a></li>
                        <li><a href="/timeline/rang-vinh-vien"><img alt="" src="/img/link_RVV.fw.png"></a></li>
                        <li style="display: <?php echo  isset(Common::getCurrentUser()->id) ? "block" : 'none'; ?>"><a href="/profile/<?php echo Common::getCurrentUser()->id;?>/tuoi-moc-rang"><img alt="" src="/img/link_tmr.fw.png"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/ng-template" id="view.html">
    <?php include APPPATH.VIEW_PATH.'/ProfileDetail.php'; ?>
</script>
<script type="text/ng-template" id="edit.html">
    <?php include APPPATH.VIEW_PATH.'/ProfileEdit.php'; ?>
</script>
<script type="text/javascript">
    $(document).ready(function(){
       if(me.account_role == undefined || me.account_role == 'USER' ){
           $("#addbtn").hide();
       }
        
        $(window).scroll(function(e){
            var scrollTop = $(window).scrollTop();
            if(scrollTop > 130){
                $('.anchor-tab').show();
                $('.menu-conatiner').hide().fadeOut( "slow" );
                $('body .header').css('min-height','85px');
                $('body .header').css('background-image','none');
            }else{
                $('.anchor-tab').hide().fadeOut( "slow" );
                $('.menu-conatiner').show();
                $('body .header').css('min-height','120px');
                $('body .header').css('background-image','url(/img/Head_bg.fw.png)');
                
            }
        });
    });
</script>
