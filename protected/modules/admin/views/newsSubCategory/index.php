<?php
/* @var $this NewsSubCategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'News Sub Categories',
);

$this->menu=array(
	array('label'=>'Create NewsSubCategory', 'url'=>array('create')),
	array('label'=>'Manage NewsSubCategory', 'url'=>array('admin')),
);
?>

<h1>News Sub Categories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
