<?php

class m260303_223222_create_book extends CDbMigration
{
	public function up()
	{
		$this->createTable('book', [
			'id' => 'pk',
			'title' => 'varchar(255) NOT NULL',
			'year' => 'int NOT NULL',
			'description' => 'text',
			'isbn' => 'varchar(32)',
			'cover' => 'varchar(255)',
		]);
	}

	public function down()
	{
		$this->dropTable('book');
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