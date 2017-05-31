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