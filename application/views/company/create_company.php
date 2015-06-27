
<?php echo $map['js']; ?>

<div class="container">
	<p class="lead">Create Company</p>

	<?php if(validation_errors() != NULL ): ?>
    <div class="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4>Form couldn't be saved</h4>
      <p>
      	<?php echo validation_errors(); ?>
      </p>
    </div>
  <?php endif ?>

	<?php echo form_open_multipart('newcompany'); ?>
		<div class="row">
			<div class="col-md-4">
					<div class="form-group">
	  				<div class="fileinput fileinput-new" data-provides="fileinput">
	    				<div class="fileinput-new thumbnail" style="width: 100%; height: 200px;">
	      					<img data-src="holder.js/100%x100%" alt="..." style="width: 100%; ">
	    				</div>
	    				<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
	    				<div>
	      					<span class="btn btn-primary  btn-file">
						        <span class="fileinput-new"><span class="fui-image"></span>  Select image</span>
						        <span class="fileinput-exists"><span class="fui-gear"></span>  Change</span>
						        <input type="file" name="userfile">
	      					</span>
	      					<a href="#" class="btn btn-primary fileinput-exists" data-dismiss="fileinput"><span class="fui-trash"></span>  Remove</a>
	    				</div>
	  				</div>
				</div>
				<div class="alert">All fields are required expect logo</div>
			</div>
			<div class="col-md-8">
				<div class="form-group">
	    			<label for="companyName">Company Name</label>
	    			<input type="text" class="form-control" id="companyName" placeholder="Enter Company Name" value="<?php echo set_value('companyName'); ?>" name="companyName">
	 			</div>
	 			<div class="form-group">
	    		<label for="naceCode">Nace Code</label>
					<select id="selectize" name="naceCode">
						<option value="">Nothing Selected</option>
						<?php foreach ($all_nace_codes as $anc): ?>
							<option value="<?php echo $anc['code']; ?>"><?php echo $anc['code']; ?> - <?php echo $anc['name_tr']; ?></option>
						<?php endforeach ?>
					</select>
					<small>You can search nace codes by typing it</small>
	 			</div>
				<div class="form-group">
	    			<label for="email">E-mail</label>
	    			<input type="text" class="form-control" id="email" placeholder="E-mail" value="<?php echo set_value('email'); ?>"  name="email">
	 			</div>
<!-- 	 			<div class="form-group">
	    			<label for="cellPhone">Cell Phone</label>
	    			<input type="text" class="form-control" id="cellPhone" placeholder="Cell Phone" value="<?php echo set_value('cellPhone'); ?>" name="cellPhone">
	 			</div> -->
	 			<div class="form-group">
	    			<label for="workPhone">Work Phone</label>
	    			<input type="text" class="form-control" id="workPhone" placeholder="Work Phone" value="<?php echo set_value('workPhone'); ?>" name="workPhone">
	 			</div>
	 			<div class="form-group">
	    			<label for="fax">Fax Phone</label>
	    			<input type="text" class="form-control" id="fax" placeholder="Fax Number" value="<?php echo set_value('fax'); ?>" name="fax">
	 			</div>
				<div class="form-group">
	    			<label for="coordinates">Coordinates</label>
	    			<button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-block btn-primary" id="coordinates" >Select Company on Map</button><br>
	    			<div class="row">
		    			<div class="col-md-6">
		    				<input type="text" class="form-control" id="lat" placeholder="Lat" name="lat" style="color:#333333;" value="<?php echo set_value('lat'); ?>" readonly/>
		    			</div>
		    			<div class="col-md-6">
		    				<input type="text" class="form-control" id="long" placeholder="Long" name="long" style="color:#333333;" value="<?php echo set_value('long'); ?>" readonly/>
		    			</div>
	    			</div>
	 			</div>

	 			<div class="form-group">
	    			<label for="address">Address</label>
	    			<textarea class="form-control" rows="3" name="address" id="address" placeholder="Address"><?php echo set_value('address'); ?></textarea>
	 			</div>
	 			<div class="form-group">
	    			<label for="companyDescription">Company Description</label>
	    			<textarea class="form-control" rows="3" name="companyDescription" id="companyDescription" placeholder="Company Description"><?php echo set_value('companyDescription'); ?></textarea>
	 			</div>
	 					<button type="submit" class="btn btn-primary btn-block">Create Company</button>
			</div>
		</div>
	</form>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" rendered="<?php echo $map['js']; ?>">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title" id="myModalLabel">Click Map</h4>
	        <hr>
	        <div class="row">
	        	<div class="col-md-6">
	        		<input type="text" class="form-control" id="latId" name="lat" style="color:#333333;" readonly/>
	        	</div>
	        	<div class="col-md-6">
	        		<input type="text" class="form-control" id="longId" name="long"  style="color:#333333;" readonly/>
	        	</div>
	        </div>
	      </div>
	      <div class="modal-body">
	       <?php echo $map['html']; ?>
	      </div>
	      <div class="modal-footer">
	      </div>
	    </div>
	  </div>
</div>

</div>
<script type="text/javascript">
	$('#selectize').selectize({
		create: false
	});
</script>