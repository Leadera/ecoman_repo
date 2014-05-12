<div class="col-md-9 sagbar">
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
	    <label for="flowname">Flow name</label>
	    <input class="form-control" id="flowname" name="flowname" placeholder="Enter flow name">
	  </div>
	  <div class="form-group">
	    <label for="ei">Environmental impact</label>
	    <input class="form-control" id="ei" name="ei" placeholder="Enter environmental impact of flow">
	  </div>
	  <div class="form-group">
	    <label for="cost">Cost</label>
	    <input class="form-control" id="cost" name="cost" placeholder="Cost of flow (number)">
	  </div>
	  <div class="form-group">
	    <label for="amount">Amount</label>
	    <input class="form-control" id="amount" name="amount" placeholder="Enter amount of flow (number)">
	  </div>
	  <button type="submit" class="btn btn-info">Save flow</button>
	  <button class="btn btn-default">Cancel</button>
	</form>
</div>