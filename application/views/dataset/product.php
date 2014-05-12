<div class="col-md-9 sagbar">
	
	<div class="row">
		<div class="col-md-6"><div class="altbaslik">Manage products</div></div>
		<div class="col-md-6"><?php echo anchor('product/new_product', 'New product', 'class="btn btn-primary pull-right"'); ?></div>			
	</div>
	
	<table class="table table-bordered table-hover" style="margin-top:20px;">
	<tr>
		<th>ID</th>
		<th>Product name</th>		
		<th>Product type</th>
		<th>Quantity</th>
		<th>Product unit</th>
		<th>Product description</th>
	</tr>
	<?php foreach ($product_list as $product): ?>
			<tr>
				<td><?php echo $product['id']; ?></td>
				<td><?php echo $product['name']; ?></td>
				<td><?php echo $product['type']; ?></td>
				<td><?php echo $product['quantity']; ?></td>
				<td><?php echo $product['unit']; ?></td>
				<td><?php echo $product['description']; ?></td>
			</tr>
	<?php endforeach ?>
	</table>

</div>