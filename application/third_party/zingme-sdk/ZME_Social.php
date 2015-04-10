<?php

/**
 * Copyright 2013 ZingMe
 * 
 */
class ZME_Social extends BaseZingMe {
	private $invite_path = "social/invite/@%s";
	private $friend_request_path = "social/addfriendrequest/@%s";
	private $post_feed_path = "social/post/@%s";
	private $post_feed_with_pics_path = "social/postwithpics/@%s";
	private $notification_path = "social/sendnotification/@%s";
	private $share_path = "social/share/@%s";
	public function __construct($config) {
		parent::__construct ( $config );
	}
	
	/**
	 * share news, feed...
	 * onto Zing Me user's wall.
	 * 
	 * @param type $access_token
	 *        	the token authorized user to be accessible to Zing Me resource
	 * @param type $name        	
	 * @param type $title        	
	 * @param type $description        	
	 * @param type $link        	
	 * @param type $action_link        	
	 * @param type $urlImg        	
	 * @return type
	 */
	public function share($access_token, $name, $title, $description, $link, $action_link, $urlImg) {
		$path = sprintf ( $this->share_path, $this->appname );
		$url = $this->getUrl ( "social", $path, "" );
		$feed_data = array (
				"access_token" => $access_token,
				"name" => $name,
				"title" => $title,
				"description" => $description,
				"link" => $link,
				"actionLink" => $action_link,
				"urlImg" => $urlImg 
		);
		
		$data = $this->sendRequest ( $url, $feed_data );
		return $data;
	}
	
	/**
	 * send invite to join app
	 *
	 * @param type $access_token,
	 *        	$uidTo, $link, $caption
	 * @return status of invite request
	 */
	public function invite($access_token, $uidTo, $link) {
		if ($uidTo < 1) {
			throw new ZingMeApiException ( - 401, "GraphAPIExcaption.Social.Invalid data", "User Id invalid" );
		}
		$path = sprintf ( $this->invite_path, $this->appname );
		
		$url = $this->getUrl ( "social", $path, '' );
		
		$data = $this->sendRequest ( $url, array (
				'access_token' => $access_token,
				'uidTo' => $uidTo,
				'link' => $link 
		) );
		return $data;
	}
	
	/**
	 * send friend request to other Zing Me user
	 *
	 * @param type $access_token        	
	 * @param type $uid        	
	 * @return status of add friend request
	 *         {"error_code":0,"error_type":"","error_message":"Successful.","data":true}
	 */
	public function addFriendRequest($access_token, $uidTo) {
		if ($uidTo < 1) {
			throw new ZingMeApiException ( - 401, "GraphAPIExcaption.Social.Invalid data", "User Id invalid" );
		}
		$path = sprintf ( $this->friend_request_path, $this->appname );
		
		$url = $this->getUrl ( "social", $path, "" );
		
		$data = $this->sendRequest ( $url, array (
				"access_token" => $access_token,
				"uidTo" => $uidTo 
		) );
		return $data;
	}
	
	/**
	 * post a feed with single image to user's wall
	 * 
	 * @param type $access_token        	
	 * @param type $name        	
	 * @param type $title        	
	 * @param type $description        	
	 * @param type $urlImg        	
	 * @param type $link        	
	 * @param type $actionLink        	
	 * @param type $useLargeImage        	
	 * @return type
	 */
	public function post($access_token, $name, $title, $description, $urlImg, $link, $actionLink, $useLargeImage = false) {
		$path = sprintf ( $this->post_feed_path, $this->appname );
		
		$url = $this->getUrl ( "social", $path, "" );
		
		$feed_data = array (
				"access_token" => $access_token,
				"name" => $name,
				"title" => $title,
				"description" => $description,
				"urlImg" => $urlImg,
				"link" => $link,
				"actionLink" => $actionLink 
		);
		
		if ($useLargeImage === true) {
			$feed_data ["wide"] = 1;
		}
		
		$data = $this->sendRequest ( $url, $feed_data );
		return $data;
	}
	
	/**
	 * send notification to your friends
	 * 
	 * @param type $access_token        	
	 * @param type $uidTo        	
	 * @param type $link        	
	 * @param type $message        	
	 * @return type
	 */
	public function sendNotification($access_token, $uidTo, $link, $message) {
		$path = sprintf ( $this->notification_path, $this->appname );
		
		$url = $this->getUrl ( "social", $path );
		
		$data = $this->sendRequest ( $url, array (
				"access_token" => $access_token,
				"fid" => $uidTo,
				"link" => $link,
				"message" => $message 
		) );
		return $data;
	}
	
	/**
	 * post feed with multiple images (using 3-image-template or 4-image-template)
	 * onto user's wall
	 */
	public function postWithPics($access_token, $name, $title, $description, $urlImgs, $link, $actionLink) {
		$path = sprintf ( $this->post_feed_with_pics_path, $this->appname );
		
		$url = $this->getUrl ( "social", $path, "" );
		
		$feed_data = array (
				"access_token" => $access_token,
				"name" => $name,
				"title" => $title,
				"description" => $description,
				"urlImg" => $urlImgs,
				"link" => $link,
				"actionLink" => $actionLink 
		);
		
		$data = $this->sendRequest ( $url, $feed_data );
		return $data;
	}
}

