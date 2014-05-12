<div class="col-md-9 sagbar">
	
	<div class="row">
		<div class="col-md-6"><div class="altbaslik">Flows and components</div></div>
		<div class="col-md-6">
			<?php echo anchor('flow_and_component/new_flow', 'New flow', 'class="btn btn-primary pull-right" style="margin-left:10px;"'); ?>
			<?php echo anchor('flow_and_component/new_component', 'New component', 'class="btn btn-primary pull-right"'); ?>
		</div>			
	</div>
	
	<table class="table table-bordered table-hover" style="margin-top:20px;">
	<tr><th colspan="5">Flows</th></tr>
	<tr>
		<th>ID</th>
		<th>Flow name</th>		
		<th>Environmental impact</th>
		<th>flow cost</th>
		<th>Flow amount</th>
	</tr>
	<?php foreach ($flow_list as $flow): ?>
			<tr>
				<td><?php echo $flow['id']; ?></td>
				<td><?php echo $flow['name']; ?></td>
				<td><?php echo $flow['ei']; ?></td>
				<td><?php echo $flow['cost']; ?></td>
				<td><?php echo $flow['amount']; ?></td>
			</tr>
	<?php endforeach ?>
	</table>

	<table class="table table-bordered table-hover" style="margin-top:20px;">
	<tr><th colspan="5">Components</th></tr>
	<tr>
		<th>ID</th>
		<th>Component name</th>		
	</tr>
	<?php foreach ($component_list as $component): ?>
			<tr>
				<td><?php echo $component['id']; ?></td>
				<td><?php echo $component['name']; ?></td>
			</tr>
	<?php endforeach ?>
	</table>
</div>