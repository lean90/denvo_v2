<?php
class CategoryService {
    function del($categoryId)
    {
        $categoryRespository = new CategoryRepository();
        $categoryRespository->id = $categoryId;
        $results = $categoryRespository->getOneById();
        $category = $results[0];
        $category instanceof CategoryRepository;
        
        $this->updatePositionOnDelCategory($category->id, $category->category_id);
        $this->updatePostOnDelCategory($category->id, $category->category_id);
        $this->updateChildCategoryViaDel($category->id, $category->category_id);
        
        $categoryRespository->delete();
        
        $categoryRespository = new CategoryRepository();
        $categoryRespository->id = $categoryId;
        $results = $categoryRespository->getOneById();
        $category = $results[0];
        return $category;
    }
    
    function updatePositionOnDelCategory($categoryId, $parentCategoryId){
        $positionRepository = new PositionRepository();
        $positionRepository->fk_category = $categoryId;
        $results = $positionRepository->getMutilCondition();
        $positionRepository = new PositionRepository();
        foreach ($results as $result){
        	$positionRepository->id =  $result->id;
        	$positionRepository->fk_category = $parentCategoryId;
        	$positionRepository->updateById();
        }
    }
    
    function updatePostOnDelCategory($categoryId, $parentCategoryId){
    	$postRepository = new PostRepository();
    	$postRepository->fk_category = $categoryId;
    	$results = $postRepository->getMutilCondition();
    	$postRepository = new PostRepository();
    	foreach ($results as $result){
    		$postRepository->id =  $result->id;
    		$postRepository->fk_category = $parentCategoryId;
    		$postRepository->updateById();
    	}
    }
    
    function updateChildCategoryViaDel($categoryId,$parentCategoryId){
    	$categoryRespository = new CategoryRepository();
    	$categoryRespository->category_id =  $categoryId;
    	$results = $categoryRespository->getMutilCondition();
    	
    	$categoryRespository = new CategoryRepository();
    	foreach($results as $result){
    		$result instanceof CategoryRepository;
    		$categoryRespository->id = $result->id;
    		$categoryRespository->category_id = $parentCategoryId;
    		$categoryRespository->updateById();
    	}
    	
    	$this->buildChild($parentCategoryId);
    }
    
    function buildChild($categoryId)
    {
    	$categoryRespository = new CategoryRepository();
    	$categoryRespository->id = $categoryId;
    	$categories =  $categoryRespository->getOneById();
    	$category = $categories[0];
    	$category instanceof CategoryRepository;
    	
		$categoryRespository = new CategoryRepository();
		$categoryRespository->category_id =  $categoryId;
		$results = $categoryRespository->getMutilCondition();
		
		$categoryRespository = new CategoryRepository();
		foreach ($results as $result){
			$result instanceof CategoryRepository;
			if(empty($result->category_id) || intval($result->delete) != 0){
				continue;
			}
			
			$newParthOnPartTree = Common::removeVietnameseAaccents($result->name);
			$newParthOnPartTree = "/".str_replace(" ", "-", $newParthOnPartTree);
			$categoryRespository->id = $result->id;
			$categoryRespository->part_url = $category->part_url.$newParthOnPartTree;
			$categoryRespository->part_tree = $category->part_tree.",{$result->id}";
			$categoryRespository->updateById();
			
			$this->buildChild($result->id);
		}
		
    }
    
    
    
}