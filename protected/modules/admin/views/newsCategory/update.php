<?php
/* @var $this NewsCategoryController */
/* @var $model NewsCategory */

$this->breadcrumbs=array(
	'News Categories'=>array('index'),
	$model->NewsCategoryId=>array('view','id'=>$model->NewsCategoryId),
	'Update',
);

$this->menu=array(
	array('label'=>'List NewsCategory', 'url'=>array('index')),
	array('label'=>'Create NewsCategory', 'url'=>array('create')),
	array('label'=>'View NewsCategory', 'url'=>array('view', 'id'=>$model->NewsCategoryId)),
	array('label'=>'Manage NewsCategory', 'url'=>array('admin')),
);
?>

<h1>Update NewsCategory <?php echo $model->NewsCategoryId; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>