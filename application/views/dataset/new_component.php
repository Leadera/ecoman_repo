	<div class="col-md-9">
		<?php echo form_open_multipart('new_component/'.$companyID, 'style="overflow:hidden;"'); ?>
			<p class="lead">New Component</p>
			<div class="form-group">
			    <label for="component_name">Component Name</label>
			   	<input class="form-control" id="component_name" name="component_name" placeholder="Enter Component Name">
		 	</div>

			<div class="form-group">
			    <select id="flowtype" class="info select-block" name="flowtype">
					<?php foreach ($flow_and_flow_type as $flows): ?>
						<option value="<?php echo $flows['value_id']; ?>"><?php echo $flows['flow_name'].'('.$flows['flow_type_name'].')'; ?></option>
					<?php endforeach ?>
				</select>
			</div>
		  	
		  	<button type="submit" class="btn btn-primary pull-right">Add Component</button>
		</form>
		<hr>
		<table class="table table-striped table-bordered text-center">
			<tr>
				<td><b>Component Name</b></td>
			</tr>
			<?php foreach ($component_name as $component): ?>
				<tr>	
					<td><?php echo $component['name']; ?></td>
				</tr>
			<?php endforeach ?>
		</table>
		</div>
	</div>
</div>