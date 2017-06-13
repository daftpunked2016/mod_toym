<style> 
.file { visibility: hidden; position: absolute; } 
.filename-upload-container:disabled { background-color: #FFF; }
.bootstrap-tagsinput {
  display:block, width:auto; margin: auto 0;
}

.img-prev-container {
  position: relative; 
  overflow: hidden; 
  width:50px; 
  height:50px; 
  border:1px solid #000;
  box-shadow:none;
}

.img-prev-container:hover {
  box-shadow: 0 0 10px #2F4F4F;
}

.img-prev-container img {
  display:block; 
  height:50px; 
  margin:0 auto;
}

</style>

<section class="content-header">
  <h1>
    <i class="fa fa-file-text" aria-hidden="true" style="margin-right:10px;"></i> BUILD PORTFOLIO
    <?php if($portfolio->status_id == 1) 
      echo "<span class='label label-success'><i class='fa fa-star'></i> SUBMITTED</span>";
      ?>
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
          <button type="button" class="btn btn-save btn-primary btn-lg" data-validate="0" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Saving.."> <i class="fa fa-check"></i> Save </button>
          <button type="button" class="btn btn-save btn-warning btn-lg" data-validate="1" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Saving.."> <i class="fa fa-check-square-o"></i> Save & Validate </button>
           
          <?php if($page == 3 && $portfolio->status_id != 1): ?>  
            <button type="button" id="btn-submit" class="btn btn-success btn-lg" disabled data-agree="0" data-toggle="tooltip" data-placement="top" title="You must AGREE first with the waiver statements." data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing.."> <i class="fa fa-send"></i> SUBMIT PORTFOLIO </button>
          <?php endif; ?>
        </div>
        <div class="pull-right">
          <?php if($page == 1): ?>
            <button type="button" class="btn btn-primary btn-lg btn-flat" disabled> <strong>1</strong> </button>
          <?php else: ?>
            <button type="button" class="btn btn-default btn-lg btn-flat btn-pager" data-page="1" data-loading-text="<i class='fa fa-spinner fa-spin'></i>"> <strong>1</strong> </a>
          <?php endif; ?>

          <?php if($page == 2): ?>
            <button type="button" class="btn btn-primary btn-lg btn-flat" disabled> <strong>2</strong> </button>
          <?php else: ?>
            <button type="button" class="btn btn-default btn-lg btn-flat btn-pager" data-page="2" data-loading-text="<i class='fa fa-spinner fa-spin'></i>"> <strong>2</strong> </a>
          <?php endif; ?>
          

          <?php if($page == 3): ?>
            <button type="button" class="btn btn-primary btn-lg btn-flat" disabled> <strong>3</strong> </button>
          <?php else: ?>
            <button type="button" class="btn btn-default btn-lg btn-flat btn-pager" data-page="3" data-loading-text="<i class='fa fa-spinner fa-spin'></i>"> <strong>3</strong> </a>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <br />

  <?php $this->endWidget(); ?>

</section>


<script src="<?php echo Yii::app()->request->baseUrl; ?>/page_assets/plugins/ckeditor/ckeditor.js"></script>

<script>
var module = "nominee";

$(document).ready(function() {
  <?php if($page == 1): ?>
  replaceTextareaToCkeditor('career_info_essay_1', 700);
  replaceTextareaToCkeditor('career_info_essay_2', 700);
  replaceTextareaToCkeditor('career_info_essay_3', 700);
  replaceTextareaToCkeditor('career_info_essay_4', 700);
  <?php endif; ?>
});
</script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/page_assets/dev/js/portfolio.js"></script>
