<?php

class Book extends CActiveRecord
{
    public $coverFile;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'book';
    }

    public function rules()
    {
        return [
            ['title, year', 'required'],
            ['year', 'numerical', 'integerOnly' => true],
            ['title, isbn, cover', 'length', 'max' => 255],
            ['description', 'safe'],
            ['coverFile', 'file', 'types' => 'jpg,png', 'allowEmpty' => true],
            ['id, title, year', 'safe', 'on' => 'search'],
        ];
    }

    public function relations()
    {
        return [
            'authors' => [self::MANY_MANY, 'Author', 'book_author(book_id, author_id)'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'year' => 'Год выпуска',
            'description' => 'Описание',
            'isbn' => 'ISBN',
            'cover' => 'Обложка',
        ];
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('year', $this->year);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }
}