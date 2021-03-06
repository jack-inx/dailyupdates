<?php
/* @var $this NewsCategoryController */
/* @var $model NewsCategory */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'news-category-form',
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
        <?php echo $form->labelEx($model, 'NewsCategoryName'); ?>
<?php echo $form->textField($model, 'NewsCategoryName', array('size' => 60, 'maxlength' => 255)); ?>
    <?php echo $form->error($model, 'NewsCategoryName'); ?>
    </div>

    <?php /* ?>
      <div class="row">
      <?php echo $form->labelEx($model,'InsertedDate'); ?>
      <?php echo $form->textField($model,'InsertedDate'); ?>
      <?php echo $form->error($model,'InsertedDate'); ?>
      </div>

      <div class="row">
      <?php echo $form->labelEx($model,'UpdatedDate'); ?>
      <?php echo $form->textField($model,'UpdatedDate'); ?>
      <?php echo $form->error($model,'UpdatedDate'); ?>
      </div>
      <?php */ ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'Status'); ?>
<?php echo $form->dropDownlist($model, 'Status', array('Active' => 'Active', 'Inactive' => 'Inactive')); ?>
<?php echo $form->error($model, 'Status'); ?>
    </div>

    <div class="row buttons">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->