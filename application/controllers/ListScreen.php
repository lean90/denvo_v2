<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class ListScreen extends BaseController {
	function __construct() {
		parent::__construct ();
	}
	function ShowPage($category, $parrent = null) {
		$data = array ();
		
		$parrent = $parrent == null ? '' : '/' . $parrent;
		$category = '/' . $category;
		
		$categoryRepository = new CategoryRepository ();
		$categoryRepository->part_url = $parrent . $category;
		$categories = $categoryRepository->getMutilCondition ();
		if (count ( $categories ) == 0) {
			throw new Lynx_RoutingException ( 'Không tìm thấy danh mục' );
		}
		$category = $categories [0];
		if ($category->visible == 0) {
			throw new Lynx_RoutingException ( '' );
		}
		
		$categoryName = $category->name;
		$values = explode ( ',', $category->part_tree );
		$parrentCategories = $categoryRepository->getWhereIn ( T_category::id, $values );
		$data ['parrentPageCategory'] = $parrentCategories;
		
		$arrQuery = $this->getQueryStringParams ();
		$page = isset ( $arrQuery ['page'] ) ? $arrQuery ['page'] : 0;
		$pageSize = 10;
		$postsRepository = new PostRepository ();
		$posts = $postsRepository->getPostByParrentCategory ( $categories [0]->id, $pageSize, $page * $pageSize );
		$postsCount = $postsRepository->getPostByParrentCategoryCount ( $categories [0]->id, $pageSize, $page * $pageSize );
		
		$data ['posts'] = $posts;
		$data ['postsCount'] = $postsCount;
		
		$posts = array ();
		LayoutFactory::getLayout ( LayoutFactory::MAIN_DETAIL )->setData ( $data )->setJavascript ( array (
				'/js/controllers/ListController.js' 
		) )->setTitles ( $categoryName )->render ( 'list' );
	}
}