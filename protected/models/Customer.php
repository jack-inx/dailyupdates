<?php

Yii::import('application.models._base.BaseCustomer');

class Customer extends BaseCustomer {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function rules() {
        return array(
            array('FirstName, LastName, UserName, Email, Password, BirthDate, CityId, StateId, CountryId, InsertedDate, UpdatedDate, Status', 'required'),
            array('CityId, StateId, CountryId', 'numerical', 'integerOnly' => true),
            array('UserType', 'length', 'max' => 10),
            array('FirstName, LastName', 'length', 'max' => 50),
            array('UserName, Email', 'length', 'max' => 100),
            array('Password', 'length', 'max' => 255),
            array('Gender', 'length', 'max' => 6),
            array('AccountVerified', 'length', 'max' => 3),
            array('Status', 'length', 'max' => 8),
            array('UserType, Gender, AccountVerified', 'default', 'setOnEmpty' => true, 'value' => null),
            array('UserId, UserType, FirstName, LastName, UserName, Email, Password, Gender, BirthDate, CityId, StateId, CountryId, AccountVerified, InsertedDate, UpdatedDate, Status', 'safe', 'on' => 'search'),
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('UserId', $this->UserId);
        $criteria->compare('UserType', $this->UserType, true);
        $criteria->compare('FirstName', $this->FirstName, true);
        $criteria->compare('LastName', $this->LastName, true);
        $criteria->compare('UserName', $this->UserName, true);
        $criteria->compare('Email', $this->Email, true);
        $criteria->compare('Password', $this->Password, true);
        $criteria->compare('Gender', $this->Gender, true);
        $criteria->compare('BirthDate', $this->BirthDate, true);
        $criteria->compare('CityId', $this->CityId);
        $criteria->compare('StateId', $this->StateId);
        $criteria->compare('CountryId', $this->CountryId);
        $criteria->compare('AccountVerified', $this->AccountVerified, true);
        $criteria->compare('InsertedDate', $this->InsertedDate, true);
        $criteria->compare('UpdatedDate', $this->UpdatedDate, true);
        $criteria->compare('Status', $this->Status, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function getCustomers() {
        $resultset = Customer::model()->findAll("Status='Active'");
        $customerArr = array();
        foreach ($resultset as $key => $row) {
            $data = $row->attributes;
            $customerArr[$data['id']] = $data;
        }
        return $customerArr;
    }

    public function beforeSave() {
        if ($this->isNewRecord)
            $this->created_date = new CDbExpression('NOW()');

        $this->updated_date = new CDbExpression('NOW()');

        return parent::beforeSave();
    }

    public function getActiveCustomer() {
        $session = new CHttpSession;
        $session->open();
        if (!empty($session)) {
            $currentCustomer = $session['signup'];
        }
        if ($currentCustomer) {
            $userObj = Customer::model()->find("UserId='$currentCustomer'");
            if (isset($userObj->attributes)) {
                return $userObj->attributes;
            }
        }
    }

    public function getCustomerOnField($field, $value) {
        $resultset = Customer::model()->findAll($field = $value);
        $customerArr = array();
        foreach ($resultset as $key => $row) {
            $data = $row->attributes;
            $customerArr[$data['id']] = $data;
        }
        return $customerArr;
    }

    public function accountConfirmStatus($credential) {
        if (!empty($credential)) {
            //$userObj=Customer::model()->find("email='$credential' or fullname='$credential'");
            $safe_string_credential = $this->quote_smart($credential);
            $userObj = Customer::model()->find("t.email=$safe_string_credential");
            $userObj1 = Customer::model()->find("t.username=$safe_string_credential");
            $flag = 0;
            if (isset($userObj->attributes)) {
                $flag = 1;
            } else if (isset($userObj1->attributes)) {
                $flag = 1;
                $userObj = $userObj1;
            }

            if ($flag == 1) {
                //if(($userObj->is_active==1)&& ($userObj->account_confirmed=='Confirmed')){
                if ($userObj->is_active == 1) {
                    return 1; // successfully login
                } else {
                    return 2; //activation not done
                }
            } else {
                return 3; //Invalid username/email address or password.
            }
        }
    }

    // Quote variable to make safe
    public function quote_smart($value) {
        // Stripslashes
        if (get_magic_quotes_gpc()) {
            $value = stripslashes($value);
        }
        // Quote if not a number or a numeric string
        if (!is_numeric($value)) {
            $value = "'" . mysql_real_escape_string($value) . "'";
        }
        return $value;
    }

    public function accountSignupConfirmStatus($credential) {
        if (!empty($credential)) {
            //$userObj=Customer::model()->find("email='$credential' or fullname='$credential'");
            $userObj = Customer::model()->find("email='$credential'");
            if (isset($userObj->attributes)) {
                if (($userObj->is_active == 1) && ($userObj->activation != '')) {
                    return 1;
                } else {
                    return 2;
                }
            } else {
                return 3;
            }
        }
    }

    public function encodeConfirmationLink($value) {
        $key = md5($value);
        $encodeURL = $_SERVER["HTTP_HOST"] . Yii::app()->baseUrl . "/index.php/index/confirmaccount/key/$key";
        return $encodeURL;
    }

}

