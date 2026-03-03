<?php

class m260303_223253_create_author_subscription extends CDbMigration
{
	public function up()
	{
		$this->createTable('author_subscription', [
			'id' => 'pk',
			'author_id' => 'int NOT NULL',
			'phone' => 'varchar(32) NOT NULL',
			'created_at' => 'datetime NOT NULL',
		]);

		$this->addForeignKey(
			'fk_subscription_author',
			'author_subscription',
			'author_id',
			'author',
			'id',
			'CASCADE',
			'CASCADE'
		);
	}

	public function down()
	{
		$this->dropTable('author_subscription');
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