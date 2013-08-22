<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class AdminCoreController extends Controller {

    public $layout = 'admin';
    public $accessRule = '';
    public $userType = 'admin';
    public $defaultAction = 'admin';

    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
        //set usertype
        if (isset(Yii::app()->admin->id)) {
            $admin = Yii::app()->admin->getState('admin');
            if (isset($admin['UserType']) && $admin['UserType'] != '') {
                $this->userType = $admin['UserType'];
            }
        }
        $this->accessRule = new UserAccessControll();
    }

    /**
     * The filter method for 'accessControl' filter.
     * This filter is a wrapper of {@link CAccessControlFilter}.
     * To use this filter, you must override {@link accessRules} method.
     * @param CFilterChain $filterChain the filter chain that the filter is on.
     */
    public function filterAccessControl($filterChain) {
        //$filter=new CAccessControlFilter;
        $filter = new JVAccessControlFilter;
        $filter->setRules($this->accessRules());
        $filter->filter($filterChain);
    }

    public function getControllerName() {
        return get_class($this);
    }

    public function getModuleId() {
        return $this->accessRule->getModule($this->getModule()->id, 'id');
    }

    public function defaultAccessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'roles' => array('*'),
                'desc' => 'List / Details Data',
            ),
            array('allow',
                'actions' => array('minicreate', 'create', 'update'),
                'roles' => array('UserCreator'),
                'desc' => 'Add / Update Data',
            ),
            array('allow',
                'actions' => array('admin', 'delete'),
                'users' => array($this->userType),
                'desc' => 'Delete and Manage Operation',
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function accessRules($userType = 'admin', $isDefault = false) {
        $user_roles = ((AdminModule::getUserDataByKey('UserRoles') != '') ? AdminModule::getUserDataByKey('UserRoles') : "''");

        $models = UserRules::model()->findAll("PrivilegesController = '" . $this->getControllerName() . "' AND ModuleId = '" . $this->getModuleId() . "' AND RoleId IN (" . $user_roles . ")");
        foreach ($models as $model) {
            $array[] = array(
                $model->Permission,
                'actions' => explode(',', $model->PrivilegesActions),
                'users' => explode(',', $model->PermissionType),
                'desc' => $model->RoleDesc,
            );
        }

        if (isset($array)) {
            return $array;
        } else {
            return $this->defaultAccessRules();
        }
    }

}