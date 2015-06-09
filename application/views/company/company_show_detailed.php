<?php echo $map['js']; ?>
<div class="container">
	<div class="row">
		<div class="col-md-9">
			<div class="lead pull-left"><?php echo $companies['name']; ?></div>
			<?php if($have_permission): ?>
			<a style="margin-left:10px;" class="btn btn-info btn-sm pull-right" href="<?php echo base_url("new_flow/".$companies['id']); ?>">Dataset Management</a>
			<a class="btn btn-info btn-sm pull-right" href="<?php echo base_url("update_company/".$companies['id']); ?>">Update Company</a>
			<?php endif ?>

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
			<?php if($have_permission): ?>
			<?php if($valid != 0): ?>
				
				<table class="table table-bordered">
					<tr class="success">
						<th colspan="5">Company Flows</th>
					</tr>
					<tr>
						<th>Flow Name</th>
						<th>Flow Type</th>
						<th>Quantity</th>
						<th>Cost</th>
						<th>EP</th>
					</tr>
					<?php foreach ($company_flows as $flows): ?>
						<tr>	
							<td><?php echo $flows['flowname']; ?></td>
							<td><?php echo $flows['flowtype']; ?></td>
							<td><?php echo $flows['qntty'].' '.$flows['qntty_unit_name']; ?></td>
							<td><?php echo $flows['cost'].' '.$flows['cost_unit']; ?></td>
							<td><?php echo $flows['ep'].' EP'?></td>
						</tr>
					<?php endforeach ?>
				</table>
				
				<table class="table table-bordered">
					<tr class="success">
						<th colspan="3">Company Process</th>
					</tr>
					<tr>
						<th>Process Name</th>
						<th>Flow Name</th>
						<th>Flow Type</th>
					</tr>
					<?php foreach ($company_prcss as $prcss): ?>
						<tr>	
							<td><?php echo $prcss['prcessname']; ?></td>
							<td><?php echo $prcss['flowname']; ?></td>
							<td><?php echo $prcss['flow_type_name']?></td>
						</tr>
					<?php endforeach ?>
				</table>

				<table class="table table-bordered">
					<tr class="success">
						<th colspan="2">Company Component</th>
					</tr>
					<tr>
						<th>Flow Name</th>
						<th>Component Name</th>
					</tr>
					<?php foreach ($company_component as $cmpnnt): ?>
						<tr>	
							<td><?php echo $cmpnnt['flow_name']; ?></td>
							<td><?php echo $cmpnnt['component_name']; ?></td>
						</tr>
					<?php endforeach ?>
				</table>

				<table class="table table-bordered">
					<tr class="success">
						<th colspan="4">Company Equipment</th>
					</tr>
					<tr>
						<th>Equipment Name</th>
						<th>Equipment Type Name</th>
						<th>Equipment Attribute Name</th>
						<th>Used Process</th>
					</tr>
					<?php foreach ($company_equipment as $eqpmnt): ?>
						<tr>	
							<td><?php echo $eqpmnt['eqpmnt_name']; ?></td>
							<td><?php echo $eqpmnt['eqpmnt_type_name']; ?></td>
							<td><?php echo $eqpmnt['eqpmnt_type_attrbt_name']; ?></td>
							<td><?php echo $eqpmnt['prcss_name']; ?></td>
						</tr>
					<?php endforeach ?>
				</table>

				<table class="table table-bordered">
					<tr class="success">
						<th>Company Product</th>
					</tr>
					<tr>
						<th>Product Name</th>
					</tr>
					<?php foreach ($company_product as $prdct): ?>
						<tr>	
							<td><?php echo $prdct['name']; ?></td>
						</tr>
					<?php endforeach ?>
				</table>
			<?php endif ?>			
		<?php endif ?>
		</div>

		<div class="col-md-3">
		<div style="margin-bottom:30px;">
			<?php if($companies['logo'] == null) 
					$companies['logo'] = '.jpg';
				if(file_exists("assets/company_pictures/".$companies['logo'])): ?>
				<img style="width:100%; max-width:250px;" src="<?php echo asset_url('company_pictures/'.$companies['logo']);?>" />
			<?php else: ?>
				<img style="width:100%; max-width:250px;" src="<?php echo asset_url("company_pictures/default.jpg"); ?>">
			<?php endif ?>
		</div>
			<div class="form-group" style="margin-bottom:20px;">
				<ul class="nav nav-list">
					<li class="nav-header" style="font-size:15px;">Company project</li>
				<?php foreach ($prjname as $prj): ?>
					<li><a style="text-transform:capitalize;" href="<?php echo base_url('project/'.$prj['proje_id']); ?>"> <?php echo $prj["name"]; ?></a></li>
				<?php endforeach ?>
				</ul>
			</div>

			<div class="form-group">
				<ul class="nav nav-list">
					<li class="nav-header" style="font-size:15px;">Company users</li>
				<?php foreach ($cmpnyperson as $cmpprsn): ?>
					<li><a style="text-transform:capitalize;" href="<?php echo base_url('user/'.$cmpprsn["user_name"]); ?>"> <?php echo $cmpprsn["name"].' '.$cmpprsn["surname"]; ?></a></li>
				<?php endforeach ?>
				</ul>
			</div>


			<?php if($have_permission): ?>
			<button class="btn btn-sm btn-success" style="width:100%" onclick="$('#target').toggle();">Add New User</button>

			<div id="target" class="well" style="display: none">
				<p>
					Select user to add
				</p>
				<div class="content">
					<?php echo form_open('addUsertoCompany/'.$companies['id']); ?>
						<p>
							<select id="users" class="info select-block" name="users">
							<?php foreach ($users_without_company as $users): ?>
								<option value="<?php echo $users['id']; ?>"><?php echo $users['name'].' '.$users['surname']; ?></option>
								<?php endforeach ?>
							</select>
							<button type="submit" class="btn btn-primary">Add</button>
						</form>
					</p>
				</div>
			</div>
			<?php endif ?>


		</div>
	</div>
</div>
