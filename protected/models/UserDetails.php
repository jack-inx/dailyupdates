<?php

/**
 * This is the model class for table "UserDetails".
 *
 * The followings are the available columns in table 'UserDetails':
 * @property integer $UserDetailsId
 * @property integer $UserId
 * @property string $City
 * @property string $EducationLevel
 * @property string $AnnualIncome
 * @property string $EmploymentField
 * @property string $LanguageOne
 * @property string $LanguageTwo
 */
class UserDetails extends CActiveRecord {

    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
     * Description : @param string $className active record class name.
     * @return UserDetails the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
     * Description : @return string the associated database table name
     */
    /**
     * 
     */
    public function tableName() {
        return 'UserDetails';
    }

    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
     * Description : @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        //EducationLevel, AnnualIncome, EmploymentField, LanguageOne, LanguageTwo
        return array(
            array('UserId', 'required'),
            array('UserId', 'numerical', 'integerOnly' => true),
            array('EducationLevel', 'length', 'max' => 50),
            array('City, AnnualIncome, EmploymentField', 'length', 'max' => 255),
            array('LanguageOne, LanguageTwo', 'length', 'max' => 10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('UserDetailsId, UserId, City, EducationLevel, AnnualIncome, EmploymentField, LanguageOne, LanguageTwo', 'safe', 'on' => 'search'),
        );
    }

    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
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
     * Created Date : 29 July 2013
     * Description : @return array customized attribute labels (name=>label)
     */    
    public function attributeLabels() {
        return array(
            'UserDetailsId' => 'User Details',
            'UserId' => 'User',
            'City' => 'City',
            'EducationLevel' => 'Education Level',
            'AnnualIncome' => 'Annual Income',
            'EmploymentField' => 'Employment Field',
            'LanguageOne' => 'Language One',
            'LanguageTwo' => 'Language Two',
        );
    }

    
    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
     * Description : Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('UserDetailsId', $this->UserDetailsId);
        $criteria->compare('UserId', $this->UserId);
        $criteria->compare('City', $this->City);
        $criteria->compare('EducationLevel', $this->EducationLevel, true);
        $criteria->compare('AnnualIncome', $this->AnnualIncome, true);
        $criteria->compare('EmploymentField', $this->EmploymentField, true);
        $criteria->compare('LanguageOne', $this->LanguageOne, true);
        $criteria->compare('LanguageTwo', $this->LanguageTwo, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
     * Description : @returns: City details
     */
    public function getshowEducationLevel() {
        $ssEducationLevel = $this->EducationLevel;
        if ($ssEducationLevel == '') {
            $ssEducationalLevel = ' -- ';
        } else {
            $ssEducationalLevel = $ssEducationLevel;
        }
        return $ssEducationalLevel;
    }

    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
     * Description : @returns: Annual Income details
     */
    public function getshowAnnualIncome() {
        $ssAnnualIncome = $this->AnnualIncome;
        if ($ssAnnualIncome == '') {
            $ssAnnualIncomeData = ' -- ';
        } else {
            $ssAnnualIncomeData = $ssAnnualIncome;
        }
        return $ssAnnualIncomeData;
    }

    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
     * Description : @returns: Employment Field details
     */
    public function getshowEmploymentField() {
        $ssEmploymentField = $this->EmploymentField;
        if ($ssEmploymentField == '') {
            $ssEmploymentFieldData = ' -- ';
        } else {
            $ssEmploymentFieldData = $ssEmploymentField;
        }
        return $ssEmploymentFieldData;
    }

    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
     * Description : @returns: Language One details
     */
    public function getshowLanguageOne() {
        $ssLanguageOne = $this->LanguageOne;
        if ($ssLanguageOne == '') {
            $ssLanguageOneData = ' -- ';
        } else {
            $ssLanguageOneData = $ssLanguageOne;
        }
        return $ssLanguageOneData;
    }

    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
     * Description : @returns: Language Two details
     */
    public function getshowLanguageTwo() {
        $ssLanguageTwo = $this->LanguageTwo;
        if ($ssLanguageTwo == '') {
            $ssLanguageTwoData = ' -- ';
        } else {
            $ssLanguageTwoData = $ssLanguageTwo;
        }
        return $ssLanguageTwoData;
    }

}