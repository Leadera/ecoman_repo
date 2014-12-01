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

		  	<div class="form-group">
				  <label for="cf">Chemical formula</label>
				  <input class="form-control" id="cf" name="cf" placeholder="Chemical formula">
		  	</div>		  	

				<div class="form-group">
					<label for="availability">Availability</label>
					<select id="availability" class="info select-block" name="availability">
						<option value="1">Available</option>
						<option value="0">Not Available</option>
					</select>
				</div>

				<div class="form-group">
					<label for="conc">Concentration</label>
					<input class="form-control" id="conc" name="conc" placeholder="Concentration">
				</div>				

				<div class="form-group">
					<label for="pres">Pression</label>
					<input class="form-control" id="pres" name="pres" placeholder="Pression">
				</div>				

				<div class="form-group">
					<label for="ph">PH</label>
					<input class="form-control" id="ph" name="ph" placeholder="PH">
				</div>

				<div class="form-group">
					<label for="state">State</label>
					<select id="state" class="info select-block" name="state">
						<option value="1">Solid</option>
						<option value="2">Liquid</option>
						<option value="3">Gas</option>
					</select>
				</div>

				<div class="form-group">
					<label for="quality">Quality</label>
					<input class="form-control" id="quality" name="quality" placeholder="Quality">
				</div>				

				<div class="form-group">
					<label for="oloc">Output location</label>
					<input class="form-control" id="oloc" name="oloc" placeholder="Output location">
				</div>				

<!--					<div class="form-group">
					<label for="odis">Output distance</label>
					<input class="form-control" id="odis" name="odis" placeholder="Output distance">
				</div>				

				<div class="form-group">
					<label for="otrasmean">Output transport mean</label>
					<input class="form-control" id="otrasmean" name="otrasmean" placeholder="Output transport mean">
				</div>				

				<div class="form-group">
					<label for="sdis">Supply distance</label>
					<input class="form-control" id="sdis" name="sdis" placeholder="Supply distance">
				</div>				

				<div class="form-group">
					<label for="strasmean">Supply transport mean</label>
					<input class="form-control" id="strasmean" name="strasmean" placeholder="Supply transport mean">
				</div>
						
 				<div class="form-group">
					<label for="rtech">Recycling technology</label>
					<input class="form-control" id="rtech" name="rtech" placeholder="Recycling technology">
				</div> -->
				
				<div class="form-group">
					<label for="spot">Substitute potential</label>
					<input class="form-control" id="spot" name="spot" placeholder="Substitute potential">
				</div>

				<div class="form-group">
					<label for="desc">Description</label>
					<input class="form-control" id="desc" name="desc" placeholder="Description">
				</div>

				<div class="form-group">
					<label for="comment">Comment</label>
					<input class="form-control" id="comment" name="comment" placeholder="Comment">
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
