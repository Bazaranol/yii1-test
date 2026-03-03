<?php

class m260303_223234_create_book_author extends CDbMigration
{
	public function up()
	{
		$this->createTable('book_author', [
			'book_id' => 'int NOT NULL',
			'author_id' => 'int NOT NULL',
			'PRIMARY KEY(book_id, author_id)',
		]);

		$this->addForeignKey(
			'fk_book_author_book',
			'book_author',
			'book_id',
			'book',
			'id',
			'CASCADE',
			'CASCADE'
		);

		$this->addForeignKey(
			'fk_book_author_author',
			'book_author',
			'author_id',
			'author',
			'id',
			'CASCADE',
			'CASCADE'
		);
	}

	public function down()
	{
		$this->dropTable('book_author');
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