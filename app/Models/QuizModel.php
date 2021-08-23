<?php

namespace App\Models;

use CodeIgniter\Model;

class QuizModel extends Model
{
	protected $table                = 'quizzes';
	protected $primaryKey           = 'id';
	protected $allowedFields = ['title','desc','total','host_id'];
	public $has_one = array( "users" );
	public $has_many = array( "questions" );

	public function getAllQuizzesQuery(){

		$query = "SELECT * FROM users as u,quizzes as q WHERE q.host_id = u.id ";
		$query=$this->db->query($query);	
		return $query->getResultArray();
					  
	   }     

}
