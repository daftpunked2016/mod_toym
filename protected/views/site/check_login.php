<section class="content">
	<br style="margin-top:10px;" />

	<div class="row">
		<div class="col-md-offset-3 col-md-6">
			<form class="form-horizontal" method="POST" action="<?= Yii::app()->createUrl('site/proceednominate'); ?>">
				<div class="box box-primary">
				    <div class="box-header with-border text-center">
				      <h3 class="box-title ">myJCIP Log-in</h3>
				    </div>
					<div class="box-body">
						<?php 
						    foreach(Yii::app()->user->getFlashes() as $key=>$message) {
						      if($key === 'success') {
						        echo '<div class="alert alert-success alert-dismissible">
						                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						                '.$message.'
						              </div>';
						      } else {
						        echo '<div class="alert alert-danger alert-dismissible">
						                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						                '.$message.'
						              </div>';
						      }
						    }
						?>
					    <div class="form-group">
					    	<div class="col-md-12">
					      		<label for="exampleInputEmail1">E-mail </label>
					      		<input type="email" class="form-control" id="email" name="Account[username]" placeholder="E-mail">
					      		<span class="glyphicon glyphicon-envelope form-control-feedback" style="margin-top:25px;margin-right:15px;"></span>
					    	</div>
					    </div>
					    <div class="form-group">
					    	<div class="col-md-12">
					      		<label for="exampleInputPassword1"> Password </label>
					      		<input type="password" class="form-control" id="password" name="Account[password]" placeholder="Password">
					      		<span class="glyphicon glyphicon-lock form-control-feedback" style="margin-top:25px;margin-right:15px;"></span>
					      	</div>
					    </div>
					</div>
					<div class="box-footer with-border">
				      <input type="submit" class="btn btn-primary pull-right btn-lg" value="Log-in" /> 
				    </div>
				</div>
			</form>

			<br />
			<div class="text-center">
				<h4><a href="<?= Yii::app()->createUrl('site/proceednominate'); ?>"> Non-JCI member? Click here to proceed. </a></h4>
			</div>
		</div>
	</div>
</section>