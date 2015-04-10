<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class EditPost extends BaseController {
	protected $authorization_required = true;
	function __construct() {
		parent::__construct ();
	}
	function ShowPage($category, $postId) {
		$data = array ();
		
		$postRepository = new PostRepository ();
		$postRepository->id = $postId;
		$posts = $postRepository->getOneById ();
		if (count ( $posts ) == 0) {
			throw new Exception ( 'Không tìm thấy bài viết' );
		}
		$post = $posts [0];
		$data ['post'] = $post;
		
		$caregoryRepository = new CategoryRepository ();
		$caregoryRepository->id = $post->category_id;
		$category = $caregoryRepository->getOneById ();
		$category = $category [0];
		$categoryParttree = preg_split ( "/\,/", $category->part_tree );
		$parrentCategories = $caregoryRepository->getWhereIn ( T_category::id, $categoryParttree );
		$data ['category'] = $category;
		$data ['parrentPageCategory'] = $parrentCategories;
		
		$postTagRepository = new PostTagRepository ();
		$postTagRepository->post_id = $post->id;
		$postTagRepository->delete = 0;
		$postTags = $postTagRepository->getMutilCondition ();
		$arrTagId = array ();
		foreach ( $postTags as $postTag ) {
			array_push ( $arrTagId, $postTag->tag_id );
		}
		
		$tagRepository = new TagRepository ();
		$tags = $tagRepository->getWhereIn ( T_tag::id, $arrTagId );
		$data ['tags'] = $tags;
		
		LayoutFactory::getLayout ( LayoutFactory::MAIN_DETAIL )->setData ( $data )->setJavascript ( array (
				'/js/controllers/EditController.js',
				'/js/plugins/ckeditor/ckeditor.js' 
		) )->setTitles ( " Chỉnh sửa | " . $category->name )->render ( 'edit' );
	}
	function editPost($category, $postId) {
		$post = $this->input->post ();
		$postRespsitory = new PostRepository ();
		$postRespsitory->id = $post ['post_id'];
		$postRespsitory->title = $post ['txtTitle'];
		$postRespsitory->description = $post ['txtDescription'];
		$postRespsitory->content = $post ['content'];
		$postRespsitory->category_id = $post ['category'];
		$postRespsitory->user_id = $this->obj_user->id;
		$postRespsitory->content_static = isset ( $post ['content_static'] ) ? $post ['content_static'] : null;
		$postRespsitory->part_url = $this->createPath ( $post ['category'], $post ['txtTitle'] );
		$fileAvatar = null;
		$files = isset ( $_FILES ['thumbnail'] ) && ! empty ( $_FILES ['thumbnail'] ) ? $_FILES ['thumbnail'] : '';
		if (gettype ( $files ) == 'array' && $files ['size'] > 0) {
			$fileAvatar = $this->saveAvatar ( $files );
		}
		if ($fileAvatar == null && isset ( $post ['thumbnail'] )) {
			$fileAvatar = $post ['thumbnail'];
		}
		$postRespsitory->thumbnail = $fileAvatar;
		$postRespsitory->updateById ();
		$this->saveTag ( $postRespsitory->id );
		
		$postRespsitory = new PostRepository ();
		$postRespsitory->id = $post ['post_id'];
		$posts = $postRespsitory->getOneById ();
		$post = $posts [0];
		
		$userSessionRepository = new UserSessionRepository ();
		$userSessionRepository->user_id = $this->obj_user->id;
		$userSessionRepository->activity = "Sửa bài viết :  <a href='{$post->part_url}-{$post->id}.html'>Open</a>";
		$userSessionRepository->session_id = $this->session->userdata ( 'session_id' );
		$userSessionRepository->insert ();
		
		redirect ( "{$post->part_url}-{$post->id}.html" );
	}
	function createPath($categoryId, $title) {
		$categoryRespository = new CategoryRepository ();
		$categoryRespository->id = $categoryId;
		$category = $categoryRespository->getOneById ();
		if ($category [0]->category_type == 'STATIC') {
			return;
		}
		$categoryPath = $category [0]->part_url;
		$categoryPathCollection = preg_split ( "/\//", $categoryPath );
		$categoryPath = $categoryPathCollection [count ( $categoryPathCollection ) - 1];
		$postPath = strtolower ( $this->removeVietnameseAaccents ( $title ) );
		$postPath = str_replace ( " ", "-", $postPath );
		return "/{$categoryPath}/{$postPath}";
	}
	function saveAvatar($files) {
		$fileRepository = new FileRepository ();
		$fileModel = new FileService ();
		$fileID = null;
		try {
			if (isset ( $files ['name'] )) {
				$fileInfo = $files;
				if (! $fileInfo ['name'] || ! is_uploaded_file ( $fileInfo ['tmp_name'] ) || ! file_exists ( $fileInfo ['tmp_name'] )) {
					return;
				}
				list ( $imgWidth, $imgHeight, $imgType, $imgAttr ) = getimagesize ( $fileInfo ['tmp_name'] );
				$fileID = $fileModel->handleImageUpload ( $fileInfo, $fileRepository );
			}
		} catch ( Exception $e ) {
			throw $e;
		}
		
		return $fileID;
	}
	function saveTag($postId) {
		$post = $this->input->post ();
		$tags = json_decode ( $post ['tags'] );
		
		$postTagRepository = new PostTagRepository ();
		$postTagRepository->post_id = $postId;
		$postTagRepository->delete = 0;
		$olds = $postTagRepository->getMutilCondition ();
		foreach ( $olds as $refer ) {
			$postTagRepository = new PostTagRepository ();
			$postTagRepository->id = $refer->id;
			$postTagRepository->delete ();
		}
		
		foreach ( $tags as $tag ) {
			$tagRepository = new TagRepository ();
			if (! isset ( $tag->id )) {
				$tagRepository->value = str_replace ( '-', ' ', $tag->value );
				$tag->id = $tagRepository->insert ();
			}
			$postTagRepository = new PostTagRepository ();
			$postTagRepository->post_id = $postId;
			$postTagRepository->tag_id = $tag->id;
			$postTagRepository->insert ();
		}
	}
}