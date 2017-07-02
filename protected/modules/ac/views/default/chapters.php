<section class="content-header">
	<h1>
		AREA <?php echo CHtml::encode($region->area_no); ?>
		<small><?php echo CHtml::encode($region->region); ?></small>
	</h1>
	<ol class="breadcrumb">
		<li>
			<?php echo CHtml::link('AREA '.$region->area_no, array('default/index')); ?>
		</li>
		<li class="active"><?php echo CHtml::encode($region->region); ?></li>
	</ol>
</section>

<section class="content">
	<div class="box">
		<div class="box-header with-border">
			<div class="pull-left">
				<?php echo CHtml::link('<i class="fa fa-chevron-left"></i>', array('default/index'), array('class'=>'btn btn-danger btn-flat', 'title'=>'Back')); ?>
				List of Chapters under : <strong><?php echo CHtml::encode($region->region); ?></strong>
			</div>
			<div class="pull-right">

			</div>
		</div>
		<div class="box-body">
			<?php  $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$chaptersDP,
				'itemView'=>'_view_chapters',
				'template' => "{sorter}<table id=\"example1\" class=\"table table-bordered table-hover\">
				<thead class='panel-heading'>
					<th>Chapter</th>
					<th class='text-center'>Total # of Bids</th>
				</thead>
				<tbody>
					{items}
				</tbody>
				</table>
				{pager}",
				'emptyText' => "<tr><td class='text-center' colspan=\"8\">No available entries</td></tr>",
			));  ?>
		</div>
		<div class="box-footer">
			<div class="pull-left">
				List of Chapters under : <strong><?php echo CHtml::encode($region->region); ?></strong>
			</div>
			<div class="pull-right">
				Total: <strong><?php echo ToymNominator::model()->getRegionCount($region->id); ?></strong>
			</div>
		</div>
	</div>
</section>