<?php

namespace App\Models;

use CodeIgniter\Model;

class QuestionsModel extends Model
{
	protected $table                = 'questions';
	protected $primaryKey           = 'id';
	protected $allowedFields = ['question','choice1','choice2','choice3','answer','quiz_id'];
	public $has_one = array( "quizzes" );
}
