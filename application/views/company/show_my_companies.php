<div class="container">
	<div class="row">
		<div class="col-md-8">
				<!-- harita -->
				<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
				<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
				<?php
				$company_array = array();
			 	foreach ($companies as $com => $k) {	 
					$company_array[$com][0] = $k['latitude'];
					$company_array[$com][1] = $k['longitude'];
					$company_array[$com][2] = "<a href='".base_url('company/'.$k['id'])."'>".$k['name']."</a>";
				} 
				//print_r($company_array);
				?>
				<div id="map"></div>
				<script type="text/javascript">
  			var planes = <?php echo json_encode($company_array); ?>;
  			var bounds = new L.LatLngBounds(planes);

        var map = L.map('map').setView([41.83683, 19.33594], 4);
        map.fitBounds(bounds);
        mapLink = 
            '<a href="http://openstreetmap.org">OpenStreetMap</a>';
        L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
					attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
				}).addTo(map);

				for (var i = 0; i < planes.length; i++) {
					marker = new L.marker([planes[i][0],planes[i][1]])
						.bindPopup(planes[i][2])
						.addTo(map);
				}
				</script>
				<!-- harita bitti -->
			<div class="lead pull-left">Show My Companies</div>
				<?php 
					$temp = $this->session->userdata('user_in');
					if($temp['id'] != null): ?>
					<a class="pull-right  btn btn-info btn-sm" href="<?php echo base_url("newcompany"); ?>">Create a Company</a>
					<?php endif	?>	
				<ul class="list-group" style="clear:both; margin-top:20px;">
				<?php foreach ($companies as $com): ?>
					<li class="list-group-item">
						<b><a href="<?php echo base_url('company/'.$com['id']) ?>"><?php echo $com['name']; ?></a></b>
						<span style="color:#999999; font-size:12px;"><?php echo $com['description']; ?></span>
					</li>
				<?php endforeach ?>
				</ul>
		</div>	
		<div class="col-md-4">
			
		</div>
	</div>
</div>
