<?php

Yii::import('application.models.User._base.BaseUser');

class User extends BaseUser {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * Created By : Inheritx
     * Created Date : 29 July 2013
     * Description : get system date and time
     */
    public function getCurrentDateTime() {
        $connection = Yii::app()->db; // assuming you have configured a "db" connection
        $sql = 'select NOW() as date';
        $dataReader = $connection->createCommand($sql)->query();
        $smDateArray = $dataReader->read();
        $smDate = $smDateArray['date'];

        return $smDate;
    }

    /**
     * Created By : Inheritx
     * Created Date : 05 August 2013
     * Description : Show api response
     */
    public function showresponse($response) {
// p($response);
        header('Content-type:application/json');
        echo json_encode($response);
        exit;
    }

    /**
     * Created By : Inheritx
     * Created Date : 05 August 2013
     * Description : function: base64UrlDecode()
     * For decode data into base64 method
     * @param $input
     * @return string decoded data
     */
    public static function base64UrlDecode($input) {
        return base64_decode(strtr($input, '-_', '+/'));
    }

    /**
     * Created By : Inheritx
     * Created Date : 05 August 2013
     * Description : For GET/POST State List Webservices Ends
     */
    public function getAPIDataStruct() {
        $status = 200;
//$body = '';
        $content_type = 'text/json';
        $status_header = 'HTTP/1.1 ' . $status . ' ';
        header($status_header);
        header('Content-type: ' . $content_type);
//$request = array();

        if (Yii::app()->request->getRequestType() == 'GET') {
            $params = $_GET;
        } else if (Yii::app()->request->getRequestType() == 'POST') {
            $post = file_get_contents("php://input");
            $params = json_decode($post, true);
        } else if (Yii::app()->request->getRequestType() == 'REQUEST') {
            $params = $_REQUEST;
        }

        $request = array(
            'request' => array(
                'method' => Yii::app()->request->getPathInfo(),
                'params' => $params,
            ),
            'response' => array('success' => '0', 'error' => array())
        );
        return $request;
    }

    /**
     * Created By : Inheritx
     * Created Date : 05 August 2013
     * Description : get user details
     */
    public function showUserDetails($UserId) {
        $response = array();
        $saRegisteredUserDetail = User::model()->find('UserId="' . $UserId . '"');
        if (isset($saRegisteredUserDetail) && !empty($saRegisteredUserDetail)) {
            $saUserDetails = UserDetails::model()->find('UserId="' . $UserId . '"');

            $ssConnection = Yii::app()->db;
            $ssUserPreferenceSql = 'SELECT up.NewsCategoryId, up.NewsSubCategoryId, nc.NewsCategoryName, nsc.NewsSubCategoryName FROM UserPreference AS up LEFT JOIN NewsCategory AS nc ON nc.NewsCategoryId = up.NewsCategoryId LEFT JOIN  NewsSubCategory AS nsc ON nsc.NewsSubCategoryId = up.NewsSubCategoryId WHERE up.UserId = "' . $UserId . '" AND nc.Status = "Active" AND nsc.Status = "Active" ORDER BY nc.NewsCategoryName ASC';

            $obUserPreferenceCommand = $ssConnection->createCommand($ssUserPreferenceSql);
//$snRowCount = $obGroupUserCommand->execute(); // execute the non-query SQL
            $saUserPreference = $obUserPreferenceCommand->query(); // execute a query SQL


            $saUserData['UserId'] = $saRegisteredUserDetail->UserId;
            $saUserData['Email'] = $saRegisteredUserDetail->Email;
            $snCityId = $saUserDetails->City;
            $snStateId = $saUserDetails->State;
            $snCountryId = $saUserDetails->Country;

            $saUserData['EducationLevel'] = $saUserDetails->EducationLevel;
            $saUserData['AnnualIncome'] = $saUserDetails->AnnualIncome;
            $saUserData['EmploymentField'] = $saUserDetails->EmploymentField;
            $saUserData['LanguageOne'] = $saUserDetails->LanguageOne;
            $saUserData['LanguageTwo'] = $saUserDetails->LanguageTwo;

            if (isset($saUserPreference) && !empty($saUserPreference)) {
                $snUserPreferenceCounter = 0;
                foreach ($saUserPreference AS $UserPref) {
                    $saUserData['UserPreference'][$snUserPreferenceCounter]['NewsCategoryId'] = $UserPref['NewsCategoryId'];
                    $saUserData['UserPreference'][$snUserPreferenceCounter]['NewsCategoryName'] = $UserPref['NewsCategoryName'];
                    $saUserData['UserPreference'][$snUserPreferenceCounter]['NewsSubCategoryId'] = $UserPref['NewsSubCategoryId'];
                    $saUserData['UserPreference'][$snUserPreferenceCounter]['NewsSubCategoryName'] = $UserPref['NewsSubCategoryName'];
                    $snUserPreferenceCounter++;
                }
            }

            $response['UserDetails'] = $saUserData;
        } else {
            $response['Error'] = 'User does not exist!!!';
        }

        return $response;
    }

    /**
     * Created By : Inheritx
     * Created Date : 09 August 2013
     * Description : Delete all users
     */
    public function removeSelectedUsers($anUserIds) {
        UserDetails::model()->deleteAll('UserId IN(' . implode(',', $anUserIds) . ')');
        UserPreference::model()->deleteAll('UserId IN(' . implode(',', $anUserIds) . ')');
        $bDeleted = User::model()->deleteAll('UserId IN(' . implode(',', $anUserIds) . ')');
        return $bDeleted;
    }

    /**
     * Created By : Inheritx
     * Created Date : 09 August 2013
     * Description : Change status to active/inactive of all users
     */
    public function changeStatusSelectedUsers($anStatusIds, $anStatusType = 'Active') {
        $connection = Yii::app()->db;
        $snUserId = @implode(',',$anStatusIds);
        $sql = 'UPDATE User SET Status ="'.$anStatusType.'" WHERE UserType <> "admin" AND UserId IN ('.$snUserId.')';
        $command = $connection->createCommand($sql);
        //p($command);
        $command->execute();
        return true;
    }
    
    /**
     * Created By : Inheritx
     * Created Date : 13 August 2013
     * Description : Generate 7 character password.
     */
    public function generatePassword() {
        $length = 7;
        $strength = 0;
        $vowels = 'aeuy';
        $consonants = 'bdghjmnpqrstvz';
        if ($strength & 1) {
            $consonants .= 'BDGHJLMNPQRSTVWXZ';
        }
        if ($strength & 2) {
            $vowels .= "AEUY";
        }
        if ($strength & 4) {
            $consonants .= '23456789';
        }
        if ($strength & 8) {
            $consonants .= '@#$%';
        }

        $password = '';
        $alt = time() % 2;
        for ($i = 0; $i < $length; $i++) {
            if ($alt == 1) {
                $password .= $consonants[(rand() % strlen($consonants))];
                $alt = 0;
            } else {
                $password .= $vowels[(rand() % strlen($vowels))];
                $alt = 1;
            }
        }
        return $password;
    }
    
    /**
     * Created By : Inheritx
     * Created Date : 13 August 2013
     * Description : Encrypt Password.
     */
    public static function encrypting($string = "") {
        //$hash = Yii::app()->getModule('api')->hash;
        $hash = "md5";
        if ($hash == "md5")
            return md5($string);
        if ($hash == "sha1")
            return sha1($string);
        else
            return hash($hash, $string);
    }


}