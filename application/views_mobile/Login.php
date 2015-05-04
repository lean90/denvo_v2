<div class="body-content width-960">
    <div class="login-pop dento-pop" ng-controller="LoginController">
        <ul class="login-gateway col-xs-12">
    		<li ng-click="loginFacebook()" class="facebook"></li>
    		<li ng-click="loginTwitter()" class="twister"></li>
    		<li ng-click="loginGoogle()" class="google"></li>
    		<li ng-click="loginZing()" class="zing"></li>
    	</ul>
    	<form id="login-frm">
    		<div class="form-group login-frm col-xs-12 text-left">
    			<div class="login-invalid" ng-show="error">{{loginMsg}}</div>
    			<input name="us" ng-model="us" type="text" class="form-control" placeholder="Email" /> <input name="ps" ng-model="ps" type="password" class="form-control" placeholder="Password" />
    			<p style="margin-top:10px;">
    			    <input style="width:30px;height:30px;font-size: 35px;margin-top:5px;position: absolute;" ng-model="re" id="cbkRemember" name="cbkRemember" type="checkbox" class="simple"/> <label for="cbkRemember" style="margin-left: 35px;line-height: 35px;margin-top:5px;">Ghi nhớ đăng nhập</label> 
    			</p>
    			<button type="button" ng-click="Login()" class="btn btn-primary">Đăng nhập</button>
    			<a class="resg-link" href="/register">Đăng ký</a> <a class="pass-link col-xs-12" href="/lost-password">Quên mật khẩu</a>
    		</div>
    	</form>
    </div>
</div>

