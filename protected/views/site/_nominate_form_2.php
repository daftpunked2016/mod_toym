<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title"><strong style="margin-right:5px;">II.</strong> <em class="text-muted">Nominee's Info Sheet</em></h3>
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
      <?php echo $form->labelEx($nominee,'lastname',array('class'=>'col-sm-2 control-label')); ?>
      <div class="col-sm-10">
        <?php echo $form->textField($nominee,'lastname',array('class'=>'form-control', 'placeholder'=>'Last Name')); ?>
        <?php echo $form->error($nominee,'lastname', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="form-group">
      <?php echo $form->labelEx($nominee,'firstname',array('class'=>'col-sm-2 control-label')); ?>
      <div class="col-sm-10">
        <?php echo $form->textField($nominee,'firstname',array('class'=>'form-control', 'placeholder'=>'First Name')); ?>
        <?php echo $form->error($nominee,'firstname', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="form-group">
      <?php echo $form->labelEx($nominee,'middlename',array('class'=>'col-sm-2 control-label')); ?>
      <div class="col-sm-10">
        <?php echo $form->textField($nominee,'middlename',array('class'=>'form-control', 'placeholder'=>'Middle Name')); ?>
        <?php echo $form->error($nominee,'middlename', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="form-group">
      <?php echo $form->labelEx($nominee,'title',array('class'=>'col-sm-2 control-label')); ?>
      <div class="col-sm-10">
        <?php echo $form->textField($nominee,'title',array('class'=>'form-control', 'placeholder'=>'Title (e.g Dr., Mr., PhD, etc.) ')); ?>
        <?php echo $form->error($nominee,'title', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="form-group">
      <?php echo $form->labelEx($nominee,'name_on_trophy',array('class'=>'col-sm-2 control-label')); ?>
      <div class="col-sm-10">
        <?php echo $form->textField($nominee,'name_on_trophy',array('class'=>'form-control', 'placeholder'=>'Name to appear on the trophy')); ?>
        <?php echo $form->error($nominee,'name_on_trophy', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="form-group">
      <?php echo $form->labelEx($nominee,'phonetic_pronunciation',array('class'=>'col-sm-2 control-label')); ?>
      <div class="col-sm-10">
        <?php echo $form->textField($nominee,'phonetic_pronunciation',array('class'=>'form-control', 'placeholder'=>'Phonetic Pronunciation')); ?>
        <?php echo $form->error($nominee,'phonetic_pronunciation', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="form-group">
      <?php echo $form->labelEx($nominee,'email',array('class'=>'col-sm-2 control-label')); ?>
      <div class="col-sm-10">
        <?php echo $form->textField($nominee,'email',array('class'=>'form-control', 'placeholder'=>'E-mail')); ?>
        <?php echo $form->error($nominee,'email', array('class'=>'text-red')); ?>
        <span class="glyphicon glyphicon-envelope form-control-feedback" style="margin-right:20px;"></span>
      </div>
    </div>
    <!-- <div class="form-group">
      <?php // echo $form->labelEx($nominee,'password',array('class'=>'col-sm-2 control-label')); ?>
      <div class="col-sm-10">
        <?php // echo $form->passwordField($nominee,'password',array('class'=>'form-control', 'placeholder'=>'Password')); ?>
        <?php // echo $form->error($nominee,'password', array('class'=>'text-red')); ?>
        <span class="glyphicon glyphicon-lock form-control-feedback" style="margin-right:20px;"></span>
      </div>
    </div> -->
    <div class="form-group">
      <?php echo $form->labelEx($nominee,'profession',array('class'=>'col-sm-2 control-label')); ?>
      <div class="col-sm-10">
        <?php echo $form->textField($nominee,'profession',array('class'=>'form-control', 'placeholder'=>'Occupation or Profession')); ?>
        <?php echo $form->error($nominee,'profession', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="form-group">
      <?php echo $form->labelEx($nominee,'position',array('class'=>'col-sm-2 control-label')); ?>
      <div class="col-sm-10">
        <?php echo $form->textField($nominee,'position',array('class'=>'form-control', 'placeholder'=>'Position or Title')); ?>
        <?php echo $form->error($nominee,'position', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="form-group">
      <?php echo $form->labelEx($nominee,'toym_category_id',array('class'=>'col-sm-2 control-label')); ?>
      <div class="col-sm-10">
        <?php
          echo $form->dropDownList($nominee, 'toym_category_id',
            CHtml::listData($categories, 'id', 'catname'), array('empty' => 'Select Category..', 'class'=>'form-control', 'id'=>'toym-category-id'));
        ?>
        <?php echo $form->error($nominee,'toym_category_id', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="form-group">
      <?php echo $form->labelEx($nominee,'toym_subcategory_id',array('class'=>'col-sm-2 control-label')); ?>
      <div class="col-sm-10">
        <?php
          echo $form->dropDownList($nominee, 'toym_subcategory_id',
            CHtml::listData($subcategories, 'id', 'catdesc'), array('empty' => 'Select Subcategory..', 'class'=>'form-control', 'id'=>'toym-subcategory-id'));
        ?>
        <?php echo $form->error($nominee,'toym_subcategory_id', array('class'=>'text-red')); ?>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>