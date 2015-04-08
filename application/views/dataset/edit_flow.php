	<?php //print_r($flow); ?>
	<div class="col-md-6 col-md-offset-3">
	<?php if(validation_errors() != NULL ): ?>
	    <div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<div>Form couldn't be saved. Please fix the errors.</div>
	      	<div class="popover-content">
	      		<?php echo validation_errors(); ?>
	      	</div>
	    </div>
	<?php endif ?>
		<?php echo form_open_multipart('edit_flow/'.$companyID.'/'.$flow['flow_id'].'/'.$flow['flow_type_id']); ?>
			<p class="lead">Edit Company Flow</p>
			<div class="form-group">
				<div class="row">
					<div class="col-md-8">
						<label for="quantity">Quantity (Annual) <span style="color:red;">*</span></label>
						<input class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity of Flow" value="<?php echo set_value('quantity',$flow['qntty']); ?>">
					</div>
					<div class="col-md-4">
						<label for="quantityUnit">Quantity Unit <span style="color:red;">*</span></label>
						<select id="quantityUnit" class="info select-block" name="quantityUnit">
							<?php foreach ($units as $unit): ?>
								<?php if($flow['qntty_unit_id']==$unit['id']) {$deger = TRUE;}else{$deger=False;} ?>
								<option value="<?php echo $unit['id']; ?>" <?php echo set_select('quantityUnit', $unit['id'], $deger); ?>><?php echo $unit['name']; ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
			</div>
		  	<div class="form-group">
		    	<div class="row">
						<div class="col-md-8">
							<label for="cost">Cost (Annual) <span style="color:red;">*</span></label>
		    			<input class="form-control" id="cost" name="cost" placeholder="Cost of flow (number)" value="<?php echo set_value('cost',$flow['cost']); ?>">
			    	</div>
						<div class="col-md-4">
							<label for="cost">Cost Unit <span style="color:red;">*</span></label>
							<select id="costUnit" class="info select-block" name="costUnit">
								<?php $edeger = FALSE; ?>
								<?php $ddeger = FALSE; ?>
								<?php $tdeger = FALSE; ?>
								<?php if($flow['cost_unit_id']=="Euro") {$edeger = TRUE;} ?>
								<?php if($flow['cost_unit_id']=="Dolar") {$ddeger = TRUE;} ?>
								<?php if($flow['cost_unit_id']=="TL") {$tdeger = TRUE;} ?>
								<option value="Euro" <?php echo set_select('costUnit', 'Euro', $edeger); ?>>Euro</option>
								<option value="Dolar" <?php echo set_select('costUnit', 'Dolar', $ddeger); ?>>Dolar</option>
								<option value="TL" <?php echo set_select('costUnit', 'TL', $tdeger); ?>>TL</option>
							</select>
						</div>
		  		</div>
		  	</div>
		  	<div class="form-group">
		  		<div class="row">
						<div class="col-md-8">
				  		<label for="ep">EP (Annual) <span style="color:red;">*</span></label>
				    	<input class="form-control" id="ep" name="ep" placeholder="Enter EP" value="<?php echo set_value('ep',$flow['ep']); ?>">
				    </div>
						<div class="col-md-4">
							<label for="epUnit">EP Unit <span style="color:red;">*</span></label>
							<input type="text" class="form-control" id="epUnit" value="EP" name="epUnit" readonly>
						</div>
		  		</div>
		  	</div>

		  	<div class="form-group">
				  <label for="cf">Chemical formula</label>
				  <input class="form-control" id="cf" name="cf" placeholder="Chemical formula" value="<?php echo set_value('chemical_formula',$flow['chemical_formula']); ?>">
		  	</div>		  	

				<div class="form-group">
					<label for="availability">Availability</label>
					<select id="availability" class="info select-block" name="availability">
						<?php $aa = FALSE; ?>
						<?php $na = FALSE; ?>
						<?php if($flow['availability']=="t") {$aa = TRUE;} ?>
						<?php if($flow['availability']=="f") {$na = TRUE;} ?>
						<option value="true" <?php echo set_select('availability', 'true', $aa); ?>>Available</option>
						<option value="false" <?php echo set_select('availability', 'false', $na); ?>>Not Available</option>
					</select>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-8">
							<label for="conc">Concentration</label>
							<input class="form-control" id="conc" name="conc" placeholder="Concentration" value="<?php echo set_value('conc',$flow['concentration']); ?>">
						</div>
						<div class="col-md-4">
							<label for="concunit">Concentration Unit</label>
							<select id="concunit" class="info select-block" name="concunit">
								<?php $bir = FALSE; ?>
								<?php $iki = FALSE; ?>
								<?php if($flow['concunit']=="%") {$bir = TRUE;} ?>
								<?php if($flow['concunit']=="kg/m3") {$iki = TRUE;} ?>
								<option value="%" <?php echo set_select('concunit', '%', $bir); ?>>%</option>
								<option value="kg/m3" <?php echo set_select('concunit', 'kg/m3', $iki); ?>>kg/m3</option>								
							</select>
						</div>
					</div>
				</div>				

				<div class="form-group">
					<div class="row">
						<div class="col-md-8">
							<label for="pres">Pressure</label>
							<input class="form-control" id="pres" name="pres" placeholder="Pressure" value="<?php echo set_value('pres',$flow['pression']); ?>">
						</div>
						<div class="col-md-4">
							<label for="presunit">Pressure Unit</label>
							<select id="presunit" class="info select-block" name="presunit">
								<?php $biri = FALSE; ?>
								<?php $ikii = FALSE; ?>
								<?php $uci = FALSE; ?>
								<?php if($flow['presunit']=="Pascal (Pa)") {$biri = TRUE;} ?>
								<?php if($flow['presunit']=="bar (Bar)") {$ikii = TRUE;} ?>
								<?php if($flow['presunit']=="Standard atmosphere (atm)") {$uci = TRUE;} ?>
								<option value="Pascal (Pa)" <?php echo set_select('presunit', 'Pascal (Pa)', $biri); ?>>Pascal (Pa)</option>
								<option value="bar (Bar)" <?php echo set_select('presunit', 'bar (Bar)', $ikii); ?>>bar (Bar)</option>
								<option value="Standard atmosphere (atm)" <?php echo set_select('presunit', 'Standard atmosphere (atm)', $uci); ?>>Standard atmosphere (atm)</option>								
							</select>
						</div>
					</div>
				</div>				

				<div class="form-group">
					<label for="ph">PH</label>
					<input class="form-control" id="ph" name="ph" placeholder="PH" value="<?php echo set_value('ph',$flow['ph']); ?>">
				</div>

				<div class="form-group">
					<label for="state">State</label>
					<select id="state" class="info select-block" name="state">
						<?php $x = FALSE; ?>
						<?php $y = FALSE; ?>
						<?php $z = FALSE; ?>
						<?php if($flow['state_id']=="1") {$x = TRUE;} ?>
						<?php if($flow['state_id']=="2") {$y = TRUE;} ?>
						<?php if($flow['state_id']=="3") {$z = TRUE;} ?>
						<option value="1" <?php echo set_select('state', '1', $x); ?>>Solid</option>
						<option value="2" <?php echo set_select('state', '2', $y); ?>>Liquid</option>
						<option value="3" <?php echo set_select('state', '3', $z); ?>>Gas</option>					
					</select>
				</div>

				<div class="form-group">
					<label for="quality">Quality</label>
					<input class="form-control" id="quality" name="quality" placeholder="Quality" value="<?php echo set_value('quality',$flow['quality']); ?>">
				</div>				

				<div class="form-group">
					<label for="oloc">Output location</label>
					<input class="form-control" id="oloc" name="oloc" placeholder="Output location" value="<?php echo set_value('output_location',$flow['output_location']); ?>">
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
					<input class="form-control" id="spot" name="spot" placeholder="Substitute potential" value="<?php echo set_value('substitute_potential',$flow['substitute_potential']); ?>">
				</div>

				<div class="form-group">
					<label for="desc">Description</label>
					<input class="form-control" id="desc" name="desc" placeholder="Description" value="<?php echo set_value('description',$flow['description']); ?>">
				</div>

				<div class="form-group">
					<label for="comment">Comment</label>
					<input class="form-control" id="comment" name="comment" placeholder="Comment" value="<?php echo set_value('comment',$flow['comment']); ?>">
				</div>

		  	<button type="submit" class="btn btn-info">Save new data</button>
		</form>
		<span class="label label-default"><span style="color:red;">*</span> labels are required.</span>
		</div>
