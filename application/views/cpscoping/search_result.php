<div class="container">
	<div class="row">
		<div class="col-md-4">
			<table class="table table-bordered">
				<tr>
					<th>Index</th>
					<th>Result</th>
				</tr>
				<?php $sayac = 1; foreach ($result as $r): ?>
					<tr>
						<th><?php echo $sayac;$sayac++; ?></th>
						<th><?php echo $r['file_name']; ?></th>
					</tr>
				<?php endforeach ?>
			</table>
		</div>
	</div>
</div>