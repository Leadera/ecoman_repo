<div class="col-md-8">
	<p>Cost - Benefit Analysis</p>
	<?php if (!empty($allocation)): ?>
			<?php $i=1; ?>
			<?php foreach ($allocation as $a): ?>
				<?php echo form_open('cost-benefit'); ?>
				<table class="table table-bordered">
					<tr>
						<td>#</td><td><?php echo $i; ?> (<?php echo $a['allocation_id']; ?>)</td>
					</tr>
					<tr>
						<td width="250">Option</td>
						<td style="widtd:250px;"><b><?php echo $a['prcss_name']; ?></b> <small class="text-muted"><?php echo $a['flow_name']; ?>-<?php echo $a['flow_type_name']; ?></small><br><span class="text-info"><?php echo $a['best']; ?></span></td>
					</tr>
						<tr><td>CAPEX old option (€)</td>								
						<td><input type="text" name="capexold" class="form-control"></td>

						</tr><tr><td>OPEX old option (€)</td>								<td><input type="text" name="opexold" class="form-control"></td>

						</tr><tr><td>Lifetime old option (yr)</td>								<td><input type="text" name="ltold" class="form-control"></td>

						</tr><tr><td>CAPEX new option (€)</td>								<td><input type="text" name="capexnew" class="form-control"></td>

						</tr><tr><td>OPEX new option (€)</td>								<td><input type="text" name="opexnew" class="form-control"></td>

						</tr><tr><td>Lifetime new option (yr)</td>								<td><input type="text" name="ltnew" class="form-control"></td>

						</tr><tr><td>Discount rate (%)</td>								<td><input type="text" name="disrate" class="form-control"></td>

						</tr><tr><td>Ann. costs old option</td>								<td><input type="text" name="acold" class="form-control"></td>

						</tr><tr><td>Ann. costs new option</td>								<td><input type="text" name="acnew" class="form-control"></td>

						</tr><tr><td>Economic Cost/Benefit</td>								<td><input type="text" name="eco" class="form-control"></td>

						</tr><tr><td>Unit</td>								<td><input type="text" name="unit" class="form-control"></td>

						</tr>
						<tr>
							<td>Old Consumption</td><td><input type="text" name="oldcons" class="form-control" value="<?php echo $a['qntty']; ?>"></td>
						</tr>
						<tr>
							<td>Old Total Cost</td><td><input type="text" name="oldcons" class="form-control" value="<?php echo $a['cost']; ?>"></td>
						</tr>
						<tr>
							<td>Old Total EP</td><td><input type="text" name="oldcons" class="form-control" value="<?php echo $a['ep']; ?>"></td>
						</tr>
						<tr><td>Estimated new consumption</td>								<td><input type="text" name="newcons" class="form-control"></td>

						</tr>
						<tr>
							<td>Unit</td>
							<td><?php echo $a['qntty_unit']; ?>/year</td>
						</tr>
						<tr><td>€/ Unit</td>								<td><input type="text" name="eipunit" class="form-control"></td>

						</tr><tr><td>EIP/ Unit</td>								<td><input type="text" name="eipunit" class="form-control"></td>

						</tr><tr><td>Ecological Benefit</td>								<td><input type="text" name="ecoben" class="form-control"></td>

						</tr><tr><td>Unit</td><td>EIP/year</td>

						</tr><tr><td>Marginal costs</td>								<td><input type="text" name="marcos" class="form-control"></td>

						</tr><tr><td>Unit</td><td>¢/EIP</td>

						</tr><tr><td>Save</td>

								<td><input type="submit" value="Save" class="btn"/></td>

					</tr>
				</table>
				<hr>
				<?php $i++; ?>
				</form>
			<?php endforeach ?>
		<?php endif ?>
</div>
<div class="col-md-4">
	Graph
</div>







