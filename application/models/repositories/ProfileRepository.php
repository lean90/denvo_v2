<?php
class ProfileRepository extends BaseRepository {
	protected $_constIntanceName = 'T_profile';
	var $support_id;
	var $user_id;
	var $full_name;
	var $dob;
	var $email;
	var $gender;
	var $teeth_status;
	var $examination_at;
	function __construct() {
		parent::__construct ();
	}
}