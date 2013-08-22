<?php

class IndexController extends FrontCoreController {

    /**
     * Created By : Inheritx
     * Created Date : 25 July 2013
     * Description : Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * Created By : Inheritx
     * Created Date : 25 July 2013
     * Description : Displays landing page after successful login.
     */
    public function actionIndex() {
        $obUser = array();
        $this->render('index', array('obUser' => $obUser));
    }

    /**
     * Created By : Inheritx
     * Created Date : 25 July 2013
     * Description : Displays the login page.
     */
    public function actionLogin() {
        //$this->layout = 'column1';
        $model = new LoginForm;
        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            //p($model->attributes);

            if ($model->validate() && $model->login()) {
                $this->redirect('index');
            }
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Created By : Inheritx
     * Created Date : 25 July 2013
     * Description : Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    /**
     * Created By : Inheritx
     * Created Date : 25 July 2013
     * Description : Forgot password functionality by sending confirmation email.
     */
    public function actionForgot() {
        $params = array();
        if (isset($_POST['User_email']) && !empty($_POST['User_email'])) {
            $email = $_POST['User_email'];
            $forgotpwd = User::model()->forgotpassword();

            if ($forgotpwd == 1) {
                Yii::app()->user->setFlash('success', Yii::t("messages", "Kindly check your email to reset your password"));
                $this->redirect(CController::createUrl('index/login'));
                Yii::app()->end();
            } else {
                Yii::app()->user->setFlash('error', Yii::t("messages", "Entered email does not exist!!!"));
                $this->render('forgot', array('params' => $params));
                Yii::app()->end();
            }
        }

        // Display the home page
        $this->render('forgot', array('params' => $params));
    }

    /**
     * Created By : Inheritx
     * Created Date : 25 July 2013
     * Description : Change email functionality.
     */
    public function actionChange($code) {
        $code_arr = @explode('-', base64_decode($code));
        $id = $code_arr[0];
        $code = $code_arr[1];

        $model = $this->loadModel($id, 'Customer');
        $userdata = Customer::model()->find("UserId='" . $id . "'");
        $loginForm = new LoginForm;
        $modelCustomer = new Customer;
        //p($_POST);
        if (empty($_POST['User']['Password'])) {
            Yii::app()->user->setFlash('error', Yii::t("messages", "Please enter your Password."));
            $this->render('change', array('model' => $model, 'userdata' => $userdata));
            Yii::app()->end();
        } else
        if (isset($_POST['User']['Password']) && !empty($_POST['User']['Password'])) {
            $obj = Customer::model()->find("UserId='" . $id . "'");
            //echo $obj->password.' == '.$code; exit;
            if ($obj->Password == $code) {
                $model->Password = Yii::app()->getModule('admin')->encrypting($_POST['User']['Password']);
                $model->save(false);
                Yii::app()->user->setFlash('success', Yii::t("messages", "Your password was successfully reset."));
                $this->redirect($this->createUrl('index/login'));
                Yii::app()->end();
            } else {
                $email = base64_encode($userdata->Email);
                $url = $this->createUrl('index/reset/id/' . $email);
                $changeURL = ' <a id="forgot_password_link1" class="blue_colorsa clear_left" href="' . $url . '">Reset Password</a>';
                Yii::app()->user->setFlash('error', Yii::t("messages", "The reset link has expired. &nbsp;Please click on " . $changeURL . " so we can send you a new link to " . $userdata->Email . "."));
            }
        }
        $this->render('change', array('model' => $model, 'userdata' => $userdata));
    }

    /**
     * Created By : Inheritx
     * Created Date : 05 August 2013
     * Description : This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

}
