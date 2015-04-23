<?php
class ExportService {
	protected $_CiInstance;
	function __construct($ciInstance) {
		$this->_CiInstance = $ciInstance;
	}
	
	var $objTpl;
	var $filename = "";
	var $email;
	var $full_name;
	private function report_head(){
	    $this->filename = "export_searching_user_".mt_rand(1,100000).'.xls';
	    header('Content-Type: application/vnd.ms-excel');
	    header('Content-Disposition: attachment;filename="'.$this->filename.'"');
	    header('Cache-Control: max-age=0');
	}
	
	private function report_write(){
	    $objWriter = PHPExcel_IOFactory::createWriter($this->objTpl, 'Excel5');
	    $objWriter->save('php://output');
	}


	/**
	 *
	 * @param string $email.
	 * @param string $fullName.
	 * @param UserRespository $userRespository
	 * @return string the path of csv or excel file.
	 */
	function exportUser($email, $fullName, UserRepository $userRespository) {
	    $this->full_name = $fullName;
	    $this->email = $email;
	    $this->report_head();
	    $objReader  = PHPExcel_IOFactory::createReader('Excel5');
	    $this->objTpl =  $objReader->load(BASEPATH.'../temp/export_searching.xls');
	    $this->report_system_user();
	    $this->report_write();
	}
	
	private function report_system_user(){
	    $objTpl = $this->objTpl;
	    $objTpl->setActiveSheetIndex(0);
	    $userRepository = new UserRepository();
	    $results = $userRepository->exportUser($this->full_name, $this->email);
	    $objTpl->setActiveSheetIndex(0);  //set first sheet as active
	    $row = 1;
	    foreach ($results as $result){
	        $row++;
	        $result instanceof UserRepository;
	        $objTpl->getActiveSheet()->insertNewRowBefore($row,1);
	        $objTpl->getActiveSheet()->setCellValue("A{$row}", $row-1);
	        $objTpl->getActiveSheet()->setCellValue("B{$row}", $result->id);
	        $objTpl->getActiveSheet()->setCellValue("C{$row}", $result->us);
	        $objTpl->getActiveSheet()->setCellValue("D{$row}", $result->email);
	        $objTpl->getActiveSheet()->setCellValue("E{$row}", $result->full_name);
	        $objTpl->getActiveSheet()->setCellValue("F{$row}", $result->created_at);
	        $objTpl->getActiveSheet()->setCellValue("G{$row}", $result->platform);
	        $objTpl->getActiveSheet()->setCellValue("H{$row}", $result->status == 1 ? "Active" : $result->status == 0 ? "Queue" : "Deactive");
	    }
	}
}