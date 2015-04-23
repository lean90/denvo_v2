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
	
    /*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    /*::                                                                         :*/
    /*::  This routine calculates the distance between two points (given the     :*/
    /*::  latitude/longitude of those points). It is being used to calculate     :*/
    /*::  the distance between two locations using GeoDataSource(TM) Products    :*/
    /*::                                                                         :*/
    /*::  Definitions:                                                           :*/
    /*::    South latitudes are negative, east longitudes are positive           :*/
    /*::                                                                         :*/
    /*::  Passed to function:                                                    :*/
    /*::    lat1, lon1 = Latitude and Longitude of point 1 (in decimal degrees)  :*/
    /*::    lat2, lon2 = Latitude and Longitude of point 2 (in decimal degrees)  :*/
    /*::    unit = the unit you desire for results                               :*/
    /*::           where: 'M' is statute miles                                   :*/
    /*::                  'K' is kilometers   (default)                          :*/
    /*::                  'N' is nautical miles                                  :*/
    /*::  Worldwide cities and other features databases with latitude longitude  :*/
    /*::  are available at http://www.geodatasource.com                          :*/
    /*::                                                                         :*/
    /*::  For enquiries, please contact sales@geodatasource.com                  :*/
    /*::                                                                         :*/
    /*::  Official Web site: http://www.geodatasource.com                        :*/
    /*::                                                                         :*/
    /*::         GeoDataSource.com (C) All Rights Reserved 2015		   		     :*/
    /*::                                                                         :*/
    /*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    static function distance($lat1, $lon1, $lat2, $lon2, $unit = 'K') {
    
      $theta = $lon1 - $lon2;
      $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
      $dist = acos($dist);
      $dist = rad2deg($dist);
      $miles = $dist * 60 * 1.1515;
      $unit = strtoupper($unit);
    
      if ($unit == "K") {
        return ($miles * 1.609344);
      } else if ($unit == "N") {
          return ($miles * 0.8684);
        } else {
            return $miles;
          }
    }
    static function removeVietnameseAaccents($str) {
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
}
