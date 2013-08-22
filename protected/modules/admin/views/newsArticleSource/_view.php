<?php
/* @var $this NewsArticleSourceController */
/* @var $data NewsArticleSource */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('NewsArticleSourceId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->NewsArticleSourceId), array('view', 'id'=>$data->NewsArticleSourceId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NewsArticleSourceTitle')); ?>:</b>
	<?php echo CHtml::encode($data->NewsArticleSourceTitle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NewsArticleSourceUrl')); ?>:</b>
	<?php echo CHtml::encode($data->NewsArticleSourceUrl); ?>
	<br />
        <?php /* ?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('NewsArticleUpdatedDuration')); ?>:</b>
	<?php echo CHtml::encode($data->NewsArticleUpdatedDuration); ?>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('InsertedDate')); ?>:</b>
	<?php echo CHtml::encode($data->InsertedDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UpdatedDate')); ?>:</b>
	<?php echo CHtml::encode($data->UpdatedDate); ?>
	<br />
        <?php */ ?>
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('Status')); ?>:</b>
	<?php echo CHtml::encode($data->Status); ?>
	<br />


</div>