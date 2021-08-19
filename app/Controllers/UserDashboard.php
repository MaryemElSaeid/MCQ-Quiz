<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class UserDashboard extends BaseController
{
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

	public function list(){
		$userModel = new UsersModel();
		$data['user'] = $userModel->findAll();
		return view('users/index',$data);
	}

	public function create(){
		return view('users/create');
	}

	public function store(){
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
		// dd($data);
		$userModel->save($data);
		return redirect()->to('/user')->with('success','User added successfully');
	}
}
