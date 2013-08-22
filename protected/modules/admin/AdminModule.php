<?php

//if (!defined('STK_INDEX'))       { define('STK_INDEX', STK_ROOT_PATH . 'index.' . PHP_EXT); }
//Fix (tentative)
//if (!defined('E_DEPRECATED'))    { define('E_DEPRECATED', 8192); }
//error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

class AdminModule extends CWebModule {

    public $returnUrl = "/admin/index";
    public $homeUrl = "/admin/index";
    public $loginUrl = "/admin/login";
    public $logoutUrl = "/admin/logout";

    /**
     * @var string
     * @desc hash method (md5,sha1 or algo hash function http://www.php.net/manual/en/function.hash.php)
     */
    public $hash = 'md5';

    /**
     * @var boolean
     * @desc use email for activation customer account
     */
    public $sendActivationMail = true;

    public function init() {
        //Below code to select a theme
        Yii::app()->theme = 'abound';

        Yii::app()->setComponents(array(
            'errorHandler' => array(
                'errorAction' => 'admin/index/error',
            ),
        ));
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport(array(
            'admin.models.*',
            'application.models.User.*',
            'admin.components.*',
        ));
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            $loginAction = TRUE;

            if ($controller->id == 'index' && $action->id == 'login') {
                $loginAction = FALSE;
            }

            if (Yii::app()->admin->id && $action->id == 'login') {
                Yii::app()->controller->redirect(AdminModule::getUrl('home'));
            }

            if ($controller->id != 'index') {
                if (!Yii::app()->admin->id && $loginAction) {
                    Yii::app()->controller->redirect(AdminModule::getUrl('login'));
                }
            }
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        }
        else
            return false;
    }

    public static function getUrl($type = 'home') {
        switch ($type) {
            case 'home':
                return AdminCoreController::createUrl(Yii::app()->getModule('admin')->homeUrl);
                break;
            case 'return':
                return AdminCoreController::createUrl(Yii::app()->getModule('admin')->returnUrl);
                break;
            case 'login':
                return AdminCoreController::createUrl(Yii::app()->getModule('admin')->loginUrl);
                break;
            case 'logout':
                return AdminCoreController::createUrl(Yii::app()->getModule('admin')->logoutUrl);
                break;
        }
    }

    public static function getUserData() {
        return Yii::app()->admin->getState('admin');
    }

    public static function getFullName() {
        $data = self::getUserData();
        if (isset($data['FullName']))
            return $data['FullName'];
        else
            return false;
    }

    public static function getUserDataByKey() {
        $array = func_get_args(); //explode('.', $path);
        $adminData = Yii::app()->admin->getState('admin');

        $str = '';
        $val = $adminData;
        foreach ($array as $data) {
            $str .= '[\'' . $data . '\']';
            if (!isset($val[$data]))
                return false;
            $val = $val[$data];
        }
        return $val;
    }

    public static function encrypting($string = "") {
        $hash = Yii::app()->getModule('admin')->hash;
        if ($hash == "md5")
            return md5($string);
        if ($hash == "sha1")
            return sha1($string);
        else
            return hash($hash, $string);
    }

    public static function getLoginUrl() {
        if (!Yii::app()->admin->Id) {
            return Controller::createUrl('/admin/login');
        } else {
            return Controller::createUrl('/admin/logout');
        }
    }

    public static function getLoginText() {
        if (!Yii::app()->admin->Id) {
            return 'Login';
        } else {
            return 'Logout';
        }
    }

    public static function getWelcomeText() {
        if (Yii::app()->admin->Id) {
            $admin_id = Yii::app()->admin->Id;
            $asAdminDetails = User::model()->find('UserId="' . $admin_id . '"');
            return 'Welcome ' . ucwords($asAdminDetails->FirstName . ' ' . $asAdminDetails->LastName) . '  |';
        } else {
            return false;
        }
    }

}
