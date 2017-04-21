<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title"><strong style="margin-right:5px;">IV.</strong> <em class="text-muted">More Info</em></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="row form-group">
      <div class="col-md-6">
        <?php echo $form->labelEx($nominee_info,'citizenship',array('class'=>'control-label')); ?>
        <?php echo $form->textField($nominee_info,'citizenship',array('class'=>'form-control', 'placeholder'=>'Citizenship')); ?>
        <?php echo $form->error($nominee_info,'citizenship', array('class'=>'text-red')); ?>
      </div>
      <div class="col-md-6">
        <?php echo $form->labelEx($nominee_info,'civil_status',array('class'=>'control-label')); ?>
       <?php
          echo $form->dropDownList($nominee_info, 'civil_status',
            ['S'=>'Single', 'M'=>'Married', 'W'=>'Widowed'], array('empty' => 'Select Civil Status..', 'class'=>'form-control' ));
        ?>
        <?php echo $form->error($nominee_info,'civil_status', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="row form-group">
      <div class="col-md-6">
        <?php echo $form->labelEx($nominee_info,'gender',array('class'=>'control-label')); ?>
        <?php
          echo $form->dropDownList($nominee_info, 'gender',
            ['M'=>'Male', 'F'=>'Female'], array('empty' => 'Select Gender..', 'class'=>'form-control' ));
        ?>
        <?php echo $form->error($nominee_info,'gender', array('class'=>'text-red')); ?>
      </div>
      <div class="col-md-6">
        <?php echo $form->labelEx($nominee_info,'birthdate',array('class'=>'control-label')); ?>
        <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                  'model' => $nominee_info,
                  'attribute' => 'birthdate',
                  'options'=>array(
                    'showAnim'=>'slideDown',
                    'yearRange'=>'-60:-18',
                    'changeMonth' => true,
                    'changeYear' => true,
                    'dateFormat' => 'yy-mm-dd'
                    ),
                  'htmlOptions' => array(
                    'size' => 20,         // textField size
                    'class' => 'form-control',

                  ),  
                ));
              ?>
        <?php echo $form->error($nominee_info,'birthdate', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="row form-group">
      <div class="col-md-6">
        <?php echo $form->labelEx($nominee_info,'birthplace',array('class'=>'control-label')); ?>
        <?php echo $form->textField($nominee_info,'birthplace',array('class'=>'form-control', 'placeholder'=>'Place of Birth')); ?>
        <?php echo $form->error($nominee_info,'birthplace', array('class'=>'text-red')); ?>
      </div>
      <div class="col-md-6">
        <?php echo $form->labelEx($nominee_info,'home_address',array('class'=>'control-label')); ?>
        <?php echo $form->textField($nominee_info,'home_address',array('class'=>'form-control', 'placeholder'=>'Home Address')); ?>
        <?php echo $form->error($nominee_info,'home_address', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-6">
        <?php echo $form->labelEx($nominee_info,'province',array('class'=>'control-label')); ?>
        <?php echo $form->textField($nominee_info,'province',array('class'=>'form-control', 'placeholder'=>'Province')); ?>
        <?php echo $form->error($nominee_info,'province', array('class'=>'text-red')); ?>
      </div>
      <div class="col-md-6">
        <?php echo $form->labelEx($nominee_info,'city',array('class'=>'control-label')); ?>
        <?php echo $form->textField($nominee_info,'city',array('class'=>'form-control', 'placeholder'=>'City')); ?>
        <?php echo $form->error($nominee_info,'city', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-6">
        <?php echo $form->labelEx($nominee_info,'country',array('class'=>'control-label')); ?>
        <?php
          echo $form->dropDownList($nominee_info, 'country',
            CHtml::listData($countries, 'id', 'country_name'), array('empty' => 'Select Country..', 'class'=>'form-control' ));
        ?>
        <?php echo $form->error($nominee_info,'country', array('class'=>'text-red')); ?>
      </div>
      <div class="col-md-6">
        <?php echo $form->labelEx($nominee_info,'home_telephone',array('class'=>'control-label')); ?>
        <?php echo $form->textField($nominee_info,'home_telephone',array('class'=>'form-control', 'placeholder'=>'Home Telephone')); ?>
        <?php echo $form->error($nominee_info,'home_telephone', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-6">
        <?php echo $form->labelEx($nominee_info,'mobile_no',array('class'=>'control-label')); ?>
        <?php echo $form->textField($nominee_info,'mobile_no',array('class'=>'form-control', 'placeholder'=>'mobile_no')); ?>
        <?php echo $form->error($nominee_info,'mobile_no', array('class'=>'text-red')); ?>
      </div>
      <div class="col-md-6">
        <?php echo $form->labelEx($nominee_info,'spouse_name',array('class'=>'control-label')); ?>
        <?php echo $form->textField($nominee_info,'spouse_name',array('class'=>'form-control', 'placeholder'=>'Spouse Name')); ?>
        <?php echo $form->error($nominee_info,'spouse_name', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-12">
        <?php echo $form->labelEx($nominee_info,'children_name',array('class'=>'control-label')); ?> <small class="text-muted">(Press "Enter" key to add new entry)</small>
        <?php echo $form->textField($nominee_info,'children_name',array('class'=>'form-control','id'=>'children-name', 'data-role'=>'tagsinput', 'style'=>'width:100%', 'placeholder'=>'Children Name')); ?>
        <?php echo $form->error($nominee_info,'children_name', array('class'=>'text-red')); ?>
      </div>
    </div>
    <hr />
    <div class="row">
      <div class="col-md-12">
        <h4>Educational Attainment *</h4>
      </div>
    </div>
    <div class="row form-group">
      <div class="col-md-6">
        <?php echo $form->labelEx($nominee_info,'grade_school',array('class'=>'control-label')); ?>
        <?php echo $form->textField($nominee_info,'grade_school',array('class'=>'form-control', 'placeholder'=>'Grade School')); ?>
        <?php echo $form->error($nominee_info,'grade_school', array('class'=>'text-red')); ?>
      </div>
      <div class="col-md-6">
        <?php echo $form->labelEx($nominee_info,'high_school',array('class'=>'control-label')); ?>
        <?php echo $form->textField($nominee_info,'high_school',array('class'=>'form-control', 'placeholder'=>'High School')); ?>
        <?php echo $form->error($nominee_info,'high_school', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="row form-group">
      <div class="col-md-6">
        <?php echo $form->labelEx($nominee_info,'college',array('class'=>'control-label')); ?>
        <?php echo $form->textField($nominee_info,'college',array('class'=>'form-control', 'placeholder'=>'College')); ?>
        <?php echo $form->error($nominee_info,'college', array('class'=>'text-red')); ?>
      </div>
      <div class="col-md-6">
        <?php echo $form->labelEx($nominee_info,'college_degree',array('class'=>'control-label')); ?>
        <?php echo $form->textField($nominee_info,'college_degree',array('class'=>'form-control', 'placeholder'=>'Course/Degree')); ?>
        <?php echo $form->error($nominee_info,'college_degree', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="row form-group">
      <div class="col-md-6">
        <?php echo $form->labelEx($nominee_info,'post_graduate',array('class'=>'control-label')); ?>
        <?php echo $form->textField($nominee_info,'post_graduate',array('class'=>'form-control', 'placeholder'=>'Post-Graduate')); ?>
        <?php echo $form->error($nominee_info,'post_graduate', array('class'=>'text-red')); ?>
      </div>
      <div class="col-md-6">
        <?php echo $form->labelEx($nominee_info,'post_graduate_degree',array('class'=>'control-label')); ?>
        <?php echo $form->textField($nominee_info,'post_graduate_degree',array('class'=>'form-control', 'placeholder'=>'Course/Degree')); ?>
        <?php echo $form->error($nominee_info,'post_graduate_degree', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-6">
        <?php echo $form->labelEx($nominee_info,'academic_honors',array('class'=>'control-label')); ?>
        <?php echo $form->textField($nominee_info,'academic_honors',array('class'=>'form-control', 'placeholder'=>'Academic Honors')); ?>
        <?php echo $form->error($nominee_info,'academic_honors', array('class'=>'text-red')); ?>
      </div>
    </div>

    <hr />

    <div class="row form-group">
      <div class="col-md-6">
        <?php echo $form->labelEx($nominee_info,'name_business_employer',array('class'=>'control-label')); ?>
        <?php echo $form->textField($nominee_info,'name_business_employer',array('class'=>'form-control', 'placeholder'=>'Name of Business or Employer')); ?>
        <?php echo $form->error($nominee_info,'name_business_employer', array('class'=>'text-red')); ?>
      </div>
      <div class="col-md-6">
        <?php echo $form->labelEx($nominee_info,'business_address',array('class'=>'control-label')); ?>
        <?php echo $form->textField($nominee_info,'business_address',array('class'=>'form-control', 'placeholder'=>'Business Address')); ?>
        <?php echo $form->error($nominee_info,'business_address', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="row form-group">
      <div class="col-md-6">
        <?php echo $form->labelEx($nominee_info,'business_phone_no',array('class'=>'control-label')); ?>
        <?php echo $form->textField($nominee_info,'business_phone_no',array('class'=>'form-control', 'placeholder'=>'Tel. No.')); ?>
        <?php echo $form->error($nominee_info,'business_phone_no', array('class'=>'text-red')); ?>
      </div>
      <div class="col-md-6">
        <?php echo $form->labelEx($nominee_info,'length_of_service_with_business_employer',array('class'=>'control-label')); ?>
        <?php echo $form->textField($nominee_info,'length_of_service_with_business_employer',array('class'=>'form-control', 'placeholder'=>'')); ?>
        <?php echo $form->error($nominee_info,'length_of_service_with_business_employer', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-12">
        <?php echo $form->labelEx($nominee_info,'organization_affiliation',array('class'=>'control-label')); ?>
        <?php echo $form->textArea($nominee_info,'organization_affiliation',array('class'=>'form-control ckeditor-basic','id'=>'organization-affiliation', 'placeholder'=>'')); ?>
        <?php echo $form->error($nominee_info,'organization_affiliation', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-12">
        <?php echo $form->labelEx($nominee_info,'positions_held_term_office',array('class'=>'control-label')); ?>
        <?php echo $form->textArea($nominee_info,'positions_held_term_office',array('class'=>'form-control ckeditor-basic','id'=>'positions-held-term-office', 'placeholder'=>'')); ?>
        <?php echo $form->error($nominee_info,'positions_held_term_office', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="row form-group">
      <div class="col-md-12">
        <?php echo $form->labelEx($nominee_info,'derogatory_information',array('class'=>'control-label')); ?> <span class="text-muted">(if any)</span>
        <?php echo $form->textField($nominee_info,'derogatory_information',array('class'=>'form-control', 'placeholder'=>'')); ?>
        <?php echo $form->error($nominee_info,'derogatory_information', array('class'=>'text-red')); ?>
      </div>
      <br />
      <div class="col-md-12">
        <?php echo $form->labelEx($nominee_info,'warranty_of_originality_creation',array('class'=>'control-label')); ?> <span class="text-muted">(if any)</span>
        <?php echo $form->textField($nominee_info,'warranty_of_originality_creation',array('class'=>'form-control', 'placeholder'=>'')); ?>
        <?php echo $form->error($nominee_info,'warranty_of_originality_creation', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-12">
        <?php echo $form->labelEx($nominee_info,'published_work',array('class'=>'control-label')); ?>
        <?php echo $form->textArea($nominee_info,'published_work',array('class'=>'form-control ckeditor-basic','id'=>'published-work', 'placeholder'=>'')); ?>
        <?php echo $form->error($nominee_info,'published_work', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-12">
        <?php echo $form->labelEx($nominee_info,'category',array('class'=>'control-label')); ?>
        <?php echo $form->textArea($nominee_info,'category',array('class'=>'form-control ckeditor-basic','id'=>'organization-affiliation', 'placeholder'=>'')); ?>
        <?php echo $form->error($nominee_info,'category', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-12">
        <label>List most important published works and a brief description of each:* </label>
        <?php echo $form->textArea($nominee_info,'important_published_works',array('class'=>'form-control ckeditor-basic','id'=>'organization-affiliation', 'placeholder'=>'')); ?>
        <?php echo $form->error($nominee_info,'important_published_works', array('class'=>'text-red')); ?>
      </div>
    </div>
    
  </div>
  <!-- /.box-body -->
</div>