<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title"><strong style="margin-right:5px;">I.</strong> <em class="text-muted">Nominator's Info</em></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="row">
      <div class="col-md-12" style="margin-left:10px;">
        <span class="text-muted"><strong><i class="fa fa-warning"></i> NOTE: </strong> All fields are required. Please indicate  <strong>N/A</strong> if not applicable.</span>
      </div>
    </div>
    <br />
    <div class="form-group">
      <?php echo $form->labelEx($nominator,'lastname',array('class'=>'col-sm-2 control-label')); ?>
      <div class="col-sm-10">
        <?php echo $form->textField($nominator,'lastname',array('class'=>'form-control', 'placeholder'=>'Last Name')); ?>
        <?php echo $form->error($nominator,'lastname', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="form-group">
      <?php echo $form->labelEx($nominator,'firstname',array('class'=>'col-sm-2 control-label')); ?>
      <div class="col-sm-10">
        <?php echo $form->textField($nominator,'firstname',array('class'=>'form-control', 'placeholder'=>'First Name')); ?>
        <?php echo $form->error($nominator,'firstname', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="form-group">
      <?php echo $form->labelEx($nominator,'middlename',array('class'=>'col-sm-2 control-label')); ?>
      <div class="col-sm-10">
        <?php echo $form->textField($nominator,'middlename',array('class'=>'form-control', 'placeholder'=>'Middle Name')); ?>
        <?php echo $form->error($nominator,'middlename', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="form-group">
      <?php echo $form->labelEx($nominator,'home_address',array('class'=>'col-sm-2 control-label')); ?>
      <div class="col-sm-10">
        <?php echo $form->textField($nominator,'home_address',array('class'=>'form-control', 'placeholder'=>'Home Address')); ?>
        <?php echo $form->error($nominator,'home_address', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="form-group">
      <?php echo $form->labelEx($nominator,'mobile_no',array('class'=>'col-sm-2 control-label')); ?>
      <div class="col-sm-10">
        <?php echo $form->textField($nominator,'mobile_no',array('class'=>'form-control', 'placeholder'=>'Mobile No.')); ?>
        <?php echo $form->error($nominator,'mobile_no', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="form-group">
      <?php echo $form->labelEx($nominator,'home_telephone',array('class'=>'col-sm-2 control-label')); ?>
      <div class="col-sm-10">
        <?php echo $form->textField($nominator,'home_telephone',array('class'=>'form-control', 'placeholder'=>'Home Telephone')); ?>
        <?php echo $form->error($nominator,'home_telephone', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="form-group">
      <?php echo $form->labelEx($nominator,'business_address',array('class'=>'col-sm-2 control-label')); ?>
      <div class="col-sm-10">
        <?php echo $form->textField($nominator,'business_address',array('class'=>'form-control', 'placeholder'=>'Business or Office Address')); ?>
        <?php echo $form->error($nominator,'business_address', array('class'=>'text-red')); ?>
      </div>
    </div>
    
  </div>
  <!-- /.box-body -->
</div>