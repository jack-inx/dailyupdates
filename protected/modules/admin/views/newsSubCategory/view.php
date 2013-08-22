<?php
/* @var $this NewsSubCategoryController */
/* @var $model NewsSubCategory */

$this->breadcrumbs=array(
	'News Sub Categories'=>array('index'),
	$model->NewsSubCategoryId,
);

$this->menu=array(
	array('label'=>'List NewsSubCategory', 'url'=>array('index')),
	array('label'=>'Create NewsSubCategory', 'url'=>array('create')),
	array('label'=>'Update NewsSubCategory', 'url'=>array('update', 'id'=>$model->NewsSubCategoryId)),
	array('label'=>'Delete NewsSubCategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->NewsSubCategoryId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage NewsSubCategory', 'url'=>array('admin')),
);
?>

<h1>View NewsSubCategory #<?php echo $model->NewsSubCategoryId; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'NewsSubCategoryId',
		'NewsCategoryId',
		'NewsSubCategoryName',
		'InsertedDate',
		'UpdatedDate',
		'Status',
	),
)); ?>
