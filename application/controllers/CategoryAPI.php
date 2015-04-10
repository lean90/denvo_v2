<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class CategoryAPI extends BaseController {
	function __construct() {
		parent::__construct ();
	}
	function getPostsByCategoryId($category, $parrent = null) {
		$data = array ();
		
		$parrent = $parrent == null ? '' : '/' . $parrent;
		$category = '/' . $category;
		$arrQuery = $this->getQueryStringParams ();
		$page = isset ( $arrQuery ['page'] ) ? $arrQuery ['page'] : 0;
		$pageSize = 10;
		
		$categoryRepository = new CategoryRepository ();
		$categoryRepository->part_url = $parrent . $category;
		$categories = $categoryRepository->getMutilCondition ();
		if (count ( $categories ) == 0) {
			throw new Lynx_RoutingException ( 'Không tìm thấy danh mục' );
		}
		
		$postsRepository = new PostRepository ();
		$posts = $postsRepository->getPostByParrentCategory ( $categories [0]->id, $pageSize, $page * $pageSize );
		$postsCount = $postsRepository->getPostByParrentCategoryCount ( $categories [0]->id, $pageSize, $page * $pageSize );
		
		$data = array ();
		$data ['posts'] = $posts;
		$data ['posts_count'] = $postsCount;
		$this->output->set_content_type ( 'application/json' )->set_output ( json_encode ( $data, true ) );
	}
	function getCategories($cateid = null) {
		$categoryRepository = new CategoryRepository ();
		$categories = array ();
		$categories = $cateid == "all" ? $categoryRepository->getAllCategoriesWithOrder () : $categoryRepository->getChildCategoriesWithOrder ( $cateid );
		
		$this->output->set_content_type ( 'application/json' )->set_output ( json_encode ( $categories, true ) );
	}
}