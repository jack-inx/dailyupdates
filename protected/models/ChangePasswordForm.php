<?php

class ChangePasswordForm extends CFormModel {

    public $OldPassword;
    public $NewPassword;
    public $PasswordRepeat;
    public $Salt;
    public $UserId;

    public function rules() {

        //$message ="<span class='ui-icon ui-icon-alert'></span><span class='app'>". Yii::t('app','{attribute} cannot be blank.')."</span>";
        return array(
            //OldPassword
            array('NewPassword,PasswordRepeat', 'required'),
            array('PasswordRepeat', 'compare', 'compareAttribute' => 'NewPassword'),
        );
    }

    public function attributeLabels() {
        return array(
            'OldPassword' => Yii::t('app', 'Old  Password'),
            'NewPassword' => Yii::t('app', 'New Password'),
            'PasswordRepeat' => Yii::t('app', 'Repeat New Password'),
        );
    }

}

