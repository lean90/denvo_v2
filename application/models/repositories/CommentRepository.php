<?php
class CommentRepository extends BaseRepository {
	protected $_constIntanceName = 'T_comment';
	var $user_id;
	var $post_id;
	var $comment;
	var $visible;
}