<?php
class ExportService {
	protected $_CiInstance;
	function __construct($ciInstance) {
		$this->_CiInstance = $ciInstance;
	}
	
	/**
	 *
	 * @param string $email.        	
	 * @param string $fullName.        	
	 * @param UserRespository $userRespository        	
	 * @return string the path of csv or excel file.
	 */
	function exportUser($email, $fullName, UserRepository $userRespository) {
		$this->_CiInstance->load->helper ( 'file' );
		$exportData = $userRespository->exportUser ( $fullName, $email );
		$exportData = utf8_encode ( $exportData );
		$absolutePath = '/export/' . date ( 'YmdHms' ) . '.csv';
		$filePath = BASEPATH . '../docroot' . $absolutePath;
		write_file ( $filePath, $exportData, 'a+' );
		return $absolutePath;
	}
}