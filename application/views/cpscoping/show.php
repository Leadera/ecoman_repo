<script type="text/javascript">
	function yazdir(f,p,k) {
	    $.ajax({
	      type: "POST",
	      dataType:'json',
		  url: '<?php echo base_url('cpscoping/get_allo'); ?>/'+f+'/'+p+'/'+<?php echo $this->uri->segment(3); ?> + '/' + k + '/' + <?php echo $this->uri->segment(2); ?>,
	      success: function(data)
	      {
	      	if(!$.isEmptyObject(data)){
	      		//console.log(data);
	        	var vPool="";
	        	if(data.allocation_amount!="none"){
					vPool += '<table style="width:100%; min-width:150px; font-size:13px; text-align:center;" frame="void"><tr><td>' + data.amount + ' ' + data.unit_amount + '</td><td rowspan="3" style="width:70px;">%'+data.allocation_rate+'</td></tr><tr><td>' + data.cost + ' ' + data.unit_cost + '</td></tr><tr><td>' + data.env_impact + ' ' + data.unit_env_impact + '</td></tr></table>';
				}
				else {
					vPool += '<table style="width:100%; min-width:150px; font-size:13px; text-align:center;" frame="void"><tr><td>' + data.amount + ' ' + data.unit_amount + '</td></tr><tr><td>' + data.cost + ' ' + data.unit_cost + '</td></tr><tr><td>' + data.env_impact + ' ' + data.unit_env_impact + '</td></tr></table>';
				}
				$("div."+f+p+k).html(vPool);
	      	}
	      	else{
	      		$("div."+f+p+k).html(" ");
	      	}      	
	      }
	    });
	};

	function cost_ep_value(prcss_id){
		//alert(prcss_id);
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: '<?php echo base_url('cpscoping/cost_ep'); ?>/'+prcss_id+'/'+<?php echo $this->uri->segment(2);?>+'/'+<?php echo $this->uri->segment(3); ?>,
			success: function(data){
				//console.log(data);
				var temp = "";
				temp += '<table style="width:100%; min-width:150px; font-size:13px; text-align:center;" frame="void"><tr><th style="text-align:center;">' + data.prcss_name + '</th></tr><tr><td> Upper EP Value: ' + data.ep_value_ust + ' EP</td></tr><tr><td> Lower EP Value: ' + data.ep_value_alt + ' EP</td></tr><tr><td> Upper Cost Value: ' + data.cost_value_ust + ' Euro</td></tr><tr><td> Lower Cost Value: ' + data.cost_value_alt + ' Euro</td></tr></table>';
				$("div."+prcss_id).html(temp);
			}
		});
	};
</script>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered">
			<tr>
			<th>Input Flows</th>
			<th>Total</th>
			<?php $deneme_arrayi = array(); $tekrarsiz = array(); $tekrarsiz[-1] = "0"; $count = 0; $process_adet=0; ?>
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
					if($degisken == 1): ?>
					<tr>
						<td><b><?php echo $a['flow_name']; ?></b></td>
						<?php for ($t=0; $t < $process_adet+1; $t++): ?>
							<script type="text/javascript">
								yazdir(<?php echo $a['flow_id']; ?>,<?php echo $tekrarsiz[$t-1]; ?>,1);
							</script>
							<td style="padding:0px !important;">
								<div class="<?php echo $a['flow_id'].''.$tekrarsiz[$t-1]; ?>1">
									
								</div>
							</td>
						<?php endfor ?>
					</tr>

				<?php endif ?>
				<?php endforeach ?>
			</table>

			<!-- Output Table -->
			<table class="table table-bordered">
			<tr>
			<th>Output Flows</th>
			<th>Total</th>
			<?php $deneme_arrayi = array(); $tekrarsiz = array(); $tekrarsiz[-1] = "0"; $count = 0; $process_adet=0; ?>
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
					if($degisken == 1): ?>
					<tr>
						<td><b><?php echo $a['flow_name']; ?></b></td>
						<?php for ($t=0; $t < $process_adet+1; $t++): ?>
							<script type="text/javascript">
								yazdir(<?php echo $a['flow_id']; ?>,<?php echo $tekrarsiz[$t-1]; ?>,2);
							</script>
							<td style="padding:0px !important;">
								<div class="<?php echo $a['flow_id'].''.$tekrarsiz[$t-1]; ?>2">
									
								</div>
							</td>
						<?php endfor ?>
					</tr>

				<?php endif ?>
				<?php endforeach ?>
			</table>

			<table class="table table-bordered">
				<tr>
					<?php for($i = 0 ; $i < $process_adet ; $i++): ?>
						<script type="text/javascript">
							cost_ep_value(<?php echo $tekrarsiz[$i]; ?>);
						</script>
						<td style="padding:0px !important;">
							<div class="<?php echo $tekrarsiz[$i]; ?>">
								
							</div>
						</td>
					<?php endfor ?>
				</tr>
			</table>

		</div>
	</div>
</div>