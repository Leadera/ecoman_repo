<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="lead pull-left">Show All Projects</div>
			<?php if($is_consultant):?>
			<a class="pull-right btn btn-info btn-embossed btn-sm" href="<?php echo base_url("newproject"); ?>">Create Project</a>
			<?php endif ?>
			<ul class="list-group" style="clear:both;">
			<?php foreach ($projects as $pro): ?>
				<li class="list-group-item">
					<b><a href="<?php echo base_url('project/'.$pro['id']) ?>"><?php echo $pro['name']; ?></a></b>
					<span style="color:#999999; font-size:12px;"><?php echo $pro['description']; ?></span>
				</li>
			<?php endforeach ?>
			</ul>
		</div>	
		<div class="col-md-4">
		</div>
	</div>
</div>
