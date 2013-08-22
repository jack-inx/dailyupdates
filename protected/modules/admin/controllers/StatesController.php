<?php

class StatesController extends Controller {
    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
     * Description : @var string the default layout for the views. Defaults to '//layouts/column2', meaning using two-column layout. See 'protected/views/layouts/column2.php'.
     */

    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
     * Description: Action before calling the action
     */    
    public function init() {
        Yii::app()->theme = 'abound';
        //$this->layout = 'webroot.themes.abound.views.layouts.main';
        $this->layout = 'webroot.themes.abound.views.layouts.column2';
    }

    
    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
     * Description : @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
     * Description : Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
     * Description : Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */    
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
     * Description : Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new States;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['States'])) {
            $model->attributes = $_POST['States'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->StateId));
        }

        $this->render('create', array(
            'model' => $model,
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

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['States'])) {
            $model->attributes = $_POST['States'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->StateId));
        }

        $this->render('update', array(
            'model' => $model,
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
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
     * Description : Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('States');
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
        $model = new States('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['States']))
            $model->attributes = $_GET['States'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
     * Description : Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return States the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = States::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
     * Description : Performs the AJAX validation.
     * @param States $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'states-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
