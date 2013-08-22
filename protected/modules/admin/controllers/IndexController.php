<?php

/**
 * Created By : Inheritx
 * Created Date : 26 July 2013
 * Description : Admin index controller
 */
class IndexController extends AdminCoreController {

    public $defaultAction = 'index';

    /**
     * Created By : Inheritx
     * Created Date : 26 July 2013
     * Description : Action before calling the action
     */
    public function init() {
        Yii::app()->theme = 'abound';
        //$this->layout = 'webroot.themes.abound.views.layouts.main';
        $this->layout = 'webroot.themes.abound.views.layouts.column2';
    }

    /**
     * Created By : Inheritx
     * Created Date : 26 July 2013
     * Description : @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Created By : Inheritx
     * Created Date : 26 July 2013
     * Description : Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function defaultAccessRules() {
        //$rules = parent::accessRules();
        $rules = array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('login', 'logout', 'forgot'),
                'users' => array('*'),
                'desc' => 'Login and Logout',
            ),
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index'),
                'users' => array('admin'),
                'desc' => 'Dashboard',
            ),
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index'),
                'users' => array('user'),
                'desc' => 'Dashboard',
            ),
        );

        return $rules;
    }

    /**
     * Created By : Inheritx
     * Created Date : 26 July 2013
     * Description : Specifies index action to render index page.
     */
    public function actionIndex() {
        $this->render('index');
    }

    /**
     * Created By : Inheritx
     * Created Date : 26 July 2013
     * Description : Displays the login page
     */
    public function actionLogin() {
        $this->layout = 'webroot.themes.abound.views.layouts.column1';
        $model = new AdminLoginForm;

        //redirect user to get dashboard
        $saAdminId = Yii::app()->admin->getId();
        if (isset($saAdminId) && !empty($saAdminId) && $saAdminId > 0) {
            $this->redirect("admin/index");
        }

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['AdminLoginForm'])) {
            $model->attributes = $_POST['AdminLoginForm'];
            // validate user input and redirect to the previous page if valid

            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->request->baseUrl . '/admin/index');
        }


        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Created By : Inheritx
     * Created Date : 26 July 2013
     * Description : Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->admin->logout(false);
        $this->redirect(Yii::app()->request->baseUrl . '/admin');
    }

    /**
     * Created By : Inheritx
     * Created Date : 26 July 2013
     * Description : show error message or redirects to error page
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Created By : Inheritx
     * Created Date : 31 July 2013
     * Description : Show forgot password form.
     */
    public function actionForgot() {
        $this->layout = 'webroot.themes.abound.views.layouts.column1';
        $this->pageTitle = "Forgot Password";
        $model = new ForgotPasswordForm();

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'forgot-password-form-forgotpassword-form') {
            CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['ForgotPasswordForm'])) {

            if (empty($_POST['ForgotPasswordForm']['Email'])) {
                Yii::app()->user->setFlash('error', Yii::t("app", "Email can not be empty."));
                $this->render('forgotpassword', array('model' => $model,));
                Yii::app()->end();
            }

            CActiveForm::validate($model);

            $pwd = $model->generatePassword();
            $Npwd = Yii::app()->getModule('admin')->encrypting($pwd);
            $email = $_POST['ForgotPasswordForm']['Email'];
            //$user = User::model()->find("Email='$email' and UserType = 'admin' AND Email <> 'admin@admin.com' ");
            $user = User::model()->find("Email='$email' and UserType = 'admin' ");

            if (empty($user->UserId)) {
                Yii::app()->user->setFlash('error', "Cannot find the email address.!");
                $this->redirect(Yii::app()->baseUrl . '/admin/index/forgot', array('model' => $model));
            } else {

                $arr = array('Password' => $Npwd);
                $user->attributes = $arr;
                $user->save();

                $ssEmail = $_POST['ForgotPasswordForm']['Email'];
                $ssSubject = 'Forgot Password';
                $content = "<p> Please find the following password</p>";
                $content.="<span>Password:$pwd</span> <br/>";
                $content.="<span>Go into your account and reset your password.!</span>";
                $ssBody = $content;
                Common::sendMail($ssEmail, array(Yii::app()->params['adminEmail'] => Yii::app()->params['adminEmail']), $ssSubject, $ssBody);

                Yii::app()->user->setFlash('success', "Password sent in your email!");
            }
        }
        // display the forgor password form
        $this->render('forgotpassword', array('model' => $model));
    }

}