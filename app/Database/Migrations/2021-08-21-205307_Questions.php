<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Questions extends Migration
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
			'question'       => [
					'type'       => 'VARCHAR',
					'constraint' => '1500',
			],
			'choice1'       => [
				'type'       => 'VARCHAR',
				'constraint' => '500',
	     	],
			 'choice2'       => [
				'type'       => 'VARCHAR',
				'constraint' => '500',
	     	],
			 'choice3'       => [
				'type'       => 'VARCHAR',
				'constraint' => '500',
	     	],
			 'answer'       => [
				'type'       => 'VARCHAR',
				'constraint' => '500',
	     	],
			 'quiz_id' => ['type' => 'INT',
                    'unsigned' => TRUE,
			],
			 'created_at datetime default current_timestamp',
			 'updated_at datetime default current_timestamp on update current_timestamp', 
	]);
		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('quiz_id','quizzes','id','CASCADE','CASCADE');
		$this->forge->createTable('questions');
	
	}

	public function down()
	{
		//
	}
}