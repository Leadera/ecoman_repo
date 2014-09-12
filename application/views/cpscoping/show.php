<div class="container">
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered">
			<tr>
			<th>Input Flows</th>
			<th>Unit</th>
			<th>Quantity</th>
			<?php $deneme_array = array(); $count = 0; ?>
			<?php foreach ($allocation as $a): ?>
			<?php
			$degisken = 1;
			$deneme_array[$count] = $a['prcss_name'];
			$count++;
			for ($i=0; $i < $count-1; $i++) { 
				if($deneme_array[$i] == $a['prcss_name']){
				$degisken = 0;
				break;
				}
			}
if($degisken == 1){

				echo "<th>".$a['prcss_name']."</th>";
			}
			?>
			<?php endforeach ?>
			</tr>
			<?php 
				$count = 0; $deneme_array = array();
				foreach ($allocation as $a):
					$degisken = 1; 
					$deneme_array[$count] = $a['flow_name'];
					$count++;
					for ($i=0; $i < $count-1; $i++) { 
					if($deneme_array[$i] == $a['flow_name'] && sizeof($deneme_array) > 1){
					$degisken = 0;
					break;
					}
					}
				if($degisken == 1): 	

						if ($a['flow_type_name'] == "Input"): ?>
			<tr>
				<td rowspan="3"><?php echo $a['flow_name']; ?></td>
				<td>Amount (<?php echo $a['unit_amount']; ?>)</td>
				<td><?php echo $a['amount']; ?></td> 
					<?php 
						$temp = "";
							$temp = $a['flow_name'];
							for($i = 0 ; $i < count($allocation); $i++){ 
								$tempp = $allocation[$i]['prcss_name'];
								$sayi = 0;
								$prc_array = array(); $prccount = 0;

								for($j = 0 ; $j < count($allocation); $j++){
									$flow_name_temp = $allocation[$j]['flow_name'];
									$prcss_name_temp = $allocation[$j]['prcss_name'];



										$tuna = 1;
										$prc_array[$prccount] = $prcss_name_temp;
										//print_r($prc_array);
										$prccount++;
										for ($ip=0; $ip < $prccount-1; $ip++) { 
											if($prc_array[$ip] == $prcss_name_temp){
											$tuna = 0;
											break;
											}
										}
										if($tuna == 1){


									if($temp == $flow_name_temp && $tempp == $prcss_name_temp){		

										$sayi++;
										echo "<td rowspan='3'>
											".$sayi." / ".$allocation[$j]['prcss_name']." - ".$prcss_name_temp."
											<table style='width:100%; font-size:13px;'>
												<tr>
													<td>".$allocation[$j]['amount']."</td><td rowspan='3'>test</td>
												</tr>
												<tr>
													<td>".$allocation[$j]['cost']."</td>
												</tr>
												<tr>
													<td>".$allocation[$j]['env_impact']."</td>
												</tr>
											</table>
										</td>";
									}
									}
								}

									if($sayi == 0){
										echo "<td rowspan='3'>".$sayi."/".count($allocation)."</td>";
									}
							}
					
					?>
				</tr>
				<tr>
					<td>Cost (<?php echo $a['unit_cost']; ?>)</td>
					<td><?php echo $a['cost']; ?></td>
				</tr>
				<tr>
					<td>Ep (UBP)</td>
					<td><?php echo $a['env_impact']; ?></td>
				</tr>
						<?php endif ?>

				<?php endif ?>
				<?php endforeach ?>
			</table>
		</div>
	</div>
</div>