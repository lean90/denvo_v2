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
	    ->setTitles ( 'Beta Finder ')
	    ->setJavascript(array('/js/controllers/PositionController.js'))
	    ->render ( 'HospitalView' );
	}
	
	function LoadTopPositionNearCurrentPosition(){
	    $lat = $this->input->get("lat");
	    $long = $this->input->get("long");
	    $numberWillGet = $this->input->get("total");
	    $limitInKm = $this->input->get("limit");
	    $type =  $this->input->get("type");
	    if(empty($numberWillGet)){
	    	$numberWillGet = 999999;
	    }
	    if(empty($limitInKm)){
	    	$limitInKm = 999999999;
	    }
	    
	    $lat = empty($lat) ? 21.044829 : $lat;
	    $long = empty($lat) ? 105.757673 : $long;
	    
	    $positionRespository = new PositionRepository();
	    $positionRespository->position_type = $type;
	    $positionRespository->delete = 0;
	    $results = $positionRespository->getMutilCondition();
	    for($i = 0 ; $i < count($results); $i++){
	    	$result = $results[$i];
	    	$distance = Common::distance($lat, $long, $result->latitude, $result->longitude);
	    	if($distance <= $limitInKm){
	    		$result instanceof PositionRepository;
	    		$result->distance = $distance;
	    	}else{
	    		 unset($results[$i]);
	    	}
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
	    $results = array_slice($results, 0, $numberWillGet);
	    $this->output->set_content_type ( 'application/json' )->set_output ( json_encode ( $results, true ) );
	}
	
	function searchPosition(){
		$pagecount = 30;
		
		$name = $this->input->get("name");
		$catgeid = $this->input->get("cate-id");
		$type = $this->input->get("type");
		$orderBy = $this->input->get("order-col");
		$page = $this->input->get("page");
		
		$catgeid = empty($catgeid) ? 46 : $catgeid;
		$type = empty($type)  ? "" : $type;
		$orderBy = empty($orderBy) ? T_position::name : $orderBy;
		$limit = empty($page) ? 999999 : $pagecount;
		$offset = empty($page) ? 0 : $pagecount * ($page - 1);
		
		$categoryIds = array();
		$categoryRepository = new CategoryRepository();
		$results = $categoryRepository->getChildCategoriesWithOrder($catgeid);
		foreach ($results as $category){
			array_push($categoryIds, $category->id);
		}
		
		$positionRepository = new PositionRepository();
		$results = $positionRepository->searchPosition($name, $categoryIds, $orderBy, $type, $limit, $offset);
		$resultsCount = $positionRepository->getCountSearchPosition($name, $categoryIds, $type);
		
		$stdClassResult = new stdClass();
		$stdClassResult->results = $results;
		$stdClassResult->total = $resultsCount[0]->count;
		$stdClassResult->name = $this->input->get("name");
		$stdClassResult->cate_id = $this->input->get("cate-id");
		$stdClassResult->type = $this->input->get("type");
		$stdClassResult->order_col = $this->input->get("order-col");
		$stdClassResult->page = $this->input->get("page");
		
		$this->output->set_content_type ( 'application/json' )->set_output ( json_encode ( $stdClassResult, true ) );
	}
	
	function like_position($id){
		$positionRespository = new PositionRepository();
		$positionRespository->id = $id;
		$results = $positionRespository->getOneById();
		if(count($results) <= 0){
			throw new Lynx_Exception("not found");
		}
		
		$cookie = $this->input->cookie("liked_position_{$this->obj_user->id}");
		$cookie = $cookie !== false ? json_decode($cookie) : array();
		if(in_array($id,$cookie)){
			$this->output->set_content_type ( 'application/json' )->set_output ( json_encode ( false, true ) );
			return;
		}
		
		$position = $results[0];
		$positionRespository = new PositionRepository();
		$positionRespository->id = $id;
		$positionRespository->like_number = intval($position->like_number) + 1;
		$positionRespository->updateById();
		
		array_push($cookie, $id);
		setcookie("liked_position_{$this->obj_user->id}",json_encode($cookie),time() + (86400 * 3650),"/");
		$this->output->set_content_type ( 'application/json' )->set_output ( json_encode ( true, true ) );
	}
	
	function detail($id){
		$data = array();
		
		$positionRepository = new PositionRepository();
		$positionRepository->id = $id;
		$results = $positionRepository->getOneById();
		if(count($results) <= 0){
			throw new Lynx_RoutingException("NOT FOUND POSITION DETAIL {$id}");
			return;
		}
		$data['detail'] = $results[0];
		LayoutFactory::getLayout ( LayoutFactory::MAIN_DETAIL )
		->setData ( $data )
		->setTitles ( "Chi tiết phòng khám {$results[0]->name}")
		->setJavascript(array('/js/controllers/DetailPositionController.js'))
		->render ( 'detailHospitalView' );
	}
	
}

