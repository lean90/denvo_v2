<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class BaseAdminController extends MY_Controller {
	protected $authorization_required = true;
	function __construct() {
		parent::__construct ();
	}
	function init() {
		parent::init ();
		if ($this->obj_user->account_role != 'ADMIN') {
			throw new Lynx_AuthenticationException ( 'Bạn không có quyền truy cập nội dung này' );
		}
	}
}