<div class="col-md-9 sagbar">
	<div class="row">
		<div class="col-md-6"><div class="altbaslik">New component</div></div>
		<div class="col-md-6"></div>			
	</div>
	<?php echo form_open('flow_and_component/new_component','role="form"'); ?>

		<?php if(validation_errors() != NULL ): ?>
    <div class="alert">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <?php echo validation_errors(); ?>        
    </div>
    <?php endif ?>
	  <div class="form-group">
	    <label for="componentname">Component name</label>
	    <input class="form-control" id="componentname" name="componentname" placeholder="Enter component name">
	  </div>
	  <button type="submit" class="btn btn-info">Save component</button>
	  <button class="btn btn-default">Cancel</button>
	</form>
</div>