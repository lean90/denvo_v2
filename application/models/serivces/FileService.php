<?php
class FileService {
	
	/**
	 *
	 * @param string $fileInfo        	
	 * @param FileRepository $fileRepository        	
	 * @throws Lynx_RequestException
	 * @throws Lynx_BusinessLogicException
	 * @return unknown
	 */
	function handleImageUpload($fileInfo, $fileRepository) {
		// validate
		if ($fileInfo ['size'] > 20000000) 		// 20MB
		{
			throw new Lynx_RequestException ( 'Maximum size exceeded' );
		}
		$dotPosition = strrpos ( $fileInfo ['name'], '.' );
		$extension = '';
		if ($dotPosition !== false) {
			$extension = substr ( $fileInfo ['name'], $dotPosition + 1 );
		}
		$newName = md5 ( uniqid () ) . '.' . $extension;
		$path = 'uploads/' . date_create ( $fileRepository->getDate () )->format ( 'Y/m/d' ) . '/';
		$destination = dirname ( BASEPATH ) . '/statics/' . $path;
		if (! is_dir ( $destination ) && ! mkdir ( $destination, 0777, true )) {
			throw new Lynx_BusinessLogicException ( "Khong tao duoc dir: '$destination'" );
		}
		if (! move_uploaded_file ( $fileInfo ['tmp_name'], $destination . $newName )) {
			throw new Lynx_BusinessLogicException ( "Khong chuyen duoc file den vi tri upload" );
		}
		
		$fileRepository->internal_path = $path . $newName;
		$fileRepository->url = Common::getStaticHost(). '/' . $path . $newName;
		$fileRepository->name = $fileInfo ['name'];
		$insertResult = $fileRepository->insert ();
		
		if (! $insertResult) {
			throw new Lynx_BusinessLogicException ( "Insert file that bai" );
		}
		return $fileRepository->url;
	}
	
	/**
	 *
	 * @param string $id        	
	 * @param FileRepository $FileRepository        	
	 * @throws Lynx_BusinessLogicException
	 */
	function delete($id, $FileRepository) {
		$instance = $FileRepository->getOneById ( $id );
		/* @var $instance FileDomain */
		if (! $instance->id) {
			throw new Lynx_BusinessLogicException ( 'Could not find t_file record, cancel delete: ' . $id );
		}
		$filename = FCPATH . '/' . $instance->internalPath;
		if (! file_exists ( $filename )) {
			return;
		}
		$FileRepository->delete ();
		unlink ( $filename );
	}
}
