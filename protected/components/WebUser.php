<?php

class WebUser extends CWebUser
{
    public function checkAccess($operation, $params = [])
    {
        if ($this->isGuest) {
            return Yii::app()->authManager->checkAccess($operation, 'guest');
        }

        return Yii::app()->authManager->checkAccess($operation, 'user');
    }
}