<?php
class PostRepository extends BaseRepository {
	protected $_constIntanceName = 'T_post';
	var $user_id;
	var $category_id;
	var $part_url;
	var $title;
	var $description;
	var $content;
	var $content_static;
	var $view_count;
	var $thumbnail;
	function __construct() {
		parent::__construct ();
	}
	function getPostByParrentCategory($categoryId, $limit = 10, $offset = 0) {
		$sql = "
                SELECT 
                  `t_post`.`id`,
                  `t_post`.`user_id`,
                  `t_post`.`part_url`,
                  `t_post`.`thumbnail`,
                  `t_post`.`title`,
                  `t_post`.`description`,
                  `t_post`.`content`,
                  `t_post`.`view_count`,
                  `t_post`.`created_at`,
                  `t_post`.`deleted_at`,
                  `t_post`.`delete`,
                   t_category.`id` AS 'category_id',  
                   t_category.`part_tree` AS 'part_tree',
                   t_category.`part_url` AS 'category_part_url',  
                   t_category.`name` AS 'category_name',
                   t_category.category_type as 'category_type'
                FROM  `t_post` 
                INNER JOIN t_category ON `t_post`.`category_id` = t_category.`id`
                WHERE (`t_post`.`category_id` IN 
                    (SELECT id FROM `t_category` 
                     WHERE `t_category`.`part_tree` 
                     LIKE  (SELECT CONCAT('',`t_category`.`part_tree`,',%') 
                        FROM `t_category` 
                        WHERE `t_category`.id = {$categoryId}
                        )
                    )
                OR `t_post`.`category_id` = {$categoryId})
                AND t_post.delete = 0
                ORDER BY `t_post`.`created_at` DESC
                LIMIT {$limit} OFFSET {$offset}
            ";
		$query = $this->db->query ( $sql );
		$results = $query->result ();
		return $results;
	}
	function getPostByParrentCategoryCount($categoryId) {
		$sql = "
            SELECT 
              COUNT(`t_post`.`id`) as 'count'
            FROM  `t_post` 
            INNER JOIN t_category ON `t_post`.`category_id` = t_category.`id`
            WHERE `t_post`.`category_id` IN 
                (SELECT id FROM `t_category` 
                 WHERE `t_category`.`part_tree` 
                 LIKE  (SELECT CONCAT('',`t_category`.`part_tree`,'%') 
                    FROM `t_category` 
                    WHERE `t_category`.id = {$categoryId}
                    )
                )
             AND t_post.delete = 0
        ";
		
		$query = $this->db->query ( $sql );
		$results = $query->result ();
		return $results [0]->count;
	}
	function searchPost($userid, $tagid, $keyword, $startedDate, $endedDate, $category, $limit = 10, $offset = 0) {
		$sql = "
            SELECT DISTINCT
              `t_post`.`id`,
              `t_post`.`user_id`,
              `t_post`.`part_url`,
              `t_post`.`thumbnail`,
              `t_post`.`title`,
              `t_post`.`description`,
              `t_post`.`content`,
              `t_post`.`view_count`,
              `t_post`.`created_at`,
              `t_post`.`deleted_at`,
              `t_post`.`delete`,
               t_category.`id` AS 'category_id',  
               t_category.`part_tree` AS 'part_tree',
               t_category.`part_url` AS 'category_part_url',  
               t_category.`name` AS 'category_name',
               t_category.category_type AS 'category_type',
               t_category.`visible` AS 'category_visible'
            FROM t_post 
            LEFT JOIN `t_post_tag` ON `t_post`.id = `t_post_tag`.`post_id` 
            INNER JOIN t_category ON `t_category`.`id` = `t_post`.`category_id`
            WHERE ( '{$userid}' = '' OR `t_post`.`user_id` = '{$userid}') 
            AND   ( '{$tagid}' = '' OR  `t_post_tag`.`tag_id` = '{$tagid}') 
            AND   ('{$endedDate}' = '' OR `t_post`.`created_at` < '{$endedDate}')
            AND   ('{$startedDate}' = '' OR `t_post`.`created_at` > '{$startedDate}')
            AND   ('{$category}' = '' OR t_category.id IN 
                    (SELECT id FROM `t_category` 
                     WHERE `t_category`.`part_tree` 
                     LIKE  (SELECT CONCAT('',`t_category`.`part_tree`,'%') 
                        FROM `t_category` 
                        WHERE `t_category`.id = '{$category}'
                        )
                    ))
            AND   ( t_post.`title` LIKE CONCAT('%','{$keyword}','%') OR t_post.`content` LIKE CONCAT('%','{$keyword}','%') OR t_post.`description` LIKE CONCAT('%','{$keyword}','%')) 
            AND   t_post.delete = 0 
            AND   (t_category.`visible` = 1)
            ORDER BY `t_post`.`created_at` DESC
            LIMIT {$offset},{$limit}";
		$query = $this->db->query ( $sql );
		$results = $query->result ();
		
		return $results;
	}
	function searchPostCount($userid, $tagid, $keyword, $startedDate, $endedDate, $category) {
		$sql = "
            SELECT DISTINCT
              `t_post`.id as 'id'
            FROM t_post 
            LEFT JOIN `t_post_tag` ON `t_post`.id = `t_post_tag`.`post_id` 
            INNER JOIN t_category ON `t_category`.`id` = `t_post`.`category_id`
            WHERE ( '{$userid}' = '' OR `t_post`.`user_id` = '{$userid}') 
            AND   ( '{$tagid}' = '' OR  `t_post_tag`.`tag_id` = '{$tagid}') 
            AND   ( t_post.`title` LIKE CONCAT('%','{$keyword}','%') OR t_post.`content` LIKE CONCAT('%','{$keyword}','%') OR t_post.`description` LIKE CONCAT('%','{$keyword}','%')) 
            AND   ('{$endedDate}' = '' OR `t_post`.`created_at` < '{$endedDate}')
            AND   ('{$startedDate}' = '' OR `t_post`.`created_at` > '{$startedDate}')
            AND   ('{$category}' = '' OR t_category.id IN 
                    (SELECT id FROM `t_category` 
                     WHERE `t_category`.`part_tree` 
                     LIKE  (SELECT CONCAT('',`t_category`.`part_tree`,'%') 
                        FROM `t_category` 
                        WHERE `t_category`.id = '{$category}'
                        )
                    ))
            AND   t_post.delete = 0 
            AND   (t_category.`visible` = 1)
            ";
		$query = $this->db->query ( $sql );
		$results = $query->result ();
		return count ( $results );
	}
	function getPostCountByDate($startDate, $endDate) {
		$sql = "SELECT CAST(`t_post`.`created_at` AS DATE) AS 'date', COUNT(id) AS 'count' 
                FROM `t_post`
                WHERE created_at > '{$startDate}' AND created_at < '{$endDate}'
                GROUP BY CAST(`t_post`.`created_at` AS DATE)";
		$queryResult = $this->db->query ( $sql );
		return $queryResult->result ();
	}
}