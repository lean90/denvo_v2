<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class NewPost extends BaseController {
	protected $authorization_required = true;
	function __construct() {
		parent::__construct ();
	}
	function ShowPage($category, $parrent = null) {
		$data = array ();
		$parrent = $parrent == null ? '' : '/' . $parrent;
		$categoryPath = $parrent . '/' . $category;
		
		$categoryRespository = new CategoryRepository ();
		$categoryRespository->part_url = $categoryPath;
		$categoryResult = $categoryRespository->getMutilCondition ();
		
		if (count ( $categoryResult ) == 0) {
			throw new Lynx_RoutingException ( 'Can not find categories' );
		}
		$category = $categoryResult [0];
		$data ['configCategory'] = json_encode ( $category );
		
		$categoryName = $category->name;
		$values = explode ( ',', $category->part_tree );
		$parrentCategories = $categoryRespository->getWhereIn ( T_category::id, $values );
		$data ['parrentPageCategory'] = $parrentCategories;
		
		$tagRepository = new TagRepository ();
		$tags = $tagRepository->getMutilCondition ();
		$data ['tags'] = json_encode ( $tags );
		
		LayoutFactory::getLayout ( LayoutFactory::MAIN_DETAIL )->setData ( $data )->setJavascript ( array (
				'/js/controllers/AddController.js',
				'/js/plugins/ckeditor/ckeditor.js' 
		) )->setTitles ( " Thêm mới | " . $category->name )->render ( 'add' );
	}
	function addPost() {
		$post = $this->input->post ();
		$postRespsitory = new PostRepository ();
		$postRespsitory->title = $post ['txtTitle'];
		$postRespsitory->description = $post ['txtDescription'];
		$postRespsitory->content = $post ['content'];
		$postRespsitory->content_static = isset ( $post ['content_static'] ) ? $post ['content_static'] : null;
		$postRespsitory->category_id = $post ['category'];
		$postRespsitory->user_id = $this->obj_user->id;
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
		$postId = $postRespsitory->insert ();
		$this->saveTag ( $postId );
		
		$userSessionRepository = new UserSessionRepository ();
		$userSessionRepository->user_id = $this->obj_user->id;
		$userSessionRepository->activity = "Thêm bài viêt <a href='{$postRespsitory->part_url}-{$postId}.html}'> Open </a>";
		$userSessionRepository->session_id = $this->session->userdata ( 'session_id' );
		$userSessionRepository->insert ();
		
		redirect ( "{$postRespsitory->part_url}-{$postId}.html" );
	}
	function createPath($categoryId, $title) {
		$categoryRespository = new CategoryRepository ();
		$categoryRespository->id = $categoryId;
		$category = $categoryRespository->getOneById ();
		
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
					return null;
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