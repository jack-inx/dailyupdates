<?php
/* $this->pageTitle=Yii::app()->name . ' - Login';
  $this->breadcrumbs=array(
  'Login',
  ); */
?>
<div class="page-header">
    <h1>Forgot Password <small>of your account</small></h1>
</div>
<div class="row-fluid">

    <div class="span6 offset3">
        <?php
        $this->beginWidget('zii.widgets.CPortlet', array(
            'title' => "Forgot Password",
        ));
        ?>
        <p>Please fill out the following form with your email:</p>

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

            <div class="row buttons">
            <?php echo CHtml::submitButton('Retrieve Password', array('class' => 'btn btn btn-primary')); ?>
        </div>

            <?php $this->endWidget(); ?>
        </div><!-- form -->

        <?php $this->endWidget(); ?>

    </div>

</div>

