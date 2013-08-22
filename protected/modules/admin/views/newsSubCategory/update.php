<?php
/* @var $this NewsSubCategoryController */
/* @var $model NewsSubCategory */

$this->breadcrumbs=array(
	'News Sub Categories'=>array('index'),
	$model->NewsSubCategoryId=>array('view','id'=>$model->NewsSubCategoryId),
	'Update',
);

$this->menu=array(
	array('label'=>'List NewsSubCategory', 'url'=>array('index')),
	array('label'=>'Create NewsSubCategory', 'url'=>array('create')),
	array('label'=>'View NewsSubCategory', 'url'=>array('view', 'id'=>$model->NewsSubCategoryId)),
	array('label'=>'Manage NewsSubCategory', 'url'=>array('admin')),
);
?>

<h1>Update NewsSubCategory <?php echo $model->NewsSubCategoryId; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>