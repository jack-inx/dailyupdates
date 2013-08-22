<?php

class Common {

    /** function updateCompositeField() 
     * for update respectively record into $ssTableName
     * @param string $ssTableName
     * @param string $ssFieldName
     * @param string $ssFieldValue
     * @param string $smCompareParam
     * @param int  $smCompareValue
     * return object
     */
    
    public static function updateCompositeField($ssTableName, $ssFieldName, $ssFieldValue, $smCompareParam, $smCompareValue) {

        $oCommand = Yii::app()->db->createCommand();
        $oCommand->update($ssTableName, array(
            $ssFieldName => $ssFieldValue,
                ), $smCompareParam . '=:' . $smCompareParam, array(':' . $smCompareParam => $smCompareValue));
        $oCommand->query();

        return $oCommand->execute();
    }

    public static function randomGeneratedCode($length) {
        $random = "";
        srand((double) microtime() * 1000000);

        $data = "AbcDE123IJKLMN67QRSTUVWXYZ";
        $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
        $data .= "0FGH45OP89";

        for ($i = 0; $i < $length; $i++) {
            $random .= substr($data, (rand() % (strlen($data))), 1);
        }
        return $random;
    }

    public static function upload_image($image_name, $field_name, $form_name) {
        if (isset($_FILES)) {
            if (array_key_exists($form_name, $_FILES)) {
                $uploaddir = Yii::getPathOfAlias('webroot') . '/uploads/profile/';
                $valid_formats = array("JPG", "JPEG", "jpg", "jpeg", "png", "gif", "bmp");
                //p($_FILES,0);
                $name = $_FILES["$form_name"]['name']["$field_name"];
                $size = $_FILES["$form_name"]['size']["$field_name"];
                $tmp = $_FILES["$form_name"]['tmp_name']["$field_name"];
                $image = $_FILES["$form_name"]['name']["$field_name"];
                //$file 	= $uploaddir.basename($_FILES['UserImages']['name']['img_name_2']);
                $file = $uploaddir . $image_name;
                move_uploaded_file($tmp, $file);
            }
        }
    }

    public static function createDirectory($ssName, $form_name) {
        $ssDirectoryPath = dirname(__FILE__) . DIRECTORY_SEPARATOR . '../../uploads/profile/';
        $ssDirectoryName = $ssDirectoryPath . $ssName;
        if (!file_exists($ssDirectoryName) && !is_dir($ssDirectoryName)) {
            mkdir($ssDirectoryName, 0777);
        }
    }

    public static function dropdownarray() {
        $data = PollFieldData::getPollFieldDatas('poll_sector');
        //$key = array_keys($data);
        foreach ($data as $key => $value) {

            $array[] = array('label' => $value, 'url' => array('user/survey', 'opt' => $key));
        }
        return $array;
    }

    public static function age_spouse_user() {
        for ($i = 15; $i <= 90; $i++) {
            $array[Yii::t('app', "$i")] = Yii::t('app', "$i");
        }
        return $array;
    }

    public static function child_user() {
        for ($i = 0; $i <= 10; $i++) {
            $array[Yii::t('app', "$i")] = Yii::t('app', "$i");
        }
        return $array;
    }

    public static function child_age() {
        for ($i = 1; $i <= 50; $i++) {
            $array[Yii::t('app', "$i")] = Yii::t('app', "$i");
        }
        return $array;
    }

    public static function base64UrlDecode($input) {
        return base64_decode(strtr($input, '-_', '+/'));
    }

    public static function getstatus($status) {
        if ($status == '1') {
            $value = 'Active';
        } else {
            $value = 'Inactive';
        }

        return $value;
    }

    public function age_count($start_date, $end_date, $user_date) {
        $age = date("Y") - $user_date;


        if ($age >= $start_date && $age <= $end_date) {
            $user_age = "Yes";
        } else {
            $user_age = "No";
        }
        return $user_age;
    }

    public function getReportsBySectorForClient($key, $flag = '', $client_id, $search = '') {
       
        if ($flag == 'purchase') {
            $sql = "SELECT t.report_purchase_id,t.sector_ids,t.client_id,t.category_ids,rpr.request_id,t.assigned_status,rm.publish_id,rm.report_title,rm.description,rm.report_id,rm.created_at,rm.added_file 
                        FROM report_purchase as t 
                        LEFT JOIN report_purchase_request as rpr ON t.report_purchase_id = rpr.report_purchase_id
                        LEFT JOIN report_master as rm ON rpr.report_id = rm.report_id
                        where t.assigned_status='yes' AND rpr.is_deleted='no' AND t.client_id= '" . $client_id . "' AND t.sector_ids like '%$key%'  AND (rm.report_title like '%$search%')";
            //p($sql,0);
            
        } elseif ($flag == 'archived') {
            $sql = "SELECT t.report_purchase_id,t.sector_ids,t.client_id,t.category_ids,rpr.request_id,t.assigned_status,rm.publish_id,rm.report_title,rm.description,rm.report_id,rm.created_at,rm.added_file 
              FROM report_purchase as t
              LEFT JOIN report_purchase_request as rpr ON t.report_purchase_id = rpr.report_purchase_id
              LEFT JOIN report_master as rm ON rpr.report_id = rm.report_id
              where t.assigned_status='yes' AND rpr.is_deleted='yes' AND t.client_id= '" . $client_id . "' AND t.sector_ids like '%$key%'   AND (  rm.report_title like '%$search%') ";
          
           
        } elseif ($flag == 'new') {
             $sql = "SELECT rm.* 
              FROM report_master rm
              WHERE rm.status = 1 AND FIND_IN_SET($key,rm.sector_ids)
              AND rm.report_id NOT IN(SELECT rpr.report_id FROM report_purchase_request rpr
              LEFT JOIN report_purchase rp
              ON rp.report_purchase_id = rpr.report_purchase_id
              WHERE  (rm.report_title like '%$search%') AND rp.client_id = '$client_id')"; 
            //p($sql);
        } elseif($flag == 'favourite' ){
            $sql = "
                SELECT t.report_purchase_id,t.sector_ids,t.client_id,t.category_ids,rpr.request_id,t.assigned_status,rm.publish_id,rm.report_title,rm.description,rm.report_id,rm.created_at,rm.added_file,fp.page_ids
                        FROM report_purchase as t 
                        LEFT JOIN report_purchase_request as rpr ON t.report_purchase_id = rpr.report_purchase_id
                        LEFT JOIN report_master as rm ON rpr.report_id = rm.report_id
                        LEFT JOIN favorite_pages as fp ON fp.report_id = rm.report_id
                        WHERE t.assigned_status='yes' AND rpr.is_deleted='no' AND t.client_id= '" . $client_id . "' AND fp.flag = '1' AND t.sector_ids like '%$key%'  AND (rm.report_title like '%$search%')";
        
            //p($sql);
        }else {
            $sql = "SELECT t.report_id,t.sector_ids,t.category_ids,t.report_title,t.description,rpr.request_id ,t.created_at
                        FROM report_master as t LEFT OUTER JOIN report_purchase_request as rpr ON  t.report_id = rpr.report_id
                        WHERE t.sector_ids like '%$key%' AND rpr.report_id IS NULL GROUP BY t.report_id";
        }
        $connection = Yii::app()->db;
            $command = $connection->createCommand($sql);
            $dataSet = $command->queryAll();
        return $dataSet;
    }

    public static function TotalParentQuetions($poll_id){
          $sql = "SELECT count(survey_id) as total_parentquetions FROM `survey_question_master` WHERE survey_id = '$poll_id' &&  parent_option_id IS NULL";
          $parentQuetionTotal = Yii::app()->db->createCommand($sql)->queryRow();
           $total =  $parentQuetionTotal['total_parentquetions'] - 1;
          return  $total;
    }
     public static function TotalParentChildQuetions($poll_id,$parent_quetion_id){
          $sql = "SELECT count(survey_id) as total_childquetions FROM `survey_question_master` WHERE survey_id = '$poll_id' &&  parent_option_id ='$parent_quetion_id'";
          $childQuetionTotal = Yii::app()->db->createCommand($sql)->queryRow();
          $total = $childQuetionTotal['total_childquetions'];
          return  $total;
    }
    
    public static function GetProgressBarValue($poll_id,$user_id,$request)
    {        
        $sql = "SELECT count(survey_question_id) as total_question FROM survey_question_master where survey_id='".$poll_id."' AND parent_option_id IS NULL";
        $totalQuetions = Yii::app()->db->createCommand($sql)->queryRow();
        $totalOfQuestion = $totalQuetions['total_question'];
        
        if(array_key_exists('answer_id',$request)){
           $optionIdArr = explode(",",$request['answer_id']); $tmpOptionsArr = array();
           if(count($optionIdArr) > 1){
               foreach($optionIdArr as $_option){
                   $sql = "SELECT count(survey_question_id) as total_child_question FROM survey_question_master where survey_id='".$poll_id."' AND parent_option_id = '".$_option."'";
                   $totalChildQuetions = Yii::app()->db->createCommand($sql)->queryRow();
                   $totalOfQuestion = $totalOfQuestion + $totalChildQuetions['total_child_question'];
               }
           }else{
                $answer_id = $request['answer_id'];
                $sql = "SELECT count(survey_question_id) as total_child_question FROM survey_question_master where survey_id='".$poll_id."' AND parent_option_id = '".$answer_id."'";
                $totalChildQuetions = Yii::app()->db->createCommand($sql)->queryRow();
                $totalOfQuestion = $totalOfQuestion + $totalChildQuetions['total_child_question'];
           }
        }
        echo $totalOfQuestion;
        $progress_bar = 0;
        if(array_key_exists('progress_count',$request)){
            $progress_bar = round(($request['progress_count'] / $totalOfQuestion) * 100 );
        }
        /*
        $sql = "SELECT count(survey_id) as total_quetions FROM `survey_question_master` WHERE survey_id = '$poll_id'";
        $totalQuetionTotal = Yii::app()->db->createCommand($sql)->queryRow();
        $totalQuetionTotal = $totalQuetionTotal['total_quetions'];
        $sqlPollTaker = "SELECT count(pta.answer_id) as totalanswerquetions FROM `poll_taker` as t
                         Left join poll_taker_answer as pta on pta.poll_taker_id = t.poll_taker_id
                         WHERE t.poll_id='$poll_id' AND t.user_id = '$user_id'";
        
        if(array_key_exists('progress_count',$request)){
            $totalQuetionTotal = $request['progress_count'];
        }

        $totalPollTaker = Yii::app()->db->createCommand($sqlPollTaker)->queryRow();
         $progress_bar = '0';
        if(isset($totalQuetionTotal) && (!empty($totalQuetionTotal))){
            if(isset($totalPollTaker) && (!empty($totalPollTaker))){
                $progress_bar = round(($totalPollTaker['totalanswerquetions'] / $totalQuetionTotal ) * 100 );
            }
        }*/
        echo $progress_bar;exit;
        return $progress_bar;
    }

    public static function SavePoll($data,$flag='')
    {
       // p($data);
        
        $ranking_order = '';
        $poll_id = $data['poll_id'];
        $user_id = $data['user_id'];
        $poll_taker = PollTaker::model()->find("poll_id= '$poll_id' AND user_id= '$user_id'");

        if (!isset($poll_taker->attributes)){
            $poll_taker = new PollTaker;
        }
     
        if($flag == "exit"){
            if(array_key_exists('child_offset',$data)){
                $poll_taker->current_offset = $data['child_offset'];
                $poll_taker->current_option_id = $data['option_id'];
                $poll_taker->is_parent 	 = $data['is_parent'];
                $poll_taker->progress_count 	 = $data['progress_count'];
                $poll_taker->previous_parent_offset  = $data['progress_bar_total'];
            }else{
                $poll_taker->current_offset = $data['parent_offset'];
                $poll_taker->is_parent 	 = $data['is_parent'];
                $poll_taker->progress_count 	 = $data['progress_count'];
                $poll_taker->previous_parent_offset  = $data['progress_bar_total'];
            }
        }
       /* if(array_key_exists('parent_offset', $data)){
            $poll_taker->current_offset  = $data['parent_offset'];
            $poll_taker->current_option_id   = $data['parent_option_id'];
            $poll_taker->is_parent = 'yes';
        }
        if(array_key_exists('child_offset', $data)){
            $poll_taker->current_offset  =  $data['child_offset'];
            $poll_taker->current_option_id   = $data['parent_option_id'];
            $poll_taker->is_parent = 'no';
        }*/
        $poll_taker->user_id = $user_id;
        $poll_taker->poll_id = $poll_id;

        if(array_key_exists('iscompleted',$data)){
            if ($data['iscompleted'] == 'yes'){
                $user_data = User::model()->find("user_id=" . $user_id . "");
                $poll_data = SurveyMaster::model()->find("survey_id =" . $poll_id . "");
                $points = $user_data->points;
                $user_data->points = $points + $poll_data->points;
                $user_data->save(false);
                $poll_taker->flag = 1;
            }else
                $poll_taker->flag = 0;
        }
        $poll_taker->save(false);
        
        $poll_taker_id = $poll_taker->poll_taker_id;
         if(array_key_exists('quetion_id',$data)){
             $question_id = $data['quetion_id'];
         }
         if(array_key_exists('answer_id',$data)){
              $option_id = $data['answer_id'];
         }
        
         // start code 
         if(array_key_exists('ranking_order_string',$data)){
              $ranking_order = $data['ranking_order_string'];
         }
          // end code
        
        

        $poll_taker_ans = PollTakerAnswer::model()->find("poll_taker_id= " . $poll_taker['poll_taker_id'] . " AND poll_id= '$poll_id' AND question_id= '$question_id'");
        if (!isset($poll_taker_ans->attributes))
            $poll_taker_ans = new PollTakerAnswer;

        $poll_taker_ans->poll_id = $poll_id;
        $poll_taker_ans->poll_taker_id = $poll_taker_id;
        $poll_taker_ans->question_id = $question_id;
        $poll_taker_ans->option_id = $option_id;
        
        // start code
        $poll_taker_ans->ranking_order = $ranking_order;
        // end code
        
        if(array_key_exists('other_option',$data)){
            $poll_taker_ans->other_option = $data['other_option'];
        }    
        $poll_taker_ans->save(false);

     return TRUE;
        
    }
    
    
    /**
     * function: errorResponse()
     * For generate array for error response.
     * @return array $amResponse
     */
    public static function errorResponse($ssErrorMessage) {
        $amResponse = array('success' => 0, 'message' => $ssErrorMessage);
        return $amResponse;
    }

    /**
     * function: successResponse()
     * For generate array for success response.
     * @return array $amResponse
     */
    public static function successResponse($ssSuccessMessage, $amReponseParam = array()) {
        $amResponse = array('IsSuccess' => 1, 'message' => $ssSuccessMessage, 'data' => $amReponseParam);
        return $amResponse;
    }
    
     /**
     * function: encodeResponseJSON()
     * For generate random number
     * @param array $amResponse 
     * @return object JSON
     */
    public static function encodeResponseJSON($amResponse) {
        header('Content-type:application/json');
        echo CJSON::encode($amResponse);
        Yii::app()->end();
    }
    
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
    
    /**
     * function: sendMail()
     * For send apple push notification.
     * @param string $ssToEmail
     * @param string $asFromEmail 
     * @param string $ssSubject
     * @param string $ssBody
     */
    
    public static function sendMail($ssToEmail, $asFromEmail, $ssSubject, $ssBody) {
        $omMessage = new YiiMailMessage;

        $omMessage->setTo($ssToEmail);
        $omMessage->setFrom($asFromEmail);
        $omMessage->setSubject($ssSubject);
        $omMessage->setBody($ssBody, 'text/html', 'utf-8');

        $bMailStatus = Yii::app()->mail->send($omMessage);

        return $bMailStatus;
    }
    
}

