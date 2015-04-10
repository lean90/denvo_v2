<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class lost_password extends BaseController {
	function __construct() {
		parent::__construct ();
	}
	function show_page() {
		LayoutFactory::getLayout ( LayoutFactory::MAIN_DETAIL )->setJavascript ( array (
				'/js/controllers/ListController.js' 
		) )->setTitles ( 'Quên mật khẩu' )->render ( 'lost_password' );
	}
	function reset() {
		$data = array ();
		$email = $this->input->post ( 'email' );
		$userRepository = new UserRepository ();
		$userRepository->us = $email;
		$users = $userRepository->getMutilCondition ();
		if (count ( $users ) == 0) {
			$data ['error'] = 'Email không tồn tại';
			LayoutFactory::getLayout ( LayoutFactory::MAIN_DETAIL )->setData ( $data )->setTitles ( 'Quên mật khẩu' )->render ( 'lost_password' );
		} else {
			$pw = $this->incrementalHash ( 6 );
			$userRepository = new UserRepository ();
			$userRepository->id = $users [0]->id;
			$userRepository->pw = md5 ( $pw );
			$userRepository->updateById ();
			$data ['ok'] = 'Vui lòng kiểm tra mail để lấy mật khẩu';
			ServiceFactory::CreateMailSerivce ()->sendMailResetPassword ( $users [0], $pw );
			LayoutFactory::getLayout ( LayoutFactory::MAIN_DETAIL )->setData ( $data )->setTitles ( 'Quên mật khẩu' )->render ( 'lost_password' );
		}
	}
	function incrementalHash($len = 6) {
		$seed = str_split ( 'abcdefghijklmnopqrstuvwxyz' . 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' . '0123456789' ); // and any other characters
		shuffle ( $seed ); // probably optional since array_is randomized; this may be redundant
		$rand = '';
		foreach ( array_rand ( $seed, $len ) as $k )
			$rand .= $seed [$k];
		
		return $rand;
	}
	
	function reset_password(){
	   $u = $this->input->get("u");
	   $p = $this->input->get("p");
	   $repositoryUser = new UserRepository();
	   $repositoryUser->id = $u;
	   $repositoryUser->pw = $p;
	   $results = $repositoryUser->getMutilCondition();
	   $data = array();
	   $data["userId"] = $u;
	   if(count($results) != 1){
	       $data['error'] = true;
	   }
	   LayoutFactory::getLayout ( LayoutFactory::MAIN_DETAIL )->setData ( $data )->setTitles ( 'Thiết lập mật khẩu' )->render ( 'reset_password' );
	}
	
	function reset_password_save(){
	    $u = $this->input->get("u");
	    $p = $this->input->get("p");
	    $reUser = $this->input->post("user-id");
	    $data = array();
	    $data["userId"] = $u;
	    if ($u != $reUser) {
            $data ['error'] = true;
        }
	    $password = $this->input->post("password");
	    $repositoryUser = new UserRepository();
	    $repositoryUser->id = $u;
	    $repositoryUser->pw = md5($password);  
	    $repositoryUser->updateById();
	    $data ['ok'] = true;
	    LayoutFactory::getLayout ( LayoutFactory::MAIN_DETAIL )->setData ( $data )->setTitles ( 'Thiết lập mật khẩu' )->render ( 'reset_password' );
	}
}