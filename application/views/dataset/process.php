
	<?php echo form_open_multipart('process'); ?>

			<div class="col-md-4">
				<div class="form-group">
		    		<label for="status">Process Name</label>
		    		<div>	    			
			    		<select id="status" class="info select-block" name="status">
			  			<?php foreach ($process as $pro): ?>
							<option value="<?php echo $pro['id']; ?>"><?php echo $pro['name']; ?></option>
						<?php endforeach ?>-->
						</select>
					</div>
	 			</div>
	 			<div class="form-group">
		    	<label for="description">Used Flows</label>
		    	<?php foreach ($company_flows as $flow): ?>
					<ul class="nav nav-list">	
							<li  class="nav-header" style="font-size:15px;"><?php echo $flow['flowname'].'('.$flow['flowtype'].')'; ?></li>
					</ul>
					<?php endforeach ?>

		    </div>
			</div>
		</div>
		<button type="submit" class="btn btn-primary pull-right">Add Process</button>
	</form>
</div>
