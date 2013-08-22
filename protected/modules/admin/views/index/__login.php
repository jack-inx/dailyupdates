<?php
//$this->pageTitle=Yii::app()->name . ' - Login';
/*$this->breadcrumbs=array(
	'Login',
);*/
?>
<div class="login_box">
    <h1>Login</h1>
    <div class="form">
        <p>Please fill out the following form with your login credentials:</p>
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'login-form',
            //'enableAjaxValidation'=>true,
        )); ?>
	
	<p class="note">Fields with <span class="required">*</span> are required.</p>
        <div class="row">
            <?php echo $form->labelEx($model,'Email'); ?>
            <?php echo $form->textField($model,'Email'); ?>
            <?php echo $form->error($model,'Email'); ?>		
	</div>

	<div class="row">
            <?php echo $form->labelEx($model,'Password'); ?>
            <?php echo $form->passwordField($model,'Password'); ?>
            <?php echo $form->error($model,'Password'); ?>
            <p class="hint"></p>
	</div>

	<div class="row rememberMe">
            <?php echo $form->checkBox($model,'RememberMe'); ?>
            <?php echo $form->label($model,'RememberMe'); ?>
            <?php echo $form->error($model,'RememberMe'); ?>		
	</div>
	<div class="row rememberMe">
            <a href="Site/forgot"> Forgot Password? </a>
	</div>
	
	<div class="row buttons">
            <?php echo CHtml::submitButton('Login'); ?>
	</div>
        <?php $this->endWidget(); ?>
    </div><!-- form -->
</div>
<script type="text/javascript">
jQuery(document).ready(function(){	
    $('#login-form').submit(function() {
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        var email = $("#Customer_email").attr('value');
        if($("#LoginForm_email").attr('value') != '' && $("#LoginForm_email").attr('value')=="Email")
        {
            $("#pop_up").slideDown("slow");
            $('#popup_msg').html('Please enter email address');
            document.getElementById("LoginForm_email").focus();
            return false;
        }else if($("#LoginForm_password").attr('value')=="Password"){
            $("#pop_up").slideDown("slow");
            $('#popup_msg').html('Password cannot be blank');

            document.getElementById("LoginForm_password").focus();
            return false;
        }else{
            return true;
        }
    });		
});
</script>