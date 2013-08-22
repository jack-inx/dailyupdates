<?php

/**
 * This is the model base class for the table "user".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "User".
 *
 * Columns in table "user" available as properties of the model,
 * and there are no model relations.
 *
 * @property string $id
 * @property string $user_type
 * @property string $display_name
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $email_privacy
 * @property string $email_privacy_id
 * @property string $password
 * @property string $website
 * @property string $website_privacy
 * @property string $website_privacy_id
 * @property string $image
 * @property string $photo_by
 * @property string $gender
 * @property string $gender_privacy
 * @property string $gender_privacy_id
 * @property string $birthdate
 * @property string $birthdate_privacy
 * @property string $birthdate_privacy_id
 * @property string $phone
 * @property string $phone_privacy
 * @property string $phone_privacy_id
 * @property string $hometown
 * @property string $hometown_privacy
 * @property string $hometown_privacy_id
 * @property string $city
 * @property string $city_privacy
 * @property string $city_privacy_id
 * @property string $my_story
 * @property string $my_story_privacy
 * @property string $my_story_privacy_id
 * @property string $i_am
 * @property string $i_am_other
 * @property string $g_name
 * @property string $g_name_privacy
 * @property string $g_name_privacy_id
 * @property string $g_email
 * @property string $g_email_privacy
 * @property string $g_email_privacy_id
 * @property string $g_phone
 * @property string $g_phone_privacy
 * @property string $g_phone_privacy_id
 * @property string $union_status
 * @property string $union_privacy
 * @property string $union_privacy_id
 * @property string $union_membership
 * @property string $union_membership_privacy
 * @property string $union_membership_privacy_id
 * @property string $is_agency
 * @property string $show_reel
 * @property string $show_reel_privacy
 * @property string $show_reel_privacy_id
 * @property string $show_gear
 * @property string $show_gear_privacy
 * @property string $show_gear_privacy_id
 * @property string $my_gear
 * @property string $my_gear_privacy
 * @property string $my_gear_privacy_id
 * @property string $show_gallery
 * @property string $show_gallery_privacy
 * @property string $show_gallery_privacy_id
 * @property integer $wizard_step
 * @property integer $send_email_updates
 * @property integer $agree_terms
 * @property string $id_register_hear_aboutus
 * @property string $id_register_identify_question
 * @property string $created_at
 * @property string $updated_at
 * @property string $logdate
 * @property string $lognum
 * @property string $is_active
 * @property string $user_roles
 * @property string $extra
 * @property string $activation
 *
 */
abstract class BaseCustomer extends GxActiveRecord {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'User';
    }

    public static function label($n = 1) {
        return Yii::t('app', 'User|Users', $n);
    }

    public static function representingColumn() {
        return 'UserType';
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

    public function relations() {
        return array(
            'userOtherDetails' => array(self::HAS_MANY, 'UserOtherDetails', 'UserId'),
        );
    }

    public function pivotModels() {
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'UserId' => Yii::t('app', 'User'),
            'UserType' => Yii::t('app', 'User Type'),
            'FirstName' => Yii::t('app', 'First Name'),
            'LastName' => Yii::t('app', 'Last Name'),
            'UserName' => Yii::t('app', 'User Name'),
            'Email' => Yii::t('app', 'Email'),
            'Password' => Yii::t('app', 'Password'),
            'Gender' => Yii::t('app', 'Gender'),
            'BirthDate' => Yii::t('app', 'Birth Date'),
            'CityId' => Yii::t('app', 'City'),
            'StateId' => Yii::t('app', 'State'),
            'CountryId' => Yii::t('app', 'Country'),
            'AccountVerified' => Yii::t('app', 'Account Verified'),
            'InsertedDate' => Yii::t('app', 'Inserted Date'),
            'UpdatedDate' => Yii::t('app', 'Updated Date'),
            'Status' => Yii::t('app', 'Status'),
            'userOtherDetails' => null,
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

}