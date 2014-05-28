<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="lead pull-left">Show All Companies</div>
			<a class="pull-right btn btn-info btn-embossed btn-sm" href="<?php echo base_url("newcompany"); ?>">Create a Company</a>

			<ul class="list-group" style="clear:both;">
			<?php foreach ($companies as $com): ?>
				<li class="list-group-item">
					<b><a href="<?php echo base_url('company/'.$com['id']) ?>"><?php echo $com['name']; ?></a></b>
					<span style="color:#999999; font-size:12px;"><?php echo $com['description']; ?></span>
				</li>
			<?php endforeach ?>
			</ul>
		</div>	
		<div class="col-md-4">
		</div>
	</div>
</div>
