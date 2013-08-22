<?php

class UserController extends Controller {

    /**
     * Created By : Inheritx
     * Created Date : 07 August 2013
     * Description : Login of User.
     */
    //-----------User Login----------------------------------
    public function actionLogin() {
        $smData = User::model()->getAPIDataStruct();
        $response = array();
        if (!empty($smData['request']['params'])) {
            $smRequestData = $smData['request']['params'];
            ///// Check Email exist or not /////
            if (empty($smRequestData['Email'])) {
                $response['Error'] = array('Email cannot be blank!!!');
                User::model()->showresponse($response);
                exit;
            } else if (!empty($smRequestData['Email'])) {
                $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
                // Run the preg_match() function on regex against the email address
                if (preg_match($regex, $smRequestData['Email'])) {
                    //check whether email exist in database
                    $saUserDetails = User::model()->find('Email="' . $smRequestData['Email'] . '"');
                    if (isset($saUserDetails) && count($saUserDetails) > 0) {
                        //do nothing
                    } else {
                        //email does not exist
                        $response['Error'] = array('Email does not exist in database!!!');
                        User::model()->showresponse($response);
                        exit;
                    }
                } else {
                    $response['Error'] = array('Invalid Email!!!');
                    User::model()->showresponse($response);
                    exit;
                }
            }

            ///// Check Password is correct or not /////
            if (empty($smRequestData['Password'])) {
                $response['Error'] = array('Password cannot be blank!!!');
                User::model()->showresponse($response);
                exit;
            } else {

                $saUserDetails = User::model()->find('Email = "' . $smRequestData['Email'] . '"');
                //p($saUserDetails->attributes);
                if (!empty($saUserDetails)) {
                    //p($saUserDetails);
                    $smSavedPassword = $saUserDetails->Password;
                    $password = $smRequestData['Password'];
                    $encPassword = Yii::app()->getModule('admin')->encrypting($password);
                    if ($encPassword == $smSavedPassword) {
                        //p($saUserDetails->attributes );
                        $response['Success'] = array('Login Successfully!!!');
                        $response['UserDetails'] = $saUserDetails->attributes;
                        User::model()->showresponse($response);
                        exit;
                    } else {
                        $response['Error'] = array('Invalid Password!!!');
                        User::model()->showresponse($response);
                        exit;
                    }
                } else {
                    $response['Error'] = array('No Record Found!!!');
                    User::model()->showresponse($response);
                    exit;
                }
            }
        } else {
            $response['Error'] = array('Invalid Request Parameter!!!');
            User::model()->showresponse($response);
            exit;
        }
        User::model()->showresponse($response);
        exit;
    }

    /**
     * Created By : Inheritx
     * Created Date : 07 August 2013
     * Description : Registration of User.
     */
    //-----------Register new user----------------------------------
    public function actionRegister() {
        $smData = User::model()->getAPIDataStruct();
        $response = array();
        if (isset($smData['request']['params']) && !empty($smData['request']['params'])) {
            $smRequestData = $smData['request']['params'];
            ///// Check Email exist or not /////
            $ssEmail = '';
            if (empty($smRequestData['Email'])) {
                //p($smRequestData);
                $response['Error'] = array('Email cannot be blank!!!');
                User::model()->showresponse($response);
                exit;
            } else if (!empty($smRequestData['Email'])) {
                //p($smRequestData);
                $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
                // Run the preg_match() function on regex against the email address
                if (preg_match($regex, $smRequestData['Email'])) {
                    //check whether email exist in database
                    $saUserDetails = User::model()->find('Email="' . $smRequestData['Email'] . '"');
                    if (isset($saUserDetails) && count($saUserDetails) > 0) {
                        //do nothing
                        //email does not exist
                        $response['Error'] = array('Entered Email is already exists!!!');
                        User::model()->showresponse($response);
                        exit;
                    } else {
                        $ssEmail = $smRequestData['Email'];
                    }
                } else {
                    $response['Error'] = array('Invalid Email!!!');
                    User::model()->showresponse($response);
                    exit;
                }
            }

            ///// Check UserName exist or not /////            
            $saEmailArr = @explode('@', $ssEmail);
            $ssUsername = $saEmailArr[0];


            if (empty($response)) {
                // Insert new user details
                $obUser = new User();
                $obUser->setAttributes($smRequestData);
                $password = $smRequestData['Password'];
                $encPassword = Yii::app()->getModule('admin')->encrypting($password);
                $obUser->Password = $encPassword;
                $obUser->UserName = $ssUsername;
                $obUser->Status = 'Active';
                $obUser->InsertedDate = User::model()->getCurrentDateTime();
                $obUser->save(false);

                $obUserDetails = new UserDetails();
                $obUserDetails->UserId = $obUser->UserId;
                $obUserDetails->save(false);


                $response = User::model()->showUserDetails($obUser->UserId);
                $response['Success'] = array('Registered Successfully!!!');
                User::model()->showresponse($response);
                exit;
            }
        } else {
            $response['Error'] = array('Invalid Request Parameter!!!');
            User::model()->showresponse($response);
            exit;
        }
        User::model()->showresponse($response);
        exit;
    }

    /**
     * Created By : Inheritx
     * Created Date : 09 August 2013
     * Description : Update User Profile.
     */
    //-----------Update Profile----------------------------------
    public function actionUpdateUserProfile() {
        $smData = User::model()->getAPIDataStruct();
        $response = array();
        if (isset($smData['request']['params']) && !empty($smData['request']['params'])) {
            $smRequestData = $smData['request']['params'];
            ///// Check Email exist or not /////
            $ssEmail = '';
            if ($smRequestData['UserId']) {
                $snUserId = $smRequestData['UserId'];
                //check whether UserId exist or Not in database
                $saUser = User::model()->find('UserId="' . $snUserId . '"');
                if (isset($saUser) && count($saUser) > 0) {
                    if (empty($smRequestData['Email'])) {
                        $response['Error'] = array('Email cannot be blank!!!');
                        User::model()->showresponse($response);
                        exit;
                    } else if (!empty($smRequestData['Email'])) {
                        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
                        // Run the preg_match() function on regex against the email address
                        if (preg_match($regex, $smRequestData['Email'])) {
                            //check whether email exist in database
                            $saUser = User::model()->find('Email="' . $smRequestData['Email'] . '"');
                            if (isset($saUser) && count($saUser) > 0) {
                                //do nothing
                                //email does not exist
                                $response['Error'] = array('Entered Email is already exists!!!');
                                User::model()->showresponse($response);
                                exit;
                            } else {
                                $ssEmail = $smRequestData['Email'];
                            }
                        } else {
                            $response['Error'] = array('Invalid Email!!!');
                            User::model()->showresponse($response);
                            exit;
                        }
                    }
                    $saEmailArr = @explode('@', $ssEmail);
                    $ssUsername = $saEmailArr[0];
                    if (empty($response)) {
                        // Insert user details
                        $saUser = User::model()->find('UserId="' . $snUserId . '"');
                        $saUser->Email = $smRequestData['Email'];
                        $saUser->Gender = $smRequestData['Gender'];
                        $saUser->BirthDate = $smRequestData['BirthDate'];
                        /* $password = $smRequestData['Password'];
                          if ($password != "") {
                          $encPassword = Yii::app()->getModule('admin')->encrypting($password);
                          $saUser->Password = $encPassword;
                          } */
                        $saUserDetails = UserDetails::model()->find('UserId="' . $snUserId . '"');
                        if (isset($saUserDetails)) {
                            $saGetState->countryid = $smRequestData['countryid'];
                            $saGetCity->stateid = $smRequestData['stateid'];
                            $saUserDetails->EducationLevel = $smRequestData['EducationLevel'];
                            $saUserDetails->AnnualIncome = $smRequestData['AnnualIncome'];
                            $saUserDetails->EmploymentField = $smRequestData['EmploymentField'];
                            $saUserDetails->LanguageOne = $smRequestData['LanguageOne'];
                            $saUserDetails->LanguageTwo = $smRequestData['LanguageTwo'];
                            $saUserDetails->save(false);
                        }
                        $saUser->save(false);
                        $response['Success'] = array('User Profile Update Successfully!!!');
                        User::model()->showresponse($response);
                        exit;
                    }
                } else {
                    $response['Error'] = array('User Id Does Not Exist!!!');
                    User::model()->showresponse($response);
                    exit;
                }
            } else {
                $response['Error'] = array('Invalid User ID!!!');
                User::model()->showresponse($response);
                exit;
            }
        } else {
            $response['Error'] = array('Invalid Request Parameter!!!');
            User::model()->showresponse($response);
            exit;
        }
        User::model()->showresponse($response);
        exit;
    }

    /**
     * Created By : Inheritx
     * Created Date : 12 August 2013
     * Description : Update Country , State , City Of User.
     */
    //-----------Update Country , State , City----------------------------------
    public function actionGetCountry() {
        $smData = User::model()->getAPIDataStruct();
        $response = array();
        $responseData = array();
        if (!empty($_REQUEST['countryid'])) {
            $saGetState = States::model()->findAll('CountryID="' . $_REQUEST['countryid'] . '"');
            foreach ($saGetState as $key => $value) {
                $responseData[] = array(
                    'StateId' => $value['StateId'],
                    'StateName' => $value['StateName'],
                );
            }
        } elseif (!empty($_REQUEST['stateid'])) {
            $saGetCity = Cities::model()->findAll('StateID="' . $_REQUEST['stateid'] . '"');
            foreach ($saGetCity as $key => $value) {
                $responseData[] = array(
                    'CityId' => $value['CityID'],
                    'CityName' => $value['CityName'],
                );
            }
        } else {
            $saGetCountry = Countries::model()->findAll();
            foreach ($saGetCountry as $key => $value) {
                $responseData[] = array(
                    'CountryId' => $value['CountryId'],
                    'CountryName' => $value['CountryName'],
                );
            }
        }
        $response = $responseData;
        User::model()->showresponse($responseData);
        exit;
    }

    /**
     * Created By : Inheritx
     * Created Date : 12 August 2013
     * Description : Show User Profile Date.
     */
    //-----------Show User Profile Date----------------------------------

    public function actionShowUserProFileData() {
        $smData = User::model()->getAPIDataStruct();
        $response = array();
        if (isset($smData['request']['params']) && !empty($smData['request']['params'])) {
            $smRequestData = $smData['request']['params'];
            //p($smRequestData);
            ///// Check UserId exist or not /////
            if ($smRequestData['UserId']) {
                $snUserId = $smRequestData['UserId'];
                //check whether UserId exist or Not in database
                $saUser = User::model()->find('UserId="' . $snUserId . '"');

                $response = User::model()->showUserDetails($snUserId);
                User::model()->showresponse($response);
                exit;
            } else {
                $response['Error'] = array('Invalid User ID!!!');
                User::model()->showresponse($response);
                exit;
            }
        } else {
            $response['Error'] = array('Invalid Request Parameter!!!');
            User::model()->showresponse($response);
            exit;
        }
        User::model()->showresponse($response);
        exit;
    }

    /**
     * Created By : Inheritx
     * Created Date : 13 August 2013
     * Description : Forgot password.
     */
    //-----------Forgot password----------------------------------
    public function actionForgotPassword() {
        $smData = User::model()->getAPIDataStruct();
        //p($smData);
        $response = array();
        if (isset($smData['request']['params']) && !empty($smData['request']['params'])) {
            $smRequestData = $smData['request']['params'];
            ///// Check Email exist or not /////
            if (empty($smRequestData['Email'])) {
                $response['Error'] = array('Email cannot be blank!!!');
                User::model()->showresponse($response);
                exit;
            } else if (!empty($smRequestData['Email'])) {
                //check whether email exist in database
                $saUserDetails = User::model()->find('Email="' . $smRequestData['Email'] . '"');
                if (isset($saUserDetails) && count($saUserDetails) > 0) {
                    $ssEmail = $smRequestData['Email'];
                    $pwd = User::generatePassword();
                    $ssSubject = 'Forgot Password';
                    $content = "<p> Please find the following password</p>";
                    $content.="<span>Password: $pwd</span> <br/>";
                    $content.="<span>Go into your account and reset your password.!</span>";
                    $ssBody = $content;
                    Common::sendMail($ssEmail, array(Yii::app()->params['adminEmail'] => Yii::app()->params['adminEmail']), $ssSubject, $ssBody);
                    $Npwd = Yii::app()->getModule('admin')->encrypting($pwd);
                    $user = User::model()->find("Email='$ssEmail' and UserType = 'user' ");
                    $arr = array('Password' => $Npwd);
                    $user->attributes = $arr;
                    $user->save(false);
                    $response['Success'] = array('Message Successfuly send!!!');
                    User::model()->showresponse($response);
                    exit;
                } else {
                    $response['Error'] = array('EmailId Does Not Exist!!!');
                    User::model()->showresponse($response);
                    exit;
                }
            }
        } else {
            $response['Error'] = array('Invalid Request Parameter!!!');
            User::model()->showresponse($response);
            exit;
        }
        User::model()->showresponse($response);
        exit;
    }

}