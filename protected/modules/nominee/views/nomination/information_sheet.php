<style> 
.file { visibility: hidden; position: absolute; } 
.filename-upload-container:disabled { background-color: #FFF; }
.bootstrap-tagsinput {
  display:block, width:auto; margin: auto 0;
}
</style>

<section class="content-header">
  <h1>
    <i class="fa fa-user-circle" aria-hidden="true" style="margin-right:10px;"></i> Information Sheet
  </h1>
</section>

<?php if($nominee_info->isNewRecord): ?>
<div class="row">
  <div class="col-md-12" style="padding:10px;">
    <div class="alert alert-info alert-dismissible" style="margin:0 15px;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-exclamation-circle"></i> Reminder</h4>
      Please complete the <b>Nomination Information Sheet</b> first before building and submitting your portfolio.
    </div>
  </div>
</div>
<?php endif; ?>

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
    'id'=>'nomination-info-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
    'htmlOptions'=>['enctype'=>'multipart/form-data','class'=>'form-horizontal',]
  )); 
  ?>

    <?= $this->renderPartial('_info_form_2', ['form'=>$form, 'nominee'=>$nominee, 'categories'=>$categories, 'subcategories'=>$subcategories]); ?>
    <? //= $this->renderPartial('_info_form_3', ['form'=>$form, 'nominee_essays'=>$nominee_essays]); ?>
    <?= $this->renderPartial('_info_form_4', ['form'=>$form, 'nominee_info'=>$nominee_info, 'countries'=>$countries]); ?>
    <div class="row">
      <div class="col-md-12">
        <div class="pull-right">
          <button type="button" class="btn btn-primary btn-lg btn-flat" id='btn-submit' data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing.."><i class="fa fa-check-square-o"></i> Save Changes</button>
          <?php // echo CHtml::submitButton('Nominate', array('class'=>'btn btn-primary btn-lg btn-flat', 'id'=>'btn-submit')); ?>
        </div>
      </div>
    </div>

  <?php $this->endWidget(); ?>

</section>


<script src="<?php echo Yii::app()->request->baseUrl; ?>/page_assets/plugins/ckeditor/ckeditor.js"></script>
<script>
  $(document).ready(function() {
    // replaceTextareaToCkeditor('nominator-essay-1', 700);
    // replaceTextareaToCkeditor('nominator-essay-2', 700);
    // replaceTextareaToCkeditor('nominator-essay-3', 700);
    CKEDITOR.replaceClass = 'ckeditor-basic';

    var toym_category = $('#toym-category-id').val();

    if (toym_category != "") {
      loadSubcategory(toym_category, $('#toym-subcategory-id').val());
    };

    if($('#toym-subcategory-id').find(":selected").text() == "Others (Specify)") {
      $('#subcategory-others').show();
    }

    $(document).on('change', '#toym-category-id', function() {
      loadSubcategory($(this).val());
    });

    $(document).on('change', '#toym-subcategory-id', function() {
      var selected = $(this).find("option[value='"+$(this).val()+"']").text();

      if(selected == "Others (Specify)") {
        $('#subcategory-others').fadeIn();
      } else {
        $('#subcategory-others').hide();
      }
    });

    $('#btn-submit').on('click', function () {
      $(this).removeClass('btn-primary').addClass('btn-warning disabled').html("<i class='fa fa-spinner fa-spin'></i> Saving..");
      $('#nomination-info-form').submit();
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