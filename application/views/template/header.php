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
    <link href="<?php echo asset_url('css/selectize.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo asset_url('css/font-awesome.min.css'); ?>">
    <!--<link href="<?php // echo asset_url('css/jquery-ui-1.10.4.custom.css'); ?>" rel="stylesheet"> 

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->

    <script src="<?php echo asset_url('js/jquery-1.10.2.min.js'); ?>"></script>
    <script src="<?php echo asset_url('js/bootstrap.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset_url('is/jquery.easyui.min.js'); ?>"></script>
    <!--[if lt IE 9]><script src="http://cdnjs.cloudflare.com/ajax/libs/es5-shim/2.0.8/es5-shim.min.js"></script><![endif]-->
    <?php if($this->uri->segment(1)!="isscoping" and $this->uri->segment(1)!="isscopingauto" 
            and $this->uri->segment(1)!="isScopingAutoPrjBase" 
            and $this->uri->segment(1)!="isScopingAutoPrjBaseMDF" 
            and $this->uri->segment(1)!="isScopingPrjBaseMDF" 
            and $this->uri->segment(1)!="isScopingPrjBase" 
            and $this->uri->segment(1)!="scenarios"
            and $this->uri->segment(1)!="cost_benefit"
            and $this->uri->segment(1)!="kpi_calculation"): ?>
      <script src="<?php echo asset_url('js/selectize.min.js'); ?>"></script>
      <script type="text/javascript">
        $(function() {
          $('#selectize').selectize({
            create: true,
            sortField: 'text'
          });
          //$( "select" ).selectize();
        });
      </script>
    <?php endif ?>

    <!-- font -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,400italic,500italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
  </head>
  <body <?php /*if($this->uri->segment(1)=="isscoping" or $this->uri->segment(1)=="isscopingauto"){echo 'class="easyui-layout"';}*/ ?>>

    <nav class="navbar navbar-default navbar-lg" style="margin-bottom:0px;">
      <a class="navbar-brand" href="<?php echo base_url(); ?>" style="color:white;">ECOMAN</a>
      
      <form class="navbar-form navbar-left" action="<?php echo base_url('search') ?>" method="post" role="search" style="display: table;">
        <div class="form-group">
          <div class="input-group" style="display:block;">
            <input name="term" class="form-control" id="navbarInput-01" type="search" placeholder="Search">
            <span class="input-group-btn">
              <button type="submit" class="btn"><span class="fui-search"></span></button>
            </span>
          </div>
        </div>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <?php
          //print_r($this->session->userdata('user_in'));
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
    <div style="background-color: rgb(240, 240, 240); margin-bottom: 20px;">
      <ul class="nav navbar-nav navbar-left">
          <li>

          <div class="dropdown">
            <button style="font-size: 16px;padding: 15px 21px;line-height: 23px;font-weight: 400;" class="btn btn-link dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
              <i class="fa fa-globe"></i> Projects
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu dropdown-inverse" role="menu" aria-labelledby="dropdownMenu1" style="padding:13px;">
              <?php if ($this->session->userdata('user_in') !== FALSE): ?>
                <li><a style="color:white;" href="<?php echo base_url('myprojects'); ?>">My Projects</a></li>
              <?php endif ?>
              <li><a style="color:white;" href="<?php echo base_url('projects'); ?>">All Projects</a></li>
            </ul>
          </div>
          </li>
        <li>
          <div class="dropdown">
            <button style="font-size: 16px;padding: 15px 21px;line-height: 23px;font-weight: 400;" class="btn btn-link dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
              <i class="fa fa-user"></i> Members
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu dropdown-inverse" role="menu" aria-labelledby="dropdownMenu1" style="padding:13px;">
              <li><a style="color:white;" href="<?php echo base_url('companies'); ?>"><i class="fa fa-building-o"></i> All Companies</a></li>
              <?php if ($this->session->userdata('user_in') !== FALSE): ?>
                <li><a style="color:white;" href="<?php echo base_url('mycompanies'); ?>"><i class="fa fa-building-o"></i> My Companies</a></li>
                <?php if($this->session->userdata('project_id') !== FALSE): ?>
                  <li><a style="color:white;" href="<?php echo base_url('projectcompanies'); ?>"><i class="fa fa-building-o"></i> Project Companies</a></li>
                <?php endif ?>
              <?php endif ?>
              <li><a style="color:white;" href="<?php echo base_url('users'); ?>"><i class="fa fa-group"></i> Consultants</a></li>
            </ul>
          </div>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo base_url('whatwedo'); ?>"><i class="fa fa-question-circle"></i> What We Do</a></li>
        <li><a href="<?php echo base_url('functionalities'); ?>"><i class="fa fa-dashboard"></i> Functionalities</a></li>
        <li><a href="<?php echo base_url('contactus'); ?>"><i class="fa fa-envelope"></i> Contact Us</a></li>
      </ul>
      <div class="clearfix"></div>
      </div>
      <?php if ($this->session->userdata('user_in') !== FALSE): ?>
        <div style=" padding: 10px 20px; margin-bottom: 20px; margin-top:-20px; border-top:1px solid #d0d0d0; border-bottom:1px solid #d0d0d0;">
        <?php if($this->session->userdata('project_id') !== FALSE): ?>
          

          <div class="">
        <ul class="list-inline pull-left" style="margin:0px;">
          <li class="head-li"><a href="<?php echo base_url('cpscoping'); ?>"><i class="fa fa-bar-chart"></i> Cleaner Production Allocations</a></li>
          <li class="head-li">
            <div class="dropdown">
              <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                <i class="fa fa-sitemap"></i> Industrial Symbiosis Allocations
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu dropdown-inverse" role="menu" aria-labelledby="dropdownMenu1">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('isScopingPrjBase'); ?>">Manual IS</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('isScopingAutoPrjBase'); ?>">Automated IS</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('isScopingPrjBaseMDF'); ?>">Manual IS(New Company/Flow Grid)</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('isScopingAutoPrjBaseMDF'); ?>">Automated IS(New Company/Flow Grid)</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('isscenarios'); ?>">IS Scenarios</a></li>
              </ul>
            </div>
          </li>
        </ul>
        <ul class="list-inline pull-right" style="margin: 8px 0 8px 0;">
          <li class="head-li">You are working on a project named: <a href="<?php echo base_url('project/'.$this->session->userdata('project_id')); ?>"><?php echo $this->session->userdata('project_name'); ?></a>
          </li>
          <li class="head-li"><a href="<?php echo base_url('closeproject'); ?>"><i class="fa fa-times-circle"></i> Close this project</a></li>
        </ul>
        </div>
        <?php else: ?>
          <ul class="list-inline" style="margin:0px;">
            <li class="head-li"><a href="<?php echo base_url('openproject'); ?>"><i class="fa fa-plus-square-o"></i> Open a Project</a></li>
          </ul>
        <?php endif ?>
        <div class="clearfix"></div>
      </div>
    <?php else: ?>
      <!-- <p style="font-size:14px; margin:0px;">
        To use the extended features of this web site, please register.
      </p> -->
    <?php endif ?>
    