<section class="content-header">
	<h1>
		Dashboard
		<small>view</small>
	</h1>
	<ol class="breadcrumb">
		<li>
			<?php echo CHtml::link('Dashboard', array('default/index')); ?>
		</li>
		<li class="active">View</li>
	</ol>
</section>

<div class="content-header">
	<div class="row">

		<div class="col-md-12">
			<h3 class="text-center">
				<strong>AREA <?= $area_no; ?> Nomination Summary</strong>
			</h3>
		</div>

		<!-- <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php // echo AwardBid::model()->count(array('condition'=>'award_program_id = :settings AND status_id = 1', 'params'=>array(':settings'=>$settings->bid_season_id))); ?></h3>
              <p>Qualified Bids</p>
            </div>
            <div class="icon">
              <i class="fa fa-check"></i>
            </div>
            <?php //echo CHtml::link('More info <i class="fa fa-arrow-circle-right"></i>', array('default/index'), array('class'=>'small-box-footer')); ?>
          </div>
        </div> -->

        <!-- <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php // echo AwardBid::model()->count(array('condition'=>'award_program_id = :settings AND status_id = 3', 'params'=>array(':settings'=>$settings->bid_season_id))); ?></h3>
              <p>Disqualified Bids</p>
            </div>
            <div class="icon">
              <i class="fa fa-times"></i>
            </div>
            <?php //echo CHtml::link('More info <i class="fa fa-arrow-circle-right"></i>', array('default/index'), array('class'=>'small-box-footer')); ?>
          </div>
        </div>

		<div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php // echo AwardBid::model()->count(array('condition'=>'award_program_id = :settings', 'params'=>array(':settings'=>$settings->bid_season_id))); ?></h3>
              <p>Total Bids</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
            <?php //echo CHtml::link('More info <i class="fa fa-arrow-circle-right"></i>', array('default/index'), array('class'=>'small-box-footer')); ?>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php // echo AwardJudge::model()->isActive()->count(); ?></h3>
              <p>Approved Judges</p>
            </div>
            <div class="icon">
              <i class="fa fa-legal"></i>
            </div>
            <?php //echo CHtml::link('More info <i class="fa fa-arrow-circle-right"></i>', array('judge/index', 't'=>1), array('class'=>'small-box-footer')); ?>
          </div>
        </div> -->
	</div>
</div>

<section class="content">
	<div class="row">
		<?php $areaDP=new CArrayDataProvider($area_regions, array(
			'pagination' => array(
		        'pageSize'=>10,
		    ),
		)); ?>

		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<div class="pull-left">
						AREA <?= $area_no; ?> REGIONS
					</div>
					<div class="pull-right">
						<strong>
							<i class="fa fa-cog"></i>
						</strong>
					</div>
				</div>
				<div class="box-body">
					<?php  $this->widget('zii.widgets.CListView', array(
						'dataProvider' => $areaDP,
						'itemView'=>'_view_regions',
						'template' => "{sorter}<table id=\"example1\" class=\"table table-bordered table-hover\">
						<thead class='panel-heading'>
							<th>Region #</th>
							<th>Name</th>
							<th class='text-center'>Total # of Bids</th>
						</thead>
						<tbody>
							{items}
						</tbody>
						</table>
						{pager}",
						'emptyText' => "<tr><td class='text-center' colspan=\"3\">No available entries</td></tr>",
					));  ?>
				</div>
				<div class="box-footer">
					<div class="pull-left">
						AREA <?= $area_no; ?> REGIONS
					</div>
					<div class="pull-right">
						Total : <strong><?php echo ToymNominator::model()->getAreaCount($area_no); ?></strong>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>