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
							vPool += '<table style="width:100%; min-width:150px; font-size:13px; text-align:center;" frame="void"><tr><td>' + data.amount + ' ' + data.unit_amount + ' <span class="label label-info">' + data.error_amount + '%</span></td><td rowspan="3" style="width:70px;">%'+data.allocation_rate+'</td></tr><tr><td>' + data.cost + ' ' + data.unit_cost + ' <span class="label label-info">' + data.error_cost + '%</span></td></tr><tr><td>' + data.env_impact + ' ' + data.unit_env_impact + ' <span class="label label-info">' + data.error_ep + '%</span></td></tr></table>';
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
				// var temp = "";
				// temp += '<table style="width:100%; min-width:150px; font-size:13px; text-align:center;" frame="void"><tr><th style="text-align:center;">' + data.prcss_name + '</th></tr><tr><td> <b>EP Value:</b> ' + data.ep_def_value + '  <b>EP Range:</b> ' + data.ep_value_alt + ' - ' + data.ep_value_ust + '</td></tr><tr><td> <b>Cost Value:</b> ' + data.cost_def_value + '   <b>Cost Range:</b> ' + data.cost_value_alt.toFixed(2) + ' - ' + data.cost_value_ust.toFixed(2) + ' Euro</td></tr></table>';
				// $("div."+prcss_id).html(temp);
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
		<div class="col-md-4" id="sol4">
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

			<hr>
			<?php for($i = 0 ; $i < $process_adet ; $i++): ?>
				<script type="text/javascript">
					cost_ep_value(<?php echo $tekrarsiz[$i]; ?>,<?php echo $process_adet; ?>);
				</script>
			<?php endfor ?>


			<table id="dg" class="easyui-datagrid"
			    data-options="
			        iconCls: 'icon-edit',
			        singleSelect: true,
			        toolbar: '#tb',
			        method: 'get',
			        fitColumns: true,
			        onClickRow: onClickRow
			    ">
				<thead>
				    <tr>
				        <th data-options="field:'prcss_name',align:'center',width:100">Process</th>
				        <th data-options="field:'ep_def_value',align:'center',width:100">Ep Value</th>
				        <th data-options="field:'ep_value_alt',align:'center',width:100">Min Ep Value</th>
				        <th data-options="field:'ep_value_ust',align:'center',width:100">Max Ep Value</th>
				        <th data-options="field:'cost_def_value',align:'center',width:100">Cost Value</th>
				        <th data-options="field:'cost_value_alt',align:'center',width:100">Min Cost Value</th>
				        <th data-options="field:'cost_value_ust',align:'center',width:100">Max Cost Value</th>
				        <th data-options="field:'comment',width:200,align:'center',editor:'text'">Comments / Remarks</th>
				      
				    </tr>
				</thead>
			</table>
    <div id="tb">
    		<p style="float:left;">Cost and Environmental impact data of processes</p>
        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-save',plain:true" onclick="accept()">Save All Changes</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-undo',plain:true" onclick="reject()">Cancel All Changes</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-search',plain:true" onclick="getChanges()">See Changes</a>
    </div>
    
    <script type="text/javascript">
        var editIndex = undefined;
        function endEditing(){
            if (editIndex == undefined){return true}
            if ($('#dg').datagrid('validateRow', editIndex)){
                $('#dg').datagrid('endEdit', editIndex);
                editIndex = undefined;
                return true;
            } else {
                return false;
            }
        }
        function onClickRow(index){
            if (editIndex != index){
                if (endEditing()){
                    $('#dg').datagrid('selectRow', index)
                            .datagrid('beginEdit', index);
                    editIndex = index;
                } else {
                    $('#dg').datagrid('selectRow', editIndex);
                }
            }
        }
        function accept(){
            if (endEditing()){
            	var rows = $('#dg').datagrid('getRows');
        			var prjct_id = <?php echo $this->uri->segment(2); ?>;
							var cmpny_id = <?php echo $this->uri->segment(3); ?>;
							$("#alerts").html("");
							$("#alerts").fadeIn( "fast" );
							$.each(rows, function(i, row) {
							  $('#dg').datagrid('endEdit', i);
							  /* var url = row.isNewRecord ? 'test.php?savetest=true' : 'test.php?updatetest=true'; */
							  var url = '../../kpi_insert/'+prjct_id+'/'+cmpny_id+'/'+row.flow_id+'/'+row.flow_type_id+'/'+row.prcss_id;
							  $.ajax(url, {
							      type:'POST',
							      dataType:'json',
							      data:row,
					          success: function(data, textStatus, jqXHR) {
					          	console.log(data);
					          	//alert(data);
					          	$("#alerts").append(data);
					          	deneme();
										},
								    error: function(jqXHR, textStatus, errorThrown) {
										  console.log(textStatus, errorThrown);
										}
							  });
							});
							$("#alerts").delay(5000).fadeOut( "fast" );

            }
        }
        function reject(){
            $('#dg').datagrid('rejectChanges');
            editIndex = undefined;
        }
        function getChanges(){
            var rows = $('#dg').datagrid('getChanges');
            alert(rows.length+' rows are changed!');
        }
    </script>


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

	//datagrid'in içini doldurma
	$('#dg').datagrid('loadData', data);  

	var margin = {
	            "top": 10,
	            "right": 30,
	            "bottom": 200,
	            "left": 80
	        };
	var width = $('#sol4').width()-110;
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

	// var color = d3.scale.category20();
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

	//x axis label
	svg.append("text")
		.attr("transform", "translate(" + (width / 2) + " ," + (height + margin.bottom - 155) + ")")
		.style("text-anchor", "middle")
		.text("Cost Value");

	//y axis label
	svg.append("text")
		.attr("transform", "rotate(-90)")
		.attr("y", 0 - margin.left)
		.attr("x", 0 - (height / 2))
		.attr("dy", "1em")
		.style("text-anchor", "middle")
		.text("Ep Value");

	svg.selectAll("rect").
	  data(data).
	  enter().
	  append("svg:rect").
	  attr("x", function(datum,index) { return x(datum.cost_value_alt); }).
	  attr("y", function(datum,index) { return y(datum.ep_value_ust); }).
	  attr("height", function(datum,index) { return y(datum.ep_value_alt)-y(datum.ep_value_ust); }).
	  attr("width", function(datum, index) { return x(datum.cost_value_ust)-x(datum.cost_value_alt); }).
	  attr("fill",function(datum,index) { return datum.color; })
  	.on("mouseover", function(datum,index){return tooltip.style("visibility", "visible").html(datum.prcss_name+"<br>EP Range:"+datum.ep_value_alt+"-"+datum.ep_value_ust+"<br>Cost Range:"+datum.cost_value_alt+"-"+datum.cost_value_ust);})
		.on("mousemove", function(datum,index){return tooltip.style("top", (event.pageY-10)+"px").style("left",(event.pageX+10)+"px").html(datum.prcss_name+"<br>EP Range:"+datum.ep_value_alt+"-"+datum.ep_value_ust+"<br>Cost Range:"+datum.cost_value_alt+"-"+datum.cost_value_ust);})
		.on("mouseout", function(){return tooltip.style("visibility", "hidden");});

		var tooltip = d3.select("body")
		.append("div")
		.style("position", "absolute")
		.style("z-index", "10")
		.style("visibility", "hidden")
		.style("background-color", "white")
		.style("color", "darkblue");

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
      .append("rect")
	  .attr("x", 9)
      .attr("y", function(d, i){ return 410 + (i *  20);})
	  .attr("width", 10)
	  .attr("height", 10)
	  .style("fill", function(datum,index) { return datum.color; })
      
    legend.selectAll('text')
      .data(data)
      .enter()
      .append("text")
	  .attr("x", 22)
    .attr("y", function(d, i){ return i *  20 + 419;})
	  .text(function(datum,index) { return datum.prcss_name; });

	}
</script>