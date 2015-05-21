<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Location extends BaseAdminController {
	function __construct() {
		parent::__construct ();
	}
	
	
	function ShowPage() {
		$category = new CategoryRepository();
		$category->part_url = "/phong-kham";
		$results = $category->getMutilCondition();
		$data = array();
		$data['rootCate'] = $results[0];
		LayoutFactory::getLayout ( LayoutFactory::MAIN_ADMIN )
		->setData ($data)
		->setTitles ( 'Cấu hình bản đồ' )
		->render ('admin/location');
	}
	
	function getLocationByName(){
		$q = $this->input->get("q");
		$location = new PositionRepository();
		$location->name = $q;
	    $results = $location->getWhereLike(T_position::name,'both');
	    foreach (array_keys($results) as $key) {
	    	if($results[$key]->delete == "1" || $results[$key]->delete == 1){
	    		unset($results[$key]);
	    	}
	    }
	    $this->output->set_content_type ( 'application/json' )->set_output ( json_encode ( $results, true ) );
	}
	
	function add(){
		$post = $this->input->post();
		$data = $post['data'];
		$location = new PositionRepository();
		$location->fk_category = $data['fk_category'];
		$location->name = $data['name'];
		$location->description = $data['description'];
		$location->website_link = $data['website_link'];
		$location->latitude = $data['lat'];
		$location->longitude = $data['long'];
		$location->created_at = $location->getDate();
		$location->position_type = $data['position_type'];
		$location->img1 = $data['img1'];
		$location->img2 = $data['img2'];
		$location->img3 = $data['img3'];
		$location->img4 = $data['img4'];
		$location->detail_address = $data['detail_address'];
		$location->sort_description = $data['sort_description'];
		$location->email = $data['email'];
		$location->hotline = $data['hotline'];
		$location->working_time  = $data['working_time'];
		$result = $location->insert();
		$this->output->set_content_type ( 'application/json' )->set_output ( json_encode ( $result, true ) );
	}
	
	function update(){
		$post = $this->input->post();
		$data = $post['data'];
		$location = new PositionRepository();
		$location->id = $data['id'];
		$location->fk_category = $data['fk_category'];
		$location->name = $data['name'];
		$location->description = $data['description'];
		$location->website_link = $data['website_link'];
		$location->latitude = $data['lat'];
		$location->longitude = $data['long'];
		$location->created_at = $location->getDate();
		$location->position_type = $data['position_type'];
		$location->img1 = $data['img1'];
		$location->img2 = $data['img2'];
		$location->img3 = $data['img3'];
		$location->img4 = $data['img4'];
		$location->detail_address = $data['detail_address'];
		$location->sort_description = $data['sort_description'];
		$location->email = $data['email'];
		$location->hotline = $data['hotline'];
		$location->working_time  = $data['working_time'];
		$result = $location->updateById();
		$this->output->set_content_type ( 'application/json' )->set_output ( json_encode ( $result, true ) );
	}
	
	function del(){
		$post = $this->input->post();
		$data = $post['data'];
		$location = new PositionRepository();
		$location->id = $data['id'];
		$result = $location->delete();
		$this->output->set_content_type ( 'application/json' )->set_output ( json_encode ( $result, true ) );
	}
	
	function addArea(){
		$data = $this->input->post('data');
		
		$category = new CategoryRepository();
		$category->category_id = $data['parent'];
		$category->name = $data['name'];
		$category->created_at = $category->getDate();
		$category->order = 1;
		$category->visible = 1;
		$newId = $category->insert();
		
		$parentCategoryRepository = new CategoryRepository();
		$parentCategoryRepository->id =  $data['parent'];
		$results = $parentCategoryRepository->getOneById();
		$parentCategory = $results[0];
		$parentCategory instanceof CategoryRepository;
		
		
		$nameClear = $this->removeVietnameseAaccents($data['name']);
		$nameClear = str_replace(' ', "-", $nameClear);
		$category = new CategoryRepository();
		$category->id = $newId;
		$category->part_url = $parentCategory->part_url ."/".$nameClear;
		$category->part_tree = $parentCategory->part_tree.",{$newId}";
		$category->updateById();
		$query =  $category->db->last_query();
		
		$this->output->set_content_type ( 'application/json' )->set_output ( json_encode ( true, true ) );
	}
	
	function removeArea(){
		$data = $this->input->post("data");
		$categoryService = new CategoryService();
		$this->output->set_content_type ( 'application/json' )->set_output ( json_encode ( $categoryService->del ( $data['id'] ), true ) );
	}
	
	function updateArea(){
		$data = $this->input->post('data');
		
		$category = new CategoryRepository();
		$category->id = $data['id'];
		$category->category_id = $data['parent'];
		$category->name = $data['name'];
		$category->updateById();
		
		$categoryService = new CategoryService();
		$categoryService->buildChild($data['parent']);
		
		$this->output->set_content_type ( 'application/json' )->set_output ( json_encode ( true, true ) );
	}
	
}