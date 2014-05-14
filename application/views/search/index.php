<div class="col-md-9 sagbar">
	<table class="table table-hover table-bordered">
	<tr>
		<th>ID</th>
		<th>Product name</th>		
		<th>Product type</th>
		<th>Quantity</th>
		<th>Product unit</th>
		<th>Product description</th>
	</tr>
	<?php foreach ($search_result as $s): ?>
			<tr>
				<td><?php echo $s['id']; ?></td>
				<td><?php echo $s['name']; ?></td>
				<td><?php echo $s['type']; ?></td>
				<td><?php echo $s['quantity']; ?></td>
				<td><?php echo $s['unit']; ?></td>
				<td><?php echo $s['description']; ?></td>
			</tr>
	<?php endforeach ?>
	</table>
</div>