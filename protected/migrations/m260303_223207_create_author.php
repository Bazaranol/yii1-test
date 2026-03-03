<?php

class m260303_223207_create_author extends CDbMigration
{
	public function up()
	{
		$this->createTable('author', [
			'id' => 'pk',
			'full_name' => 'varchar(255) NOT NULL',
		]);
	}

	public function down()
	{
		$this->dropTable('author');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}