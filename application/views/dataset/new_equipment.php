	<div class="col-md-9">
	<?php echo form_open_multipart('new_equipment/'.$companyID[0],'style="overflow:hidden;"'); ?>
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
			    <button type="submit" class="btn btn-primary pull-right">Add Equipment</button>
			
	</form>
		<hr>
		<table class="table table-striped table-bordered text-center">
			<tr>
				<td>Equipment Name</td>
				<td>Equipment Type Name</td>
				<td>Equipment Attribute Name</td>
				<td>Processes</td>
			</tr>
			<?php foreach ($informations as $info): ?>
			<tr>	
					<td><?php echo $info['equipment_name']; ?></td>
					<td><?php echo $info['equipment_type_name']; ?></td>
					<td>NULL</td>
					<td><?php echo $info['prcss_name']; ?></td>
			</tr>
			<?php endforeach ?>
		</table>
		</div>
	</div>
</div>
