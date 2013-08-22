<?php

include('rss_feed_parser/Rss.minified.php');

class RssFeedController extends Controller {

    /**
     * Created By : Inheritx
     * Created Date : 06 August 2013
     * Description: Action before calling the action
     */
    public function init() {
        Yii::app()->theme = 'abound';
        //$this->layout = 'webroot.themes.abound.views.layouts.main';
        $this->layout = 'webroot.themes.abound.views.layouts.column2';
    }

    /**
     * Created By : Inheritx
     * Created Date : 06 August 2013
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
     * Created By : Inheritx
     * Created Date : 06 August 2013
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
     * Created Date : 06 August 2013
     * Description : Lists all models.
     */
    public function actionIndex() {
        $this->render('create');
    }

    /**
     * Created By : Inheritx
     * Created Date : 05 August 2013
     * Description : Receive Feeds from given url.
     */
    public function actionReceiveFeeds() {
        //request url = http://localhost/dailyupdates/api/RssFeed/ReceiveFeeds?url=http://feeds.feedburner.com/thedailybeast/articles
        //$smData = User::model()->getAPIDataStruct();
        $response = array();
        //if (isset($smData['request']['params']['url']) && !empty($smData['request']['params']['url'])) {
        if (isset($_POST['RSSFeed_Url']) && !empty($_POST['RSSFeed_Url'])) {

            $ssRssFeedUrl = $_POST['RSSFeed_Url'];

            $obRss = new Rss; // create object
            //try {
            //http://feeds.feedburner.com/thedailybeast/articles
            $saFeed = $obRss->getFeed($ssRssFeedUrl, Rss::XML);
            //p($saFeed);
            $snCounter = 0;
            if (count($saFeed) > 0) {
                foreach ($saFeed as $saItem) {
                    if (isset($saItem['title']) && !empty($saItem['title'])) {
                        $ssTitle = $saItem['title'];
                        $ssDescription = $saItem['description'];
                        $ssCategory = $saItem['category'];
                        $ssLink = $saItem['link'];
                        $ssDate = $saItem['date'];

                        if ($ssCategory != '') {
                            //Check category
                            $saNewsCategory = NewsCategory::model()->find('LCASE(NewsCategoryName) = LCASE("' . $ssCategory . '")');
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
                        } else {
                            $snNewsCategoryId = 0;
                        }
                        $saNewsArticle = NewsArticle::model()->find('NewsArticleTitle = "' . mysql_real_escape_string($ssTitle) . '" AND NewsCategoryId = ' . $snNewsCategoryId);
                        if (isset($saNewsArticle) && count($saNewsArticle) > 0) {
                            //do nothing
                        } else {
                            //insert article
                            $snCounter++;
                            $saNewsArticle = new NewsArticle();
                            $saNewsArticle->NewsArticleTitle = $ssTitle;
                            $saNewsArticle->NewsCategoryId = $snNewsCategoryId;
                            $saNewsArticle->NewsSubCategoryId = '';
                            $saNewsArticle->NewsArticleSourceId = '';
                            $saNewsArticle->NewsArticleImage = '';
                            $saNewsArticle->NewsArticleLink = $ssLink;
                            $saNewsArticle->NewsDescription = $ssDescription;
                            $saNewsArticle->NewsPublishDate = date('Y-m-d H:i:s', strtotime($ssDate));
                            $saNewsArticle->InsertedDate = User::model()->getCurrentDateTime();
                            $saNewsArticle->Status = 'Active';
                            $saNewsArticle->save(false);
                            $snNewsArticleId = $saNewsArticle->NewsArticleId;
                            $saUserPreferenceDetails = UserPreference::model()->findAll(' NewsCategoryId = "'.$snNewsCategoryId.'" AND NewsSubCategoryId = "0"');
                            if(isset($saUserPreferenceDetails) && !empty($saUserPreferenceDetails))
                            {
                                foreach($saUserPreferenceDetails AS $saUserPreference)
                                {
                                    $snUserId = $saUserPreference->UserId;
                                    $saUserArticleAccess = new UserArticleAccess();
                                    $saUserArticleAccess->UserId = $snUserId;
                                    $saUserArticleAccess->NewsArticleId = $snNewsArticleId;
                                    $saUserArticleAccess->TimeDuration = '00:00:00';
                                    $saUserArticleAccess->AccessStatus = 'Unread';
                                    $saUserArticleAccess->InsertedDate = User::model()->getCurrentDateTime();
                                    $saUserArticleAccess->Status = 'Active';
                                    $saUserArticleAccess->save();
                                    
                                }
                            }
                            
                        }
                    }
                }
            }
            echo $snCounter;
            exit;
            /* } catch (Exception $e) {
              echo $e->getMessage();
              } */
        } else {
            echo '-1';
            exit;
        }
    }

}