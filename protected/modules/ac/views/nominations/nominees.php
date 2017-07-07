<section class="content-header">
	<?php foreach(Yii::app()->user->getFlashes() as $key=>$message) {
		if($key  === 'success')
			{
			echo "<div class='alert alert-success alert-dismissible' role='alert'>
			<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>".
			$message.'</div>';
			}
		else
			{
			echo "<div class='alert alert-danger alert-dismissible' role='alert'>
			<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>".
			$message.'</div>';
			}
		}
	?>

<?php 
switch($status) {
	case 1:
		$status_str = "APPROVED";
		break;
	case 2:
		$status_str = "Pending to NC";
		break;
	case 3:
		$status_str = "Pending";
		break;
	case 4:
		$status_str = "Rejected by NC";
		break;
	case 5:
		$status_str = "Rejected by AC";
		break;
	default:
		$status_str = "*ALL";
}
?>
<h1>Nominations <?= Yii::getVersion(); ?> <em class="text-muted">(<?= $status_str; ?>)</em></h1>
</section>

<section class="content">
	<div class="well" style="padding: 10px;">
		<div class="row">
			<form method="GET" action="<?= Yii::app()->createUrl('ac/nominations/nominees'); ?>">
				<div class="col-md-4">
					<div class="form-group">
						<label for="credentials">Search</label>
						<input type="text" class="form-control" name="credentials" placeholder="Nominee Name / Nominee E-mail / Nominator Name" value="<?= (isset($_GET['credentials'])) ? $_GET['credentials'] : null; ?>" />
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="status">Status</label>
						<select class="form-control" name="status">
							<option value="">*ALL</option>
							<option value="1" <?= (isset($_GET['status']) && $_GET['status'] == 1) ? 'selected' : null; ?> >Approved</option>
							<option value="2"  <?= (isset($_GET['status']) && $_GET['status'] == 2) ? 'selected' : null; ?>>Pending to NC/Admin</option>
							<option value="3"  <?= (isset($_GET['status']) && $_GET['status'] == 3) ? 'selected' : null; ?>>Pending</option>
							<option value="4"  <?= (isset($_GET['status']) && $_GET['status'] == 4) ? 'selected' : null; ?>>Rejected by NC</option>
							<option value="4"  <?= (isset($_GET['status']) && $_GET['status'] == 4) ? 'selected' : null; ?>>Rejected by AC</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="area_no">Chapter</label>
						<select class="form-control" name="chapter_id" id="chapter-id">
							<option value="">*ALL</option>
							<?php foreach($chapters as $chapter): ?>
								<option class="chapter-options" value="<?= $chapter->id; ?>" data-area="<?= $chapter->area_no; ?>" <?= (isset($_GET['chapter_id']) && $chapter->id == $_GET['chapter_id']) ? 'selected' : null; ?>><?= $chapter->chapter; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<button class="btn btn-info pull-right"><i class="fa fa-search"></i> Search</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="box">
	            <div class="box-header with-border">
	              <h3 class="box-title">Nominees List</h3>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body">
				<?php  $this->widget('zii.widgets.CListView', array(
					'dataProvider'=>$nomineesDP,
					'itemView'=>'_view_nominees',
					'viewData' => array("status" => $status, 'chapters_indexed'=>$chapters_indexed),
					'template' => "{sorter}<table id=\"example1\" class=\"table table-bordered table-hover\">
					<thead class='panel-heading'>
						<th>Title</th>
						<th>Name</th>
						<th>E-mail</th>
						<th>Category</th>
						<th>Endorsing Chapter</th>
						<th>Nominator</th>
						<th>Date Nominated</th>
						<th>Status</th>
						<th>Action</th>
					</thead>
					<tbody>
						{items}
					</tbody>
					</table>
					{pager}",
					'emptyText' => "<tr><td colspan=\"9\">No available entries</td></tr>",
				));  ?>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="modal fade" tabindex="-1" role="dialog" id="viewDetailsModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-search"></i> View Nomination Details</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="endorsingChaptersModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-circle"></i> Add Other Endorsing Chapters</h4>
      </div>
      <div class="modal-body">
      	<form id="endorsing-chapter-form">
	        <div class="row">
	        	<div class="col-md-12">
	        		<input type="hidden" id="ec-nominator-id" name="nominator_id" value="" />
	        		<label>Endorsing Chapters</label>
	        		<select class="form-control" id="endorsing-chapters" name="additional_endorsing_chapters[]" multiple="multiple" style="width:100%;">
						<?php foreach($chapters as $chapter): ?>
							<option value="<?= $chapter->id; ?>"><?= $chapter->chapter; ?></option>
						<?php endforeach; ?>
					</select>
	        	</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="btn-hide-add-chapter">Close</button>
        <button type="button" class="btn btn-primary" id="btn-update-chapters">Update</button>
      </div>
    </div>
  </div>
</div>

<script>
$(function() {
	$(document).on('click', '.btn-view-details', function() {
		$('.btn-actions').prop('disabled', true);
		var $btn = $(this).button('loading');

		$.ajax({
	         url: site_url + '/ac/nominations/viewdetails',
	         method: "POST",
	         data: {'id': $(this).data('id')},
	         success: function(response) {
	            	details_html = response;
	         },
	         complete: function() {
	         	$('.btn-actions').prop('disabled', false);
	         	$btn.button('reset');
	            
	         	$('#viewDetailsModal').find('.modal-body').html(details_html);
	         	$('#viewDetailsModal').modal('show');
	         },
	         error: function() {
	              alert("ERROR in running requested function. Page will now reload.");
	              location.reload();
	         }
	    });
	});

	$(document).on('click', '.btn-add-chapter', function() {
		var chapters = $(this).data('chapters');
		var $endorsingChapters = $("#endorsing-chapters").select2();

		if(chapters != "")
			$endorsingChapters.val(chapters).trigger("change");

		$('#ec-nominator-id').val($(this).data('nominator'));
		$('#endorsingChaptersModal').modal('show');
	});

	$(document).on('click', '#btn-hide-add-chapter', function() {
		var $endorsingChapters = $("#endorsing-chapters").select2();
		$endorsingChapters.val(null).trigger("change");
		$('#endorsingChaptersModal').modal('hide');
	});

	$(document).on('click', '#btn-update-chapters', function() {
		$('.btn-actions').prop('disabled', true);
		var $btn = $(this).button('loading');

		$.ajax({
	         url: site_url + '/ac/nominations/updateendorsingchapters',
	         method: "POST",
	         data: $('#endorsing-chapter-form').serialize(),
	         success: function(response) {
	            result = JSON.parse(response);
	         },
	         complete: function() {
	         	if(result.type) {
	                alert(result.message);
	            } else {
	                launchAlert(result.message, 'danger');
	            }

	            location.reload();
	         },
	         error: function() {
	              alert("ERROR in running requested function. Page will now reload.");
	              location.reload();
	         }
	    });
	});
});
</script>