<div class="container">
	<div class="row">
		<div class="col-md-3">
			<?php if(validation_errors() != NULL ): ?>
			<div class="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>Form couldn't be saved</h4>
				<p>
					<?php echo validation_errors(); ?>
				</p>
			</div>
			<?php endif ?>


			<div>
				<div class="lead"><?php echo $company_info['name']; ?></div>
				<div><small><b>Email:</b> <?php echo $company_info['email']; ?></small></div>
				<div><small><b>Phone:</b> <?php echo $company_info['phone_num_1']; ?></small></div>
			</div>
			<hr>
			<div class="form-group">
				<ul class="nav nav-list" style="padding-left:0px;">
					<li class="nav-header" style="font-size:15px;">Dataset Parts</li>
					<li><a style="text-transform:capitalize;" href="<?php echo base_url('new_flow/'.$companyID); ?>">Flows</a></li>
					<li><a style="text-transform:capitalize;" href="<?php echo base_url('new_component/'.$companyID); ?>"><span style="margin-left:10px; font-size:12px;"> Component</span></a></li>
					<li><a style="text-transform:capitalize;" href="<?php echo base_url('new_process/'.$companyID); ?>">Process</a></li>
					<li><a style="text-transform:capitalize;" href="<?php echo base_url('new_equipment/'.$companyID); ?>">Equipment</a></li>
					<li><a style="text-transform:capitalize;" href="<?php echo base_url('new_product/'.$companyID); ?>">Product</a></li>
					</ul>
			</div>
		</div>
