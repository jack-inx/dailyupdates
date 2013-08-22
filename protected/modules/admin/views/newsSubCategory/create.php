<?php
/* @var $this NewsSubCategoryController */
/* @var $model NewsSubCategory */

$this->breadcrumbs=array(
	'News Sub Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List NewsSubCategory', 'url'=>array('index')),
	array('label'=>'Manage NewsSubCategory', 'url'=>array('admin')),
);
?>

<h1>Create NewsSubCategory</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>