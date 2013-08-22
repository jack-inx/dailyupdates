<?php
/* @var $this CitiesController */
/* @var $model Cities */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'cities-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <?php echo $form->errorSummary($model); ?>
    <?php
    foreach (Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
    ?>
    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <div class="row">
        <?php echo $form->labelEx($model, 'CityID'); ?>
        <?php echo $form->textField($model, 'CityID'); ?>
        <?php echo $form->error($model, 'CityID'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'CityName'); ?>
        <?php echo $form->textField($model, 'CityName', array('size' => 60, 'maxlength' => 70)); ?>
        <?php echo $form->error($model, 'CityName'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'ShortCity'); ?>
        <?php echo $form->textField($model, 'ShortCity', array('size' => 60, 'maxlength' => 60)); ?>
        <?php echo $form->error($model, 'ShortCity'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'StateID'); ?>
        <?php echo $form->textField($model, 'StateID'); ?>
        <?php echo $form->error($model, 'StateID'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'CountryID'); ?>
        <?php echo $form->textField($model, 'CountryID'); ?>
        <?php echo $form->error($model, 'CountryID'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->