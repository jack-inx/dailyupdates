<?php
/* @var $this NewsArticleSourceController */
/* @var $model NewsArticleSource */

$this->breadcrumbs=array(
	'News Article Sources'=>array('index'),
	$model->NewsArticleSourceId,
);

$this->menu=array(
	array('label'=>'List NewsArticleSource', 'url'=>array('index')),
	array('label'=>'Create NewsArticleSource', 'url'=>array('create')),
	array('label'=>'Update NewsArticleSource', 'url'=>array('update', 'id'=>$model->NewsArticleSourceId)),
	array('label'=>'Delete NewsArticleSource', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->NewsArticleSourceId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage NewsArticleSource', 'url'=>array('admin')),
);
?>

<h1>View NewsArticleSource #<?php echo $model->NewsArticleSourceId; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'NewsArticleSourceId',
		'NewsArticleSourceTitle',
		'NewsArticleSourceUrl',
		//'NewsArticleUpdatedDuration',
		//'InsertedDate',
		//'UpdatedDate',
		'Status',
	),
)); ?>
