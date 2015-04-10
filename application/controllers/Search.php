<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Search extends BaseController {
	function __construct() {
		parent::__construct ();
	}
	function ShowPage() {
		$data = array ();
		$searchInputs = $this->getQueryStringParams ();
		$userId = isset ( $searchInputs ['user_id'] ) ? $searchInputs ['user_id'] : null;
		$tagId = isset ( $searchInputs ['tag_id'] ) ? $searchInputs ['tag_id'] : null;
		$keyword = isset ( $searchInputs ['key_word'] ) ? $searchInputs ['key_word'] : null;
		$startedDate = isset ( $searchInputs ['started_date'] ) ? $searchInputs ['started_date'] : null;
		$startedDate = $startedDate == null || $startedDate == '' ? '2000/01/01 00:00:00' : DateTime::createFromFormat ( 'd/m/Y', $startedDate )->format ( DatabaseFixedValue::DEFAULT_FORMAT_DATE );
		
		$endedDate = isset ( $searchInputs ['ended_date'] ) ? $searchInputs ['ended_date'] : null;
		$endedDate = $startedDate == null || $endedDate == '' ? '2100/01/01 00:00:00' : DateTime::createFromFormat ( 'd/m/Y', $endedDate )->format ( DatabaseFixedValue::DEFAULT_FORMAT_DATE );
		
		$categoryId = isset ( $searchInputs ['category_id'] ) ? $searchInputs ['category_id'] : null;
		$showSearchPannel = isset ( $searchInputs ['show_search_pannel'] ) ? $searchInputs ['show_search_pannel'] : 1;
		$pageName = isset ( $searchInputs ['page_name'] ) ? $searchInputs ['page_name'] : 'Tìm kiếm';
		$page = isset ( $searchInputs ['page'] ) ? $searchInputs ['page'] : 0;
		
		$data ['isShowSearchPannel'] = $showSearchPannel;
		
		$postRepository = new PostRepository ();
		$posts = $postRepository->searchPost ( $userId, $tagId, $keyword, $startedDate, $endedDate, $categoryId, 10, ($page) * 10 );
		$postsCount = $postRepository->searchPostCount ( $userId, $tagId, $keyword, $startedDate, $endedDate, $categoryId );
		$data ['posts'] = $posts;
		$data ['postsCount'] = $postsCount;
		
		if ($showSearchPannel != 1) {
			LayoutFactory::getLayout ( LayoutFactory::MAIN_DETAIL )->setData ( $data )->setJavascript ( array (
					'/js/controllers/ListController.js',
					'/js/controllers/SearchFromController.js' 
			) )->setTitles ( $pageName )->render ( 'search' );
			return;
		}
		
		$categoryRepository = new CategoryRepository ();
		$categoryRepository->delete = 0;
		$categoryRepository->visible = 1;
		$allCategories = $categoryRepository->getMutilCondition ();
		$data ['categories'] = $allCategories;
		
		LayoutFactory::getLayout ( LayoutFactory::MAIN_DETAIL )->setData ( $data )->setJavascript ( array (
				'/js/controllers/ListController.js',
				'/js/controllers/SearchFromController.js' 
		) )->setTitles ( $pageName )->render ( 'search' );
	}
	function searchPostXHR() {
	}
}