<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
	public function run()
	{
		$data = [
			[
				'id' => 1,
			     'role' => 'admin',
		    ],
		    [	
			'id' => 2,
			'role' => 'user',
			],
	];

	$this->db->table('roles')->insertBatch($data);

	}
	
}
