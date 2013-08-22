<?php
/* @var $this CountriesController */
/* @var $data Countries */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CountryId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CountryId), array('view', 'id'=>$data->CountryId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CountryName')); ?>:</b>
	<?php echo CHtml::encode($data->CountryName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ShortCountry')); ?>:</b>
	<?php echo CHtml::encode($data->ShortCountry); ?>
	<br />


</div>