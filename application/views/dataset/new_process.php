		<script type="text/javascript">
		function getProcessId(){
		    var id = $('.selectize-input .item').html();
		    var isnum = /^\d+$/.test(id);
		    //alert(isnum);
		    if(isnum){
		    	alert("You can't enter only numerical characters as a flow name!");
		    	$("select[id=selectize] option").remove();
		    }
		    //console.log(id);
		    var newid = $('select[name=process]').val();
				var newisnum = /^\d+$/.test(newid);
				if(!newisnum && newid !=""){
					$('#process-family').show("slow");
				}
		}
	</script>

		<div class="col-md-4 borderli">
		<?php echo form_open_multipart('new_process/'.$companyID); ?>

			<p class="lead">Assign new process and set a flow to the company</p>
			<div class="form-group">
	    	<label for="status">Process Name <span style="color:red;">*</span></label>
				<select id="selectize" onchange="getProcessId()" name="process">
					<option value="">Please select a process</option>
					<?php foreach ($process as $pro): ?>
						<option value="<?php echo $pro['id']; ?>"><?php echo $pro['name']; ?></option>
					<?php endforeach ?>
				</select>
 			</div>
 			<div class="form-group" id="process-family" style="display:none;">
				<label for="processfamily">Process Family <span style="color:red;">*</span></label>
				<select id="processfamily" class="info select-block" name="processfamily">
					<?php foreach ($processfamilys as $processfamily): ?>
						<option value="<?php echo $processfamily['id']; ?>"><?php echo $processfamily['name']; ?></option>
					<?php endforeach ?>
				</select>
			</div>
 			<div class="form-group">
		    	<label for="description">Used Flows <span style="color:red;">*</span></label>
		    	<select multiple="multiple" class="select-block" id="usedFlows" name="usedFlows[]">
			    	<?php foreach ($company_flows as $flow): ?>
						<option value="<?php echo $flow['cmpny_flow_id']; ?>"><?php echo $flow['flowname'].'('.$flow['flowtype'].')'; ?></option>
					<?php endforeach ?>
				</select>
	    </div>
	    <div class="form-group">
				<div class="row">
					<div class="col-md-8">
						<label for="min_rate_util">Minimum rate of utilization</label>
						<input class="form-control" id="min_rate_util" name="min_rate_util" placeholder="Minimum rate of utilization">
					</div>
					<div class="col-md-4">
						<label for="min_rate_util_unit">Utilization Unit</label>
						<select id="min_rate_util_unit" class="info select-block" name="min_rate_util_unit">
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
						<label for="typ_rate_util">Typical rate of utilization</label>
						<input class="form-control" id="typ_rate_util" name="typ_rate_util" placeholder="Typical rate of utilization">
					</div>
					<div class="col-md-4">
						<label for="typ_rate_util_unit">Utilization Unit</label>
						<select id="typ_rate_util_unit" class="info select-block" name="typ_rate_util_unit">
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
						<label for="max_rate_util">Maximum rate of utilization</label>
						<input class="form-control" id="max_rate_util" name="max_rate_util" placeholder="Maximum rate of utilization">
					</div>
					<div class="col-md-4">
						<label for="max_rate_util_unit">Utilization Unit</label>
						<select id="max_rate_util_unit" class="info select-block" name="max_rate_util_unit">
							<?php foreach ($units as $unit): ?>
								<option value="<?php echo $unit['id']; ?>"><?php echo $unit['name']; ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="comment">Comment</label>
				<input class="form-control" id="comment" name="comment" placeholder="Comment">
			</div>
	    <button type="submit" class="btn btn-info">Add Process</button>
	    </form>
	    </div>
		<div class="col-md-8">
			<p class="lead">Company processes</p>
			<table class="table table-striped table-bordered">
			<tr>
				<th>Process Name</th>
				<th>Used Flows</th>
				<th>Minimum rate of utilization</th>
				<th>Typical rate of utilization</th>
				<th>Maximum rate of utilization</th>
				<th>Comment</th>
				<th>Delete</th>
			</tr>
			<?php foreach ($cmpny_flow_prcss as $attribute): ?>
				<tr>	
					<td><?php echo $attribute['prcessname']; ?></td>
					<td><?php echo $attribute['flowname'].'('.$attribute['flow_type_name'].')'; ?></td>
					<td><?php echo $attribute['min_rate_util']; ?> <?php echo $attribute['minrateu']; ?></td>
					<td><?php echo $attribute['typ_rate_util']; ?> <?php echo $attribute['typrateu']; ?></td>
					<td><?php echo $attribute['max_rate_util']; ?> <?php echo $attribute['maxrateu']; ?></td>
					<td><?php echo $attribute['comment']; ?></td>
					<td><a href="<?php echo base_url('delete_process/'.$companyID.'/'.$attribute['company_process_id'].'/'.$attribute['company_flow_id']);?>" class="label label-danger" value="<?php echo $attribute['prcessid']; ?>"><span class="fa fa-times"></span> Delete</button></td>
				</tr>
				<?php endforeach ?>
			</table>
		</div>