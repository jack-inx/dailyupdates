<?php
/* @var $this StatesController */
/* @var $model States */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'states-form',
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
        <?php echo $form->labelEx($model, 'StateId'); ?>
<?php echo $form->textField($model, 'StateId'); ?>
<?php echo $form->error($model, 'StateId'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'StateName'); ?>
<?php echo $form->textField($model, 'StateName', array('size' => 35, 'maxlength' => 35)); ?>
<?php echo $form->error($model, 'StateName'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'shortState'); ?>
<?php echo $form->textField($model, 'shortState', array('size' => 25, 'maxlength' => 25)); ?>
<?php echo $form->error($model, 'shortState'); ?>
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