<?php
/* @var $this NewsArticleController */
/* @var $model NewsArticle */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'NewsArticleId'); ?>
		<?php echo $form->textField($model,'NewsArticleId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NewsArticleTitle'); ?>
		<?php echo $form->textField($model,'NewsArticleTitle',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NewsCategoryId'); ?>
		<?php echo $form->textField($model,'NewsCategoryId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NewsSubCategoryId'); ?>
		<?php echo $form->textField($model,'NewsSubCategoryId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NewsArticleSourceId'); ?>
		<?php echo $form->textField($model,'NewsArticleSourceId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NewsArticleImage'); ?>
		<?php echo $form->textField($model,'NewsArticleImage',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NewsArticleLink'); ?>
		<?php echo $form->textField($model,'NewsArticleLink',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NewsDescription'); ?>
		<?php echo $form->textField($model,'NewsDescription',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NewsPublishDate'); ?>
		<?php echo $form->textField($model,'NewsPublishDate'); ?>
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