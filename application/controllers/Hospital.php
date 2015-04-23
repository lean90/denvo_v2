<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Hospital extends BaseController {
    protected $authorization_required = false;
	
	function ShowPage(){
	    $data = array();
	    
	    $currentDateKey = "REQUEST_MAPS_COUNT_" . date ( 'Ymd' );
	    $settingRespository = new SettingRepository ();
	    $settingRespository->key = $currentDateKey;
	    $results = $settingRespository->getMutilCondition ();
	    if (count ( $results ) == 0) {
	    	$settingRespository = new SettingRepository ();
	    	$settingRespository->key = $currentDateKey;
	    	$settingRespository->value = 1;
	    	$settingRespository->insert ();
	    } else {
	    	$result = $results [0];
	    	$settingRespository = new SettingRepository ();
	    	$settingRespository->id = $result->id;
	    	$settingRespository->value = intval ( $result->value ) + 1;
	    	$settingRespository->updateById ();
	    }
	    
	    LayoutFactory::getLayout ( LayoutFactory::MAIN_DETAIL )
	    ->setData ( $data )
	    ->setTitles ( 'Phòng khám ')
	    ->setJavascript(array('/js/controllers/PositionController.js'))
	    ->render ( 'HospitalView' );
	}
	
	function LoadTopPositionNearCurrentPosition($number){
	    $lat = $this->input->get("lat");
	    $long = $this->input->get("long");
	    
	    $lat = empty($lat) ? 21.044829 : $lat;
	    $long = empty($lat) ? 105.757673 : $long;
	    
	    
	    $positionRespository = new PositionRepository();
	    $results = $positionRespository->getMutilCondition();
	    foreach ($results as $result){
	        $result instanceof PositionRepository;
	        $result->distance = Common::distance($lat, $long, $result->latitude, $result->longitude);
	    }
	    function sortPosition($a, $b)
	    {
	        $b instanceof PositionRepository;
	        $a instanceof PositionRepository;
	        if ($a->distance == $b->distance) {
	            return 0;
	        }
	        return ($a->distance < $b->distance) ? -1 : 1;
	    }
	    usort($results, "sortPosition");
	    $results = array_slice($results, 0, $number);
	    $this->output->set_content_type ( 'application/json' )->set_output ( json_encode ( $results, true ) );
	}
}

