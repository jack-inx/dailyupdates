<?php

/**
 * Created By : Inheritx
 * Created Date : 02 August 2013
 * Description : This is the model class for table "NewsCategory".
 * The followings are the available columns in table 'NewsCategory':
 * @property integer $NewsCategoryId
 * @property string $NewsCategoryName
 * @property string $InsertedDate
 * @property string $UpdatedDate
 * @property string $Status
 */
class NewsCategory extends CActiveRecord {

    /**
     * Created By : Inheritx
     * Created Date : 02 August 2013
     * Description : Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return NewsCategory the static model class
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
        return 'NewsCategory';
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
            //UpdatedDate
            array('NewsCategoryName, InsertedDate', 'required'),
            array('NewsCategoryName', 'length', 'max' => 255),
            array('Status', 'length', 'max' => 8),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            //UpdatedDate,
            array('NewsCategoryId, NewsCategoryName, InsertedDate, Status', 'safe', 'on' => 'search'),
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
            'NewsCategoryId' => 'News Category',
            'NewsCategoryName' => 'News Category Name',
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

        $criteria->compare('NewsCategoryId', $this->NewsCategoryId);
        $criteria->compare('NewsCategoryName', $this->NewsCategoryName, true);
        $criteria->compare('InsertedDate', $this->InsertedDate, true);
        $criteria->compare('UpdatedDate', $this->UpdatedDate, true);
        $criteria->compare('Status', $this->Status, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    /**
     * Created By : Inheritx
     * Created Date : 02 August 2013
     * Description : Show News Categories
     */
    public function showNewCategory($id) {
        $saNewCategoryDetails = NewsCategory::model()->find(' NewsCategoryId = "' . $id . '" ');
        $ssNewCategoryName = '---';
        if (isset($saNewCategoryDetails) && !empty($saNewCategoryDetails)) {
            $ssNewCategoryName = $saNewCategoryDetails->NewsCategoryName;
        }
        return $ssNewCategoryName;
    }

    /**
     * Created By : Inheritx
     * Created Date : 06 August 2013
     * Description : Get news category listing
     */
    public function getCategoryListing() {
        $saNewCategoryDetails = NewsCategory::model()->findAll(' Status= "Active" ');
        $ssNewCategoryName = array();
        $ssNewCategoryName[''] = '--Select--';
        if (isset($saNewCategoryDetails) && !empty($saNewCategoryDetails)) {
            foreach ($saNewCategoryDetails AS $saNewCat) {
                $ssNewCategoryName[$saNewCat->NewsCategoryId] = $saNewCat->NewsCategoryName;
            }
        }
        $ssNewCategoryName['Other'] = 'Other';
        return $ssNewCategoryName;
    }
    
    /**
     * Created By : Inheritx
     * Created Date : 09 August 2013
     * Description : Delete all categories
     */
    public function removeSelectedCategories($anCategoryIds) {
        $bDeleted = 0;
        if(count($anCategoryIds) > 0)
        {
            foreach($anCategoryIds AS $saKey => $snValue)
            {
                $saCategoryArr = NewsSubCategory::model()->findAll('NewsCategoryId = "'.$snValue.'"');
                if(count($saCategoryArr) == 0)
                {
                    $bDeleted = NewsCategory::model()->deleteAll('NewsCategoryId = "' . $snValue . '" ');
                }
            }
        }
        return $bDeleted;
    }

    /**
     * Created By : Inheritx
     * Created Date : 09 August 2013
     * Description : Change status to active/inactive of all categories
     */
    public function changeStatusSelectedCategories($anStatusIds, $anStatusType = 'Active') {
        $connection = Yii::app()->db;
        $snNewsCategoryId = @implode(',',$anStatusIds);
        $sql = 'UPDATE NewsCategory SET Status ="'.$anStatusType.'" WHERE NewsCategoryId IN ('.$snNewsCategoryId.')';
        $command = $connection->createCommand($sql);
        //p($command);
        $command->execute();
        return true;
    }

}