<?php

//error_reporting(E_ALL);
//ini_set("display_errors", 1);
if (substr(phpversion(), 0, 1) != '6')
    error_reporting(E_ALL);
else
    error_reporting(E_ALL & ~E_STRICT);

// change the following paths if necessary
$yii = dirname(__FILE__) . '/yii1113/framework/yii.php';
$config = dirname(__FILE__) . '/protected/config/main.php';
$inx = dirname(__FILE__) . '/inx.php';
// remove the following line when in production mode
// defined('YII_DEBUG') or define('YII_DEBUG',true);

require_once($yii);
require_once($inx);
Yii::createWebApplication($config)->run();
