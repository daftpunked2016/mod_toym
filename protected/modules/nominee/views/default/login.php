<div class="login-box">
  <div class="login-logo">
    <img src = "<?php echo Yii::app()->request->baseUrl; ?>/page_assets/images/navbar_jci.png" height="125px" ></img>
  </div><!-- /.login-logo -->
  <!-- /.login-logo -->
  <div class="login-box-body">
    <div class="login-logo">
      <a href="<?php echo Yii::app()->request->baseUrl; ?>/page_assets/index2.html"><b>TOYM</b> | Nominee</a>
    </div>
    
    <p class="login-box-msg">Sign in to start your session</p>

    <?php $form=$this->beginWidget('CActiveForm', array(
      'id'=>'login-form',
      'enableClientValidation'=>true,
      'clientOptions'=>array(
        'validateOnSubmit'=>true, 
      ),
    )); 
    ?>
    <?php foreach(Yii::app()->user->getFlashes() as $key=>$message) {
      if($key  === 'success')
        {
          echo "<div class='alert alert-success alert-dismissible text-center' role='alert' style='margin-bottom:5px'>
          <button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>".
          $message.'</div><br />';
        }
        else
        {
          echo "<div class='alert alert-danger alert-dismissible text-center'' role='alert' style='margin-bottom:5px'>
          <button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>".
          $message.'</div><br />';
        }
      }
    ?>

    <div class="form-group has-feedback">
      <?php echo $form->textField($model,'username', array('class'=>'form-control', 'type'=>'email', 'placeholder'=>'Email')); ?><span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      <?php echo $form->error($model,'username'); ?>
      
    </div>

    <div class="form-group has-feedback">
      <?php echo $form->passwordField($model,'password', array('class'=>'form-control', 'placeholder'=>'Password')); ?><span class="glyphicon glyphicon-lock form-control-feedback"></span>
      <?php echo $form->error($model,'password'); ?>
    </div>


    <div class="form-group has-feedback">
      <?php echo CHtml::submitButton('Sign in', array('class'=>'btn btn-primary btn-block btn-flat')); ?>
    </div>
    <?php $this->endWidget(); ?>
    
    <br />
    <div class="row text-center">
      <a href="<?php echo Yii::app()->request->baseUrl; ?>/nominee/default/forgotpassword">Forgot Password?</a><br>
    </div>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->