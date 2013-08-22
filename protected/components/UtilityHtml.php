<?php

class UtilityHtml extends CHtml
{

    /**
     * Displays a summary of validation errors for one or several models.
     * @param mixed $model the models whose input errors are to be displayed. This can be either
     * a single model or an array of models.
     * @param string $header a piece of HTML code that appears in front of the errors
     * @param string $footer a piece of HTML code that appears at the end of the errors
     * @param array $htmlOptions additional HTML attributes to be rendered in the container div tag.
     * This parameter has been available since version 1.0.7.
     * A special option named 'firstError' is recognized, which when set true, will
     * make the error summary to show only the first error message of each attribute.
     * If this is not set or is false, all error messages will be displayed.
     * This option has been available since version 1.1.3.
     * @return string the error summary. Empty if no errors are found.
     * @see CModel::getErrors
     * @see errorSummaryCss
     */
    public static function errorSummary($model,$header=null,$footer=null,$htmlOptions=array())
    {
        $content='';
        if(!is_array($model))
        $model=array($model);
        if(isset($htmlOptions['firstError']))
        {
            $firstError=$htmlOptions['firstError'];
            unset($htmlOptions['firstError']);
        }
        else
        $firstError=false;
        foreach($model as $m)
        {
            foreach($m->getErrors() as $errors)
            {
                foreach($errors as $error)
                {
                    if($error!='')
                    $content.="<li>$error</li>\n";
                    if($firstError)
                    break;
                }
            }
        }
        if($content!=='')
        {
            if($header===null)
            $header='<p>We\'re sorry, we are not able to process your request because of following errors.<BR> Please rectify them:</p>';
            if(!isset($htmlOptions['class']))
            $htmlOptions['class']=self::$errorSummaryCss;
            return parent::tag('div',$htmlOptions,$header."\n<ul>\n$content</ul>".$footer);
        }
        else
        return '';
    }

    public static function customErrorSummary($array=array(),$header=null,$footer=null,$htmlOptions=array())
    {
        $content='';

        foreach($array as $errors)
        {
            if(is_array($errors)) {
                foreach($errors as $error) {
                    if($error!='')
                    $content.="<li>$error</li>\n";
                }
            }else {
                if($errors!='')
                $content.="<li>$errors</li>\n";
            }
        }
        if($content!=='')
        {
            if($header===null)
            $header='<p>We\'re sorry, we are not able to process your request because of following errors.<BR> Please rectify them:</p>';
            if(!isset($htmlOptions['class']))
            $htmlOptions['class']=self::$errorSummaryCss;
            return parent::tag('div',$htmlOptions,$header."\n<ul>\n$content</ul>".$footer);
        }
        else
        return '';
    }
    public static function activeTimeField($model,$attribute,$htmlOptions=array())
    {
        // SET UP ARRAYS OF OPTIONS FOR DAY, MONTH, YEAR
        $x = 0;

        $hourOptions = array('0'=>' - ');
        while ($x < 24)
        {
            $hourOptions[$x] = (($x<10)?'0':'').$x;
            $x++;
        }

        $x = 0;
        $minuteOptions = array('0'=>' - ');
        while ($x < 61)
        {
            $minuteOptions[$x] = (($x<10)?'0':'').$x;
            $x++;
        }

        $x = 0;
        $secondOptions = array('0'=>' - ');
        while ($x < 61)
        {
            $secondOptions[$x] = (($x<10)?'0':'').$x;
            $x++;
        }

        $x = 1;
        $dayOptions = array('0'=>' - ');
        while ($x < 31)
        {
            $dayOptions[$x] = $x;
            $x++;
        }

        $monthOptions = array(
                '0' => ' - ',
                '1'=> UserModule::t('January'),
                '2'=> UserModule::t('February'),
                '3'=> UserModule::t('March'),
                '4'=> UserModule::t('April'),
                '5'=> UserModule::t('May'),
                '6'=> UserModule::t('June'),
                '7'=> UserModule::t('July'),
                '8'=> UserModule::t('August'),
                '9'=> UserModule::t('September'),
                '10'=> UserModule::t('October'),
                '11'=> UserModule::t('November'),
                '12'=> UserModule::t('December'),
        );

        $yearOptions = array('0'=>' - ');
        $x = 1901;
        while ($x < 2030)
        {
            $yearOptions[$x] = $x;
            $x++;
        }


        parent::resolveNameID($model,$attribute,$htmlOptions);

        if (is_array($model->$attribute)) {
            $arr = $model->$attribute;
            $model->$attribute = mktime($arr['hour'],$arr['minute'],$arr['second'],$arr['month'],$arr['day'],$arr['year']);
        }

        if ($model->$attribute != '0' && isset($model->$attribute))
        {
            //echo "<pre>"; print_r(date('Y-m-d',$model->$attribute)); die();
            // intval removes leading zero
            $day = intval(date('j',$model->$attribute));
            $month = intval(date('m',$model->$attribute));
            $year = intval(date('Y',$model->$attribute));

            $hour = intval(date('H',$model->$attribute));
            $minute = intval(date('i',$model->$attribute));
            $second = intval(date('s',$model->$attribute));
        } else
        {
            // DEFAULT TO 0 IF THERE IS NO DATE SET
            $day = intval(date('j',time()));
            $month = intval(date('m',time()));
            $year = intval(date('Y',time()));

            $hour = intval(date('H',time()));
            $minute = intval(date('i',time()));
            $second = intval(date('s',time()));
            /*
             $day = 0;
             $month = 0;
             $year = 0;
             $hour = 0;
             $minute = 0;
             $second = 0;//*/
        }

        $return  = parent::dropDownList($htmlOptions['name'].'[day]', $day,$dayOptions);
        $return .= parent::dropDownList($htmlOptions['name'].'[month]', $month,$monthOptions);
        $return .= parent::dropDownList($htmlOptions['name'].'[year]', $year,$yearOptions);
        $return .= ' Time:';
        $return .= parent::dropDownList($htmlOptions['name'].'[hour]', $hour,$hourOptions);
        $return .= parent::dropDownList($htmlOptions['name'].'[minute]', $minute,$minuteOptions);
        $return .= parent::dropDownList($htmlOptions['name'].'[second]', $second,$secondOptions);
        return $return;
    }

    public static function activeDateField($model,$attribute,$htmlOptions=array())
    {
        // SET UP ARRAYS OF OPTIONS FOR DAY, MONTH, YEAR
        $x = 1;
        $dayOptions = array('00'=>' - ');
        while ($x < 31)
        {
            $dayOptions[(($x<10)?'0':'').$x] = $x;
            $x++;
        }

        $monthOptions = array(
                '00' => ' - ',
                '01'=> UserModule::t('January'),
                '02'=> UserModule::t('February'),
                '03'=> UserModule::t('March'),
                '04'=> UserModule::t('April'),
                '05'=> UserModule::t('May'),
                '06'=> UserModule::t('June'),
                '07'=> UserModule::t('July'),
                '08'=> UserModule::t('August'),
                '09'=> UserModule::t('September'),
                '10'=> UserModule::t('October'),
                '11'=> UserModule::t('November'),
                '12'=> UserModule::t('December'),
        );

        $yearOptions = array('0000'=>' - ');
        $x = 1901;
        while ($x < 2030)
        {
            $yearOptions[$x] = $x;
            $x++;
        }


        parent::resolveNameID($model,$attribute,$htmlOptions);

        if ($model->$attribute != '0000-00-00' && isset($model->$attribute))
        {
            if (is_array($model->$attribute)) {
                $new = $model->$attribute;

                $day = $new['day'];
                $month = $new['month'];
                $year = $new['year'];

            } else {
                $new = explode('-',$model->$attribute);
                // intval removes leading zero
                $day = $new[2];
                $month = $new[1];
                $year = $new[0];
            }
        } else {
            // DEFAULT TO 0 IF THERE IS NO DATE SET
            $day = '00';
            $month = '00';
            $year = '0000';
        }

        //echo "<pre>"; print_r(array($day,$month,$year)); die();

        $return  = parent::dropDownList($htmlOptions['name'].'[day]', $day,$dayOptions);
        $return .= parent::dropDownList($htmlOptions['name'].'[month]', $month,$monthOptions);
        $return .= parent::dropDownList($htmlOptions['name'].'[year]', $year,$yearOptions);
        return $return;
    }
    public static function getCardTypes($htmlOptions=array(), $selected='')
    {
        $collection = array(
                'visa' => 'Visa',
                'MasterCard' => 'Master card',
                'AmericanExpress'=> 'American Express',
        );
        $htmlOptions['empty']= 'Card Type';
        return $return  = parent::dropDownList($htmlOptions['name'], $selected, $collection);
    }

    public static function getMonthField($htmlOptions=array(),$month='00')
    {
        // SET UP ARRAYS OF OPTIONS FOR DAY, MONTH, YEAR
        $monthOptions = array(
                '01'=> Yii::t('Shop','January'),
                '02'=> Yii::t('Shop','February'),
                '03'=> Yii::t('Shop','March'),
                '04'=> Yii::t('Shop','April'),
                '05'=> Yii::t('Shop','May'),
                '06'=> Yii::t('Shop','June'),
                '07'=> Yii::t('Shop','July'),
                '08'=> Yii::t('Shop','August'),
                '09'=> Yii::t('Shop','September'),
                '10'=> Yii::t('Shop','October'),
                '11'=> Yii::t('Shop','November'),
                '12'=> Yii::t('Shop','December'),
        );
        $htmlOptions['empty']= 'Month';
        if(!isset($htmlOptions['name'])) {
            $htmlOptions['name'] = 'month';
        }
        $return = parent::dropDownList($htmlOptions['name'], $month,$monthOptions, $htmlOptions);
        return $return;
    }

    public static function getYearField($minY, $maxY, $htmlOptions=array(), $year='')
    {
        //$yearOptions = array('0'=>' Year ');
        $x = $minY;
        while ($x < $maxY) {
            $yearOptions[$x] = $x;
            $x++;
        }
        $htmlOptions['empty']= 'Year';

        if(!isset($htmlOptions['name'])) {
            $htmlOptions['name'] = 'year';
        }
        $return = parent::dropDownList($htmlOptions['name'], $year,$yearOptions, $htmlOptions);
        return $return;
    }

    public static function getAsapField($htmlOptions=array(), $asap='ASAP')
    {
        $hList = array("00","01","02","03","04","05","06","07","08","09",10,11,12,13,14,15,16,17,18,19,20,21,22,23);
        $mList = array("00",15,30,45);

        $currentH = date('H');
        $currentM = date('i');

        $timeOptions = array();
        $flag=false;
        foreach($hList as $h) {
            foreach($mList as $m) {
                if($h%12==0) $timeOptions[$h.$m] = (((float)$h>=12)?('12:'.$m.'PM'):("12:".$m.'AM'));
                else $timeOptions[$h.$m] = (((float)$h>=12)?(((float)$h-12).':'.$m.'PM'):($h.":".$m.'AM'));
                if(((float)$currentH <= (float)$h) && (round($currentM / 15) == ($m/15)) && !$flag) {
                    $timeOptions['ASAP'] = 'ASAP';
                    //$asap = $currentH.$mList[round($currentM / 15)];
                    $flag=true;
                }
            }
        }
        if(!isset($htmlOptions['name'])) {
            $htmlOptions['name'] = 'asap';
        }

        $return = parent::dropDownList($htmlOptions['name'],$asap,  $timeOptions, $htmlOptions);
        return $return;
    }

    public static function getDeliveryTimeDropdown($htmlOptions=array(), $select='')
    {
        $timestamp = mktime();
        $day = date('Y/m/d', $timestamp);
        $dayStr = 'Today';

        $day1 = date('Y/m/d', mktime(0,0,0,date("m"),date("d")+1,date("Y")));
        $day1Str = 'Tomorrow'; //date('l', mktime(0,0,0,date("m"),date("d")+1,date("Y")));

        $day2 = date('Y/m/d', mktime(0,0,0,date("m"),date("d")+2,date("Y")));
        $day2Str = date('l', mktime(0,0,0,date("m"),date("d")+2,date("Y")));

        $day3 = date('Y/m/d', mktime(0,0,0,date("m"),date("d")+3,date("Y")));
        $day3Str = date('l', mktime(0,0,0,date("m"),date("d")+3,date("Y")));

        $dayOptions[$day]  = $dayStr;
        $dayOptions[$day1] = $day1Str;
        $dayOptions[$day2] = $day2Str;
        $dayOptions[$day3] = $day3Str;

        $return = parent::dropDownList($htmlOptions['name'], $select=0,$dayOptions, $htmlOptions);
        return $return;
    }

    public static function getTipDropdown($htmlOptions=array(), $select=0)
    {
        if(!isset($htmlOptions['name'])) {
                $htmlOptions['name'] = 'tip';
        }
        $estimatedTip 	= Cart::model ()->getEstimatedTipPrice();
        $totalPrice 	= Cart::model ()->getTotalPrice();

        $freq = 0.25;
        $dataOptions = array();
        $i=0;
        $flag=0;
        while($i<=$totalPrice) {
            $dataOptions[''.$i.''] = '+ '.Cart::model ()->priceFormat($i,1);
            if($select=='') {
                if($i>=$estimatedTip && $flag==0) {
                    if($select=='') {
                        $flag=1;
                        //$rem =  round(($estimatedTip - floor($estimatedTip)) / ($freq));
                        //$select=floor($estimatedTip) + ($rem * $freq);
                        $select = 0;
                    }
                }
            }
            $i+=0.25;
        }
        $return = parent::dropDownList($htmlOptions['name'], $select,$dataOptions, $htmlOptions);
        return $return;
    }
    public static function getCountryData($country='')
    {
        $CountryData = CountryMaster::model()->findAll(array('order'=>'countryName ASC'));
        $dataOptions = array(''=>'Select Country');
        foreach ($CountryData as $country) {
            $dataOptions[$country->id] = $country->countryName;
        }
        return $dataOptions;
    }

    public static function getCountryCodeData()
    {
        $CountryCodeData = CountryMaster::model()->findAll();
        $dataOptions = array(''=>'Select Country Code');
        foreach ($CountryCodeData as $country) {
            $dataOptions[$country->country_code] = $country->country_code;
        }
        return $dataOptions;
    }
    public static function getStateDropdown($htmlOptions=array(), $country='US', $select='')
    {
        $stateData = StateMaster::model()->findAll();
        $dataOptions = array(''=>'Select State');
        foreach ($stateData as $state) {
            $dataOptions[$state->state_code] = $state->state_code.' - '.$state->state;
        }
        $return = parent::dropDownList($htmlOptions['name'], $select,$dataOptions, $htmlOptions);
        return $return;
    }
    public static function getStateCodeData()
    {
        $StateCodeData = StateMaster::model()->findAll();
        $statecodedataOptions = array(''=>'Select State Code');
        foreach ($StateCodeData as $state) {
            $statecodedataOptions[$state->state_code] = $state->state_code;
        }
        return $statecodedataOptions;
    }
    public static function getStateData($country='')
    {
        $stateData = StateMaster::model()->findAll(array('order'=>'stateName ASC'));
        $statedataOptions = array(''=>'Select Province/State');
        foreach ($stateData as $state) {
            $statedataOptions[$state->id] = $state->stateName;
        }
        return $statedataOptions;
    }
    public static function getContinent($status='')
    {
        $stateData = ContinentMaster::model()->findAll(array('order'=>'continentName ASC'));
        $statedataOptions = array(''=>'Select Continent Name');
        foreach ($stateData as $state) {
            $statedataOptions[$state->id] = $state->continentName;
        }
        return $statedataOptions;
    }
    public static function formatStrToTime($time)
    {
        $str = $time;
        if(is_numeric($time)) {
            $array = str_split($time,2);
            if($array[0]>=12) $str=' PM'; else $str=' AM';
            if($array[0]==0) $array[0] = 12;
            $str = implode(':',$array). $str;
        }
        return $str;
    }
    public static function getSortByDropdown($htmlOptions=array(), $select='')
    {
        $dataOptions = array(
            'OPEN_NOW' => 'OPEN NOW', 
            //'OPEN_24_HOURS' => 'OPEN 24 HOURS',
            //'DISTANCE' => 'DISTANCE',
            'TOP_RATED' => 'TOP RATED',
            //'FREE_DELIVERY' => 'FREE DELIVERY'
        );
        $return = parent::dropDownList($htmlOptions['name'], $select,$dataOptions,$htmlOptions);
        return $return;
    }

    /*public static function getCurrentTime()
     {
        $return = (CURTIME() - 1);
        return $return;
    }*/

    public static function getSpecialOfferDropdown($htmlOptions=array(), $select='')
    {
        $dataOptions = array(
            'DISCOUNTS' => 'DISCOUNTS', 
            'SPECIAL_OFFRES' => 'SPECIAL OFFRES',
            'STUDENT_DISCOUNTS' => 'STUDENT DISCOUNTS');
        $return = parent::dropDownList($htmlOptions['name'], $select,$dataOptions,$htmlOptions);
        return $return;
    }

    public static function getIdetificationQuestionDropDown($htmlOptions=array(), $select='')
    {
        $dataOptions = array(
            '1'=>'What is your mother name?',
            '2' => 'What is your junior school name?', 
            '3' => 'What is your favorite animal?');
        $return = parent::dropDownList($htmlOptions['name'], $select,$dataOptions,$htmlOptions);
        return $return;
    }

    public static function getHearAboutUsDropDown($htmlOptions=array(), $select='')
    {
        $dataOptions = array(
                'search_engine' => 'Search engine', 
            'blog' => 'Blog', 
            'banner' => 'Banner', 
            'linkedin_facebook' => 'Linkedin/facebook', 
            'another_site' => 'Another site', 
            'magazine' => 'Magazine/newspaper', 
                'email' => 'Email', 
                'word_of_mouth' => 'Word of mouth', 
                'recruiter' => 'Recruiter', 
                'career_consultant' => 'Career consultant', 
                'other' => 'Other');
        $return = parent::dropDownList($htmlOptions['name'], $select,$dataOptions,$htmlOptions);
        return $return;
    }

    public static function getActionDropDown($htmlOptions=array(), $select='')
    {
        $dataOptions = array(
                'applied' => 'Applied', 
                'not_applied' => 'Not Applied');
        $return = parent::dropDownList($htmlOptions['name'], $select,$dataOptions,$htmlOptions);
        return $return;
    }




    public static function getDeliveryTypeControl($htmlOptions=array(),$type='radio')
    {
        $url=Yii::app()->request->baseUrl;
        $select = Cart::model()->getCartDataByKey('delivery_type');
        $data = array( 'Delivery'=>'<span class="d-info" style="margin-left: 5px">Delivery</span>',
                                   'Pickup' => '<span class="d-info" style="margin-left: 5px">Pickup</span>');

        if($type=='radio') {
            /*
             if(!Cart::model()->allowDelivery()) {
                    return  '<span class="d-info">Pickup</span>';
                    }
                    */
            $htmlOptions['onClick'] = "javascript:updateDeliveryType('$url/cart/UpdateCart', this);";
            return parent::radioButtonList('delivery_type', $select, $data, $htmlOptions);
        }elseif($type=='message') {
            if(Cart::model()->getDeliveryType()=='Pickup') {
                    return 'This order will be pickup.';
            }else{
                    return 'This order will be delivered.';
            }
        }else if($type=='popup_link') {
            return parent::link('Click Here','#',$htmlOptions);
            //return "<span class=\"why_span\" id=\"change_delivery_type\" onclick=\"javascript:updateDeliveryType('$url/index.php/cart/UpdateCart', this)\">Click Here</span>";
        } else {
            /*
             if(!Cart::model()->allowDelivery()) {
                return  '';//'Pickup';
            }
            */
            if(Cart::model()->getDeliveryType()=='Pickup') {
                $str = 'Change it to Delivery >>';
            }else{
                $str = 'Change it to Pickup >>';
            }
            return "<input type=\"hidden\" name=\"delivery_type\" id=\"delivery_type\" value=\"".Cart::model()->getDeliveryType()."\" />
            <!-- <a class=\"why\" id=\"change_delivery_type\" href=\"javascript:return false;\" 
            style=\"cursor: pointer\" onclick=\"javascript:updateDeliveryType('$url/cart/UpdateCart')\">".$str."</a> -->
            <span class=\"why_span\" id=\"change_delivery_type\" onclick=\"javascript:updateDeliveryType('$url/cart/UpdateCart', this)\">".$str."</span>";
        }
    }


    public static function getStatusImageIcon($status, $htmloptions='')
    {
        return CHTML::image(self::getStatusImage($status), $htmloptions);
    }

    public static function getStatusemail($status)
    {
        if($status==1 || strtolower($status)=='yes') {
            return 'Yes';
        }else {
            return 'No';
        }
    }
    public function getDefinedFaultType()
    {
        $definedStruct = array('1'=>'Active','0'=>'Inactive');
        $fault = EmailFormat::model();
        //m($user,0);
        preg_match('[enum\((.*)\)]',$fault->getTableSchema()->getColumn('status')->dbType,$matches);
        $type = array_values(explode(',',(str_replace('\'', '', $matches[1]))));
        $data = array();
        $data['']="All";
        foreach ($type as $value) {
            $data[$value] = $definedStruct[$value];
            //p($data[$value]);
        }

        return $data;
    }
    public function getFaultTypeLabel($key)
    {
        $faultType = $this->getDefinedFaultType();
        if(isset($faultType[$key])) return $faultType[$key];
    }
    public static function getStatus($status)
    {
        if($status == '1'){
            return 'Active';
        }else {
            return 'Inactive';
        }
    }

    public static function getStatusImage($status)
    {
        if($status==1 || strtolower($status)=='yes') {
            return Yii::app()->request->baseUrl.'/images/checked.png';
        }else {
            return Yii::app()->request->baseUrl.'/images/unchecked.png';
        }
    }

    public static function getStatusDetails($status)
    {			
        if($status=='Active' || strtolower($status)=='active') {
            return Yii::app()->request->baseUrl.'/images/checked.png';
        }else {
            return Yii::app()->request->baseUrl.'/images/unchecked.png';
        }
    }

    public static function getDefinedStatusType()
    {
        $definedStruct = array('1'=>'Active', '0'=>'Inactive');
        $fault = EmailFormat::model();
        //m($user,0);
        preg_match('[enum\((.*)\)]',$fault->getTableSchema()->getColumn('status')->dbType,$matches);
        $type = array_values(explode(',',(str_replace('\'', '', $matches[1]))));
        $data = array();
        foreach ($type as $value) {
            $data[$value] = $definedStruct[$value];
        }

        return $data;
    }
    public static function getStatusTypeLabel($key)
    {
        $statusType = self::getDefinedStatusType();
        if(isset($statusType[$key])) return $statusType[$key];
    }

    public static function getIAMuser($id='')
    {
        $IAmdata = IAmMaster::model()->findAll();
        /*
         if(!empty($id)){
            $im_arr_id = @explode(',',$id);
        }*/
        $IamOptions = array(''=>'--Select--');
        foreach ($IAmdata as $iam) {
            /*if(count($im_arr_id)>0){
                for($r=0;$r<count($im_arr_id);$r++){
                    if($im_arr_id[$r]==$iam->id){

                    }
                }
            }else{
                $IamOptions[$iam->id] = $iam->title;
            }*/
            $IamOptions[$iam->id] = $iam->title;
        }
        return $IamOptions;
    }
    /**
     * First arguement dataset
     * next arguement is sequence of n number variables
     */
    public static function getDataByKey()
    {
        $array = func_get_args(); //explode('.', $path);
        if(!empty($array)) {
            $data = array_shift($array);
            $str ='';
            $val = $data;
            foreach($array as $data) {
                $str .= '[\''.$data.'\']';
                if(!isset($val[$data])) return false;
                $val = $val[$data];
            }
            return $val;
        }else {
            return false;
        }
    }
}
