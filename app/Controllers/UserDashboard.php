<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\QuizModel;
use App\Models\UserQuizModel;

class UserDashboard extends BaseController
{
	public function __construct(){
		helper(['url' , 'form']);
	}
	public function index()
	{
		$userModel = new \App\Models\UsersModel();
		$loggedUserId = session()->get('loggedUser');
		$userInfo = $userModel->find($loggedUserId);
		$data = [
			'title'=>'Dashboard',
			'userInfo'=>$userInfo
		];
		return view('dashboard/userdashboard',$data);
	} 

	public function test(){
		dd('hellooooo');
	}

	public function list(){
		$userModel = new UsersModel();
		$data['user'] = $userModel->findAll();
		return view('users/index',$data);
	}

	public function show($id) {
		// dd(session()->get('loggedUser'));
		$userModel = new UsersModel();
		$userquizModel = new UserQuizModel();
		$data['user'] = $userModel->find($id);
		$user_id = $data['user']['id'];
		$data['userquiz'] = $userquizModel->getAllUserQuizzesQuery($user_id);
		return view('users/show',$data);
    }

	public function create(){
		return view('users/create');
	}

	public function store(){

		$validation = $this->validate([
			'name'=>[
				'rules'=>'required',
				'errors'=>[
					'required'=>'Name is a required field'
				]
			],
			'email'=>[
				'rules'=>'required|valid_email|is_unique[users.email]',
				'errors'=>[
					'required'=>'Email is a required field',
					'valid_email'=>'Enter a valid Email',
					'is_unique'=>'Email already taken'
				]
			],
			'password'=>[
				'rules'=>'required|min_length[5]',
				'errors'=>[
					'required'=>'Password is a required field',
					'min_length'=>'Password must have at least 5 characters',
				]
			],
		]);

		if(!$validation){
			return view('users/create',['validation' =>$this->validator]);
		} else {
			
		$userModel = new UsersModel();
		$name = $this->request->getPost('name');
		$email = $this->request->getPost('email');
		$password = $this->request->getPost('password');
		$role_id = $this->role_id = 2;
		$data = [
			'name'=>$name,
			'email'=>$email,
			'password'=>password_hash($password, PASSWORD_BCRYPT),
			'role_id'=>$role_id,
		];
		$userModel->save($data);
		return redirect()->to('/user')->with('success','User added successfully');

		}
	}

	public function edit($id){
		$userModel = new UsersModel();
		$data['user'] = $userModel->find($id);
		return view('users/edit',$data);
	}

	public function update($id){
		$userModel = new UsersModel();
		$userModel->find($id);
		$validation = $this->validate([
			'name'=>[
				'rules'=>'required',
				'errors'=>[
					'required'=>'Name is a required field'
				]
			],
			'email'=>[
				'rules'=>'required|valid_email|is_unique[users.id!='.$id.' AND '.'email=]',
				'errors'=>[
					'required'=>'Email is a required field',
					'valid_email'=>'Enter a valid Email',
					'is_unique'=>'Email already taken'
				]
			],

		]);

		if(!$validation){

		$userModel = new UsersModel();
		$data['user'] = $userModel->find($id);
		$data['validation'] = $this->validator;
		return view('users/edit',$data);
		} else {

		$name = $this->request->getPost('name');
		$email = $this->request->getPost('email');
		$role_id = $this->role_id = 2;
		$data = [
			'name'=>$name,
			'email'=>$email,
			'role_id'=>$role_id,
		];
		$userModel->update($id,$data);
		if (session()->has('loggedUser')){
			return redirect()->to('/userdashboard')->with('success','Profile updated successfully');
		} else {
            return redirect()->to('/user')->with('success','User updated successfully');
		}
		
	}
	}

	public function delete($id){
		$userModel = new UsersModel();
        $userModel->delete($id);
		return redirect()->to('/user')->with('fail','User deleted successfully');
	}


}
