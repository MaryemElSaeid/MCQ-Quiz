<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\QuizModel;
use App\Models\UsersModel;
use App\Models\QuestionsModel;

class QuizController extends BaseController
{
	public function __construct(){
        //to use helper class
		helper(['url' , 'form']);
	}
	public function index()
	{
		$quizModel = new QuizModel();
		// $user = new UsersModel();
		// $data['quiz'] = $quiz->findAll();
		$data['quiz'] = $quizModel->getAllQuizzesQuery();
		return view('quizzes/index',$data);
	}



	public function show($id) {
		$quizModel = new QuizModel();
		$questionModel = new QuestionsModel();
		$data['quiz'] = $quizModel->find($id);
		$data['question'] = $questionModel->where('quiz_id',$id)->find();
		// dd($data);
		return view('quizzes/show',$data);
    }

	public function create(){
		return view('quizzes/create');
	}

	public function store(){
		//to get admin id 
		// dd(session()->get('loggedAdmin'));

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
		// return redirect()->to('/question-add')->with('success','Quiz added successfully');

		}
	}

	public function edit($id){
		$quizModel = new QuizModel();
		$questionModel = new QuestionsModel();
		$data['quiz'] = $quizModel->find($id);
		$data['question'] = $questionModel->where('quiz_id',$id)->find();
		// dd($data);
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
		$data['quiz'] = $quizModel->find($id);
		$data['validation'] = $this->validator;
		return view('quizzes/edit',$data);
		} else {

		$title = $this->request->getPost('title');
		$desc = $this->request->getPost('desc');
		$total = $this->request->getPost('total');
		$host_id = session()->get('loggedAdmin');
		// dd(session()->get('loggedAdmin'));
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
