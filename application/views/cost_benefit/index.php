<div class="col-md-8">
	<p>Cost - Benefit Analysis</p>
	<?php if (!empty($allocation)): ?>
			<?php $i=1; ?>
			<?php foreach ($allocation as $a): ?>

 				<?php $attributes = array('id' => 'form-'.$i); ?>
				<?php echo form_open('cost-benefit', $attributes); ?>
				<table class="costtable">
					<tr>
						<td>#</td><td><?php echo $i; ?> (<?php echo $a['allocation_id']; ?>)</td>
					</tr>
					<tr>
						<td width="250">Option</td>
						<td width="75%"><b><?php echo $a['prcss_name']; ?></b> <small class="text-muted"><?php echo $a['flow_name']; ?>-<?php echo $a['flow_type_name']; ?></small><br><span class="text-info"><?php echo $a['best']; ?></span></td>
					</tr>
						<tr><td>CAPEX old option (€)</td>								
						<td><div class=" has-warning"><input type="number" name="capexold" id="capexold-<?php echo $i; ?>" class="form-control has-warning" placeholder="You should fill this field."></div></td>
					</tr>
					<tr>
						<td>OPEX old option (€)</td>
						<td><input type="number" name="opexold" id="opexold-<?php echo $i; ?>" class="form-control"></td>
					</tr>
					<tr>
						<td>Lifetime old option (yr)</td>
						<td><div class=" has-warning"><input type="number" name="ltold" id="ltold-<?php echo $i; ?>" class="form-control" placeholder="You should fill this field."></div></td>
					</tr>
					<tr>
						<td>CAPEX new option (€)</td>
						<td><div class=" has-warning"><input type="number" name="capexnew" id="capexnew-<?php echo $i; ?>" class="form-control" placeholder="You should fill this field."></div></td>
					</tr>
					<tr>
						<td>OPEX new option (€)</td>
						<td><input type="number" name="opexnew" id="opexnew-<?php echo $i; ?>" class="form-control"></td>
					</tr>
					<tr>
						<td>Lifetime new option (yr)</td>
						<td><div class=" has-warning"><input type="number" name="ltnew" id="ltnew-<?php echo $i; ?>" class="form-control" placeholder="You should fill this field."></div></td>
					</tr>
					<tr>
						<td>Discount rate (%)</td>
						<td><div class=" has-warning"><input type="number" name="disrate" id="disrate-<?php echo $i; ?>" class="form-control" placeholder="You should fill this field."></div></td>
					</tr>
					<tr>
						<td>Ann. costs old option</td>
						<td><input type="number" name="acold" id="acold-<?php echo $i; ?>" class="form-control"></td>
					</tr>
					<tr>
						<td>Ann. costs new option</td>
						<td><input type="number" name="acnew" id="acnew-<?php echo $i; ?>" class="form-control"></td>
					</tr>
					<tr>
						<td>Economic Cost/Benefit</td>
						<td><input type="number" name="eco" id="eco-<?php echo $i; ?>" class="form-control"></td>
					</tr>
					<tr>
						<td>Unit</td>
						<td>Euro/Year</td>
					</tr>
					<tr>
						<td>Old Consumption</td><td><input type="number" name="oldcons" id="oldcons-<?php echo $i; ?>" class="form-control" value="<?php echo $a['qntty']; ?>"></td>
					</tr>
					<tr>
						<td>Old Total Cost</td><td><input type="number" name="oldcost" id="oldcost-<?php echo $i; ?>" class="form-control" value="<?php echo $a['cost']; ?>"></td>
					</tr>
					<tr>
						<td>Old Total EP</td><td><input type="number" name="oldep" id="oldep-<?php echo $i; ?>" class="form-control" value="<?php echo $a['ep']; ?>"></td>
					</tr>
					<tr>
						<td>Estimated new consumption</td>
						<td><div class=" has-warning"><input type="number" name="newcons" id="newcons-<?php echo $i; ?>" class="form-control" placeholder="You should fill this field."></div></td>
					</tr>
					<tr>
						<td>Unit</td>
						<td><?php echo $a['qntty_unit']; ?>/year</td>
					</tr>
					<tr>
						<td>€/ Unit</td>
						<td><input type="number" name="euunit" id="euunit-<?php echo $i; ?>" class="form-control" value="<?php echo round($a['cost']/$a['qntty'],2); ?>" ></td>
					</tr>
					<tr>
						<td>EIP/ Unit</td>
						<td><input type="number" name="eipunit" id="eipunit-<?php echo $i; ?>" class="form-control" value="<?php echo round($a['ep']/$a['qntty'],2); ?>" ></td>
					</tr>
					<tr>
						<td>Ecological Benefit</td>
						<td><input type="number" name="ecoben" id="ecoben-<?php echo $i; ?>" class="form-control"></td>
					</tr>
					<tr>
						<td>Unit</td>
						<td>EIP/year</td>
					</tr>
					<tr>
						<td>Marginal costs</td>
						<td><input type="number" name="marcos" id="marcos-<?php echo $i; ?>" class="form-control"></td>	
					</tr>
					<tr>
						<td>Unit</td><td>¢/EIP</td>
					</tr>
				</table>
				<input type="submit" value="Save" class="btn btn-block btn-info" style="margin-top:20px;"/>
				<script type="text/javascript">
					$('#form-<?php echo $i; ?> input').keydown(function(e){
						
						// Allow: backspace, delete, tab, escape, enter and .
						if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
						     // Allow: Ctrl+A
						    (e.keyCode == 65 && e.ctrlKey === true) || 
						     // Allow: home, end, left, right, down, up
						    (e.keyCode >= 35 && e.keyCode <= 40)) {
						         // let it happen, don't do anything
						         return;
						}
						// Ensure that it is a number and stop the keypress
						if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
						    e.preventDefault();
						}

						//console.log("x<?php echo $i; ?>");
					});

					$('#form-<?php echo $i; ?> input').change(function(e){

						//OPEX OLD calculation
						$("#opexold-<?php echo $i; ?>").val($("#oldcons-<?php echo $i; ?>").val()*$("#euunit-<?php echo $i; ?>").val());

						//OPEX NEW calculation
						$("#opexnew-<?php echo $i; ?>").val($("#newcons-<?php echo $i; ?>").val()*$("#euunit-<?php echo $i; ?>").val());

						//Ecological Benefit calculation
						$("#ecoben-<?php echo $i; ?>").val(-$("#eipunit-<?php echo $i; ?>").val() * ($("#newcons-<?php echo $i; ?>").val()-$("#oldcons-<?php echo $i; ?>").val()));

						//Economic cost-benefit calculation
						$("#eco-<?php echo $i; ?>").val($("#acnew-<?php echo $i; ?>").val()-$("#acold-<?php echo $i; ?>").val());

						//MArgianl-costs calculation
						//=EĞER(W3>0,M3/W3*100,-M3/W3*100)
						if($("#ecoben-<?php echo $i; ?>").val()>0){
							$("#marcos-<?php echo $i; ?>").val($("#eco-<?php echo $i; ?>").val()/$("#ecoben-<?php echo $i; ?>").val()*100);
						}
						else{
							$("#marcos-<?php echo $i; ?>").val(-$("#eco-<?php echo $i; ?>").val()/$("#ecoben-<?php echo $i; ?>").val()*100);
						}


						//Ann. costs old option calculation
						//D3*(J3*(1+J3)^F3)/((1+J3)^F3-1)+E3
						//capexold*(Discount*(1+Discount)^Lifetimeold)/(((1+Discount)^Lifetimeold)-1)+opexold
						$("#acold-<?php echo $i; ?>").val( 
							parseFloat($("#capexold-<?php echo $i; ?>").val()*( 
								$("#disrate-<?php echo $i; ?>").val()/100 * 
									Math.pow(
										((1)+parseFloat($("#disrate-<?php echo $i; ?>").val()/100)),$("#ltold-<?php echo $i; ?>").val()
									))/(parseFloat(
									Math.pow(
										((1)+parseFloat($("#disrate-<?php echo $i; ?>").val()/100)),$("#ltold-<?php echo $i; ?>").val()
									)
								)-(1)))
							+ parseFloat($("#opexold-<?php echo $i; ?>").val())
						);

						/*
						console.log(
							Math.pow(
										((1)+parseFloat($("#disrate-<?php echo $i; ?>").val()/100)),$("#ltold-<?php echo $i; ?>").val()
								)-(1)
						);
						console.log(parseFloat($("#disrate-<?php echo $i; ?>").val()/100));
						console.log(parseFloat($("#ltold-<?php echo $i; ?>").val()));
						*/





					});

 				</script>
				<hr>
				<?php $i++; ?>
				</form>
			<?php endforeach ?>
		<?php endif ?>
</div>
<div class="col-md-4">
	Graph
</div>







