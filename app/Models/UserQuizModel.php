<?php

namespace App\Models;

use CodeIgniter\Model;

class UserQuizModel extends Model
{
	// protected $DBGroup              = 'default';
	protected $table                = 'userquizzes';
	protected $primaryKey           = 'id';
	protected $allowedFields = ['user_id','quiz_id','score'];

	public function getAllUserQuizzesQuery($id){

		$query = "SELECT uq.created_at,user_id,score,title FROM userquizzes as uq,quizzes as q  WHERE uq.user_id = $id and uq.quiz_id = q.id";
		$query=$this->db->query($query);	
		return $query->getResultArray();
					  
	   } 
	// protected $useAutoIncrement     = true;
	// protected $insertID             = 0;
	// protected $returnType           = 'array';
	// protected $useSoftDeletes       = false;
	// protected $protectFields        = true;
	// protected $allowedFields        = [];

	// // Dates
	// protected $useTimestamps        = false;
	// protected $dateFormat           = 'datetime';
	// protected $createdField         = 'created_at';
	// protected $updatedField         = 'updated_at';
	// protected $deletedField         = 'deleted_at';

	// // Validation
	// protected $validationRules      = [];
	// protected $validationMessages   = [];
	// protected $skipValidation       = false;
	// protected $cleanValidationRules = true;

	// // Callbacks
	// protected $allowCallbacks       = true;
	// protected $beforeInsert         = [];
	// protected $afterInsert          = [];
	// protected $beforeUpdate         = [];
	// protected $afterUpdate          = [];
	// protected $beforeFind           = [];
	// protected $afterFind            = [];
	// protected $beforeDelete         = [];
	// protected $afterDelete          = [];
}
