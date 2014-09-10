<div class="container">
	<div class="row">
		<div class="col-md-6">
			<select id="projects" class="btn-group select select-block">
				<option value="0">Nothing Selected</option>
				<?php foreach ($c_projects as $p): ?>
					<option value="<?php echo $p['proje_id']; ?>"><?php echo $p['name']; ?></option>
				<?php	endforeach  ?>
			</select>
		</div>
		<div class="col-md-6">
			<select id="companiess" class="btn-group select select-block">
				<option value="0">Nothing Selected</option>
			</select>
		</div>
		<div class="col-md-4">
			<a href="#" class="btn btn-default btn-sm" id="cpscopinga">New CP potentials identification</a>		
		</div>
	</div>
</div>
