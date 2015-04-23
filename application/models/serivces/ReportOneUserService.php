<?php
class ReportOneUserService extends ReportService {
    var $objTpl;
    var $filename = "";
    var $user_id = "";
    private function report_head(){
        $this->filename = "use_report_".mt_rand(1,100000).'.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$this->filename.'"');
        header('Cache-Control: max-age=0');
    }
    
    private function report_write(){
        $objWriter = PHPExcel_IOFactory::createWriter($this->objTpl, 'Excel5');
        $objWriter->save('php://output');
    }
    
   public function report_user($user_id){
        $this->user_id = $user_id;
        $this->report_head();
        $objReader  = PHPExcel_IOFactory::createReader('Excel5');
        $this->objTpl =  $objReader->load(BASEPATH.'../temp/bao_cao_user.xls');
        $this->report_user_info();
        $this->report_user_active();
        $this->report_user_support_ticket();
        $this->report_user_ho_so_rang_mieng();
        $this->report_user_tuoi_moc_rang();
        $this->report_write();
    }
    
   private function report_user_info(){
        $objTpl = $this->objTpl;
        $userRepository = new UserRepository();
        $results = $userRepository->getMutilCondition();
        $result =  $results[0];
        $result instanceof UserRepository;
        $objTpl->setActiveSheetIndex(0);  //set first sheet as active
        $objTpl->getActiveSheet()->setCellValue("B3",$result->id);
        $objTpl->getActiveSheet()->setCellValue("B4",$result->us);
        $objTpl->getActiveSheet()->setCellValue("B5",$result->full_name);
        $objTpl->getActiveSheet()->setCellValue("B6",$result->platform);
        $objTpl->getActiveSheet()->setCellValue("B7",$result->dob);
        $objTpl->getActiveSheet()->setCellValue("B8",$result->avartar);
        $objTpl->getActiveSheet()->setCellValue("B9",$result->email);
        $objTpl->getActiveSheet()->setCellValue("B10",$result->gender);
        $objTpl->getActiveSheet()->setCellValue("B11",$result->status == 1 ? "Active" : $result->status == 0 ? "Queue" : "Deactive");
        $objTpl->getActiveSheet()->setCellValue("B12",$result->created_at);
        $objTpl->getActiveSheet()->setCellValue("B13",date('m/d/Y', $result->last_activity));
        $objTpl->getActiveSheet()->setCellValue("B14",$result->account_role);
    }
    
    private function report_user_active(){
        $objTpl = $this->objTpl;
        $objTpl->setActiveSheetIndex(1);  //set first sheet as active
        $userSession = new UserSessionRepository ();
        $userSession->user_id = $this->user_id;
        $results = $userSession->getMutilCondition ( T_user_session::created_at, 'DESC');
        $row = 1;
        foreach ($results as $result){
            $row++;
            $result instanceof UserSessionRepository;
            $objTpl->getActiveSheet()->insertNewRowBefore($row,1);
            $objTpl->getActiveSheet()->setCellValue("A{$row}", $result->activity);
            $objTpl->getActiveSheet()->setCellValue("B{$row}", $result->created_at);
        }
    }
    
    private function report_user_support_ticket(){
        $objTpl = $this->objTpl;
        $objTpl->setActiveSheetIndex(2);  //set first sheet as active
        $subportTicket = new SupportTicketRepository ();
        $subportTicket->user_post = $this->user_id;
        $results = $subportTicket->getMutilCondition ( T_user_session::created_at, 'DESC');
        $row = 1;
        foreach ($results as $result){
            $row++;
            $result instanceof SupportTicketRepository;
            $objTpl->getActiveSheet()->insertNewRowBefore($row,1);
            $objTpl->getActiveSheet()->setCellValue("A{$row}", $row - 1);
            $objTpl->getActiveSheet()->setCellValue("B{$row}", strip_tags($result->ticket_content));
            $objTpl->getActiveSheet()->setCellValue("C{$row}", strip_tags($result->ticket_response) );
            $objTpl->getActiveSheet()->setCellValue("D{$row}", $result->created_at);
        }
    }
    
    private function report_user_ho_so_rang_mieng(){
        // Load History
    	$histories = array ();
    	$profileRepository = new ProfileRepository ();
    	$profileRepository->user_id = $this->user_id;
    	$profileResults = $profileRepository->getMutilCondition ( T_profile::created_at, 'DESC' );
    	
    	foreach ( $profileResults as $profileResult ) {
    		$history = array ();
    		$history ['id'] = $profileResult->id;
    		$history ['user_id'] = $profileResult->user_id;
    		$history ['full_name'] = $profileResult->full_name;
    		$history ['dob'] = DateTime::createFromFormat ( DatabaseFixedValue::DEFAULT_FORMAT_DATE, $profileResult->dob )->format ( 'd/m/Y' );
    		$history ['examination_at'] = empty ( $profileResult->examination_at ) ? "" : DateTime::createFromFormat ( DatabaseFixedValue::DEFAULT_FORMAT_DATE, $profileResult->examination_at )->format ( 'd/m/Y' );
    		$history ['gender'] = $profileResult->gender;
    		$history ['email'] = $profileResult->email;
    		$history ['created_at'] = $profileResult->created_at;
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
        
        foreach ($histories as $history){
            $this->write_one_ho_so_rang_mieng($history);
        }
    }
    
    private function write_one_ho_so_rang_mieng($item){
        $objTpl = $this->objTpl;
        $work_sheet = $objTpl->createSheet();
        $work_sheet->setTitle(mb_substr("Hồ sơ răng miệng - {$item["full_name"]}", 0,30) );
        //set head
        $work_sheet->setCellValue("A1","System id");
        $work_sheet->setCellValue("B1",$item["id"]);
        
        $work_sheet->setCellValue("A2","Họ và tên");
        $work_sheet->setCellValue("B2",$item["full_name"]);
        
        $work_sheet->setCellValue("A3","Giới tính");
        $work_sheet->setCellValue("B3",$item["gender"]);
        
        $work_sheet->setCellValue("A4","Ngày sinh");
        $work_sheet->setCellValue("B4",$item["dob"]);
        
        $work_sheet->setCellValue("A5","Ngày khám cuối");
        $work_sheet->setCellValue("B5",$item['examination_at']);
        
        $work_sheet->setCellValue("A6","Email");
        $work_sheet->setCellValue("B6",$item['email']);
        
        $work_sheet->setCellValue("A7","Ngày tạo");
        $work_sheet->setCellValue("B7",$item['created_at']);
        
        $work_sheet->setCellValue("A8","Tình trạng chung");
        $status_overview = "";
        foreach ($item['teeth_status']->detail as $detail){
            if($detail->selected){
                $status_overview .= "{$detail->value},";
            }
        }
        
        $work_sheet->setCellValue("B8",$status_overview);
        
        $work_sheet->setCellValue("A9","Tổng số lượng răng");
        $work_sheet->setCellValue("B9",$item['teeth_status']->amount);

        $work_sheet->setCellValue("A10","Cảm giác");
        $work_sheet->setCellValue("B10",$item['teeth_status']->feed);
        
        $work_sheet->setCellValue("D1","Code");
        $work_sheet->setCellValue("E1","Tình trạng");
        $row = 1;
        //var_dump($item['teeth_status_detail']);die;
        foreach ($item['teeth_status_detail'] as $detail){
            $row++;
            $work_sheet->setCellValue("D{$row}",$detail['code']);
            $teeth_status_item_str = "";
            foreach ($detail['status'] as $teeth_status_item){
                if($teeth_status_item->selected){
                    $teeth_status_item_str .= $teeth_status_item->value;
                }
            }
            $work_sheet->setCellValue("E{$row}",$teeth_status_item_str);
        }
    }
    
    private function report_user_tuoi_moc_rang(){
        $histories = array ();
        $teethGrowRepository = new TeethGrowRepository ();
        $teethGrowRepository->user_id = $this->user_id;;
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
            $history ['created_at'] = $result->created_at;
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
        foreach ($histories as $history){
            $this->write_one_tuoi_moc_rang($history);
        }
    }
    private function write_one_tuoi_moc_rang($item){
        $objTpl = $this->objTpl;
        $work_sheet = $objTpl->createSheet();
        $work_sheet->setTitle(mb_substr("Tuổi mọc răng - {$item["full_name"]}", 0,30) );
        //set head
        $work_sheet->setCellValue("A1","System id");
        $work_sheet->setCellValue("B1",$item["id"]);
        
        $work_sheet->setCellValue("A2","Họ và tên");
        $work_sheet->setCellValue("B2",$item["full_name"]);
        
        $work_sheet->setCellValue("A3","Giới tính");
        $work_sheet->setCellValue("B3",$item["gender"]);
        
        $work_sheet->setCellValue("A4","Ngày sinh");
        $work_sheet->setCellValue("B4",$item["dob"]);
        
        $work_sheet->setCellValue("A5","Ngày khám cuối");
        $work_sheet->setCellValue("B5",$item['examination_at']);
        
        $work_sheet->setCellValue("A6","Email");
        $work_sheet->setCellValue("B6",$item['email']);
        
        $work_sheet->setCellValue("A7","Ngày tạo");
        $work_sheet->setCellValue("B7",$item['created_at']);
        
        $work_sheet->setCellValue("D1","Code");
        $work_sheet->setCellValue("E1","Thời gian mọc ");
        $work_sheet->setCellValue("F1","Thời gian thay");
        $work_sheet->setCellValue("G1","Comment");
        $row = 1;
        foreach ($item['history'] as $history){
            if(empty($history->current)&&empty($history->rcurrent)&&empty($history->comment)){
                continue;
            }
            $row++;
            $work_sheet->setCellValue("D{$row}",$history->code);
            $work_sheet->setCellValue("E{$row}",$history->current);
            $work_sheet->setCellValue("F{$row}",empty($history->rcurrent) ? "" : $history->rcurrent);
            $work_sheet->setCellValue("G{$row}",$history->comment);
        }
    }
    
}