<?php
/* @var $this StatesController */
/* @var $model States */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    /* $form = $this->beginWidget('CActiveForm', array(
      'id' => 'rssfeed-form',
      'enableAjaxValidation' => false,
      )); */
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <div class="row">
        <?php echo CHtml::label('RSS Feed Url', ''); ?>
        <?php echo CHtml::textField('RSSFeed[Url]'); ?>		
    </div>

    <div class="row buttons">
        <?php echo CHtml::Button('Fetch', array('id' => 'Fetch_Url')); ?>
    </div>

    <?php //$this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
    /* change state dropdown value */
    $(document).on("click", "#Fetch_Url", function(e) {
        var val = $('#RSSFeed_Url').val();
        if(val != ''){
            var url = '<?php echo Yii::app()->baseUrl . '/admin/rssFeed/receiveFeeds' ?>';
            $.post(url, {"RSSFeed_Url":val}, function(data) {
                if(data >= 0){
                    bootbox.alert("Rss Feed Fetched successfully!<br />Total Record Fetched : "+data, function() {
                        $('#RSSFeed_Url').focus();
                    });
                }else{
                    bootbox.alert("Rss Feed Url cannot be blank", function() {
                        $('#RSSFeed_Url').focus();
                    });
                }
                
            });                    
        }else{
            bootbox.alert("Rss Feed Url cannot be blank", function() {
                $('#RSSFeed_Url').focus();
            });
        }        
    });
</script>