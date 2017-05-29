<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title"><em class="text-muted">In the Words of the Nominator</em></h3>
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
        <label>Explain how the nominee exemplifies the principle expressed in the following line of the JCI VALUES, “That service to humanity is the best work of life.” *</label>
        <?php echo $form->textArea($nominee_essays,'nominator_essay_1',array('class'=>'form-control nominator-essays','id'=>'nominator-essay-1', 'placeholder'=>'')); ?>
        <?php echo $form->error($nominee_essays,'nominator_essay_1', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-12">
        <label>In your own words, why do you believe that the nominee should be selected as one of the JCI The Outstanding Young Men of the Philippines? *</label>
        <?php echo $form->textArea($nominee_essays,'nominator_essay_2',array('class'=>'form-control nominator-essays', 'id'=>'nominator-essay-2','placeholder'=>'')); ?>
        <?php echo $form->error($nominee_essays,'nominator_essay_2', array('class'=>'text-red')); ?>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-12">
        <label>Describe how the nominee and his published works or accomplishments contribute to Filipino's welfare and the Philippines at large. *</label>
        <?php echo $form->textArea($nominee_essays,'nominator_essay_3',array('class'=>'form-control nominator-essays', 'id'=>'nominator-essay-3', 'placeholder'=>'')); ?>
        <?php echo $form->error($nominee_essays,'nominator_essay_3', array('class'=>'text-red')); ?>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>