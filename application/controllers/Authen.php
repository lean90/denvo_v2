<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Authen extends BaseController {
	// protected $authorization_required = false;
	function __construct() {
		parent::__construct ();
	}
	function ShowPage() {
		LayoutFactory::getLayout ( LayoutFactory::MAIN )->setTitles ( 'Đăng nhập' )->render ( 'Login' );
	}
	function registor($pf) {
		switch ($pf) {
			case 'pf' :
				$this->registorViaEmail ();
				break;
			case 'facebook' :
				$this->registorViaFacbook ();
				break;
			case 'google' :
				$this->registorViaGoogle ();
				break;
		}
	}
	function registorViaFacbook() {
	}
	function registorViaGoogle() {
	}
	function registorViaEmail() {
		$post = $this->input->post ();
		$repositoryUser = new UserRepository ();
		$repositoryUser->us = $post ['client-us'];
		$checkResult = $repositoryUser->getMutilCondition ();
		if (count ( $checkResult ) > 0) {
			$url = $post ['url'];
			if (strpos ( $url, '?' ) === false) {
				$url .= '?';
			}
			$url .= '&error=1001';
			redirect ( $url );
			exit ();
		}
		$fileRepository = new FileRepository ();
		$fileservice = new FileService ();
		$fileAvatar = null;
		$files = isset ( $_FILES ['client-avatar'] ) && ! empty ( $_FILES ['client-avatar'] ) ? $_FILES ['client-avatar'] : null;
		if (gettype ( $files ) == 'array' && $files ['size'] > 0) {
			$fileAvatar = $this->saveAvatar ( $files );
		}
		
		$newformat = DateTime::createFromFormat ( 'd/m/Y', $post ['dob'] )->format ( 'Y-m-d' );
		$repositoryUser = new UserRepository ();
		$repositoryUser->us = $post ['client-us'];
		$repositoryUser->pw = md5 ( $post ['client-pw'] );
		$repositoryUser->full_name = $post ['fullname'];
		$repositoryUser->dob = $newformat;
		$repositoryUser->gender = $post ['gender'];
		$repositoryUser->avartar = $fileAvatar;
		$repositoryUser->platform = DatabaseFixedValue::USER_PLATFORM_DEFAULT;
		$repositoryUser->account_role = DatabaseFixedValue::USER_TYPE_USER;
		$repositoryUser->account_status = DatabaseFixedValue::USER_STATUS_ACTIVE;
		$repositoryUser->email = $repositoryUser->us;
		$id = $repositoryUser->insert ();
		
		$repositoryUser->activeLink = $this->config->item ( 'path_to_active_account' );
		$repositoryUser->activeLink = str_replace ( '{key}', $id, $repositoryUser->activeLink );
		$repositoryUser->activeLink = Common::getCurrentHost () . $repositoryUser->activeLink;
		ServiceFactory::CreateMailSerivce ()->sendMailRegistor ( array (
				'user' => $repositoryUser 
		), $repositoryUser->email );
		
		$data ['url'] = $post ['url'];
		LayoutFactory::getLayout ( LayoutFactory::MAIN )->setTitles ( 'Đăng ký thành công' )->setData ( $data )->render ( 'registorComplete' );
	}
	function saveAvatar($files) {
		$fileRepository = new FileRepository ();
		$fileModel = new FileService ();
		$fileID = null;
		try {
			if (isset ( $files ['name'] )) {
				$fileInfo = $files;
				if (! $fileInfo ['name'] || ! is_uploaded_file ( $fileInfo ['tmp_name'] ) || ! file_exists ( $fileInfo ['tmp_name'] )) {
					return;
				}
				list ( $imgWidth, $imgHeight, $imgType, $imgAttr ) = getimagesize ( $fileInfo ['tmp_name'] );
				$fileID = $fileModel->handleImageUpload ( $fileInfo, $fileRepository );
			}
		} catch ( Exception $e ) {
			throw $e;
		}
		return $fileID;
	}
	function logout() {
		$this->remove_obj_user_to_me ();
		$userSessionRepository = new UserSessionRepository ();
		$userSessionRepository->user_id = $this->obj_user->id;
		$userSessionRepository->activity = "LOGOUT";
		$userSessionRepository->session_id = $this->session->userdata ( 'session_id' );
		$userSessionRepository->insert ();
		$this->session->unset_userdata ( 'access_token' );
		$this->session->unset_userdata ( 'access_token_secret' );
		$this->session->unset_userdata ( 'request_token' );
		$this->session->unset_userdata ( 'request_token_secret' );
		$this->session->unset_userdata ( 'twitter_user_id' );
		$this->session->unset_userdata ( 'twitter_screen_name' );
		$this->session->unset_userdata ( 'SESSION_COUNT' );
		redirect ( 'home' );
	}
}