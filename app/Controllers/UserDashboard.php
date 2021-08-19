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
}
