<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Home extends BaseController {
	function __construct() {
		parent::__construct ();
	}
	function ShowPage() {
		$viewData = array ();
		$viewData ['banners'] = $this->loadBanner ();
		$viewData ['gks'] = $this->loadGeneralKnowledge ();
		$viewData ['knowledges'] = $this->loadFirstKnowledge ();
		$viewData ['products'] = $this->loadProduct ();
		$viewData ['games'] = $this->loadGame ();
		$viewData ['newStatus'] = $this->loadNewStatus ();
		$viewData ['histories'] = $this->loadHistory ( $this->obj_user->id );
		$viewData ['video'] = $this->loadVideo ();
		LayoutFactory::getLayout ( LayoutFactory::MAIN )->setJavascript ( array (
				"/js/controllers/ProfileHomeController.js" 
		) )->setData ( $viewData )->setTitles ( 'Trang chủ' )->render ( 'home' );
	}
	function loadFirstKnowledge() {
		$categoryRepository = new CategoryRepository ();
		$categoryRepository->part_url = "/tin-tuc/kien-thuc-chung-ve-rang-mieng";
		$results = $categoryRepository->getMutilCondition ();
		$postRepository = new PostRepository ();
		$postRepository->delete = 0;
		$postRepository->category_id = $results [0]->id;
		return $postRepository->getMutilCondition ( T_post::created_at, 'DESC', 3, 0 );
	}
	function loadVideo() {
		$settingRespository = new SettingRepository ();
		$settingRespository->id = 16;
		$results = $settingRespository->getOneById ();
		return $results [0];
	}
	function loadNewStatus() {
		$reObj = new stdClass ();
		$postRepository = new PostRepository ();
		$postRepository->created_at = date ( 'Y-m-d', strtotime ( "-2 days" ) );
		$postRepository->delete = 0;
		$results = $postRepository->getWhereGte(T_post::created_at,null,true);
		//echo $postRepository->db->last_query(); die;
		$reObj->chamSocRangMieng = false;
		$reObj->cheDoDinhDuong = false;
		$reObj->benhLy = false;
		$reObj->capNhat = FALSE;
		$reObj->video = false;
		$reObj->kienThucChung = false;
		foreach ( $results as $result ) {
			switch ($result->category_id) {
				case 2 :
				    $reObj->kienThucChung = true;
				break;
				case 4 :
				case 5 :
				case 6 :
				case 7 :
				case 8 :
					$reObj->chamSocRangMieng = true;
					break;
				case 9 :
					$reObj->cheDoDinhDuong = true;
					break;
				case 3 :
					$reObj->benhLy = true;
					break;
				case 10 :
					$reObj->capNhat = true;
					break;
				case 11 :
					$reObj->video = true;
					break;
			}
		}
		return $reObj;
	}
	function loadHistory($userId) {
		if (! isset ( $userId ) || $userId == '') {
			return array ();
		}
		
		// Load History
		$histories = array ();
		$profileRepository = new ProfileRepository ();
		$profileRepository->user_id = $userId;
		$profileResults = $profileRepository->getMutilCondition ( T_profile::created_at, 'DESC' );
		foreach ( $profileResults as $profileResult ) {
			$history = array ();
			$history ['id'] = $profileResult->id;
			$history ['user_id'] = $profileResult->user_id;
			$history ['full_name'] = $profileResult->full_name;
			$history ['dob'] = DateTime::createFromFormat ( DatabaseFixedValue::DEFAULT_FORMAT_DATE, $profileResult->dob )->format ( 'd/m/Y' );
			$history ['gender'] = $profileResult->gender;
			$history ['email'] = $profileResult->email;
			$history ['teeth_status'] = json_decode ( $profileResult->teeth_status );
			$history ['teeth_status_detail'] = array ();
			
			$profileDetailRepository = new ProfileDetailRepository ();
			$profileDetailRepository->profile_id = $profileResult->id;
			$profileDetailRepository->delete = 0;
			$profileDetailResults = $profileDetailRepository->getMutilCondition ();
			$history ['teeth_status_detail'] = array ();
			foreach ( $profileDetailResults as $profileDetailResult ) {
				array_push ( $history ['teeth_status_detail'], array (
						'code' => $profileDetailResult->teeth_code,
						'status' => json_decode ( $profileDetailResult->teeth_status ) 
				) );
			}
			if (! isset ( $profileResult->support_id ) || $profileResult->support_id == null) {
				array_push ( $histories, $history );
				continue;
			}
			$supportTicketRepository = new SupportTicketRepository ();
			$supportTicketRepository->id = $profileResult->support_id;
			$results = $supportTicketRepository->getOneById ();
			if (count ( $results ) == 0) {
				array_push ( $histories, $history );
				continue;
			}
			$history ['ticket_response'] = $results [0];
			array_push ( $histories, $history );
		}
		return $histories;
	}
	function loadGame() {
		$games = array ();
		$settingRepository = new SettingRepository ();
		$settingRepository->key = 'GAME';
		$results = $settingRepository->getMutilCondition ();
		$index = 0;
		foreach ( $results as $result ) {
			
			$postUrl = $result->value;
			$matches = array ();
			preg_match ( '/([0-9]+).html/', $postUrl, $matches );
			if (! isset ( $matches [1] [0] )) {
				$index ++;
				continue;
			}
			
			$postRepository = new PostRepository ();
			$postRepository->id = $matches [1];
			$postResults = $postRepository->getOneById ();
			
			$banner = array (
					"gameLink" => $result->value,
					"gameObject" => $postResults [0] 
			);
			
			array_push ( $games, $banner );
			$index ++;
		}
		return $games;
	}
	function loadProduct() {
		$reObj = new stdClass ();
		$postRepository = new PostRepository ();
		$postRepository->category_id = 13;
		$postRepository->delete = 0;
		$postResults = $postRepository->getMutilCondition ( T_post::created_at, 'DESC', 2, 0 );
		$reObj->banChaiDanhRang = $postResults;
		
		$postRepository = new PostRepository ();
		$postRepository->category_id = 14;
		$postRepository->delete = 0;
		$postResults = $postRepository->getMutilCondition ( T_post::created_at, 'DESC', 2, 0 );
		$reObj->kemDanhRang = $postResults;
		
		$postRepository = new PostRepository ();
		$postRepository->category_id = 15;
		$postRepository->delete = 0;
		$postResults = $postRepository->getMutilCondition ( T_post::created_at, 'DESC', 2, 0 );
		$reObj->thuoc = $postResults;
		
		$postRepository = new PostRepository ();
		$postRepository->category_id = 16;
		$postRepository->delete = 0;
		$postResults = $postRepository->getMutilCondition ( T_post::created_at, 'DESC', 2, 0 );
		$reObj->nuocSucMieng = $postResults;
		
		$postRepository = new PostRepository ();
		$postRepository->category_id = 17;
		$postRepository->delete = 0;
		$postResults = $postRepository->getMutilCondition ( T_post::created_at, 'DESC', 2, 0 );
		$reObj->khac = $postResults;
		
		return $reObj;
	}
	function loadGeneralKnowledge() {
		$generalKnowledges = array ();
		$settingRepository = new SettingRepository ();
		$settingRepository->key = 'KIEN-THUC-CHUNG';
		$results = $settingRepository->getMutilCondition ();
		$index = 0;
		foreach ( $results as $result ) {
			
			$postUrl = $result->value;
			$matches = array ();
			preg_match ( '/([0-9]+).html/', $postUrl, $matches );
			if (! isset ( $matches [1] [0] )) {
				$index ++;
				continue;
			}
			
			$postRepository = new PostRepository ();
			$postRepository->id = $matches [1];
			$postResults = $postRepository->getOneById ();
			
			$banner = array (
					"gkLink" => $result->value,
					"gkObject" => $postResults [0] 
			);
			
			array_push ( $generalKnowledges, $banner );
			$index ++;
		}
		return $generalKnowledges;
	}
	function loadBanner() {
		$banners = array ();
		$settingRepository = new SettingRepository ();
		$settingRepository->key = 'BANNER-URL';
		$results = $settingRepository->getMutilCondition ();
		
		$settingRepository->key = WEBVIEW_VERSION == 'MOBILE' ? 'BANNER_MOBILE' : 'BANNER';
		$imageResults = $settingRepository->getMutilCondition ();
		
		$index = 0;
		foreach ( $results as $result ) {
			
			$postUrl = $result->value;
			$matches = array ();
			preg_match ( '/([0-9]+).html/', $postUrl, $matches );
			if (! isset ( $matches [1] [0] )) {
				$index ++;
				continue;
			}
			
			$postRepository = new PostRepository ();
			$postRepository->id = $matches [1];
			$postResults = $postRepository->getOneById ();
			
			$banner = array (
					"BannerImage" => $imageResults [$index]->value,
					"BannerLink" => $result->value,
					"BannerObject" => $postResults [0] 
			);
			
			array_push ( $banners, $banner );
			$index ++;
		}
		return $banners;
	}
}