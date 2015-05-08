<div class="container">
	<div class="row">
		<div class="col-md-8">
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
        map.fitBounds(bounds);
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
			<div class="lead pull-left">Show All Projects</div>
			<?php if($is_consultant):?>
			<a class="pull-right btn btn-info btn-embossed btn-sm" href="<?php echo base_url("newproject"); ?>">Create Project</a>
			<?php endif ?>
			<ul class="list-group" style="clear:both;">
			<?php foreach ($projects as $pro): ?>
				<li class="list-group-item">
					<b><a href="<?php echo base_url('project/'.$pro['id']) ?>"><?php echo $pro['name']; ?></a></b>
					<span style="color:#999999; font-size:12px;"><?php echo $pro['description']; ?></span>
				</li>
			<?php endforeach ?>
			</ul>
		</div>	
		<div class="col-md-4">
		</div>
	</div>
</div>
