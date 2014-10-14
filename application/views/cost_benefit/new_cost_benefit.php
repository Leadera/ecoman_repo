<div class="col-md-4">
</div>
<div class="col-md-4">
	<table class="table table-bordered">
		<tr>
			<th>Prcss Name</th>
			<th>Flow Name</th>
			<th>Flow Type Name</th>
		</tr>
		<?php foreach ($cost_benefit as $co_benefit): ?>
			<tr>
				<td><?php echo $co_benefit['prcss_name']; ?></td>
				<td><?php echo $co_benefit['flow_name']; ?></td>
				<td><?php echo $co_benefit['flow_type_name']; ?></td>
			</tr>
		<?php endforeach ?>
	</table>
</div>
<div class="col-md-4">
</div>