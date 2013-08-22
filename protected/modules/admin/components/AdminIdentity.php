<?php

/**
 * CustomerIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class AdminIdentity extends UserIdentity
{
    private $_Id;
    const ERROR_NONE=0;
    const ERROR_EMAIL_INVALID=3;
    const ERROR_STATUS_NOTACTIV=4;
    const ERROR_STATUS_BAN=5;
    const ERROR_PASSWORD_INVALID=6;
    /**
     * Authenticates a user.
     * The example implementation makes sure if the email and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public $Email;

    public function __construct($UserName,$Password)
    {
        //p($this);
        $this->username=$UserName;
        $this->Email=$UserName;
        $this->password=$Password;
    }

    public function authenticate()
    {		 
        $email = $this->Email;
        $criteria = new CDbCriteria();

        $criteria->select = "t.*, CONCAT_WS(' ', t.`FirstName`, t.`LastName`) AS `FullName`";
        //$criteria->condition  = ' t.user_type = IN(\'admin\',\'user\') AND(t.username = \''.$this->username.'\' OR  t.`email` = \''.$email.'\')';
        //$criteria->condition  = ' t.user_type IN(\'admin\',\'user\') AND(t.username = \''.$this->username.'\' OR  t.`email` = \''.$email.'\')';
        $criteria->condition  = ' t.UserType IN(\'admin\', \'User\') AND(t.`Email` = \''.$email.'\') ';
        $admin = User::model()->find($criteria);

        //p($admin);
        //$admin=admin::model()->findByAttributes(array('email'=>$email),$criteria);

        /*
        print Yii::app()->getModule('admin')->encrypting($this->password); 
        print "<BR>";
        print $admin->password;
        die;
        */
        if($admin===null) {
            $this->errorCode=self::ERROR_EMAIL_INVALID;
        } else if(Yii::app()->getModule('admin')->encrypting($this->password)!==$admin->Password) {
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        //} else if($admin->status==0&&Yii::app()->getModule('admin')->loginNotActive==false) {
            //$this->errorCode=self::ERROR_STATUS_NOTACTIV;
        } else if($admin->Status=='Banned') {
            $this->errorCode=self::ERROR_STATUS_BAN;
        } else {
            $this->_Id		= $admin->UserId;
            $this->Email	= $admin->Email;
            $this->username	= $admin->UserName;
            $this->errorCode= self::ERROR_NONE;
            Yii::app()->admin->setId($this->_Id);
            Yii::app()->admin->guestName = $admin->UserName;
            Yii::app()->admin->Name = strtolower($admin->UserType);

            Yii::app()->admin->fullname = $admin->FirstName.' '.$admin->LastName;

            $adminData = $admin->attributes;
            $adminData['FullName'] = $admin->FirstName.' '.$admin->LastName;
            Yii::app()->admin->setState('admin',$adminData);
        }

        return !$this->errorCode;
    }

    /**
     * @return integer the ID of the user record
     */
    public function getId()
    {
        return $this->_Id;
    }
}