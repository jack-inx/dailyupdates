<?php

/**
 * Created By : Inheritx
 * Created Date : 02 August 2013
 * Description : This is the model class for table "NewsSubCategory".
 * The followings are the available columns in table 'NewsSubCategory':
 * @property integer $NewsSubCategoryId
 * @property integer $NewsCategoryId
 * @property string $NewsSubCategoryName
 * @property string $InsertedDate
 * @property string $UpdatedDate
 * @property string $Status
 */
class NewsSubCategory extends CActiveRecord {

    /**
     * Created By : Inheritx
     * Created Date : 02 August 2013
     * Description : Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return NewsSubCategory the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * Created By : Inheritx
     * Created Date : 02 August 2013
     * Description : @return string the associated database table name
     */
    public function tableName() {
        return 'NewsSubCategory';
    }

    /**
     * Created By : Inheritx
     * Created Date : 02 August 2013
     * Description : @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            //InsertedDate, UpdatedDate
            array('NewsCategoryId, NewsSubCategoryName', 'required'),
            array('NewsCategoryId', 'numerical', 'integerOnly' => true),
            array('NewsSubCategoryName', 'length', 'max' => 255),
            array('Status', 'length', 'max' => 8),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            //UpdatedDate,
            array('NewsSubCategoryId, NewsCategoryId, NewsSubCategoryName, InsertedDate, Status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * Created By : Inheritx
     * Created Date : 02 August 2013
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
     * Created Date : 02 August 2013
     * Description : @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'NewsSubCategoryId' => 'News Sub Category',
            'NewsCategoryId' => 'News Category',
            'NewsSubCategoryName' => 'News Sub Category Name',
            'InsertedDate' => 'Inserted Date',
            'UpdatedDate' => 'Updated Date',
            'Status' => 'Status',
        );
    }

    /**
     * Created By : Inheritx
     * Created Date : 02 August 2013
     * Description : Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('NewsSubCategoryId', $this->NewsSubCategoryId);
        $criteria->compare('NewsCategoryId', $this->NewsCategoryId);
        $criteria->compare('NewsSubCategoryName', $this->NewsSubCategoryName, true);
        $criteria->compare('InsertedDate', $this->InsertedDate, true);
        $criteria->compare('UpdatedDate', $this->UpdatedDate, true);
        $criteria->compare('Status', $this->Status, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    /**
     * Created By : Inheritx
     * Created Date : 07 August 2013
     * Description : Show News Sub Categories
     */
    public function showNewsSubCategory($id) {
        $saNewSubCategoryDetails = NewsSubCategory::model()->find(' NewsSubCategoryId = "' . $id . '" ');
        $ssNewSubCategoryName = '---';
        if (isset($saNewSubCategoryDetails) && !empty($saNewSubCategoryDetails)) {
            $ssNewSubCategoryName = $saNewSubCategoryDetails->NewsSubCategoryName;
        }
        return $ssNewSubCategoryName;
    }
    
    /**
     * Created By : Inheritx
     * Created Date : 02 August 2013
     * Description : @returns: News Category listing
     */
    public function getNewsCategoryListing() {
        $saNewsCategoryData = NewsCategory::model()->findAll('Status="Active" ORDER BY NewsCategoryName ASC');

        $saNCL = array('' => '--Select--');
        if (isset($saNewsCategoryData) && count($saNewsCategoryData) > 0) {
            foreach ($saNewsCategoryData AS $saNewsCategory) {
                $saNCL[$saNewsCategory->NewsCategoryId] = $saNewsCategory->NewsCategoryName;
            }
        }
        return $saNCL;
    }
    
    
    /**
     * Created By : Inheritx
     * Created Date : 09 August 2013
     * Description : Delete all sub category
     */
    public function removeSelectedSubCategories($anSubCategoryIds) {
        $bDeleted = NewsSubCategory::model()->deleteAll('NewsSubCategoryId = "' . @implode(',',$anSubCategoryIds) . '" ');
        return $bDeleted;
    }

    /**
     * Created By : Inheritx
     * Created Date : 09 August 2013
     * Description : Change status to active/inactive of all sub category
     */
    public function changeStatusSelectedSubCategories($anStatusIds, $anStatusType = 'Active') {
        $connection = Yii::app()->db;
        $snNewsSubCategoryId = @implode(',',$anStatusIds);
        $sql = 'UPDATE NewsSubCategory SET Status ="'.$anStatusType.'" WHERE NewsSubCategoryId IN ('.$snNewsSubCategoryId.')';
        $command = $connection->createCommand($sql);
        //p($command);
        $command->execute();
        return true;
    }

}