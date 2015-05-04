
<script type="text/javascript">

$(document).ready(function(){
    $("#login-btn").click(function(e){
        $(".dento-pop").hide();
        $("#login-Pop").toggle();
        return false;
    });
    $('[action=callLoginDialog]').click(function(e){
        $(".dento-pop").hide();
        $("#login-Pop").toggle();
        return false;
    });
    
    $("#login-frm").click(function(e){return false;});
    
    $('#login-Pop .resg-link').click(function(){
        $("#resgitor-window").show();
        $("#resgitor-window .box-primary").show();
    });
    $('#login-Pop .pass-link').click(function(){
        window.location = "/lost-password";
    });
    
    $("#resgitor-window-frm").validate({
        ignore: ".ignore",
        invalidHandler: function(event, validator) {
        }
    });
    $("#url").val(location.href);
    $error = getParameterByName('error');
    if($error == 1001){
        $("#login-Pop").show();
        $("#resgitor-window").show();
        $("#alert-email-exist").show();
    }
});
$(document).ready(function(){
    $('#resgitor-window #close-btn').on('click',function(){
        $("#resgitor-window").hide();
    });

    $("#btn-registor").on('click',function(){
        var validResult = $('#resgitor-window-frm').validate();
        if(validResult.errorList.length == 0){
            $("#resgitor-window-frm").submit();
            }
    });
});

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
</script>


<div id="login-Pop" class="login-pop dento-pop" ng-controller="LoginController">
    <ul class="login-gateway col-xs-12">
        <li ng-click="loginFacebook()" class="facebook"></li>
        <li ng-click="loginTwitter()" class="twister"></li>
        <li ng-click="loginGoogle()" class="google"></li>
        <li ng-click="loginZing()" class="zing"></li>
    </ul>
    <form id="login-frm">
        <div class="form-group login-frm col-xs-12 text-left">
            <div class="login-invalid" ng-show="loginedResult">{{loginMsg}}</div>
            <input name="us" ng-model="us" type="text" class="form-control" placeholder="Email" /> <input name="ps" ng-model="ps" type="password" class="form-control" placeholder="Password" />
            <div class="checkbox text-left">
                <label class="">
                    <div class="icheckbox_minimal" aria-checked="false" aria-disabled="false" style="position: relative; margin-top: -3px;">
                        <input ng-model="re" name="cbkRemember" type="checkbox" style="position: absolute; opacity: 0;">
                        <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins>
                    </div> Ghi nhớ đăng nhập
                </label>
            </div>
            <button type="button" ng-click="Login()" class="btn btn-primary">Đăng nhập</button>
            <a class="resg-link" href="#">Đăng ký</a> <a class="pass-link col-xs-12" href="/lost_password">Quên mật khẩu</a>
        </div>
    </form>
</div>



<div id="resgitor-window" class="page-mark text-left" style="display: none">
    <form id="resgitor-window-frm" action="/register/pf" method="post" enctype="multipart/form-data">
        <input id="url" name="url" type="hidden" />
        <div class="model-dialog resg-window">
            <div class="box box-primary" style="display: inline-block;">
                <div class="box-header" title="">
                    <h3 class="box-title">Đăng ký tài khoản</h3>
                    <div class="box-tools pull-right">
                        <button id="close-btn" class="btn btn-primary btn-xs" data-widget="remove">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body col-xs-12" style="display: inline-block;">
                    <div id="alert-email-exist" class="alert alert-danger alert-dismissable" style="display: none">
                        <i class="fa fa-ban"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Địa chỉ mail đã được sử dụng.
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="client-us">Email address</label> <input id="client-us" name="client-us" type="email" required aria-required="true" class="form-control" placeholder="Enter email">
                    </div>
                    <div class="form-group col-xs-6">
                        <label for="client-pw">Mật khẩu</label> <input id="client-pw" name="client-pw" type="password" minlength="6" maxlength="56" required aria-required="true" class="form-control" placeholder="Mật khẩu">
                        <p class="help-block">Mật khẩu từ 6 - 56 ký tự</p>
                    </div>
                    <div class="form-group col-xs-6">
                        <label for="re-password">Nhập lại mật khẩu</label> <input id="re-password" equalTo="#client-pw" type="password" minlength="6" maxlength="56" required aria-required="true" class="form-control" placeholder="Nhập lại mật khẩu">
                    </div>
                    <div class="form-group col-xs-12"></div>
                    <div class="form-group col-xs-6">
                        <label for="fullname">Họ và tên</label> <input id="fullname" name="fullname" type="text" class="form-control" required aria-required="true" placeholder="Họ và tên" />
                    </div>
                    <div class="form-group col-xs-6">
                        <label for="dob">Ngày sinh</label> <input id="dob" name="dob" required type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" placeholder="Ngày/Tháng/Năm" />
                    </div>
                    <div class="form-group col-xs-6">
                        <label for="dob">Giới tính</label> <select name="gender" class="form-control">
                            <option value="MALE">Nam</option>
                            <option value="FMALE">Nữ</option>
                            <option value="OTHER">Khác</option>
                        </select>
                    </div>
                    <div class="form-group col-xs-6">
                        <label for="avatar">Ảnh đại diện</label> <input name="client-avatar" accept="image/x-png, image/gif, image/jpeg" type="file" id="avatar" />
                    </div>

                    <div class="form-group col-xs-12">
                        <div class="checkbox">
                            <label class="">
                                <div class="icheckbox_minimal" aria-checked="false" aria-disabled="false" style="position: relative;">
                                    <input id="chkagree" name="chkagree" type="checkbox" style="position: absolute; opacity: 0;" required />
                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins>
                                </div> Tôi đồng ý với <a href="/gioi-thieu/dieu-khoan-su-dung-200.html">điều khoản sử dùng <a /> của website. 
                            
                            </label>
                        </div>
                    </div>
                    <div></div>
                </div>
                <div class="box-footer col-xs-12 text-right" style="display: inline-block;">
                    <button id="btn-registor" data-type="submit" class="btn btn-primary">Đăng ký</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">


</script>



