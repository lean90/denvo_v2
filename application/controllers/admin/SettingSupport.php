<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class SettingSupport extends MY_Controller {
	function __construct() {
		parent::__construct ();
	}
	function ShowPage() {
		$dataView = array ();
		$settingRepository = new SettingRepository ();
		$settingRepository->key = 'SUPPORTER';
		$results = $settingRepository->getMutilCondition ( T_setting::id );
		$arraySetting = array ();
		foreach ( $results as &$result ) {
			$userRepository = new UserRepository ();
			$userRepository->id = json_decode ( $result->value )->user;
			$userResults = $userRepository->getMutilCondition ();
			
			$stdClass = new stdClass ();
			$stdClass->user = $userResults [0];
			$stdClass->facebookUrl = json_decode ( $result->value )->facebookUrl;
			$stdClass->viberAccount = json_decode ( $result->value )->viberAccount;
			$stdClass->skypeAccount = json_decode ( $result->value )->skypeAccount;
			$stdClass->yahooAccount = json_decode ( $result->value )->yahooAccount;
			$stdClass->type = json_decode ( $result->value )->type;
			
			array_push ( $arraySetting, $stdClass );
		}
		$dataView ['setting_support'] = $arraySetting;
		
		$userRepository = new UserRepository ();
		$userRepository->id = 'ADMIN';
		$userResults = $userRepository->getMutilCondition ();
		$admins = array ();
		foreach ( $userResults as $userResult ) {
			array_push ( $admins, $userResult->email );
		}
		
		$userRepository = new UserRepository ();
		$userRepository->account_role = 'ADMIN';
		$userResults = $userRepository->getMutilCondition ();
		$admins = array ();
		foreach ( $userResults as $userResult ) {
			array_push ( $admins, $userResult->email );
		}
		$userRepository->account_role = 'COLLABORATORS';
		$userResults = $userRepository->getMutilCondition ();
		$collaborators = array ();
		foreach ( $userResults as $userResult ) {
			array_push ( $admins, $userResult->email );
		}
		$dataView ['admins'] = $admins;
		
		LayoutFactory::getLayout ( LayoutFactory::MAIN_ADMIN )->setData ( $dataView )->setTitles ( 'Cấu hình Cộng tác viên' )->render ( 'admin/setting_support' );
	}
	function save($idKey) {
		$account = $this->input->post ( 'email' );
		$facebookUrl = $this->input->post ( 'facebook-url' );
		$viberAccount = $this->input->post ( 'viber-account' );
		$skypeAccount = $this->input->post ( 'skype-account' );
		$yahooAccount = $this->input->post ( 'yahoo-account' );
		
		// load account
		$userRepository = new UserRepository ();
		$userRepository->email = $account;
		$results = $userRepository->getMutilCondition ();
		if (count ( $results ) == 0) {
			throw new Lynx_BusinessLogicException ( "Không thể lấy dữ liệu từ user" );
		}
		
		$arraySetting = array ();
		$arraySetting ['user'] = $results [0]->id;
		$arraySetting ['facebookUrl'] = $facebookUrl;
		$arraySetting ['viberAccount'] = $viberAccount;
		$arraySetting ['skypeAccount'] = $skypeAccount;
		$arraySetting ['yahooAccount'] = $yahooAccount;
		$arraySetting ['type'] = $idKey == "18" || $idKey == "17" ? 'ADMIN' : 'COLLABORATORS';
		
		$valueStr = json_encode ( $arraySetting );
		
		$settingRepository = new SettingRepository ();
		$settingRepository->id = $idKey;
		$settingRepository->value = $valueStr;
		$settingRepository->updateById ();
		
		redirect ( '/__admin/setting_support' );
	}
}