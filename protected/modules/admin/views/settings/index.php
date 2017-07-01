<section class="content-header">
	<?php foreach(Yii::app()->user->getFlashes() as $key=>$message) {
		if($key  === 'success')
			{
			echo "<div class='alert alert-success alert-dismissible' role='alert'>
			<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>".
			$message.'</div>';
			}
		else
			{
			echo "<div class='alert alert-danger alert-dismissible' role='alert'>
			<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>".
			$message.'</div>';
			}
		}
	?>

<h1> Settings </h1>
</section>

<div class="row" id="alert-message-container" style="margin:20px 10px 0px 10px;"> <!-- ALERT MESSAGES --> </div>

<section class="content">
	<h4><i class="fa fa-gear" style="margin-right:10px;"></i> Settings List</h4>
	<div class="well" style="padding: 10px;">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
		    		<div class="col-md-4">
		    			<label for="additional_insured_oo2" class="control-label">Nomination</label>
		    		</div>
	    			<div class="col-md-6 input-container">
	    				<input data-toggle="toggle" class="form-checkbox settings-input" type="checkbox" name="nomination_status" id="nomination_status" data-on="Enabled" data-off="Disabled" value="1" data-width="150" 
	    				<?= ($settings['nomination_status']->status == 1) ? 'checked' : null; ?> > 
	    			</div>
	    		</div>
	    	</div>
		</div>
		<br />
		<div class="row">
	    	<div class="col-md-12">
				<div class="form-group">
		    		<div class="col-md-4">
		    			<label for="additional_insured_oo2" class="control-label">Submission of Portfolio</label>
		    		</div>
	    			<div class="col-md-6 input-container">
	    				<input data-toggle="toggle" class="form-checkbox settings-input" type="checkbox" name="portfolio_sub_status" id="portfolio_sub_status" data-on="Enabled" data-off="Disabled" value="1" data-width="150" 
	    				<?= ($settings['portfolio_sub_status']->status == 1) ? 'checked' : null; ?> > 
	    			</div>
	    		</div>
	    	</div>
		</div>
	</div>
</section>

<script>
$(function() {
	$(document).on('change', '.settings-input', function() {
		var value = 0;
		var name = $(this).attr('name');
		if($(this).is(':checked')) { value = 1; }

		$(this).closest('.input-container').append("<i id='loader-"+name+"'class='fa fa-spinner fa-spin' style='margin-left:5px;'></i>");

		$.ajax({
	         url: site_url + '/admin/settings/save',
	         method: "POST",
	         data: { 'name': name, 'value': value },
	         success: function(response) {
	            result = JSON.parse(response);
	         },
	         complete: function() {
	         	if(result.type) {
	                alert(result.message);
	            } else {
	                launchAlert(result.message, 'danger');
	            }

	            $('#loader-'+name).remove();
	         },
	         error: function() {
	              alert("ERROR in running requested function. Page will now reload.");
	              location.reload();
	         }
	    });
	});
});
</script>