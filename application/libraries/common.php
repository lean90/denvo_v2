<?php
class Common {
	const SESSION_NOTIFY_KEY = '__NOTIFY__';
	static function curPageURL() {
		$pageURL = 'http';
		// if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER ["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER ["SERVER_NAME"] . ":" . $_SERVER ["SERVER_PORT"] . $_SERVER ["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER ["SERVER_NAME"] . $_SERVER ["REQUEST_URI"];
		}
		return $pageURL;
	}
	static function getCurrentHost() {
		$protocol = strtolower ( substr ( $_SERVER ["SERVER_PROTOCOL"], 0, strpos ( $_SERVER ["SERVER_PROTOCOL"], '/' ) ) ) . '://';
		return $ns = $protocol . $_SERVER ['HTTP_HOST'];
	}
	
	static function getStaticHost(){
	    $protocol = strtolower ( substr ( $_SERVER ["SERVER_PROTOCOL"], 0, strpos ( $_SERVER ["SERVER_PROTOCOL"], '/' ) ) ) . '://';
	    $array = explode(".", $_SERVER ['HTTP_HOST']);
	    $domain = (array_key_exists(count($array) - 2, $array) ? $array[count($array) - 2] : "").".".$array[count($array) - 1];
	    return $ns = $protocol .'statics.'. $domain;
	}
	
	static function getGUID() {
		if (function_exists ( 'com_create_guid' )) {
			return com_create_guid ();
		} else {
			mt_srand ( ( double ) microtime () * 10000 ); // optional for php 4.2.0 and up.
			$charid = strtoupper ( md5 ( uniqid ( rand (), true ) ) );
			$hyphen = chr ( 45 ); // "-"
			$uuid = chr ( 123 ) . 			// "{"
			substr ( $charid, 0, 8 ) . $hyphen . substr ( $charid, 8, 4 ) . $hyphen . substr ( $charid, 12, 4 ) . $hyphen . substr ( $charid, 16, 4 ) . $hyphen . substr ( $charid, 20, 12 ) . chr ( 125 ); // "}"
			return $uuid;
		}
	}
	static function redirect_notify($url, $msg = '', $success = true) {
		static::notify ( $msg, $success );
		redirect ( $url );
	}
	static function redirect_back($msg = '', $success = true) {
		if ($msg) {
			static::notify ( $msg, $success );
		}
		die ( "<html><head><meta charset=\"utf-8\"></head><body><script>window.history.go(-1);</script></body></html>" );
	}
	static function notify($msg, $success = true) {
		get_instance ()->session->set_userdata ( array (
				static::SESSION_NOTIFY_KEY => array (
						'title' => $success ? 'Cập nhật thành công' : 'Cập nhật thất bại',
						'msg' => $msg,
						'success' => $success 
				) 
		) );
	}
	static function get_notification() {
		$data = get_instance ()->session->userdata ( static::SESSION_NOTIFY_KEY );
		get_instance ()->session->set_userdata ( array (
				static::SESSION_NOTIFY_KEY => null 
		) );
		return $data;
	}
	static function nocache() {
		header ( 'Pragma: no-cache' );
		header ( 'Cache-Control: max-age=1; no-cache' );
		@session_start ();
	}
	
	/**
	 *
	 * @return UserModel;
	 */
	static function getCurrentUser() {
		$user = get_instance ()->obj_user;
		
		unset ( $user->pw );
		return $user;
	}
	
	/**
	 *
	 * @param type $key        	
	 */
	static function loadSettingKey($key) {
		return get_instance ()->loadSettingKey ( $key );
	}
}
