<input type="hidden" value="3" name="page" id="page_num" />
<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title"><strong style="margin-right:5px;">VII.</strong> <em class="text-muted">Related Documents</em></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="row">
      <div class="col-md-12" style="margin-left:10px;">
        <span class="text-muted"><strong><i class="fa fa-warning"></i> NOTE: </strong> All fields are required.</span>
      </div>
    </div>
    <br />
    <div class="form-group has-feedback">
      <?php echo $form->labelEx($portfolio,'photograph_upload_id',array('class'=>'col-sm-3 control-label')); ?>
      <?php if($portfolio->photograph_upload_id != "" || $portfolio->photograph_upload_id != null): ?>
        <?php $file_path = ToymFileUploads::getFilePath($portfolio->photograph_upload_id);
          echo "  
          <div class='col-sm-1'>
            <a href='{$file_path}' target='_blank'>
              <div class='img-prev-container'>
                <img src='{$file_path}' />
              </div>
            </a>            
          </div>
          <div class='col-sm-8'>
            <div class='btn-group btn-block' role='group' style='margin-top:8px;'>
              <a href='{$file_path}' target='_blank' class='btn btn-info' data-toggle='tooltip' data-placement='top' title='Click to Load/View File Uploaded..'><i class='fa fa-search' style='margin-right:10px'></i><span style='margin-right:20px;'> View Image </span></a>
              <span class='btn btn-danger delete-file' data-fid='".$portfolio->photograph_upload_id."' data-attribute='photograph_upload_id' data-toggle='tooltip' data-placement='top' title='Click to Delete File Uploaded..'><i class='fa fa-trash' style='margin-right:10px'></i><span style='margin-right:20px;'> Delete Image </span></span>
            </div>
          </div>";
        ?>
      <?php else: ?>
        <input type="file" name="photograph_upload_id" id="photograph_upload_id" class="file" data-allowed="{'jpg','jpeg','png'}">
        <div class="input-group col-sm-9" style="padding:0 20px;" data-allowed="{'jpg','jpeg','png'}">
          <span class="input-group-btn">
            <button class="browse btn btn-default" type="button"><i class="glyphicon glyphicon-plus"></i> Select File </button>
          </span>
          <input type="text" class="form-control filename-upload-container" disabled placeholder="No file selected..">
        </div>
      <?php endif; ?>
      <div class="col-sm-offset-3 col-sm-9">
        <?php echo $form->error($portfolio,'photograph_upload_id', array('class'=>'text-red')); ?>
        <br />
        <small class="text-muted">
          A good quality, 4" x 6" (10 cm x 15 cm), head-and-shoulders photograph must be uploaded along with the official nomination form. <br />
          This file must be in JPG Format and cannot be greater than 3MB of size.
        </small>
      </div>
    </div>
    <div class="form-group has-feedback">
      <?php echo $form->labelEx($portfolio,'id_birth_cert_upload_id',array('class'=>'col-sm-3 control-label')); ?>
      <?php if($portfolio->id_birth_cert_upload_id != "" || $portfolio->id_birth_cert_upload_id != null): ?>
        <?php $file_path = ToymFileUploads::getFilePath($portfolio->id_birth_cert_upload_id);
          echo "  
          <div class='col-sm-9'>
            <div class='btn-group btn-block' role='group' style='margin-top:8px;'>
              <a href='{$file_path}' target='_blank' class='btn btn-info' data-toggle='tooltip' data-placement='top' title='Click to Load/View File Uploaded..'><i class='fa fa-search' style='margin-right:10px'></i><span style='margin-right:20px;'> View File </span></a>
              <span class='btn btn-danger delete-file' data-fid='".$portfolio->id_birth_cert_upload_id."' data-attribute='id_birth_cert_upload_id' data-toggle='tooltip' data-placement='top' title='Click to Delete File Uploaded..'><i class='fa fa-trash' style='margin-right:10px'></i><span style='margin-right:20px;'> Delete File </span></span>
            </div>
          </div>";
        ?>
      <?php else: ?>
        <input type="file" name="id_birth_cert_upload_id" id="id_birth_cert_upload_id" class="file" data-allowed="{'jpg','jpeg','png', 'pdf'}">
        <div class="input-group col-sm-9" style="padding:0 20px;">
          <span class="input-group-btn" >
            <button class="browse btn btn-default" type="button"><i class="glyphicon glyphicon-plus"></i> Select File </button>
          </span>
          <input type="text" class="form-control filename-upload-container" disabled placeholder="No file selected..">
        </div>
      <?php endif; ?>
      <div class="col-sm-offset-3 col-sm-9">
        <?php echo $form->error($portfolio,'id_birth_cert_upload_id', array('class'=>'text-red')); ?>
        <br />
        <small class="text-muted">
          A certified copy of the ID/Birth Certificate should be uploaded along with the nomination form to prove the age of the nominee. <br />
          We accept any official document indicating the birth date of the nominee. JCI requests this document to check that the nominee is in JCI age. <br />
          This file must be in JPG or PDF Format and cannot be greater than 3MB of size
        </small>
      </div>
    </div>
    <div class="form-group has-feedback">
      <?php echo $form->labelEx($portfolio,'nbi_clearance_upload_id',array('class'=>'col-sm-3 control-label')); ?>
      <?php if($portfolio->nbi_clearance_upload_id != "" || $portfolio->nbi_clearance_upload_id != null): ?>
        <?php $file_path = ToymFileUploads::getFilePath($portfolio->nbi_clearance_upload_id);
          echo "  
          <div class='col-sm-9'>
            <div class='btn-group btn-block' role='group' style='margin-top:8px;'>
              <a href='{$file_path}' target='_blank' class='btn btn-info' data-toggle='tooltip' data-placement='top' title='Click to Load/View File Uploaded..'><i class='fa fa-search' style='margin-right:10px'></i><span style='margin-right:20px;'> View File </span></a>
              <span class='btn btn-danger delete-file' data-fid='".$portfolio->nbi_clearance_upload_id."' data-attribute='nbi_clearance_upload_id' data-toggle='tooltip' data-placement='top' title='Click to Delete File Uploaded..'><i class='fa fa-trash' style='margin-right:10px'></i><span style='margin-right:20px;'> Delete File </span></span>
            </div>
          </div>";
        ?>
      <?php else: ?>
        <input type="file" name="nbi_clearance_upload_id" id="nbi_clearance_upload_id" class="file" data-allowed="{'jpg','jpeg','png', 'pdf'}">
        <div class="input-group col-sm-9" style="padding:0 20px;">
          <span class="input-group-btn" >
            <button class="browse btn btn-default" type="button"><i class="glyphicon glyphicon-plus"></i> Select File </button>
          </span>
          <input type="text" class="form-control filename-upload-container" disabled placeholder="No file selected..">
        </div>
      <?php endif; ?>
      <div class="col-sm-offset-3 col-sm-9">
        <?php echo $form->error($portfolio,'nbi_clearance_upload_id', array('class'=>'text-red')); ?>
        <br />
        <small class="text-muted">
          A certified copy of the NBI Clearance should be uploaded.<br />
          This file must be in JPG or PDF Format and cannot be greater than 3MB of size
        </small>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>

<?php if($portfolio->status_id == 2): ?>
<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title"><strong style="margin-right:5px;">VIII.</strong> <em class="text-muted">Waiver</em></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="row">
      <div class="col-md-offset-1 col-md-10">
      
        <iframe class="embed-responsive-item" src="<?= Yii::app()->createUrl('nominator/portfolio/waiver'); ?>" height="200" width="100%" frameborder="1"> </iframe>
        <br /><br />
        <p class="text-center">
          <input type="checkbox" name="agree" style="margin-right:10px;" id="waiver-agree" /> <strong> I AGREE TO THE WAIVER STATEMENTS *</strong>
        </p>
      </div>
    </div>

  </div>
  <!-- /.box-body -->
</div>
<?php endif; ?>