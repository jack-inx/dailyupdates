<?php

/**
 * This is the model class for table "UserPreference".
 *
 * The followings are the available columns in table 'UserPreference':
 * @property integer $UserPreferenceId
 * @property integer $UserId
 * @property integer $NewsCategoryId
 * @property integer $NewsSubCategoryId
 */
class UserPreference extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserPreference the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'UserPreference';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserId, NewsCategoryId, NewsSubCategoryId', 'required'),
			array('UserId, NewsCategoryId, NewsSubCategoryId', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('UserPreferenceId, UserId, NewsCategoryId, NewsSubCategoryId', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'UserPreferenceId' => 'User Preference',
			'UserId' => 'User',
			'NewsCategoryId' => 'News Category',
			'NewsSubCategoryId' => 'News Sub Category',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('UserPreferenceId',$this->UserPreferenceId);
		$criteria->compare('UserId',$this->UserId);
		$criteria->compare('NewsCategoryId',$this->NewsCategoryId);
		$criteria->compare('NewsSubCategoryId',$this->NewsSubCategoryId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}