<div class="container">
	<?php if(!empty($this->session->flashdata('project_error'))): ?>
		<div class="alert alert-warning"><?php echo $this->session->flashdata('project_error'); ?></div>
	<?php endif ?>
	<div class="row">
		<div class="col-md-8">
				<div class="swissheader">All Projects</div>
						<!-- harita -->
				<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
				<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
				<?php
				$project_array = array();
                                $counter=0;
			 	foreach ($projects as $prj => $k) {
//print_r($prj);
//print_r($k);
                                    if($k['latitude']!="" || $k['longitude']!="") {
                                        $project_array[$prj][0] = $k['latitude'];
					$project_array[$prj][1] = $k['longitude'];
					$project_array[$counter][2] = "<a href='".base_url('project/'.$k['id'])."'>".$k['name']."</a>";
                                    } else {
                                        $project_array[$prj][0] = '39';
					$project_array[$prj][1] = '32';
					$project_array[$prj][2] = "<a href='".base_url('project/'.$k['id'])."'>".$k['name']."</a>";
                                    }
                                    /*if($k['latitude']!="" && $k['longitude']!="") {
                                        $project_array[$prj][0] = $k['latitude'];
					$project_array[$prj][1] = $k['longitude'];
					$project_array[$prj][2] = "<a href='".base_url('project/'.$k['id'])."'>".$k['name']."</a>";
                                    }*/
                                    
                                    /*$project_array[$prj][0] = $k['latitude'];
                                    $project_array[$prj][1] = $k['longitude'];
                                    $project_array[$prj][2] = "<a href='".base_url('project/'.$k['id'])."'>".$k['name']."</a>";

                                     */
                                    $counter++;
				} 
				//print_r($project_array);
				?>
				<div id="map"></div>
				<script type="text/javascript">
                                
  			var project = <?php echo json_encode($project_array); ?>;
                        //console.log(project);
  			var bounds = new L.LatLngBounds(project);

        var map = L.map('map');
        map.fitWorld().zoomIn();

				map.on('resize', function(e) {
				    map.fitWorld({reset: true}).zoomIn();
				});
        /*var map = L.map('map', {
    center: [51.505, -0.09],
    zoom: 13
});*/
        
        mapLink = 
            '<a href="http://openstreetmap.org">OpenStreetMap</a>';
        L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
					attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
				}).addTo(map);

				for (var i = 0; i < project.length; i++) {
                                    /*if(project[i][0]!=null || project[i][1]!=null) {
                                        marker = new L.marker([project[i][0],project[i][1]])
						.bindPopup(project[i][2])
						.addTo(map);
                                    }*/
                                    marker = new L.marker([project[i][0],project[i][1]])
						.bindPopup(project[i][2])
						.addTo(map);
					
				}
				</script>
				<!-- harita bitti -->
			<table class="table-hover" style="clear:both;">
			<?php foreach ($projects as $pro): ?>
				<tr>
				<td style="padding: 10px 15px;">
					<a href="<?php echo base_url('project/'.$pro['id']) ?>">
					<div class="row">
						<div class="col-md-9">
							<div><b><?php echo $pro['name']; ?></b></div>
							<div><span style="color:#999999; font-size:12px;"><?php echo $pro['description']; ?></span></div>
						</div>
						<div class="col-md-3">
							
						</div>
					</div>
					</a>
				</td>
				</tr>
			<?php endforeach ?>
			</table>
		</div>	
		<div class="col-md-4">
			<div class="well">
				You are now seeing all the projects at the system. You can only access and open the projects that you are involved.
			</div>
		</div>
	</div>
</div>
