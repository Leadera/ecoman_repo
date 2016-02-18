



<script src="http://d3js.org/d3.v3.min.js"></script>
<div class="col-md-12">
	<div class="lead"><?php echo $company['name']; ?></div>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-yw4l{vertical-align:top}
</style>
<?php  $allocation = array_merge($allocation, $is);  //print_r($allocation); ?>
	<p><?php echo lang("cbaheading"); ?></p>
	<?php if (!empty($allocation)): ?>
			<?php $i=1; ?>
			<?php foreach ($allocation as $a): ?>
				<?php if(!empty($a['cp_id'])){$iid=$a['cp_id']; $tip="cp";}else{$iid=$a['is_id'];$tip="is";} ?>
 				<?php $attributes = array('id' => 'form-'.$i); ?>
				<?php echo form_open('cba/save/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/'.$iid.'/'.$tip, $attributes); ?>
<table class="tg costtable">
  <tr>
    <th class="tg-yw4l">Option</th>
    <th class="tg-yw4l">Yearly CAPEX / rest value (€/yr)</th>
    <th class="tg-yw4l" colspan="2">Annual energy and material flows</th>
    <th class="tg-yw4l">unit</th>
    <th class="tg-yw4l">Specific costs (€/unit)</th>
    <th class="tg-yw4l">OPEX (€)</th>
    <th class="tg-yw4l">EIP/ Unit</th>
    <th class="tg-yw4l">EIP</th>
    <th class="tg-yw4l">Annual costs (€/yr)</th>
    <th class="tg-yw4l">Lifetime (yr)</th>
    <th class="tg-yw4l">Investment (€)</th>
    <th class="tg-yw4l">Discount rate (%) not for the existing process</th>
    <th class="tg-yw4l">Yearly CAPEX  (€/yr)</th>
    <th class="tg-yw4l" colspan="2">Annual energy and material flows</th>
    <th class="tg-yw4l">unit</th>
    <th class="tg-yw4l">Specific costs (€/unit)</th>
    <th class="tg-yw4l">OPEX (€)</th>
    <th class="tg-yw4l">EIP/ Unit</th>
    <th class="tg-yw4l">EIP</th>
    <th class="tg-yw4l">Annual costs (€/yr)</th>
    <th class="tg-yw4l">Type</th>
    <th class="tg-yw4l">Differences of energy and material flows</th>
    <th class="tg-yw4l">Unit</th>
    <th class="tg-yw4l">Reduction OPEX (€)</th>
    <th class="tg-yw4l">Economic Benefit (€)</th>
    <th class="tg-yw4l">Ecological  Benefit (EIP)</th>
    <th class="tg-yw4l">Marginal costs (€/EIP)</th>
    <th class="tg-yw4l">Pay pack time  of Investment (yrs)</th>
  </tr>
  <tr>
    <td class="tg-yw4l" rowspan="7">							
    <span class="text-info">
		<?php if(empty($a['cmpny_from_name'])) {echo $a['best'];} else {echo $a['flow_name']." input IS potential from ".$a['cmpny_from_name']; } ?>
	</span>
	</td>
    <td class="tg-yw4l" rowspan="7">
    	<div class=" has-warning"><input type="text" name="capexold" id="capexold-<?php echo $i; ?>" class="form-control has-warning" value="<?php echo $a['capexold']; ?>" placeholder="You should fill this field."></div>
    </td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l" rowspan="7"></td>
    <td class="tg-yw4l" rowspan="7">
    	<div class=" has-warning"><input type="text" name="ltold" id="ltold-<?php echo $i; ?>" value="<?php echo $a['ltold']; ?>" class="form-control" placeholder="You should fill this field."></div>
    </td>
    <td class="tg-yw4l" rowspan="7"></td>
    <td class="tg-yw4l" rowspan="7">
    	<div class=" has-warning"><input type="text" name="disrate" id="disrate-<?php echo $i; ?>"  value="<?php echo $a['disrate']; ?>" class="form-control" placeholder="You should fill this field."></div>
    </td>
    <td class="tg-yw4l" rowspan="7">
    	<div class=" has-warning"><input type="text" name="capexnew" id="capexnew-<?php echo $i; ?>" value="<?php echo $a['capexnew']; ?>" class="form-control" placeholder="You should fill this field.">
    </td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l" rowspan="7"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l" rowspan="7"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l" rowspan="7"></td>
    <td class="tg-yw4l" rowspan="7"></td>
  </tr>
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
  </tr>
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
  </tr>
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
  </tr>
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
  </tr>
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
  </tr>
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
  </tr>
</table>
<hr>

<?php $i++; ?>
				</form>
				<script type="text/javascript">	$( document ).ready(calculate);</script>
			<?php endforeach ?>
		<?php endif ?>
</div>



<div class="col-md-6">
<?php  $allocation = array_merge($allocation, $is);  //print_r($allocation); ?>
	<p><?php echo lang("cbaheading"); ?></p>
	<?php if (!empty($allocation)): ?>
			<?php $i=1; ?>
			<?php foreach ($allocation as $a): ?>
				<?php if(!empty($a['cp_id'])){$iid=$a['cp_id']; $tip="cp";}else{$iid=$a['is_id'];$tip="is";} ?>
 				<?php $attributes = array('id' => 'form-'.$i); ?>
				<?php echo form_open('cba/save/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/'.$iid.'/'.$tip, $attributes); ?>
				<table class="costtable">
					<tr>
						<td>#</td><td><?php echo $i; ?></td>
					</tr>
					<tr>
						<td width="250"><?php echo lang("option"); ?></td>
						<td width="75%">
						<?php //print_r($a); ?>
							<b><?php if(!empty($a['prcss_name'])) {echo $a['prcss_name'];} else {echo "IS potential"; } ?></b> 
							<small class="text-muted"><?php echo $a['flow_name']; ?><?php if(!empty($a['prcss_name'])) {echo "-".$a['flow_type_name']; } ?></small><br>
							<span class="text-info">
								<?php if(empty($a['cmpny_from_name'])) {echo $a['best'];} else {echo $a['flow_name']." input IS potential from ".$a['cmpny_from_name']; } ?>
							</span>
						</td>
					</tr>
					<tr>
						<td><?php echo lang("discountrate"); ?> (%)</td>
						<td><div class=" has-warning"><input type="text" name="disrate" id="disrate-<?php echo $i; ?>"  value="<?php echo $a['disrate']; ?>" class="form-control" placeholder="You should fill this field."></div></td>
					</tr>
						<tr><td><?php echo lang("capexold"); ?> (€/<?php echo lang("year"); ?>)</td>								
						<td><div class=" has-warning"><input type="text" name="capexold" id="capexold-<?php echo $i; ?>" class="form-control has-warning" value="<?php echo $a['capexold']; ?>" placeholder="You should fill this field."></div></td>
					</tr>
					<tr>
						<td><?php echo lang("opexold"); ?> (€/<?php echo lang("year"); ?>)</td>
						<td><input type="text" name="opexold" id="opexold-<?php echo $i; ?>" class="form-control"></td>
					</tr>
					<tr>
						<td><?php echo lang("lifetimeold"); ?> (<?php echo lang("year"); ?>)</td>
						<td><div class=" has-warning"><input type="text" name="ltold" id="ltold-<?php echo $i; ?>" value="<?php echo $a['ltold']; ?>" class="form-control" placeholder="You should fill this field."></div></td>
					</tr>
					<tr>
						<td><?php echo lang("capexnew"); ?> (€/<?php echo lang("year"); ?>)</td>
						<td><div class=" has-warning"><input type="text" name="capexnew" id="capexnew-<?php echo $i; ?>" value="<?php echo $a['capexnew']; ?>" class="form-control" placeholder="You should fill this field."></div></td>
					</tr>
					<tr>
						<td><?php echo lang("opexnew"); ?> (€/<?php echo lang("year"); ?>)</td>
						<td><input type="text" name="opexnew" id="opexnew-<?php echo $i; ?>" class="form-control"></td>
					</tr>
					<tr>
						<td><?php echo lang("lifetimenew"); ?> (<?php echo lang("year"); ?>)</td>
						<td><div class=" has-warning"><input type="text" name="ltnew" id="ltnew-<?php echo $i; ?>" value="<?php echo $a['ltnew']; ?>" class="form-control" placeholder="You should fill this field."></div></td>
					</tr>
					<tr>
						<td><?php echo lang("anncostold"); ?></td>
						<td><input type="text" name="acold" id="acold-<?php echo $i; ?>" class="form-control"></td>
					</tr>
					<tr>
						<td><?php echo lang("anncostnew"); ?></td>
						<td><input type="text" name="acnew" id="acnew-<?php echo $i; ?>" class="form-control"></td>
					</tr>
					<tr>
						<td><?php echo lang("economiccostbenefit"); ?></td>
						<td><input type="text" name="eco" id="eco-<?php echo $i; ?>" class="form-control"></td>
					</tr>
					<tr>
						<td><?php echo lang("unit"); ?></td>
						<td>Euro/<?php echo lang("year"); ?></td>
					</tr>
					<tr>
						<td><?php echo lang("oldcons"); ?></td><td><input type="text" name="oldcons" id="oldcons-<?php echo $i; ?>" class="form-control" value="<?php echo $a['qntty']; ?>"></td>
					</tr>
					<tr>
						<td><?php echo lang("oldcost"); ?></td><td><input type="text" name="oldcost" id="oldcost-<?php echo $i; ?>" class="form-control" value="<?php echo $a['cost']; ?>"></td>
					</tr>
					<tr>
						<td><?php echo lang("oldep"); ?></td><td><input type="text" name="oldep" id="oldep-<?php echo $i; ?>" class="form-control" value="<?php echo $a['ep']; ?>"></td>
					</tr>
					<tr>
						<td><?php echo lang("newcons"); ?></td>
						<td><div class=" has-warning"><input type="text" name="newcons" id="newcons-<?php echo $i; ?>" value="<?php echo $a['newcons']; ?>" class="form-control" placeholder="You should fill this field."></div></td>
					</tr>
					<tr>
						<td><?php echo lang("unit"); ?></td>
						<td><input type="hidden" name="unit2" value="<?php echo $a['qntty_unit']; ?>/<?php echo lang('year'); ?>" > <?php echo $a['qntty_unit']; ?>/<?php echo lang("year"); ?></td>
					</tr>
					<tr>
						<td>€/ <?php echo lang("unit"); ?></td>
						<td><input type="text" name="euunit" id="euunit-<?php echo $i; ?>" class="form-control" value="<?php echo ($a['cost']/$a['qntty']); ?>" ></td>
					</tr>
					<tr>
						<td>EIP/ <?php echo lang("unit"); ?></td>
						<td><input type="text" name="eipunit" id="eipunit-<?php echo $i; ?>" class="form-control" value="<?php echo ($a['ep']/$a['qntty']); ?>" ></td>
					</tr>
					<tr>
						<td><?php echo lang("ecologicalbenefit"); ?></td>
						<td><input type="text" name="ecoben" id="ecoben-<?php echo $i; ?>" class="form-control"></td>
					</tr>
					<tr>
						<td><?php echo lang("unit"); ?></td>
						<td>EIP/<?php echo lang("year"); ?></td>
					</tr>
					<tr>
						<td><?php echo lang("marginalcost"); ?></td>
						<td><input type="text" name="marcos" id="marcos-<?php echo $i; ?>" class="form-control"></td>	
					</tr>
					<tr>
						<td><?php echo lang("unit"); ?></td><td>$/EIP</td>
					</tr>
				</table>
				<input type="submit" value="<?php echo lang("save"); ?>" class="btn btn-block btn-info" style="margin-top:20px;"/>
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
							$("#marcos-<?php echo $i; ?>").val(toFixed($("#marcos-<?php echo $i; ?>").val(),2));
						}
						else{
							$("#marcos-<?php echo $i; ?>").val(-$("#eco-<?php echo $i; ?>").val()/$("#ecoben-<?php echo $i; ?>").val()*100);
							$("#marcos-<?php echo $i; ?>").val(toFixed($("#marcos-<?php echo $i; ?>").val(),2));
						}

					}

					function toFixed ( number, precision ) {
					    var multiplier = Math.pow( 10, precision + 1 ),
					        wholeNumber = Math.floor( number * multiplier );
					    return Math.round( wholeNumber / 10 ) * 10 / multiplier;
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
<div class="col-md-6" id="sag4">
	<p><?php echo lang("cbaheading2"); ?></p>
	<?php //print_r($allocation); ?>
		<?php if (!empty($allocation)): ?>
			<table class="table" style="font-size:12px;">
				<tr>
					<th><?php echo lang("optionandprocess"); ?></th><th><?php echo lang("marginalcost"); ?></th><th><?php echo lang("ecologicalbenefit"); ?></th>
				</tr>
			<?php foreach ($allocation as $a): ?>
				<tr>
					<td>
					<?php 
					if(empty($a['cmpny_from_name'])) {
						echo "<div style='font-size:13px; margin-bottom:5px;' class='label label-default'>".$a['prcss_name']." - ".$a['flow_name']." - ".$a['flow_type_name']."</div>";
						echo "<div><br>".$a['best']."</div>";
					}
					else {
						echo $a['flow_name']." input IS potential from ".$a['cmpny_from_name']; 
					} ?>
					</td>
					<td><?php echo $a['marcos']; ?></td>
					<td><?php echo $a['ecoben']; ?></td></tr>
			<?php endforeach ?>
			</table>
		<?php endif ?>
			<p><?php echo lang("cbaheading3"); ?></p>
	<div id="rect-demo-ana" style="border:2px solid #f0f0f0;">
    <div id="rect-demo"></div>
  </div>
</div>
<?php
	//array defining
	$t=0;
	$toplameco=0;
	foreach ($allocation as $a) {
		if(empty($a['cmpny_from_name'])) { $tuna_array[$t]['name']=$a['best']."-".$a['prcss_name'];} else {$tuna_array[$t]['name']=$a['flow_name']." input IS potential from ".$a['cmpny_from_name']; }
		
		$tuna_array[$t]['color']='#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
		if($a['marcos']>0){
			$tuna_array[$t]['ymax']= $a['marcos'];
		}
		else{
			$tuna_array[$t]['ymax']= 0;
		}

		$toplameco+=$a['ecoben'];
		$tuna_array[$t]['xmax']= intval($a['ecoben']);

		$eksieco = $toplameco - $a['ecoben'];
		$tuna_array[$t]['xmin']= $eksieco;

		if($a['marcos']>0){
			$tuna_array[$t]['ymin']= "0";
		}
		else{
			$tuna_array[$t]['ymin']= $a['marcos'];
		}
		$t++;
	}
	//print_r($tuna_array);
	//echo json_encode($tuna_array);
?>
<script type="text/javascript">
	setTimeout(function()
	{
		tuna_graph();
	}, 1000);

	function tuna_graph(){
	//console.log(list);
	//Tuna Graph
	var data = <?php echo json_encode($tuna_array); ?>;
	//console.log(data);
	var margin = {
	            "top": 10,
	            "right": 30,
	            "bottom": 350,
	            "left": 50
	        };
	var width = $('#sag4').width()-80;
	var height = 500;
	// Set the scales
  var x = d3.scale.linear()
          .domain([0, d3.max(data, function(d) { return d.xmin+d.xmax; })])
      		.range([0,width]).nice();

  var y = d3.scale.linear()
      		.domain([d3.min(data, function(d) { return d.ymin-0.1; }), d3.max(data, function(d) { return d.ymax; })])
      		.range([height, 0]).nice();

  var xAxis = d3.svg.axis().scale(x).orient("bottom");
  var yAxis = d3.svg.axis().scale(y).orient("left");

	// Create the SVG 'canvas'
  var svg = d3.select("#rect-demo-ana").append("svg")
          .attr("class", "chart")
          .attr("mousewheel.zoom", null)
          .attr("width", width + margin.left + margin.right)
          .attr("height", height + margin.top + margin.bottom).append("g")
          .attr("transform", "translate(" + margin.left + "," + margin.right + ")");

  svg.append("g")
    .attr("class", "x axis")
    .attr("transform", "translate(0,"+ y(0) +")")
    .call(xAxis);

  svg.append("g")
    .attr("class", "y axis")
    .call(yAxis);

  //x axis label
	svg.append("text")
		.attr("transform", "translate(" + (width / 2) + " ," + (height + margin.bottom - 305) + ")")
		.style("text-anchor", "middle")
		.text("<?php echo lang('ecologicalbenefit'); ?>");

	//y axis label
	svg.append("text")
		.attr("transform", "rotate(-90)")
		.attr("y", 0 - margin.left)
		.attr("x", 0 - (height / 2))
		.attr("dy", "1em")
		.style("text-anchor", "middle")
		.text("<?php echo lang('marginalcost'); ?>");

	svg.selectAll("rect").
		data(data).
		enter().
		append("svg:rect").
		attr("x", function(datum,index) { return x(datum.xmin); }).
		attr("y", function(datum,index) { return y(datum.ymax); }).
		attr("height", function(datum,index) { return y(datum.ymin)-y(datum.ymax)+(height*0.0001); }).
		attr("width", function(datum, index) { return x(datum.xmax)+(width*0.0001); })
		.attr("fill", function(d, i) { return d.color; })
		.style("opacity", '0.5')
		.on("mouseover", function(datum,index){return tooltip.style("visibility", "visible").html(datum.name);})
		.on("mousemove", function(datum,index){return tooltip.style("top", (d3.event.pageY-10)+"px").style("left",(d3.event.pageX+10)+"px").html(datum.name);})
		.on("mouseout", function(){return tooltip.style("visibility", "hidden");});

		var tooltip = d3.select("body")
		.append("div")
		.style("position", "absolute")
		.style("z-index", "10")
		.style("visibility", "hidden")
		.style("background-color", "white")
		.style("padding", "10px")
		.style("border", "1px solid #d0d0d0")
		.style("border-radius", "2px")
		.style("font-size", "12px")
		.style("max-width", "200px")
		.style("color", "#444");

		// add legend   
		var legend = svg.append("g")
	  .attr("class", "legend")
        //.attr("x", w - 65)
        //.attr("y", 50)
	  .attr("height", 100)
	  .attr("width", 100)
    .attr('transform', 'translate(-20,50)')    
      
    legend.selectAll('rect')
      .data(data)
      .enter()
      .append("circle")
      .attr("r", 7)
      .attr("cx", 1)
      .attr("cy", function(d, i){ return 555 + (i *  19);})
		  .style("fill", function(datum,index) { return datum.color; })
		 	.style("opacity", '0.5')
      
    legend.selectAll('text')
      .data(data)
      .enter()
      .append("text")
		.style("font-size", "12px")
	  .attr("x", 16)
    .attr("y", function(d, i){ return i *  19 + 559;})
	  .text(function(datum,index) { return datum.name; });

	  svg.call(
	  	d3.behavior.zoom()
	  	.x(x).y(y).on("zoom", zoom)
	  	);
 
		function zoom() {
		  svg.select(".x.axis").call(xAxis);
		  svg.select(".y.axis").call(yAxis);
		  svg.selectAll('rect').attr("transform", "translate(" + d3.event.translate + ")scale(" + d3.event.scale + ")");
		}
	}
</script>