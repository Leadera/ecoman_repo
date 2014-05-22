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
				    	<input type="text" class="form-control" value="" id="datepicker-01" />
				  	</div>
	 			</div>
	 			<div class="form-group">
	    			<label for="status">Status</label>	    			
	    			<select id="info" name="status" class="select-block">
	  					<option>status 1</option>
						<option>status 2</option>
						<option>status 3</option>
						<option>status 4</option>
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
	    			<select multiple="multiple" class="" id="info" name='assignCompany[]'>
						<?php foreach ($companies as $company): ?>
							<option><?php echo $company['name']; ?></option>
						<?php endforeach ?>
					</select>
	 			</div>
	 			<div class="form-group">
	    			<label for="assignedConsultant">Assign Consultant</label>   			
	    			<select multiple="multiple" class="" id="info" name='assignConsultant'>
						<?php foreach ($consultants as $consultant): ?>
							<option><?php echo $consultant['name'].' '.$consultant['surname'].' ('.$consultant['user_name']; ?></option>
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
