<?php
/* @var $this NewsArticleController */
/* @var $data NewsArticle */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('NewsArticleId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->NewsArticleId), array('view', 'id'=>$data->NewsArticleId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NewsArticleTitle')); ?>:</b>
	<?php echo CHtml::encode($data->NewsArticleTitle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NewsCategoryId')); ?>:</b>
	<?php echo CHtml::encode($data->NewsCategoryId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NewsSubCategoryId')); ?>:</b>
	<?php echo CHtml::encode($data->NewsSubCategoryId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NewsArticleSourceId')); ?>:</b>
	<?php echo CHtml::encode($data->NewsArticleSourceId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NewsArticleImage')); ?>:</b>
	<?php echo CHtml::encode($data->NewsArticleImage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NewsArticleLink')); ?>:</b>
	<?php echo CHtml::encode($data->NewsArticleLink); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('NewsDescription')); ?>:</b>
	<?php echo CHtml::encode($data->NewsDescription); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NewsPublishDate')); ?>:</b>
	<?php echo CHtml::encode($data->NewsPublishDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('InsertedDate')); ?>:</b>
	<?php echo CHtml::encode($data->InsertedDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UpdatedDate')); ?>:</b>
	<?php echo CHtml::encode($data->UpdatedDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Status')); ?>:</b>
	<?php echo CHtml::encode($data->Status); ?>
	<br />

	*/ ?>

</div>