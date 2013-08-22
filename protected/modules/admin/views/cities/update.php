<?php
/* @var $this CitiesController */
/* @var $model Cities */

$this->breadcrumbs=array(
	'Cities'=>array('index'),
	$model->CityID=>array('view','id'=>$model->CityID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Cities', 'url'=>array('index')),
	array('label'=>'Create Cities', 'url'=>array('create')),
	array('label'=>'View Cities', 'url'=>array('view', 'id'=>$model->CityID)),
	array('label'=>'Manage Cities', 'url'=>array('admin')),
);
?>

<h1>Update Cities <?php echo $model->CityID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>