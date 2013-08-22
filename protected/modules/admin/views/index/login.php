<?php
/* $this->pageTitle=Yii::app()->name . ' - Login';
  $this->breadcrumbs=array(
  'Login',
  ); */
?>
<div class="page-header">
    <h1>Login <small>to your account</small></h1>
</div>
<div class="row-fluid">

    <div class="span6 offset3">
        <?php
        $this->beginWidget('zii.widgets.CPortlet', array(
            'title' => "Private access",
        ));
        ?>
        <p>Please fill out the following form with your login credentials:</p>

        <div class="form">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'login-form',
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                    ));
            ?>

            <?php echo $form->errorSummary($model); ?>
            <?php
            foreach (Yii::app()->user->getFlashes() as $key => $message) {
                echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
            }
            ?>
            <p class="note">Fields with <span class="required">*</span> are required.</p>

            <?php
            foreach (Yii::app()->user->getFlashes() as $key => $message) {
                echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
            }
            ?>

            <div class="row">
                <?php echo $form->labelEx($model, 'Email'); ?>
                <?php echo $form->textField($model, 'Email'); ?>
                <?php echo $form->error($model, 'Email'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'Password'); ?>
                <?php echo $form->passwordField($model, 'Password'); ?>
                <?php echo $form->error($model, 'Password'); ?>                
            </div>

            <div class="row rememberMe">

                <?php echo $form->checkBox($model, 'RememberMe'); ?>
                <?php echo $form->label($model, 'RememberMe'); ?>
                <?php echo $form->error($model, 'RememberMe'); ?>

                <span>
                    <a href="<?php echo Yii::app()->baseUrl; ?>/admin/index/forgot">
                        Forgot Password</a>
                </span>

            </div>

            <div class="row buttons">
                <?php echo CHtml::submitButton('Login', array('class' => 'btn btn btn-primary')); ?>
            </div>

            <?php $this->endWidget(); ?>
        </div><!-- form -->

        <?php $this->endWidget(); ?>

    </div>

</div>