<?php
/* @var $this NewsArticleSourceController */
/* @var $model NewsArticleSource */

$this->breadcrumbs=array(
	'News Article Sources'=>array('index'),
	$model->NewsArticleSourceId=>array('view','id'=>$model->NewsArticleSourceId),
	'Update',
);

$this->menu=array(
	array('label'=>'List NewsArticleSource', 'url'=>array('index')),
	array('label'=>'Create NewsArticleSource', 'url'=>array('create')),
	array('label'=>'View NewsArticleSource', 'url'=>array('view', 'id'=>$model->NewsArticleSourceId)),
	array('label'=>'Manage NewsArticleSource', 'url'=>array('admin')),
);
?>

<h1>Update NewsArticleSource <?php echo $model->NewsArticleSourceId; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>