<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class SendEmail extends BaseController {
	protected $authorization_required = false;
	function __construct() {
		parent::__construct ();
	}
	function ShowPage() {
		LayoutFactory::getLayout ( LayoutFactory::MAIN_BLANK )->setJavascript ( array (
				'/js/controllers/SendMailController.js',
				'/js/plugins/ckeditor/ckeditor.js' 
		) )->setTitles ( "Gửi mail" )->render ( 'SendMail' );
	}
	function send() {
		$queryString = $this->getQueryStringParams ();
		$post = $this->input->post ();
		
		$mailData = array (
				'contactName' => $post ['fullname'],
				'contactEmail' => $post ['email'],
				'contactContent' => $post ['content'] 
		);
		ServiceFactory::CreateMailSerivce ()->sendMailContact ( $mailData );
		echo "<script>window.close();</script>";
	}
}