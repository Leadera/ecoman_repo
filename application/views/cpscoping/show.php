<script type="text/javascript" src="https://www.google.com/jsapi"></script>

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

	google.load("visualization", "1", {packages:["corechart"]});
	var temp_array = new Array();
	var temp_index = 0;
	var ep_alt_temp_array = new Array();
	var ep_alt_temp_index = 0;
	var ep_ust_temp_array = new Array();
	var ep_ust_temp_index = 0;
	var cost_array = new Array();
	var cost_array_clone = new Array();
	var cost_index = 0;
	var index_array = new Array();

	function cost_ep_value(prcss_id,process_adet){
		//alert(prcss_id);
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: '<?php echo base_url('cpscoping/cost_ep'); ?>/'+prcss_id+'/'+<?php echo $this->uri->segment(2);?>+'/'+<?php echo $this->uri->segment(3); ?>,
			success: function(data){
				//console.log(data);
				var temp = "";
				temp += '<table style="width:100%; min-width:150px; font-size:13px; text-align:center;" frame="void"><tr><th style="text-align:center;">' + data.prcss_name + '</th></tr><tr><td> <b>EP:</b> ' + data.ep_value_alt + ' - ' + data.ep_value_ust + '</td></tr><tr><td> <b>Cost:</b> ' + data.cost_value_alt.toFixed(2) + ' - ' + data.cost_value_ust.toFixed(2) + ' Euro</td></tr></table>';
				$("div."+prcss_id).html(temp);


				temp_array[temp_index] = data.prcss_name;
				temp_index++;
				ep_alt_temp_array[ep_alt_temp_index] = data.ep_value_alt;
				ep_alt_temp_index++;
				ep_ust_temp_array[ep_ust_temp_index] = data.ep_value_ust;
				ep_ust_temp_index++;

				cost_array[cost_index] = data.cost_value_alt;
				cost_array_clone[cost_index] = data.cost_value_alt;
				cost_index++;

				if(process_adet == temp_index){
	          		
	          		for(var i = 0 ; i < cost_index; i++){
	          			for(var j = i+1 ; j < cost_index ; j++){
	          				if(cost_array[i] > cost_array[j]){
	          					var temp = cost_array[j];
	          					cost_array[j] = cost_array[i];
	          					cost_array[i] = temp;
	          				}
	          			}
	          		}

	          		for(var i = 0 ; i < cost_index ; i++){
	          			for(var j = 0 ; j < cost_index ; j++){
	          				if(cost_array_clone[j] == cost_array[i]){
	          					index_array[i] = j;
	          				}
	          			}
	          		}

		          	var newData = new Array(temp_index+1);
		          	for(var i = 0 ; i < temp_index+1 ; i++){
		          		newData[i] = new Array(5);
		          	}

		          	console.log(newData);

		          	newData[0][0] = '';
		          	newData[0][1] = 0;
		          	newData[0][2] = 0;
		          	newData[0][3] = 0;
		          	newData[0][4] = 0;

		          	for(var i = 0 ; i < temp_index ; i++){
		          		newData[i+1][0] = temp_array[index_array[i]];
		          		newData[i+1][1] = ep_alt_temp_array[index_array[i]];
		          		newData[i+1][2] = ep_alt_temp_array[index_array[i]];
		          		newData[i+1][3] = ep_ust_temp_array[index_array[i]];
		          		newData[i+1][4] = ep_ust_temp_array[index_array[i]];
		          	}

		          	var data = google.visualization.arrayToDataTable(newData, true);
				    var options = {
				      legend:'none'
				    };
				    var chart = new google.visualization.CandlestickChart(document.getElementById('chart_div'));
				    chart.draw(data, options);
	          	}
			}
		});
	};

	function is_candidate(id){
		var buton_durum = 0;
		$(document).ready(function () {
			$.ajax({
		     	type: "POST",
		     	dataType:'json',
			  	url: '<?php echo base_url('cpscoping/is_candidate_control'); ?>/'+id,
		      	success: function(data)
		      	{
		      		if(!(data.control == 1)){
		      			$("#"+id).removeClass();
		    			$("#"+id).addClass("btn btn-success btn-xs");
		    			$("#"+id).html("Selected");
		    			buton_durum = 1;
		    		}else{
		    			$("#"+id).removeClass();
		    			$("#"+id).addClass("btn btn-default btn-xs");
		    			$("#"+id).html("Dropped");
		    			buton_durum = 0;
		    		}
		    		$.ajax({
				     	type: "POST",
				     	dataType:'json',
					  	url: '<?php echo base_url('cpscoping/is_candidate_insert'); ?>/'+id+'/'+buton_durum,
				    });
		      	}
		    });
	  	});
	};

	function open_document(id){
		alert(id);
	};
</script>
		<div class="col-md-12" style="margin-bottom: 10px;">
			<a class="btn btn-default btn-sm" href="<?php echo base_url('kpi_calculation/'.$this->uri->segment(2).'/'.$this->uri->segment(3)); ?>">Show KPI Calculation Data</a>
		</div>
		<div class="col-md-4">
			<p>Cost and Environmental impact graph of processes</p>
			<div id="chart_div" style="width: 100%; height: 400px; border:2px solid #f0f0f0;"></div>
			
		</div>
		<div class="col-md-8">
			<p>CP Potentials Identifications</p>
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
				$count = 0; $deneme_array = array(); $flow_type_array = array();
				foreach ($allocation as $a):
					$degisken = 1;
					$deneme_array[$count] = $a['flow_name'];
					$flow_type_array[$count] = $a['flow_type_id'];
					$count++;
					for ($i=0; $i < $count-1; $i++) {
						if($deneme_array[$i] == $a['flow_name'] && sizeof($deneme_array) > 1 && $flow_type_array[$i] == $a['flow_type_id']){
							$degisken = 0;
							break;
						}
					}
					
					if($degisken == 1 && $a['flow_type_id'] == 1): ?>
					<tr>
						<td>
							<b><?php echo $a['flow_name']; ?></b>
							<br>
							<?php if ($active[$a['allocation_id']] == 0): ?>
								<button class="btn btn-default btn-xs" id="<?php echo $a['allocation_id']; ?>" onclick="is_candidate(<?php echo $a['allocation_id'];?>)">
									Select as IS candidate
								</button>
							<?php else: ?>
								<button class="btn btn-success btn-xs" id="<?php echo $a['allocation_id']; ?>" onclick="is_candidate(<?php echo $a['allocation_id'];?>)">IS candidate
								</button>
							<?php endif ?>
							
						</td>
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
					if($degisken == 1){
						$id = 0;
						foreach ($allocation_output as $a_output) {
							if($a_output['flow_name'] == $a['flow_name']){
								$id = $a_output['allocation_id'];
							}
						}
						if($id == 0){
							continue;
						}

							?>
					<tr>
						<td>
							<b><?php echo $a['flow_name']; ?></b>
							<br>
							<?php
							if($id != 0){
							if ($active[$id] == 0): ?>
								<button class="btn btn-default btn-xs" id="<?php echo $id; ?>" onclick="is_candidate(<?php echo $id;?>)">Select as IS candidate
								</button>
							<?php else: ?>
								<button class="btn btn-success btn-xs" id="<?php echo $id; ?>" onclick="is_candidate(<?php echo $id;?>)">IS Candidate
								</button>
							<?php endif ?>

							<?php } ?>

						</td>
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

				<?php } ?>
				<?php endforeach ?>
			</table>
			<p>Cost and Environmental impact data of processes</p>
			<table class="table table-bordered">
				<tr>
					<?php for($i = 0 ; $i < $process_adet ; $i++): ?>
						<script type="text/javascript">
							cost_ep_value(<?php echo $tekrarsiz[$i]; ?>,<?php echo $process_adet; ?>);
						</script>
						<td style="padding:0px !important;">
							<div class="<?php echo $tekrarsiz[$i]; ?>">
								
							</div>
						</td>
					<?php endfor ?>
				</tr>
			</table>
		</div>