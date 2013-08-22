<?php
/* @var $this NewsSubCategoryController */
/* @var $model NewsSubCategory */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'NewsSubCategoryId'); ?>
		<?php echo $form->textField($model,'NewsSubCategoryId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NewsCategoryId'); ?>
		<?php echo $form->textField($model,'NewsCategoryId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NewsSubCategoryName'); ?>
		<?php echo $form->textField($model,'NewsSubCategoryName',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'InsertedDate'); ?>
		<?php echo $form->textField($model,'InsertedDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UpdatedDate'); ?>
		<?php echo $form->textField($model,'UpdatedDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Status'); ?>
		<?php echo $form->textField($model,'Status',array('size'=>8,'maxlength'=>8)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->