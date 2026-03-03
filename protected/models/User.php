<?php

class User extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            ['login, password_hash', 'required'],
            ['login', 'length', 'max' => 100],
            ['password_hash', 'length', 'max' => 255],
            ['id, login', 'safe', 'on' => 'search'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Логин',
            'password_hash' => 'Пароль',
        ];
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('login', $this->login, true);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }
}