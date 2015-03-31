<div class="col-md-4 borderli">
			<p class="lead">Add new product to company</p>
			<?php echo form_open_multipart('new_product/'.$companyID); ?>
				<div class="form-group">
						<label for="product">Add Product <span style="color:red;">*</span></label>
						<input class="form-control" id="product" name="product" placeholder="Enter Product Name">
				</div>				
				<div class="form-group">
					<div class="row">
							<div class="col-md-8">
								<label for="quantities">Quantities</label>
								<input class="form-control" id="quantities" name="quantities" placeholder="Enter Quantities">
							</div>
							<div class="col-md-4">
								<label for="qunit">Quantities Unit</label>
								<select id="qunit" class="info select-block" name="qunit">
									<option value="">Please Select</option>
									<?php foreach ($units as $unit): ?>
										<option value="<?php echo $unit['name']; ?>"><?php echo $unit['name']; ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
					</div>				
				<div class="form-group">
					<div class="row">
						<div class="col-md-8">
							<label for="ucost">Unit Cost</label>
							<input class="form-control" id="ucost" name="ucost" placeholder="Enter Unit Cost">
						</div>
						<div class="col-md-4">
							<label for="ucostu">Unit Cost Unit</label>
							<select id="ucostu" class="info select-block" name="ucostu">
								<option value="">Please Select</option>
								<option value="TL">TL</option>
								<option value="Euro">Euro</option>
								<option value="Dolar">Dolar</option>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="tper">Time Period</label>
					<select id="tper" class="info select-block" name="tper">
						<option value="">Please Select</option>
						<option value="Daily">Daily</option>
						<option value="Weekly">Weekly</option>
						<option value="Monthly">Monthly</option>
						<option value="Annually">Annually</option>
					</select>
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
				<th>Quantities</th>
				<th>Unit Cost</th>
				<th>Time Period</th>
				<th style="width:100px;">Delete</th>
			</tr>
			<?php foreach ($product as $pro): ?>
			<tr>	
				<td><?php echo $pro['name']; ?></td>
				<td><?php if(empty($pro['quantities']) or $pro['quantities'] == 0){echo "";} else {echo $pro['quantities'].' '.$pro['qunit']; } ?></td>
				<td><?php if(empty($pro['ucost']) or $pro['ucost'] == 0){echo "";} else {echo $pro['ucost'].' '.$pro['ucostu']; } ?></td>
				<td><?php echo $pro['tper']; ?></td>
				<td>
				<a href="<?php echo base_url('edit_product/'.$companyID.'/'.$pro['id']);?>" class="label label-warning"><span class="fa fa-edit"></span> Edit</button>
				<a href="<?php echo base_url('delete_product/'.$companyID.'/'.$pro['id']);?>" class="label label-danger"><span class="fa fa-times"></span> Delete</button></td>
			</tr>
			<?php endforeach ?>

			</table>
		</div>
