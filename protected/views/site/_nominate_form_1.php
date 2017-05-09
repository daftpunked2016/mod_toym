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
    <?php if($account == NULL): ?>
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
      <div class="form-group">
        <?php echo $form->labelEx($nominator,'email',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo $form->textField($nominator,'email',array('class'=>'form-control', 'placeholder'=>'E-mail')); ?>
          <?php echo $form->error($nominator,'email', array('class'=>'text-red')); ?>
          <span class="glyphicon glyphicon-envelope form-control-feedback" style="margin-right:20px;"></span>
        </div>
      </div>
      <div class="form-group">
        <?php echo $form->labelEx($nominator,'password',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo $form->passwordField($nominator,'password',array('class'=>'form-control', 'placeholder'=>'Password')); ?>
          <?php echo $form->error($nominator,'password', array('class'=>'text-red')); ?>
          <span class="glyphicon glyphicon-lock form-control-feedback" style="margin-right:20px;"></span>
        </div>
      </div>
      <div class="form-group">
        <?php echo $form->labelEx($nominator,'endorsing_chapter',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php
            echo $form->dropDownList($nominator, 'endorsing_chapter',
              CHtml::listData($chapters, 'id', 'chapter'), array('empty' => 'Select Endorsing Chapter..', 'class'=>'form-control'));
          ?> 
          <?php echo $form->error($nominator,'endorsing_chapter', array('class'=>'text-red')); ?>
          <small class="text-muted">If you do not have an <em>endorsing chapter</em>, please call:  <br /> Nancy  <strong><u>+6319-931-5182</u></strong> <br /> <em>(TOYM Secretariat)</em> </small><br />
        </div>
      </div>
      <?php echo $form->hiddenField($nominator,'is_jci_member',array('value'=>0)); ?>
    <?php else: ?>
       <div class="form-group">
        <?php echo $form->labelEx($nominator,'lastname',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo $form->textField($nominator,'lastname',array('class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Last Name', 'value'=>$account->user->lastname)); ?>
          <?php echo $form->error($nominator,'lastname', array('class'=>'text-red')); ?>
        </div>
      </div>
      <div class="form-group">
        <?php echo $form->labelEx($nominator,'firstname',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo $form->textField($nominator,'firstname',array('class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'First Name', 'value'=>$account->user->firstname)); ?>
          <?php echo $form->error($nominator,'firstname', array('class'=>'text-red')); ?>
        </div>
      </div>
      <div class="form-group">
        <?php echo $form->labelEx($nominator,'middlename',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo $form->textField($nominator,'middlename',array('class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Middle Name', 'value'=>$account->user->middlename)); ?>
          <?php echo $form->error($nominator,'middlename', array('class'=>'text-red')); ?>
        </div>
      </div>
      <div class="form-group">
        <?php echo $form->labelEx($nominator,'home_address',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo $form->textField($nominator,'home_address',array('class'=>'form-control', 'placeholder'=>'Home Address', 'value'=>$account->user->address)); ?>
          <?php echo $form->error($nominator,'home_address', array('class'=>'text-red')); ?>
        </div>
      </div>
      <div class="form-group">
        <?php echo $form->labelEx($nominator,'mobile_no',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo $form->textField($nominator,'mobile_no',array('class'=>'form-control', 'placeholder'=>'Mobile No.', 'value'=>$account->user->contactno)); ?>
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
      <div class="form-group">
        <?php echo $form->labelEx($nominator,'email',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
          <?php echo $form->textField($nominator,'email',array('class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'E-mail', 'value'=>$account->username)); ?>
          <?php echo $form->error($nominator,'email', array('class'=>'text-red')); ?>
          <span class="glyphicon glyphicon-envelope form-control-feedback" style="margin-right:20px;"></span>
        </div>
      </div>
      <?php echo $form->hiddenField($nominator,'endorsing_chapter',array('value'=>$account->user->chapter_id)); ?>
      <?php echo $form->hiddenField($nominator,'password',array('value'=>'jcipmember')); ?>
      <?php echo $form->hiddenField($nominator,'is_jci_member',array('value'=>1)); ?>
      <?php echo $form->hiddenField($nominator,'account_id',array('value'=>$account->id)); ?>
    <?php endif; ?>
  </div>
  <!-- /.box-body -->
</div>