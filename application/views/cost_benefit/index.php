<link href="<?php echo asset_url('visualize/css/basic.css'); ?>" type="text/css" rel="stylesheet" />
<link href="<?php echo asset_url('visualize/css/visualize.css'); ?>" type="text/css" rel="stylesheet" />
<link href="<?php echo asset_url('visualize/css/visualize-light.css'); ?>" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo asset_url('visualize/js/enhance.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset_url('visualize/js/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset_url('visualize/js/visualize.jQuery.js'); ?>"></script>
	<script type="text/javascript">
		// Run the script on DOM ready:
		$(function(){
			$('#test').graph();
		});
	</script>

<div class="col-md-6">
	<p>Cost - Benefit Analysis</p>
	<?php if (!empty($allocation)): ?>
			<?php $i=1; ?>
			<?php foreach ($allocation as $a): ?>

 				<?php $attributes = array('id' => 'form-'.$i); ?>
				<?php echo form_open('cba/save/'.$a['allocation_id'].'/'.$this->uri->segment(2).'/'.$this->uri->segment(3), $attributes); ?>
				<table class="costtable">
					<tr>
						<td>#</td><td><?php echo $i; ?> (<?php echo $a['allocation_id']; ?>)</td>
					</tr>
					<tr>
						<td width="250">Option</td>
						<td width="75%"><b><?php echo $a['prcss_name']; ?></b> <small class="text-muted"><?php echo $a['flow_name']; ?>-<?php echo $a['flow_type_name']; ?></small><br><span class="text-info"><?php echo $a['best']; ?></span></td>
					</tr>
						<tr><td>CAPEX old option (€)</td>								
						<td><div class=" has-warning"><input type="text" name="capexold" id="capexold-<?php echo $i; ?>" class="form-control has-warning" value="<?php echo $a['capexold']; ?>" placeholder="You should fill this field."></div></td>
					</tr>
					<tr>
						<td>OPEX old option (€)</td>
						<td><input type="text" name="opexold" id="opexold-<?php echo $i; ?>" class="form-control"></td>
					</tr>
					<tr>
						<td>Lifetime old option (yr)</td>
						<td><div class=" has-warning"><input type="text" name="ltold" id="ltold-<?php echo $i; ?>" value="<?php echo $a['ltold']; ?>" class="form-control" placeholder="You should fill this field."></div></td>
					</tr>
					<tr>
						<td>CAPEX new option (€)</td>
						<td><div class=" has-warning"><input type="text" name="capexnew" id="capexnew-<?php echo $i; ?>" value="<?php echo $a['capexnew']; ?>" class="form-control" placeholder="You should fill this field."></div></td>
					</tr>
					<tr>
						<td>OPEX new option (€)</td>
						<td><input type="text" name="opexnew" id="opexnew-<?php echo $i; ?>" class="form-control"></td>
					</tr>
					<tr>
						<td>Lifetime new option (yr)</td>
						<td><div class=" has-warning"><input type="text" name="ltnew" id="ltnew-<?php echo $i; ?>" value="<?php echo $a['ltnew']; ?>" class="form-control" placeholder="You should fill this field."></div></td>
					</tr>
					<tr>
						<td>Discount rate (%)</td>
						<td><div class=" has-warning"><input type="text" name="disrate" id="disrate-<?php echo $i; ?>"  value="<?php echo $a['disrate']; ?>" class="form-control" placeholder="You should fill this field."></div></td>
					</tr>
					<tr>
						<td>Ann. costs old option</td>
						<td><input type="text" name="acold" id="acold-<?php echo $i; ?>" class="form-control"></td>
					</tr>
					<tr>
						<td>Ann. costs new option</td>
						<td><input type="text" name="acnew" id="acnew-<?php echo $i; ?>" class="form-control"></td>
					</tr>
					<tr>
						<td>Economic Cost/Benefit</td>
						<td><input type="text" name="eco" id="eco-<?php echo $i; ?>" class="form-control"></td>
					</tr>
					<tr>
						<td>Unit</td>
						<td>Euro/Year</td>
					</tr>
					<tr>
						<td>Old Consumption</td><td><input type="text" name="oldcons" id="oldcons-<?php echo $i; ?>" class="form-control" value="<?php echo $a['qntty']; ?>"></td>
					</tr>
					<tr>
						<td>Old Total Cost</td><td><input type="text" name="oldcost" id="oldcost-<?php echo $i; ?>" class="form-control" value="<?php echo $a['cost']; ?>"></td>
					</tr>
					<tr>
						<td>Old Total EP</td><td><input type="text" name="oldep" id="oldep-<?php echo $i; ?>" class="form-control" value="<?php echo $a['ep']; ?>"></td>
					</tr>
					<tr>
						<td>Estimated new consumption</td>
						<td><div class=" has-warning"><input type="text" name="newcons" id="newcons-<?php echo $i; ?>" value="<?php echo $a['newcons']; ?>" class="form-control" placeholder="You should fill this field."></div></td>
					</tr>
					<tr>
						<td>Unit</td>
						<td><?php echo $a['qntty_unit']; ?>/year</td>
					</tr>
					<tr>
						<td>€/ Unit</td>
						<td><input type="text" name="euunit" id="euunit-<?php echo $i; ?>" class="form-control" value="<?php echo round($a['cost']/$a['qntty'],2); ?>" ></td>
					</tr>
					<tr>
						<td>EIP/ Unit</td>
						<td><input type="text" name="eipunit" id="eipunit-<?php echo $i; ?>" class="form-control" value="<?php echo round($a['ep']/$a['qntty'],2); ?>" ></td>
					</tr>
					<tr>
						<td>Ecological Benefit</td>
						<td><input type="text" name="ecoben" id="ecoben-<?php echo $i; ?>" class="form-control"></td>
					</tr>
					<tr>
						<td>Unit</td>
						<td>EIP/year</td>
					</tr>
					<tr>
						<td>Marginal costs</td>
						<td><input type="text" name="marcos" id="marcos-<?php echo $i; ?>" class="form-control"></td>	
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

					function calculate(){

						//OPEX OLD calculation
						$("#opexold-<?php echo $i; ?>").val($("#oldcons-<?php echo $i; ?>").val()*$("#euunit-<?php echo $i; ?>").val());

						//OPEX NEW calculation
						$("#opexnew-<?php echo $i; ?>").val($("#newcons-<?php echo $i; ?>").val()*$("#euunit-<?php echo $i; ?>").val());



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

						//Ann. costs new option calculation
						//D3*(J3*(1+J3)^F3)/((1+J3)^F3-1)+E3
						//capexold*(Discount*(1+Discount)^Lifetimeold)/(((1+Discount)^Lifetimeold)-1)+opexold
						$("#acnew-<?php echo $i; ?>").val( 
							parseFloat($("#capexnew-<?php echo $i; ?>").val()*( 
								$("#disrate-<?php echo $i; ?>").val()/100 * 
									Math.pow(
										((1)+parseFloat($("#disrate-<?php echo $i; ?>").val()/100)),$("#ltnew-<?php echo $i; ?>").val()
									))/(parseFloat(
									Math.pow(
										((1)+parseFloat($("#disrate-<?php echo $i; ?>").val()/100)),$("#ltnew-<?php echo $i; ?>").val()
									)
								)-(1)))
							+ parseFloat($("#opexnew-<?php echo $i; ?>").val())
						);

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

					}


					$('#form-<?php echo $i; ?> input').change(calculate);
 				</script>
				<hr>
				<?php $i++; ?>
				</form>
				<script type="text/javascript">	$( document ).ready(calculate);</script>
			<?php endforeach ?>
		<?php endif ?>
</div>
<div class="col-md-6">

<table class="datatable" id="test">
		<thead>
			<tr>
				<th class="toprow">Process</th>
				<th class="toprow">Ecological Potential [EP]</th>
				<th class="toprow">[% EP]</th>
				<th class="toprow">Economic Potential [EUR]</th>
				<th class="toprow">[% EUR]</th>
			</tr>
		</thead>
		<tbody>
			 
			<tr>
				<th>Guestrooms</th>
				<td><nobr>201'608'339</nobr></td>
				<td><nobr>88</nobr></td>
				<td><nobr>120'000</nobr></td>
				<td><nobr>100</nobr></td>
			</tr>
			  
			<tr>
				<th>Central Heating</th>
				<td><nobr>27'169'506</nobr></td>
				<td><nobr>12</nobr></td>
				<td><nobr>0</nobr></td>
				<td><nobr>0</nobr></td>
			</tr>
			  
			<tr>
				<th>Water Provision</th>
				<td><nobr>101'068</nobr></td>
				<td><nobr>0</nobr></td>
				<td><nobr>47</nobr></td>
				<td><nobr>0</nobr></td>
			</tr>
			   
		</tbody>
	</table>

	<table border="1" id="measures" style="border-collapse: collapse;">
		<thead>
			<tr>
				<th>Number</th>
				<th>Option</th>
				<th>Investment</th>
				<th>Payback</th>
				<th>Type</th>
				<th>Saving</th>
				<th>Economic Benefit</th>
				<th>Ecological Benefit</th>
			</tr>
		</thead>
		
		<tbody>
			
				
					<tr>
						<td rowspan="3">1</td>
				
						<td rowspan="3">
							<b>Guestrooms, Water Consumption:</b> Flow limiter shower <br>
							<p>Using flow limiters in the shower will reduce the water usage.
This in turn brings a reduction of energy that would otherwise be necessary to heat the water.</p>
						</td>
						
						<td align="right" rowspan="3">
							
								-
							
						</td>
						
						<td align="right" rowspan="3">
							
								-
							
						</td>
				
						<td><b>SUM</b></td>
						<td><b>&nbsp;</b></td>
						<td align="right"><b><nobr>80'000</nobr> EUR</b></td>
						<td align="right"><b><nobr>147'241'435</nobr> EP</b></td>
					</tr>
			
					
						<tr>
							<td>Water</td>
							<td align="right">
								
									<nobr>8'000</nobr> m3
								
							</td>
							<td align="right">
								
									<nobr>80'000</nobr> EUR
								
							</td>
							<td align="right">
								
									<nobr>108'733'808</nobr> EP
								
							</td>
						</tr>
					
						<tr>
							<td>Energy</td>
							<td align="right">
								
									<nobr>244'493</nobr> kWh
								
							</td>
							<td align="right">
								
									-
								
							</td>
							<td align="right">
								
									<nobr>38'507'627</nobr> EP
								
							</td>
						</tr>
					
				
			
				
					<tr>
						<td rowspan="3">2</td>
				
						<td rowspan="3">
							<b>Guestrooms, Water Consumption:</b> Flow limiter tap <br>
							<p>Using flow limiters in the tap will reduce the water usage.
This in turn brings a reduction of energy that would otherwise be necessary to heat the water.</p>
						</td>
						
						<td align="right" rowspan="3">
							
								-
							
						</td>
						
						<td align="right" rowspan="3">
							
								-
							
						</td>
				
						<td><b>SUM</b></td>
						<td><b>&nbsp;</b></td>
						<td align="right"><b><nobr>40'000</nobr> EUR</b></td>
						<td align="right"><b><nobr>54'366'904</nobr> EP</b></td>
					</tr>
			
					
						<tr>
							<td>Water</td>
							<td align="right">
								
									<nobr>4'000</nobr> m3
								
							</td>
							<td align="right">
								
									<nobr>40'000</nobr> EUR
								
							</td>
							<td align="right">
								
									<nobr>54'366'904</nobr> EP
								
							</td>
						</tr>
					
						<tr>
							<td>Energy</td>
							<td align="right">
								
									-
								
							</td>
							<td align="right">
								
									-
								
							</td>
							<td align="right">
								
									-
								
							</td>
						</tr>
					
				
			
				
					<tr>
						<td rowspan="2">3</td>
				
						<td rowspan="2">
							<b>Central Heating, Boiler 1:</b> Soot layer <br>
							<p>Clean out the soot layer in your Diesel Boiler. This will help to achieve a cleaner incineration process,
saving energy.</p>
						</td>
						
						<td align="right" rowspan="2">
							
								-
							
						</td>
						
						<td align="right" rowspan="2">
							
								-
							
						</td>
				
						<td><b>SUM</b></td>
						<td><b>&nbsp;</b></td>
						<td align="right"><b><nobr>0</nobr> EUR</b></td>
						<td align="right"><b><nobr>13'584'753</nobr> EP</b></td>
					</tr>
			
					
						<tr>
							<td>Gas</td>
							<td align="right">
								
									<nobr>86'252</nobr> kWh
								
							</td>
							<td align="right">
								
									-
								
							</td>
							<td align="right">
								
									<nobr>13'584'753</nobr> EP
								
							</td>
						</tr>
					
				
			
				
					<tr>
						<td rowspan="2">4</td>
				
						<td rowspan="2">
							<b>Central Heating, Boiler 1:</b> Burner optimisation <br>
							<p>Optimising your boiler is always a good idea.</p>
						</td>
						
						<td align="right" rowspan="2">
							
								-
							
						</td>
						
						<td align="right" rowspan="2">
							
								-
							
						</td>
				
						<td><b>SUM</b></td>
						<td><b>&nbsp;</b></td>
						<td align="right"><b><nobr>0</nobr> EUR</b></td>
						<td align="right"><b><nobr>13'584'753</nobr> EP</b></td>
					</tr>
			
					
						<tr>
							<td>Gas</td>
							<td align="right">
								
									<nobr>86'252</nobr> kWh
								
							</td>
							<td align="right">
								
									-
								
							</td>
							<td align="right">
								
									<nobr>13'584'753</nobr> EP
								
							</td>
						</tr>
					
				
			
				
					<tr>
						<td rowspan="2">5</td>
				
						<td rowspan="2">
							<b>Water Provision, Hot Water Circulation:</b> Tank insulation <br>
							<p>Energy losses due to bad tank insulation.</p>
						</td>
						
						<td align="right" rowspan="2">
							
								-
							
						</td>
						
						<td align="right" rowspan="2">
							
								-
							
						</td>
				
						<td><b>SUM</b></td>
						<td><b>&nbsp;</b></td>
						<td align="right"><b><nobr>47</nobr> EUR</b></td>
						<td align="right"><b><nobr>101'068</nobr> EP</b></td>
					</tr>
			
					
						<tr>
							<td>Energy</td>
							<td align="right">
								
									<nobr>474</nobr> kWh
								
							</td>
							<td align="right">
								
									<nobr>47</nobr> EUR
								
							</td>
							<td align="right">
								
									<nobr>101'068</nobr> EP
								
							</td>
						</tr>
					
				
			
		</tbody>
	</table>
</div>
