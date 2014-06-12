	<div class="col-md-9">
		<?php echo form_open_multipart('new_flow/'.$companyID); ?>
			<p class="lead">New flow</p>
			<div class="form-group">
				<label for="flowname">Flow Name</label>
				<select id="flowname" class="info select-block" name="flowname">
					<?php foreach ($flownames as $flowname): ?>
						<option value="<?php echo $flowname['id']; ?>"><?php echo $flowname['name']; ?></option>
					<?php endforeach ?>
				</select>
		 	</div>
			<div class="form-group">
				<label for="flowtype">Flow Type</label>
				<select id="flowtype" class="info select-block" name="flowtype">
					<?php foreach ($flowtypes as $flowtype): ?>
						<option value="<?php echo $flowtype['id']; ?>"><?php echo $flowtype['name']; ?></option>
					<?php endforeach ?>
				</select>
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
							<label for="cost">Cost (Annual)</label>
		    			<input class="form-control" id="cost" name="cost" placeholder="Cost of flow (number)">
			    	</div>
						<div class="col-md-4">
							<label for="cost">Cost Unit</label>
							<select id="costUnit" class="info select-block" name="costUnit">
								<?php foreach ($units as $unit): ?>
									<option value="<?php echo $unit['id']; ?>"><?php echo $unit['name']; ?></option>
								<?php endforeach ?>
							</select>
						</div>
		  	</div>
		  	<div class="form-group">
		  		<div class="row">
						<div class="col-md-8">
				  		<label for="amount">EP (Annual)</label>
				    	<input class="form-control" id="ep" name="ep" placeholder="Enter EP">
				    </div>
						<div class="col-md-4">
							<label for="amount">EP Unit</label>
							<select id="epUnit" class="info select-block" name="epUnit">
								<?php foreach ($units as $unit): ?>
									<option value="<?php echo $unit['id']; ?>"><?php echo $unit['name']; ?></option>
								<?php endforeach ?>
							</select>
						</div>
		  		</div>
		  	</div>
		  	<button type="submit" class="btn btn-info">Add Flow</button>
		</form>
		<hr>
		<p class="lead">Company flows</p>
		<table class="table table-striped table-bordered">
			<tr>
				<th>Flow Name</th>
				<th>Flow Type</th>
				<th>Quantity</th>
				<th>Cost</th>
				<th>EP</th>
			</tr>
			<?php foreach ($company_flows as $flow): ?>
				<tr>	
					<td><?php echo $flow['flowname']; ?></td>
					<td><?php echo $flow['flowtype']; ?></td>
					<td><?php echo $flow['qntty'].' '.$flow['qntty_unit_name']; ?></td>
					<td><?php echo $flow['cost'].' '.$flow['cost_unit_name']; ?></td>
					<td><?php echo $flow['ep'].' '.$flow['ep_unit_name']; ?></td>
				</tr>
			<?php endforeach ?>
		</table>
		</div>
	</div>
</div>