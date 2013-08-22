<?php
/* @var $this StatesController */
/* @var $model States */

$this->breadcrumbs=array(
	'States'=>array('index'),
	$model->StateId=>array('view','id'=>$model->StateId),
	'Update',
);

$this->menu=array(
	array('label'=>'List States', 'url'=>array('index')),
	array('label'=>'Create States', 'url'=>array('create')),
	array('label'=>'View States', 'url'=>array('view', 'id'=>$model->StateId)),
	array('label'=>'Manage States', 'url'=>array('admin')),
);
?>

<h1>Update States <?php echo $model->StateId; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>