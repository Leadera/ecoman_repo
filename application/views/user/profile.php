<div class="container">
	<div class="row">
		<div class="col-md-9">
			<div class="lead pull-left"><?php echo $userInfo["name"].' '.$userInfo["surname"].' Profile'; ?></div>
		  	<a class="btn btn-info btn-embossed btn-sm pull-right" href="<?php echo base_url("profile_update"); ?>">Update User Info</a>
		  	<?php if($userInfo['role_id']==null): ?>
		  	<a class="btn btn-success btn-embossed btn-sm pull-right" style="margin-right:15px;" href="<?php echo base_url("become_consultant"); ?>">Becoman a Consultant</a>
		  	<?php endif ?>
		  	<?php if($userInfo['role_id']=="1"): ?>
		  	<div class="label label-success" style="margin-left:15px;">This user is a consultant</div>
		  	<?php endif ?>
			<table class="table table-striped table-bordered text-center">
				<tr>
					<td>
					User Info
					</td>
					<td>
						<div><?php echo $userInfo['description']; ?></div>
					</td>
				</tr>
				<tr>
					<td>
					E-mail
					</td>
					<td>
					<?php echo $userInfo['email']; ?>
					</td>
				</tr>
				<tr>
					<td>
					Cell Phone
					</td>
					<td>
					<?php echo $userInfo['phone_num_1']; ?>
					</td>
				</tr>
				<tr>
					<td>
					Work Phone
					</td>
					<td>
					<?php echo $userInfo['phone_num_2']; ?>
					</td>
				</tr>
				<tr>
					<td>
					Fax Phone
					</td>
					<td>
					<?php echo $userInfo['fax_num']; ?>
					</td>
				</tr>
			</table>
		</div>
		<div class="col-md-3">
			<img class="img-responsive thumbnail" src="<?php echo asset_url("user_pictures/".$userInfo['photo']); ?>">
			<ul class="nav nav-list">
					<li class="nav-header" style="font-size:15px;">Projects</li>
			<?php foreach ($projects as $prj): ?>
					<li><a style="text-transform:capitalize;" href="<?php echo base_url('project/'.$prj["proje_id"]) ?>"><?php echo $prj["name"] ?></a></li>
			<?php endforeach ?>
			</ul>
		</div>
	</div>
</div>
