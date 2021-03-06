<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->UserId,
);

$this->menu=array(
array('label'=>'List User','url'=>array('index')),
array('label'=>'Create User','url'=>array('create')),
array('label'=>'Update User','url'=>array('update','id'=>$model->UserId)),
array('label'=>'Delete User','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->UserId),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage User','url'=>array('admin')),
);
?>

<h1>View User #<?php echo $model->UserId; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'UserId',
		'UserType',
		'FirstName',
		'LastName',
		'UserName',
		'Email',
		'Password',
		'Gender',
		'BirthDate',
		'AccountVerified',
		'UserRoles',
		'DeviceId',
		'MobileDeviceId',
		'InsertedDate',
		'UpdatedDate',
		'Status',
),
)); ?>
