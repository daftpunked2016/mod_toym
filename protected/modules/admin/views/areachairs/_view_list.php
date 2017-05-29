<tr>
	<td class="text-center"><strong><?= $data->area_no; ?></strong></td>
	<td><em><?= CHtml::encode($data->account->username); ?></em></td>
	<td><strong><?= CHtml::encode($data->account->user->getFullName()); ?></strong></td>
	<td><?= CHtml::encode($data->account->user->position->position); ?></td>
	<td><?= CHtml::encode($data->account->user->chapter->chapter); ?></td>
	<td>
		<? //= CHtml::link('<span class="btn-flat btn-info btn-sm"><i class="fa fa-search"></i></span> ', array('account/deactivate', 'id' => $data->id), array('title' => 'View Area Chair Details')); ?> 
		<?= CHtml::link('<span class="btn-flat btn-danger btn-sm"><i class="fa fa-remove"></i></span> ', array('areachairs/delete', 'id' => $data->id), array('confirm' => "Are you sure you want to delete this Area Chair?", 'title' => 'Delete Area Chair')); ?>
	</td>
</tr>