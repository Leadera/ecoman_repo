<div class="container">
	<p>Dizayn Makina Eco Tracking Page</p>
	<a class="btn btn-info pull-right" href="http://212.156.205.183:8081/olcum/">Instant Tracking Data</a>
	<p>Daily consumption values for Machine 1</p>
	<table class="table table-hover">
		<tr>
			<th>Date</th><th>Power 1</th><th>Power 2</th><th>Power 3</th>
		</tr>
		<?php foreach($veriler as $v): ?>
			<tr>
				<td><?php echo $v['date'] ?></td><td><?php echo $v['powera'] ?> kVa</td><td><?php echo $v['powerb'] ?> kVa</td><td><?php echo $v['powerc'] ?> kVa</td>
			</tr>
		<?php endforeach ?>
	</table>
</div>