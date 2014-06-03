
	<?php echo form_open_multipart('new_equipment/'.$companyID[0]); ?>
			<div class="col-md-4">
				<div class="form-group">
		    		<label for="status">Equipment Name</label>
		    		<div>	    			
			    		<select id="process" class="info select-block" name="equipment">
			  			<?php foreach ($equipmentName as $eqpmntName): ?>
							<option value="<?php echo $eqpmntName['id']; ?>"><?php echo $eqpmntName['name_tr']; ?></option>
						<?php endforeach ?>
						</select>
					</div>
	 			</div>
	 			<div class="form-group">
			    	<label for="description">Used Processes</label>
			    	<select multiple="multiple" class="select-block" id="usedprocess" name="usedprocess[]">
				    	<?php foreach ($process as $prcss): ?>
							<option value="<?php echo $prcss['processid']; ?>"><?php echo $prcss['prcessname']; ?></option>
						<?php endforeach ?>
					</select>
		    	</div>
		    <button type="submit" class="btn btn-primary pull-right">Add Equipment</button>
			</div>
			<div class="col-md-5">
				<table class="table table-striped table-bordered text-center">
					<tr>
						<td>Equipment Name</td>
						<td>Processes</td>
					</tr>
				</table>
			</div>
		</div>
	</form>
</div>
