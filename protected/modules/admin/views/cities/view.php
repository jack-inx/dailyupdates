<?php
/* @var $this CitiesController */
/* @var $model Cities */

$this->breadcrumbs=array(
	'Cities'=>array('index'),
	$model->CityID,
);

$this->menu=array(
	array('label'=>'List Cities', 'url'=>array('index')),
	array('label'=>'Create Cities', 'url'=>array('create')),
	array('label'=>'Update Cities', 'url'=>array('update', 'id'=>$model->CityID)),
	array('label'=>'Delete Cities', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CityID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Cities', 'url'=>array('admin')),
);
?>

<h1>View Cities #<?php echo $model->CityID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CityID',
		'CityName',
		'ShortCity',
		'StateID',
		'CountryID',
	),
)); ?>
