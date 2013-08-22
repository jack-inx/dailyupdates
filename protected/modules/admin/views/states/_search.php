<?php
/* @var $this StatesController */
/* @var $model States */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'StateId'); ?>
		<?php echo $form->textField($model,'StateId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'StateName'); ?>
		<?php echo $form->textField($model,'StateName',array('size'=>35,'maxlength'=>35)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'shortState'); ?>
		<?php echo $form->textField($model,'shortState',array('size'=>25,'maxlength'=>25)); ?>
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