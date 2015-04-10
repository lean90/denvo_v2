<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class UserApi extends BaseController {
	function login($pf) {
		switch ($pf) {
			case 'pf' :
				$this->loginPf ();
				break;
			case 'facebook' :
				$this->loginFacebook ();
				break;
			case 'google' :
				$this->loginGoogle ();
				break;
		}
	}
	function loginPf() {
		$logindt = $this->input->post ( 'data' );
		$userRepository = new UserRepository ();
		$userRepository->us = $logindt ['us'];
		$userRepository->pw = md5 ( $logindt ['pw'] );
		$result = $userRepository->getMutilCondition ();
		if (count ( $result ) <= 0) {
			$this->output->set_content_type ( 'application/json' )->set_output ( json_encode ( false, true ) );
			return;
		}
		$userModel = $userRepository->getUser ( $result [0]->id );
		
		$this->set_obj_user_to_me ( $userModel, $logindt ['re'] );
		
		$userSessionRepository = new UserSessionRepository ();
		$userSessionRepository->user_id = $this->obj_user->id;
		$userSessionRepository->activity = "LOGIN";
		$userSessionRepository->session_id = $this->session->userdata ( 'session_id' );
		$userSessionRepository->insert ();
		
		$this->output->set_content_type ( 'application/json' )->set_output ( json_encode ( true, true ) );
	}
	function loginFacebook() {
		$logindt = $this->input->post ( 'data' );
		$logindt = json_decode ( $logindt );
		$logindt->birthday = isset ( $logindt->birthday ) ? $logindt->birthday : DateTime::createFromFormat ( DatabaseFixedValue::DEFAULT_FORMAT_DATE, date ( DatabaseFixedValue::DEFAULT_FORMAT_DATE ) )->format ( 'm/d/Y' );
		$userRepository = new UserRepository ();
		$userRepository->us = $logindt->id;
		$checkResult = $userRepository->getMutilCondition ();
		$userId = null;
		
		if (count ( $checkResult ) <= 0) {
			$userRepository = new UserRepository ();
			$userRepository->us = $logindt->id;
			$userRepository->full_name = empty( $logindt->name) ? "" : $logindt->name;
			$userRepository->gender = empty($logindt->gender) ? 'MALE' : $logindt->gender == "male" ? 'MALE' : 'FMALE';
			$userRepository->dob = DateTime::createFromFormat ( 'm/d/Y', $logindt->birthday ) == false ? $userRepository->getDate() : DateTime::createFromFormat ( 'm/d/Y', $logindt->birthday )->format ( DatabaseFixedValue::DEFAULT_FORMAT_DATE );
			$userRepository->avartar = empty( $logindt->picture->data->url ) ? null : $logindt->picture->data->url;
			$userRepository->email = empty($logindt->email) ? '' : $logindt->email;
			$userRepository->platform = DatabaseFixedValue::USER_PLATFORM_FACEBOOK;
			$userRepository->account_role = DatabaseFixedValue::USER_TYPE_USER;
			$userRepository->account_status = DatabaseFixedValue::USER_STATUS_ACTIVE;
			$userId = $userRepository->insert ();
		} else {
			$userRepository = new UserRepository ();
			$userRepository->id = $checkResult [0]->id;
			$userRepository->full_name = empty( $logindt->name) ? "" : $logindt->name;
			$userRepository->gender = empty($logindt->gender) ? 'MALE' : $logindt->gender == "male" ? 'MALE' : 'FMALE';
			$userRepository->dob = DateTime::createFromFormat ( 'm/d/Y', $logindt->birthday ) == false ? $userRepository->getDate() : DateTime::createFromFormat ( 'm/d/Y', $logindt->birthday )->format ( DatabaseFixedValue::DEFAULT_FORMAT_DATE );
			$userRepository->avartar = empty( $logindt->picture->data->url ) ? null : $logindt->picture->data->url;
			$userRepository->email = empty($logindt->email) ? '' : $logindt->email;
			$userRepository->updateById ();
		}
		
		if ($userId != null) {
			$userRepository = new UserRepository ();
			$userRepository->id = $userId;
			$checkResult = $userRepository->getOneById ();
		}
		
		$userModel = $userRepository->getUser ( $checkResult [0]->id );
		$this->set_obj_user_to_me ( $userModel, $this->input->post ( 're' ) );
		
		$userSessionRepository = new UserSessionRepository ();
		$userSessionRepository->user_id = $this->obj_user->id;
		$userSessionRepository->activity = "LOGIN";
		$userSessionRepository->session_id = $this->session->userdata ( 'session_id' );
		$userSessionRepository->insert ();
		
		$this->output->set_content_type ( 'application/json' )->set_output ( json_encode ( true, true ) );
	}
	function loginGoogle() {
	}
	function searchUserByFullName() {
		$params = $this->getQueryStringParams ();
		$fullName = isset ( $params ['full_name'] ) ? $params ['full_name'] : '';
		if ($fullName == '') {
			$this->output->set_content_type ( 'application/json' )->set_output ( json_encode ( array (), true ) );
		}
		$userRepository = new UserRepository ();
		$userRepository->full_name = $fullName;
		$result = $userRepository->getWhereLike ( T_user::full_name, 'both', 10, 0 );
		$this->output->set_content_type ( 'application/json' )->set_output ( json_encode ( $result, true ) );
	}
}