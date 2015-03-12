<?php //print_r($users); ?>
<div class="container">
	<div class="row">
		<div class="col-md-8">
				<p class="lead">Consultants</p>
				<ul class="list-group" style="clear:both;">
				<?php foreach ($users as $com): ?>
					<li class="list-group-item">
						<b><a href="<?php echo base_url('user/'.$com['user_name']) ?>"><?php echo $com['name']; ?> <?php echo $com['surname']; ?></a></b>
						<span style="color:#999999; font-size:12px;"><?php echo $com['description']; ?></span>
					</li>
				<?php endforeach ?>
				</ul>
		</div>	
		<div class="col-md-4">	
		</div>
	</div>
</div>
