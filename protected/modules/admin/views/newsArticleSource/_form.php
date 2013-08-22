<?php
/* @var $this NewsArticleSourceController */
/* @var $model NewsArticleSource */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'news-article-source-form',
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

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->textFieldRow($model, 'NewsArticleSourceTitle', array('class' => 'span5', 'maxlength' => 255)); ?>        
    </div>

    <div class="row">
        <?php echo $form->textFieldRow($model, 'NewsArticleSourceUrl', array('class' => 'span5', 'maxlength' => 255)); ?>        
    </div>
    <?php /* ?>
      <div class="row">
      <?php echo $form->labelEx($model, 'NewsArticleUpdatedDuration'); ?>
      <?php
      //$model->NewsArticleUpdatedDuration = '';
      $form->widget('zii.widgets.jui.CJuiDatePicker', array(
      'model' => $model,
      'attribute' => 'NewsArticleUpdatedDuration',
      'value' => $model->NewsArticleUpdatedDuration,
      'options' => array(
      'showButtonPanel' => true,
      'changeYear' => true,
      'changeMonth' => 'true',
      'dateFormat' => 'dd-mm-yy',
      'yearRange' => '-112:+0',
      ),
      'htmlOptions' => array(),
      ));
      ?>
      <?php echo $form->error($model, 'NewsArticleUpdatedDuration'); ?>
      </div>

      <div class="row">
      <?php echo $form->textFieldRow($model, 'InsertedDate', array('class' => 'span5', 'maxlength' => 255)); ?>
      </div>

      <div class="row">
      <?php echo $form->textFieldRow($model, 'UpdatedDate', array('class' => 'span5', 'maxlength' => 255)); ?>
      </div>
      <?php */ ?>
    <div class="row">
        <?php echo $form->dropDownlistRow($model, 'Status', array('Active' => 'Active', 'Inactive' => 'Inactive')); ?>        
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->