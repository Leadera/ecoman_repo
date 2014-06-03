
	<?php echo form_open_multipart('new_equipment/'.$companyID[0]); ?>
			<div class="col-md-4">
				<div class="form-group">
		    		<label for="status">Equipment Name</label>
		    		<div>	    			
			    		<select id="process" class="info select-block" name="process">
			  			<?php foreach ($process as $pro): ?>
							<option value="<?php echo $pro['id']; ?>"><?php echo $pro['name']; ?></option>
						<?php endforeach ?>
						</select>
					</div>
	 			</div>
	 			<div class="form-group">
			    	<label for="description">Used Processes</label>
			    	<select multiple="multiple" class="select-block" id="usedFlows" name="usedFlows[]">
				    	<?php foreach ($company_flows as $flow): ?>
							<option value="<?php echo $flow['cmpny_flow_id']; ?>"><?php echo $flow['flowname'].'('.$flow['flowtype'].')'; ?></option>
						<?php endforeach ?>
					</select>
		    	</div>
		    <button type="submit" class="btn btn-primary pull-right">Add Equipment</button>
			</div>
			<div class="col-md-5">
				<table class="table table-striped table-bordered text-center">
					<tr>
						<td>Process Name</td>
						<td>Used Flows</td>
					</tr>
				</table>
			</div>
		</div>
	</form>
</div>
