<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserQuiz extends Migration
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
			'user_id' => [
				'type' => 'INT',
			     'unsigned' => TRUE,
	        ],
			 'quiz_id' => [
				 'type' => 'INT',
                 'unsigned' => TRUE,
			],
			'score' => [
				'type' => 'INT',
				'unsigned' => TRUE,
		   ],
			 'created_at datetime default current_timestamp',
			 'updated_at datetime default current_timestamp on update current_timestamp', 
	]);
		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('user_id','users','id','CASCADE','CASCADE');
		$this->forge->addForeignKey('quiz_id','quizzes','id','CASCADE','CASCADE');
		$this->forge->createTable('userquizzes');
	
	}

	public function down()
	{
		//
	}
}
