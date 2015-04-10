<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
set_include_path ( APPPATH . 'third_party/' . PATH_SEPARATOR . get_include_path () );
require_once APPPATH . 'third_party/Google/Client.php';
require_once APPPATH . 'third_party/Google/Service/Oauth2.php';
class Google extends BaseController {
	protected $authorization_required = false;
	protected $client;
	function __construct() {
		parent::__construct ();
		$this->config->load ( 'google' );
		$this->client = new Google_Client ();
		$this->client->setClientId ( $this->config->item ( 'google_client_id' ) );
		$this->client->setClientSecret ( $this->config->item ( 'google_client_secret' ) );
		$this->client->addScope ( array (
				"https://www.googleapis.com/auth/plus.me",
				"https://www.googleapis.com/auth/userinfo.email",
				"https://www.googleapis.com/auth/userinfo.profile" 
		) );
		$this->client->setRedirectUri ( Common::getCurrentHost () . '/google/callback' );
	}
	function auth() {
		$url = $this->client->createAuthUrl ();
		$page = $this->input->get ( 'page' );
		$this->session->set_userdata ( 'oauthen_redirect', isset ( $page ) ? $page : "/" );
		redirect ( $url );
	}
	function callback() {
		$accessToken = $this->input->get ( "code" );
		if (! isset ( $accessToken )) {
			throw Lynx_ModelMiscException ( "Lỗi bất thường login hệ thông" );
		}
		$this->client->authenticate ( $accessToken );
		$oauth2 = new Google_Service_Oauth2 ( $this->client );
		$userInfo = $oauth2->userinfo->get ();
		$userRepository = new UserRepository ();
		$userRepository->us = $userInfo->id;
		$userRepository->platform = DatabaseFixedValue::USER_PLATFORM_GOOGLE;
		$results = $userRepository->getMutilCondition ();
		$id = null;
		if (count ( $results ) == 0) {
			$userRepository = new UserRepository ();
			$userRepository->us = $userInfo->id;
			$userRepository->gender = $userInfo->gender == "male" ? "MALE" : "FMALE";
			$userRepository->full_name = $userInfo->name;
			$userRepository->avartar = $userInfo->picture;
			$userRepository->account_status = 1;
			$userRepository->account_role = DatabaseFixedValue::USER_TYPE_USER;
			$userRepository->platform = DatabaseFixedValue::USER_PLATFORM_GOOGLE;
			$id = $userRepository->insert ();
		} else {
			$userRepository = new UserRepository ();
			$userRepository->us = $results [0]->id;
			$userRepository->gender = $userInfo->gender == "male" ? "MALE" : "FMALE";
			$userRepository->full_name = $userInfo->name;
			$userRepository->avartar = $userInfo->picture;
			$userRepository->account_status = 1;
			$userRepository->account_role = DatabaseFixedValue::USER_TYPE_USER;
			$userRepository->platform = DatabaseFixedValue::USER_PLATFORM_GOOGLE;
			$userRepository->updateById ();
			$id = $results [0]->id;
		}
		$userModel = $userRepository->getUser ( $id );
		$this->set_obj_user_to_me ( $userModel, TRUE );
		$redirect = $this->session->userdata ( 'oauthen_redirect' );
		$this->session->unset_userdata ( 'oauthen_redirect' );
		
		$userSessionRepository = new UserSessionRepository ();
		$userSessionRepository->user_id = $this->obj_user->id;
		$userSessionRepository->activity = "LOGIN";
		$userSessionRepository->session_id = $this->session->userdata ( 'session_id' );
		$userSessionRepository->insert ();
		
		redirect ( $redirect );
	}
}