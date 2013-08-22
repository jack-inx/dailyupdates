<?php
/* @var $this CountriesController */
/* @var $model Countries */

$this->breadcrumbs=array(
	'Countries'=>array('index'),
	$model->CountryId,
);

$this->menu=array(
	array('label'=>'List Countries', 'url'=>array('index')),
	array('label'=>'Create Countries', 'url'=>array('create')),
	array('label'=>'Update Countries', 'url'=>array('update', 'id'=>$model->CountryId)),
	array('label'=>'Delete Countries', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CountryId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Countries', 'url'=>array('admin')),
);
?>

<h1>View Countries #<?php echo $model->CountryId; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CountryId',
		'CountryName',
		'ShortCountry',
	),
)); ?>
