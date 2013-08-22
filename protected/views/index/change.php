<?php 
$form=$this->beginWidget('CActiveForm', array(
		'id'=>'forgot_password',
		'enableAjaxValidation'=>false,
		'enableClientValidation'=>true,
		'clientOptions' => array(
			'validateOnSubmit' => true,
		),
		'htmlOptions' => array(
			'name'=>'forgot_password',			
		),
	));
?>
<div class="change_email signup">
	<div class="top_box">
    	<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/change_emaillogo.png" class="img"/>
        <div class=forgotleft>
        	<h3>Reset Your Password</h3>            
        </div>
    </div>
    <div class="box">
    	<p>Enter your new Password:</p>
		<div >  <!-- class="mar_5" -->			
        	<?php echo Chtml::passwordField('User[password]'); ?>
		</div>
		<p>Confirm Password:</p>
		<div >  <!-- class="mar_5" -->			
        	<?php echo Chtml::passwordField('User[confirm_password]'); ?>
		</div>
        <div class="butt">
        	<?php echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl.'/images/continue_blue_butt.png', '', array('alt'=>'Continue','class'=>'f1')),'javascript:;',array('id'=>'change_password_continue')); ?>
			<?php echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl.'/images/cancel.png', '', array('alt'=>'Cancel','class'=>'fr')),'javascript:;',array('id'=>'change_password_cancel')); ?>            	
		</div>
	</div>
</div>
<?php $this->endWidget(); ?>