<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Quiz extends Migration
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
			'title'       => [
					'type'       => 'VARCHAR',
					'constraint' => '100',
			],
			'desc'       => [
				'type'       => 'VARCHAR',
				'constraint' => '500',
	     	],
			 'total'       => [
				'type'       => 'INT',
				'constraint' => 5 ,
			 ],
			 'host_id' => ['type' => 'INT',
                    'unsigned' => TRUE,
			],
			 'created_at datetime default current_timestamp',
			 'updated_at datetime default current_timestamp on update current_timestamp', 
	]);
	$this->forge->addKey('id', true);
	$this->forge->addForeignKey('host_id','users','id');
	$this->forge->createTable('quizzes');
	}

	public function down()
	{
		//
	}
}
