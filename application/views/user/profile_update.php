<div class="container">
	<p class="lead">Update User Profile</p>

	<?php if(validation_errors() != NULL ): ?>
    <div class="alert">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <?php echo validation_errors(); ?>
    </div>
    <?php endif ?>

	<?php echo form_open_multipart('profile_update'); ?>
		<div class="row">
			<div class="col-md-4">

				<div class="form-group">
						<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-new thumbnail">
								<img class="img-rounded" style="width:120px;" src="<?php echo asset_url("user_pictures/".$photo); ?>">
							
							</div>
							<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
							<div>
									<span class="btn btn-primary btn-embossed btn-file">
										<span class="fileinput-new"><span class="fui-image"></span>  Select image</span>
										<span class="fileinput-exists"><span class="fui-gear"></span>  Change</span>
										<input type="file" name="userfile">
									</span>
									<a href="#" class="btn btn-primary btn-embossed fileinput-exists" data-dismiss="fileinput"><span class="fui-trash"></span>  Remove</a>
							</div>
						</div>
				</div>
				<div class="form-group">
						<label for="username">Username</label>
						<input type="text" class="form-control" id="username" value="<?php echo set_value('username',$user_name); ?>" placeholder="Username" name="username">
				</div>

			</div>
			<div class="col-md-4">
				<div class="form-group">
	    			<label for="email">E-mail</label>
	    			<input type="text" class="form-control" id="email" placeholder="E-mail" value="<?php echo set_value('email',$email); ?>"  name="email">
	 			</div>
	 			<div class="form-group">
	    			<label for="cellPhone">Cell Phone</label>
	    			<input type="text" class="form-control" id="cellPhone" value="<?php echo set_value('cellPhone',$phone_num_1); ?>" placeholder="Cell Phone" name="cellPhone">
	 			</div>
	 			<div class="form-group">
	    			<label for="workPhone">Work Phone</label>
	    			<input type="text" class="form-control" id="workPhone" value="<?php echo set_value('workPhone',$phone_num_2); ?>" placeholder="Work Phone" name="workPhone">
	 			</div>
	 			<div class="form-group">
	    			<label for="fax">Fax Number</label>
	    			<input type="text" class="form-control" id="fax" value="<?php echo set_value('fax',$fax_num); ?>" placeholder="Fax Number" name="fax">
	 			</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
						<label for="name">Name</label>
						<input type="text" class="form-control" id="name" placeholder="Enter name" value="<?php echo set_value('name',$name); ?>" name="name">
				</div>
				<div class="form-group">
						<label for="surname">Surname</label>
						<input type="text" class="form-control" id="surname" placeholder="Enter surname" value="<?php echo set_value('surname',$surname); ?>"  name="surname">
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
						<input type="text" class="form-control" id="jobTitle" value="<?php echo set_value('jobTitle',$title); ?>" placeholder="Job Title" name="jobTitle">
				</div>
				<div class="form-group">
						<label for="jobDescription">Description</label>
						<textarea class="form-control" rows="3" name="description" id="description" placeholder="Description"><?php echo set_value('description',$description); ?></textarea>
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>
