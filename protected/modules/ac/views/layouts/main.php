<!DOCTYPE html>
<html>
<?php $this->widget('AcHead') ?>	

<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  <?php $this->widget('AcHeader') ?>
  <!-- Left side column. contains the logo and sidebar -->
  <?php $this->widget('AcLeftsideNav') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"><?php echo $content; ?></div>
  <!-- /.content-wrapper -->
  <?php $this->widget('AcFooter') ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php $this->widget('AcJScripts') ?>
</body>
</html>
