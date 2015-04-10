<?php
class SupportTicketRepository extends BaseRepository {
	protected $_constIntanceName = 'T_support_ticket';
	var $user_post;
	var $user_response;
	var $ticket_content;
	var $ticket_response;
	function __construct() {
		parent::__construct ();
	}
	function getSupportByDate($startDate, $endDate) {
		$sql = "SELECT CAST(`t_support_ticket`.`created_at` AS DATE) AS 'date', COUNT(id) AS 'count' 
                FROM `t_support_ticket`
                WHERE created_at > '{$startDate}' AND created_at < '{$endDate}'
                GROUP BY CAST(`t_support_ticket`.`created_at` AS DATE)";
		$queryResult = $this->db->query ( $sql );
		return $queryResult->result ();
	}
	function getSupportedByDate($startDate, $endDate) {
		$sql = "SELECT CAST(`t_support_ticket`.`created_at` AS DATE) AS 'date', COUNT(id) AS 'count' 
                FROM `t_support_ticket`
                WHERE created_at > '{$startDate}' AND created_at < '{$endDate}' 
                      AND `user_response` IS NOT NULL
                GROUP BY CAST(`t_support_ticket`.`created_at` AS DATE)";
		$queryResult = $this->db->query ( $sql );
		return $queryResult->result ();
	}
}