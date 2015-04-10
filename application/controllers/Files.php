<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Files extends BaseController {
	protected $authorization_required = TRUE;
	function __construct() {
		parent::__construct ();
	}
	function ShowPage() {
		$limit = $this->input->get ( 'limit' );
		$offset = $this->input->get ( 'offset' );
		$limit = $limit === false ? 10 : $limit;
		$offset = $offset === false ? 0 : $offset;
		$offset = $limit * $offset;
		
		$data = array ();
		$filesRespository = new FileRepository ();
		$data ['itemsCount'] = $filesRespository->getCountCondition ();
		$data ['items'] = $filesRespository->getMutilCondition ( T_file::created_at, 'desc', $limit, $offset );
		
		LayoutFactory::getLayout ( LayoutFactory::MAIN_DETAIL )->setData ( $data )->setJavascript ( array (
				'/js/controllers/FilesController.js' 
		) )->setTitles ( "Files" )->render ( 'files' );
	}
	function saveFile() {
		$files = isset ( $_FILES ['file'] ) && ! empty ( $_FILES ['file'] ) ? $_FILES ['file'] : null;
		if (gettype ( $files ) == 'array' && $files ['size'] > 0) {
			$fileAvatar = $this->saveAvatar ( $files );
		}
		redirect ( '/files' );
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
}