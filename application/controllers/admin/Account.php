<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Account extends BaseAdminController {
	function __construct() {
		parent::__construct ();
	}
	function ShowPage() {
		$viewData = array ();
		$userRepository = new UserRepository ();
		$results = $userRepository->findUser ( $this->input->get ( 'full_name' ), $this->input->get ( 'email' ) );
		foreach ( $results as &$result ) {
			$result->dob = ($result->dob != null || $result->dob != '') ? DateTime::createFromFormat ( DatabaseFixedValue::DEFAULT_FORMAT_DATE, $result->dob )->format ( 'd/m/Y' ) : '';
			unset ( $result->pw );
		}
		unset ( $result );
		$viewData ['findResults'] = $results;
		
		LayoutFactory::getLayout ( LayoutFactory::MAIN_ADMIN )->setTitles ( 'Quản lý tài khoản' )->setData ( $viewData )->setJavascript ( array (
				'/js/controllers/AdminAccountController.js' 
		) )->render ( 'admin/account' );
	}
	function export() {
		$url = ServiceFactory::CreateExportService ()->exportUser ( $this->input->get ( 'email' ), $this->input->get ( 'full_name' ), new UserRepository () );
		redirect ( $url );
	}
	function setPermission($userId) {
		$userRepository = new UserRepository ();
		$userRepository->id = $userId;
		$userRepository->account_role = $this->input->post ( 'permission' );
		$userRepository->updateById ();
		redirect ( $this->input->post ( 'callback' ) );
	}
	function setBannedStatus($userId) {
		$userRepository = new UserRepository ();
		$userRepository->id = $userId;
		$userRepository->account_status = $this->input->post ( 'status' );
		$userRepository->updateById ();
		redirect ( $this->input->post ( 'callback' ) );
	}
	function history($userid) {
		$userSession = new UserSessionRepository ();
		$userSession->user_id = $userid;
		$results = $userSession->getMutilCondition ( T_user_session::created_at, 'DESC', 50, 0 );
		$this->output->set_content_type ( 'application/json' )->set_output ( json_encode ( $results, true ) );
	}
	function ticketSupport($userid) {
		$subportTicket = new SupportTicketRepository ();
		$subportTicket->user_post = $userid;
		$results = $subportTicket->getMutilCondition ( T_user_session::created_at, 'DESC', 50, 0 );
		$this->output->set_content_type ( 'application/json' )->set_output ( json_encode ( $results, true ) );
	}
}