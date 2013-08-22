<?php
/* @var $this NewsArticleController */
/* @var $model NewsArticle */

$this->breadcrumbs=array(
	'News Articles'=>array('index'),
	$model->NewsArticleId=>array('view','id'=>$model->NewsArticleId),
	'Update',
);

$this->menu=array(
	array('label'=>'List NewsArticle', 'url'=>array('index')),
	array('label'=>'Create NewsArticle', 'url'=>array('create')),
	array('label'=>'View NewsArticle', 'url'=>array('view', 'id'=>$model->NewsArticleId)),
	array('label'=>'Manage NewsArticle', 'url'=>array('admin')),
);
?>

<h1>Update NewsArticle <?php echo $model->NewsArticleId; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>