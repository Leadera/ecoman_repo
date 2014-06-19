<div class="container">
	<div class="row">
		<div class="col-md-9">
			<div style="overflow:hidden; margin-bottom: 10px;">
				<?php  if($userInfo['id']==$this->session->userdata('user_in')['id']): ?>
		  	<a style="margin-left:10px;" class="btn btn-info btn-sm pull-right" href="<?php echo base_url("profile_update"); ?>">Update User Info</a>
		  	<a class="btn btn-default btn-sm pull-right" href="<?php echo base_url('send_email_for_change_pass'); ?>" style="text-transform: capitalize;">Change Password</a>
		  	<?php endif ?>
		  	<?php if($userInfo['role_id']=='2'): ?>
		  	<a class="btn btn-success btn-sm pull-right" style="margin-right:15px;" href="<?php echo base_url("become_consultant"); ?>">Become a Consultant</a>
		  	<?php endif ?>
		  	<?php if($userInfo['role_id']=="1"): ?>
		  	<div class="label label-default">This user is a consultant</div>
		  	<?php endif ?>
		  </div>
			<div class="lead" style="margin: 15px 0;"><?php echo $userInfo["name"].' '.$userInfo["surname"].' Profile'; ?></div>
			<table class="table table-striped table-bordered">
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
			<?php if(file_exists("assets/user_pictures/".$userInfo['photo'])): ?>
				<img class="img-responsive thumbnail" src="<?php echo asset_url("user_pictures/".$userInfo['photo']); ?>">
			<?php else: ?>
				<img class="img-responsive thumbnail" src="<?php echo asset_url("user_pictures/default.jpg"); ?>">
			<?php endif ?>
			<ul class="nav nav-list">
					<li class="nav-header" style="font-size:15px;">Projects As a Contact Person</li>
			<?php foreach ($projectsAsWorker as $prj): ?>
					<li><a style="text-transform:capitalize;" href="<?php echo base_url('project/'.$prj["proje_id"]) ?>"><?php echo $prj["name"] ?></a></li>
			<?php endforeach ?>
			</ul>
			<?php if($userInfo['role_id']==1): ?>
			<ul class="nav nav-list">
					<li class="nav-header" style="font-size:15px;">Projects As a Consultant</li>
			<?php foreach ($projectsAsConsultant as $prj): ?>
					<li><a style="text-transform:capitalize;" href="<?php echo base_url('project/'.$prj["proje_id"]) ?>"><?php echo $prj["name"] ?></a></li>
			<?php endforeach ?>
			</ul>
			<?php endif ?>
		</div>
	</div>
</div>
