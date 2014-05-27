<div class="container">
	<div class="row">
		<div class="col-md-8">
			<p class="lead"><?php echo $user[0]["name"].' '.$user[0]["surname"].' Profile'; ?></p>
			<table class="table">
				<tr>
					<td>
					<p class = "text-left">User Info:</p>
					</td>
					<td>
					<p class = "text-left"><?php echo $user[0]['description']; ?></p>
					</td>
				</tr>
				<tr>
					<td>
					<p class = "text-left">E-mail:</p>
					</td>
					<td>
					<p class = "text-left"><?php echo $user[0]['email']; ?></p>
					</td>
				</tr>
				<tr>
					<td>
					<p class = "text-left">Cell Phone:</p>
					</td>
					<td>
					<p class = "text-left"><?php echo $user[0]['phone_num_1']; ?></p>
					</td>
				</tr>
				<tr>
					<td>
					<p class = "text-left">Work Phone:</p>
					</td>
					<td>
					<p class = "text-left"><?php echo $user[0]['phone_num_2']; ?></p>
					</td>
				</tr>
				<tr>
					<td>
					<p class = "text-left">Fax Phone:</p>
					</td>
					<td>
					<p class = "text-left"><?php echo $user[0]['fax_num']; ?></p>
					</td>
				</tr>
			</table>
		</div>
		<div class="col-md-4">
			<h5><a href = "<?php echo base_url("profile_update"); ?>">Update User Info</a></h5>

			<br>
			
			<div class="form-group">
				<b><p class = "text-left">Projects</p></b>
				<?php foreach ($user[0]['prjname'] as $prj) {
					echo '<p class = "text-left">'.$prj["name"].'</p>';
					echo "<br>";
				} 
				?>

			</div>
		</div>
	</div>
</div>
