<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <?php if($nomination_setting->status == 1): ?>
        <li class="header">MAIN NAVIGATION</li>
        <?php if(!isset(Yii::app()->session['member'])): ?>
        <li active>
          <a href="<?= Yii::app()->createUrl('site/checklogin'); ?>">
            <i class="fa fa-check-square-o"></i> <span>Nominate</span>
          </a>
        </li>
        <?php endif; ?>
        <?php if(isset(Yii::app()->session['member'])): ?>
        <li>
          <a href="<?= Yii::app()->createUrl('site/cancelnominate'); ?>">
            <i class="fa fa-arrow-left text-red"></i> 
            <span class="text-red">Back <?php if(isset(Yii::app()->session['account'])): ?>(Log-out)<?php endif; ?></span>
          </a>
        </li>
        <?php endif; ?>
      <?php endif; ?>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>