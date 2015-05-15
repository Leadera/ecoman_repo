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
                map.fitWorld().zoomIn();

				map.on('resize', function(e) {
				    map.fitWorld({reset: true}).zoomIn();
				});
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
				<div class="swissheader pull-left">Show <?php echo $cluster_name['name'];?></div>
				<?php 
					$temp = $this->session->userdata('user_in');
					if($temp['id'] != null): ?>
					<a class="pull-right btn btn-info btn-sm" href="<?php echo base_url("newcompany"); ?>">Create a Company</a>
					<?php endif	?>	

				<ul class="list-group" style="clear:both;">
				<?php foreach ($companies as $com): ?>
					<li class="list-group-item">
						<b><a href="<?php echo base_url('company/'.$com['id']) ?>"><?php echo $com['name']; ?></a></b>
						<span style="color:#999999; font-size:12px;"><?php echo $com['description']; ?></span>
						<?php if($com['have_permission']==1): ?>
							<i class="fa fa-check-square-o pull-right"></i>
						<?php endif ?>
					</li>
				<?php endforeach ?>
				</ul>
		</div>	
		<div class="col-md-4">

			<a class="btn btn-default btn-sm" href="<?php echo base_url('cluster'); ?>">Add company to a cluster</a>
			<?php echo form_open_multipart('companies'); ?>

			<div class="well" style="margin-top: 20px;">
				<label for="cluster">Select Cluster</label>
				<select title="Choose at least one" class="select-block" id="cluster" name="cluster">
					<option value="0">All of the Companies</option>
					<?php foreach ($clusters as $cluster): ?>
						<option value="<?php echo $cluster['id']; ?>"><?php echo $cluster['name']; ?></option>
					<?php endforeach ?>
				</select>
				<button type="submit" class="btn btn-primary btn-sm">Filter</button>
			</div>
			</form>

			<i class="fa fa-check-square-o"></i> means that you have the rights to edit the company.
		</div>
	</div>
</div>
