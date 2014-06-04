<div class="container">
	<div class="row">
		<?php if(validation_errors() != NULL ): ?>
		<div class="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4>Form couldn't be saved</h4>
			<p>
				<?php echo validation_errors(); ?>
			</p>
		</div>
		<?php endif ?>
		<div class="col-md-3">
			<div class="form-group">
				<ul class="nav nav-list">
					<li><a style="text-transform:capitalize;" href="<?php echo base_url('new_flow/'.$companyID); ?>">Flows</a></li>
					<li><a style="text-transform:capitalize;" href="<?php echo base_url('new_process/'.$companyID); ?>">Process</a></li>
					<li><a style="text-transform:capitalize;" href="<?php echo base_url('new_equipment/'.$companyID); ?>">Equipment</a></li>
					<li><a style="text-transform:capitalize;" href="<?php echo base_url('new_product/'.$companyID); ?>">Product</a></li>
					<li><a style="text-transform:capitalize;" href="<?php echo base_url(''); ?>">Component</a></li>
					</ul>
			</div>
		</div>
