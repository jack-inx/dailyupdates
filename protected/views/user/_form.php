<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'UserType',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'FirstName',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'LastName',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'UserName',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'Email',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->passwordFieldRow($model,'Password',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'Gender',array('class'=>'span5','maxlength'=>6)); ?>

	<?php echo $form->textFieldRow($model,'BirthDate',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'AccountVerified',array('class'=>'span5','maxlength'=>3)); ?>

	<?php echo $form->textFieldRow($model,'UserRoles',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'DeviceId',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'MobileDeviceId',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'InsertedDate',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'UpdatedDate',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Status',array('class'=>'span5','maxlength'=>8)); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
