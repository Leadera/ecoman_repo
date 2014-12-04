	<div class="col-md-5 borderli">
		<div class="lead">Add new equipment to company</div>
			<?php echo form_open_multipart('new_equipment/'.$companyID); ?>
			<div class="form-group">
					<label for="status">Equipment Name <span style="color:red;">*</span></label>
					<div>	    			
				  	<select class="info select-block" name="equipment" id="equipment">
			  			<option value="">Nothing Selected</option>
						<?php foreach ($equipmentName as $eqpmntName): ?>
						<option value="<?php echo $eqpmntName['id']; ?>"><?php echo $eqpmntName['name']; ?></option>
					<?php endforeach ?>
					</select>
					</div>
				</div>
				<div class="form-group">
					<label for="status">Equipment Type Name <span style="color:red;">*</span></label>
					<div>	    			
			  		<select  class="select-block" id="equipmentTypeName" name="equipmentTypeName">
							<option value="">Nothing Selected</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="status">Equipment Attribute Name <span style="color:red;">*</span></label>
					<div>	    			
			  		<select  class="select-block" id="equipmentAttributeName" name="equipmentAttributeName">
							<option value="">Nothing Selected</option>
						</select>
					</div>
				</div>
				<div class="form-group">
				<div class="row">
					<div class="col-md-8">
						<label for="eqpmnt_attrbt_val">Equipment Attribute Value <span style="color:red;">*</span></label>
						<input class="form-control" id="eqpmnt_attrbt_val" name="eqpmnt_attrbt_val" placeholder="Equipment Attribute Value">
					</div>
					<div class="col-md-4">
						<label for="eqpmnt_attrbt_unit">Equipment Attribute Unit <span style="color:red;">*</span></label>
						<select id="eqpmnt_attrbt_unit" class="info select-block" name="eqpmnt_attrbt_unit">
							<?php foreach ($units as $unit): ?>
								<option value="<?php echo $unit['id']; ?>"><?php echo $unit['name']; ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
			</div>
				<div class="form-group">
			  	<label for="description">Used Processes <span style="color:red;">*</span></label>
			  	<select class="select-block" id="usedprocess" name="usedprocess">
			    	<?php foreach ($process as $prcss): ?>
						<option value="<?php echo $prcss['processid']; ?>"><?php echo $prcss['prcessname']; ?></option>
					<?php endforeach ?>
				</select>
				</div>
			  <button type="submit" class="btn btn-info">Add Equipment</button>
			</form>
		</div>
		<div class="col-md-5">
			<div class="lead">Company equipments</div>
			<table class="table table-striped table-bordered">
				<tr>
					<th>Equipment Name</th>
					<th>Equipment Type Name</th>
					<th>Equipment Attribute Name</th>
					<th>Equipment Attribute Value</th>
					<th>Used Process</th>
					<th>Delete</th>
				</tr>
				<?php foreach ($informations as $info): ?>
				<tr>	
						<td><?php echo $info['eqpmnt_name']; ?></td>
						<td><?php echo $info['eqpmnt_type_name']; ?></td>
						<td><?php echo $info['eqpmnt_type_attrbt_name']; ?></td>
						<td><?php echo $info['eqpmnt_attrbt_val']; ?> <?php echo $info['unit']; ?></td>
						<td><?php echo $info['prcss_name']; ?></td>
						<td><a href="<?php echo base_url('delete_equipment/'.$companyID.'/'.$info['cmpny_eqpmnt_id']);?>" class="label label-danger" value="<?php echo $info['cmpny_eqpmnt_id']; ?>"><span class="fa fa-times"></span> Delete</button></td>
				</tr>
				<?php endforeach ?>
			</table>
		</div>

	