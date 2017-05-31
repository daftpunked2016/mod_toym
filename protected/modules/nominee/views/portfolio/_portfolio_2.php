<input type="hidden" value="2" name="page" id="page_num" />
<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title"><strong style="margin-right:5px;">VI.</strong> <em class="text-muted">Supporting Photos</em></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="row">
      <div class="col-md-12" style="margin-left:10px;">
         <span class="text-muted">
          <strong><i class="fa fa-warning"></i> NOTE: </strong> 
          <ul>
            <!-- <li>All fields are required.</li> -->
            <li>All files must be in JPG or PNG format and cannot be greater than 3MB of size.</li>
          </ul>
        </span>
      </div>
    </div>
    <br />
    <?php $portfolio->printSupportingPhotosInput('supporting_photo_1'); ?>
    <br />
    <?php $portfolio->printSupportingPhotosInput('supporting_photo_2'); ?>
    <br />
    <?php $portfolio->printSupportingPhotosInput('supporting_photo_3'); ?>
    <br />
    <?php $portfolio->printSupportingPhotosInput('supporting_photo_4'); ?>
    <br />
  </div>
  <!-- /.box-body -->
</div>