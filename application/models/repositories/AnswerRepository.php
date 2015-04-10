<?php
class AnswerRepository extends BaseRepository {
	protected $_constIntanceName = 'T_answers';
	var $fk_question;
	var $fk_user;
	var $answer;
	var $total_like_number;
	function __construct() {
		parent::__construct ();
	}
	
	function getQuestionIdsOrderByLike($limit,$offset){
	   $sql = "SELECT `fk_question`,SUM(`total_like_number`) AS 'like_number' 
                FROM `t_answers`
                Where total_like_number <> 0
                AND `delete` = 0 
                GROUP BY fk_question
                ORDER BY like_number DESC
                LIMIT {$offset},{$limit}";
	    $query = $this->db->query($sql);
	    $results = $query->result();
	    return $results;
	}
	
	function getQuestionHaveLikeCount(){
		$sql = "SELECT DISTINCT `fk_question` AS 'count'
                FROM `t_answers`
                WHERE total_like_number <> 0
		        AND `delete` = 0 ";
		$query = $this->db->query($sql);
		$results = $query->result();
		if(count($results) > 0){
		  return count($results);	
		}else{
		  return 0;
		}
	}
	
	function getMostAnswer($questionid){
		$sql = "SELECT * FROM `t_answers`
                WHERE `fk_question` = {$questionid}
		        AND `delete` = 0 
                ORDER BY `total_like_number` DESC
                LIMIT 0,1";
		$query = $this->db->query($sql);
		$results = $query->result();
		if(count($results) > 0){ 
		    return $results[0];
		}else{
			return null;
		} 
	}
    
	
}