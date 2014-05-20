<div class="container">
	<p class="lead">Create User</p>

	<?php if(validation_errors() != NULL ): ?>
    <div class="alert">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <?php echo validation_errors(); ?>        
    </div>
    <?php endif ?>

	<?php echo form_open('register'); ?>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
	    			<label for="name">Name</label>
	    			<input type="text" class="form-control" id="name" placeholder="Enter name" value="<?php echo set_value('name'); ?>" name="name">
	 			</div>
	 			<div class="form-group">
	    			<label for="surname">Surname</label>
	    			<input type="text" class="form-control" id="surname" placeholder="Enter surname" value="<?php echo set_value('surname'); ?>"  name="surname">
	 			</div>
	 			<div class="form-group">
	    			<label for="company">Company</label>
	    			
	    			<select id="info" name="company" class="select-block">
	  					<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
					</select>

	 			</div>
	 			<div class="form-group">
	    			<label for="jobTitle">Job Title</label>
	    			<input type="text" class="form-control" id="jobTitle" placeholder="Job Title" name="jobTitle">
	 			</div>
	 			<div class="form-group">
	    			<label for="jobDescription">Job Description</label>
	    			<textarea class="form-control" rows="3" name="jobDescription" id="jobDescription" placeholder="Job Description"></textarea>
	 			</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
	    			<label for="email">E-mail</label>
	    			<input type="text" class="form-control" id="email" placeholder="E-mail" value="<?php echo set_value('email'); ?>"  name="email">
	 			</div>
	 			<div class="form-group">
	    			<label for="cellPhone">Cell Phone</label>
	    			<input type="text" class="form-control" id="cellPhone" placeholder="Cell Phone" name="cellPhone">
	 			</div>
	 			<div class="form-group">
	    			<label for="workPhone">Work Phone</label>
	    			<input type="text" class="form-control" id="workPhone" placeholder="Work Phone" name="workPhone">
	 			</div>
	 			<div class="form-group">
	    			<label for="fax">Fax Number</label>
	    			<input type="text" class="form-control" id="fax" placeholder="Fax Number" name="fax">
	 			</div>
	 			<div class="form-group">
	    			<label for="address">Address</label>
	    			<textarea class="form-control" rows="3" name="address" id="address" placeholder="Address"></textarea>
	 			</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
	  				<div class="fileinput fileinput-new" data-provides="fileinput">
	    				<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
	      					<img data-src="holder.js/100%x100%" alt="...">
	    				</div>
	    				<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
	    				<div>
	      					<span class="btn btn-primary btn-embossed btn-file">
						        <span class="fileinput-new"><span class="fui-image"></span>  Select image</span>
						        <span class="fileinput-exists"><span class="fui-gear"></span>  Change</span>
						        <input type="file" name="...">
	      					</span>
	      					<a href="#" class="btn btn-primary btn-embossed fileinput-exists" data-dismiss="fileinput"><span class="fui-trash"></span>  Remove</a>
	    				</div>
	  				</div>
				</div>
				<div class="form-group">
	    			<label for="username">Username</label>
	    			<input type="text" class="form-control" id="username" placeholder="Username" name="username">
	 			</div>
	 			<div class="form-group">
	    			<label for="password">Password</label>
	    			<input type="password" class="form-control" id="password" placeholder="Password" name="password">
	 			</div>
	 			<div class="form-group">
	    			<label for="rePassword">Retype password</label>
	    			<input type="password" class="form-control" id="rePassword" placeholder="Retype password" name="rePassword">
	 			</div>
			</div>
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>
