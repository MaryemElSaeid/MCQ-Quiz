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
		//custome validations messages

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

			$values = [
				'name'=>$name,
				'email'=>$email,
				'password'=>Hash::make($password),
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
			    $last_id = $userModel->insertID();
				session()->set("loggedUser",$last_id);
				return redirect()->to('/userdashboard');
			}
		}
	}


	function check(){
		$validation = $this->validate([
			//is_not_unique checks if email is in db
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
			// dd($email);
			$password = $this->request->getPost('password');
			$userModel = new \App\Models\UsersModel();
			//fetch user info according to email 
			$user_info = $userModel->where('email',$email)->first();
			$check_password = Hash::check($password,$user_info['password']);

			if($email == 'admin@admin.com' && $password == 'admin'){
				$user_id = $user_info['id'];
				session()->set('loggedAdmin',$user_id);
				//redirect de l controller msh view
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
		if(session()->has('loggedUser' || 'loggedAdmin')){
			session()->remove('loggedUser' || 'loggedAdmin');
			return redirect()->to('/auth?access=out')->with('fail','You are logged out!');
		}
	}
} 