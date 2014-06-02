<div class="container">
	<p class="lead">Company Data</p>

	<?php if(validation_errors() != NULL ): ?>
    <div class="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4>Form couldn't be saved</h4>
      <p>
      	<?php echo validation_errors(); ?>
      </p>
    </div>
  <?php endif ?>

	<?php echo form_open_multipart('process'); ?>
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<ul class="nav nav-list">
						<li><a style="text-transform:capitalize;" href="<?php echo base_url('new_flow'); ?>">Flows</a></li>
						<li><a style="text-transform:capitalize;" href="<?php echo base_url('new_process'); ?>">Process</a></li>
						<li><a style="text-transform:capitalize;" href="<?php echo base_url(''); ?>">Equipment</a></li>
						<li><a style="text-transform:capitalize;" href="<?php echo base_url(''); ?>">Product</a></li>
						<li><a style="text-transform:capitalize;" href="<?php echo base_url(''); ?>">Component</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
		    		<label for="status">Process Name</label>
		    		<div>	    			
			    		<select id="status" class="info select-block" name="status">
			  			<?php foreach ($process as $pro): ?>
							<option value="<?php echo $pro['id']; ?>"><?php echo $pro['name']; ?></option>
						<?php endforeach ?>-->
						</select>
					</div>
	 			</div>
	 			<div class="form-group">
		    	<label for="description">Used Flows</label>
		    	<?php foreach ($company_flows as $flow): ?>
					<ul class="nav nav-list">	
							<li  class="nav-header" style="font-size:15px;"><?php echo $flow['flowname'].'('.$flow['flowtype'].')'; ?></li>
					</ul>
					<?php endforeach ?>

		    </div>
			</div>
		</div>
		<button type="submit" class="btn btn-primary pull-right">Add Process</button>
	</form>
</div>
