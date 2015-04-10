<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="shortcut icon" href="/img/dento_icon_fw.ico" />
<link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<link href="/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"
	rel="stylesheet" type="text/css" />
<link href="/css/iCheck/minimal/blue.css" rel="stylesheet"
	type="text/css" />
<link href="/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<link href="/css/dento-main.css" rel="stylesheet" type="text/css" />
<!-- jQuery 2.0.2 -->
<script
	src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
</head>
<body class="skin-blue">
    <?php require_once APPPATH . VIEW_PATH . $view->view . '.php'; ?>
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
	<script src="/js/angular/ng-tags-input.min.js" type="text/javascript"></script>
	<script src="/js/angular/angular-route.min.js" type="text/javascript"></script>
	<script src="/js/angular/filters.js" type="text/javascript"></script>
	<script src="/js/angular/ng-grid.min.js" type="text/javascript"></script>
	<script src="/js/angular/ui-bootstrap-tpls-0.10.0.min.js" type="text/javascript"></script>
	<script src="/js/controllers/lynx-app.js" type="text/javascript"></script>
	<script src="/js/controllers/LynxCommon.js" type="text/javascript"></script>
	<script src="/js/controllers/LoginController.js" type="text/javascript"></script>
    
    
    <?php
				// Thêm các js riêng biệt
				foreach ( $view->javascript as $jsItem ) {
					echo '<script src="' . $jsItem . '"></script>';
				}
				?>
    
    <script type="text/javascript">
            $(document).ready(function(){
                jQuery.validator.addMethod("validate-text-only", function(value, element) {
                    return this.optional(element) || /^[a-zA-Z0-9\-]+$/i.test(value);
                  }, "Trường không thể chứa ký tự đặc biệt"); 
                $(function() {
                    $('[data-type=submit]').click(function() {
                        var $this = $(this);
                        var $form = $this.parents('form:first');
                        if ($this.attr('data-action') != '') {
                            $form.attr('action', $this.attr('data-action'));
                        }
                        $form.validate({
                            submitHandler: function(form) {
                                $(form).submit();
                              }
                        });
                    });
                    $('[data-type=reset]').click(function() {
                        var $this = $(this);
                        var $form = $this.parents('form:first');
                        $form[0].reset();
                    });
                });
            });
        </script>
</body>
</html>
