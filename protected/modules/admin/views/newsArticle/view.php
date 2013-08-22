<?php
/* @var $this NewsArticleController */
/* @var $model NewsArticle */

$this->breadcrumbs = array(
    'News Articles' => array('index'),
    $model->NewsArticleId,
);

$this->menu = array(
    array('label' => 'List NewsArticle', 'url' => array('index')),
    array('label' => 'Create NewsArticle', 'url' => array('create')),
    array('label' => 'Update NewsArticle', 'url' => array('update', 'id' => $model->NewsArticleId)),
    array('label' => 'Delete NewsArticle', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->NewsArticleId), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage NewsArticle', 'url' => array('admin')),
);
?>

<h1>View News Article #<?php echo $model->NewsArticleId; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'NewsArticleId',
        'NewsArticleTitle',
        'NewsCategoryId',        
        'NewsSubCategoryId',
        'NewsArticleSourceId',
        'NewsArticleImage',
        'NewsArticleLink',
        'NewsDescription',
        'NewsPublishDate',
        'InsertedDate',
        'UpdatedDate',
        'Status',
    ),
));
?>
