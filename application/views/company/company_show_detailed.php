<?php echo $map['js']; ?>
<div class="container">
	<div class="row">
		<div class="col-md-9">
			<div class="lead pull-left"><?php echo $companies['name']; ?></div>
			<button class="btn btn-info pull-right btn-sm">Update Company</button>

			<table class="table table-bordered">
				<tr>
					<td style="width:150px;">
					Company Info
					</td>
					<td>
					<?php echo $companies['description']; ?>
					</td>
				</tr>
				<tr>
					<td>
					E-mail
					</td>
					<td>
					<?php echo $companies['email']; ?>
					</td>
				</tr>
				<tr>
					<td>
					Phone
					</td>
					<td>
					<?php echo $companies['phone_num_1']; ?>
					</td>
				</tr>
				<tr>
					<td>
					Work Phone
					</td>
					<td>
					<?php echo $companies['phone_num_2']; ?>
					</td>
				</tr>
				<tr>
					<td>
					Fax Phone
					</td>
					<td>
					<?php echo $companies['fax_num']; ?>
					</td>
				</tr>
				<tr>
					<td>
					Nace Code
					</td>
					<td>
					<?php 

					foreach ($nacecode as $nace) {
						echo $nace['code'].'-'.$nace['name']; 
						echo '<br>';
					}

					?>
					</td>
				</tr>
				<tr>
					<td>
					Address
					</td>
					<td>
					<?php echo $companies['address']; ?>
					</td>
				</tr>
				<tr>
					<td>
					Company on map
					</td>
					<td>
					<?php echo $map['html']; ?>
					</td>
				</tr>
			</table>
		</div>

		<div class="col-md-3">
		<div>
			<img class="img-responsive" src="<?php echo asset_url('company_pictures/'.$companies['name'].'.jpg');?>" />
		</div>
			<div class="form-group">
				<ul class="nav nav-list">
					<li class="nav-header" style="font-size:15px;">Company project</li>
				<?php foreach ($prjname as $prj): ?>
					<li><a style="text-transform:capitalize;" href="<?php echo base_url('project/'.$prj['proje_id']); ?>"> <?php echo $prj["name"]; ?></a></li>
				<?php endforeach ?>
				</ul>
			</div>

			<div class="form-group">
				<ul class="nav nav-list">
					<li class="nav-header" style="font-size:15px;">Company workers</li>
				<?php foreach ($cmpnyperson as $cmpprsn): ?>
					<li><a style="text-transform:capitalize;" href="<?php echo base_url('user/'.$cmpprsn["user_name"]); ?>"> <?php echo $cmpprsn["name"].' '.$cmpprsn["surname"]; ?></a></li>
				<?php endforeach ?>
				</ul>
			</div>
		</div>
	</div>
</div>
