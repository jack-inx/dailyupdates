<?php
/* @var $this CitiesController */
/* @var $model Cities */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CityID'); ?>
		<?php echo $form->textField($model,'CityID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CityName'); ?>
		<?php echo $form->textField($model,'CityName',array('size'=>60,'maxlength'=>70)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ShortCity'); ?>
		<?php echo $form->textField($model,'ShortCity',array('size'=>60,'maxlength'=>60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'StateID'); ?>
		<?php echo $form->textField($model,'StateID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CountryID'); ?>
		<?php echo $form->textField($model,'CountryID'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->