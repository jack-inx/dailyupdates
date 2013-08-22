<?php

include('rss_feed_parser/Rss.minified.php');

class RssFeedController extends Controller {

    /**
     * Created By : Inheritx
     * Created Date : 05 August 2013
     * Description : Receive Feeds from given url.
     */
    public function actionReceiveFeeds() {
        //request url = http://localhost/dailyupdates/api/RssFeed/ReceiveFeeds
        $obRss = new Rss; // create object
        $response = array();

        $saNewsArticleSourceDetails = NewsArticleSource::model()->findAll(' Status="Active" ');

        if (count($saNewsArticleSourceDetails) > 0) {
            $snCounter = 0;
            foreach ($saNewsArticleSourceDetails AS $saNAS) {
                $ssRssFeedUrl = $saNAS->NewsArticleSourceUrl;
                $snNewsArticleSourceId = $saNAS->NewsArticleSourceId;
                $saFeed = $obRss->getFeed($ssRssFeedUrl, Rss::XML);
                //p($saFeed);                
                if (count($saFeed) > 0) {
                    foreach ($saFeed as $saItem) {
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

                            $saNewsArticle = NewsArticle::model()->find('NewsArticleTitle = "' . $ssTitle . '" AND NewsCategoryId = "' . $snNewsCategoryId . '"');
                            if (isset($saNewsArticle) && count($saNewsArticle) > 0) {
                                //do nothing
                            } else {
                                //insert article
                                $snCounter++;
                                $saNewsArticle = new NewsArticle();
                                $saNewsArticle->NewsArticleTitle = $ssTitle;
                                $saNewsArticle->NewsCategoryId = $snNewsCategoryId;
                                $saNewsArticle->NewsSubCategoryId = '';
                                $saNewsArticle->NewsArticleSourceId = $snNewsArticleSourceId;
                                $saNewsArticle->NewsArticleImage = '';
                                $saNewsArticle->NewsArticleLink = $ssLink;
                                $saNewsArticle->NewsDescription = $ssDescription;
                                $saNewsArticle->NewsPublishDate = date('Y-m-d H:i:s', strtotime($ssDate));
                                $saNewsArticle->InsertedDate = User::model()->getCurrentDateTime();
                                $saNewsArticle->Status = 'Active';
                                $saNewsArticle->save(false);

                                $snNewsArticleId = $saNewsArticle->NewsArticleId;
                                $saUserPreferenceDetails = UserPreference::model()->findAll(' NewsCategoryId = "' . $snNewsCategoryId . '" AND NewsSubCategoryId = "0"');
                                if (isset($saUserPreferenceDetails) && !empty($saUserPreferenceDetails)) {
                                    foreach ($saUserPreferenceDetails AS $saUserPreference) {
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
            }
            echo 'Total Record Inserted : ' . $snCounter;
            exit;
        }
    }

}