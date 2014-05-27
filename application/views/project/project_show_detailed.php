<div class="container">
	
	<div class="row">
		<div class="col-md-8">
			<p class="lead"><?php echo $projects[0]['name']; ?></p>
			<table class="table">
				<tr>
					<td>
					<p class = "text-left">Start Date:</p>
					</td>
					<td>
					<p class = "text-left"><?php echo $projects[0]['start_date']; ?></p>
					</td>
				</tr>
				<tr>
					<td>
					<p class = "text-left">End Date:</p>
					</td>
					<td>
					<p class = "text-left"><?php echo $projects[0]['end_date']; ?></p>
					</td>
				</tr>
				<tr>
					<td>
					<p class = "text-left">Status:</p>
					</td>
					<td>
					<p class = "text-left"><?php echo $status[0]['name']; ?></p>
					</td>
				</tr>
				<tr>
					<td>
					<p class = "text-left">Description:</p>
					</td>
					<td>
					<p class = "text-left"><?php echo $projects[0]['description']; ?></p>
					</td>
				</tr>
				<tr>
					<td>
					<p class = "text-left">Consultant:</p>
					</td>
					<td>
					<p class = "text-left">
					
					<?php 
					foreach ($constant as $cons) {
						echo "<h6><a href =".base_url("user/".$cons["id"])." >";
						echo $cons['name'].' '.$cons['surname']; 
						echo '<br>';
						echo "</a>";
					}
					?>

					</p>
					</td>
				</tr>
				<tr>
					<td>
					<p class = "text-left">Contact Person:</p>
					</td>
					<td>
					<p class = "text-left">
						
						<?php 
						foreach ($contact as $con) {
							echo "<h6><a href =".base_url("user/".$con["id"])." >";
							echo $con['name'].' '.$con['surname']; 
							echo '<br>';
							echo "</a>";
						}
						?>

					</p>
					</td>
				</tr>
				<tr>
					<td>
					<p class = "text-left">Company:</p>
					</td>
					<td>
					<p class = "text-left">
						
						<?php 
						foreach ($companies as $company) {
							echo "<h6><a href =".base_url("company/".$company["id"])." >";
							echo $company['name']; 
							echo '<br>';
							echo "</a>";
						}
						?>

					</p>
					</td>
				</tr>
			</table>
		</div>
		<div class="col-md-4">
			<h5><a href = "<?php echo base_url(""); ?>">Update Project Info</a></h5>
		</div>
	</div>
</div>
