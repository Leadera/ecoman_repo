		<div class="col-md-9">
			<?php echo form_open_multipart('new_product/'.$companyID, 'style="overflow:hidden;"'); ?>
				<p class="lead">New Product</p>
				<div class="form-group">
				<div class="form-group">
				    <label for="product">Add Product</label>
				    <input class="form-control" id="product" name="product" placeholder="Enter Product Name">
				</div>
				<button type="submit" class="btn btn-primary pull-right">Add Product</button>
			</form>
			
			<hr>
			<table class="table table-striped table-bordered text-center">
			<tr>
				<td>Number</td>
				<td>Product</td>
				<td>Process</td>
			</tr>
			<?php $count = 1; foreach ($product as $pro): ?>
			<tr>	
				<td><?php echo $count; $count++; ?></td>
				<td><?php echo $pro['name']; ?></td>
				<td><a href="<?php echo base_url('delete_product/'.$companyID.'/'.$pro['id']);?>" class="btn btn-default btn-sm>" value="<?php echo $pro['id']; ?>"><span class="glyphicon glyphicon-remove"></span></button></td>
			</tr>
			<?php endforeach ?>

			</table>
		</div>
	</div>
</div>