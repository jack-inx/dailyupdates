<?php
$model->Password = '';
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'user-form',
    'enableAjaxValidation' => false,
        ));
?>

<?php echo $form->errorSummary($model); ?>
<?php
foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}
?>
<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php //echo $form->errorSummary($modeldetails);  ?>


<?php //echo $form->textFieldRow($model,'UserType',array('class'=>'span5','maxlength'=>10)); ?>

<?php //echo $form->textFieldRow($model,'FirstName',array('class'=>'span5','maxlength'=>50)); ?>

<?php //echo $form->textFieldRow($model,'LastName',array('class'=>'span5','maxlength'=>50)); ?>

<?php echo $form->textFieldRow($model, 'Email', array('class' => 'span5', 'maxlength' => 100)); ?>

<?php //echo $form->textFieldRow($model, 'UserName', array('class' => 'span5', 'maxlength' => 100)); ?>

<?php
if (isset($model->UserId) && $model->UserId > 0) {
    
} else {
    echo $form->passwordFieldRow($model, 'Password', array('value' => '', 'class' => 'span5', 'maxlength' => 255));
}
?>

<?php //echo $form->textFieldRow($model, 'Gender', array('class' => 'span5', 'maxlength' => 6)); ?>

<?php //echo $form->textFieldRow($model, 'BirthDate', array('class' => 'span5')); ?>
<?php echo $form->labelEx($model, 'BirthDate'); ?>
<?php
$model->Password = '';
$form->widget('zii.widgets.jui.CJuiDatePicker', array(
    'model' => $model,
    'attribute' => 'BirthDate',
    'value' => $model->BirthDate,
    'options' => array(
        'maxDate'=> '0',
        'showButtonPanel' => true,
        'changeYear' => true,
        'changeMonth' => 'true',
        'dateFormat' => 'dd-mm-yy',
        'yearRange' => '-112:+0',
    ),
    'htmlOptions' => array('class' => 'span5'),
));
?> 
<?php echo $form->error($model, 'BirthDate'); ?>

<?php //echo $form->textFieldRow($model, 'AccountVerified', array('class' => 'span5', 'maxlength' => 3)); ?>

<?php //echo $form->dropDownlistRow($model, 'AccountVerified', array('Yes' => 'Yes', 'No' => 'No'),array('class'=>'span5')); ?>

<?php //echo $form->textFieldRow($model, 'UserRoles', array('class' => 'span5')); ?>

<?php //echo $form->textFieldRow($model, 'DeviceId', array('class' => 'span5', 'maxlength' => 50)); ?>

<?php //echo $form->textFieldRow($model, 'MobileDeviceId', array('class' => 'span5', 'maxlength' => 255));   ?>


<?php //echo $form->dropDownlistRow($modeldetails, 'Country', Countries::model()->getCountryListing()); ?>

<?php //echo $form->dropDownlistRow($modeldetails, 'Country', array('Yes' => 'Yes', 'No' => 'No') ); ?>

<?php //echo $form->dropDownlistRow($modeldetails, 'State', array('' => '--Select--')); ?>

<?php //echo $form->dropDownlistRow($modeldetails, 'City', array('' => '--Select'));   ?>




<?php echo $form->textFieldRow($modeldetails, 'City', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($modeldetails, 'EducationLevel', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($modeldetails, 'AnnualIncome', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($modeldetails, 'EmploymentField', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($modeldetails, 'LanguageOne', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($modeldetails, 'LanguageTwo', array('class' => 'span5', 'maxlength' => 255)); ?>



<?php
if (isset($model->UserId) && $model->UserId > 0) {
    echo $form->textFieldRow($model, 'InsertedDate', array('class' => 'span5', 'disabled' => 'true'));

    echo $form->textFieldRow($model, 'UpdatedDate', array('class' => 'span5', 'disabled' => 'true'));
}
?>

<?php //echo $form->textFieldRow($model, 'Status', array('class' => 'span5', 'maxlength' => 8)); ?>

    <?php echo $form->dropDownlistRow($model, 'Status', array('Active' => 'Active', 'Inactive' => 'Inactive')); ?>

<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $model->isNewRecord ? 'Create' : 'Save',
    ));
    ?>
</div>
<?php $this->endWidget(); ?>
