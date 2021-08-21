<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\QuizModel;
use App\Models\UsersModel;

class QuizController extends BaseController
{
	public function index()
	{
		$quiz = new QuizModel();
		// $user = new UsersModel();
		// $data['quiz'] = $quiz->findAll();
		$data['quiz'] = $quiz->getAllQuizzesQuery();
		return view('quizzes/index',$data);
	}
}
