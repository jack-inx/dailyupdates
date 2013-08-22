<?php
/* @var $this NewsArticleController */
/* @var $model NewsArticle */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'news-article-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <?php echo $form->errorSummary($model); ?>
    <?php
    foreach (Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
    ?>
    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <div class="row">
        <?php echo $form->textFieldRow($model, 'NewsArticleTitle', array('class' => 'span5', 'maxlength' => 255)); ?>        
    </div>

    <div class="row">
        <?php echo $form->dropDownlistRow($model, 'NewsCategoryId', NewsCategory::model()->getCategoryListing(), array('class' => 'span5', 'maxlength' => 255)); ?>
        <?php echo CHTML::textField('NewsArticle[SourceId]', '', array('class' => 'span5', 'maxlength' => 255, 'style' => 'display:none')); ?>        
    </div>

    <div class="row">
        <?php echo $form->dropDownlistRow($model, 'NewsSubCategoryId', array('' => '--Select--'), array('class' => 'span5')); ?>
    </div>

    <div class="row">
        <?php echo $form->dropDownlistRow($model, 'NewsArticleSourceId', NewsArticleSource::model()->getNewsArticleSourceListing(), array('class' => 'span5')); ?>            
    </div>

    <div class="row">
        <?php echo $form->textFieldRow($model, 'NewsArticleImage', array('class' => 'span5', 'maxlength' => 255, 'size' => 60)); ?>        
    </div>

    <div class="row">
        <?php echo $form->textFieldRow($model, 'NewsArticleLink', array('class' => 'span5', 'maxlength' => 255, 'size' => 60)); ?>
    </div>

    <div class="row">
        <?php //echo $form->textFieldRow($model, 'NewsDescription', array('class' => 'span5', 'maxlength' => 255, 'size' => 60)); ?>
        <?php echo $form->textAreaRow($model, 'NewsDescription', array('class' => 'span5')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'NewsPublishDate'); ?>
        <?php
        $form->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'NewsPublishDate',
            'value' => $model->NewsPublishDate,
            'options' => array(
                'showButtonPanel' => true,
                'changeYear' => true,
                'changeMonth' => 'true',
                'dateFormat' => 'dd-mm-yy',
                'yearRange' => '-112:+0',
            ),
            'htmlOptions' => array(),
        ));
        ?> 
        <?php echo $form->error($model, 'NewsPublishDate'); ?>
    </div>

    <?php /* ?>
      <div class="row">
      <?php echo $form->labelEx($model, 'InsertedDate'); ?>
      <?php echo $form->textField($model, 'InsertedDate'); ?>
      <?php echo $form->error($model, 'InsertedDate'); ?>
      </div>

      <div class="row">
      <?php echo $form->labelEx($model, 'UpdatedDate'); ?>
      <?php echo $form->textField($model, 'UpdatedDate'); ?>
      <?php echo $form->error($model, 'UpdatedDate'); ?>
      </div>
      <?php */ ?>
    <div class="row">
        <?php echo $form->dropDownlistRow($model, 'Status', array('Active' => 'Active', 'Inactive' => 'Inactive')); ?>        
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
    
    /* change state dropdown value */
    $(document).on("change", "#NewsArticle_NewsCategoryId", function(e) {
        var val = $('#NewsArticle_NewsCategoryId').val();
        if(val == 'Other'){
            $('#NewsArticle_SourceId').show();            
        }else{
            $('#NewsArticle_SourceId').hide();
            $('#NewsArticle_SourceId').val('');
            var url = '<?php echo Yii::app()->baseUrl . '/admin/newsArticle/ShowSubCategory' ?>';
            $.post(url, {"id":val}, function(data) {
                if(data != ''){
                    $('#NewsArticle_NewsSubCategoryId').html(data);
                }else{
                    $('#NewsArticle_NewsSubCategoryId').html('<option value="">--Select--</option>');
                }                
            })
        }        
    });
</script>