<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
	public function run()
	{
		$admin_hashed_password = password_hash('admin', PASSWORD_BCRYPT);
		$admin2_hashed_password = password_hash('admin2', PASSWORD_BCRYPT);
		$data = [
		[	
			'id' => 1,
			'name' => 'admin',
			'email'    => 'admin@admin.com',
			'password' => $admin_hashed_password,
			'role_id' => 1
		],
		[
			'id' => 2,
			'name' => 'admin2',
			'email'    => 'admin2@admin.com',
			'password' => $admin2_hashed_password,
			'role_id' => 1
		],
	];

	// // Simple Queries
	// $this->db->query("INSERT INTO users (id,firstname, lastname, email, password,created_at,updated_at) VALUES(:id:,:firstname:,:lastname: :email:,:password:,:created_at:,:updated_at:)", $data);

	// Using Query Builder
	$this->db->table('users')->insertBatch($data);
	}
}
