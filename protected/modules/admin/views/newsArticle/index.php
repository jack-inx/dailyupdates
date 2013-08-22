<?php
/* @var $this NewsArticleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'News Articles',
);

$this->menu=array(
	array('label'=>'Create NewsArticle', 'url'=>array('create')),
	array('label'=>'Manage NewsArticle', 'url'=>array('admin')),
);
?>

<h1>News Articles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
