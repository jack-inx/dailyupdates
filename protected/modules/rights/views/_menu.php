<?php $this->widget('zii.widgets.CMenu', array(
	'firstItemCssClass'=>'first',
	'lastItemCssClass'=>'last',
	'htmlOptions'=>array('class'=>'actions'),
	'items'=>array(
		array(
			'Label'=>Rights::t('core', 'Assignments'),
			'Url'=>array('assignment/view'),
			'ItemOptions'=>array('class'=>'item-assignments'),
		),
		array(
			'Label'=>Rights::t('core', 'Permissions'),
			'Url'=>array('authItem/permissions'),
			'ItemOptions'=>array('class'=>'item-permissions'),
		),
		array(
			'Label'=>Rights::t('core', 'Roles'),
			'Url'=>array('authItem/roles'),
			'ItemOptions'=>array('class'=>'item-roles'),
		),
		array(
			'Label'=>Rights::t('core', 'Tasks'),
			'Url'=>array('authItem/tasks'),
			'ItemOptions'=>array('class'=>'item-tasks'),
		),
		array(
			'Label'=>Rights::t('core', 'Operations'),
			'Url'=>array('authItem/operations'),
			'ItemOptions'=>array('class'=>'item-operations'),
		),
	)
));	?>