<style> 
.file { visibility: hidden; position: absolute; } 
.filename-upload-container:disabled { background-color: #FFF; }
.bootstrap-tagsinput {
  display:block, width:auto; margin: auto 0;
}
</style>

<section class="content-header">
  <h1>
    <i class="fa fa-user-circle" aria-hidden="true" style="margin-right:10px;"></i> NOMINATION FORM
  </h1>
</section>


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
    'id'=>'nomination-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
    'htmlOptions'=>['enctype'=>'multipart/form-data','class'=>'form-horizontal',]
  )); 
  ?>

    <?= $this->renderPartial('_nominate_form_1', ['form'=>$form, 'nominator'=>$nominator, 'chapters'=>$chapters, 'account'=>$account]); ?>
    <?= $this->renderPartial('_nominate_form_2', ['form'=>$form, 'nominee'=>$nominee, 'categories'=>$categories, 'subcategories'=>$subcategories]); ?>
    <?= $this->renderPartial('_nominate_form_3', ['form'=>$form, 'nominee_essays'=>$nominee_essays]); ?>
    <?= $this->renderPartial('_nominate_form_4', ['form'=>$form, 'nominee_info'=>$nominee_info, 'countries'=>$countries]); ?>
    <?= $this->renderPartial('_nominate_form_5', ['form'=>$form, 'nominee_essays'=>$nominee_essays]); ?>
    <?= $this->renderPartial('_nominate_form_6', ['form'=>$form, 'nominee_info'=>$nominee_info]); ?>

    <div class="row">
      <div class="col-md-12">
        <div class="pull-left">
          <?php echo CHtml::link('Cancel', array('site/cancelnominate'), array('class'=>'btn btn-danger btn-block btn-flat')); ?>
        </div>
        <div class="pull-right">
          <button type="button" class="btn btn-primary btn-lg btn-flat" id='btn-submit' data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing.."><i class="fa fa-check-square-o"></i> NOMINATE</button>
          <?php // echo CHtml::submitButton('Nominate', array('class'=>'btn btn-primary btn-lg btn-flat', 'id'=>'btn-submit')); ?>
        </div>
      </div>
    </div>

  <?php $this->endWidget(); ?>

</section>


<script src="<?php echo Yii::app()->request->baseUrl; ?>/page_assets/plugins/ckeditor/ckeditor.js"></script>
<script>
  $(document).ready(function() {
    replaceTextareaToCkeditor('nominator-essay-1', 700);
    replaceTextareaToCkeditor('nominator-essay-2', 700);
    replaceTextareaToCkeditor('nominator-essay-3', 700);
    replaceTextareaToCkeditor('career-info-essay-1', 700);
    replaceTextareaToCkeditor('career-info-essay-2', 700);
    replaceTextareaToCkeditor('career-info-essay-3', 700);
    replaceTextareaToCkeditor('career-info-essay-4', 700);
    CKEDITOR.replaceClass = 'ckeditor-basic';

    var toym_category = $('#toym-category-id').val();

    if (toym_category != "") {
      loadSubcategory(toym_category, $('#toym-subcategory-id').val());
    };

    $(document).on('click', '.browse', function(){
      var file = $(this).parent().parent().parent().find('.file');
      file.trigger('click');
    });

    $(document).on('change', '#toym-category-id', function() {
      loadSubcategory($(this).val());
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

    $('#btn-submit').on('click', function () {
      $(this).removeClass('btn-primary').addClass('btn-warning disabled').html("<i class='fa fa-spinner fa-spin'></i> Processing");
      $('#nomination-form').submit();
    });
  });

  function loadSubcategory(category, default_value) {
   $.ajax({
      url: "<?php echo Yii::app()->createUrl('site/listsubcategoryoptions'); ?>",
      data: { category_id : category },
      method: "POST",
      success: function(response) {
        $('#toym-subcategory-id').html(response);

        if(default_value) $('#toym-subcategory-id').val(default_value);
      }
    });
  }

  function replaceTextareaToCkeditor(element, max_word_count) {
    CKEDITOR.replace(element,{
      wordcount:{
        maxWordCount: max_word_count,
      }
    });
  }
</script>