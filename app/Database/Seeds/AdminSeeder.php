<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
	public function run()
	{
		$data = [
			'id' => 1,
			'name' => 'admin',
			'email'    => 'admin@admin.com',
			'password' => 'admin',
	];

	// // Simple Queries
	// $this->db->query("INSERT INTO users (id,firstname, lastname, email, password,created_at,updated_at) VALUES(:id:,:firstname:,:lastname: :email:,:password:,:created_at:,:updated_at:)", $data);

	// Using Query Builder
	$this->db->table('users')->insert($data);
	}
}
