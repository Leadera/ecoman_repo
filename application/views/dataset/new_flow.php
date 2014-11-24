	<script type="text/javascript">
		function getFlowId(){
		    var id = $('.selectize-input .item').html();
		    var isnum = /^\d+$/.test(id);
		    //alert(isnum);
		    if(isnum){
		    	alert("You can't enter only numerical characters as a flow name!");
		    	$("select[id=selectize] option").remove();
		    }
		    //console.log(id);
		    var newid = $('select[name=flowname]').val();
				var newisnum = /^\d+$/.test(newid);
				if(!newisnum && newid !=""){
					$('#flow-family').show("slow");
				}
		}
	</script>

	<div class="col-md-5 borderli">
		<?php echo form_open_multipart('new_flow/'.$companyID); ?>
			<p class="lead">Add new flow to company</p>
			<div class="form-group">
				<label for="selectize">Flow Name</label>
				<select id="selectize" onchange="getFlowId()" class="info select-block" name="flowname">
					<option value="">Please select a flow</option>
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
			<div class="form-group" id="flow-family" style="display:none;">
				<label for="flowfamily">Flow Family</label>
				<select id="flowfamily" class="info select-block" name="flowfamily">
					<option value="">Nothing Selected</option>
					<?php foreach ($flowfamilys as $flowfamily): ?>
						<option value="<?php echo $flowfamily['id']; ?>"><?php echo $flowfamily['name']; ?></option>
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
				  		<label for="amount">EP (Annual)</label>
				    	<input class="form-control" id="ep" name="ep" placeholder="Enter EP">
				    </div>
						<div class="col-md-4">
							<label for="amount">EP Unit</label>
							<input type="text" class="form-control" id="epUnit" value="EP" name="epUnit" readonly>
						</div>
		  		</div>
		  	</div>
		  	<button type="submit" class="btn btn-info">Add Flow</button>
		</form>
		</div>
	<div class="col-md-5">
		<p class="lead">Company flows</p>
		<table class="table table-striped table-bordered">
			<tr>
				<th>Flow Name</th>
				<th>Flow Type</th>
				<th>Flow Family Name</th>
				<th>Quantity</th>
				<th>Cost</th>
				<th>EP</th>
				<th style="width:100px;">Delete</th>
			</tr>
			<?php foreach ($company_flows as $flow): ?>
				<tr>	
					<td><?php echo $flow['flowname']; ?></td>
					<td><?php echo $flow['flowtype']; ?></td>
					<td><?php echo $flow['flowfamily']; ?></td>
					<td><?php echo $flow['qntty'].' '.$flow['qntty_unit_name']; ?></td>
					<td><?php echo $flow['cost'].' '.$flow['cost_unit']; ?></td>
					<td><?php echo $flow['ep'].' '.$flow['ep_unit']; ?></td>
					<td><a href="<?php echo base_url('delete_flow/'.$companyID.'/'.$flow['id']);?>" class="label label-danger" value="<?php echo $flow['id']; ?>"><span class="fa fa-times"></span> Delete</button></td>
			
				</tr>
			<?php endforeach ?>
		</table>
	</div>
