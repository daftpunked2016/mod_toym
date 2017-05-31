<tr class="
	<?php 
	switch($data->status) {
		case 2:
			echo "warning";
			break;
		case 3:
			echo "info";
			break;
		case 4:
			echo "danger";
			break;
	} ?>">
	<td><?= CHtml::encode($data->title); ?></td>
	<td><strong><?= CHtml::encode($data->getFullName()); ?></strong></td>
	<td><em><?= CHtml::encode($data->email); ?></em></td>
	<td><?= CHtml::encode($data->category->catname); ?> <small class="text-muted">(<?= CHtml::encode($data->subcategory->catdesc); ?>)</small></td>
	<td><?= CHtml::encode($data->nominator->chapter->chapter); ?></td>
	<td><?= CHtml::encode($data->nominator->getFullName()); ?></td>
	<td><?= date('M d, Y', strtotime($data->date_created)); ?></td>
	<td>
		<small>
		<?php 
		switch($data->status) {
			case 1:
				echo "<strong>APPROVED</strong>";
				break;
			case 2:
				echo "Pending";
				break;
			case 3:
				echo "<em>For AC Approval</em>";
				break;
			case 4:
				echo "<strong>Rejected</strong>";
				break;
		}
	 	?>
		</small>
	</td>
	<td>
		<span class="btn-actions btn-flat btn-info btn-xs btn-view-details" data-loading-text="<i class='fa fa-spinner fa-spin'></i>" style="cursor:pointer;" data-id="<?= $data->id; ?>"><i class="fa fa-search"></i></span>
		<?php 
			if($data->status == 2) {
				echo CHtml::link('<span class="btn-actions btn-flat btn-success btn-xs"><i class="fa fa-check"></i></span> ', array('nominations/approve', 'id' => $data->id, 'status'=>$status), array('confirm' => "Are you sure you want to approve this nominee?", 'title' => 'Approve Nominee')).' ';
				echo CHtml::link('<span class="btn-actions btn-flat btn-danger btn-xs"><i class="fa fa-remove"></i></span> ', array('nominations/reject', 'id' => $data->id, 'status'=>$status), array('confirm' => "Are you sure you want to reject this nominee?", 'title' => 'Reject Nominee')).' ';
			} else if($data->status == 1 || $data->status == 4) {
				echo CHtml::link('<span class="btn-actions btn-flat btn-warning btn-xs"><i class="fa fa-circle-o"></i></span> ', array('nominations/returntopending', 'id' => $data->id, 'status'=>$status), array('confirm' => "Are you sure you revert this nominee into pending status?", 'title' => 'Revert to Pending')).' ';
			} 
		?>
	</td>
</tr>