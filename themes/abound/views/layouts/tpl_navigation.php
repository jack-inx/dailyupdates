<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <!-- Be sure to leave the brand out there if you want it shown -->
            <a class="brand" href="<?php echo Yii::app()->request->baseUrl; ?>/admin">Daily Updates</a>
            <?php $data = Yii::app()->admin->getState('admin'); ?> 


            <div class="nav-collapse">

                <?php
                $items = array();
                $itemsMenu = UserMenu::getMenuItems();
                if (isset($itemsMenu['items']) && !empty($itemsMenu['items'])) {
                    $items = $itemsMenu['items'];
                }
                $this->widget('zii.widgets.CMenu', array(
                    'htmlOptions' => array('class' => 'pull-right nav'),
                    'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
                    'itemCssClass' => 'item-test',
                    'encodeLabel' => false,
                    'items' => $items,
//                            array(
//                        array('label'=>'Dashboard', 'url'=>array('/site/index'), 'visible'=>!Yii::app()->user->isGuest),
//                         array('label'=>'Users', 'url'=>array('/user/admin'), 'visible'=>!Yii::app()->user->isGuest),
//                       
//                        //array('label'=>'Graphs & Charts', 'url'=>array('/site/page', 'view'=>'graphs')),
//                        //array('label'=>'Forms', 'url'=>array('/site/page', 'view'=>'forms')),
//                        // array('label'=>'Tables', 'url'=>array('/site/page', 'view'=>'tables')),
//						//array('label'=>'Interface', 'url'=>array('/site/page', 'view'=>'interface')),
//                        //array('label'=>'Typography', 'url'=>array('/site/page', 'view'=>'typography')),
//                        /*array('label'=>'Gii generated', 'url'=>array('customer/index')),*/
//                        /*'items'=>array(
//                            array('label'=>'My Messages <span class="badge badge-warning pull-right">26</span>', 'url'=>'#'),
//							array('label'=>'My Tasks <span class="badge badge-important pull-right">112</span>', 'url'=>'#'),
//							array('label'=>'My Invoices <span class="badge badge-info pull-right">12</span>', 'url'=>'#'),
//							array('label'=>'Separated link', 'url'=>'#'),
//							array('label'=>'One more separated link', 'url'=>'#'),
//                        )),*/
//                       // array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
//                        array('label'=>'Logout ('.$data['UserName'].')', 'url'=>array('/index/logout'), 'visible'=>!Yii::app()->user->isGuest),
//                    ),
                ));
                ?>
            </div>
        </div>
    </div>
</div>

<div class="subnav navbar navbar-fixed-top">
    <div class="navbar-inner">
        <!--    	<div class="container">
                
                        <div class="style-switcher pull-left">
                        <a href="javascript:chooseStyle('none', 60)"  ><span class="style" style="background-color:#0088CC;"></span></a>
                        <a href="javascript:chooseStyle('style2', 60)"><span class="style" style="background-color:#7c5706;"></span></a>
                        <a href="javascript:chooseStyle('style3', 60)"><span class="style" style="background-color:#468847;"></span></a>
                        <a href="javascript:chooseStyle('style4', 60)" ><span class="style" style="background-color:#4e4e4e;"></span></a>
                        <a href="javascript:chooseStyle('style5', 60)"><span class="style" style="background-color:#d85515;"></span></a>
                        <a href="javascript:chooseStyle('style6', 60)"><span class="style" style="background-color:#a00a69;"></span></a>
                        <a href="javascript:chooseStyle('style7', 60)"><span class="style" style="background-color:#a30c22;"></span></a>
                        </div>
                   <form class="navbar-search pull-right" action="">
                         
                   <input type="text" class="search-query span2" placeholder="Search">
                   
                   </form>
                </div><!-- container -->
    </div><!-- navbar-inner -->
</div><!-- subnav -->



