<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AdminDashboard extends BaseController
{
	public function index()
	{
		$userModel = new \App\Models\UsersModel();
		$loggedAdminId = session()->get('loggedAdmin');
		$adminInfo = $userModel->find($loggedAdminId);
		$data = [
			'title'=>'AdminDashboard',
			'adminInfo'=>$adminInfo
		];
		return view('dashboard/admindashboard',$data);
	}
}
