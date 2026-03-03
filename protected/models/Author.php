<?php

class Author extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'author';
    }

    public function rules()
    {
        return [
            ['full_name', 'required'],
            ['full_name', 'length', 'max' => 255],
            ['id, full_name', 'safe', 'on' => 'search'],
        ];
    }

    public function relations()
    {
        return [
            'books' => [self::MANY_MANY, 'Book', 'book_author(author_id, book_id)'],
            'subscriptions' => [self::HAS_MANY, 'AuthorSubscription', 'author_id'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'ФИО',
        ];
    }

    public function search()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('full_name', $this->full_name, true);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }
}