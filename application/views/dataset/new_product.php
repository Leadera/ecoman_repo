

	<?php echo form_open_multipart('new_product'); ?>

			<div class="col-md-4">
				<div class="form-group">
		    		<label for="product">Product Name</label>
		    		<div>	    			
			    		<select id="product" class="info select-block" name="product">
			  			<?php foreach ($products as $pro): ?>
							<option value="<?php echo $pro['id']; ?>"><?php echo $pro['name']; ?></option>
						<?php endforeach ?>-->
						</select>
					</div>
	 			</div>
	 				<button type="submit" class="btn btn-primary pull-right">Add Product</button>
			</div>
		</div>

	</form>
</div>
