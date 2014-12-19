<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
	function deneme() {
		google.load("visualization", "1", {packages:["corechart"]});

		var prjct_id = <?php echo $this->uri->segment(2); ?>;
		var cmpny_id = <?php echo $this->uri->segment(3); ?>;

		var prcss_array = new Array();
		var flow_array = new Array();
		var flow_type_array = new Array();
		var kpi = new Array();
		var kpi2 = new Array();
		var index = 0;
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: '<?php echo base_url('kpi_calculation_chart'); ?>/'+prjct_id+'/'+cmpny_id,
			success: function(data){
				if(data['allocation'].length != 0){
					for(var i = 0 ; i < data['allocation'].length ; i++){
						if(data['allocation'][i].benchmark_kpi != 0){
							prcss_array[index] = data['allocation'][i].prcss_name;
							flow_array[index] = data['allocation'][i].flow_name;
							flow_type_array[index] = data['allocation'][i].flow_type_name;

							kpi[index] = ((data['allocation'][i].benchmark_kpi - data['allocation'][i].kpi) / data['allocation'][i].benchmark_kpi) * 100;
							if (kpi[index] > 0) {kpi2[index] = 100-kpi[index];}
							else{kpi2[index] = 100+kpi[index];}
							index++;
						}
					}
					console.log(kpi2);
					var data = new google.visualization.DataTable();

					var newData = new Array(index);
		          	for(var i = 0 ; i < index+1 ; i++){
		          		newData[i] = new Array(4);
		          	}

		          	newData[0][0] = 'Genre';
		          	newData[0][1] = 'Fair Value';
		          	newData[0][2] = 'Error Value';
		          	newData[0][3] = { role: 'annotation' };


		          	for(var i = 1 ; i < index+1 ; i++){
		          		newData[i][0] = prcss_array[i-1]+"-"+flow_array[i-1]+"-"+flow_type_array[i-1];
		          		newData[i][1] = kpi2[i-1];
		          		newData[i][2] = kpi[i-1];
		          		newData[i][3] = '';
		          	}

		          	var data = google.visualization.arrayToDataTable(newData);

		          	var options = {
				        height: 600,
				        legend: { position: 'top', maxLines: 3 },
				        bar: { groupWidth: '75%' },
				        isStacked: true,
				        vAxis: {title: "% (Percentage)",gridlines: { count: 10},format:'0.0' },
				        hAxis: {title: 'Process Name - Flow Name - Flow Type Name', titleTextStyle: {color: 'red'}}
				    };
				    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
				    chart.draw(data, options);
				}
			}
		});
	    /*var data = google.visualization.arrayToDataTable([
			['API Category', 'Social', 'Error', { role: 'annotation' } ],
		  	['2011', 98, 53, ''],
		  	['2012', 151, 34, ''],
		  	['2013', 69, 27, ''],
		]);

	    var options = {
		    width: 1000,
		    height: 550,
		    legend: { position: 'top', maxLines: 3, textStyle: {color: 'black', fontSize: 16 } },
			isStacked: true,

			// Displays tooltip on selection.
			// tooltip: { trigger: 'selection' }, 
		 };

	    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
	    chart.draw(data, options);

		// Selects a set point on chart.
		// chart.setSelection([{row:0,column:1}]) 

		// Renders chart as PNG image 
		// chart_div.innerHTML = '<img src="' + chart.getImageURI() + '">';*/
	};
</script>

<?php if (!empty($kpi_values)): ?>
	<div class="col-md-12" style="margin-bottom: 10px;">
		<a class="btn btn-default btn-sm" href="<?php echo base_url('cpscoping/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/show'); ?>">Show CP Scoping Data</a>
	</div>
	<div class="col-md-7">
		<?php 

		if(validation_errors() != NULL ){
		    echo '<div class="alert">';
			echo '<button type="button" class="close" data-dismiss="alert">&times;</button>
					<h4>Form couldn\'t be saved</h4>
		      	<p>';
		      		echo validation_errors();
		      	echo '</p>
		    </div>';
		}

		 ?>
		<p>KPI View and Edit Table</p>
		<?php 
    		$kontrol = array(); $index = 0; $prcss_adet = 0; $kontrol_prcss = array(); $index_prcss = 0; 
    	?>
		<?php 
			foreach ($kpi_values as $kpi){
	   			$kontrol_prcss[$index_prcss] = $kpi['prcss_name'];
	   			$deger = 0;
	   			for($i = 0 ; $i < $index_prcss ; $i++){
	   				if($kontrol_prcss[$i] == $kpi['prcss_name']){
	   					$deger = 1;
	   				}
	   			}
	   			$index_prcss++;
	   			if($deger == 0){
	   				$prcss_adet++;
	   			}
	   		}
		?>
	   	<?php foreach ($kpi_values as $kpi): ?>
	   		<?php
	   			$kontrol[$index] = $kpi['prcss_name'];
	   			$deger = 0;
	   			for($i = 0 ; $i < $index ; $i++){
	   				if($kontrol[$i] == $kpi['prcss_name']){
	   					$deger = 1;
	   				}
	   			}
	   			$index++;
	   			if($deger == 0){
			 ?>
		   		<div class="cp-heading-kpi">
		   			Process: <?php echo $kpi['prcss_name'];?>
		    	</div>
		    	<div style="margin-bottom: 25px;">
		    		<?php 
		    			$kontrol_flow = array(); $index_flow = 0;
		    			$kontrol_flow_type = array();
		    		?>
	   				<?php 
	   					for($i = 0 ; $i < sizeof($kpi_values) ; $i++){
		   					if($kpi_values[$i]['prcss_name'] == $kpi['prcss_name']){
			   					$kontrol_flow[$index_flow] = $kpi_values[$i]['flow_name'];
			   					$kontrol_flow_type[$index_flow] = $kpi_values[$i]['flow_type_name'];
					   			$deger_flow = 0;
					   			for($k = 0 ; $k < $index_flow ; $k++){
					   				if($kontrol_flow[$k] == $kpi_values[$i]['flow_name'] && $kontrol_flow_type[$k] == $kpi_values[$i]['flow_type_name']){
					   					$deger_flow = 1;
					   				}
					   			}
					   			$index_flow++;
					   			if($deger_flow == 0){
					   				echo form_open_multipart("kpi_insert/".$this->uri->segment(2)."/".$this->uri->segment(3)."/".$kpi_values[$i]['flow_id']."/".$kpi_values[$i]['flow_type_id']."/".$kpi_values[$i]['prcss_id']);
					   				echo "<table class='table table-bordered' style='margin-bottom:0px;'>";
			   						echo "<tr><th colspan='6'>Flow: ".$kpi_values[$i]['flow_name']."-".$kpi_values[$i]['flow_type_name']."</th></tr>";
			   						echo "<tr><td>Kpi</td><td style='width:130px;'>".$kpi_values[$i]['kpi']."</td><td>Kpi Unit Value</td><td>".$kpi_values[$i]['unit_kpi']."</td><td>Kpi Error Value</td><td>".$kpi_values[$i]['kpi_error']."%</td></tr>";
			   						echo "<tr><td>Benchmark KPI</td><td><input type='text' class='form-control' id='benchmark_kpi' name='benchmark_kpi' value='".$kpi_values[$i]['benchmark_kpi']."'></td><td>Best Practice</td><td><textarea class='form-control' id='best_practice' name='best_practice' rows='3'>".$kpi_values[$i]['best_practice']."</textarea></td><td colspan='2'><div class='col-md-4'><button style='margin-bottom:5px;' type='submit' class='btn btn-inverted'>Save Data</button></div></td></tr>";
			   						echo "</table>";
			   						echo "</form>";
			   					}
		   					}
		   				}
	   				?>
	   			</div>
		    <?php } ?>
	   	<?php endforeach ?>
	</div>

	<div class="col-md-5">
		<p>Company KPIs vs Benchmark KPIs Comparison Graph</p>
		<div id="chart_div" style="border:2px solid #f0f0f0;"></div>
		<hr>
		<p>Search for Documents</p>
		<?php echo form_open_multipart('search_result/'.$this->uri->segment(2).'/'.$this->uri->segment(3)); ?>
		  <input style="margin-bottom:10px;" type="text" class="form-control" id="search" placeholder="Please enter search term" name="search">
	  </form>
	  <hr>
	  <p>Document Upload</p>
	  <div class="form-group">
		  	<?php if(validation_errors() != NULL ): ?>
			    <div class="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<h4>Form couldn't be saved</h4>
			      	<p>
			      		<?php echo validation_errors(); ?>
			      	</p>
			    </div>
			<?php endif ?>
			<?php echo form_open_multipart('cpscoping/file_upload/'.$this->uri->segment('2').'/'.$this->uri->segment('3')); ?>
			    <input type="text" class="form-control" id="file_name" placeholder="file_name" name="file_name">
			    <input type="file" name="userfile" id="userfile" size="20" />
					<br/>
			    <button type="submit" class="btn btn-info btn-sm">Save File</button>
		    </form>
		    <hr>
		    <p>Uploaded Documents</p>
		    <table class="table table-bordered">
		    	<tr>
		    		<th>Index</th>
		    		<th>File Name</th>
		    	</tr>
			    <?php $sayac = 1;foreach ($cp_files as $file): ?>
			    	<tr>
			    		<td>
			    			<?php echo $sayac; $sayac++; ?>
			    		</td>
			    		<td>
			    			<button onclick="open_document(<?php echo $file['id']; ?>)" id="<?php echo $file['id']; ?>"
		    						style="width:100%;background-color: Transparent;
									    background-repeat:no-repeat;
									    border: none;
									    cursor:pointer;
									    overflow: hidden;
									    outline:none;">
								<?php echo $file['file_name']; ?>
							</button>
			    		</td>
			    	</tr>
			    <?php endforeach ?>
		    </table>
		</div>
	</div>

	<script type="text/javascript">
		deneme();
	</script>
<?php else: ?>
	<div class="container">
		<div class="col-md-4"></div>
		<div class="col-md-4" style="margin-bottom: 10px; text-align:center;">
			<a class="btn btn-default btn-sm" href="<?php echo base_url('cpscoping/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/show'); ?>">Show CP Scoping Data</a>
			<p>There is nothing to display!</p>
		</div>
		<div class="col-md-4"></div>
	</div>
<?php endif ?>
		    