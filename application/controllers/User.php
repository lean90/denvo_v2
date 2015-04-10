<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class User extends BaseController {
	protected $authorization_required = true;
	function __construct() {
		parent::__construct ();
	}
	function ShowPage($userId) {
		$data = array ();
		$userRepsitory = new UserRepository ();
		$userRepsitory->id = $userId;
		$results = $userRepsitory->getOneById ();
		if (count ( $results ) == 0) {
			throw new Lynx_RequestException ( 'Tài khoản không tồn tại' );
		}
		$data ['me'] = $results [0];
		
		$postRepository = new PostRepository ();
		$postRepository->delete = 0;
		$manyViewPosts = $postRepository->getMutilCondition ( T_post::view_count, 'DESC', 10, 0 );
		$data ['manyViewPosts'] = $manyViewPosts;
		
		LayoutFactory::getLayout ( LayoutFactory::MAIN_DETAIL )->setData ( $data )->setJavascript ()->setTitles ( " Thông tin tài khoản" )->render ( 'userInformation' );
	}
	function UpdateInformation($userId) {
		$data = array ();
		$post = $this->input->post ();
		$fileRepository = new FileRepository ();
		$fileservice = new FileService ();
		$fileAvatar = null;
		$files = isset ( $_FILES ['client-avatar'] ) && ! empty ( $_FILES ['client-avatar'] ) ? $_FILES ['client-avatar'] : null;
		if (gettype ( $files ) == 'array' && $files ['size'] > 0) {
			$fileAvatar = $this->saveAvatar ( $files );
		}
		$newformat = DateTime::createFromFormat ( 'd/m/Y', $post ['dob'] )->format ( 'Y-m-d' );
		
		$repositoryUser = new UserRepository ();
		$repositoryUser->id = $userId;
		$repositoryUser->full_name = $post ['fullname'];
		$repositoryUser->dob = $newformat;
		$repositoryUser->gender = $post ['gender'];
		$repositoryUser->avartar = $fileAvatar;
		$repositoryUser->updateById ();
		
		$userRepsitory = new UserRepository ();
		$userRepsitory->id = $userId;
		$results = $userRepsitory->getOneById ();
		if (count ( $results ) == 0) {
			throw new Lynx_RequestException ( 'Tài khoản không tồn tại' );
		}
		$data ['me'] = $results [0];
		
		$postRepository = new PostRepository ();
		$postRepository->delete = 0;
		$manyViewPosts = $postRepository->getMutilCondition ( T_post::view_count, 'DESC', 10, 0 );
		$data ['manyViewPosts'] = $manyViewPosts;
		
		LayoutFactory::getLayout ( LayoutFactory::MAIN_DETAIL )->setData ( $data )->setJavascript ()->setTitles ( " Thông tin tài khoản" )->render ( 'userInformation' );
	}
	function saveAvatar($files) {
		$fileRepository = new FileRepository ();
		$fileModel = new FileService ();
		$fileID = null;
		try {
			if (isset ( $files ['name'] )) {
				$fileInfo = $files;
				if (! $fileInfo ['name'] || ! is_uploaded_file ( $fileInfo ['tmp_name'] ) || ! file_exists ( $fileInfo ['tmp_name'] )) {
					return;
				}
				list ( $imgWidth, $imgHeight, $imgType, $imgAttr ) = getimagesize ( $fileInfo ['tmp_name'] );
				$fileID = $fileModel->handleImageUpload ( $fileInfo, $fileRepository );
			}
		} catch ( Exception $e ) {
			throw $e;
		}
		
		return $fileID;
	}
	function profile($userId) {
		$userRepsitory = new UserRepository ();
		$userRepsitory->id = $userId;
		$results = $userRepsitory->getOneById ();
		if (count ( $results ) == 0) {
			throw new Lynx_RequestException ( 'Tài khoản không tồn tại' );
		}
		$data ['me'] = $results [0];
		
		$postRepository = new PostRepository ();
		$postRepository->delete = 0;
		$manyViewPosts = $postRepository->getMutilCondition ( T_post::view_count, 'DESC', 10, 0 );
		$data ['manyViewPosts'] = $manyViewPosts;
		
		LayoutFactory::getLayout ( LayoutFactory::MAIN_DETAIL )->setData ( $data )->setJavascript ()->setTitles ( "Thông tin tài khoản" )->render ( 'userProfile' );
	}
}