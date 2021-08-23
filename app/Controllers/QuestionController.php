<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\QuestionsModel;
use App\Models\QuizModel;

class QuestionController extends BaseController
{
	public function __construct(){
		helper(['url' , 'form']);
	}
	public function index()
	{
		//
	}

	public function create($id){
		$quizModel = new QuizModel();
		$id = $quizModel->where('id',$id)->first();
		return view('questions/create',$id);
	}

	public function store($id){
		//to get admin id 
		// dd(session()->get('loggedAdmin'));

		$validation = $this->validate([
			'question'=>[
				'rules'=>'required|max_length[1500]',
				'errors'=>[
					'required'=>'Question is a required field',
					'max_length'=>'Question field can not exceed 1500 characters',
				]
				
			],
			'choice1'=>[
				'rules'=>'required|max_length[500]',
				'errors'=>[
					'required'=>'Choice 1 is a required field',
					'max_length'=>'Choice 1 field can not exceed 500 characters',
				]
			],
			'choice2'=>[
				'rules'=>'required|max_length[500]',
				'errors'=>[
					'required'=>'Choice 2 is a required field',
					'max_length'=>'Choice 2 field can not exceed 500 characters',
				]
			],
			'choice3'=>[
				'rules'=>'required|max_length[500]',
				'errors'=>[
					'required'=>'Choice 3 is a required field',
					'max_length'=>'Choice 3 field can not exceed 500 characters',
				]
			],
			'answer'=>[
				'rules'=>'required|max_length[500]',
				'errors'=>[
					'required'=>'Answer is a required field',
					'max_length'=>'Answer field can not exceed 500 characters',
				]
			],
		]);
		if(!$validation){
			return view('questions/create',['validation' =>$this->validator]);
		} else {
						
		$questionModel = new QuestionsModel();
		$quizModel = new QuizModel();
		$question = $this->request->getPost('question');
		$choice1 = $this->request->getPost('choice1');
		$choice2 = $this->request->getPost('choice2');
		$choice3 = $this->request->getPost('choice3');
		$answer = $this->request->getPost('answer');
		$quiz_id = $id;
		$data = [
			'question'=>$question,
			'choice1'=>$choice1,
			'choice2'=>$choice2,
			'choice3'=>$choice3,
			'answer'=>$answer,
			'quiz_id' => $quiz_id,
		];
		$questionModel->save($data);
		$id = $quizModel->where('id',$id)->first();
		return view('questions/create',$id);
		}
	}

	public function edit($id){
		$questionModel = new QuestionsModel();
		$data['question'] = $questionModel->find($id);
		return view('questions/edit',$data);
	}

	public function update($id){
		$questionModel = new QuestionsModel();
		$questionModel->find($id);
		$validation = $this->validate([
			'question'=>[
				'rules'=>'required|max_length[1500]',
				'errors'=>[
					'required'=>'Question is a required field',
					'max_length'=>'Question field can not exceed 1500 characters',
				]
				
			],
			'choice1'=>[
				'rules'=>'required|max_length[500]',
				'errors'=>[
					'required'=>'Choice 1 is a required field',
					'max_length'=>'Choice 1 field can not exceed 500 characters',
				]
			],
			'choice2'=>[
				'rules'=>'required|max_length[500]',
				'errors'=>[
					'required'=>'Choice 2 is a required field',
					'max_length'=>'Choice 2 field can not exceed 500 characters',
				]
			],
			'choice3'=>[
				'rules'=>'required|max_length[500]',
				'errors'=>[
					'required'=>'Choice 3 is a required field',
					'max_length'=>'Choice 3 field can not exceed 500 characters',
				]
			],
			'answer'=>[
				'rules'=>'required|max_length[500]',
				'errors'=>[
					'required'=>'Answer is a required field',
					'max_length'=>'Answer field can not exceed 500 characters',
				]
			],
		]);
		if(!$validation){
				
			$data['question'] = $questionModel->find($id);
			$data['validation'] = $this->validator;
			return view('questions/edit',$data);
		} else {
		$question = $this->request->getPost('question');
		$choice1 = $this->request->getPost('choice1');
		$choice2 = $this->request->getPost('choice2');
		$choice3 = $this->request->getPost('choice3');
		$answer = $this->request->getPost('answer');
		$data = [
			'question'=>$question,
			'choice1'=>$choice1,
			'choice2'=>$choice2,
			'choice3'=>$choice3,
			'answer'=>$answer,
		];
		$questionModel->update($id,$data);
		return redirect()->to('/quiz')->with('success','Question updated successfully');
	}
	}


	public function delete($id){
		$questionModel = new QuestionsModel();
        $questionModel->delete($id);
		return redirect()->to('/quiz')->with('fail','Question deleted successfully');
	}

}
