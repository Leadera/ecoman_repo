		<div class="col-md-9">
			<p class="lead">Add new product</p>
			<?php echo form_open_multipart('new_product/'.$companyID); ?>
				<div class="form-group">
				    <label for="product">Add Product</label>
				    <input class="form-control" id="product" name="product" placeholder="Enter Product Name">
				</div>
				<button type="submit" class="btn btn-info">Add Product</button>
			</form>
			
			<hr>
			<table class="table table-striped table-bordered">
			<tr>
				<th>Product</th>
				<th style="width:100px;">Delete</th>
			</tr>
			<?php foreach ($product as $pro): ?>
			<tr>	
				<td><?php echo $pro['name']; ?></td>
				<td><a href="<?php echo base_url('delete_product/'.$companyID.'/'.$pro['id']);?>" class="btn btn-danger btn-sm" value="<?php echo $pro['id']; ?>"><span class="glyphicon glyphicon-remove"></span></button></td>
			</tr>
			<?php endforeach ?>

			</table>
		</div>
	</div>
</div>