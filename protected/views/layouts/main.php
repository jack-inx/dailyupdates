<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <!-- header starts -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <!-- header ends -->
    
    <!-- body starts -->
    <body>

        <div id="wrapper">
            <!-- header start -->
            <div class="header">
                <div class="fixdiv">
                    <div class="fl"><a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" /></a></div>
                    <ul class="fr">
                        <li><a href="#">Product Tour</a></li>
                        <li class="none"><a href="#">About</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- header ends -->

            <!-- Middle Content starts  -->
            <?php echo $content; ?>
            <!-- Middle Content ends -->

            <!-- footer -->
            <div class="footer">
                <div class="fixdiv">
                    <div class="fl"><a href="#">Contact</a></div>
                    <div class="fr">Copyright &copy; <?php echo date('Y'); ?> Daily Updates. All rights reserved.</div>
                    <div class="clear"></div>
                </div>
            </div>
            <!-- footer -->
            
        </div>
    </body>
    <!-- body ends -->
</html>