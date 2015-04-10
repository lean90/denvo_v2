<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LỖI HỆ THỐNG</title>
<style>
a {
	color: #ff881e;
	font-style: normal;
	text-decoration: underline;
}

a:link {
	color: #ff881e;
	font-style: normal;
	text-decoration: underline;
}

a:visited {
	color: #ff881e;
	text-decoration: underline;
}

a:hover {
	color: #888888;
	font-style: normal;
	text-decoration: underline;
}

a:active {
	text-decoration: none;
}
</style>
</head>
<body>
	<div class="wrap_gray">
		<div class="logo">
			<img src="/images/logo_exception.png" />
		</div>
		<div class="mi_title">
			<p>Lỗi xác minh</p>
		</div>
		<div class="mi_notice">
			<p class="maintain">
            <?php echo $e->title; ?>
        </p>
			<p class="orange">
            <?php echo $e->getMessage(); ?><br /> <br /> <a href="#"
					onClick="window.close(); return false;"></a>
			</p>
		</div>
		<div class="mi_copy">
			<p>Copyright © LYNX TEAM : lethanhan.bkaptech@gmail.com</p>
		</div>
		<pre style="visibility: hidden;"><?php var_dump($e);?></pre>
	</div>
<?php echo $this->layout->get_extra_footer(); ?>
</body>
</html>