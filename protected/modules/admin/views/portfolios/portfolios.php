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

<h1>Portfolios</h1>
</section>

<section class="content">
	<div class="well" style="padding: 10px;">
		<div class="row">
			<form method="GET">
				<div class="col-md-6">
					<div class="form-group">
						<label for="credentials">Search</label>
						<input type="text" class="form-control" name="credentials" placeholder="Nominee Name / Nominee E-mail / Nominator Name" value="<?= (isset($_GET['credentials'])) ? $_GET['credentials'] : null; ?>" />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="status">Status</label>
						<select class="form-control" name="status">
							<option value="">*ALL</option>
							<option value="1" <?= (isset($_GET['status']) && $_GET['status'] == 1) ? 'selected' : null; ?> >COMPLETED</option>
							<option value="2"  <?= (isset($_GET['status']) && $_GET['status'] == 2) ? 'selected' : null; ?>>Pending</option>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="area_no">Area</label>
						<select class="form-control" name="area_no" id="area-no">
							<option value="">*ALL</option>
							<option value="1" <?= (isset($_GET['area_no']) && $_GET['area_no'] == 1) ? 'selected' : null; ?> >1</option>
							<option value="2"  <?= (isset($_GET['area_no']) && $_GET['area_no'] == 2) ? 'selected' : null; ?>>2</option>
							<option value="3"  <?= (isset($_GET['area_no']) && $_GET['area_no'] == 3) ? 'selected' : null; ?>>3</option>
							<option value="4"  <?= (isset($_GET['area_no']) && $_GET['area_no'] == 4) ? 'selected' : null; ?>>4</option>
							<option value="5"  <?= (isset($_GET['area_no']) && $_GET['area_no'] == 5) ? 'selected' : null; ?>>5</option>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="area_no">Chapter</label>
						<select class="form-control" name="chapter_id" id="chapter-id">
							<option value="">*ALL</option>
							<?php foreach($chapters as $chapter): ?>
								<option class="chapter-options" value="<?= $chapter->id; ?>" data-area="<?= $chapter->area_no; ?>" <?= (isset($_GET['chapter_id']) && $chapter->id == $_GET['chapter_id']) ? 'selected' : null; ?> ><?= $chapter->chapter; ?></option>
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
	              <h3 class="box-title">Portfolios List</h3>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body">
				<?php  $this->widget('zii.widgets.CListView', array(
					'dataProvider'=>$portfoliosDP,
					'itemView'=>'_view_portfolios',
					'viewData' => array("status" => $status),
					'template' => "{sorter}<table id=\"example1\" class=\"table table-bordered table-hover\">
					<thead class='panel-heading'>
						<th>Nominee</th>
						<th>Nominator</th>
						<th>Date Created</th>
						<th>Date Updated</th>
						<th>Last Updated By</th>
						<th>Status</th>
						<th>Actions</th>
					</thead>
					<tbody>
						{items}
					</tbody>
					</table>
					{pager}",
					'emptyText' => "<tr><td colspan=\"6\">No available entries</td></tr>",
				));  ?>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
$(function() {
	$(document).on('click', '#area-no', function() {
		if($(this).val() == "") {
			$('#chapter-id').children('option.chapter-options').show();
		} else {
			$('#chapter-id').children('option.chapter-options').hide();
			$('#chapter-id').children('option.chapter-options[data-area="'+$(this).val()+'"]').show();
		}
		
	});
});
</script>