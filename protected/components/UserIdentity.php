<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    private $_id;
    public $Email;
    public $Password;

    public function __construct($Email, $Password) {
        $this->Email = $Email;
        $this->Password = $Password;
    }

    /**
     * Authenticates a user.
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        $user = User::model()->find('Email=?', array($this->Email));
        
        if ($user === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if (Common::encrypting($this->Password) != $user->Password)
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else {
            $this->_id = $user->UserId;
            $this->Email = $user->Email;
            $this->errorCode = self::ERROR_NONE;
            Yii::app()->user->guestName = $user->UserName;
            Yii::app()->user->setState('user', $user->attributes);
        }
        return $this->errorCode == self::ERROR_NONE;
    }

    /**
     * @return integer the ID of the user record
     */
    public function getId() {
        return $this->_id;
    }

}