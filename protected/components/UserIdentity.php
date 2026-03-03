<?php

class UserIdentity extends CUserIdentity
{
    private $_id;

    public function authenticate()
    {
        $user = User::model()->findByAttributes([
            'login' => $this->username,
        ]);

        if ($user === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
            return false;
        }

        if (!password_verify($this->password, $user->password_hash)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
            return false;
        }

        $this->_id = $user->id;
        $this->setState('role', 'user');

        $this->errorCode = self::ERROR_NONE;
        return true;
    }

    public function getId()
    {
        return $this->_id;
    }
}