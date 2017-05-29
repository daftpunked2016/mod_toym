<section class="content-header">
  <h1>
    <i class="fa fa-key" aria-hidden="true" style="margin-right:10px;"></i> Change Password
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

  <div class="row">
    <div class="col-md-offset-2 col-md-8">
        <?php 
          $form = $this->beginWidget('CActiveForm', array(
            'id'=>'change-password-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation'=>false,
            'htmlOptions'=>['enctype'=>'multipart/form-data','class'=>'form-horizontal',]
          )); 
          ?>
            <div class="box box-info">
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12" style="margin-left:10px;">
                    <span class="text-muted"><strong><i class="fa fa-warning"></i> NOTE: </strong> All fields are required.</span>
                  </div>
                </div>
                <br />
                <div class="form-group">
                  <?php echo $form->labelEx($nominator,'current_password',array('class'=>'col-sm-3 control-label')); ?>
                  <div class="col-sm-9">
                    <?php echo $form->passwordField($nominator,'current_password',array('class'=>'form-control', 'placeholder'=>'Current Password', 'value'=>'')); ?>
                    <?php echo $form->error($nominator,'current_password', array('class'=>'text-red')); ?>
                  </div>
                </div>
                <div class="form-group">
                  <?php echo $form->labelEx($nominator,'new_password',array('class'=>'col-sm-3 control-label')); ?>
                  <div class="col-sm-9">
                    <?php echo $form->passwordField($nominator,'new_password',array('class'=>'form-control', 'placeholder'=>'New Password')); ?>
                    <?php echo $form->error($nominator,'new_password', array('class'=>'text-red')); ?>
                  </div>
                </div>
                <div class="form-group">
                  <?php echo $form->labelEx($nominator,'confirm_password',array('class'=>'col-sm-3 control-label')); ?>
                  <div class="col-sm-9">
                    <?php echo $form->passwordField($nominator,'confirm_password',array('class'=>'form-control', 'placeholder'=>'Confirm Password')); ?>
                    <?php echo $form->error($nominator,'confirm_password', array('class'=>'text-red')); ?>
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
            </div>
            
            <div class="row">
              <div class="col-md-12">
                <div class="pull-right">
                  <button class="btn btn-primary btn-lg btn-flat" id="btn-submit"> Change Password </button>
                </div>
              </div>
            </div>

          <?php $this->endWidget(); ?>
    </div>
  </div>

</section>

<script>
$(function() {
  $('#btn-submit').on('click', function () {
    $(this).removeClass('btn-primary').addClass('btn-warning disabled').html("<i class='fa fa-spinner fa-spin'></i> Saving..");
    $('#change-password-form').submit();
  });
});
</script>
