<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
	protected $table                = 'users';
	protected $primaryKey           = 'id';
	protected $allowedFields = ['name','email','password','role_id'];
	public $has_many = array( "quizzes" );
	public $has_one = array( "roles" );

}
