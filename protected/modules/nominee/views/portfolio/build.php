<style> 
.file { visibility: hidden; position: absolute; } 
.filename-upload-container:disabled { background-color: #FFF; }
.bootstrap-tagsinput {
  display:block, width:auto; margin: auto 0;
}
</style>

<section class="content-header">
  <h1>
    <i class="fa fa-file-text" aria-hidden="true" style="margin-right:10px;"></i> BUILD PORTFOLIO
  </h1>
</section>

<div class="row" id="alert-message-container" style="margin:20px 10px 0px 10px;"> <!-- ALERT MESSAGES --> </div>

<section class="content">
  <?php 
    foreach(Yii::app()->user->getFlashes() as $key=>$message) {
      if($key === 'success') {
        echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                '.$message.'
              </div>';
      } else {
        echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                '.$message.'
              </div>';
      }
    }
  ?>

  <?php 
  $form = $this->beginWidget('CActiveForm', array(
    'id'=>'portfolio-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
    'htmlOptions'=>['enctype'=>'multipart/form-data','class'=>'form-horizontal',]
  )); 
  ?>

    <?= $this->renderPartial("_portfolio_{$page}", [
      'portfolio'=>$portfolio, 
      'form'=>$form
    ]); ?>


    <br />

    <div class="row">
      <div class="col-md-12">
        <div class="pull-left">
          <button type="button" class="btn btn-primary btn-lg" id="btn-save" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Saving.."> <i class="fa fa-check-square-o"></i> Save Changes </button>
           
          <?php if($page == 3): ?>  
            <button type="button" class="btn btn-success btn-lg" disabled> <i class="fa fa-send"></i> SUBMIT PORTFOLIO </button>
          <?php endif; ?>
        </div>
        <div class="pull-right">
          <?php if($page == 1): ?>
            <button type="button" class="btn btn-primary btn-lg btn-flat" disabled> <strong>1</strong> </button>
          <?php else: ?>
            <a href="<?= Yii::app()->createUrl('nominee/portfolio/build?page=1'); ?>" class="btn btn-default btn-lg btn-flat"> <strong>1</strong> </a>
          <?php endif; ?>

          <?php if($page == 2): ?>
            <button type="button" class="btn btn-primary btn-lg btn-flat" disabled> <strong>2</strong> </button>
          <?php else: ?>
            <a href="<?= Yii::app()->createUrl('nominee/portfolio/build?page=2'); ?>" class="btn btn-default btn-lg btn-flat"> <strong>2</strong> </a>
          <?php endif; ?>
          

          <?php if($page == 3): ?>
            <button type="button" class="btn btn-primary btn-lg btn-flat" disabled> <strong>3</strong> </button>
          <?php else: ?>
            <a href="<?= Yii::app()->createUrl('nominee/portfolio/build?page=3'); ?>" class="btn btn-default btn-lg btn-flat"> <strong>3</strong> </a>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <br />

  <?php $this->endWidget(); ?>

</section>


<script src="<?php echo Yii::app()->request->baseUrl; ?>/page_assets/plugins/ckeditor/ckeditor.js"></script>
<script>
  $(document).ready(function() {
    <?php if($page == 1): ?>
    replaceTextareaToCkeditor('career_info_essay_1', 700);
    replaceTextareaToCkeditor('career_info_essay_2', 700);
    replaceTextareaToCkeditor('career_info_essay_3', 700);
    replaceTextareaToCkeditor('career_info_essay_4', 700);
    <?php endif; ?>

    $(document).on('click', '.browse', function(){
      var file = $(this).parent().parent().parent().find('.file');
      file.trigger('click');
    });

    $(document).on('change', '.file', function(){
        var errors = 0;
        var val = $(this).val();
        var file_size =  parseFloat(this.files[0].size/1024/1024).toFixed(2);

        switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
            case 'jpg':
            case 'jpeg':
            case 'pdf':
                break;
            default:
                errors++;
                $(this).val('');
                // error message here
                alert("Invalid File! File must be JPEG and PDF format only.");
                break;
        }

        if(file_size > 3) {
          errors++
          $(this).val('');
          alert("The image you are trying to upload exceeds the Maximum file size (3MB) limit.")
        }

        if(errors == 0) {
          $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
        }
    });

    $(document).on('click', '#btn-save', function() {
      for ( instance in CKEDITOR.instances )
       CKEDITOR.instances[instance].updateElement();

      var $btn = $(this).button('loading');
      var form = $('#portfolio-form');
      var formData = new FormData();
      var formSerialized = form.serializeArray();
      var inputs = form.find('input, select:not([disabled=""]), button, textarea, .btn');

      $.each(formSerialized,function(key,input){
        formData.append(input.name,input.value);
      });

      $(".file").each(function( index ) {
        if($(this).get(0).files.length != 0) {
          formData.append($(this).attr('name'), $(this)[0].files[0]);
        }
      });

      inputs.prop("disabled", true);
      $('.field-error').remove();

      $.ajax({
           url: site_url + '/nominee/portfolio/save',
           method: "POST",
           data: formData,
           processData: false,  // tell jQuery not to process the data
           contentType: false,  // tell jQuery not to set contentType
           success: function(response) {
                result = JSON.parse(response);
           },
           complete: function() {
                inputs.prop("disabled", false);
                $btn.button('reset');

                if(result.type) {
                    alert(result.message);
                    launchAlert(result.message, 'success');
                } else {
                    launchAlert(result.message, 'danger');
                    launchFieldError(result.field_error_messages);
                }

           },
           error: function() {
                alert("ERROR in running requested function. Page will now reload.");
                location.reload();
           }
        });
    });
  });
  
  function launchFieldError(field_messages)
  {
    for (var field in field_messages) {
      var message = field_messages[field];
      $('#'+field).parent().append('<div class="text-red field-error">'+message+'</div>').fadeIn();
    }
  }

  function replaceTextareaToCkeditor(element, max_word_count) {
    CKEDITOR.replace(element,{
      wordcount:{
        maxWordCount: max_word_count,
      }
    });
  }
</script>