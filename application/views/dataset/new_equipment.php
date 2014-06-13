	<div class="col-md-9">
	<?php echo form_open_multipart('new_equipment/'.$companyID); ?>
	<div class="form-group">
			<label for="status">Equipment Name</label>
			<div>	    			
		  	<select class="info select-block" name="equipment" id="equipment">
					<?php foreach ($equipmentName as $eqpmntName): ?>
					<option value="<?php echo $eqpmntName['id']; ?>"><?php echo $eqpmntName['name']; ?></option>
				<?php endforeach ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="status">Equipment Type Name</label>
			<div>	    			
	  		<select  class="select-block" id="equipmentTypeName" name="equipmentTypeName">

				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="status">Equipment Attribute Name</label>
			<div>	    			
	  		<select  class="select-block" id="equipmentAttributeName" name="equipmentAttributeName">

				</select>
			</div>
		</div>
		<div class="form-group">
	  	<label for="description">Used Processes</label>
	  	<select class="select-block" id="usedprocess" name="usedprocess">
	    	<?php foreach ($process as $prcss): ?>
				<option value="<?php echo $prcss['processid']; ?>"><?php echo $prcss['prcessname']; ?></option>
			<?php endforeach ?>
		</select>
		</div>
	  <button type="submit" class="btn btn-info">Add Equipment</button>
	</form>
	<div class="clearfix">
		<hr>
		<table class="table table-striped table-bordered">
			<tr>
				<th>Equipment Name</th>
				<th>Equipment Type Name</th>
				<th>Equipment Attribute Name</th>
				<th>Used Process</th>
				<th>Delete</th>
			</tr>
			<?php foreach ($informations as $info): ?>
			<tr>	
					<td><?php echo $info['eqpmnt_name']; ?></td>
					<td><?php echo $info['eqpmnt_type_name']; ?></td>
					<td><?php echo $info['eqpmnt_type_attrbt_name']; ?></td>
					<td><?php echo $info['prcss_name']; ?></td>
					<td><a href="<?php echo base_url('delete_equipment/'.$companyID.'/'.$info['cmpny_eqpmnt_id']);?>" class="btn btn-danger btn-sm" value="<?php echo $info['cmpny_eqpmnt_id']; ?>"><span class="glyphicon glyphicon-remove"></span></button></td>
			</tr>
			<?php endforeach ?>
		</table>
	</div>

		</div>
	</div>
</div>
