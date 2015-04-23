<?php
class UserRepository extends BaseRepository {
	protected $_constIntanceName = 'T_user';
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
	var $last_activity;
	var $status;
	function getUser($id = null) {
		if ($id == null) {
			return new UserModel ();
		} else {
			$this->id = $id;
			$result = $this->getOneById ();
			if (count ( $result ) == 0) {
				return new UserModel ();
			} else {
				$result = $result [0];
				$userModel = new UserModel ();
				$userModel->id = $result->id;
				$userModel->us = $result->id;
				$userModel->pw = $result->pw;
				$userModel->full_name = $result->full_name;
				$userModel->platform = $result->platform;
				$userModel->dob = $result->dob;
				$userModel->avartar = $result->avartar;
				$userModel->email = $result->email;
				$userModel->gender = $result->gender;
				$userModel->account_role = $result->account_role;
				$userModel->account_status = $result->account_status;
				$userModel->created_at = $result->created_at;
				$userModel->deleted_at = $result->deleted_at;
				$userModel->delete = $result->delete;
				$userModel->last_activity = $result->last_activity;
				$userModel->is_authorized = true;
				$userModel->status = $result->status;
				return $userModel;
			}
		}
	}
	function getUserOnline() {
		$minus_two_hrs = date ( "Y-m-d H:i:s", strtotime ( "-2 hours" ) );
		$timeSpan = strtotime ( $minus_two_hrs );
		$query = $this->db->query ( "SELECT COUNT(id) AS 'count_session' FROM t_user WHERE last_activity >= {$timeSpan}" );
		$results = $query->result ();
		return $results [0]->count_session;
	}
	function findUser($fullname, $email) {
		$this->db->like ( T_user::email, $email, 'both' );
		$this->db->like ( T_user::full_name, $fullname, 'both' );
		$this->db->limit ( 20, 0 );
		
		$query = $this->db->get ( T_user::tableName );
		
		$result = $query->result ();
		return $result;
	}
	function exportUser($fullname, $email) {
		$this->db->like ( T_user::email, $email, 'both' );
		$this->db->like ( T_user::full_name, $fullname, 'both' );
		$query = $this->db->get ( T_user::tableName );
		return $query->result();
	}
}