	<?php print_r($flow); ?>
	<div class="col-md-4 col-md-offset-4">
		<?php echo form_open_multipart('new_flow/'.$companyID); ?>
			<p class="lead">Edit Company Flow</p>
			<div class="form-group">
				<div class="row">
					<div class="col-md-8">
						<label for="quantity">Quantity (Annual) <span style="color:red;">*</span></label>
						<input class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity of Flow" value="<?php echo set_value('quantity',$flow['qntty']); ?>">
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

		  	<button type="submit" class="btn btn-info">Save new data</button>
		</form>
		<span class="label label-default"><span style="color:red;">*</span> labels are required.</span>
		</div>
