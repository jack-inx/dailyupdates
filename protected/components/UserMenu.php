<?php

Yii::import('zii.widgets.CPortlet');

class UserMenu extends CPortlet {

    public function init() {
        $this->title = CHtml::encode(Yii::app()->user->name);
        parent::init();
    }

    protected function renderContent() {
        $this->render('userMenu');
    }

    public static function getMenuItems() {
        $menuData = array();
        if (isset(Yii::app()->user->id)) {
            $menuData = UserRulesMenu::model()->getMenuItems('admin');
        }
        //p($menuData);
        return $menuData;
    }

}