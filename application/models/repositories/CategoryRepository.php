<?php
class CategoryRepository extends BaseRepository {
	protected $_constIntanceName = 'T_category';
	var $category_id;
	var $part_url;
	var $name;
	var $visible;
	var $part_tree;
	var $order;
	var $category_type;
	function __construct() {
		parent::__construct ();
	}
	function getChildCategoriesWithOrder($categoriesId) {
		$sql = "
        SELECT * FROM `t_category`
        WHERE 
        (
            `t_category`.part_tree LIKE (SELECT  CONCAT('',`t_category`.`part_tree`,',%') FROM `t_category` WHERE `t_category`.`id` = {$categoriesId})
        OR 
            `t_category`.part_tree LIKE (SELECT  CONCAT('%,',`t_category`.`part_tree`,'') FROM `t_category` WHERE `t_category`.`id` = {$categoriesId})
        OR 
            `t_category`.part_tree = (SELECT  `t_category`.`part_tree` FROM `t_category` WHERE `t_category`.`id` = {$categoriesId})
	    ) 
        AND `delete` = 0 
        ORDER BY t_category.`category_id`,`t_category`.`order`
        ";
		$query = $this->db->query ( $sql );
		$results = $query->result ();
		$arrayPlus = array ();
		foreach ( $results as $result ) {
			if (count ( $arrayPlus ) == 0) {
				array_push ( $arrayPlus, $result );
			}
			$arrayPlus = $this->meregChild ( $arrayPlus [count ( $arrayPlus ) - 1]->id, $results, $arrayPlus );
		}
		return $arrayPlus;
	}
	function meregChild($parrentId, $results, $arrayPlus) {
		foreach ( $results as $result ) {
			if (in_array ( $result, $arrayPlus ))
				continue;
			$childId = $result->category_id;
			if ($parrentId == $childId) {
				array_push ( $arrayPlus, $result );
				$arrayPlus = $this->meregChild ( $arrayPlus [count ( $arrayPlus ) - 1]->id, $results, $arrayPlus );
			}
		}
		return $arrayPlus;
	}
	function getAllCategoriesWithOrder() {
		$sql = "
            SELECT * FROM `t_category` 
			where `delete` = 0 
			AND part_tree NOT LIKE '%46,%' 
            ORDER BY t_category.`category_id` , `t_category`.`order`
        ";
		$query = $this->db->query ( $sql );
		$results = $query->result ();
		$arrayPlus = array ();
		foreach ( $results as $result ) {
			if (! in_array ( $result, $arrayPlus )) {
				array_push ( $arrayPlus, $result );
			}
			$arrayPlus = $this->meregChild ( $arrayPlus [count ( $arrayPlus ) - 1]->id, $results, $arrayPlus );
		}
		return $arrayPlus;
	}
}