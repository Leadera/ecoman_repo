<div class="col-md-9">
	<?php echo form_open_multipart('new_flow/'.$companyID, 'style="overflow:hidden;"'); ?>
		<p class="lead">New flow</p>
		<div class="form-group">
	    <label for="flowname">Flow Name</label>
    	<div>	    			
				<select id="flowname" class="info select-block" name="flowname">
					<?php foreach ($flownames as $flowname): ?>
						<option value="<?php echo $flowname['id']; ?>"><?php echo $flowname['name']; ?></option>
					<?php endforeach ?>
				</select>
			</div>
	  </div>
	  <div class="form-group">
	    <label for="flowtype">Flow Type</label>
	    <div>	    			
				<select id="flowtype" class="info select-block" name="flowtype">
					<?php foreach ($flowtypes as $flowtype): ?>
						<option value="<?php echo $flowtype['id']; ?>"><?php echo $flowtype['name']; ?></option>
					<?php endforeach ?>
				</select>
			</div>
	  </div>
	  <div class="form-group">
	    <label for="quantity">Quantity(Annual)</label>
	    <input class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity of Flow">
	  </div>
	  <div class="form-group">
	    <label for="cost">Cost(Annual)</label>
	    <input class="form-control" id="cost" name="cost" placeholder="Cost of flow (number)">
	  </div>
	  <div class="form-group">
	    <label for="amount">EP(Annual)</label>
	    <input class="form-control" id="ep" name="ep" placeholder="Enter EP">
	  </div>
	  <button type="submit" class="btn btn-primary pull-right">Add Flow</button>
	</form>
	<hr>
	<table class="table table-striped table-bordered text-center">
	<tr>
		<td>Flow Name</td>
		<td>Flow Type</td>
		<td>Quantity</td>
		<td>Cost</td>
		<td>EP</td>
		<td>Equipment</td>
	</tr>
	<?php foreach ($company_flows as $flow): ?>
	<tr>	
			<td><?php echo $flow['flowname']; ?></td>
			<td><?php echo $flow['flowtype']; ?></td>
			<td><?php echo $flow['qntty']; ?></td>
			<td><?php echo $flow['cost']; ?></td>
			<td><?php echo $flow['ep']; ?></td>
			<td><a href="<?php echo base_url('new_flow/'.$companyID);?>" class="btn btn-default btn-sm>" value=""><span class="glyphicon glyphicon-edit"></span></button></td>

	</tr>
	<?php endforeach ?>

	</table>

	</div>

	</div>
</div>