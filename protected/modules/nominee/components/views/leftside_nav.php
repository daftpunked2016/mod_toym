<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    	<ul class="sidebar-menu">
      	<li class="header">MAIN NAVIGATION</li>

      	<li>
        	<a href="<?= Yii::app()->createUrl('nominee/nomination/info'); ?>">
          		<i class="fa fa-info"></i> <span>Information Sheet</span>
        	</a>
      	</li>

      	<li>
        	<a href="<?= Yii::app()->createUrl('nominee/portfolio/build'); ?>">
          		<i class="fa fa-pencil-square-o"></i> <span>Build Portfolio</span>
        	</a>
      	</li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>