<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      	<li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="<?= Yii::app()->createUrl('ac/default/index'); ?>">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
       	<li class="treeview active">
          <a href="#">
           	<i class="fa fa-user-plus"></i> <span>Nominations</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu menu-open" style="display: block;">
            <li class=""><a href="<?= Yii::app()->createUrl('ac/nominations/nominees?status=3'); ?>"><i class="fa fa-circle-o"></i> Pending</a></li>
            <li><a href="<?= Yii::app()->createUrl('ac/nominations/nominees?status=1'); ?>"><i class="fa fa-check-circle-o"></i> Approved</a></li>
            <li><a href="<?= Yii::app()->createUrl('ac/nominations/nominees?status=5'); ?>"><i class="fa fa-times-circle-o"></i> Rejected</a></li>
            <li><a href="<?= Yii::app()->createUrl('ac/nominations/nominees?status=4'); ?>"><i class="fa fa-times-circle-o"></i> Rejected by NC</a></li>
          </ul>
        </li>
      	<li>
        	<a href="<?= Yii::app()->createUrl('ac/portfolios/index'); ?>">
          		<i class="fa fa-file-text-o"></i> <span>Portfolios</span>
        	</a>
      	</li>
    </ul>

  </section>
  <!-- /.sidebar -->
</aside>