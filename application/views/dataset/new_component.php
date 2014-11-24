	<div class="col-md-5 borderli">
		<?php echo form_open_multipart('new_component/'.$companyID); ?>
			<p class="lead">Add new component to company</p>
			<div class="form-group">
			    <label for="component_name">Component Name</label>
			   	<input class="form-control" id="component_name" name="component_name" placeholder="Enter Component Name">
		 	</div>

			<div class="form-group">
					<label for="component_name">Connected Flow</label>
			    <select id="flowtype" class="info select-block" name="flowtype">
					<?php foreach ($flow_and_flow_type as $flows): ?>
						<option value="<?php echo $flows['value_id']; ?>"><?php echo $flows['flow_name'].'('.$flows['flow_type_name'].')'; ?></option>
					<?php endforeach ?>
				</select>
			</div>
		  	
		  	<button type="submit" class="btn btn-info">Add Component</button>
		</form>
		</div>
		<div class="col-md-5">
		<p class="lead">Company components</p>
		<table class="table table-striped table-bordered">
			<tr>
				<th>Flow Name</th>
				<th>Component Name</th>
				<th style="width:100px;">Delete</th>
			</tr>
			<?php foreach ($component_name as $component): ?>
				<tr>	
					<td><?php echo $component['flow_name']; ?> (<?php echo $component['flow_type_name']; ?>)</td>
					<td><?php echo $component['component_name']; ?></td>
					<td><a href="<?php echo base_url('delete_component/'.$companyID.'/'.$component['id']);?>" class="label label-danger" value="<?php echo $component['id']; ?>"><span class="fa fa-times"></span> Delete</a></td>
			
				</tr>
			<?php endforeach ?>
		</table>
		</div>