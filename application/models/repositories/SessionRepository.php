<?php
class SessionRepository extends BaseRepository {
	protected $_constIntanceName = 'T_session';
	var $session_id;
	var $ip_address;
	var $user_agent;
	var $last_activity;
	var $user_data;
}