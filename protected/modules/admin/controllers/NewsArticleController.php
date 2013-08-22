<?php

class NewsArticleController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('admin'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('admin'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('user'),
            ),
        );
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
        $model = new NewsArticle;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['NewsArticle'])) {

            $model->attributes = $_POST['NewsArticle'];
            $model->NewsPublishDate = '';
            //p($_POST);
            if(isset($_POST['NewsArticle']['NewsPublishDate']) && !empty($_POST['NewsArticle']['NewsPublishDate'])){
            $model->NewsPublishDate = date('Y-m-d H:i:s', strtotime($_POST['NewsArticle']['NewsPublishDate']));
            }
            $model->InsertedDate = User::model()->getCurrentDateTime();
            if ($_POST['NewsArticle']['NewsCategoryId'] == 'Other') {
                if ($_POST['NewsArticle']['SourceId'] != '') {
                    $ssNewsCategory = $_POST['NewsArticle']['SourceId'];
                    $saNewsCategory = NewsCategory::model()->find('LCASE(NewsCategoryName) = LCASE("' . $ssNewsCategory . '")');
                    if (isset($saNewsCategory) && count($saNewsCategory) > 0) {
                        $snNewsCategoryId = $saNewsCategory->NewsCategoryId;
                    } else {
                        $saNewsCategory = new NewsCategory();
                        $saNewsCategory->NewsCategoryName = $ssCategory;
                        $saNewsCategory->InsertedDate = User::model()->getCurrentDateTime();
                        $saNewsCategory->Status = 'Active';
                        $saNewsCategory->save();
                        $snNewsCategoryId = $saNewsCategory->NewsCategoryId;
                    }
                    $model->NewsCategoryId = $snNewsCategoryId;
                } /* else {
                  Yii::app()->user->setFlash('success', Yii::t("messages", "Please Enter Other News Category"));
                  $this->redirect($this->createUrl('admin/newsArticle/update/id/'.$model->NewsArticleId));
                  Yii::app()->end();
                  } */
            }
            //p($model->attributes);
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->NewsArticleId));
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

        if (isset($_POST['NewsArticle'])) {
            $model->attributes = $_POST['NewsArticle'];
            $model->NewsPublishDate = date('Y-m-d H:i:s', strtotime($_POST['NewsArticle']['NewsPublishDate']));
            $model->UpdatedDate = User::model()->getCurrentDateTime();
            if ($_POST['NewsArticle']['NewsCategoryId'] == 'Other') {
                if ($_POST['NewsArticle']['SourceId'] != '') {
                    $ssNewsCategory = $_POST['NewsArticle']['SourceId'];
                    $saNewsCategory = NewsCategory::model()->find('LCASE(NewsCategoryName) = LCASE("' . $ssNewsCategory . '")');
                    if (isset($saNewsCategory) && count($saNewsCategory) > 0) {
                        $snNewsCategoryId = $saNewsCategory->NewsCategoryId;
                    } else {
                        $saNewsCategory = new NewsCategory();
                        $saNewsCategory->NewsCategoryName = $ssCategory;
                        $saNewsCategory->InsertedDate = User::model()->getCurrentDateTime();
                        $saNewsCategory->Status = 'Active';
                        $saNewsCategory->save();
                        $snNewsCategoryId = $saNewsCategory->NewsCategoryId;
                    }
                    $model->NewsCategoryId = $snNewsCategoryId;
                }
            }
            //p($model->attributes);
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->NewsArticleId));
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
        $dataProvider = new CActiveDataProvider('NewsArticle');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new NewsArticle('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['NewsArticle']))
            $model->attributes = $_GET['NewsArticle'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return NewsArticle the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = NewsArticle::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param NewsArticle $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'news-article-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Created By : Inheritx
     * Created Date : 06 August 2013
     * Description : Show sub category listing
     */
    public function actionShowSubCategory() {
        $ssHtmlOptions = '';
        if (isset($_POST['id']) && $_POST['id'] > 0) {
            $snNewsCategoryId = $_POST['id'];
            $saSubCategoryDetails = NewsSubCategory::model()->findAll(' NewsCategoryId = "' . $snNewsCategoryId . '" AND Status = "Active" ');
            if (isset($saSubCategoryDetails) && count($saSubCategoryDetails) > 0) {
                $ssHtmlOptions .= '<option value="">--Select--</option>';
                foreach ($saSubCategoryDetails AS $saSubCat) {
                    $ssHtmlOptions .= '<option value="' . $saSubCat->NewsSubCategoryId . '">' . $saSubCat->NewsSubCategoryName . '</option>';
                }
            }
        }
        echo $ssHtmlOptions;
        exit;
    }

    /**
     * Created By : Inheritx
     * Created Date : 09 August 2013
     * Description : Delete multiple news article
     */
    public function actionDeleteMultipleArticle() {
        //p($_POST);
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $anDeletedIds = isset($_POST['Data']) ? $_POST['Data'] : array();
            //p($anDeletedIds);
            if (count($anDeletedIds) > 0) {
                $bDeleted = NewsArticle::removeSelectedArticle($anDeletedIds);
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
     * Description : Change multiple news article status to Active/Inactive.
     */
    public function actionChangeArticleStatus() {
        //p($_POST);
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $anStatusIds = isset($_POST['Data']) ? $_POST['Data'] : array();
            $anStatusType = isset($_POST['Status']) ? $_POST['Status'] : '';

            if (count($anStatusIds) > 0) {
                $bUpdated = NewsArticle::changeStatusSelectedArticle($anStatusIds, $anStatusType);
                if ($bUpdated) {
                    echo '1';
                    exit;
                }
            }
        }
    }

}
