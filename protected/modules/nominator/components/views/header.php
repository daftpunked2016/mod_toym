<header class="main-header">
  <!-- Logo -->
  <a href="<?= Yii::app()->createUrl('nominator/default/index'); ?>" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b><small>TOYM</small></b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><small>NOMINATOR</small> | <b>TOYM</b></span>
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
            <i class="fa fa-user-circle-o" style="margin-right:5px;"></i> <span class="hidden-xs" style="margin-top:10px;"><?= Yii::app()->getModule('nominator')->user->getState('name'); ?></span>
          </a>
          <?php if(Yii::app()->getModule('nominator')->user->getState('account_id') == null): ?>
          <ul class="dropdown-menu" style="height:80px;width:100px">
            <li>
              <!-- inner menu: contains the actual data -->
              <ul class="menu">
                <li>
                  <a href="<?= Yii::app()->createUrl('nominator/default/changepassword'); ?>">
                    <i class="fa fa-key"></i> Change Password
                  </a>
                </li>
                <li>
                  <a href="<?= Yii::app()->createUrl('nominator/default/logout'); ?>">
                    <i class="fa fa-sign-out"></i> Log-out
                  </a>
                </li>
  
              </ul>
            </li>
          </ul>
          <?php else: ?>
          <ul class="dropdown-menu" style="height:40px;width:100px">
            <li>
              <!-- inner menu: contains the actual data -->
              <ul class="menu">

                <li>
                  <a href="<?= Yii::app()->createUrl('nominator/default/logout'); ?>" class="text-center">
                    <i class="fa fa-sign-out"></i> Log-out
                  </a>
                </li>
  
              </ul>
            </li>
          </ul>
          <?php endif; ?>
        </li>
      
      </ul>
    </div>

    <div class="navbar-custom-menu"></div>
  </nav>
</header>