<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
class Question extends BaseController {
	protected $authorization_required = false;
	function __construct() {
		parent::__construct ();
		$this->load->helper('cookie');
	}
	
	function showPage(){
	    $data = array();
	    //get question have like;
	    $answerRepository = new AnswerRepository();
	    $data['have_like_count'] = $answerRepository->getQuestionHaveLikeCount() ;
	    
	    $questionRepository =  new QuestionRepository();
	    $questionRepository->q_status = DatabaseFixedValue::QUESTION_STATUS_OK;
	    $questionRepository->delete = 0;
	    $data['all_count'] =$questionRepository->getCountCondition();

	    $questionRepository = new QuestionRepository();
	    $questionRepository->q_status = DatabaseFixedValue::QUESTION_STATUS_OK;
	    $questionRepository->delete = 0;
	    $questionRepository->question_type = DatabaseFixedValue::QUESTION_TYPE_MOST;
	    
	    $data['most_count'] = $questionRepository->getCountCondition();
	    
	    
	    $postRepository = new PostRepository ();
	    $postRepository->category_id = 2;
	    $postRepository->delete = 0;
	    $manyViewPosts = $postRepository->getMutilCondition ( T_post::view_count, 'DESC', 5 );
	    $data ['manyViewPosts'] = $manyViewPosts;
	    
	    LayoutFactory::getLayout ( LayoutFactory::MAIN_DETAIL )
	    ->setData ( $data )
	    ->setJavascript ( array ("/js/controllers/QuestionsController.js"))
	    ->setTitles ( 'Câu hỏi' )->render ( 'Questions' );
	}
	
	function detail($questionId){
	    $questionRepository = new QuestionRepository();
	    $questionRepository->id = $questionId;
	    $results = $questionRepository->getOneById();
	    if(count($results) == 0){
	       throw new Lynx_RequestException("Page not found");
	    }
	    $question = $results[0];
	    $questionRepository = new QuestionRepository();
	    $questionRepository->id = $questionId;
	    $questionRepository->view_count = $question->view_count + 1;
	    $questionRepository->updateById();
	    
	    $data = array();
	    $questionRepository = new QuestionRepository();
	    $questionRepository->id = $questionId;
	    $results = $questionRepository->getOneById();
	    $data['question'] = $results[0];
	    if(!empty($data['question']->fk_user)){
	        $userRepository = new UserRepository();
	        $userRepository->id = $question->fk_user;
	        $user = $userRepository->getOneById();
	        unset($user->pw);
	        $data['question']->user = $user[0];
	    }
	    $data['question']->friendly_time = TimeService::convertDatetimeToFriendlyMessage($data['question']->created_at);
	    
	    
	    $answerRepository = new AnswerRepository();
	    $answerRepository->fk_question = $questionId;
	    $answerRepository->delete = 0;
	    $answers = $answerRepository->getMutilCondition(T_answers::created_at,'DESC');
	    $data['answers'] = $answers;
	    foreach ($data['answers'] as &$answer){
	        $userRepository = new UserRepository();
	        $userRepository->id = $answer->fk_user;
	        $user = $userRepository->getOneById();
	        unset($user->pw);
	        $answer->user = $user[0];
	        $answer->friendly_time = TimeService::convertDatetimeToFriendlyMessage($answer->created_at);
	    }
	    
	    $postRepository = new PostRepository ();
	    $postRepository->category_id = 2;
	    $postRepository->delete = 0;
	    $manyViewPosts = $postRepository->getMutilCondition ( T_post::view_count, 'DESC', 5 );
	    $data ['manyViewPosts'] = $manyViewPosts;
	    
	    LayoutFactory::getLayout ( LayoutFactory::MAIN_DETAIL )
	    ->setData ( $data )
	    ->setJavascript ( array ("/js/controllers/QuestionController.js"))
	    ->setTitles ( 'Câu hỏi' )->render ( 'Question' );
	}
	
	function addQuestion(){
	   $acttachedimage = $this->input->post("acttachedimage"); 
	   $questionRepository = new QuestionRepository();
	   $questionRepository->email = $this->input->post("email");
	   $questionRepository->full_name = $this->input->post("full_name");
	   $questionRepository->question = $this->input->post("question");
	   $questionRepository->fk_user = $this->obj_user->id;
	   $questionRepository->question_type = DatabaseFixedValue::QUESTION_TYPE_NORMAL;
	   $questionRepository->q_status = DatabaseFixedValue::QUESTION_STATUS_PEDDING;
	   $files = isset ( $_FILES ['acttachedimage_1'] ) && ! empty ( $_FILES ['acttachedimage_1'] ) ? $_FILES ['acttachedimage_1'] : null;
       if (gettype ( $files ) == 'array' && $files ['size'] > 0) {
            $questionRepository->attached_img_1 = $this->acttachedImage ( $files );
       }
       $files = isset ( $_FILES ['acttachedimage_2'] ) && ! empty ( $_FILES ['acttachedimage_2'] ) ? $_FILES ['acttachedimage_2'] : null;
       if (gettype ( $files ) == 'array' && $files ['size'] > 0) {
           $questionRepository->attached_img_2 = $this->acttachedImage ( $files );
       }
       $files = isset ( $_FILES ['acttachedimage_3'] ) && ! empty ( $_FILES ['acttachedimage_3'] ) ? $_FILES ['acttachedimage_3'] : null;
       if (gettype ( $files ) == 'array' && $files ['size'] > 0) {
           $questionRepository->attached_img_3 = $this->acttachedImage ( $files );
       }
	   $id = $questionRepository->insert();
	   redirect('/cau-hoi/'.$id);
	}
	
    function acttachedImage($files) {
		$fileRepository = new FileRepository ();
		$fileModel = new FileService ();
		$fileID = null;
		try {
			if (isset ( $files ['name'] )) {
				$fileInfo = $files;
				if (! $fileInfo ['name'] || ! is_uploaded_file ( $fileInfo ['tmp_name'] ) || ! file_exists ( $fileInfo ['tmp_name'] )) {
					return;
				}
				list ( $imgWidth, $imgHeight, $imgType, $imgAttr ) = getimagesize ( $fileInfo ['tmp_name'] );
				$fileID = $fileModel->handleImageUpload ( $fileInfo, $fileRepository );
			}
		} catch ( Exception $e ) {
			throw $e;
		}
		return $fileID;
	}
	
	function getQuestions($method){
	    
	    $page = $this->input->get("page");
	    $page = $page === false ? 0 : $page - 1;
	    $offset = $page * 10;
	    $limit = 10;
	    $questionRepository = new QuestionRepository();
	    $questionRepository->delete = 0;
	    if($this->obj_user->account_role != DatabaseFixedValue::USER_TYPE_ADMIN && $this->obj_user->account_role != DatabaseFixedValue::USER_TYPE_COLLABORATORS){
	        $questionRepository->q_status = DatabaseFixedValue::QUESTION_STATUS_OK;
	    }
	    $data = array();
	    
		switch ($method){
			case "fill_all" :
			    $data['questions'] = $questionRepository->getMutilCondition(T_questions::created_at,'DESC',$limit,$offset);
			    $data['count'] = $questionRepository->getCountCondition();
			    break;
			case DatabaseFixedValue::QUESTION_TYPE_MOST :
			    $questionRepository->question_type = DatabaseFixedValue::QUESTION_TYPE_MOST;
			    $data['questions'] = $questionRepository->getMutilCondition(T_questions::created_at,'DESC',$limit,$offset);
			    $data['count'] = $questionRepository->getCountCondition();
			    break;
			case 'many-like':
			    $answerRespository = new AnswerRepository();
			    $results = $answerRespository->getQuestionIdsOrderByLike($limit, $offset);
			    $questionIds = array();
			    foreach ($results as $result){
			         array_push($questionIds,  $result->fk_question);
			    }
			    $questionRepository = new QuestionRepository();
			    $data['questions'] = $questionRepository->getWhereIn(T_questions::id, $questionIds);
			    $data['count'] = $answerRespository->getQuestionHaveLikeCount();
			break;
		}
		foreach ($data["questions"] as &$question){
		    $answerRespository = new AnswerRepository();
		    $question->answer = $answerRespository->getMostAnswer($question->id);
		    if(!empty($question->answer)){
    		    $question->answer->friendly_time = TimeService::convertDatetimeToFriendlyMessage($question->answer->created_at);
    		    $answerRespository = new AnswerRepository();
    		    $answerRespository->fk_question = $question->id;
    		    $answerRespository->delete = 0;
    		    $question->answers_count = $answerRespository->getCountCondition();
		    }
		    if(!empty($question->fk_user)){
		        $userRepository = new UserRepository();
		        $userRepository->id = $question->fk_user;
		        $user = $userRepository->getOneById();
		        unset($user->pw);
		        $question->user = $user[0];
		    }
		}
		
		$returnData = array();
		$returnData['data'] = $data;
		$returnData['page'] = $page + 1;
		
		$this->output->set_content_type ( 'application/json' )->set_output ( json_encode ( $returnData, true ) );
	}
	
	function addAnswer($questionId){
	   $answerRepository = new AnswerRepository();
	   $answerRepository->answer = $this->input->post("answer");
	   $answerRepository->fk_user = $this->obj_user->id;
	   $answerRepository->fk_question =  $questionId;
	   $answerRepository->total_like_number = 0;
	   $answerRepository->insert();
	   redirect('/cau-hoi/'.$questionId);
	}
	
	function like($answerId){
	    $answerRepository = new AnswerRepository();
	    $answerRepository->id = $answerId;
	    $results = $answerRepository->getOneById();
	    $like_count = $results[0]->total_like_number;
	    $question_id = $results[0]->fk_question;
	    $answerRepository = new AnswerRepository();
	    $answerRepository->id = $answerId;
	    $answerRepository->total_like_number = $like_count += 1;
	    $answerRepository->updateById();
	    $cookie = $this->input->cookie("liked_{$this->obj_user->id}_{$question_id}");
	    $cookie = $cookie !== false ? json_decode($cookie) : array();
	    array_push($cookie, $answerId);
	    setcookie("liked_{$this->obj_user->id}_{$question_id}",json_encode($cookie),time() + (86400 * 3650),"/");
	    redirect('/cau-hoi/'.$question_id);
	}
	
	function del($questionId){
	   $questionRepository = new QuestionRepository();
	   $questionRepository->id = $questionId;
	   $questionRepository->delete = true;
	   $questionRepository->deleted_at = $questionRepository->getDate();
	   $questionRepository->updateById();
	   redirect('/danh-sach-cau-hoi');
	}
	
	function setToMostQuestion($questionId){
	    $questionRepository = new QuestionRepository();
	    $questionRepository->id = $questionId;
	    $questionRepository->question_type = DatabaseFixedValue::QUESTION_TYPE_MOST;
	    $questionRepository->updateById();
	    redirect('/danh-sach-cau-hoi');
	}
	
	function removeToMostQuestion($questionId){
	    $questionRepository = new QuestionRepository();
	    $questionRepository->id = $questionId;
	    $questionRepository->question_type = DatabaseFixedValue::QUESTION_TYPE_NORMAL;
	    $questionRepository->updateById();
	    redirect('/danh-sach-cau-hoi');
	}
	
	function removeAnswer($ansId){
	    
	    $answerRespository = new AnswerRepository();
	    $answerRespository->id = $ansId;
	    $var = $answerRespository->getOneById();
	    if(count($var) == 0){
	        throw new Lynx_RequestException("Answers đã bị xóa");
	        return;
	    }
	    $question_id = $var[0]->fk_question;
	    
	    $answerRespository = new AnswerRepository();
	    $answerRespository->id = $ansId;
	    $answerRespository->delete();
	    redirect('/cau-hoi/'.$question_id);
	}
	
	function publicQuestion($questionId){
	    $questionRepository = new QuestionRepository();
	    $questionRepository->id = $questionId;
	    $questionRepository->q_status = DatabaseFixedValue::QUESTION_STATUS_OK;
	    $questionRepository->updateById();
	    redirect('/cau-hoi/'.$questionId);
	}
	
	function rejectQuestion($questionId){
	    $questionRepository = new QuestionRepository();
	    $questionRepository->id = $questionId;
	    $questionRepository->q_status = DatabaseFixedValue::QUESTION_STATUS_REJECT;
	    $questionRepository->updateById();
	    redirect('/cau-hoi/'.$questionId);
	}
	
}