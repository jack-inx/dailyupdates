<?php
/* @var $this CitiesController */
/* @var $data Cities */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CityID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CityID), array('view', 'id'=>$data->CityID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CityName')); ?>:</b>
	<?php echo CHtml::encode($data->CityName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ShortCity')); ?>:</b>
	<?php echo CHtml::encode($data->ShortCity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('StateID')); ?>:</b>
	<?php echo CHtml::encode($data->StateID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CountryID')); ?>:</b>
	<?php echo CHtml::encode($data->CountryID); ?>
	<br />


</div>