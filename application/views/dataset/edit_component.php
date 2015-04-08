<?php //print_r($component); ?>
	<div class="col-md-6 col-md-offset-3">
		<?php echo form_open_multipart('edit_component/'.$companyID.'/'.$component['id']); ?>
			<p class="lead">Edit Component</p>
			<div class="form-group">
			    <label for="component_name">Component Name <span style="color:red;">*</span></label>
			   	<input class="form-control" id="component_name" name="component_name" placeholder="Enter Component Name" value="<?php echo set_value('component_name',$component['component_name']); ?>">
		 	</div>

		 	<div class="form-group">
			  <label for="component_type">Component Type</label>
				<select id="component_type" class="info select-block" name="component_type">
					<option value="0">Please Select</option>
					<?php foreach ($ctypes as $ctype): ?>
						<?php if($component['type_name']==$ctype['name']) {$deger = TRUE;}else{$deger=False;} ?>
						<option value="<?php echo $ctype['id']; ?>" <?php echo set_select('component_type', $ctype['id'], $deger); ?>><?php echo $ctype['name']; ?></option>
					<?php endforeach ?>
				</select>
		 	</div>

			<div class="form-group">
				<label for="description">Description</label>
				<input class="form-control" id="description" name="description" placeholder="Description" value="<?php echo set_value('description',$component['description']); ?>">
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-md-8">
						<label for="quantity">Quantity (Annual)</label>
						<input class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity of Flow" value="<?php echo set_value('quantity',$component['qntty']); ?>">
					</div>
					<div class="col-md-4">
						<label for="quantity">Quantity Unit</label>
						<select id="quantityUnit" class="info select-block" name="quantityUnit">
							<?php foreach ($units as $unit): ?>
								<?php if($component['qntty_unit_id']==$unit['id']) {$deger = TRUE;}else{$deger=False;} ?>
								<option value="<?php echo $unit['id']; ?>" <?php echo set_select('quantityUnit', $unit['id'], $deger); ?>><?php echo $unit['name']; ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-8">
						<label for="cost">Supply Cost (Annual)</label>
						<input class="form-control" id="cost" name="cost" placeholder="Supply Cost of flow (number)" value="<?php echo set_value('cost',$component['supply_cost']); ?>">
					</div>
					<div class="col-md-4">
						<label for="cost">Supply Cost Unit</label>
						<select id="costUnit" class="info select-block" name="costUnit">
							<?php $edeger = FALSE; ?>
							<?php $ddeger = FALSE; ?>
							<?php $tdeger = FALSE; ?>
							<?php if($component['supply_cost_unit']=="Euro") {$edeger = TRUE;} ?>
							<?php if($component['supply_cost_unit']=="Dolar") {$ddeger = TRUE;} ?>
							<?php if($component['supply_cost_unit']=="TL") {$tdeger = TRUE;} ?>
							<option value="Euro" <?php echo set_select('costUnit', 'Euro', $edeger); ?>>Euro</option>
							<option value="Dolar" <?php echo set_select('costUnit', 'Dolar', $ddeger); ?>>Dolar</option>
							<option value="TL" <?php echo set_select('costUnit', 'TL', $tdeger); ?>>TL</option>
						</select>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-md-8">
						<label for="ocost">Output Cost (Annual)</label>
						<input class="form-control" id="ocost" name="ocost" placeholder="Output Cost of flow (number)" value="<?php echo set_value('ocost',$component['output_cost']); ?>">
					</div>
					<div class="col-md-4">
						<label for="ocostunit">Output Cost Unit</label>
						<select id="ocostunit" class="info select-block" name="ocostunit">
							<?php $edeger = FALSE; ?>
							<?php $ddeger = FALSE; ?>
							<?php $tdeger = FALSE; ?>
							<?php if($component['output_cost_unit']=="Euro") {$edeger = TRUE;} ?>
							<?php if($component['output_cost_unit']=="Dolar") {$ddeger = TRUE;} ?>
							<?php if($component['output_cost_unit']=="TL") {$tdeger = TRUE;} ?>
							<option value="Euro" <?php echo set_select('ocostunit', 'Euro', $edeger); ?>>Euro</option>
							<option value="Dolar" <?php echo set_select('ocostunit', 'Dolar', $ddeger); ?>>Dolar</option>
							<option value="TL" <?php echo set_select('ocostunit', 'TL', $tdeger); ?>>TL</option>
						</select>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label for="quality">Quality</label>
				<input class="form-control" id="quality" name="quality" placeholder="Quality" value="<?php echo set_value('quality',$component['data_quality']); ?>">
			</div>

			<div class="form-group">
				<label for="spot">Substitute potential</label>
				<input class="form-control" id="spot" name="spot" placeholder="Substitute potential" value="<?php echo set_value('substitute_potential',$component['substitute_potential']); ?>">
			</div>
		  
		  <div class="form-group">
				<label for="comment">Comment</label>
				<input class="form-control" id="comment" name="comment" placeholder="Comment" value="<?php echo set_value('comment',$component['comment']); ?>">
			</div>
		  
		  <button type="submit" class="btn btn-info">Save Edited Component Data</button>
		</form>
		<span class="label label-default"><span style="color:red;">*</span> labels are required.</span>

</div>
