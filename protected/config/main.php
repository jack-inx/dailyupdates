<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Daily Updates',
    // preloading 'log' component
    'preload' => array('log', 'bootstrap'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'ext.giix-components.*', // giix components
        'ext.slajaxtabs.*', // giix components
        'application.extensions.fckeditor.FCKEditorWidget.*',
        'application.extensions.yii-mail.*', // Email Extension
        //'application.extensions.rss_feed_parser.*', // Rss Feed Parser Extension
        'application.modules.rights.*',
        'application.modules.rights.components.*',
        'application.extensions.yii-mail.*', // Email extension
    //'application.helpers.*',
    ),
    'defaultController' => 'index',
    'modules' => array(
        'rights' => array(
            'install' => true,
        ),
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'admin',
            /* 'generatorPaths' => array(
              'ext.giix-core', // giix generators
              ), */
            'generatorPaths' => array(
                'bootstrap.gii'  // giix generators  bootstrap
            ),
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
        //'rights'=>array( 'install'=>true,),
        'admin',
        'customer',
        'api',
    ),
    // application components
    'components' => array(
        'bootstrap' => array(
            'class' => 'ext.bootstrap.components.Bootstrap',
            'responsiveCss' => true,
        ),
        'user' => array(
            'class' => 'RWebUser',
            'allowAutoLogin' => true,
        ),
        'authManager' => array(
            'class' => 'RDbAuthManager',
        //  'language'=>'pt_br'
        ),
        'admin' => array(
            'allowAutoLogin' => true,
            'autoUpdateFlash' => true,
            'class' => 'AdminRWebUser',
            'loginUrl' => array('/admin/login'),
            'fullname' => '',
        ),
        'customer' => array(
            'allowAutoLogin' => true,
            'autoUpdateFlash' => true,
            'class' => 'CustomerRWebUser',
            'loginUrl' => array('/login/index'),
        ),
        
        // YiiMail Settings //        
        'mail' => array(
            'class' => 'application.extensions.yii-mail.YiiMail',
            'transportType' => 'smtp', /// case sensitive!
            'transportOptions' => array(
                'host' => 'mail.inheritx.com',
                'username' => 'client1@inheritx.com',
                'password' => 'client@123',
                'port' => '26',
            //'encryption'=>'ssl',
            ),
            'viewPath' => 'application.views.mail',
            'logging' => true,
            'dryRun' => false,
        ),
        
        /* 'db'=>array(
          'connectionString' => 'sqlite:protected/data/blog.db',
          'tablePrefix' => 'tbl_',
          ), */
        // uncomment the following to use a MySQL database

        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=dailyupdates',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'inheritx',
            'charset' => 'utf8',
        //'tablePrefix' => 'tbl_',
        ),
        'errorHandler' => array(
            // use 'index/error' action to display errors
            'errorAction' => 'index/error',
        ),
        'urlManager' => array(
            'showScriptName' => false,
            //  'caseSensitive'=>false,  
            'urlFormat' => 'path',
            'rules' => array(
                // 'site' => 'site/login',
                //'site/<action:\w+>' => 'site/<action>',
                '/' => 'index/login',
                'admin' => 'admin/index/login',
                'admin/login' => 'admin/index/login',
                'admin/user' => 'admin/user/admin',
                'admin/newsCategory' => 'admin/newsCategory/admin',
                'admin/newsSubCategory' => 'admin/newsSubCategory/admin',
                'admin/newsArticleSource' => 'admin/newsArticleSource/admin',
                'admin/newsArticle' => 'admin/newsArticle/admin',
                //'admin/countries' =>'admin/countries/admin',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
            //'post/<id:\d+>/<title:.*? >' => 'post/view',
            // 'posts/<tag:.*? >' => 'post/index',
            ),
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => require(dirname(__FILE__) . '/params.php'),
        //default theme
        //'theme' => 'abound',
);