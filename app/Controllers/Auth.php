<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Hash;

class Auth extends BaseController
{
	public function __construct(){
		helper(['url' , 'form']);
	}
	public function index()
	{
		return view('auth/login');
	}

	public function register()
	{
		return view('auth/register');
	}

	public function save()
	{
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
			'cpassword'=>[
				'rules'=>'required|min_length[5]|matches[password]',
				'errors'=>[
					'required'=>'Confirm password is a required field',
					'min_length'=>'Confirm password must have at least 5 characters',
					'matches'=>'Confirm password must match password'
				]
			],
			

		]);

		if(!$validation){
			return view('auth/register',['validation' =>$this->validator]);
		} else {
			$name = $this->request->getPost('name');
			$email = $this->request->getPost('email');
			$password = $this->request->getPost('password');
			$role_id = $this->role_id = 2;

			$values = [
				'name'=>$name,
				'email'=>$email,
				'password'=>Hash::make($password),
				'role_id'=>$role_id,
			];


			$userModel = new \App\Models\UsersModel();
			$query = $userModel->insert($values);
			if(!$query){
				return redirect()->back()->with('fail','Something went wrong');
				
			} else {
			    $last_id = $userModel->insertID();
				session()->set("loggedUser",$last_id);
				return redirect()->to('/userdashboard');
			}
		}
	}


	function check(){
		$validation = $this->validate([
			'email'=>[
				'rules'=>'required|valid_email|is_not_unique[users.email]',
				'errors'=>[
					'required'=>'Email is a required field',
					'valid_email'=>'Enter a valid Email',
					'is_not_unique'=>'This email is not registred'
				]
			],
			'password'=>[
				'rules'=>'required|min_length[5]',
				'errors'=>[
					'required'=>'Password is a required field',
					'min_length'=>'Password must have at least 5 characters',
				]
			]
		]);

		if(!$validation){
			return view('auth/login',['validation'=>$this->validator]);
		} else {
			$email = $this->request->getPost('email');
			$password = $this->request->getPost('password');
			$userModel = new \App\Models\UsersModel();

			$user_info = $userModel->where('email',$email)->first();
			$roleid = $user_info['role_id'];

			$check_password = Hash::check($password,$user_info['password']);
    
			if($roleid == 1 && $check_password ){
				$user_id = $user_info['id'];
				session()->set('loggedAdmin',$user_id);
				return redirect()->to('/admindashboard');
			}
	

			if(!$check_password){
				session()->setFlashdata('fail','Incorrect Password');
				return redirect()->to('/auth')->withInput();
			} else {
				$user_id = $user_info['id'];
				session()->set('loggedUser',$user_id);
				return redirect()->to('/userdashboard');

			}
		}

	}

	function logout(){
		if(session()->has('loggedUser')){
			session()->remove('loggedUser');
			return redirect()->to('/auth?access=out')->with('fail','You are logged out!');
		}

		if(session()->has('loggedAdmin')){
			session()->remove('loggedAdmin');
			return redirect()->to('/auth?access=out')->with('fail','You are logged out!');
		}
	}
} 