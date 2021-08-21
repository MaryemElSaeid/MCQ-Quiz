<?php

namespace App\Models;

use CodeIgniter\Model;

class QuizModel extends Model
{
	// protected $DBGroup              = 'default';
	protected $table                = 'quizzes';
	protected $primaryKey           = 'id';
	protected $allowedFields = ['title','desc','total','host_id'];
	// public $has_one = array( "users" );
	// $builder = $db->table('blogs');
	// $builder->select('*');
	// $builder->join('comments', 'comments.id = blogs.id');
	// $query = $builder->get();

	public function getAllQuizzesQuery(){

		$query = "SELECT * FROM users as u,quizzes as q WHERE q.host_id = u.id ";
		$query=$this->db->query($query);	
		return $query->getResultArray();
					  
	   }   

    // return $query;


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