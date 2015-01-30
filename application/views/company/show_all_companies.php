<div class="container">
	<div class="row">
		<div class="col-md-8">
			<?php echo form_open_multipart('company'); ?>
				<div class="lead pull-left"><?php echo $cluster_name['name'];?></div>
				<?php 
					$temp = $this->session->userdata('user_in');
					if(($temp['id'] != null) && ($help != "0")): ?>
					<a class="pull-right btn btn-info btn-sm" href="<?php echo base_url("newcompany"); ?>">Create a Company</a>
					<?php endif	?>	

				<ul class="list-group" style="clear:both;">
				<?php foreach ($companies as $com): ?>
					<li class="list-group-item">
						<b><a href="<?php echo base_url('company/'.$com['id']) ?>"><?php echo $com['name']; ?></a></b>
						<span style="color:#999999; font-size:12px;"><?php echo $com['description']; ?></span>
						<?php if($com['have_permission']==1): ?>
							<i class="fa fa-check-square-o pull-right"></i>
						<?php endif ?>
					</li>
				<?php endforeach ?>
				</ul>
			</form>
		</div>	
		<div class="col-md-4">

			<a class="btn btn-default btn-sm" href="<?php echo base_url('cluster'); ?>">Add company to a cluster</a>
						<?php echo form_open_multipart('company'); ?>

			<div class="well" style="margin-top: 20px;">
				<label for="cluster">Select Cluster</label>
				<select title="Choose at least one" class="select-block" id="cluster" name="cluster">
					<option value="0">All of Companies</option>
					<?php foreach ($clusters as $cluster): ?>
						<option value="<?php echo $cluster['id']; ?>"><?php echo $cluster['name']; ?></option>
					<?php endforeach ?>
				</select>
				<button type="submit" class="btn btn-primary btn-sm">Filter</button>
			</div>
			</form>

			<i class="fa fa-check-square-o"></i> means that you have the rights to edit the company.
		</div>
	</div>
</div>
