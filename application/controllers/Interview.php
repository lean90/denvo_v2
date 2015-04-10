<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Interview extends BaseController {
	protected $authorization_required = false;
	function __construct() {
		parent::__construct ();
	}
	function ShowPage() {
		LayoutFactory::getLayout ( LayoutFactory::MAIN_BLANK )->setJavascript ()->setTitles ( "" )->render ( 'Interview' );
	}
	function send() {
		$queryString = $this->getQueryStringParams ();
		$page = isset ( $queryString ['page'] ) ? $queryString ['page'] : '';
		$post = $this->input->post ();
		$cv = null;
		$files = isset ( $_FILES ['cv'] ) && ! empty ( $_FILES ['cv'] ) ? $_FILES ['cv'] : null;
		if (gettype ( $files ) == 'array' && $files ['size'] > 0) {
			$cv = $this->saveFile ( $files );
		}
		$mailData = array (
				'interviewName' => $post ['fullname'],
				'interviewEmail' => $post ['email'],
				'interviewDescription' => $post ['description'],
				'interviewPath' => $page 
		);
		ServiceFactory::CreateMailSerivce ()->sendMailInterview ( $mailData, $cv );
		echo 'Bạn đã gửi thành công sơ yếu lý lịch </br> Nhà quản trị sẽ liên hệ sớm nhất với bạn';
	}
	function saveFile($files) {
		$fileRepository = new FileRepository ();
		$fileModel = new FileService ();
		$fileID = null;
		try {
			if (isset ( $files ['name'] )) {
				$fileInfo = $files;
				if (! $fileInfo ['name'] || ! is_uploaded_file ( $fileInfo ['tmp_name'] ) || ! file_exists ( $fileInfo ['tmp_name'] )) {
					return;
				}
				$fileID = $fileModel->handleImageUpload ( $fileInfo, $fileRepository );
			}
		} catch ( Exception $e ) {
			throw $e;
		}
		
		return $fileID;
	}
}