<div class="col-md-12">
	<?php if(validation_errors() != NULL ): ?>
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4>Form couldn't be saved</h4>
		<p>
			<?php echo validation_errors(); ?>
		</p>
	</div>
	<?php endif ?>
	<div style="margin-bottom:20px; overflow:hidden;">
		<div class="pull-left"><b><a href="<?php echo base_url('company/'.$company_info['id']); ?>"><?php echo $company_info['name']; ?></a> Dataset Services</b></div>
		<div class="pull-right">
		<span class="label label-default"><b>Email:</b> <?php echo $company_info['email']; ?></span>
		<span class="label label-default"><b>Phone:</b> <?php echo $company_info['phone_num_1']; ?></span>
		<span><a href="<?php echo base_url('company/'.$company_info['id']); ?>" class="label label-primary">Go to company page</a></span></div>
	</div>
	<div>
		<ul class="list-inline ultab">
			<li <?php if ($this->uri->segment(1) == "new_flow"){ echo "class='btn-inverse'"; } ?>><a href="<?php echo base_url('new_flow/'.$companyID); ?>">Flow</a></li>
			<li <?php if ($this->uri->segment(1) == "new_component"){ echo "class='btn-inverse'"; } ?>><a class="" href="<?php echo base_url('new_component/'.$companyID); ?>"><span +>Component</span></a></li>
			<li <?php if ($this->uri->segment(1) == "new_process"){ echo "class='btn-inverse'"; } ?>><a class="" href="<?php echo base_url('new_process/'.$companyID); ?>">Process</a></li>
			<li <?php if ($this->uri->segment(1) == "new_equipment"){ echo "class='btn-inverse'"; } ?>><a class="" href="<?php echo base_url('new_equipment/'.$companyID); ?>">Equipment</a></li>
			<li <?php if ($this->uri->segment(1) == "new_product"){ echo "class='btn-inverse'"; } ?>><a class="" href="<?php echo base_url('new_product/'.$companyID); ?>">Product</a></li>
			</ul>
	</div>
</div>
