<?php

Yii::import('application.models.User._base.BaseUserRulesMenu');

function getRecursiveTree() {
    
}

class UserRulesMenu extends BaseUserRulesMenu {

    public $menuList = array();
    public $current_parent_id = 0;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getAllowedMenu($module, $parent_id) {
        switch (strtolower($module)) {
            case 'admin':
                $role_ids = AdminModule::getUserDataByKey('UserRoles');
                break;
            case 'member':
                $role_ids = MemberModule::getUserDataByKey('UserRoles');
                break;
        }

        if (trim($role_ids) == '') {
            $role_ids = "''";
        }

        $criteria = new CDbCriteria();
        $criteria->condition = " Id IN (" . $role_ids . ") AND IsPublish=1 ";
        $modelRole = UserRole::model()->findAll($criteria);
        $role_idAr = array();
        foreach ($modelRole as $role) {
            $role_idAr[] = $role->Id;
        }

        $role_ids = implode(',', $role_idAr);
        if (trim($role_ids) == '') {
            $role_ids = "''";
        }

        $criteria = new CDbCriteria();
        $criteria->condition = " Rule.RoleId IN (" . $role_ids . ") AND Module.ModuleCode='" . $module . "'
            AND t.ParentId = '" . $parent_id . "'
            AND t.IsActive=1 ";
        $criteria->order = 't.Position ASC';
        $data = UserRulesMenu::model()->with(array('Module', 'Rule'))->findAll($criteria);
        return $data = UserRulesMenu::model()->with(array('Module', 'Rule'))->findAll($criteria);

        //$model = UserRole::model()->findAll();
    }

    public function createTree($module = 'admin', $index = 0, $level = 0, $menuList = array()) {
        $data = $this->getAllowedMenu($module, $this->current_parent_id);

        if (count($data) > 0) {
            foreach ($data as $row) {
                $this->menuList[] = array('label' => $row->Label, 'url' => array($row->Url), 'Level' => $level, 'Id' => $row->Id, 'ParentId' => $row->ParentId);
                $this->current_parent_id = $row->Id;
                $index++;
                $this->createTree($module, $index, $level + 1);
            }
        }
    }

    public function getMenuItems($module = 'admin') {
        $this->createTree($module);

        $items = $this->menuList;
        $childs = array();
        $tree = array();
        foreach ($items as &$item) {
            $childs[$item['ParentId']][] = &$item;
        }
        unset($item);

        foreach ($items as &$item)
            if (isset($childs[$item['Id']]))
                $item['Items'] = $childs[$item['Id']];
        unset($item);

        if (isset($childs[0])) {
            $tree = $childs[0];
        }
        //p($tree);
        return array('items' => $tree);
    }

}