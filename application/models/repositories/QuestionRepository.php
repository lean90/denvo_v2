<?php
class QuestionRepository extends BaseRepository {
	protected $_constIntanceName = 'T_questions';
	var $fk_user;
	var $full_name;
	var $question;
	var $email;
	var $file_url;
	var $file_name;
	var $view_count;
	var $question_type;
	var $q_status;
	var $attached_img_1;
	var $attached_img_2;
	var $attached_img_3;
	function __construct() {
		parent::__construct ();
	}
}