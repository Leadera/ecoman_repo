<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="form-group" style="width: 100%; height: 400px; border:2px solid #f0f0f0;">
				<?php echo form_open_multipart('cpscoping/file_upload/'.$this->uri->segment('2').'/'.$this->uri->segment('3')); ?>
				    <input type="text" class="form-control" id="file_name" placeholder="file_name.pdf or file_name.xlsx or file_name.docx etc." name="file_name">
				    <input type="file" name="userfile" id="userfile" size="20" />
					<br/>
				    <button type="submit" class="btn btn-info">Save File</button>
			    </form>
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

			<?php echo form_open_multipart('search_result/'.$this->uri->segment(2).'/'.$this->uri->segment(3)); ?>
			    <input style="margin-bottom:10px;" type="text" class="form-control" id="search" placeholder="Search" name="search">
		    </form>
		    <?php 
    			$kontrol = array(); $index = 0;
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
			   			<?php echo $kpi['prcss_name']; ?>
			    	</div>
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
						   				echo "<table class='table table-bordered' style='text-align:center; margin-bottom:5px;'>";
				   						echo "<tr><th style='text-align:center;' colspan='2'>".$kpi_values[$i]['flow_name']."-".$kpi_values[$i]['flow_type_name']."</th></tr>";
				   						echo "<tr><td style='width:50%;'>Kpi</td><td>".$kpi_values[$i]['kpi']."</td></tr>";
				   						echo "<tr><td style='width:50%;'>Benchmark KPI</td><td><input type='text' class='form-control' id='benchmark_kpi' name='benchmark_kpi' value=''></td></tr>";
				   						echo "<tr><td>Kpi Unit Value</td><td>".$kpi_values[$i]['unit_kpi']."</td></tr>";
				   						echo "<tr><td>Kpi Error Value</td><td>".$kpi_values[$i]['kpi_error']."%</td></tr>";
				   						echo "<tr><td>Best Practice</td><td><textarea class='form-control' id='best_practice' name='best_practice' rows='3'></textarea></td></tr>";
				   						echo "</table>";
				   						echo "<div class='col-md-4'><button style='margin-bottom:5px;' type='submit' class='btn btn-primary'>Save Info</button></div>";
				   						echo "</form>";
				   					}
			   					}
			   				}
		   				?>
			    <?php } ?>
		   	<?php endforeach ?>
		</div>
	</div>
</div>