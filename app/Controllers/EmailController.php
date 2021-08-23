<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class EmailController extends BaseController
{
	public function index()
	{
		$email = \Config\Services::email();
		$email->setFrom('quizapp@admin.com', 'Quiz Application');
		$email->setTo('admin@admin.com');
		$email->setSubject('Exam Notification');
		$email->setMessage('An exam Has been submitted!');
		
		if($email->send()){
             echo 'success';
		} else {
			$error = $email->printDebugger(['header']);
			print_r($error);

		}
		
	}
}
