	<div class="col-md-5 borderli">
		<?php echo form_open_multipart('new_component/'.$companyID); ?>
			<p class="lead">Add new component to company</p>
			<div class="form-group">
			    <label for="component_name">Component Name</label>
			   	<input class="form-control" id="component_name" name="component_name" placeholder="Enter Component Name">
		 	</div>

		 	<div class="form-group">
			  <label for="component_type">Component Type</label>
				<select id="component_type" class="info select-block" name="component_type">
					<option value="0">Please Select</option>
					<?php foreach ($ctypes as $ctype): ?>
						<option value="<?php echo $ctype['id']; ?>"><?php echo $ctype['name']; ?></option>
					<?php endforeach ?>
				</select>
		 	</div>

			<div class="form-group">
				<label for="component_name">Connected Flow</label>
				<select id="flowtype" class="info select-block" name="flowtype">
					<?php foreach ($flow_and_flow_type as $flows): ?>
					<option value="<?php echo $flows['value_id']; ?>"><?php echo $flows['flow_name'].'('.$flows['flow_type_name'].')'; ?></option>
					<?php endforeach ?>
				</select>
			</div>

			<div class="form-group">
				<label for="description">Description</label>
				<input class="form-control" id="description" name="description" placeholder="Description">
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-md-8">
						<label for="quantity">Quantity (Annual)</label>
						<input class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity of Flow">
					</div>
					<div class="col-md-4">
						<label for="quantity">Quantity Unit</label>
						<select id="quantityUnit" class="info select-block" name="quantityUnit">
							<?php foreach ($units as $unit): ?>
								<option value="<?php echo $unit['id']; ?>"><?php echo $unit['name']; ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-8">
						<label for="cost">Supply Cost (Annual)</label>
						<input class="form-control" id="cost" name="cost" placeholder="Supply Cost of flow (number)">
					</div>
					<div class="col-md-4">
						<label for="cost">Supply Cost Unit</label>
						<select id="costUnit" class="info select-block" name="costUnit">
							<option value="TL">TL</option>
							<option value="Euro">Euro</option>
							<option value="Dolar">Dolar</option>
						</select>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-md-8">
						<label for="ocost">Output Cost (Annual)</label>
						<input class="form-control" id="ocost" name="ocost" placeholder="Output Cost of flow (number)">
					</div>
					<div class="col-md-4">
						<label for="ocostunit">Output Cost Unit</label>
						<select id="ocostunit" class="info select-block" name="ocostunit">
							<option value="TL">TL</option>
							<option value="Euro">Euro</option>
							<option value="Dolar">Dolar</option>
						</select>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label for="quality">Quality</label>
				<input class="form-control" id="quality" name="quality" placeholder="Quality">
			</div>

			<div class="form-group">
				<label for="spot">Substitute potential</label>
				<input class="form-control" id="spot" name="spot" placeholder="Substitute potential">
			</div>
		  
		  <div class="form-group">
				<label for="comment">Comment</label>
				<input class="form-control" id="comment" name="comment" placeholder="Comment">
			</div>
		  
		  <button type="submit" class="btn btn-info">Add Component</button>
		</form>
		</div>
		<div class="col-md-5">
		<p class="lead">Company components</p>
		<table class="table table-striped table-bordered">
			<tr>
				<th>Flow Name</th>
				<th>Component Name</th>
				<th>Component Type Name</th>
				<th>Description</th>
				<th>Quantity</th>
				<th>Supply Cost</th>
				<th>Output Cost</th>
				<th>Quality</th>
				<th>Substitute Potential</th>
				<th>Comment</th>
				<th style="width:100px;">Delete</th>
			</tr>
			<?php foreach ($component_name as $component): ?>
				<tr>
					<td><?php echo $component['flow_name']; ?> (<?php echo $component['flow_type_name']; ?>)</td>
					<td><?php echo $component['component_name']; ?></td>
					<td><?php echo $component['type_name']; ?></td>
					<td><?php echo $component['description']; ?></td>
					<td><?php echo $component['qntty']; ?> <?php echo $component['qntty_unit_id']; ?></td>
					<td><?php echo $component['supply_cost']; ?> <?php echo $component['supply_cost_unit']; ?></td>
					<td><?php echo $component['output_cost']; ?> <?php echo $component['output_cost_unit']; ?></td>
					<td><?php echo $component['data_quality']; ?></td>
					<td><?php echo $component['substitute_potential']; ?></td>
					<td><?php echo $component['comment']; ?></td>
					<td><a href="<?php echo base_url('delete_component/'.$companyID.'/'.$component['id']);?>" class="label label-danger" value="<?php echo $component['id']; ?>"><span class="fa fa-times"></span> Delete</a></td>
			
				</tr>
			<?php endforeach ?>
		</table>
		</div>