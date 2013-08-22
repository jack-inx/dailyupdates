<?php

/**
 * This is the model class for table "NewsArticleSource".
 *
 * The followings are the available columns in table 'NewsArticleSource':
 * @property integer $NewsArticleSourceId
 * @property string $NewsArticleSourceTitle
 * @property string $NewsArticleSourceUrl
 * @property string $NewsArticleUpdatedDuration
 * @property string $InsertedDate
 * @property integer $UpdatedDate
 * @property string $Status
 */
class NewsArticleSource extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return NewsArticleSource the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'NewsArticleSource';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            //,NewsArticleUpdatedDuration , InsertedDate, UpdatedDate
            array('NewsArticleSourceTitle, NewsArticleSourceUrl', 'required'),
            array('NewsArticleSourceTitle, NewsArticleSourceUrl', 'length', 'max' => 255),
            array('Status', 'length', 'max' => 8),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            //, NewsArticleUpdatedDuration, InsertedDate, UpdatedDate
            array('NewsArticleSourceId, NewsArticleSourceTitle, NewsArticleSourceUrl, Status', 'safe', 'on' => 'search'),
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
            'NewsArticleSourceId' => 'News Article Source',
            'NewsArticleSourceTitle' => 'News Article Source Title',
            'NewsArticleSourceUrl' => 'News Article Source Url',
            'NewsArticleUpdatedDuration' => 'News Article Updated Duration',
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

        $criteria->compare('NewsArticleSourceId', $this->NewsArticleSourceId);
        $criteria->compare('NewsArticleSourceTitle', $this->NewsArticleSourceTitle, true);
        $criteria->compare('NewsArticleSourceUrl', $this->NewsArticleSourceUrl, true);
        //$criteria->compare('NewsArticleUpdatedDuration', $this->NewsArticleUpdatedDuration, true);
        $criteria->compare('InsertedDate', $this->InsertedDate, true);
        $criteria->compare('UpdatedDate', $this->UpdatedDate);
        $criteria->compare('Status', $this->Status, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    /**
     * Created By : Inheritx
     * Created Date : 06 August 2013
     * Description : Get news article source listing
     */
    public function getNewsArticleSourceListing() {
        $saNewArticleSourceDetails = NewsArticleSource::model()->findAll(' Status = "Active" ');
        $saNewArticleSourceArr = array();
        $saNewArticleSourceArr[''] = '--Select--';
        if (isset($saNewArticleSourceDetails) && !empty($saNewArticleSourceDetails)) {
            foreach ($saNewArticleSourceDetails AS $saNewArticleSource) {
                $saNewArticleSourceArr[$saNewArticleSource->NewsArticleSourceId] = $saNewArticleSource->NewsArticleSourceTitle;
            }
        }
        return $saNewArticleSourceArr;
    }
    
    
    /**
     * Created By : Inheritx
     * Created Date : 07 August 2013
     * Description : Show Article Source
     */
    public function showArticleSource($id) {
        $saNewArticleSourceDetails = NewsArticleSource::model()->find(' NewsArticleSourceId = "' . $id . '" ');
        $ssNewArticleSourceName = '---';
        if (isset($saNewArticleSourceDetails) && !empty($saNewArticleSourceDetails)) {
            $ssNewArticleSourceName = $saNewArticleSourceDetails->NewsArticleSourceTitle;
        }
        return $ssNewArticleSourceName;
    }

    /**
     * Created By : Inheritx
     * Created Date : 09 August 2013
     * Description : Delete all news article source
     */
    public function removeSelectedArticleSource($anArticleSourceIds) {
        $bDeleted = 0;
        if(count($anArticleSourceIds) > 0)
        {
            foreach($anArticleSourceIds AS $saKey => $snValue)
            {
                $saNewsArticleAccessArr = NewsArticleSource::model()->findAll('NewsArticleSourceId = "'.$snValue.'"');
                if(count($saNewsArticleAccessArr) == 0)
                {
                    $bDeleted = NewsArticleSource::model()->deleteAll('NewsArticleSourceId = "' . $snValue . '" ');
                }
            }
        }
        return $bDeleted;        
    }

    /**
     * Created By : Inheritx
     * Created Date : 09 August 2013
     * Description : Change status to active/inactive of all news article source
     */
    public function changeStatusSelectedArticleSource($anStatusIds, $anStatusType = 'Active') {
        $connection = Yii::app()->db;
        $snNewsArticleSourceId = @implode(',',$anStatusIds);
        $sql = 'UPDATE NewsArticleSource SET Status ="'.$anStatusType.'" WHERE NewsArticleSourceId IN ('.$snNewsArticleSourceId.')';
        $command = $connection->createCommand($sql);
        //p($command);
        $command->execute();
        return true;
    }
    
}