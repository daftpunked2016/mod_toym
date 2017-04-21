<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li>
        <a href="<?= Yii::app()->createUrl('site/nominate'); ?>">
          <i class="fa fa-check-square-o"></i> <span>Nominate</span>
        </a>
      </li>
      <?php if(isset(Yii::app()->session['member'])): ?>
      <li>
        <a href="<?= Yii::app()->createUrl('site/cancelnominate'); ?>">
          <i class="fa fa-arrow-left text-red"></i> <span class="text-red">Back</span>
        </a>
      </li>
      <?php endif; ?>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>