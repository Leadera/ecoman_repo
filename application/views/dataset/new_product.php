<div class="col-md-9 sagbar">
	<div class="row">
		<div class="col-md-6"><div class="altbaslik">New product</div></div>
		<div class="col-md-6"></div>			
	</div>
	<?php echo form_open('product/new_product','role="form"'); ?>

		<?php if(validation_errors() != NULL ): ?>
    <div class="alert">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <?php echo validation_errors(); ?>        
    </div>
    <?php endif ?>
	  <div class="form-group">
	    <label for="productname">Product name</label>
	    <input class="form-control" id="productname" name="productname" placeholder="Enter product name">
	  </div>
	  <div class="form-group">
	    <label for="producttype">Product type</label>
	    <input class="form-control" id="producttype" name="producttype" placeholder="Enter type of product">
	  </div>
	  <div class="form-group">
	    <label for="quan">Quantity</label>
	    <input class="form-control" id="quan" name="quan" placeholder="Quantity (number)">
	  </div>
	  <div class="form-group">
	    <label for="productunit">Product unit</label>
	    <input class="form-control" id="productunit" name="productunit" placeholder="Enter unit of product">
	  </div>
	  <div class="form-group">
	    <label for="productdesc">Product description</label>
	    <input class="form-control" id="productdesc" name="productdesc" placeholder="Enter product description">
	  </div>
	  <button type="submit" class="btn btn-info">Save product</button>
	  <button class="btn btn-default">Cancel</button>
	</form>
</div>