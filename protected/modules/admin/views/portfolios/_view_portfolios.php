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
		<?= CHtml::link('<span class="btn-flat btn-info btn-xs"><i class="fa fa-search"></i></span> ', array(), array('title' => 'View Nomination Details', 'disabled'=>'disabled')); ?> 
	</td>
</tr>