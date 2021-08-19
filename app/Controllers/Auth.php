<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Hash;

class Auth extends BaseController
{
	public function __construct(){
        //to use helper class
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
		//request validations
		//custom validations messages
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
				'rules'=>'required|min_length[5]|max_length[15]',
				'errors'=>[
					'required'=>'Password is a required field',
					'min_length'=>'Password must have at least 5 characters',
					'max_length'=>'Password can not be more than 15 characters',
				]
			],
			'cpassword'=>[
				'rules'=>'required|min_length[5]|max_length[15]|matches[password]',
				'errors'=>[
					'required'=>'Confirm password is a required field',
					'min_length'=>'Confirm password must have at least 5 characters',
					'max_length'=>'Confirm password can not be more than 15 characters',
					'matches'=>'Confirm password must match password'
				]
			],
			

		]);

		if(!$validation){
			return view('auth/register',['validation' =>$this->validator]);
		} else {
			//if all validations are passed add to db
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
			//insert data into database
			$query = $userModel->insert($values);

			// if data not inserted in db
			if(!$query){
				return redirect()->back()->with('fail','Something went wrong');
				// return redirect()->to('register')->with('fail','Something went wrong');
			} else {
				// return redirect()->to('auth/register')->with('success','You registred successfully');
				//if registered successfully redirect to userdash 
				// make user login automatically 
			    $last_id = $userModel->insertID();
				session()->set("loggedUser",$last_id);
				return redirect()->to('/userdashboard');
			}
		}
	}


	function check(){
		$validation = $this->validate([
			//is_not_unique checks if email is in db
			//here are the intial checks before searching in db 
			'email'=>[
				'rules'=>'required|valid_email|is_not_unique[users.email]',
				'errors'=>[
					'required'=>'Email is a required field',
					'valid_email'=>'Enter a valid Email',
					'is_not_unique'=>'This email is not registred'
				]
			],
			'password'=>[
				'rules'=>'required|min_length[5]|max_length[15]',
				'errors'=>[
					'required'=>'Password is a required field',
					'min_length'=>'Password must have at least 5 characters',
					'max_length'=>'Password can not be more than 15 characters',
				]
			]
		]);

		if(!$validation){
			return view('auth/login',['validation'=>$this->validator]);
		} else {
			$email = $this->request->getPost('email');
			$password = $this->request->getPost('password');
			$userModel = new \App\Models\UsersModel();
			//fetch user info according to email 
			$user_info = $userModel->where('email',$email)->first();
			$roleid = $user_info['role_id'];
			// dd($roleid);
			$check_password = Hash::check($password,$user_info['password']);
    
			if($roleid == 1 && $check_password ){
				$user_id = $user_info['id'];
				session()->set('loggedAdmin',$user_id);
				return redirect()->to('/admindashboard');
				// dd(session());
				//redirect de l controller msh view
				// if(session()->has('loggedAdmin')){
				// 	dd(session());
				// }
			}
	
            //law 3adda mn el if de yb2a da msh admin w aroo7 
			//a check 3ala info bt3to fel db 
			if(!$check_password){
				session()->setFlashdata('fail','Incorrect Password');
				return redirect()->to('/auth')->withInput();
			} else {
				$user_id = $user_info['id'];
				session()->set('loggedUser',$user_id);
				// if(session()->has('loggedAdmin')){
				// 	dd(session());
				// }
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