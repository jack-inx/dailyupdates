<?php

/**
 * This is the model class for table "Cities".
 *
 * The followings are the available columns in table 'Cities':
 * @property integer $CityID
 * @property string $CityName
 * @property string $ShortCity
 * @property integer $StateID
 * @property integer $CountryID
 */
class Cities extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cities the static model class
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
		return 'Cities';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CityID, StateID, CountryID', 'numerical', 'integerOnly'=>true),
			array('CityName', 'length', 'max'=>70),
			array('ShortCity', 'length', 'max'=>60),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CityID, CityName, ShortCity, StateID, CountryID', 'safe', 'on'=>'search'),
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
			'CityID' => 'City',
			'CityName' => 'City Name',
			'ShortCity' => 'Short City',
			'StateID' => 'State',
			'CountryID' => 'Country',
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

		$criteria->compare('CityID',$this->CityID);
		$criteria->compare('CityName',$this->CityName,true);
		$criteria->compare('ShortCity',$this->ShortCity,true);
		$criteria->compare('StateID',$this->StateID);
		$criteria->compare('CountryID',$this->CountryID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}