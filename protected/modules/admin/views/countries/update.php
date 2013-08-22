<?php
/* @var $this CountriesController */
/* @var $model Countries */

$this->breadcrumbs=array(
	'Countries'=>array('index'),
	$model->CountryId=>array('view','id'=>$model->CountryId),
	'Update',
);

$this->menu=array(
	array('label'=>'List Countries', 'url'=>array('index')),
	array('label'=>'Create Countries', 'url'=>array('create')),
	array('label'=>'View Countries', 'url'=>array('view', 'id'=>$model->CountryId)),
	array('label'=>'Manage Countries', 'url'=>array('admin')),
);
?>

<h1>Update Countries <?php echo $model->CountryId; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>