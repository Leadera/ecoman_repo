<div class="container">
	<p class="lead">Show All Companies</p>
	
	<div class="row">
		<div class="col-md-8">

			<?php 
				foreach ($companies as $company) {
					echo "<h6><a href =".base_url("company/".$company["id"])." >";
					echo ($company['name']); 
					echo '<br>';
					echo "</a></h6>";
				}
			?>
		</div>
		<div class="col-md-4">
			
			<h4><a href = "<?php echo base_url("newcompany"); ?>">Create Company</a></h4>

		</div>
	</div>
</div>
