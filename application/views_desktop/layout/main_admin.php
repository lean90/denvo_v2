<!DOCTYPE html>
<html ng-app="lynx">
<head>

<meta charset="UTF-8">
<title>DENTO | <?php echo $view->title;?></title>
<meta
	content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'
	name='viewport'>
<!-- bootstrap 3.0.2 -->
<link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- font Awesome -->
<link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="/css/AdminLTE.css" rel="stylesheet" type="text/css" />

<script
	src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
</head>
<body class="skin-blue">
	<!-- header logo: style can be found in header.less -->
	<header class="header">
		<a href="/__admin" class="logo"> <!-- Add the class icon to your logo image or logo icon to add the margining -->
			DENTO
		</a>
		<!-- Header Navbar: style can be found in header.less -->
		<nav class="navbar navbar-static-top" role="navigation">
			<!-- Sidebar toggle button-->
			<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas"
				role="button"> <span class="sr-only">Toggle navigation</span> <span
				class="icon-bar"></span> <span class="icon-bar"></span> <span
				class="icon-bar"></span>
			</a>
			<div class="navbar-right">
				<ul class="nav navbar-nav">
					<li class="dropdown user user-menu"><a href="#"
						class="dropdown-toggle" data-toggle="dropdown"> <i
							class="glyphicon glyphicon-user"></i> <span><?php echo Common::getCurrentUser()->full_name?><i
								class="caret"></i></span>
					</a>
						<ul class="dropdown-menu">
							<!-- User image -->
							<li class="user-header bg-light-blue"><img
								src="<?php echo Common::getCurrentUser()->avartar; ?>"
								class="img-circle" alt="User Image" />
								<p>
                                        <?php echo Common::getCurrentUser()->full_name?>
                                        <small>
                                            <?php echo DateTime::createFromFormat(DatabaseFixedValue::DEFAULT_FORMAT_DATE, Common::getCurrentUser()->dob)->format('d/m/Y'); ?>
                                        </small>
								</p></li>

							<!-- Menu Footer-->
							<li class="user-footer">
								<div class="pull-left">
									<a href="/profile/<?php Common::getCurrentUser()->id?>"
										class="btn btn-default btn-flat">Profile</a>
								</div>
								<div class="pull-right">
									<a href="/logout" class="btn btn-default btn-flat">Sign out</a>
								</div>
							</li>
						</ul></li>
				</ul>
			</div>
		</nav>
	</header>
	<div class="wrapper row-offcanvas row-offcanvas-left">
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="left-side sidebar-offcanvas">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<!-- Sidebar user panel -->
				<div class="user-panel">
					<div class="pull-left image">
						<img src="<?php echo Common::getCurrentUser()->avartar ?>"
							class="img-circle" alt="User Image" />
					</div>
					<div class="pull-left info">
						<p><?php echo Common::getCurrentUser()->full_name ?></p>

						<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
					</div>
				</div>
				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu">
					<li class="active"><a href="/__admin"> <i class="fa fa-dashboard"></i>
							<span>Dashboard</span>
					</a></li>
					<li><a href="/__admin/account"> <i class="glyphicon glyphicon-user"></i>
							<span>Tài khoản</span>
					</a></li>
					<li><a href="/__admin/setting_support"> <i
							class="fa fa-fw fa-users"></i> <span>Cộng tác viên</span>
					</a></li>
					<li><a href="/__admin/setting"> <i class="fa fa-th"></i> <span>Setting
								hệ thống</span>
					</a></li>
				</ul>
			</section>
			<!-- /.sidebar -->
		</aside>

		<!-- Right side column. Contains the navbar and content of the page -->
		<aside class="right-side">
                 <?php require_once APPPATH . VIEW_PATH . $view->view . '.php'; ?>
            </aside>
		<!-- /.right-side -->
	</div>
	<!-- ./wrapper -->


	<script src="/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="/js/plugins/input-mask/jquery.inputmask.js"
		type="text/javascript"></script>
	<script
		src="/js/plugins/input-mask/jquery.inputmask.date.extensions.js"
		type="text/javascript"></script>
	<script src="/js/plugins/input-mask/jquery.inputmask.extensions.js"
		type="text/javascript"></script>
	<script src="/js/plugins/daterangepicker/daterangepicker.js"
		type="text/javascript"></script>
	<script src="/js/plugins/colorpicker/bootstrap-colorpicker.min.js"
		type="text/javascript"></script>
	<script src="/js/plugins/timepicker/bootstrap-timepicker.min.js"
		type="text/javascript"></script>
	<script
		src="/js/plugins/DataTables-1.10.0/media/js/jquery.dataTables.min.js"></script>
	<script
		src="/js/plugins/DataTables-1.10.0/media/js/custom.dataTables.js"></script>
	<script src="/js/plugins/gritter/js/jquery.gritter.min.js"></script>
	<script src="/js/plugins/validation/jquery.validate.min.js"></script>
	<script src="/js/plugins/config-plugins.js"></script>
	<script src="/js/plugins/validation/additional-methods.min.js"></script>
	<script src="/js/AdminLTE/app.js" type="text/javascript"></script>

	<script src="/js/angular/angular.min.js" type="text/javascript"></script>
	<script src="/js/angular/angular-cookies.js" type="text/javascript"></script>
	<script src="/js/angular/ng-tags-input.min.js" type="text/javascript"></script>
	<script src="/js/angular/angular-route.min.js" type="text/javascript"></script>
	<script src="/js/angular/filters.js" type="text/javascript"></script>
	<script src="/js/angular/ng-grid.min.js" type="text/javascript"></script>
	<script src="/js/angular/ui-bootstrap-tpls-0.10.0.min.js"
		type="text/javascript"></script>
	<script src="/js/controllers/lynx-app.js" type="text/javascript"></script>
	<script src="/js/controllers/LynxCommon.js" type="text/javascript"></script>
	<script src="/js/controllers/LoginController.js" type="text/javascript"></script>
	<script src="/js/controllers/SearchPopController.js"
		type="text/javascript"></script>
        <?php
								// Thêm các js riêng biệt
								foreach ( $view->javascript as $jsItem ) {
									echo '<script src="' . $jsItem . '"></script>';
								}
								?>
    </body>
</html>
