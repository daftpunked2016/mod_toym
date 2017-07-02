<tr>
	<td><?php echo CHtml::link($data->chapter, array('nominations/nominees', 'chapter_id'=>$data->id), array('target'=>'_blank')); ?></td>
	<td class="text-center">
		<?php $count = ToymNominator::model()->count(array('condition'=>'endorsing_chapter = :cid', 'params'=>array(':cid'=>$data->id))); 
		if($count == 0) {
			echo "<span class='text-muted'>0</span>";
		} else {
			echo "<b>{$count}</b>";
		}
		?>
	</td>
</tr>