<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title"><strong style="margin-right:5px;">V.</strong> <em class="text-muted">Nominee's Career Info</em></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="row">
      <div class="col-md-12" style="margin-left:10px;">
        <span class="text-muted">
          <strong><i class="fa fa-warning"></i> NOTE: </strong> 
          <ul>
            <li>All fields are required. Please indicate  <strong>N/A</strong> if not applicable.</li>
            <li>Each category requires a minimum of 250 words but not exceeding 700 words </li>
          </ul>
        </span>
      </div>
    </div>
    <br />
    <div class="form-group">
      <div class="col-md-12">
        <label>Outline the timeline of the nominee’s career or field of activity *</label>
        <?php echo $form->textArea($portfolio,'career_info_essay_1',array('class'=>'form-control', 'id'=>'career_info_essay_1', 'placeholder'=>'')); ?>
        <?php echo $form->error($portfolio,'career_info_essay_1', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-12">
        <label>Provide additional details on the exceptional achievements of the nominee, and/or the challenges he/she has overcome to achieve them *</label>
        <?php echo $form->textArea($portfolio,'career_info_essay_2',array('class'=>'form-control','id'=>'career_info_essay_2', 'placeholder'=>'')); ?>
        <?php echo $form->error($portfolio,'career_info_essay_2', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-12">
        <label>List important awards and honors the nominee received that illustrate his/her achievements. Include a brief description of each *</label>
        <?php echo $form->textArea($portfolio,'career_info_essay_3',array('class'=>'form-control', 'id'=>'career_info_essay_3','placeholder'=>'')); ?>
        <?php echo $form->error($portfolio,'career_info_essay_3', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-12">
        <label>List any quotes from authorities that illustrate his/her achievements *</label>
        <?php echo $form->textArea($portfolio,'career_info_essay_4',array('class'=>'form-control','id'=>'career_info_essay_4', 'placeholder'=>'')); ?>
        <?php echo $form->error($portfolio,'career_info_essay_4', array('class'=>'text-red')); ?>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>