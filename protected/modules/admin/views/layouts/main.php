<!DOCTYPE html>
<html>
<?php $this->widget('AdminHead') ?>	

<body class="hold-transition skin-yellow sidebar-mini">
<div class="wrapper">

  <?php $this->widget('AdminHeader') ?>
  <!-- Left side column. contains the logo and sidebar -->
  <?php $this->widget('AdminLeftsideNav') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"><?php echo $content; ?></div>
  <!-- /.content-wrapper -->
  <?php $this->widget('AdminFooter') ?>

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
<?php $this->widget('AdminJScripts') ?>
</body>
</html>
