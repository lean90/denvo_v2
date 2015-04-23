<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
class Report extends BaseController {
    var $authorization_required = true;
    public function report_system(){
        $report_service = new ReportService();
        $report_service->report_system();
        exit;
    }
    
    public function report_user($user_id){
        $report_service = new ReportOneUserService();
        $report_service->report_user($user_id);
    }
}