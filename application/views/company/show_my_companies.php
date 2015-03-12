<div class="container">
	<div class="row">
		<div class="col-md-8">
			<?php echo form_open_multipart('company'); ?>
				<?php 
					$temp = $this->session->userdata('user_in');
					if($temp['id'] != null): ?>
					<a class="btn btn-info btn-sm" href="<?php echo base_url("newcompany"); ?>">Create a Company</a>
					<?php endif	?>	

				<ul class="list-group" style="clear:both; margin-top:20px;">
				<?php foreach ($companies as $com): ?>
					<li class="list-group-item">
						<b><a href="<?php echo base_url('company/'.$com['id']) ?>"><?php echo $com['name']; ?></a></b>
						<span style="color:#999999; font-size:12px;"><?php echo $com['description']; ?></span>
					</li>
				<?php endforeach ?>
				</ul>
			</form>
		</div>	
		<div class="col-md-4">
			
		</div>
	</div>
</div>
