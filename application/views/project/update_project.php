<div class="container">
	<p class="lead">Update Project</p>

	<!-- for Datepicker -->
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

	<?php if(validation_errors() != NULL ): ?>
	    <div class="alert">
	      <button type="button" class="close" data-dismiss="alert">&times;</button>
	      <?php echo validation_errors(); ?>        
	    </div>
    <?php endif ?>

	<?php echo form_open('update_project/'.$projects['id']); ?>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
	    			<label for="projectName">Project Name</label>
	    			<input type="text" class="form-control" id="projectName" placeholder="Enter Project Name" value="<?php echo set_value('projectName',$projects['name']); ?>" name="projectName">
	 			</div>
	 			<div class="form-group">
	 				<label for="datePicker">Start Date</label>
	    			<div class="input-group">
				    	<span class="input-group-btn">
				      		<button class="btn" type="button" style="height: 38px; border: 1px solid;"><span class="fui-calendar"></span></button>
				    	</span>
				    	<input type="text" class="form-control" value="<?php echo set_value('projectName',$projects['start_date']); ?>" id="datepicker-01" name="datepicker" />
				  	</div>
	 			</div>
	 			<div class="form-group">
	    			<label for="status">Status</label>
	    			<div>	    			
		    			<select id="status" class="info select-block" name="status">
		  					<?php foreach ($project_status as $status): ?>
								<option value="<?php echo $status['id']; ?>" <?php if($status['id']==$projects['status_id'])  echo 'selected';  ?> > <?php echo $status['name']; ?></option>
							<?php endforeach ?>
						</select>
					</div>
	 			</div>
	 			<div class="form-group">
	    			<label for="description">Description</label>
	    			<textarea class="form-control" rows="3" name="description" id="description" placeholder="Description" value=""><?php echo set_value('description',$projects['description']); ?></textarea>
	 			</div>
			</div>
			<div class="col-md-4">
	 			<div class="form-group">
	    			<label for="assignedCompanies">Assign Company</label>    			
	    			<!--  <input type="text" id="companySearch" />	-->

	    			<select multiple="multiple"  title="Choose at least one" class="select-block" id="assignCompany" name="assignCompany[]">
	    				
						<?php foreach ($companies as $company): ?>
							<option value="<?php echo $company['id']; ?>" <?php if(in_array($company['id'], $companyIDs)) echo 'selected';?> ><?php echo $company['name']; ?></option>
						<?php endforeach ?>
					</select>
	 			</div>
	 			<div class="form-group">
	    			<label for="assignedConsultant">Assign Consultant</label>   			
	    			<select multiple="multiple"  title="Choose at least one" class="select-block" id="assignConsultant" name="assignConsultant[]">
	    			
						<?php foreach ($consultants as $consultant): ?>
							<option value="<?php echo $consultant['id']; ?>" <?php if(in_array($consultant['id'], $consultantIDs)) echo 'selected';?>><?php echo $consultant['name'].' '.$consultant['surname'].' ('.$consultant['user_name'].')'; ?></option>
						<?php endforeach ?>
					</select>
	 			</div>
	 			<div class="form-group">
	    			<label for="assignContactPerson">Assign Contact Person</label>   			
	    			<select  class="select-block" id="assignContactPerson" name="assignContactPerson">
	    			<?php foreach ($contactusers as $contacts): ?>
	    			<?php foreach ($contacts as $contactuser): ?>
							<option value="<?php echo $contactuser['id']; ?>"<?php if(in_array($contactuser['id'], $contactIDs)) echo 'selected';?>  ><?php echo $contactuser['name'].' '.$contactuser['surname'].' ('.$contactuser['cmpny_name'].')'; ?></option>
						<?php endforeach ?>
							<?php endforeach ?>
					</select>
	 			</div>
	 			
			</div>
			<div class="col-md-4">

			</div>
		</div>
		<button type="submit" class="btn btn-primary">Update Project</button>
	</form>

</div>
	<script type="text/javascript">
    // Datepicker on projects
    // jQuery UI Datepicker JS init
    var datepickerSelector = '#datepicker-01';
    $(datepickerSelector).datepicker({
      showOtherMonths: true,
      selectOtherMonths: true,
      dateFormat: "yy-mm-dd",
      yearRange: '-1:+1'
    }).prev('.btn').on('click', function (e) {
      e && e.preventDefault();
      $(datepickerSelector).focus();
    });

    // Now let's align datepicker with the prepend button
    $(datepickerSelector).datepicker('widget').css({'margin-left': -$(datepickerSelector).prev('.btn').outerWidth()});
  </script>