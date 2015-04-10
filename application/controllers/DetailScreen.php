<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class DetailScreen extends BaseController {
	function __construct() {
		parent::__construct ();
	}
	function ShowPage($pageId) {
		$data = array ();
		$postRepository = new PostRepository ();
		$postRepository->id = $pageId;
		$results = $postRepository->getOneById ();
		$result = $results [0];
		
		$data ['post'] = $result;
		$postRepository->view_count = $result->view_count + 1;
		$postRepository->updateById ();
		
		$caregoryRepository = new CategoryRepository ();
		$caregoryRepository->id = $result->category_id;
		$category = $caregoryRepository->getOneById ();
		$category = $category [0];
		$categoryParttree = preg_split ( "/\,/", $category->part_tree );
		$parrentCategories = $caregoryRepository->getWhereIn ( T_category::id, $categoryParttree );
		
		$data ['parrentPageCategory'] = $parrentCategories;
		
		$postRepository = new PostRepository ();
		$postRepository->category_id = $category->id;
		$postRepository->created_at = $result->created_at;
		$postRepository->delete = 0;
		$results = $postRepository->getWhereLte ( T_post::created_at, 10 );
		$data ['referPosts'] = $results;
		
		$postRepository = new PostRepository ();
		$postRepository->category_id = $category->visible == 1 ? $result->category_id : null;
		$postRepository->delete = 0;
		$manyViewPosts = $postRepository->getMutilCondition ( T_post::view_count, 'DESC', 5 );
		$data ['manyViewPosts'] = $manyViewPosts;
		
		LayoutFactory::getLayout ( LayoutFactory::MAIN_DETAIL )->setData ( $data )->setTitles ( $result->title )->render ( 'detail' );
	}
}