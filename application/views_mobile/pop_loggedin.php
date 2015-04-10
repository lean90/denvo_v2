
<script type="text/javascript">

$(document).ready(function(){
    
    $("#login-btn").click(function(e){
        $(".dento-pop").hide();
        $("#login-Pop").toggle();
        var width = $("#login-btn").width();
        width = (width - 128);
        $("#login-Pop").show();
        $("#login-Pop").css('margin-left',width+"px");
        return false;
    });
    $("#login-btn *").click(function(e){return false});
    
    $('#login-Pop .resg-link').click(function(){
        $("#resgitor-window").show();
        $("#resgitor-window .box-primary").show();
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
});

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
</script>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '<?php echo get_instance()->config->item('facebook_app_id'); ?>',
      xfbml      : true,
      version    : 'v2.0'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
 </script>

<div id="login-Pop" class="logged-pop dento-pop"
	ng-controller="LoginController">
	<span class="grow-up"></span>
	<ul>
		<li><a ng-href="{{me.informationUrl}}">Thông tin cá nhân <img
				height="40px" width="40px" ng-src="{{me.avartar}}" /></a></li>
		<li ng-show="me.account_role == 'ADMIN'"><a href="/__admin">Trang quản
				trị hệ thống</a></li>
		<li
			ng-show="me.account_role == 'COLLABORATORS' || me.account_role == 'ADMIN'"><a
			href="/search?<?php echo "user_id=".Common::getCurrentUser()->id."&page_name=Bài đăng của tôi&show_search_pannel=0" ?> ">Nội
				dung của tôi</a></li>
		<li
			ng-show="me.account_role == 'COLLABORATORS' || me.account_role == 'ADMIN'"><a
			href="/files">File đã upload</a></li>
		<li><a href="/profile/{{me.id}}/ho-so-rang-mieng">Hồ sơ răng miệng</a></li>
		<li><a href="/profile/{{me.id}}/tuoi-moc-rang">Tuổi mọc răng</a></li>
		<li><a href="/logout">Đăng xuất</a></li>
	</ul>
</div>




