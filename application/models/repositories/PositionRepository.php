<?php
class PositionRepository extends BaseRepository {
	protected $_constIntanceName = 'T_position';
	var $fk_category;
    var $name;
    var $description;
    var $latitude;
    var $longitude;
    var $website_link;
    var $position_type;
    var $img1;
    var $img2;
    var $img3;
    var $img4;
    var $sort_description;
    var $detail_address;
    var $hotline;
    var $logo;
    var $like_number;
    var $email;
    var $working_time;
    
    function searchPosition($name,$categoryIds,$orderBy,$type,$limit,$offset){
    	$catesString = implode(",", $categoryIds);
    	$orderLogic = "ASC";
    	if($orderBy == T_position::like_number){
    		$orderLogic = "DESC";
    	}
    	if(empty($catesString)){
    		$catesString = "-1";
    	}
    	$sql = "
    	SELECT `t_position`.* FROM `t_position` INNER JOIN `t_category` ON `t_position`.`fk_category` = `t_category`.`id`
		WHERE 
		('-1' = '{$catesString}' OR `fk_category` IN ({$catesString}) ) AND 
		('' = '{$type}' OR `position_type` = '{$type}') AND 
		`t_position`.`name` LIKE CONCAT('%','{$name}','%') 
		AND `t_position`.`delete` = 0
		ORDER BY `t_category`.`name` , `t_position`.`{$orderBy}` {$orderLogic}, `t_position`.`name`
		LIMIT {$offset},{$limit}";
    	
    	if($orderBy == T_position::like_number){
    		$sql = "
    		SELECT `t_position`.* FROM `t_position` INNER JOIN `t_category` ON `t_position`.`fk_category` = `t_category`.`id`
    		WHERE
    		('-1' = '{$catesString}' OR `fk_category` IN ({$catesString}) ) AND
    		('' = '{$type}' OR `position_type` = '{$type}') AND
    		`t_position`.`name` LIKE CONCAT('%','{$name}','%')
    		AND `t_position`.`delete` = 0
    		ORDER BY `t_position`.`{$orderBy}` {$orderLogic}, `t_position`.`name`
    		LIMIT {$offset},{$limit}";
    	}
    	
    	$query = $this->db->query ( $sql );
    	$results = $query->result ();
    	return $results;
    }
    
    function getCountSearchPosition($name,$categoryIds,$type){
    	$catesString = implode(",", $categoryIds);
    	if(empty($catesString)){
    		$catesString = "-1";
    	}
    	$sql = "
    	SELECT count(id) as 'count' FROM `t_position`
    	WHERE
    	('-1' = '{$catesString}' OR `fk_category` IN ({$catesString}) ) AND
    	('' = '{$type}' OR `position_type` = '{$type}') AND
    	`t_position`.`name` LIKE CONCAT('%','{$name}','%') AND 
    	`delete` = 0";
    	$query = $this->db->query ( $sql );
    	$results = $query->result ();
    	return $results;
    }
}