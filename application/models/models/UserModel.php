<?php
class UserModel {
	var $id;
	var $us;
	var $pw;
	var $full_name;
	var $platform;
	var $dob;
	var $avartar;
	var $email;
	var $gender;
	var $account_role;
	var $account_status;
	var $created_at;
	var $deleted_at;
	var $delete;
	var $is_authorized = FALSE;
	var $last_activity;
	var $status;
	function __construct() {
		$this->account_role = DatabaseFixedValue::USER_TYPE_USER;
	}
}