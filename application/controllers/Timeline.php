<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Timeline extends BaseController {
	protected $authorization_required = FALSE;
	function __construct() {
		parent::__construct ();
	}
	function rs() {
		$data = array ();
		
		$postRepository = new PostRepository ();
		$postRepository->category_id = 5;
		$postRepository->delete = 0;
		$manyViewPosts = $postRepository->getMutilCondition ( T_post::view_count, 'DESC', 5 );
		
		$data ['manyViewPosts'] = $manyViewPosts;
		
		$currentDateKey = "REQUEST_TIMELINE_RS_COUNT_" . date ( 'Ymd' );
		$settingRespository = new SettingRepository ();
		$settingRespository->key = $currentDateKey;
		$results = $settingRespository->getMutilCondition ();
		if (count ( $results ) == 0) {
			$settingRespository = new SettingRepository ();
			$settingRespository->key = $currentDateKey;
			$settingRespository->value = 1;
			$settingRespository->insert ();
		} else {
			$result = $results [0];
			$settingRespository = new SettingRepository ();
			$settingRespository->id = $result->id;
			$settingRespository->value = intval ( $result->value ) + 1;
			$settingRespository->updateById ();
		}
		
		LayoutFactory::getLayout ( LayoutFactory::MAIN_DETAIL )->setData ( $data )->setJavascript ( array (
				'/js/controllers/TimelineRSController.js' 
		) )->setTitles ( " Timeline | Răng sữa" )->render ( 'TimelineRS' );
	}
	function rvv() {
		$data = array ();
		
		$postRepository = new PostRepository ();
		$postRepository->category_id = 9;
		$postRepository->delete = 0;
		$manyViewPosts = $postRepository->getMutilCondition ( T_post::view_count, 'DESC', 5 );
		
		$currentDateKey = "REQUEST_TIMELINE_RVV_COUNT_" . date ( 'Ymd' );
		$settingRespository = new SettingRepository ();
		$settingRespository->key = $currentDateKey;
		$results = $settingRespository->getMutilCondition ();
		if (count ( $results ) == 0) {
			$settingRespository = new SettingRepository ();
			$settingRespository->key = $currentDateKey;
			$settingRespository->value = 1;
			$settingRespository->insert ();
		} else {
			$result = $results [0];
			$settingRespository = new SettingRepository ();
			$settingRespository->id = $result->id;
			$settingRespository->value = intval ( $result->value ) + 1;
			$settingRespository->updateById ();
		}
		
		$data ['manyViewPosts'] = $manyViewPosts;
		LayoutFactory::getLayout ( LayoutFactory::MAIN_DETAIL )->setData ( $data )->setJavascript ( array (
				'/js/controllers/TimelineRVVController.js' 
		) )->setTitles ( " Timeline | Răng vinh viễn" )->render ( 'TimelineRVV' );
	}
}