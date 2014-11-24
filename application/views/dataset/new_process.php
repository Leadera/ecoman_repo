		<div class="col-md-5 borderli">
		<?php echo form_open_multipart('new_process/'.$companyID); ?>

			<p class="lead">Add new process</p>
			<div class="form-group">
	    	<label for="status">Process Name</label>
				<select id="selectize" name="process">
					<option value="">Please select a process</option>
					<?php foreach ($process as $pro): ?>
						<option value="<?php echo $pro['id']; ?>"><?php echo $pro['name']; ?></option>
					<?php endforeach ?>
				</select>
 			</div>
 			<div class="form-group">
		    	<label for="description">Used Flows</label>
		    	<select multiple="multiple" class="select-block" id="usedFlows" name="usedFlows[]">
			    	<?php foreach ($company_flows as $flow): ?>
						<option value="<?php echo $flow['cmpny_flow_id']; ?>"><?php echo $flow['flowname'].'('.$flow['flowtype'].')'; ?></option>
					<?php endforeach ?>
				</select>
	    	</div>
	    <button type="submit" class="btn btn-info">Add Process</button>
	    </form>
	    </div>
		<div class="col-md-5">
			<p class="lead">Company processes</p>
			<table class="table table-striped table-bordered">
			<tr>
				<th>Process Name</th>
				<th>Used Flows</th>
				<th>Delete</th>
			</tr>
			<?php foreach ($cmpny_flow_prcss as $attribute): ?>
				<tr>	
					<td><?php echo $attribute['prcessname']; ?></td>
					<td><?php echo $attribute['flowname'].'('.$attribute['flow_type_name'].')'; ?></td>
					<td><a href="<?php echo base_url('delete_process/'.$companyID.'/'.$attribute['company_process_id'].'/'.$attribute['company_flow_id']);?>" class="label label-danger" value="<?php echo $attribute['prcessid']; ?>"><span class="fa fa-times"></span> Delete</button></td>
				</tr>
				<?php endforeach ?>
			</table>
		</div>