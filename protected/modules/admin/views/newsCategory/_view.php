<?php
/* @var $this NewsCategoryController */
/* @var $data NewsCategory */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('NewsCategoryId')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->NewsCategoryId), array('view', 'id' => $data->NewsCategoryId)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('NewsCategoryName')); ?>:</b>
    <?php echo CHtml::encode($data->NewsCategoryName); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('InsertedDate')); ?>:</b>
    <?php echo CHtml::encode($data->InsertedDate); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('UpdatedDate')); ?>:</b>
    <?php echo CHtml::encode($data->UpdatedDate); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('Status')); ?>:</b>
    <?php echo CHtml::encode($data->Status); ?>
    <br />


</div>