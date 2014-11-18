<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>CPIS Tool</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- Loading Bootstrap -->
    <link href="<?php echo asset_url('bootstrap/css/bootstrap.css'); ?>" rel="stylesheet">

    <!-- Loading Flat UI -->
    <link rel="stylesheet" href="<?php echo asset_url('themes/default/easyui.css') ?>">
    <link rel="stylesheet" href="<?php echo asset_url('themes/icon.css') ?>">
    <link rel="stylesheet" href="<?php echo asset_url('themes/demo.css') ?>">
    <link href="<?php echo asset_url('css/flat-ui.css'); ?>" rel="stylesheet">
    <link href="<?php echo asset_url('css/custom.css'); ?>" rel="stylesheet">
    <link href="<?php echo asset_url('css/selectize.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo asset_url('css/font-awesome.min.css'); ?>">
    <!--<link href="<?php // echo asset_url('css/jquery-ui-1.10.4.custom.css'); ?>" rel="stylesheet"> 

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->

    <script src="<?php echo asset_url('js/jquery-1.10.2.min.js'); ?>"></script>
    <!--[if lt IE 9]><script src="http://cdnjs.cloudflare.com/ajax/libs/es5-shim/2.0.8/es5-shim.min.js"></script><![endif]-->
    <script src="<?php echo asset_url('js/selectize.min.js'); ?>"></script>
    <script type="text/javascript">
    $(function() {
      $('#selectize').selectize({
        create: true,
        sortField: 'text'
      });
    });
    </script>
  </head>
  <body>

    <nav class="navbar navbar-default navbar-lg" style="margin-bottom:0px;">
      <a class="navbar-brand" href="<?php echo base_url(); ?>" style="color:white;">ECOMAN</a>
      <ul class="nav navbar-nav navbar-left">
        <li><a href="<?php echo base_url('projects'); ?>"><i class="fa fa-globe"></i> Projects</a></li>
        <li><a href="<?php echo base_url('company'); ?>"><i class="fa fa-building-o"></i> Companies</a></li>
      </ul>
      <form class="navbar-form navbar-left" action="<?php echo base_url('search') ?>" method="post" role="search">
        <div class="form-group">
          <div class="input-group">
            <input name="term" class="form-control" id="navbarInput-01" type="search" placeholder="Search">
            <span class="input-group-btn">
              <button type="submit" class="btn"><span class="fui-search"></span></button>
            </span>
          </div>
        </div>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <?php
          if ($this->session->userdata('user_in') !== FALSE):
            $tmp = $this->session->userdata('user_in');
        ?>
          <li class="head-li"><a href="<?php echo base_url('user/'.$tmp['username']); ?>" style="text-transform: capitalize;"><i class="fa fa-user"></i>
 <?php echo $tmp['username']; ?></a></li>
          <li class="head-li"><a href="<?php echo base_url('logout'); ?>"><i class="fa fa-sign-out"></i>
 Logout</a></li>
        <?php else: ?>
          <li class="head-li"><a href="<?php echo base_url('login'); ?>"><i class="fa fa-sign-in"></i>
 Login</a></li>
          <li class="head-li"><a href="<?php echo base_url('register'); ?>">Register</a></li>
        <?php endif ?>
      </ul>
    </nav>
    <div style="background-color: rgb(240, 240, 240); padding: 10px 20px; margin-bottom: 40px;">
      <?php if ($this->session->userdata('user_in') !== FALSE): ?>
        <ul class="list-inline" style="margin:0px;">
          <li class="head-li"><a href="<?php echo base_url('cpscoping'); ?>"><i class="fa fa-bar-chart"></i> Cleaner Production Allocations</a></li>
        </ul>
      <?php else: ?>
        <p style="font-size:14px; margin:0px;">
          To use the extended features of this web site, please register.
        </p>
      <?php endif ?>
    </div>