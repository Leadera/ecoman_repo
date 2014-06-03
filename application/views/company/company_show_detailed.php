<?php echo $map['js']; ?>
<div class="container">
	<div class="row">
		<div class="col-md-9">
			<div class="lead pull-left"><?php echo $companies['name']; ?></div>
			<a style="margin-left:10px;" class="btn btn-info btn-sm pull-right" href="<?php echo base_url("new_flow/".$companies['id']); ?>">Dataset Management</a>
			<a class="btn btn-info btn-sm pull-right" href="<?php echo base_url("update_company/".$companies['id']); ?>">Update Company</a>

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
							echo $nacecode['code'].'-'.$nacecode['name_tr']; 
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
			<img class="img-responsive thumbnail" src="<?php echo asset_url('company_pictures/'.$companies['logo']);?>" />
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
