<?php
class ProfileDetailRepository extends BaseRepository {
	protected $_constIntanceName = 'T_profile_detail';
	var $profile_id;
	var $teeth_code;
	var $teeth_status;
	function __construct() {
		parent::__construct ();
	}
}