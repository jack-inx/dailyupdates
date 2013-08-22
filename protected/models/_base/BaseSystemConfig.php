<?php

/**
 * This is the model base class for the table "SystemConfig".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "SystemConfig".
 *
 * Columns in table "SystemConfig" available as properties of the model,
 * and there are no model relations.
 *
 * @property string $Id
 * @property string $SystemSectionId
 * @property string $SystemGroupId
 * @property string $Name
 * @property string $Desc
 * @property string $Value
 * @property string $InputType
 * @property string $InputOptions
 * @property integer $Status
 * @property integer $Position
 *
 */
abstract class BaseSystemConfig extends CActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'SystemConfig';
    }

    public static function label($n = 1) {
        return Yii::t('app', 'SystemConfig|SystemConfigs', $n);
    }

    public static function representingColumn() {
        return 'Name';
    }

    public function rules() {
        return array(
                array('Name, Value', 'required'),
                array('Status, Position', 'numerical', 'integerOnly'=>true),
                array('SystemSectionId, SystemGroupId', 'length', 'max'=>10),
                array('Name', 'length', 'max'=>100),
                array('InputType', 'length', 'max'=>8),
                array('Desc, InputOptions', 'safe'),
                array('SystemSectionId, SystemGroupId, Desc, InputType, InputOptions, Status, Position', 'default', 'setOnEmpty' => true, 'value' => null),
                array('Id, SystemSectionId, SystemGroupId, Name, Desc, Value, InputType, InputOptions, Status, Position', 'safe', 'on'=>'search'),
        );
    }

    public function relations() {
        return array(
        );
    }

    public function pivotModels() {
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'Id' => Yii::t('app', 'ID'),
            'SystemSectionId' => Yii::t('app', 'System Section'),
            'SystemGroupId' => Yii::t('app', 'System Group'),
            'Name' => Yii::t('app', 'Name'),
            'Desc' => Yii::t('app', 'Desc'),
            'Value' => Yii::t('app', 'Value'),
            'InputType' => Yii::t('app', 'Input Type'),
            'InputOptions' => Yii::t('app', 'Input Options'),
            'Status' => Yii::t('app', 'Status'),
            'Position' => Yii::t('app', 'Position'),
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('Id', $this->Id, true);
        $criteria->compare('SystemSectionId', $this->SystemSectionId, true);
        $criteria->compare('SystemGroupId', $this->SystemGroupId, true);
        $criteria->compare('Name', $this->Name, true);
        $criteria->compare('Desc', $this->Desc, true);
        $criteria->compare('Value', $this->Value, true);
        $criteria->compare('InputType', $this->InputType, true);
        $criteria->compare('InputOptions', $this->InputOptions, true);
        $criteria->compare('Status', $this->Status);
        $criteria->compare('Position', $this->Position);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}