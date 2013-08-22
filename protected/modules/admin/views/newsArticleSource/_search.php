<?php
/* @var $this NewsArticleSourceController */
/* @var $model NewsArticleSource */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'NewsArticleSourceId'); ?>
		<?php echo $form->textField($model,'NewsArticleSourceId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NewsArticleSourceTitle'); ?>
		<?php echo $form->textField($model,'NewsArticleSourceTitle',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NewsArticleSourceUrl'); ?>
		<?php echo $form->textField($model,'NewsArticleSourceUrl',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NewsArticleUpdatedDuration'); ?>
		<?php echo $form->textField($model,'NewsArticleUpdatedDuration',array('size'=>50,'maxlength'=>50)); ?>
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