<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class BaseController extends MY_Controller {
	function __construct() {
		parent::__construct ();
	}
	function init() {
		parent::init ();
		if (! $this->is_ajax_request ()) {
			$sesssion = new SessionRepository ();
			$sesssion->id = $this->obj_user->id;
			$results = $sesssion->getMutilCondition ();
			$oldSession = $this->session->userdata ( 'SESSION_COUNT' );
			$currentSession = $this->session->userdata ( 'session_id' );
			if (! isset ( $oldSession ) || $oldSession != $currentSession) {
				$this->session->set_userdata ( 'SESSION_COUNT', $currentSession );
				$currentDateKey = "REQUEST_COUNT_" . date ( 'Ymd' );
				$settingRespository = new SettingRepository ();
				$settingRespository->key = $currentDateKey;
				$results = $settingRespository->getMutilCondition ();
				if (count ( $results ) == 0) {
					$settingRespository = new SettingRepository ();
					$settingRespository->key = $currentDateKey;
					$settingRespository->value = 1;
					$settingRespository->insert ();
				} else {
					$result = $results [0];
					$settingRespository = new SettingRepository ();
					$settingRespository->id = $result->id;
					$settingRespository->value = intval ( $result->value ) + 1;
					$settingRespository->updateById ();
				}
			}
		}
	}
	/**
	 * Lấy thông tin Query string.
	 * 
	 * @return array
	 */
	protected function getQueryStringParams() {
		parse_str ( $_SERVER ['QUERY_STRING'], $params );
		return $params;
	}
	function removeVietnameseAaccents($str) {
		$accents_arr = array (
				"à",
				"á",
				"ạ",
				"ả",
				"ã",
				"â",
				"ầ",
				"ấ",
				"ậ",
				"ẩ",
				"ẫ",
				"ă",
				"ằ",
				"ắ",
				"ặ",
				"ẳ",
				"ẵ",
				"è",
				"é",
				"ẹ",
				"ẻ",
				"ẽ",
				"ê",
				"ề",
				"ế",
				"ệ",
				"ể",
				"ễ",
				"ì",
				"í",
				"ị",
				"ỉ",
				"ĩ",
				"ò",
				"ó",
				"ọ",
				"ỏ",
				"õ",
				"ô",
				"ồ",
				"ố",
				"ộ",
				"ổ",
				"ỗ",
				"ơ",
				"ờ",
				"ớ",
				"ợ",
				"ở",
				"ỡ",
				"ù",
				"ú",
				"ụ",
				"ủ",
				"ũ",
				"ư",
				"ừ",
				"ứ",
				"ự",
				"ử",
				"ữ",
				"ỳ",
				"ý",
				"ỵ",
				"ỷ",
				"ỹ",
				"đ",
				"À",
				"Á",
				"Ạ",
				"Ả",
				"Ã",
				"Â",
				"Ầ",
				"Ấ",
				"Ậ",
				"Ẩ",
				"Ẫ",
				"Ă",
				"Ằ",
				"Ắ",
				"Ặ",
				"Ẳ",
				"Ẵ",
				"È",
				"É",
				"Ẹ",
				"Ẻ",
				"Ẽ",
				"Ê",
				"Ề",
				"Ế",
				"Ệ",
				"Ể",
				"Ễ",
				"Ì",
				"Í",
				"Ị",
				"Ỉ",
				"Ĩ",
				"Ò",
				"Ó",
				"Ọ",
				"Ỏ",
				"Õ",
				"Ô",
				"Ồ",
				"Ố",
				"Ộ",
				"Ổ",
				"Ỗ",
				"Ơ",
				"Ờ",
				"Ớ",
				"Ợ",
				"Ở",
				"Ỡ",
				"Ù",
				"Ú",
				"Ụ",
				"Ủ",
				"Ũ",
				"Ư",
				"Ừ",
				"Ứ",
				"Ự",
				"Ử",
				"Ữ",
				"Ỳ",
				"Ý",
				"Ỵ",
				"Ỷ",
				"Ỹ",
				"Đ",
				"?",
				'"',
				"'",
				"!",
				"(",
				")",
				"[",
				"]",
				".",
				",",
				":" 
		);
		
		$no_accents_arr = array (
				"a",
				"a",
				"a",
				"a",
				"a",
				"a",
				"a",
				"a",
				"a",
				"a",
				"a",
				"a",
				"a",
				"a",
				"a",
				"a",
				"a",
				"e",
				"e",
				"e",
				"e",
				"e",
				"e",
				"e",
				"e",
				"e",
				"e",
				"e",
				"i",
				"i",
				"i",
				"i",
				"i",
				"o",
				"o",
				"o",
				"o",
				"o",
				"o",
				"o",
				"o",
				"o",
				"o",
				"o",
				"o",
				"o",
				"o",
				"o",
				"o",
				"o",
				"u",
				"u",
				"u",
				"u",
				"u",
				"u",
				"u",
				"u",
				"u",
				"u",
				"u",
				"y",
				"y",
				"y",
				"y",
				"y",
				"d",
				"A",
				"A",
				"A",
				"A",
				"A",
				"A",
				"A",
				"A",
				"A",
				"A",
				"A",
				"A",
				"A",
				"A",
				"A",
				"A",
				"A",
				"E",
				"E",
				"E",
				"E",
				"E",
				"E",
				"E",
				"E",
				"E",
				"E",
				"E",
				"I",
				"I",
				"I",
				"I",
				"I",
				"O",
				"O",
				"O",
				"O",
				"O",
				"O",
				"O",
				"O",
				"O",
				"O",
				"O",
				"O",
				"O",
				"O",
				"O",
				"O",
				"O",
				"U",
				"U",
				"U",
				"U",
				"U",
				"U",
				"U",
				"U",
				"U",
				"U",
				"U",
				"Y",
				"Y",
				"Y",
				"Y",
				"Y",
				"D",
				"",
				"",
				"",
				"",
				"",
				"",
				"",
				"",
				"",
				"",
				"" 
		);
		
		return str_replace ( $accents_arr, $no_accents_arr, $str );
	}
	/**
	 * Load setting key
	 * 
	 * @param type $key        	
	 * @return $settingRepository
	 */
	function loadSettingKey($key) {
		$settingRepository = new SettingRepository ();
		$settingRepository->key = $key;
		$results = $settingRepository->getMutilCondition ();
		return $results;
	}
	function loadSettingPost($key) {
		$settingRepository = new SettingRepository ();
		$settingRepository->key = $key;
		$results = $settingRepository->getMutilCondition ();
		$result = $results [0];
		$postUrl = $result->value;
		if (empty ( $postUrl )) {
			throw new Lynx_ControllerMiscException ( 'không thể load setting key' );
			redirect ( "/error" );
		}
		$matches = array ();
		preg_match ( '/^-([0-9]+).html/', $postUrl, $matches, PREG_OFFSET_CAPTURE );
	}
	function getSupporter() {
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
		return $arraySetting;
	}
	function getRootUser(){
	    $settingRepository = new SettingRepository ();
	    $settingRepository->key = 'SUPPORTER';
	    $results = $settingRepository->getMutilCondition ( T_setting::id );
	    $arraySetting = array ();
	    $result = $results[0];
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
	    return $stdClass;
	}
	
	
	function getSysUserInformation() {
		$reObj = new stdClass ();
		$userRepository = new UserRepository ();
		$userRepository->delete = 0;
		$reObj->usersCount = $userRepository->getCountCondition ();
		
		$settingRepository = new SettingRepository ();
		$reObj->sessionCount = $settingRepository->getcountSession ();
		
		$sessionRepository = new SessionRepository ();
		$reObj->onlineCount = $sessionRepository->getCountCondition ();
		return $reObj;
	}
	
	
    function getNewMenuStatus() {
        $reObj = new stdClass ();
        $postRepository = new PostRepository ();
        $postRepository->created_at = date ( 'Y-m-d', strtotime ( "-1000 days" ) );
        $postRepository->delete = 0;
        $results = $postRepository->getWhereGte(T_post::created_at,null,true);
        $reObj->tintuc = false;
        $reObj->sanpham = false;
        $reObj->trochoi = false;
        $reObj->kythuat = FALSE;
        $reObj->datasource = $results;
        foreach ( $results as $result ) {
            switch ($result->category_id) {
                case 2 :case 4 :case 5 :case 6 :case 7 :case 8 :case 9 :case 3 :case 10 :case 11 :
                    $reObj->tintuc = true;
                    $result->item_type="tintuc";
                break;
                case 12 :case 13 :case 14 :case 15 :case 16 :case 19 :
                    $reObj->sanpham = true;
                    $result->item_type="sanpham";
                break;
                case 20 :case 25 :case 26 :case 27 :case 28 :case 29 :case 30 :case 31 :
                   $reObj->kythuat = true;
                   $result->item_type="kythuat";
                break;
                case 32 :case 33 :case 34 :case 35 :
                    $reObj->trochoi = true;
                    $result->item_type="trochoi";
                break;
            }
        }
        return $reObj;
    }
}