<?php

class m260303_223245_create_user extends CDbMigration
{
	public function up()
	{
		$this->createTable('user', [
			'id' => 'pk',
			'login' => 'varchar(100) NOT NULL',
			'password_hash' => 'varchar(255) NOT NULL',
		]);

		$this->createIndex('ux_user_login', 'user', 'login', true);
	}

	public function down()
	{
		$this->dropTable('user');
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