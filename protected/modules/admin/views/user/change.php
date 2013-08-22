<h1>Change Password </h1>
<div class="row-fluid">



    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'pwd-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <?php echo $form->errorSummary($model); ?>
    <?php
    foreach (Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
    ?>
    <p class="note">
        <?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
    </p>

    <?php echo $form->errorSummary($model, Yii::t('app', 'Please fix the following input errors:')); ?>
    <div class="row">
        <?php ?>
        <?php echo $form->labelEx($model, 'NewPassword'); ?>
        <?php echo $form->passwordField($model, 'NewPassword', array('size' => 40, 'maxlength' => 40, 'value' => '')); ?>
        <?php echo $form->error($model, 'NewPassword'); ?>

    </div>

    <div class="row">
        <?php ?>
        <?php echo $form->labelEx($model, 'PasswordRepeat'); ?>
        <?php echo $form->passwordField($model, 'PasswordRepeat', array('size' => 40, 'maxlength' => 40, 'value' => '')); ?>
        <?php echo $form->error($model, 'PasswordRepeat'); ?>

    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Change Password', array('class' => 'btn btn btn-primary')); ?>
    </div>
    <!-- <a href="javascript:history.back()" class="backlink"> Back </a>-->
    <?php $this->endWidget(); ?>

</div><!-- form -->
