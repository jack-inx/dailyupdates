<?php

class CategoryController extends Controller {

    /**
     * Created By : Inheritx
     * Created Date : 08 August 2013
     * Description : Category SubCategory List.
     */
    public function actionGetCategoryList() {
        $smData = User::model()->getAPIDataStruct();
        $response = array();
        if (isset($smData['request']['params']) && !empty($smData['request']['params'])) {
            $smRequestData = $smData['request']['params'];
            if ($smRequestData['UserId']) {
                $snUserId = $smRequestData['UserId'];
                //check whether UserId exist or Not in database
                $saUserDetails = User::model()->find('UserId="' . $snUserId . '"');
                if (isset($saUserDetails) && count($saUserDetails) > 0) {
                    //Fetch categories and subcategories
                    $saNewsCategoryDetails = NewsCategory::model()->findAll("Status='Active'");
                    if (isset($saNewsCategoryDetails) && count($saNewsCategoryDetails) > 0) {
                        $NewsCategory = array();
                        $snCategoryCounter = 0;
                        foreach ($saNewsCategoryDetails AS $saNewsCategory) {
                            //Set SubCategory for response
                            $sbNewsSubCategory = NewsSubCategory::model()->findAll("NewsCategoryId = '" . $saNewsCategory['NewsCategoryId'] . "'");
                            if (isset($sbNewsSubCategory)) {
                                $snSubCategoryCounter = 0;
                                $NewsSubCategory = array();                                
                                foreach ($sbNewsSubCategory as $key => $value) {
                                    //check sub category set by user
                                    $saUserPreferenceSubCategory = UserPreference::model()->find('UserId="' . $snUserId . '" AND NewsSubCategoryId = "' . $value['NewsSubCategoryId'] . '" ORDER BY NewsCategoryId ASC, NewsSubCategoryId ASC ');
                                    $snUserPreferenceSubCategoryFlag = 0;
                                    if (isset($saUserPreferenceSubCategory) && !empty($saUserPreferenceSubCategory)) {
                                        $snUserPreferenceSubCategoryFlag = 1;
                                    }
                                    $snSubCategoryCounter++;
                                    $NewsSubCategory[] = array(
                                        'SubId' => $snSubCategoryCounter,
                                        'NewsSubCategoryId' => $value['NewsSubCategoryId'],
                                        'NewsSubCategoryName' => $value['NewsSubCategoryName'],
                                        'Checked' => $snUserPreferenceSubCategoryFlag
                                    );
                                }
                            }
                            if (!empty($NewsSubCategory))
                                $NewsSubCategory1 = $NewsSubCategory;
                            else
                                $NewsSubCategory1 = array();
                            //$NewsSubCategory1 = "SubCategory Name Not Found!!";
                            //check category set by user
                            $saUserPreferenceCategory = UserPreference::model()->find('UserId="' . $snUserId . '" AND NewsCategoryId = "' . $saNewsCategory['NewsCategoryId'] . '" ORDER BY NewsCategoryId ASC, NewsSubCategoryId ASC ');
                            $snUserPreferenceCategoryFlag = 0;
                            if (isset($saUserPreferenceCategory) && !empty($saUserPreferenceCategory)) {
                                $snUserPreferenceCategoryFlag = 1;
                            }
                            
                            $NewsCategory[$snCategoryCounter] = array(
                                'Id' => $snCategoryCounter+1,
                                'NewsCategoryId' => $saNewsCategory['NewsCategoryId'],
                                'NewsCategoryName' => $saNewsCategory['NewsCategoryName'],
                                'Checked' => $snUserPreferenceCategoryFlag,
                                'NewsSubCategory' => $NewsSubCategory1,
                            );                            
                            $snCategoryCounter++;
                        }
                        
                        $response['SubjectList'] = $NewsCategory;
                        $response['Success'] = array('Subject listed successfully!!!');
                        User::model()->showresponse($response);
                        exit;
                    } else {
                        $response['Error'] = array('No Subject Found!!!');
                        User::model()->showresponse($response);
                        exit;
                    }
                } else {
                    $response['Error'] = array('Invalid UserId!!!');
                    User::model()->showresponse($response);
                    exit;
                }
            } else {
                $response['Error'] = array('Invalid Request Parameter!!!');
                Category::model()->showresponse($response);
                exit;
            }
        }
    }

    /**
     * Created By : Inheritx
     * Created Date : 09 August 2013
     * Description : Save User Preference.
     */
    public function actionSaveUserPreference() {
        $smData = User::model()->getAPIDataStruct();
        $response = array();
        if (isset($smData['request']['params']) && !empty($smData['request']['params'])) {
            $smRequestData = $smData['request']['params'];
            if ($smRequestData['UserId']) {
                $snUserId = $smRequestData['UserId'];
                //check whether UserId exist or Not in database
                $saUserDetails = User::model()->find('UserId="' . $snUserId . '"');
                if (isset($saUserDetails) && count($saUserDetails) > 0) {
                    if ($smRequestData['NewsCategoryId']) {
                        $snNewsCategoryId = $smRequestData['NewsCategoryId'];
                        $saUserPreferenceDetails = UserPreference::model()->deleteAll('UserId= "' . $snUserId . '" ');
                        
                        foreach ($snNewsCategoryId as $snUserPreferenceCategory => $snUserSubCategory) {                          
                            if (count($snUserSubCategory) > 0) {
                                foreach ($snUserSubCategory as $key => $snUserPreferenceSubCategory) {
                                    $model = new UserPreference();
                                    $model->UserId = $snUserId;
                                    $model->NewsCategoryId = $snUserPreferenceCategory;

                                    $NewsSubCategory1 = 0;
                                    if (!empty($snUserPreferenceSubCategory))
                                        $NewsSubCategory1 = $snUserPreferenceSubCategory;
                                    
                                    $model->NewsSubCategoryId = $NewsSubCategory1;
                                    $model->save();
                                }
                            }else {
                                $model = new UserPreference();
                                $model->UserId = $snUserId;
                                $model->NewsCategoryId = $snUserPreferenceCategory;
                                $model->NewsSubCategoryId = 0;
                                $model->save();
                            }
                        }
                        
                        $response['Success'] = "Successfully Inserted!!!";
                        User::model()->showresponse($response);
                        exit;
                    } else {
                        $response['Error'] = array('Invalid CategoryID!!!');
                        User::model()->showresponse($response);
                        exit;
                    }
                } else {
                    $response['Error'] = array('Invalid UserId!!!');
                    User::model()->showresponse($response);
                    exit;
                }
            } else {
                $response['Error'] = array('Invalid Request Parameter!!!');
                Category::model()->showresponse($response);
                exit;
            }
        }
    }

}

