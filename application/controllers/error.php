<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Error extends BaseController {
	protected $authorization_required = false;
	public function notFound() {
		throw new Lynx_RoutingException ( 'LỖI HỆ THỐNG' );
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */