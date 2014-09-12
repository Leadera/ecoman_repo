<div class="container">
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered">
			<tr>
			<th>Input Flows</th>
			<th>Total</th>
			<?php $deneme_arrayi = array(); $tekrarsiz = array(); $tekrarsiz[-1] = "Total"; $count = 0; $process_adet=0; ?>
			<?php foreach ($allocation as $a): ?>
			<?php
			$degisken = 1;
			$deneme_arrayi[$count] = $a['prcss_name'];
			$count++;
			for ($i=0; $i < $count-1; $i++) { 
				if($deneme_arrayi[$i] == $a['prcss_name']){
				$degisken = 0;
				break;
				}
			}
			if($degisken == 1){
				$process_adet++;
				echo "<th>".$a['prcss_name']."</th>";
				$tekrarsiz[$process_adet-1] = $a['prcss_id']; 
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
						<td><?php echo $a['flow_name']; ?></td>	
						<?php for ($t=0; $t < $process_adet+1; $t++): ?>
							<?php if($t!=0): ?>
						<script type="text/javascript">
							$(document).ready(function() {
							        $.ajax({ 
							            type: "POST",
							            dataType:'json',
							            url: '<?php echo base_url('cpscoping/get_allo');?>/'+<?php echo $a['flow_id']; ?>+'/'+<?php echo $tekrarsiz[$t-1]; ?>, 
							            success: function(data)
							            {
							            	console.log(data);							            
							            }
							        });
							});
						</script>
					<?php endif ?>
							<td>          ".$t."     ".$tekrarsiz[$t-1]." / ".."

											<table style='width:100%; font-size:13px;'>
												<tr>
													<td>".$alloinfo['amount']."</td><td rowspan='3'>test</td>
												</tr>
												<tr>
													<td>".$alloinfo['cost']."</td>
												</tr>
												<tr>
													<td>".$alloinfo['env_impact']."</td>
												</tr>
											</table>

							</td>
						<?php endfor ?>
					</tr>

				<?php endif ?>
				<?php endif ?>
				<?php endforeach ?>
			</table>
		</div>
	</div>
</div>