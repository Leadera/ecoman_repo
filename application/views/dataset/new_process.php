
	<?php echo form_open_multipart('new_process/'.$companyID[0]); ?>
			<div class="col-md-4">
				<div class="form-group">
		    		<label for="status">Process Name</label>
		    		<div>	    			
			    		<select id="process" class="info select-block" name="process">
			  			<?php foreach ($process as $pro): ?>
							<option value="<?php echo $pro['id']; ?>"><?php echo $pro['name']; ?></option>
						<?php endforeach ?>
						</select>
					</div>
	 			</div>
	 			<div class="form-group">
			    	<label for="description">Used Flows</label>
			    	<select multiple="multiple" class="select-block" id="usedFlows" name="usedFlows[]">
				    	<?php foreach ($company_flows as $flow): ?>
							<option value="<?php echo $flow['cmpny_flow_id']; ?>"><?php echo $flow['flowname'].'('.$flow['flowtype'].')'; ?></option>
						<?php endforeach ?>
					</select>
		    	</div>
		    <button type="submit" class="btn btn-primary pull-right">Add Process</button>
			</div>
			<div class="col-md-5">
				<table class="table table-striped table-bordered text-center">
					<tr>
						<td>Process Name</td>
						<td>Used Flows</td>
					</tr>
					<?php foreach ($cmpny_flow_prcss as $attribute): ?>
						<tr>	
							<td><?php echo $attribute['prcessname']; ?></td>
							<td><?php echo $attribute['flowname']; ?></td>
						</tr>
						<?php endforeach ?>
				</table>
			</div>
		</div>
	</form>
</div>
