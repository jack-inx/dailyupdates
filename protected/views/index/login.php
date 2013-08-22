<div class="middle">
    <div class="fixdiv">
        <div class="signin fl">
            <div class="slogan"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/appstore_text.png" /></div>
            <div class="blog">
                <div class="fl">Existing Users Log-in:</div>
                <div class="fr">
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'LoginForm',
                        'action' => 'index/login',
                        'enableAjaxValidation' => false,
                        'enableClientValidation' => true,
                        'clientOptions' => array(
                            'validateOnSubmit' => true,
                        //'validateOnChange' => true,
                        ),
                        'htmlOptions' => array(
                            'name' => 'LoginForm',
                            'enctype' => 'multipart/form-data',
                            
                        ),
                            ));
                    ?>
                    <?php echo $form->hiddenField($model,'RememberMe'); ?>
                    <?php echo $form->textField($model, 'Email', array('placeholder' => 'Email', 'maxlength' => 100)); ?>
                    <?php echo $form->error($model, 'Email'); ?>

                    <?php echo $form->passwordField($model, 'Password', array('placeholder' => 'Password', 'maxlength' => 100)); ?>
                    <?php echo $form->error($model, 'Password'); ?>
                    
                    <?php echo CHtml::submitButton('Log In'); ?>
                    <?php $this->endWidget(); ?>
                    <?php echo CHtml::link('Forgot Password',array('index/forgot')); ?>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="or"><img src="images/or_divider.png" /></div>
            <div class="blog">
                <div class="fl">New Users Create Account:</div>
                <div class="fr">
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'SignForm',
                        'enableAjaxValidation' => false,
                        'enableClientValidation' => true,
                        'clientOptions' => array(
                            'validateOnSubmit' => true,
                        //'validateOnChange' => true,
                        ),
                        'htmlOptions' => array(
                            'name' => 'SignForm',
                            'enctype' => 'multipart/form-data'
                        ),
                    ));
                    ?>
                    <?php echo $form->hiddenField($model,'RememberMe'); ?>
                    <?php echo $form->textField($model, 'Email', array('placeholder' => 'Email', 'maxlength' => 100)); ?>
                    <?php echo $form->error($model, 'Email'); ?>

                    <?php echo $form->passwordField($model, 'Password', array('placeholder' => 'Password', 'maxlength' => 100)); ?>
                    <?php echo $form->error($model, 'Password'); ?>

                    <?php echo CHtml::submitButton('Log In'); ?>

                    <?php $this->endWidget(); ?>                    
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="screen fr">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/scree_img.png" />
            <div class="appstore">
                <a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/appstore.png" /></a>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>






<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

/* $this->pageTitle=Yii::app()->name . ' - Login';
  $this->breadcrumbs=array(
  'Login',
  ); */
/*
  ?>
  <div class="page-header">
  <h1>Login <small>to your account</small></h1>
  </div>
  <div class="row-fluid">

  <div class="span6 offset3">
  <?php
  $this->beginWidget('zii.widgets.CPortlet', array(
  'title'=>"Private access",
  ));

  ?>



  <p>Please fill out the following form with your login credentials:</p>

  <div class="form">
  <?php $form=$this->beginWidget('CActiveForm', array(
  'id'=>'login-form',
  'enableClientValidation'=>true,
  'clientOptions'=>array(
  'validateOnSubmit'=>true,
  ),
  )); ?>

  <p class="note">Fields with <span class="required">*</span> are required.</p>
  <?php echo $form->errorSummary($model);?>
  <?php
  foreach(Yii::app()->user->getFlashes() as $key => $message) {
  echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
  }
  ?>

  <div class="row">
  <?php echo $form->labelEx($model,'UserName'); ?>
  <?php echo $form->textField($model,'UserName'); ?>
  <?php echo $form->error($model,'UserName'); ?>
  </div>

  <div class="row">
  <?php echo $form->labelEx($model,'Password'); ?>
  <?php echo $form->passwordField($model,'Password'); ?>
  <?php echo $form->error($model,'Password'); ?>
  <p class="hint">
  Hint: You may login with <kbd>admin</kbd>/<kbd>admin</kbd>.
  </p>
  </div>

  <div class="row rememberMe">

  <?php echo $form->checkBox($model,'RememberMe'); ?>
  <?php echo $form->label($model,'RememberMe'); ?>
  <?php echo $form->error($model,'RememberMe'); ?>
  <span>
  <a href="site/forgot">
  Forgot Password</a>
  </span>

  </div>

  <div class="row buttons">
  <?php echo CHtml::submitButton('Login',array('class'=>'btn btn btn-primary')); ?>
  </div>

  <?php $this->endWidget(); ?>
  </div><!-- form -->

  <?php $this->endWidget();?>

  </div>

  </div>
  <?php
 */
?>