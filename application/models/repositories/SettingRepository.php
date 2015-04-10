<?php
class SettingRepository extends BaseRepository {
	protected $_constIntanceName = 'T_setting';
	var $key;
	var $value;
	function getcountSession() {
		$sql = "SELECT SUM(CAST(`t_setting`.`value` AS UNSIGNED)) as 'sum'
            FROM t_setting 
            WHERE `t_setting`.`key` LIKE 'REQUEST_COUNT_%'";
		$query = $this->db->query ( $sql );
		$result = $query->result ();
		return $result [0]->sum;
	}
	function getRequestCountByDate($startDate, $endDate) {
		$sql = "SELECT CAST(`t_setting`.`created_at` AS DATE) AS 'date', CAST(`t_setting`.`value` AS UNSIGNED) AS 'count' 
                FROM `t_setting`
                WHERE created_at > '{$startDate}' AND created_at < '{$endDate}'
                AND `t_setting`.`key` LIKE 'REQUEST_COUNT_%'
                GROUP BY CAST(`t_setting`.`created_at` AS DATE)";
		$queryResult = $this->db->query ( $sql );
		return $queryResult->result ();
	}
}