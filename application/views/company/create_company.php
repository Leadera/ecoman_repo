<div class="container">
	<p class="lead">Create Company</p>

	<?php if(validation_errors() != NULL ): ?>
    <div class="alert">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <?php echo validation_errors(); ?>
    </div>
    <?php endif ?>

	<?php echo form_open('newcompany'); ?>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
	    			<label for="companyName">Company Name</label>
	    			<input type="text" class="form-control" id="companyName" placeholder="Enter Company Name" value="<?php echo set_value('companyName'); ?>" name="companyName">
	 			</div>
	 			<div class="form-group">
	    			<label for="naceCode">Nace Code</label>
	    			<input type="text" class="form-control" id="naceCode" placeholder="XX.XX.XX" value="<?php echo set_value('naceCode'); ?>"  name="naceCode">
	 				<a href="http://tobb.org.tr/faaliyet/Sayfalar/nace-sorgulama.php">Nace Codes</a>
	 			</div>

	 			<div class="form-group">
	    			<label for="coordinates">Coordinates</label>
	    			<input type="text" class="form-control" id="coordinates" placeholder="Coordinates" name="coordinates">
	 			</div>
	 			<div class="form-group">
	    			<label for="companyDescription">Company Description</label>
	    			<textarea class="form-control" rows="3" name="companyDescription" id="companyDescription" placeholder="Company Description"></textarea>
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
	    			<label for="assignedCompanies">Add Worker to Company</label>
	    			<input name="tagsinput" class="tagsinput tagsinput-primary" value="" />
	 			</div>
			</div>
		</div>
		<button type="submit" class="btn btn-primary">Create Company</button>
	</form>
</div>
