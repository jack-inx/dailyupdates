<?php
/* @var $this NewsArticleSourceController */
/* @var $model NewsArticleSource */

$this->breadcrumbs=array(
	'News Article Sources'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List NewsArticleSource', 'url'=>array('index')),
	array('label'=>'Manage NewsArticleSource', 'url'=>array('admin')),
);
?>

<h1>Create NewsArticleSource</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>