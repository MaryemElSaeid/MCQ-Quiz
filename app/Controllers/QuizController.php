<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\QuizModel;
use App\Models\UserQuizModel;
use App\Models\UsersModel;
use App\Models\QuestionsModel;
use App\Controllers\UserDashboard;

class QuizController extends BaseController
{
	public function __construct(){
		helper(['url' , 'form']);
	}
	public function index()
	{
		$quizModel = new QuizModel();
		$data['quiz'] = $quizModel->getAllQuizzesQuery();
		return view('quizzes/index',$data);
	}

	public function listQuizForUser()
	{
		$quizModel = new QuizModel();
		$data['quiz'] = $quizModel->getAllQuizzesQuery();
		return view('quizzes/list',$data);
	}
	
	public function show($id) {
		$quizModel = new QuizModel();
		$questionModel = new QuestionsModel();
		$data['quiz'] = $quizModel->find($id);
		$data['question'] = $questionModel->where('quiz_id',$id)->find();
		return view('quizzes/show',$data);
    }

	public function showQuizForUser($id)
	{
		$quizModel = new QuizModel();
		$questionModel = new QuestionsModel();
		$data['quiz'] = $quizModel->find($id);
		$data['question'] = $questionModel->where('quiz_id',$id)->find();
		return view('quizzes/showuser',$data);
	
	}

	public function check($id)
	{
		$quizModel = new QuizModel();
		$questionModel = new QuestionsModel();
		$data['quiz'] = $quizModel->find($id);
		$data['question'] = $questionModel->where('quiz_id',$id)->find();
		$number_of_questions = count($data['question']);
		$data['user_answers']=[];
        $score = 0;
		
		for($i=0;$i<$number_of_questions;$i++){
			
			array_push($data['user_answers'],$this->request->getPost($data['question'][$i]['id']));
			$correct_answer = $data['question'][$i]['answer'];
			if ($data['user_answers'][$i] == $correct_answer) {
				$score = $score + 1; 
			}
		}
		$this->storeScore($data['quiz']['id'],$score);
		$this->sendEmail();
		return view('quizzes/results',$data);
	
	}

	public function storeScore($quiz_id,$score){
		$userquizModel = new UserQuizModel();
		$user_id = session()->get('loggedUser');
		$data = [
			'user_id' => $user_id,
			'quiz_id' => $quiz_id,
			'score' => $score,
		];
		
		$userquizModel->save($data);
		session()->setFlashdata('score', '1');
		// unset($_SESSION['score']);
		
	}

	public function sendEmail(){
		$email = \Config\Services::email();
		$email->setFrom('quizapp@admin.com', 'Quiz Application');
		$email->setTo('admin@admin.com');
		$email->setSubject('Exam Notification');
		$email->setMessage('An exam Has been submitted!');
		
		$email->send();
	}

	public function create(){
		return view('quizzes/create');
	}

	public function store(){
		$validation = $this->validate([
			'title'=>[
				'rules'=>'required|is_unique[quizzes.title]',
				'errors'=>[
					'required'=>'Title is a required field',
					'is_unique'=>'Title already taken'
				]
				
			],
			'desc'=>[
				'rules'=>'required|max_length[500]',
				'errors'=>[
					'required'=>'Description is a required field',
					'max_length'=>'Description field can not exceed 500 characters',
				]
			],
			'total'=>[
				'rules'=>'required|max_length[5]',
				'errors'=>[
					'required'=>'Description is a required field',
					'max_length'=>'Description field can not exceed 5 characters',
				]
			],
		]);

		if(!$validation){
			return view('quizzes/create',['validation' =>$this->validator]);
		} else {
						
		$quizModel = new QuizModel();
		$title = $this->request->getPost('title');
		$desc = $this->request->getPost('desc');
		$total = $this->request->getPost('total');
		$host_id = session()->get('loggedAdmin');
		$data = [
			'title'=>$title,
			'desc'=>$desc,
			'total'=>$total,
			'host_id' => $host_id,
		];
		
		$quizModel->save($data);
		$id = $quizModel->where('title',$title)->first();
		return view('questions/create',$id);
		}
	}

	public function edit($id){
		$quizModel = new QuizModel();
		$questionModel = new QuestionsModel();
		$data['quiz'] = $quizModel->find($id);
		$data['question'] = $questionModel->where('quiz_id',$id)->find();
		return view('quizzes/edit',$data);
	}

	public function update($id){
		$quizModel = new QuizModel();
		$quizModel->find($id);
		$validation = $this->validate([
			'title'=>[
				'rules'=>'required|is_unique[quizzes.id!='.$id.' AND '.'title=]',
				'errors'=>[
					'required'=>'Title is a required field',
					'is_unique'=>'Title already taken'
				]
				
			],
			'desc'=>[
				'rules'=>'required|max_length[500]',
				'errors'=>[
					'required'=>'Description is a required field',
					'max_length'=>'Description field can not exceed 500 characters',
				]
			],
			'total'=>[
				'rules'=>'required|max_length[5]',
				'errors'=>[
					'required'=>'Description is a required field',
					'max_length'=>'Description field can not exceed 5 characters',
				]
			],
		]);

		if(!$validation){

		$quizModel = new QuizModel();
		$questionModel = new QuestionsModel();
		$data['quiz'] = $quizModel->find($id);
		$data['validation'] = $this->validator;
		$data['question'] = $questionModel->where('quiz_id',$id)->find();
		return view('quizzes/edit',$data);
		} else {

		$title = $this->request->getPost('title');
		$desc = $this->request->getPost('desc');
		$total = $this->request->getPost('total');
		$host_id = session()->get('loggedAdmin');
		$data = [
			'title'=>$title,
			'desc'=>$desc,
			'total'=>$total,
			'host_id' => $host_id,
		];
		$quizModel->update($id,$data);
		return redirect()->to('/quiz')->with('success','Quiz updated successfully');
	}
	}


	public function delete($id){
		$quizModel = new QuizModel();
        $quizModel->delete($id);
		return redirect()->to('/quiz')->with('fail','Quiz deleted successfully');
	}

}
