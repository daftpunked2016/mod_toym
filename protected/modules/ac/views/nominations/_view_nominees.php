<tr class="
	<?php 
	switch($data->status) {
		case 2:
			echo "info";
			break;
		case 3:
			echo "warning";
			break;
		case 4: case 5:
			echo "danger";
			break;
	} ?>">
	<td><?= CHtml::encode($data->title); ?></td>
	<td><strong><?= CHtml::encode($data->getFullName()); ?></strong></td>
	<td><em><?= CHtml::encode($data->email); ?></em></td>
	<td><?= CHtml::encode($data->category->catname); ?> <small class="text-muted">(<?= CHtml::encode($data->subcategory->catdesc); ?>)</small></td>
	<td>
		<?= CHtml::encode($data->nominator->chapter->chapter); ?>
		<?php if($data->nominator->additional_endorsing_chapter != NULL) {
			$additional_chapters = json_decode($data->nominator->additional_endorsing_chapter);
			$chapters_str = "";

			foreach($additional_chapters as $chapter_id) {
				$chapters_str .= $chapters_indexed[$chapter_id]."<br />";
			}

			echo ", <u><a href='#' data-toggle='tooltip' data-placement='top' title='{$chapters_str}'  data-html='true' >etc.</a></u>";
		}
		?>
	</td>
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
				echo "<em>For NC Approval</em>";
				break;
			case 3:
				echo "Pending";
				break;
			case 4:
				echo "<strong>Rejected by NC</strong>";
				break;
			case 5:
				echo "<strong>Rejected by AC</strong>";
				break;
		}
	 	?>
		</small>
	</td>
	<td>
		<span class="btn-actions btn-flat btn-info btn-xs btn-view-details" title="View Nomination Details" data-loading-text="<i class='fa fa-spinner fa-spin'></i>" style="cursor:pointer;" data-id="<?= $data->id; ?>"><i class="fa fa-search"></i></span> 
		
		<?php 
			if($data->status == 1) {
				echo '<span class="btn-actions btn-flat btn-info btn-xs btn-add-chapter" data-chapters="'.str_replace('"', '', $data->nominator->additional_endorsing_chapter).'" data-nominator="'.$data->nominator_id.'" title="Add Endorsing Chapters" data-loading-text="<i class=\'fa fa-spinner fa-spin\'></i>" style="cursor:pointer;"><i class="fa fa-plus-circle"></i></span>';
			} 

			if($data->status == 3) {
				echo CHtml::link('<span class="btn-flat btn-success btn-xs"><i class="fa fa-check"></i></span> ', array('nominations/approve', 'id' => $data->id, 'status'=>$status), array('confirm' => "Are you sure you want to approve this nominee?", 'title' => 'Approve Nominee')).' ';
				echo CHtml::link('<span class="btn-flat btn-danger btn-xs"><i class="fa fa-remove"></i></span> ', array('nominations/reject', 'id' => $data->id, 'status'=>$status), array('confirm' => "Are you sure you want to reject this nominee?", 'title' => 'Reject Nominee')).' ';
			} else if($data->status == 5) {
				echo CHtml::link('<span class="btn-flat btn-warning btn-xs"><i class="fa fa-circle-o"></i></span> ', array('nominations/returntopending', 'id' => $data->id, 'status'=>$status), array('confirm' => "Are you sure you revert this nominee into pending status?", 'title' => 'Revert to Pending')).' ';
				//echo CHtml::link('<span class="btn-flat btn-success btn-xs"><i class="fa fa-check"></i></span> ', array('nominations/approve', 'id' => $data->id, 'status'=>$status), array('confirm' => "Are you sure you want to approve this nominee?", 'title' => 'Approve Nominee')).' ';
			}	
		?>
	</td>
</tr>