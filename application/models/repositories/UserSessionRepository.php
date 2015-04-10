<?php
class UserSessionRepository extends BaseRepository {
	protected $_constIntanceName = 'T_user_session';
	var $user_id;
	var $activity;
	var $session_id;
	function insert() {
		$this->id = $this->getUUID ();
		parent::insert ();
		return $this->id;
	}
}