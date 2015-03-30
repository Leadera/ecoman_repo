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

	<div class="col-md-4 borderli">
		<?php echo form_open_multipart('new_flow/'.$companyID); ?>
			<p class="lead">Add new flow to company</p>
			<div class="form-group">
				<label for="selectize">Flow Name <span style="color:red;">*</span></label>
				<select id="selectize" onchange="getFlowId()" class="info select-block" name="flowname">
					<option value="">Please select a flow</option>
					<?php foreach ($flownames as $flowname): ?>
						<option value="<?php echo $flowname['id']; ?>"><?php echo $flowname['name']; ?></option>
					<?php endforeach ?>
				</select>
		 	</div>
			<div class="form-group">
				<label for="flowtype">Flow Type <span style="color:red;">*</span></label>
				<select id="flowtype" class="info select-block" name="flowtype">
					<?php foreach ($flowtypes as $flowtype): ?>
						<option value="<?php echo $flowtype['id']; ?>"><?php echo $flowtype['name']; ?></option>
					<?php endforeach ?>
				</select>
			</div>
			<div class="form-group" id="flow-family" style="display:none;">
				<label for="flowfamily">Flow Family <span style="color:red;">*</span></label>
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
						<label for="quantity">Quantity (Annual) <span style="color:red;">*</span></label>
						<input class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity of Flow" value="<?php echo set_value('quantity'); ?>">
					</div>
					<div class="col-md-4">
						<label for="quantity">Quantity Unit <span style="color:red;">*</span></label>
						<select id="quantityUnit" class="info select-block" name="quantityUnit">
							<option value="">Please Select</option>
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
							<label for="cost">Cost (Annual) <span style="color:red;">*</span></label>
		    			<input class="form-control" id="cost" name="cost" placeholder="Cost of flow (number)" value="<?php echo set_value('cost'); ?>">
			    	</div>
						<div class="col-md-4">
							<label for="cost">Cost Unit <span style="color:red;">*</span></label>
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
				  		<label for="ep">EP (Annual) <span style="color:red;">*</span></label>
				    	<input class="form-control" id="ep" name="ep" placeholder="Enter EP" value="<?php echo set_value('ep'); ?>">
				    </div>
						<div class="col-md-4">
							<label for="epUnit">EP Unit <span style="color:red;">*</span></label>
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
						<option value="true">Available</option>
						<option value="false">Not Available</option>
					</select>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-8">
							<label for="conc">Concentration</label>
							<input class="form-control" id="conc" name="conc" placeholder="Concentration">
						</div>
						<div class="col-md-4">
							<label for="concunit">Concentration Unit</label>
							<select id="concunit" class="info select-block" name="concunit">
								<option value="">Please Select</option>
								<option value="%">%</option>
								<option value="kg/m3">kg/m3</option>								
							</select>
						</div>
					</div>
				</div>				

				<div class="form-group">
					<div class="row">
						<div class="col-md-8">
							<label for="pres">Pressure</label>
							<input class="form-control" id="pres" name="pres" placeholder="Pressure">
						</div>
						<div class="col-md-4">
							<label for="presunit">Pressure Unit</label>
							<select id="presunit" class="info select-block" name="presunit">
								<option value="">Please Select</option>
								<option value="Pascal (Pa)">Pascal (Pa)</option>
								<option value="bar (Bar)">bar (Bar)</option>
								<option value="Standard atmosphere (atm)">Standard atmosphere (atm)</option>								
							</select>
						</div>
					</div>
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
		<span class="label label-default"><span style="color:red;">*</span> labels are required.</span>
		</div>
	<div class="col-md-8">
		<p class="lead">Company flows</p>
		<table class="table table-striped table-bordered" style="font-size:12px;">
			<tr>
				<th>Flow Name</th>
				<th>Flow Type</th>
				<th>Flow Family Name</th>
				<th>Quantity</th>
				<th>Cost</th>
				<th>EP</th>
				<th>Chemical Formula</th>
				<th>Availability</th>
				<th>Concentration</th>
				<th>Pressure</th>
				<th>PH</th>
				<th>State</th>
				<th>Quality</th>
				<th>Output Location</th>
				<th>Substitue Potential</th>
				<th>Description</th>
				<th>Comment</th>
				<th style="width:100px;">Delete</th>
			</tr>
			<?php foreach ($company_flows as $flow): ?>
				<?php //print_r($flow); ?>
				<tr>	
					<td><?php echo $flow['flowname']; ?></td>
					<td><?php echo $flow['flowtype']; ?></td>
					<td><?php echo $flow['flowfamily']; ?></td>
					<td><?php echo $flow['qntty'].' '.$flow['qntty_unit_name']; ?></td>
					<td><?php echo $flow['cost'].' '.$flow['cost_unit']; ?></td>
					<td><?php echo $flow['ep'].' '.$flow['ep_unit']; ?></td>
					<td><?php echo $flow['chemical_formula']; ?></td>
					<td><?php if($flow['availability']=="t"){echo "Available";}else{echo "Not Available";} ?></td>
					<td><?php echo $flow['concentration'].' '.$flow['concunit']; ?></td>
					<td><?php echo $flow['pression'].' '.$flow['presunit']; ?></td>
					<td><?php echo $flow['ph']; ?></td>
					<td><?php if($flow['state_id']=="1"){echo "Solid";}else if($flow['state_id']=="2"){echo "Liquid";}else{echo "Gas";} ?></td>
					<td><?php echo $flow['quality']; ?></td>
					<td><?php echo $flow['output_location']; ?></td>
					<td><?php echo $flow['substitute_potential']; ?></td>
					<td><?php echo $flow['description']; ?></td>
					<td><?php echo $flow['comment']; ?></td>


					<td>
						<a href="<?php echo base_url('edit_flow/'.$companyID.'/'.$flow['flow_id'].'/'.$flow['flow_type_id']);?>" class="label label-warning"><span class="fa fa-edit"></span> Edit</button>
						<a href="<?php echo base_url('delete_flow/'.$companyID.'/'.$flow['id']);?>" class="label label-danger" onclick="return confirm('Are you sure you want to delete this flow?');"><span class="fa fa-times"></span> Delete</button>
					</td>
			
				</tr>
			<?php endforeach ?>
		</table>
	</div>
