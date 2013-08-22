<?php
/* @var $this NewsArticleController */
/* @var $model NewsArticle */

$this->breadcrumbs=array(
	'News Articles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List NewsArticle', 'url'=>array('index')),
	array('label'=>'Manage NewsArticle', 'url'=>array('admin')),
);
?>

<h1>Create NewsArticle</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>