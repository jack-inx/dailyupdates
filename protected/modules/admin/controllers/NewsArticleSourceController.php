<?php

class NewsArticleSourceController extends Controller {

    /**
     * Created By : Inheritx
     * Created Date : 02 August 2013
     * Description : @var string the default layout for the views. Defaults to '//layouts/column2', meaning using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public function init() {
        Yii::app()->theme = 'abound';
        $this->layout = 'webroot.themes.abound.views.layouts.column2';
    }

    /**
     * Created By : Inheritx
     * Created Date : 02 August 2013
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
     * Created Date : 02 July 2013
     * Description : @return allowed action create
     */
    public function allowedActions() {
        return 'Create';
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new NewsArticleSource;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['NewsArticleSource'])) {
            $model->attributes = $_POST['NewsArticleSource'];
            //$model->NewsArticleUpdatedDuration = date('Y-m-d H:i:s', strtotime($_POST['NewsArticleSource']['NewsArticleUpdatedDuration']));
            $model->InsertedDate = User::getCurrentDateTime();
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->NewsArticleSourceId));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['NewsArticleSource'])) {
            $model->attributes = $_POST['NewsArticleSource'];
            //$model->NewsArticleUpdatedDuration = date('Y-m-d H:i:s', strtotime($_POST['NewsArticleSource']['NewsArticleUpdatedDuration']));
            $model->UpdatedDate = User::getCurrentDateTime();
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->NewsArticleSourceId));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
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
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('NewsArticleSource');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new NewsArticleSource('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['NewsArticleSource']))
            $model->attributes = $_GET['NewsArticleSource'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return NewsArticleSource the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = NewsArticleSource::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param NewsArticleSource $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'news-article-source-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Created By : Inheritx
     * Created Date : 09 August 2013
     * Description : Delete multiple news article source.
     */
    public function actionDeleteMultipleArticleSource() {
        //p($_POST);
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $anDeletedIds = isset($_POST['Data']) ? $_POST['Data'] : array();
            //p($anDeletedIds);
            if (count($anDeletedIds) > 0) {
                $bDeleted = NewsArticleSource::removeSelectedArticleSource($anDeletedIds);
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
     * Description : Change multiple news article source status to Active/Inactive.
     */
    public function actionChangeArticleSourceStatus() {
        //p($_POST);
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $anStatusIds = isset($_POST['Data']) ? $_POST['Data'] : array();
            $anStatusType = isset($_POST['Status']) ? $_POST['Status'] : '';

            if (count($anStatusIds) > 0) {
                $bUpdated = NewsArticleSource::changeStatusSelectedArticleSource($anStatusIds, $anStatusType);
                if ($bUpdated) {
                    echo '1';
                    exit;
                }
            }
        }
    }

}
