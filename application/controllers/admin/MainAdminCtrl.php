<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class MainAdminCtrl extends BaseAdminController {
	function __construct() {
		parent::__construct ();
	}
	function ShowPage() {
		$viewData = array ();
		$viewData ['supportTicketByDate'] = $this->mergeAudiByDateToArray ( $this->loadTicketSupportCount () );
		$viewData ['supportTicketHaveSupportedByDate'] = $this->mergeAudiByDateToArray ( $this->loadTicketSupportedCount () );
		$viewData ['postAddedByDate'] = $this->mergeAudiByDateToArray ( $this->loadPostAddedByDate () );
		$viewData ['sessionByDate'] = $this->mergeAudiByDateToArray ( $this->loadUserActionByDate () );
		
		LayoutFactory::getLayout ( LayoutFactory::MAIN_ADMIN )->setTitles ( 'Dashbroad' )->setData ( $viewData )->render ( 'admin/main' );
	}
	function mergeAudiByDateToArray($arr) {
		$arReturn = array ();
		for($i = 0; $i < 30; $i ++) {
			$compareDate = date ( "Y-m-d", strtotime ( "-{$i} days" ) );
			$arReturn [] = array (
					strtotime ( $compareDate ),
					0 
			);
			
			foreach ( $arr as $item ) {
				if ($compareDate == $item->date) {
					$arReturn [count ( $arReturn ) - 1] [1] = $item->count;
				}
			}
		}
		
		return $arReturn;
	}
	function loadTicketSupportCount() {
		$startDate = date ( DatabaseFixedValue::DEFAULT_FORMAT_DATE, strtotime ( "-30 days" ) );
		$endDate = date ( DatabaseFixedValue::DEFAULT_FORMAT_DATE );
		$supportTicketRespository = new SupportTicketRepository ();
		return $supportTicketRespository->getSupportByDate ( $startDate, $endDate );
	}
	function loadTicketSupportedCount() {
		$startDate = date ( DatabaseFixedValue::DEFAULT_FORMAT_DATE, strtotime ( "-30 days" ) );
		$endDate = date ( DatabaseFixedValue::DEFAULT_FORMAT_DATE );
		$supportTicketRespository = new SupportTicketRepository ();
		return $supportTicketRespository->getSupportedByDate ( $startDate, $endDate );
	}
	function loadPostAddedByDate() {
		$startDate = date ( DatabaseFixedValue::DEFAULT_FORMAT_DATE, strtotime ( "-30 days" ) );
		$endDate = date ( DatabaseFixedValue::DEFAULT_FORMAT_DATE );
		$postRepository = new PostRepository ();
		return $postRepository->getPostCountByDate ( $startDate, $endDate );
	}
	function loadUserActionByDate() {
		$startDate = date ( DatabaseFixedValue::DEFAULT_FORMAT_DATE, strtotime ( "-30 days" ) );
		$endDate = date ( DatabaseFixedValue::DEFAULT_FORMAT_DATE );
		$settingRepository = new SettingRepository ();
		return $settingRepository->getRequestCountByDate ( $startDate, $endDate );
	}
}