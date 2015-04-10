<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Profiles extends BaseController {
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
		$postRepository->category_id = 3;
		$postRepository->delete = 0;
		$manyViewPosts = $postRepository->getMutilCondition ( T_post::view_count, 'DESC', 5 );
		$data ['manyViewPosts'] = $manyViewPosts;
		
		$data ['histories'] = $this->loadHistory ( $userId );
		$data ['userid'] = $userId;
		
		LayoutFactory::getLayout ( LayoutFactory::MAIN_DETAIL )->setData ( $data )->setJavascript ( array (
				'/js/controllers/ProfileController.js',
				'/js/plugins/ckeditor/ckeditor.js' 
		) )->setTitles ( " Tư vấn - " . $users [0]->full_name )->render ( 'Profile' );
	}
	function loadHistory($userId) {
		// Load History
		$histories = array ();
		$profileRepository = new ProfileRepository ();
		$profileRepository->user_id = $userId;
		$profileResults = $profileRepository->getMutilCondition ( T_profile::created_at, 'DESC' );
		
		foreach ( $profileResults as $profileResult ) {
			// echo "<pre/>";var_dump($profileResults); die;
			$history = array ();
			$history ['id'] = $profileResult->id;
			$history ['user_id'] = $profileResult->user_id;
			$history ['full_name'] = $profileResult->full_name;
			$history ['dob'] = DateTime::createFromFormat ( DatabaseFixedValue::DEFAULT_FORMAT_DATE, $profileResult->dob )->format ( 'd/m/Y' );
			$history ['examination_at'] = empty ( $profileResult->examination_at ) ? "" : DateTime::createFromFormat ( DatabaseFixedValue::DEFAULT_FORMAT_DATE, $profileResult->examination_at )->format ( 'd/m/Y' );
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
	function Save($userId) {
		$data = $this->input->post ( 'data' );
		$send = $this->input->post ( 'send' );
		$data = json_decode ( $data );
		$profileId = $this->saveProfile ( $userId, $data );
		$this->saveProfileDetail ( $profileId, $data );
		if ($send == 'true' || $send === true) {
			$userRepository = new UserRepository ();
			$userRepository->id = $userId;
			$resuls = $userRepository->getOneById ();
			$ccEmail = $data->email == $resuls [0]->email ? null : $data->email;
			$ticketId = ServiceFactory::CreateTicketSupport ()->sendSupportOnProfiles ( $resuls [0], $data->email, $data, new SupportTicketRepository () );
			
			$profileRepository = new ProfileRepository ();
			$profileRepository->id = $profileId;
			$profileRepository->support_id = $ticketId;
			$profileRepository->updateById ();
		}
		
		redirect ( "/profile/{$userId}/ho-so-rang-mieng?history={$profileId}" );
	}
	function saveProfileDetail($profile, $data) {
		foreach ( $data->teeth_status_detail as $teeth ) {
			$profileDetailRepository = new ProfileDetailRepository ();
			$profileDetailRepository->profile_id = $profile;
			$profileDetailRepository->teeth_code = $teeth->code;
			$reults = $profileDetailRepository->getMutilCondition ();
			if (count ( $reults ) > 0) {
				foreach ( $reults as $result ) {
					$profileDetailRepository = new ProfileDetailRepository ();
					$profileDetailRepository->id = $result->id;
					$profileDetailRepository->delete ();
				}
			}
			$profileDetailRepository = new ProfileDetailRepository ();
			$profileDetailRepository->profile_id = $profile;
			$profileDetailRepository->teeth_code = $teeth->code;
			$profileDetailRepository->teeth_status = json_encode ( $teeth->status );
			$profileDetailRepository->insert ();
		}
	}
	private function saveProfile($userId, $data) {
		$profileRepository = new ProfileRepository ();
		$profileRepository->user_id = $userId;
		$profileRepository->full_name = $data->full_name;
		$profileRepository->dob = (DateTime::createFromFormat ( 'd/m/Y', $data->dob ) == null || DateTime::createFromFormat ( 'd/m/Y', $data->dob ) == false) ? DateTime::createFromFormat ( 'd/m/Y', '01/01/2014' )->format ( 'Y-m-d' ) : DateTime::createFromFormat ( 'd/m/Y', $data->dob )->format ( 'Y-m-d' );
		$profileRepository->examination_at = (DateTime::createFromFormat ( 'd/m/Y', $data->examination_at ) == null || DateTime::createFromFormat ( 'd/m/Y', $data->examination_at ) == false) ? DateTime::createFromFormat ( 'd/m/Y', '01/01/2014' )->format ( 'Y-m-d' ) : DateTime::createFromFormat ( 'd/m/Y', $data->examination_at )->format ( 'Y-m-d' );
		$profileRepository->gender = $data->gender;
		$profileRepository->email = $data->email;
		$profileRepository->teeth_status = json_encode ( $data->teeth_status );
		if (isset ( $data->id ) && $data->id != '' && ! empty ( $data->id )) {
			$profileRepository->id = $data->id;
			$profileRepository->updateById ();
			return $profileRepository->id;
		} else {
			return $profileRepository->insert ();
		}
	}
	function SendSupport($userId) {
		$data = $this->input->post ( 'data' );
		$data = json_decode ( $data );
		
		$userRepository = new UserRepository ();
		$userRepository->id = $userId;
		$resuls = $userRepository->getOneById ();
		$ticketId = ServiceFactory::CreateTicketSupport ()->sendSupportOnProfiles ( $resuls [0], $data->email, $data, new SupportTicketRepository () );
		
		$profileRepository = new ProfileRepository ();
		$profileRepository->id = $data->id;
		$profileRepository->support_id = $ticketId;
		$profileRepository->updateById ();
		
		redirect ( "/profile/{$userId}/ho-so-rang-mieng?history={$data->id}" );
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
		$userSessionRepository->activity = "Tư vấn hồ sơ răng miệng <a href='/profile/{$userId}/ho-so-rang-mieng{$id}'> Open </a>";
		$userSessionRepository->session_id = $this->session->userdata ( 'session_id' );
		$userSessionRepository->insert ();
		
		redirect ( "/profile/{$userId}/ho-so-rang-mieng{$id}" );
	}
}