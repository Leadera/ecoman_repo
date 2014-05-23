<div class="container">
	<p class="lead">Create Project</p>

	<?php if(validation_errors() != NULL ): ?>
	    <div class="alert">
	      <button type="button" class="close" data-dismiss="alert">&times;</button>
	      <?php echo validation_errors(); ?>        
	    </div>
    <?php endif ?>

	<?php echo form_open('newproject'); ?>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
	    			<label for="projectName">Project Name</label>
	    			<input type="text" class="form-control" id="projectName" placeholder="Enter Project Name" value="<?php echo set_value('projectName'); ?>" name="projectName">
	 			</div>
	 			<div class="form-group">
	 				<label for="datePicker">Start Date</label>
	    			<div class="input-group">
				    	<span class="input-group-btn">
				      		<button class="btn" type="button"><span class="fui-calendar"></span></button>
				    	</span>
				    	<input type="text" class="form-control" value="" id="datepicker-01" name="datepicker" />
				  	</div>
	 			</div>
	 			<div class="form-group">
	    			<label for="status">Status</label>	    			
	    			<select id="info" name="status" class="select-block">
	  					<?php foreach ($project_status as $status): ?>
							<option value=<?php echo $status['id']; ?>><?php echo $status['name']; ?></option>
						<?php endforeach ?>
					</select>
	 			</div>
	 			<div class="form-group">
	    			<label for="description">Description</label>
	    			<textarea class="form-control" rows="3" name="description" id="description" placeholder="Description"></textarea>
	 			</div>
			</div>
			<div class="col-md-4">
	 			<div class="form-group">
	    			<label for="assignedCompanies">Assign Company</label>    			
	    			<select multiple="multiple" class="" id="info" name="assignCompany[]">
	    				
						<?php foreach ($companies as $company): ?>
							<option value=<?php echo $company['id']; ?>><?php echo $company['name']; ?></option>
						<?php endforeach ?>
					</select>
	 			</div>
	 			<div class="form-group">
	    			<label for="assignedConsultant">Assign Consultant</label>   			
	    			<select multiple="multiple" class="" id="info" name="assignConsultant[]">
	    			
						<?php foreach ($consultants as $consultant): ?>
							<option value=<?php echo $consultant['id']; ?>><?php echo $consultant['name'].' '.$consultant['surname'].' ('.$consultant['user_name'].')'; ?></option>
						<?php endforeach ?>
					</select>
	 			</div>
	 			
			</div>
			<div class="col-md-4">

			</div>
		</div>
		<button type="submit" class="btn btn-primary">Create Project</button>
	</form>
</div>
