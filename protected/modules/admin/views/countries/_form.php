<?php
/* @var $this CountriesController */
/* @var $model Countries */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'countries-form',
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
        <?php echo $form->labelEx($model, 'CountryId'); ?>
<?php echo $form->textField($model, 'CountryId'); ?>
<?php echo $form->error($model, 'CountryId'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'CountryName'); ?>
<?php echo $form->textField($model, 'CountryName', array('size' => 40, 'maxlength' => 40)); ?>
<?php echo $form->error($model, 'CountryName'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'ShortCountry'); ?>
<?php echo $form->textField($model, 'ShortCountry', array('size' => 30, 'maxlength' => 30)); ?>
<?php echo $form->error($model, 'ShortCountry'); ?>
    </div>

    <div class="row buttons">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->