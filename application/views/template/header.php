<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>CPIS Tool</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- Loading Bootstrap -->
    <link href="<?php echo asset_url('bootstrap/css/bootstrap.css'); ?>" rel="stylesheet">

    <!-- Loading Flat UI -->
    <link href="<?php echo asset_url('css/flat-ui.css'); ?>" rel="stylesheet">
    <link href="<?php echo asset_url('css/custom.css'); ?>" rel="stylesheet">
    <!--<link href="<?php // echo asset_url('css/jquery-ui-1.10.4.custom.css'); ?>" rel="stylesheet"> 

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->
    <script src="<?php echo asset_url('js/jquery-1.10.2.min.js'); ?>"></script>
  </head>
  <body>

  <nav class="navbar navbar-default navbar-lg" role="navigation">
  	<div class="container">
  		<div class="row">
        <div class="col-md-8">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
            <span class="sr-only">Toggle navigation</span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url(); ?>" style="color:white;">CPIS</a>
          <div class="collapse navbar-collapse" id="navbar-collapse-01">
            <ul class="nav navbar-nav">
              <li><a href="<?php echo base_url('projects'); ?>">Projects</a></li>
              <li><a href="<?php echo base_url('company'); ?>">Companies</a></li>
              <li><a href="#fakelink">Forum</a></li>
              <li><a href="#fakelink">Help</a></li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div>
        <div class="col-md-4">
          <form class="navbar-form navbar-right" action="<?php echo base_url('search') ?>" method="post" role="search">
            <div class="form-group">
              <div class="input-group">
                <input name="term" class="form-control" id="navbarInput-01" type="search" placeholder="Search">
                <span class="input-group-btn">
                  <button type="submit" class="btn"><span class="fui-search"></span></button>
                </span>
              </div>
            </div>
          </form>
        </div>
  		</div>

  		<div class="row">
  			<div class="col-md-9">
          <?php
            if ($this->session->userdata('user_in') !== FALSE):
          ?>
  				<ul class="list-inline">
  				  <li class="head-li"><a href="<?php echo base_url('cpscoping'); ?>">CP Scoping</a></li>
  				</ul>
          <?php else: ?>
            <p style="font-size:14px;">
              To use the extended features of this web site, please register.
            </p>
          <?php endif ?>
  			</div>
  			<div class="col-md-3">
  				<ul class="list-inline text-right">
  					<?php
  					  if ($this->session->userdata('user_in') !== FALSE):
                $tmp = $this->session->userdata('user_in');
    				?>
              <li class="head-li"><a href="<?php echo base_url('user/'.$tmp['username']); ?>" style="text-transform: capitalize;"><?php echo $tmp['username']; ?></a></li>
              <li class="head-li"><a href="<?php echo base_url('logout'); ?>">Log Out</a></li>
            <?php else: ?>
  					  <li class="head-li"><a href="<?php echo base_url('login'); ?>">Log In</a></li>
  				  	<li class="head-li"><a href="<?php echo base_url('register'); ?>">Register</a></li>
  					<?php endif ?>
  				</ul>
  			</div>
  		</div>
  	</div>
  </nav><!-- /navbar -->
