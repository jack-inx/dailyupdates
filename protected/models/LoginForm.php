<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel {

    public $Email;
    public $Password;
    public $RememberMe;
    private $_Identity;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            // username and password are required
            array('Email, Password', 'required'),
            // rememberMe needs to be a boolean
            array('RememberMe', 'boolean'),
            // password needs to be authenticated
            array('Password', 'authenticate'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'RememberMe' => 'Remember me next time',
        );
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute, $params) {
        $this->_Identity = new UserIdentity($this->Email, $this->Password);
        if (!$this->_Identity->authenticate())
            $this->addError('Password', 'Incorrect Email or Password.');
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login() {
        if ($this->_Identity === null) {
            $this->_Identity = new UserIdentity($this->Email, $this->Password);
            $this->_Identity->authenticate();
        }
        if ($this->_Identity->errorCode === UserIdentity::ERROR_NONE) {
            $duration = $this->RememberMe ? 3600 * 24 * 30 : 0; // 30 days
            Yii::app()->user->login($this->_Identity, $duration);
            return true;
        }
        else
            return false;
    }

}
