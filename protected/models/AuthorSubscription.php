<?php

class AuthorSubscription extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'author_subscription';
    }

    public function rules()
    {
        return [
            ['author_id, phone', 'required'],
            ['author_id', 'numerical', 'integerOnly' => true],
            ['phone', 'length', 'max' => 32],
            ['created_at', 'safe'],
            ['id, author_id, phone', 'safe', 'on' => 'search'],
        ];
    }

    public function relations()
    {
        return [
            'author' => [self::BELONGS_TO, 'Author', 'author_id'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Автор',
            'phone' => 'Телефон',
            'created_at' => 'Дата подписки',
        ];
    }

    public function beforeSave()
    {
        if ($this->isNewRecord && empty($this->created_at)) {
            $this->created_at = new CDbExpression('NOW()');
        }

        return parent::beforeSave();
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('author_id', $this->author_id);
        $criteria->compare('phone', $this->phone, true);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }
}