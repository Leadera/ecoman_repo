<div class="col-md-4 borderli">
			<p class="lead">Add new product to company</p>
			<?php echo form_open_multipart('new_product/'.$companyID); ?>
				<div class="form-group">
				    <label for="product">Add Product <span style="color:red;">*</span></label>
				    <input class="form-control" id="product" name="product" placeholder="Enter Product Name">
				</div>
				<button type="submit" class="btn btn-info">Add Product</button>
			</form>
			<span class="label label-default"><span style="color:red;">*</span> labels are required.</span>

			
			</div>
			<div class="col-md-8">
			<p class="lead">Company products</p>
			<table class="table table-striped table-bordered">
			<tr>
				<th>Product</th>
				<th style="width:100px;">Delete</th>
			</tr>
			<?php foreach ($product as $pro): ?>
			<tr>	
				<td><?php echo $pro['name']; ?></td>
				<td><a href="<?php echo base_url('delete_product/'.$companyID.'/'.$pro['id']);?>" class="label label-danger" value="<?php echo $pro['id']; ?>"><span class="fa fa-times"></span> Delete</button></td>
			</tr>
			<?php endforeach ?>

			</table>
		</div>
