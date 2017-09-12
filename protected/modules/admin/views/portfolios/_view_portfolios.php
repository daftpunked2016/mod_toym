<tr class="
	<?php 
	switch($data->status_id) {
		case 2:
			echo "warning";
			break;
		case 4:
			echo "danger";
			break;
	} ?>">
	<td><strong><em><?= CHtml::encode($data->nominee->getFullName()); ?></em></strong></td>
	<td><strong><?= CHtml::encode($data->nominator->getFullName()); ?></strong></td>
	<td><?= date('M d, Y', strtotime($data->date_created)); ?></td>
	<td><?= date('M d, Y', strtotime($data->date_updated)); ?> <small><em><?= date('h:i A', strtotime($data->date_updated)); ?></em></small></td>
	<td><?= $data->getUpdator(); ?></td>
	<td>
		<small>
		<?php 
		switch($data->status_id) {
			case 1:
				echo "<strong>COMPLETED</strong>";
				break;
			case 2:
				echo "<em>Pending</em>";
				break;
		}
	 	?>
		</small>
	</td>
	<td>
		<?= CHtml::link('<span class="btn-flat btn-info btn-xs"><i class="fa fa-search"></i></span> ', array('portfolios/view', 'id' => $data->id ), array('data-toggle'=>"tooltip", 'title' => 'View Portfolio PDF', 'target'=>'_blank')); ?> 
		
		<div class="btn-group" role="group"  data-toggle="tooltip" data-placement="top" title="Download Files">
		    <button type="button" class="btn btn-flat btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		      <i class="fa fa-download"></i>
		      <span class="caret"></span>
		    </button>
		    <ul class="dropdown-menu dropdown-menu-right">
		      <li><a href="<?= Yii::app()->createUrl('admin/portfolios/download', array('id' => $data->id)); ?>">Portfolio</a></li>
		      <?php if($data->id_birth_cert_upload_id != ""): ?><li><a href="<?= Yii::app()->createUrl('admin/portfolios/downloaddocument', array('id' => $data->id_birth_cert_upload_id)); ?>">ID/Birth Certificate</a></li><?php endif; ?>
		      <?php if($data->nbi_clearance_upload_id != ""): ?><li><a href="<?= Yii::app()->createUrl('admin/portfolios/downloaddocument', array('id' => $data->nbi_clearance_upload_id)); ?>">NBI Clearance</a></li><?php endif; ?>
		    </ul>
		</div>

		<div class="btn-group" role="group"  data-toggle="tooltip" data-placement="top" title="Download Supporting Photos">
		    <button type="button" class="btn btn-flat btn-danger btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		      <i class="fa fa-image"></i>
		      <span class="caret"></span>
		    </button>
		    <ul class="dropdown-menu dropdown-menu-right">
		    	<?= $data->getDownloadImageOptions(); ?>
		    </ul>
		</div>

		<? //= CHtml::link('<span class="btn-flat btn-primary btn-xs"><i class="fa fa-download"></i></span> ', array('portfolios/download', 'id' => $data->id ), array('title' => 'Download Portfolio PDF', 'target'=>'_blank')); ?> 
	</td>
</tr>