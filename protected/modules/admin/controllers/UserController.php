<?php

class UserController extends Controller {

    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
     * Description : @var string the default layout for the views. Defaults to '//layouts/column2', meaning using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout='//layouts/column2';

    public function init() {
        Yii::app()->theme = 'abound';
        $this->layout = 'webroot.themes.abound.views.layouts.column2';
    }

    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
     * Description : @return array action filters
     */
    public function filters() {
        return array(
            //   'rights',
            'accessControl',
        );
    }

    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
     * Description : @return allowed action create
     */
    public function allowedActions() {
        return 'Create';
    }

    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
     * Description : Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $saModelDetails = UserDetails::model()->find(' UserId = "' . $id . '"');
        $this->render('view', array(
            'model' => $this->loadModel($id), 'modeldetails' => $saModelDetails
        ));
    }

    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
     * Description : Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new User;
        $modeldetails = new UserDetails();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            if ($_POST['User']['Email'] != '') {
                $Obj = $model->findByAttributes(array('Email' => $_POST['User']['Email']));

                if (isset($Obj->attributes)) {
                    $model->attributes = $_POST['User'];
                    $modeldetails->attributes = $_POST['UserDetails'];
                    Yii::app()->user->setFlash('error', Yii::t("messages", "There is already an account with this User Name. Please try again. !!!"));
                    $this->render('create', array('model' => $model,'modeldetails' => $modeldetails));
                    Yii::app()->end();
                }
            }

            $model->attributes = $_POST['User'];
            $modeldetails->attributes = $_POST['UserDetails'];
            $pwd = Yii::app()->getModule('admin')->encrypting($_POST['User']['Password']);
            $model->Password = $pwd;
            $model->UserType = 'User';
            if ($_POST['User']['BirthDate'] != '') {
                $model->BirthDate = date('Y-m-d', strtotime($_POST['User']['BirthDate']));
            }
            $model->UserRoles = '';
            $model->InsertedDate = User::getCurrentDateTime();
            $model->UserRoles = '2';
            //p($model->attributes);
            if ($model->save()) {
                $modeldetails->attributes = $_POST['UserDetails'];
                $modeldetails->UserId = $model->UserId;
                if ($modeldetails->save()) {
                    $this->redirect(array('view', 'id' => $model->UserId));
                }
            }
        }

        $this->render('create', array(
            'model' => $model, 'modeldetails' => $modeldetails
        ));
    }

    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
     * Description : Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $smPassword = $model->Password;
        $saModelDetails = UserDetails::model()->find(' UserId = "' . $id . '" ');
        if (!isset($saModelDetails)) {
            $saModelDetails = new UserDetails();
        }

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {

            /*if ($smPassword != $_POST['User']['Password']) {
                $pwd = Yii::app()->getModule('admin')->encrypting($_POST['User']['Password']);
                $model->Password = $pwd;
            } else {
                $model->Password = $model->Password;
            }*/
            $model->attributes = $_POST['User'];



            if ($model->save()) {
                $saModelDetails->attributes = $_POST['UserDetails'];
                $saModelDetails->UserId = $id;
                $saModelDetails->save();
                $this->redirect(array('view', 'id' => $model->UserId));
            }
        }

        $this->render('update', array(
            'model' => $model, 'modeldetails' => $saModelDetails
        ));
    }

    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
     * Description : Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
     * Description : Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('User');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
     * Description : Manages all models.
     */
    public function actionAdmin() {
        $model = new User('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
     * Description : Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
     * Description : Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
     * Description : Show State according to country id.
     */
    /*
      public function actionShowCountryState() {

      $smStateHtml = '<option value="">--Select--</option>';
      if (isset($_POST['id']) && !empty($_POST['id'])) {
      $saState = States::model()->findAll(' CountryID = "' . $_POST['id'] . '"');
      if (isset($saState) && !empty($saState)) {
      foreach ($saState AS $ssState) {
      $smStateHtml .= '<option value="' . $ssState->StateId . '">' . $ssState->StateName . '</option>';
      }
      }
      }
      echo $smStateHtml;
      exit;
      }
     */
    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
     * Description : Show State according to country id.
     */
    /*
      public function actionShowStateCity() {
      $smCityHtml = '<option value="">--Select--</option>';
      if (isset($_POST['id']) && !empty($_POST['id'])) {
      $saCity = Cities::model()->findAll(' StateID = "' . $_POST['id'] . '"');
      if (isset($saCity) && !empty($saCity)) {
      foreach ($saCity AS $ssCity) {
      $smCityHtml .= '<option value="' . $ssCity->CityID . '">' . $ssCity->CityName . '</option>';
      }
      }
      }
      echo $smCityHtml;
      exit;
      }
     */

    /**
     * Created By : Inheritx
     * Created Date : 09 August 2013
     * Description : Delete multiple users.
     */
    public function actionDeleteMultipleUsers() {
        //p($_POST);
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $anDeletedIds = isset($_POST['Data']) ? $_POST['Data'] : array();
            //p($anDeletedIds);
            if (count($anDeletedIds) > 0) {
                $bDeleted = User::removeSelectedUsers($anDeletedIds);
                if ($bDeleted) {
                    echo '1';
                    exit;
                }
            }
        }
    }

    /**
     * Created By : Inheritx
     * Created Date : 09 August 2013
     * Description : Change multiple users status to Active/Inactive.
     */
    public function actionChangeUsersStatus() {
        //p($_POST);
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $anStatusIds = isset($_POST['Data']) ? $_POST['Data'] : array();
            $anStatusType = isset($_POST['Status']) ? $_POST['Status'] : '';


            if (count($anStatusIds) > 0) {
                $bUpdated = User::changeStatusSelectedUsers($anStatusIds, $anStatusType);
                if ($bUpdated) {
                    echo '1';
                    exit;
                }
            }
        }
    }

    /**
     * Created By : Inheritx
     * Created Date : 12 August 2013
     * Description : Change users password.
     */
    public function actionChange($id) {

        $model = User::model()->findByPk((int) $id);
        $modelForm = new ChangePasswordForm();

        if (isset($_POST['ChangePasswordForm']['PasswordRepeat']) && !empty($_POST['ChangePasswordForm']['PasswordRepeat'])) {
            if ((count(CJSON::decode(CActiveForm::validate($modelForm))) > 0)) {
                $this->render('change', array(
                    'model' => $modelForm,
                ));
                Yii::app()->end();
            }

            $modelForm->PasswordRepeat = $_POST['ChangePasswordForm']['PasswordRepeat'];
            $model->Password = md5($modelForm->PasswordRepeat);
            //p($model->attributes);
            $model->save(false);
            if (!$model->hasErrors()) {
                Yii::app()->user->setFlash('success', "Password change successfully!");
                $this->redirect(array('admin', 'id' => $id));
            } else {
                Yii::app()->user->setFlash('error', "Password change failure!");
                $this->redirect(array('admin', 'id' => $id));
            }
        }
        $this->render('change', array('model' => $modelForm,));
    }

}

