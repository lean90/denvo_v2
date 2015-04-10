<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class RemovePost extends BaseController {
	protected $authorization_required = true;
	function __construct() {
		parent::__construct ();
	}
	function ShowPage($category, $postId) {
		$queries = $this->getQueryStringParams ();
		$callback = isset ( $queries ['callback'] ) ? $queries ['callback'] : 'home';
		$postRepository = new PostRepository ();
		$postRepository->id = $postId;
		$postRepository->delete ();
		
		$userSessionRepository = new UserSessionRepository ();
		$userSessionRepository->user_id = $this->obj_user->id;
		$userSessionRepository->activity = "Xóa bài viết id :  {$postId}";
		$userSessionRepository->session_id = $this->session->userdata ( 'session_id' );
		$userSessionRepository->insert ();
		
		redirect ( '/' . $callback );
	}
}