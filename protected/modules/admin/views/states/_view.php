<?php
/* @var $this StatesController */
/* @var $data States */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('StateId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->StateId), array('view', 'id'=>$data->StateId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('StateName')); ?>:</b>
	<?php echo CHtml::encode($data->StateName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shortState')); ?>:</b>
	<?php echo CHtml::encode($data->shortState); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CountryID')); ?>:</b>
	<?php echo CHtml::encode($data->CountryID); ?>
	<br />


</div>