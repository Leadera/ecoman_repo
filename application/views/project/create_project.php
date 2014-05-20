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
	    			<input name="tagsinput" class="tagsinput tagsinput-primary" value="" />
	 			</div>
	 			<div class="form-group">
	    			<label for="assignedConsultant">Assign Consultant</label>    			
	    			<input name="tagsinput" class="tagsinput tagsinput-primary" value="" />
	 			</div>
	 			<div class="form-group">
	    			<label for="assignedContactPerson">Assign Contact Person</label>    			
	    			<input name="tagsinput" class="tagsinput tagsinput-primary" value="" />
	 			</div>
	 			
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="selectFile">Select File</label>
				  	<div class="fileinput fileinput-new" data-provides="fileinput">
				    	<div class="input-group">
				      		<div class="form-control uneditable-input" data-trigger="fileinput">
						        <span class="fui-clip fileinput-exists"></span>
						    	<span class="fileinput-filename"></span>
						    </div>
				      		<span class="input-group-btn btn-file">					    	
						        <span class="btn btn-default fileinput-new" data-role="select-file">Select file</span>
						        <span class="btn btn-default fileinput-exists" data-role="change"><span class="fui-gear"></span>  Change</span>
						        <input type="file" name="...">
						        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><span class="fui-trash"></span>  Remove</a>					    	
				      		</span>					    
				    	</div>
				  	</div>
				</div>
				<label for="accessRights">Access Rights</label>
				<div class="jumbotron">

				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-primary">Create Project</button>
	</form>
</div>
