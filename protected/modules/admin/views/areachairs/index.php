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

<h1>Area Chairs</h1>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
	            <div class="box-header with-border">
	              <h3 class="box-title">AC Users List</h3>
	              <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#assignAcModal"><i class="fa fa-plus"></i> Assign Area Chair</button>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body">
				<?php  $this->widget('zii.widgets.CListView', array(
					'dataProvider'=>$acsDP,
					'itemView'=>'_view_list',
					'template' => "{sorter}<table id=\"example1\" class=\"table table-bordered table-hover\">
					<thead class='panel-heading'>
						<th>AREA</th>
						<th>E-mail</th>
						<th>Name</th>
						<th>Position</th>
						<th>Chapter</th>
						<th>Actions</th>
					</thead>
					<tbody>
						{items}
					</tbody>
					</table>
					{pager}",
					'emptyText' => "<tr><td colspan=\"6\">No available entries</td></tr>",
				));  ?>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="modal fade" tabindex="-1" role="dialog" id="assignAcModal">
  <div class="modal-dialog" role="document">
  	<form id="area-chair-form">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Assign Area Chair</h4>
	      </div>
	      <div class="modal-body">
	      		<div class="row" id="alert-message-container" style="margin-right:5px;margin-left:5px;"> <!-- ALERT MESSAGES --> </div>

	        	<div class="form-group has-feedback">
					<label>Area</label>
					<select id="area_no" name="AreaChair[area_no]" class="form-control" required >
						<option disabled selected >Select Area No.</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
			    </div>
			    <div class="form-group has-feedback">
			    	<label>Region</label>
					<select id="region_id" class="form-control" required >
						<option value=""> -- <option>
					</select>
			    </div>
			    <div class="form-group has-feedback">
			    	<label>Chapter</label>
					<select id="chapter_id" class="form-control" required >
						<option value=""> -- <option>
					</select>
			    </div>
			    <div class="form-group has-feedback">
			    	<label>Member</label>
					<select id="member" name="AreaChair[account_id]" class="form-control" required >
						<option value=""> -- <option>
					</select>
			    </div>
			
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	        <button type="button" class="btn btn-primary" id="btn-save" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Saving..">Save changes</button>
	      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
	$(function() {
		//LIST REGIONS
		$(document).on("change", "#area_no", function(){
		    $.post("http://www.jci.org.ph/mod02/index.php/account/listRegions?area_no="+$(this).val(), function(data) {
		        $("select#region_id").html("<option value='' disabled selected>Select Region.. </option>" + data);
		        $("select#chapter_id").html("<option value='' disabled selected> -- </option>");
		        $("select#member").html("<option value='' disabled selected> -- </option>");
		    });
		});

		//LIST CHAPTERS
		$(document).on("change", "#region_id", function(){
		    $.post("http://www.jci.org.ph/mod02/index.php/account/listChapters?region="+$(this).val(), function(data) {
		        $("select#chapter_id").html("<option value='' disabled selected>Select Chapter.. </option>" + data);
		        $("select#member").html("<option value='' disabled selected> -- </option>");
		    });
		});

		//POPULATE CHAPTER MEMBERS FOR AREA CHAIR
		$(document).on("change", "#chapter_id", function(){
		    $.post("http://www.jci.org.ph/mod02/index.php/account/listChapterMembers?chapter="+$(this).val(), function(data) {
		        $("select#member").html("<option value='' disabled selected>Select Member.. </option>" + data);
		    });
		});

		$(document).on('click', '.btn-delete', function() {
			if(confirm('Are you sure you want to delete the selected Area Chair?')) {

				$.ajax({
			       url: site_url + '/admin/areachairs/assign',
			       method: "POST",
			       data: { 'id':$(this).data('id') },
			       success: function(response) {
			            result = JSON.parse(response);
			       },
			       complete: function() {
			            if(result.type) {
			                alert(result.message);
			                location.reload();
			            } else {
			                alert(result.message);
			            }

			       },
			       error: function() {
			            alert("ERROR in running requested function. Page will now reload.");
			            location.reload();
			       }
			    });
			    
			}
		});

		$(document).on('click', '#btn-save', function() {
			var $btn = $(this).button('loading');
			var form = $('#area-chair-form');
      		var formData = form.serializeArray();
      		var inputs = form.find('input, select:not([disabled=""]), button, textarea, .btn');

      		inputs.prop("disabled", true);
			$.ajax({
		       url: site_url + '/admin/areachairs/assign',
		       method: "POST",
		       data: formData,
		       success: function(response) {
		            result = JSON.parse(response);
		       },
		       complete: function() {
		            inputs.prop("disabled", false);
		            $btn.button('reset');

		            if(result.type) {
		                alert(result.message);
		                location.reload();
		            } else {
		                launchAlert(result.message, 'danger');
		            }

		       },
		       error: function() {
		            alert("ERROR in running requested function. Page will now reload.");
		            location.reload();
		       }
		    });
		});
	});
</script>