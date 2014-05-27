<?php echo $map['js']; ?>
<div class="container">
	
	<div class="row">
		<div class="col-md-8">
			<p class="lead"><?php echo $companies[0]['name']; ?></p>
			<table class="table">
				<tr>
					<td>
					<p class = "text-left">Company Info:</p>
					</td>
					<td>
					<p class = "text-left"><?php echo $companies[0]['description']; ?></p>
					</td>
				</tr>
				<tr>
					<td>
					<p class = "text-left">E-mail:</p>
					</td>
					<td>
					<p class = "text-left"><?php echo $companies[0]['email']; ?></p>
					</td>
				</tr>
				<tr>
					<td>
					<p class = "text-left">Phone:</p>
					</td>
					<td>
					<p class = "text-left"><?php echo $companies[0]['phone_num_1']; ?></p>
					</td>
				</tr>
				<tr>
					<td>
					<p class = "text-left">Work Phone:</p>
					</td>
					<td>
					<p class = "text-left"><?php echo $companies[0]['phone_num_2']; ?></p>
					</td>
				</tr>
				<tr>
					<td>
					<p class = "text-left">Fax Phone:</p>
					</td>
					<td>
					<p class = "text-left"><?php echo $companies[0]['fax_num']; ?></p>
					</td>
				</tr>
				<tr>
					<td>
					<p class = "text-left">Address:</p>
					</td>
					<td>
					<p class = "text-left"><?php echo $companies[0]['address']; ?></p>
					</td>
				</tr>
				<tr>
					<td>
					<p class = "text-left">Nace Code:</p>
					</td>
					<td>
					<p class = "text-left"><?php echo $companies[0]['nacecode']; ?></p>
					</td>
				</tr>
				<tr>
					<td>
					<p class = "text-left">Company on map:</p>
					</td>
					<td>
					<p class = "text-left"><?php echo $map['html']; ?></p>
					</td>
				</tr>
			</table>
		</div>
		<div class="col-md-4">
			<button class="btn btn-embossed btn-primary">Update Company</button>

			<br><br><br>
			
			<div class="form-group">
				<p class = "text-left">Company project</p>
				<?php foreach ($companies[0]['prjname'] as $prj) {
					echo '<p class = "text-left">'.$prj["name"].'</p>';
					echo "<br>";
				} ?>
				
			</div>

			<div class="form-group">
				<p class = "text-left">Company workers</p>
				<?php foreach ($companies[0]['cmpnyperson'] as $prj) {
					echo '<p class = "text-left">'.$prj["name"].' '.$prj["surname"].'</p>';
					echo "<br>";
				} ?>
			</div>
		</div>
	</div>
</div>
