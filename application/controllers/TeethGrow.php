<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class TeethGrow extends BaseController {
	protected $authorization_required = true;
	function __construct() {
		parent::__construct ();
	}
	function ShowPage($userId) {
		$data = array ();
		$userRepository = new UserRepository ();
		$userRepository->id = $userId;
		$users = $userRepository->getOneById ();
		if (count ( $users ) == 0) {
			throw new Lynx_RequestException ( 'Hồ sơ cá nhân không tồn tại' );
		}
		if ($users [0]->id != $this->obj_user->id && ! ($this->obj_user->account_role == 'ADMIN' || $this->obj_user->account_role == 'COLLABORATORS')) {
			throw new Lynx_RoutingException ( 'Bạn không có quyền truy cập' );
		}
		
		$postRepository = new PostRepository ();
		$postRepository->category_id = 2;
		$postRepository->delete = 0;
		$manyViewPosts = $postRepository->getMutilCondition ( T_post::view_count, 'DESC', 5 );
		$data ['manyViewPosts'] = $manyViewPosts;
		
		$data ['histories'] = $this->loadHistory ( $userId );
		$data ['userid'] = $userId;
		
		LayoutFactory::getLayout ( LayoutFactory::MAIN_DETAIL )->setData ( $data )->setJavascript ( array (
				'/js/controllers/TeethGrowController.js',
				'/js/plugins/ckeditor/ckeditor.js' 
		) )->setTitles ( " Tư vấn - " . $users [0]->full_name )->render ( 'TeethGrow' );
	}
	function loadHistory($userId) {
		// Load History
		$histories = array ();
		$teethGrowRepository = new TeethGrowRepository ();
		$teethGrowRepository->user_id = $userId;
		$results = $teethGrowRepository->getMutilCondition ( T_profile::created_at, 'DESC' );
		foreach ( $results as $result ) {
			$history = array ();
			$history ['id'] = $result->id;
			$history ['user_id'] = $result->user_id;
			$history ['full_name'] = $result->full_name;
			$history ['dob'] = DateTime::createFromFormat ( DatabaseFixedValue::DEFAULT_FORMAT_DATE, $result->dob )->format ( 'd/m/Y' );
			$history ['examination_at'] = empty ( $result->examination_at ) ? "" : DateTime::createFromFormat ( DatabaseFixedValue::DEFAULT_FORMAT_DATE, $result->examination_at )->format ( 'd/m/Y' );
			$history ['gender'] = $result->gender;
			$history ['email'] = $result->email;
			$history ['history'] = json_decode ( $result->history );
			
			$supportTicketRepository = new SupportTicketRepository ();
			$supportTicketRepository->id = $result->support_id;
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
	function Save($userId) {
		$data = $this->input->post ( 'data' );
		$send = $this->input->post ( 'send' );
		
		$data = json_decode ( $data );
		$profileId = $this->saveProfile ( $userId, $data );
		if ($send == 'true' || $send === true) {
			$userRepository = new UserRepository ();
			$userRepository->id = $userId;
			$resuls = $userRepository->getOneById ();
			$ccEmail = $data->email == $resuls [0]->email ? null : $data->email;
			$ticketId = ServiceFactory::CreateTicketSupport ()->sendSupportOnTeethGrowUp ( $resuls [0], $data->email, $data, new SupportTicketRepository () );
			
			$teethGrowRepository = new TeethGrowRepository ();
			$teethGrowRepository->id = $profileId;
			$teethGrowRepository->support_id = $ticketId;
			$teethGrowRepository->updateById ();
		}
		
		redirect ( "/profile/{$userId}/tuoi-moc-rang?history={$profileId}" );
	}
	private function saveProfile($userId, $data) {
		$teethGrowRepository = new TeethGrowRepository ();
		$teethGrowRepository->user_id = $userId;
		$teethGrowRepository->full_name = $data->full_name;
		$teethGrowRepository->dob = (DateTime::createFromFormat ( 'd/m/Y', $data->dob ) == null || DateTime::createFromFormat ( 'd/m/Y', $data->dob ) == false) ? DateTime::createFromFormat ( 'd/m/Y', '01/01/2014' )->format ( 'Y-m-d' ) : DateTime::createFromFormat ( 'd/m/Y', $data->dob )->format ( 'Y-m-d' );
		$teethGrowRepository->examination_at = (DateTime::createFromFormat ( 'd/m/Y', $data->examination_at ) == null || DateTime::createFromFormat ( 'd/m/Y', $data->examination_at ) == false) ? DateTime::createFromFormat ( 'd/m/Y', '01/01/2014' )->format ( 'Y-m-d' ) : DateTime::createFromFormat ( 'd/m/Y', $data->examination_at )->format ( 'Y-m-d' );
		
		$teethGrowRepository->gender = $data->gender;
		$teethGrowRepository->email = $data->email;
		$teethGrowRepository->history = json_encode ( $data->history );
		if (isset ( $data->id ) && $data->id != '' && ! empty ( $data->id )) {
			$teethGrowRepository->id = $data->id;
			$teethGrowRepository->updateById ();
			return $teethGrowRepository->id;
		} else {
			return $teethGrowRepository->insert ();
		}
	}
	function SendSupport($userId) {
		$data = $this->input->post ( 'data' );
		$data = json_decode ( $data );
		
		$userRepository = new UserRepository ();
		$userRepository->id = $userId;
		$resuls = $userRepository->getOneById ();
		$ticketId = ServiceFactory::CreateTicketSupport ()->sendSupportOnTeethGrowUp ( $resuls [0], $data->email, $data, new SupportTicketRepository () );
		
		$growUpRepository = new TeethGrowRepository ();
		$growUpRepository->id = $data->id;
		$growUpRepository->support_id = $ticketId;
		$growUpRepository->updateById ();
		
		redirect ( "/profile/{$userId}/tuoi-moc-rang?history={$data->id}" );
	}
	function UpdateSupportResponse($userId) {
		$params = $this->getQueryStringParams ();
		$id = isset ( $params ['history'] ) ? '?history=' . $params ['history'] : '';
		
		$data = $this->input->post ( 'data' );
		$data = json_decode ( $data );
		
		$supportTicketRepository = new SupportTicketRepository ();
		$supportTicketRepository->id = $data->id;
		$supportTicketRepository->ticket_response = $data->ticket_response;
		$supportTicketRepository->user_response = $this->obj_user->id;
		$supportTicketRepository->updateById ();
		
		$userSessionRepository = new UserSessionRepository ();
		$userSessionRepository->user_id = $this->obj_user->id;
		$userSessionRepository->activity = "Tư vấn Tuổi mọc răng <a href='/profile/{$userId}/tuoi-moc-rang{$id}'> Open </a>";
		$userSessionRepository->session_id = $this->session->userdata ( 'session_id' );
		$userSessionRepository->insert ();
		
		redirect ( "/profile/{$userId}/tuoi-moc-rang{$id}" );
	}
}