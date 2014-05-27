<div class="container">

	<div class="row">
		<div class="col-md-8">
			<p class="lead">Show All Projects</p>
			<?php 
				foreach ($projects as $pro) {
					echo "<h6><a href =".base_url("project/".$pro["id"])." >";
					echo ($pro['name']); 
					echo '<br>';
					echo "</a></h6>";
				}
			?>
		</div>
		<div class="col-md-4">
			
			<h4><a href = "<?php echo base_url("newproject"); ?>">Create Project</a></h4>

		</div>
	</div>
</div>
