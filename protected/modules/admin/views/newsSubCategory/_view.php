<?php
/* @var $this NewsSubCategoryController */
/* @var $data NewsSubCategory */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('NewsSubCategoryId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->NewsSubCategoryId), array('view', 'id'=>$data->NewsSubCategoryId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NewsCategoryId')); ?>:</b>
	<?php echo CHtml::encode($data->NewsCategoryId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NewsSubCategoryName')); ?>:</b>
	<?php echo CHtml::encode($data->NewsSubCategoryName); ?>
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


</div>