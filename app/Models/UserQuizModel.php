<?php

namespace App\Models;

use CodeIgniter\Model;

class UserQuizModel extends Model
{
	protected $table                = 'userquizzes';
	protected $primaryKey           = 'id';
	protected $allowedFields = ['user_id','quiz_id','score'];

	public function getAllUserQuizzesQuery($id){

		$query = "SELECT uq.created_at,user_id,score,title FROM userquizzes as uq,quizzes as q  WHERE uq.user_id = $id and uq.quiz_id = q.id";
		$query=$this->db->query($query);	
		return $query->getResultArray();
					  
	   } 
}
