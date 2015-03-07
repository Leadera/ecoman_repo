<script src="http://d3js.org/d3.v3.min.js"></script>

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
							vPool += '<table style="width:100%; min-width:150px; font-size:13px; text-align:center;" frame="void"><tr><td>' + data.amount + ' ' + data.unit_amount + ' <span class="label label-danger">' + data.error_amount + '%</span></td><td rowspan="3" style="width:70px;">%'+data.allocation_rate+'</td></tr><tr><td>' + data.cost + ' ' + data.unit_cost + ' <span class="label label-danger">' + data.error_cost + '%</span></td></tr><tr><td>' + data.env_impact + ' ' + data.unit_env_impact + ' <span class="label label-danger">' + data.error_ep + '%</span></td></tr></table>';
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
	var list=new Array;

	function cost_ep_value(prcss_id,process_adet){
		//alert(prcss_id);
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: '<?php echo base_url('cpscoping/cost_ep'); ?>/'+prcss_id+'/'+<?php echo $this->uri->segment(2);?>+'/'+<?php echo $this->uri->segment(3); ?>,
			success: function(data){
				list.push(data);
				var temp = "";
				temp += '<table style="width:100%; min-width:150px; font-size:13px; text-align:center;" frame="void"><tr><th style="text-align:center;">' + data.prcss_name + '</th></tr><tr><td> <b>EP Value:</b> ' + data.ep_def_value + '  <b>EP Range:</b> ' + data.ep_value_alt + ' - ' + data.ep_value_ust + '</td></tr><tr><td> <b>Cost Value:</b> ' + data.cost_def_value + '   <b>Cost Range:</b> ' + data.cost_value_alt.toFixed(2) + ' - ' + data.cost_value_ust.toFixed(2) + ' Euro</td></tr></table>';
				$("div."+prcss_id).html(temp);
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
		    			$("#"+id).addClass("btn btn-success btn-xs pull-right");
		    			$("#"+id).html("Selected");
		    			buton_durum = 1;
		    		}else{
		    			$("#"+id).removeClass();
		    			$("#"+id).addClass("btn btn-default btn-xs pull-right");
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
			
		  <div id="rect-demo-ana">
		    <div id="rect-demo"></div>
	    </div>
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
			if(!empty($a['prcss_name'])){
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
			}
			?>
			<?php endforeach ?>
			</tr>
			<?php
				$count = 0; $deneme_array = array(); $flow_type_array = array();
				foreach ($allocation as $a):
					if(!empty($a['flow_name'])):
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
							<?php if ($active[$a['allocation_id']] == 0): ?>
								<button class="btn btn-default btn-xs pull-right" id="<?php echo $a['allocation_id']; ?>" onclick="is_candidate(<?php echo $a['allocation_id'];?>)">
									Select as IS candidate
								</button>
							<?php else: ?>
								<button class="btn btn-success btn-xs pull-right" id="<?php echo $a['allocation_id']; ?>" onclick="is_candidate(<?php echo $a['allocation_id'];?>)">IS candidate
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
			if(!empty($a['prcss_name'])){
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
			}
			?>
			<?php endforeach ?>
			</tr>
			<?php
				$count = 0; $deneme_array = array();
				foreach ($allocation as $a):
					if(!empty($a['flow_name'])){
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
							<?php
							if($id != 0){
							if ($active[$id] == 0): ?>
								<button class="btn btn-default btn-xs pull-right" id="<?php echo $id; ?>" onclick="is_candidate(<?php echo $id;?>)">Select as IS candidate
								</button>
							<?php else: ?>
								<button class="btn btn-success btn-xs pull-right" id="<?php echo $id; ?>" onclick="is_candidate(<?php echo $id;?>)">IS Candidate
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
<script type="text/javascript">
setTimeout(function()
{
     tuna_graph(list);
}, 5000);


	function tuna_graph(list){
	//console.log(list);

	//Tuna Graph
	var data = list;
	           console.log(data);

	var margin = {
	            "top": 10,
	            "right": 30,
	            "bottom": 50,
	            "left": 80
	        };
	var width = 400;
	var height = 400;

	// Set the scales
	    var x = d3.scale.linear()
	        .domain([0, d3.max(data, function(d) { return d.cost_value_ust+100; })])
	        .range([0,width]).nice();

	    var y = d3.scale.linear()
	        .domain([d3.min(data, function(d) { return d.ep_value_alt; }), d3.max(data, function(d) { return d.ep_value_ust; })])
	        .range([height, 0]).nice();

	    var xAxis = d3.svg.axis().scale(x).orient("bottom");
	    var yAxis = d3.svg.axis().scale(y).orient("left");

			var color = d3.scale.category20();
	// Create the SVG 'canvas'
	    var svg = d3.select("#rect-demo-ana").append("svg")
	            .attr("class", "chart")
	            .attr("width", width + margin.left + margin.right)
	            .attr("height", height + margin.top + margin.bottom).append("g")
	            .attr("transform", "translate(" + margin.left + "," + margin.right + ")");

	    svg.append("g")
	      .attr("class", "x axis")
	      .attr("transform", "translate(0," + height + ")")
	      .call(xAxis);

	    svg.append("g")
	      .attr("class", "y axis")
	      .call(yAxis);

	svg.selectAll("rect").
	  data(data).
	  enter().
	  append("svg:rect").
	  attr("x", function(datum,index) { return x(datum.cost_value_alt); }).
	  attr("y", function(datum,index) { return y(datum.ep_value_ust); }).
	  attr("height", function(datum,index) { return y(datum.ep_value_alt)-y(datum.ep_value_ust); }).
	  attr("width", function(datum, index) { return x(datum.cost_value_ust)-x(datum.cost_value_alt); }).
	  attr("fill",function(d,i){return color(i);});
	}
</script>