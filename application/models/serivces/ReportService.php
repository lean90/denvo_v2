<?php
class ReportService {
    var $objTpl;
    var $filename = "";
    private function report_head(){
        $this->filename = "system_report_".mt_rand(1,100000).'.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$this->filename.'"');
        header('Cache-Control: max-age=0');
    }
    
    private function report_write(){
        $objWriter = PHPExcel_IOFactory::createWriter($this->objTpl, 'Excel5');
        $objWriter->save('php://output');
    }
    
    public function report_system(){
        $this->report_head();
        $objReader  = PHPExcel_IOFactory::createReader('Excel5');
        $this->objTpl =  $objReader->load(BASEPATH.'../temp/bao_cao_he_thong.xls');
        $this->report_system_user();
        $this->report_system_viewport();
        $this->report_system_request_support();
        $this->report_system_new_post();
        $this->report_write();
    }
    
    private function report_system_user(){
        $objTpl = $this->objTpl;
        $objTpl->setActiveSheetIndex(0);
        $userRepository = new UserRepository();
        $results = $userRepository->getMutilCondition();
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
    
    
    private function report_system_viewport(){
        $objTpl = $this->objTpl;
        $objTpl->setActiveSheetIndex(1);
        
        $collection = array();
        
        $settingRespository = new SettingRepository();
        $settingRespository->key = "REQUEST_COUNT";
        $results_request  = $settingRespository->getWhereLike(T_setting::key, 'both');
        
        $settingRespository = new SettingRepository();
        $settingRespository->key = "REQUEST_PROFILE_COUNT";
        $results_profiles  = $settingRespository->getWhereLike(T_setting::key, 'both');
        
        $settingRespository = new SettingRepository();
        $settingRespository->key = "REQUEST_TEETH_GROW_COUNT";
        $results_teeth_grow  = $settingRespository->getWhereLike(T_setting::key, 'both');
        
        $settingRespository = new SettingRepository();
        $settingRespository->key = "REQUEST_MAPS_COUNT";
        $results_maps  = $settingRespository->getWhereLike(T_setting::key, 'both');
        
        $settingRespository = new SettingRepository();
        $settingRespository->key = "REQUEST_TIMELINE_RS_COUNT";
        $results_timeline_RS = $settingRespository->getWhereLike(T_setting::key, 'both');
        
        $settingRespository = new SettingRepository();
        $settingRespository->key = "REQUEST_TIMELINE_RVV_COUNT";
        $results_timeline_RVV = $settingRespository->getWhereLike(T_setting::key, 'both');
        
        //order date;
        foreach ($results_request as $date){
        	$rowReport = new stdClass();
        	$date instanceof SettingRepository;
        	//get date from string : 
        	$key = str_replace("REQUEST_COUNT_", "", $date->key);
        	$rowReport->view = $date->value;
        	$rowReport->profiles = $this->get_setting_key_for_counting($key, $results_profiles);
        	$rowReport->teethGrow = $this->get_setting_key_for_counting($key, $results_teeth_grow);
        	$rowReport->maps = $this->get_setting_key_for_counting($key, $results_maps);
        	$rowReport->timelineRS = $this->get_setting_key_for_counting($key, $results_timeline_RS);
        	$rowReport->timelineRVV = $this->get_setting_key_for_counting($key, $results_timeline_RVV);
        	$collection[$key] = $rowReport;
        }
        krsort($collection);
        $row = 1;
        foreach ($collection as $key => $result){
            $row++;
            $result instanceof SettingRepository;
            $date = DateTime::createFromFormat("Ymd", $key)->format("d/m/Y");
            $objTpl->getActiveSheet()->insertNewRowBefore($row,1);
            $objTpl->getActiveSheet()->setCellValue("A{$row}", $date);
            $objTpl->getActiveSheet()->setCellValue("B{$row}", $result->view);
            $objTpl->getActiveSheet()->setCellValue("C{$row}", $result->profiles);
            $objTpl->getActiveSheet()->setCellValue("D{$row}", $result->teethGrow);
            $objTpl->getActiveSheet()->setCellValue("E{$row}", $result->maps);
            $objTpl->getActiveSheet()->setCellValue("F{$row}", $result->timelineRS);
            $objTpl->getActiveSheet()->setCellValue("G{$row}", $result->timelineRVV);
        }
    }
    
    private function get_setting_key_for_counting($dateKey,$collection){
    	foreach ($collection as $date){
    		$date instanceof SettingRepository;
    		$date->key = str_replace("REQUEST_COUNT_", "", $date->key);
    		$date->key = str_replace("REQUEST_PROFILE_COUNT_", "", $date->key);
    		$date->key = str_replace("REQUEST_TEETH_GROW_COUNT_", "", $date->key);
    		$date->key = str_replace("REQUEST_MAPS_COUNT_", "", $date->key);
    		$date->key = str_replace("REQUEST_TIMELINE_RS_COUNT_", "", $date->key);
    		$date->key = str_replace("REQUEST_TIMELINE_RVV_COUNT_", "", $date->key);
    		if($date->key == $dateKey){
    			return $date->value;
    		}
    	}
    }
    
    private function report_system_request_support(){
        $objTpl = $this->objTpl;
        $objTpl->setActiveSheetIndex(2);
        $results = $this->mergeAudiByDateToArray ( $this->loadTicketSupportCount () );
        $results_count = $this->mergeAudiByDateToArray ( $this->loadTicketSupportedCount () );
        $row = 1;
        foreach ($results as $result){
            $row++;
            $result instanceof SettingRepository;
            $objTpl->getActiveSheet()->insertNewRowBefore($row,1);
            $objTpl->getActiveSheet()->setCellValue("A{$row}", date('m/d/Y', $result[0]));
            $objTpl->getActiveSheet()->setCellValue("B{$row}", $result[1]);
            $objTpl->getActiveSheet()->setCellValue("C{$row}", $results_count[$row-2][1]);
        }
    }
    
    private function report_system_new_post(){
        $objTpl = $this->objTpl;
        $objTpl->setActiveSheetIndex(3);
        $results = $this->mergeAudiByDateToArray ( $this->loadPostAddedByDate () );
        $row = 1;
        foreach ($results as $result){
            $row++;
            $result instanceof SettingRepository;
            $objTpl->getActiveSheet()->insertNewRowBefore($row,1);
            $objTpl->getActiveSheet()->setCellValue("A{$row}", date('m/d/Y', $result[0]));
            $objTpl->getActiveSheet()->setCellValue("B{$row}", $result[1]);
        }
    }

    function loadPostAddedByDate() {
        $startDate = date ( DatabaseFixedValue::DEFAULT_FORMAT_DATE, strtotime ( "-30 days" ) );
        $endDate = date ( DatabaseFixedValue::DEFAULT_FORMAT_DATE );
        $postRepository = new PostRepository ();
        return $postRepository->getPostCountByDate ( $startDate, $endDate );
    }
    
    function loadTicketSupportedCount() {
        $startDate = date ( DatabaseFixedValue::DEFAULT_FORMAT_DATE, strtotime ( "-30 days" ) );
        $endDate = date ( DatabaseFixedValue::DEFAULT_FORMAT_DATE );
        $supportTicketRespository = new SupportTicketRepository ();
        return $supportTicketRespository->getSupportedByDate ( $startDate, $endDate );
    }
    
    function loadTicketSupportCount() {
        $startDate = date ( DatabaseFixedValue::DEFAULT_FORMAT_DATE, strtotime ( "-99999 days" ) );
        $endDate = date ( DatabaseFixedValue::DEFAULT_FORMAT_DATE );
        $supportTicketRespository = new SupportTicketRepository ();
        return $supportTicketRespository->getSupportByDate ( $startDate, $endDate );
    }
    
    function mergeAudiByDateToArray($arr) {
        $arReturn = array ();
        for($i = 0; $i < 30; $i ++) {
            $compareDate = date ( "Y-m-d", strtotime ( "-{$i} days" ) );
            $arReturn [] = array (
                strtotime ( $compareDate ),
                0
            );
            	
            foreach ( $arr as $item ) {
                if ($compareDate == $item->date) {
                    $arReturn [count ( $arReturn ) - 1] [1] = $item->count;
                }
            }
        }
    
        return $arReturn;
    }
}