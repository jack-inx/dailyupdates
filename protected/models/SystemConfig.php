<?php

Yii::import('application.models._base.BaseSystemConfig');

class SystemConfig extends BaseSystemConfig
{
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }
        
    public static function getValue($path='',$allFields=0)
    {
        $model = SystemConfig::model();
        $criteria = new CDbCriteria();
        $criteria->condition = "Name = '".trim($path)."'";
        $data = $model->find($criteria);
        if($allFields==0) return $data->Value;
        else return $data->attributes;
    }
}