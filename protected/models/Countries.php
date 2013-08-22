<?php

/**
 * This is the model class for table "Countries".
 *
 * The followings are the available columns in table 'Countries':
 * @property integer $CountryId
 * @property string $CountryName
 * @property string $ShortCountry
 */
class Countries extends CActiveRecord {

    /**
     * Created By : Inheritx
     * Created Date : 26 July 2013
     * Description : Returns the static model of the specified AR class.
     *               @param string $className active record class name.
     *               @return Countries the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * Created By : Inheritx
     * Created Date : 26 July 2013
     * Description : @return string the associated database table name
     */
    public function tableName() {
        return 'Countries';
    }

    /**
     * Created By : Inheritx
     * Created Date : 26 July 2013
     * Description : @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('CountryId', 'numerical', 'integerOnly' => true),
            array('CountryName', 'length', 'max' => 40),
            array('ShortCountry', 'length', 'max' => 30),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('CountryId, CountryName, ShortCountry', 'safe', 'on' => 'search'),
        );
    }

    /**
     * Created By : Inheritx
     * Created Date : 26 July 2013
     * Description : @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * Created By : Inheritx
     * Created Date : 26 July 2013
     * Description : @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'CountryId' => 'Country',
            'CountryName' => 'Country Name',
            'ShortCountry' => 'Short Country',
        );
    }

    /**
     * Created By : Inheritx
     * Created Date : 26 July 2013
     * Description : Retrieves a list of models based on the current search/filter conditions.
     *               @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('CountryId', $this->CountryId);
        $criteria->compare('CountryName', $this->CountryName, true);
        $criteria->compare('ShortCountry', $this->ShortCountry, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    /**
     * Created By : Inheritx
     * Created Date : 26 July 2013
     * Description : @returns: Country listing from country table
     */
    public function getCountryListing() {
        $saCountryData = Countries::model()->findAll('');
        //p($saCountryData[0]->attributes);
        $saCountry = array('' => '--Select--');
        if (isset($saCountryData) && count($saCountryData) > 0) {
            foreach ($saCountryData AS $saCntry) {
                $saCountry[$saCntry->CountryId] = $saCntry->CountryName;
            }
        }
        return $saCountry;
    }

}