<div class="container">
	<p class="lead">New flow</p>

	<?php if(validation_errors() != NULL ): ?>
    <div class="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4>Form couldn't be saved</h4>
      <p>
      	<?php echo validation_errors(); ?>
      </p>
    </div>
  <?php endif ?>

	<?php echo form_open_multipart('new_flow'); ?>
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<ul class="nav nav-list">
						<li><a style="text-transform:capitalize;" href="<?php echo base_url('new_flow'); ?>">Flows</a></li>
						<li><a style="text-transform:capitalize;" href="<?php echo base_url('process'); ?>">Process</a></li>
						<li><a style="text-transform:capitalize;" href="<?php echo base_url(''); ?>">Equipment</a></li>
						<li><a style="text-transform:capitalize;" href="<?php echo base_url(''); ?>">Product</a></li>
						<li><a style="text-transform:capitalize;" href="<?php echo base_url(''); ?>">Component</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-9">
				<div class="form-group">
			    <label for="flowname">Flow Name</label>
		    	<div>	    			
						<select id="flowname" class="info select-block" name="flowname">
							<?php foreach ($flownames as $flowname): ?>
								<option value="<?php echo $flowname['id']; ?>"><?php echo $flowname['name']; ?></option>
							<?php endforeach ?>
						</select>
					</div>
			  </div>
			  <div class="form-group">
			    <label for="flowtype">Flow Type</label>
			    <div>	    			
						<select id="flowtype" class="info select-block" name="flowtype">
							<?php foreach ($flowtypes as $flowtype): ?>
								<option value="<?php echo $flowtype['id']; ?>"><?php echo $flowtype['name']; ?></option>
							<?php endforeach ?>
						</select>
					</div>

			  </div>
			  <div class="form-group">
			    <label for="quantity">Quantity(Annual)</label>
			    <input class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity of Flow">
			  </div>
			  <div class="form-group">
			    <label for="cost">Cost(Annual)</label>
			    <input class="form-control" id="cost" name="cost" placeholder="Cost of flow (number)">
			  </div>
			  <div class="form-group">
			    <label for="amount">EP(Annual)</label>
			    <input class="form-control" id="ep" name="ep" placeholder="Enter EP">
			  </div>
			</div>
		</div>
		<button type="submit" class="btn btn-primary pull-right">Add Process</button>
	</form>
</div>
