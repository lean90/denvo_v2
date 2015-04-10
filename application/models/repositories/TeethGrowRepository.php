<?php
class TeethGrowRepository extends BaseRepository {
	protected $_constIntanceName = 'T_teeth_grow';
	var $support_id;
	var $user_id;
	var $full_name;
	var $dob;
	var $email;
	var $gender;
	var $history;
	var $examination_at;
	function __construct() {
		parent::__construct ();
	}
}