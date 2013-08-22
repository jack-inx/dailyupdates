<div class="middle">
    <div class="fixdiv">
        <div class="signin fl">            
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'forgot_password',
                'enableAjaxValidation' => false,
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                'htmlOptions' => array(
                    'name' => 'forgot_password',
                ),
                    ));
            ?>

            <div class="top_box">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" class="img"/>
                <div class=forgotleft>
                    <h3>Need a New Password?</h3>            
                </div>
            </div>
            <div class="box">
                <p>Enter your email address below, and we will send you an email with a link to follow, where you will be able to reset your password</p>
                <br />
                <div>  <!-- class="mar_5" -->			
                    <?php echo Chtml::textField('User_email'); ?>
                </div>
                <div class="butt">
                    <?php echo CHtml::submitButton('Continue'); ?>
                    <?php echo CHtml::link('Cancel',array('index/login')); ?>                    
                </div>
            </div>

            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
