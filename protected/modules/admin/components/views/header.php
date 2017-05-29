<header class="main-header">
  <!-- Logo -->
  <a href="<?= Yii::app()->createUrl('admin/default/index'); ?>" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b><small>TOYM</small></b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><small>ADMIN</small> | <b>TOYM</b></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        
        <!-- Notifications: style can be found in dropdown.less -->
        <li class="dropdown notifications-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-user-circle-o" style="margin-right:5px;"></i> <span class="hidden-xs" style="margin-top:10px;"><b>NC</b> <?= Yii::app()->getModule('admin')->user->getState('name'); ?></span>
          </a>
          <ul class="dropdown-menu" style="height:40px;width:80px">
            <li>
              <!-- inner menu: contains the actual data -->
              <ul class="menu">
                <li>
                  <a href="<?= Yii::app()->createUrl('admin/default/logout'); ?>" style="text-align:center;">
                    <i class="fa fa-sign-out"></i> Log-out
                  </a>
                </li>
  
              </ul>
            </li>
          </ul>
        </li>
      
      </ul>
    </div>
    
  </nav>
</header>