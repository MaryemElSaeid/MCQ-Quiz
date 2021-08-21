<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
					'type'           => 'INT',
					'constraint'     => 5,
					'unsigned'       => true,
					'auto_increment' => true,
			],
			'name'       => [
					'type'       => 'VARCHAR',
					'constraint' => '50',
			],
			'email'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
	     	],
			 'password'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
			 ],
			 'role_id' => ['type' => 'INT',
                    'unsigned' => TRUE,
			],
			 'created_at datetime default current_timestamp',
			 'updated_at datetime default current_timestamp on update current_timestamp', 
	]);
	$this->forge->addKey('id', true);
	$this->forge->addForeignKey('role_id','roles','id','CASCADE','CASCADE');
	$this->forge->createTable('users');
	}

	public function down()
	{
		//
	}
}