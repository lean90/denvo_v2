<?php
class UserModel {
	var $id;
	var $user_id;
	var $user_activity;
	var $user_urgent;
	var $user_session;
	var $created_at;
	var $deleted_at;
	var $delete;
	function __construct() {
		$this->account_role = DatabaseFixedValue::USER_TYPE_USER;
	}
}