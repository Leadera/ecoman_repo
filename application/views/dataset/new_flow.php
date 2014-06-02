<div class="container">
	<div class="row">
<div class="col-md-12 ">
	<div class="row">
		<div class="col-md-6"><div class="altbaslik">New flow</div></div>
		<div class="col-md-6"></div>			
	</div>
	<?php echo form_open('flow_and_component/new_flow','role="form"'); ?>

		<?php if(validation_errors() != NULL ): ?>
    <div class="alert">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <?php echo validation_errors(); ?>        
    </div>
    <?php endif ?>
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
	  <button type="submit" class="btn btn-info">Add as a new flow</button>
	</form>
</div>
</div>
</div>