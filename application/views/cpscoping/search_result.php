<div class="container">
	<div class="row">
		<div class="col-md-4">
		</div>
		<div class="col-md-4">
			<table class="table table-bordered">
				<tr>
					<th>Index</th>
					<th>Result</th>
				</tr>
				<?php $sayac = 1; foreach ($result as $r): ?>
					<tr>
						<th><?php echo $sayac;$sayac++; ?></th>
						<th><a href="<?php echo asset_url('cp_scoping_files').'/'.$r["file_name"]; ?>"><?php echo $r['file_name']; ?></a></th>
					</tr>
				<?php endforeach ?>
			</table>
		</div>
		<div class="col-md-4">
		</div>
	</div>
</div>