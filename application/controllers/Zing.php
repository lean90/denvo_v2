<?php

/*
 * To change this license header, choose License Headers in Project Properties. To change this template file, choose Tools | Templates and open the template in the editor.
 */
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
require_once APPPATH . '/third_party/zingme-sdk/Zing.inc';
class Zing extends MY_Controller {
	protected $zing;
	function __construct() {
		parent::__construct ();
		$this->config->load ( 'zing' );
		$this->zing = new ZME_Me ( $this->config->item ( 'Zing_config' ) );
	}
	function auth() {
		$page = $this->input->get ( 'page' );
		$this->session->set_userdata ( 'oauthen_redirect', isset ( $page ) ? $page : "/" );
		$url = $this->zing->getUrlAuthorized ( Common::getCurrentHost () . '/zing/callback' );
		redirect ( $url );
	}
	function callback() {
		$redirect = $this->session->userdata ( 'oauthen_redirect' );
		$this->session->unset_userdata ( 'oauthen_redirect' );
		
		$code = $this->input->get ( 'code' );
		if (! isset ( $code ) || $code == '') {
			throw new Lynx_EmptyDataSetException ( 'zing $access_token is null' );
		}
		
		$access_token = $this->zing->getAccessTokenFromCode ( $code );
		
		$info = $this->zing->getInfo ($access_token['access_token'],'id,username,displayname,tinyurl,profile_url,gender,dob');
		
		$userRepository = new UserRepository ();
		$userRepository->us = $info['id'];
		$userRepository->platform = DatabaseFixedValue::USER_PLATFORM_ZING;
		$checkResults = $userRepository->getMutilCondition ();
		
		$userId = null;
		if(count($checkResults) == 0){
		    $userRepository = new UserRepository ();
		    $userRepository->us = $info['id'];
		    $userRepository->full_name = $info['displayname'];
		    $userRepository->avartar = $info['tinyurl'];
		    $userRepository->dob = date(DatabaseFixedValue::DEFAULT_FORMAT_DATE,$info['dob']);
		    $userRepository->account_status = 1;
		    $userRepository->account_role = DatabaseFixedValue::USER_TYPE_USER;
		    $userRepository->platform = DatabaseFixedValue::USER_PLATFORM_ZING;
		    $userId = $userRepository->insert ();
		}else{
		    $userRepository = new UserRepository ();
		    $userRepository->id = $checkResults[0]->id;
		    $userRepository->us = $info['id'];
		    $userRepository->full_name = $info['displayname'];
		    $userRepository->avartar = $info['tinyurl'];
		    $userRepository->dob = date(DatabaseFixedValue::DEFAULT_FORMAT_DATE,$info['dob']);
		    $userRepository->updateById ();
		    $userId = $checkResults [0]->id;
		}
		$userModel = $userRepository->getUser ( $userId );
		$this->set_obj_user_to_me ( $userModel );
		
		$userSessionRepository = new UserSessionRepository ();
		$userSessionRepository->user_id = $this->obj_user->id;
		$userSessionRepository->activity = "LOGIN";
		$userSessionRepository->session_id = $this->session->userdata ( 'session_id' );
		$userSessionRepository->insert ();
		redirect ( isset($redirect) && $redirect != "" ? $redirect : "/" );
	}
}