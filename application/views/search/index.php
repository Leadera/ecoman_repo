<div class="container">
	<div class="row">
		<div class="col-md-12 ">
			<?php if(!empty($companies)): ?>
				<p class="lead">Companies</p>
			<?php foreach ($companies as $c): ?>
				<div><?php echo $c['name']; ?></div>
				<div><?php echo $c['description']; ?></div>
				<hr>
			<?php endforeach ?>
			<?php endif ?>
			<?php if(!empty($projects)): ?>
			<p class="lead">Projects</p>
			<?php foreach ($projects as $p): ?>
				<div><?php echo $p['name']; ?></div>
				<div><?php echo $p['description']; ?></div>
				<hr>
			<?php endforeach ?>
			<?php endif ?>
		</div>
	</div>
</div>