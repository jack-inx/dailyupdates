<?php

/**
 * This is the model class for table "NewsArticle".
 *
 * The followings are the available columns in table 'NewsArticle':
 * @property integer $NewsArticleId
 * @property string $NewsArticleTitle
 * @property integer $NewsCategoryId
 * @property integer $NewsSubCategoryId
 * @property integer $NewsArticleSourceId
 * @property string $NewsArticleImage
 * @property string $NewsArticleLink
 * @property string $NewsDescription
 * @property string $NewsPublishDate
 * @property string $InsertedDate
 * @property string $UpdatedDate
 * @property string $Status
 */
class NewsArticle extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return NewsArticle the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'NewsArticle';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            //,NewsCategoryId, NewsSubCategoryId, InsertedDate, UpdatedDate
            array('NewsArticleTitle, NewsArticleSourceId, NewsArticleImage, NewsArticleLink, NewsDescription, NewsPublishDate', 'required'),
            array('NewsCategoryId, NewsSubCategoryId, NewsArticleSourceId', 'numerical', 'integerOnly' => true),
            array('NewsArticleTitle, NewsArticleImage, NewsArticleLink', 'length', 'max' => 255),
            array('Status', 'length', 'max' => 8),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('NewsArticleId, NewsArticleTitle, NewsCategoryId, NewsSubCategoryId, NewsArticleSourceId, NewsArticleImage, NewsArticleLink, NewsDescription, NewsPublishDate, InsertedDate, UpdatedDate, Status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'NewsArticleId' => 'News Article',
            'NewsArticleTitle' => 'News Article Title',
            'NewsCategoryId' => 'News Category',
            'NewsSubCategoryId' => 'News Sub Category',
            'NewsArticleSourceId' => 'News Article Source',
            'NewsArticleImage' => 'News Article Image',
            'NewsArticleLink' => 'News Article Link',
            'NewsDescription' => 'News Description',
            'NewsPublishDate' => 'News Publish Date',
            'InsertedDate' => 'Inserted Date',
            'UpdatedDate' => 'Updated Date',
            'Status' => 'Status',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('NewsArticleId', $this->NewsArticleId);
        $criteria->compare('NewsArticleTitle', $this->NewsArticleTitle, true);
        $criteria->compare('NewsCategoryId', $this->NewsCategoryId);
        $criteria->compare('NewsSubCategoryId', $this->NewsSubCategoryId);
        $criteria->compare('NewsArticleSourceId', $this->NewsArticleSourceId);
        $criteria->compare('NewsArticleImage', $this->NewsArticleImage, true);
        $criteria->compare('NewsArticleLink', $this->NewsArticleLink, true);
        $criteria->compare('NewsDescription', $this->NewsDescription, true);
        $criteria->compare('NewsPublishDate', $this->NewsPublishDate, true);
        $criteria->compare('InsertedDate', $this->InsertedDate, true);
        $criteria->compare('UpdatedDate', $this->UpdatedDate, true);
        $criteria->compare('Status', $this->Status, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    /**
     * Created By : Inheritx
     * Created Date : 09 August 2013
     * Description : Delete all news article
     */
    public function removeSelectedArticle($anArticleIds) {
        $bDeleted = NewsArticle::model()->deleteAll('NewsArticleId = "' . @implode(',', $anArticleIds) . '" ');
        return $bDeleted;
    }

    /**
     * Created By : Inheritx
     * Created Date : 09 August 2013
     * Description : Change status to active/inactive of all news article
     */
    public function changeStatusSelectedArticle($anStatusIds, $anStatusType = 'Active') {
        $connection = Yii::app()->db;
        $snArticleId = @implode(',', $anStatusIds);
        $sql = 'UPDATE NewsArticle SET Status ="' . $anStatusType . '" WHERE NewsArticleId IN (' . $snArticleId . ')';
        $command = $connection->createCommand($sql);
        //p($command);
        $command->execute();
        return true;
    }

}