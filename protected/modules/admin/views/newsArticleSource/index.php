<?php
/* @var $this NewsArticleSourceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'News Article Sources',
);

$this->menu=array(
	array('label'=>'Create NewsArticleSource', 'url'=>array('create')),
	array('label'=>'Manage NewsArticleSource', 'url'=>array('admin')),
);
?>

<h1>News Article Sources</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
