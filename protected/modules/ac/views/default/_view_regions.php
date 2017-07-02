<tr>
	<td><?php echo CHtml::encode($data->id); ?></td>
	<td><?php echo CHtml::link($data->region, array('default/listchapters', 'rid'=>$data->id)); ?></td>
	<td class="text-center">
		<?php $count = ToymNominator::model()->getRegionCount($data->id); 
		if($count == 0) {
			echo "<span class='text-muted'>0</span>";
		} else {
			echo "<b>{$count}</b>";
		}
		?>
	</td>
</tr>