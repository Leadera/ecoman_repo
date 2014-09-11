<div class="container">
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered">
				<tr>
					<th>Input Flows</th>
					<th>Unit</th>
					<th>Quantity</th>
					<?php $allocation = array_unique($allocation); ?>
					<?php foreach ($allocation as $a): ?>
						<th><?php echo $a['prcss_name']; ?></th>
					<?php endforeach ?>
				</tr>
					<?php foreach ($allocation as $a): ?>
						<tr >
							<td rowspan="3"><?php echo $a['flow_name']; ?></td>
							<td>Amount (<?php echo $a['unit_amount']; ?>)</td>
							<td><?php echo $a['amount']; ?></td> 
								<?php 
									$degisken = "";
									for($i = 0 ; $i < sizeof($allocation) ; $i++){
										$degisken = $allocation[$i]['flow_name'];
										for($j = 0 ; $j < sizeof($allocation) ; $j++){
											$count = 0;
											echo "<br>";
											echo $allocation[$j]['flow_name'];
											if($degisken == $allocation[$j]['flow_name'] and $degisken== $a['flow_name']){
													$count++;
										echo "<td rowspan='3'>
														".$count."
														<table style='width:100%; font-size:13px;'>
															<tr>
																<td>".$a['amount']."</td><td rowspan='3'>test</td>
															</tr>
															<tr>
																<td>".$a['cost']."</td>
															</tr>
															<tr>
																<td>".$a['env_impact']."</td>
															</tr>
														</table>
													</td>";

											}
										}
										echo "<br>";
										echo $count;
										if($count == 0){
											$count = sizeof($allocation) - $count;
											for($j = 0 ; $j < $count ; $j++);
												echo "<td rowspan='3'></td>";
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
					<?php endforeach ?>
			</table>
		</div>
	</div>
</div>