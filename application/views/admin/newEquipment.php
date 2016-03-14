<?php  ?>
<script>
    var treeValue;
    var parentnode;
    var notroot;
    var treeNodeId;
    function submitFormEquipment(){  
            console.log($('#equipmentFamily').val()); 
            $.ajax({
                url: '../../../../slim2_ecoman_admin/index.php/insertEquipment',
                type: 'POST',
                dataType : 'json',
                //data: { equipment:$('#equipmentFamily').val(),root2:'root',test:'parentnode'},
                data: 'equipment='+$('#equipmentFamily').val()+'&notroot='+notroot+'&parentnode='+treeNodeId+'',
                success: function(data, textStatus, jqXHR) {
                  console.warn('success text status-->'+textStatus);
                  if(data["found"]==true) {
                      //$.messager.alert('Success','Success inserted Flow family!','info');
                      if(data["id"]>0) {
                          noty({text: 'Equipment inserted succesfully', type: 'success'});
                          $('#tt_tree_equipment').tree('reload');
                      } else {
                          noty({text: 'Equipment has been inserted before, please enter another Equipment', type: 'warning'});
                          $('#tt_tree_equipment').tree('reload');
                      }
                  } else if(data["found"]==false) {         
                      //$.messager.alert('Insert failed','Failed to insert Equipment !','error');
                      noty({text: 'Equipment could not be  inserted ', type: 'error'});  
                      $('#tt_tree_equipment').tree('reload');
                  }   
                },
                error: function(jqXHR , textStatus, errorThrown) {
                  //console.warn('error text status-->'+textStatus);
                  noty({text: 'Equipment could not be  inserted ', type: 'error'});  
                }
            });
        }
    
    
    jQuery(document).ready(function() { 
 
          $('#tt_tree_equipment').tree({
                url: '../../../../Proxy/SlimProxyAdmin.php',
                queryParams : { url:'equipments' },
                method:'get',
                animate:true,
                checkbox:false,
                cascadeCheck:false
            });
            
        $("#tt_tree_equipment").tree({
                    onClick: function(node){
                    notroot = node.attributes.notroot;
                    //treeNodeId = node.id;
                    /*console.log(node.attributes.notroot);
                    console.log(root);
                    console.log(node.id);
                    console.log(treeNodeId);*/
                    if(notroot==true) {
                        console.log('not root bulundu');
                        parentnode=$("#tt_tree_equipment").tree("getParent", node.target);
                        treeNodeId = parentnode.id;
                        console.log(parentnode.text);
                        $('#infoLegend').html('Equipment will be inserted under "'+parentnode.text+'" category');
                    } else {
                        console.log('root bulundu');
                        //var parentnode=$("#tt_tree_equipment").tree("getParent", node.target);
                        parentnode=null;
                        treeNodeId = null;
                        //console.log(parentnode.text);
                        //$('#infoLegend').html('Equipment will be inserted under "'+node.text+'" category');
                        $('#infoLegend').html('Equipment will be inserted to root level');
                    }
                    
                },
                onDblClick: function(node){
                    /*root = node.attributes.notroot;
                    treeNodeId = node.id;
                    console.log(node.attributes.notroot);
                    console.log(root);
                    console.log(node.id);
                    console.log(treeNodeId);
                    $('#infoLegend').html('Equipment will be inserted under "'+node.text+'" category');*/
                }
            });
            
            $.ajax({
                url: '../../../../Proxy/SlimProxyAdmin.php',
                type: 'GET',
                dataType : 'json',
                data: { url:'totalProjects' },
                success: function(data, textStatus, jqXHR) {
                  console.warn('success text status-->'+textStatus);
                  //console.warn(data);
                  $('#totalProjects').html(data['totalProjects']);
                }
            }); 
            
            $.ajax({
                //url: '../slim_2/index.php/columnflows_json_test',
                url: '../../../../Proxy/SlimProxyAdmin.php',
                type: 'GET',
                dataType : 'json',
                data: { url:'totalUsers' },
                success: function(data, textStatus, jqXHR) {
                  console.warn('success text status-->'+textStatus);
                  //console.warn(data);
                  $('#totalUsers').html(data['totalUsers']);
                }
            }); 
            
            $.ajax({
                //url: '../slim_2/index.php/columnflows_json_test',
                url: '../../../../Proxy/SlimProxyAdmin.php',
                type: 'GET',
                dataType : 'json',
                data: { url:'totalISProjects' },
                success: function(data, textStatus, jqXHR) {
                  console.warn('success text status-->'+textStatus);
                  //console.warn(data);
                  $('#totalISProjects').html(data['totalISProjects']);
                }
            });
            
            $.ajax({
                //url: '../slim_2/index.php/columnflows_json_test',
                url: '../../../../Proxy/SlimProxyAdmin.php',
                type: 'GET',
                dataType : 'json',
                data: { url:'totalProducts' },
                success: function(data, textStatus, jqXHR) {
                  console.warn('success text status-->'+textStatus);
                  //console.warn(data);
                  $('#totalProducts').html(data['totalProducts']);
                }
            });
            
            
                    
             
        });
    
    
</script>

<!-- topbar starts -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href=""> <img style="height: 60px;width: 164px;" alt="CELERO logo" src="../assets/images/anasayfa.png" /> <span>CELERO</span></a>
				
				<!-- theme selector starts -->
				<div class="btn-group pull-right theme-container" > 
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-tint"></i><span class="hidden-phone"> Change Theme/ Skin</span>
						<span class="caret"></span> 
					</a>
					<ul class="dropdown-menu" id="themes">
						<li><a data-value="classic" href="#"><i class="icon-blank"></i>Classic</a></li>
						<li><a data-value="cerulean" href="#"><i class="icon-blank"></i>Cerulean</a></li>
						<li><a data-value="cyborg" href="#"><i class="icon-blank"></i>Cyborg</a></li>
						<li><a data-value="redy" href="#"><i class="icon-blank"></i>Redy</a></li>
						<li><a data-value="journal" href="#"><i class="icon-blank"></i>Journal</a></li>
						<li><a data-value="simplex" href="#"><i class="icon-blank"></i>Simplex</a></li>
						<li><a data-value="slate" href="#"><i class="icon-blank"></i>Slate</a></li>
						<li><a data-value="spacelab" href="#"><i class="icon-blank"></i>Spacelab</a></li>
						<li><a data-value="united" href="#"><i class="icon-blank"></i>United</a></li>
					</ul>
				</div>
				<!-- theme selector ends -->
				
				<!-- user dropdown starts -->
				<div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i><span class="hidden-phone"> <?php echo $userName;  ?></span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="#">Profile</a></li>
						<li class="divider"></li>
						<li><a href="../logout">Logout</a></li>
					</ul>
				</div>
				<!-- user dropdown ends -->
				
				<div class="top-nav nav-collapse">
					<ul class="nav">
						<li><a href="../../ecoman">Main Page</a></li>
						<li>
							<form class="navbar-search pull-left">
								<input placeholder="Search" class="search-query span2" name="query" type="text">
							</form>
						</li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>
	<!-- topbar ends -->
		<div class="container-fluid">
		<div class="row-fluid">
				
			<!-- left menu starts -->
			<div class="span2 main-menu-span">
				<div class="well nav-collapse sidebar-nav">
					 <ul class="nav nav-tabs nav-stacked main-menu">
                                            <li class="nav-header hidden-tablet">Admin Menu</li>
                                            <li><a class="ajax-link" href="<?php echo base_url('admin/newFlow'); ?>"><i class="icon-edit"></i><span class="hidden-tablet">Flows</span></a></li>
                                            <li><a class="ajax-link" href="<?php echo base_url('admin/newProcess'); ?>"><i class="icon-edit"></i><span class="hidden-tablet">Processes</span></a></li>
                                            <li><a class="ajax-link" href="<?php echo base_url('admin/newEquipment'); ?>"><i class="icon-edit"></i><span class="hidden-tablet">Equipments</span></a></li>
                                            <li><a class="ajax-link" href="<?php echo base_url('admin/industrialZones'); ?>"><i class="icon-edit"></i><span class="hidden-tablet">Industrial Zones</span></a></li>
                                            <li><a class="ajax-link" href="<?php echo base_url('admin/clusters'); ?>"><i class="icon-edit"></i><span class="hidden-tablet">Clusters</span></a></li>
                                            <li><a class="ajax-link" href="<?php echo base_url('admin/employees'); ?>"><i class="icon-edit"></i><span class="hidden-tablet">Cluster Emp.</span></a></li>
                                            <li><a class="ajax-link" href="<?php echo base_url('admin/consultants'); ?>"><i class="icon-edit"></i><span class="hidden-tablet">Ind. Zone Consultants</span></a></li>
                                            <li><a class="ajax-link" href="<?php echo base_url('admin/newEquipment'); ?>"><i class="icon-edit"></i><span class="hidden-tablet">Equipments</span></a></li>
                                            <li><a class="ajax-link" href="<?php echo base_url('admin/reports'); ?>"><i class="icon-edit"></i><span class="hidden-tablet">Reports</span></a></li>

                                    </ul>
                                    
                                    
                                    <ul class="nav nav-tabs nav-stacked main-menu">
                                            <li class="nav-header hidden-tablet">Main Menu</li>
                                            <li><a class="ajax-link" href="<?php echo base_url(); ?>"><i class="icon-home"></i><span class="hidden-tablet"> Main Page</span></a></li>

                                            <li><a class="ajax-link" href="<?php echo base_url('users'); ?>"><i class="icon-user"></i><span class="hidden-tablet">Consultants</span></a></li>
                                            <li><a class="ajax-link" href="<?php echo base_url('user'); ?>/<?php echo $userName; ?>"><i class="icon-user"></i><span class="hidden-tablet">My Profile</span></a></li>
                                            <li><a class="ajax-link" href="<?php echo base_url('profile_update'); ?>"><i class="icon-edit"></i><span class="hidden-tablet">Edit Profile</span></a></li>


                                            <li><a class="ajax-link" href="<?php echo base_url('mycompanies'); ?>"><i class="icon-calendar"></i><span class="hidden-tablet">My Companies</span></a></li>
                                            <li><a class="ajax-link" href="<?php echo base_url('projectcompanies'); ?>"><i class="icon-calendar"></i><span class="hidden-tablet">Project Companies</span></a></li>
                                            <li><a class="ajax-link" href="<?php echo base_url('companies'); ?>"><i class="icon-calendar"></i><span class="hidden-tablet">All Companies</span></a></li>
                                            <li><a class="ajax-link" href="<?php echo base_url('newcompany'); ?>"><i class="icon-edit"></i><span class="hidden-tablet">Create Company</span></a></li>


                                            <li><a class="ajax-link" href="<?php echo base_url('myprojects'); ?>"><i class="icon-globe"></i><span class="hidden-tablet">My Projects</span></a></li>
                                            <li><a class="ajax-link" href="<?php echo base_url('projects'); ?>"><i class="icon-globe"></i><span class="hidden-tablet">All Projects</span></a></li>
                                            <li><a class="ajax-link" href="<?php echo base_url('newproject'); ?>"><i class="icon-edit"></i><span class="hidden-tablet">Create Project</span></a></li>


                                            <li><a class="ajax-link" href="<?php echo base_url('cpscoping'); ?>"><i class="icon-th"></i><span class="hidden-tablet">CP-Potential Identiification</span></a></li>
                                            <li><a class="ajax-link" href="<?php echo base_url('cost_benefit'); ?>"><i class="icon-th"></i><span class="hidden-tablet"> Cost-Benefit</span></a></li>
                                            <li><a class="ajax-link" href="<?php echo base_url('ecotracking'); ?>"><i class="icon-th"></i><span class="hidden-tablet"> Eco-Tracking</span></a></li>


                                            <li><a class="ajax-link" href="<?php echo base_url('logout'); ?>"><i class="icon-ban-circle"></i><span class="hidden-tablet"> Log Out</span></a></li>
                                            <!--<li><a class="ajax-link" href="#"><i class="icon-font"></i><span class="hidden-tablet">Logs</span></a></li>
                                            <li><a class="ajax-link" href="#"><i class="icon-picture"></i><span class="hidden-tablet"> Admin Reports</span></a></li>
                                            <li class="nav-header hidden-tablet">Secondary Menu</li>
                                            <li><a class="ajax-link" href="#"><i class="icon-align-justify"></i><span class="hidden-tablet"> Users, Roles and Privileges</span></a></li>
                                            <li><a class="ajax-link" href="#"><i class="icon-calendar"></i><span class="hidden-tablet"> Companies</span></a></li>
                                            <li><a class="ajax-link" href="#"><i class="icon-th"></i><span class="hidden-tablet">Projects</span></a></li>
                                            <li><a href="#"><i class="icon-globe"></i><span class="hidden-tablet">Configurations</span></a></li>
                                            <li><a class="ajax-link" href="#"><i class="icon-star"></i><span class="hidden-tablet"> Access Logs</span></a></li>
                                            <li><a href="#"><i class="icon-ban-circle"></i><span class="hidden-tablet"> Error Logs</span></a></li>-->

                                    </ul>
					<!--<label id="for-is-ajax" class="hidden-tablet" for="is-ajax"><input id="is-ajax" type="checkbox">Ajax Menü</label>-->
				</div><!--/.well -->
			</div><!--/span-->
			<!-- left menu ends -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
			<!-- content starts -->
			

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Main Page</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Equipments</a>
					</li>
				</ul>
			</div>
                        
                        
                        
                        
                        
			<div class="sortable row-fluid">
                            <a  id='toplam_anket_link' data-rel="" title="" class="well span3 top-block" href="#">
					<span class="icon32 icon-red icon-user"></span>
					<div>Total users count</div>
					<div id='totalUsers'></div>
					<span id ='totalUsers_by_today' class="notification"></span>
				</a>

				<a data-rel="tooltip" title=" new pro members." class="well span3 top-block" href="#">
					<span class="icon32 icon-color icon-inbox"></span>
					<div>Total projects count</div>
					<div id='totalProjects'></div>
					<span id='totalProjects_by_today' class="notification green">4</span>
				</a>

				<a data-rel="tooltip" title="$34 new sales." class="well span3 top-block" href="#">
					<span class="icon32 icon-color icon-cart"></span>
					<div>Total IS projects count</div>
					<div id="totalISProjects"></div>
					<span class="notification yellow"></span>
				</a>
				
				<a data-rel="tooltip" title="12 new messages." class="well span3 top-block" href="#">
					<span class="icon32 icon-color icon-wrench"></span>
					<div>Total products</div>
					<div id="totalProducts"></div>
					<span class="notification red"></span>
				</a>
			</div>
                        
                        <!-- zeynel dağlı flow tree ve form -->
                        <div class="row-fluid sortable">
                            <div class="box span12">
                                    <div class="box-header well" data-original-title>
                                            <h2><i class="icon-th"></i>  Insert Equipment</h2>
                                            <div class="box-icon">
                                                    <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                                                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                                                    <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                                            </div>
                                    </div>
                                    <div class="box-content">
                                        <div class="row-fluid">
                                            <div class="span4">
                                                <div class="easyui-panel" title="Equipment" style="width:400px;height:auto;" data-options="">
                                                        <ul id="tt_tree_equipment" class="easyui-tree" ></ul>
                                                </div>
                                                <!--<div id="ft" style="padding:5px;">
                                                    Footer Content.
                                                </div>-->
                                                
                                            </div>
                                            <div class="span6">
                                                <form class="form-horizontal" style='padding-left:82px;'>
						  <fieldset>
							<legend>Add new  equipment</legend>
                                                        <legend id='infoLegend' name='infoLegend' style='border-bottom:0px;'></legend>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Equipment </label>
							  <div class="controls">
								<input type="text" id='equipmentFamily' name='equipmentFamily' class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" data-source='["Woods","Solvents","Metals","Other"]'>
								<p class="help-block">Start typing to activate auto complete!</p>
							  </div>
							</div>
							
          
							
							<div class="form-actions">
							  <button type="submit" onclick='event.preventDefault();submitFormEquipment();' class="btn btn-primary">Save changes</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form> 
                                                
                                            </div>
                                        
                                    </div>                   
                                  </div>
                            </div><!--/span-->
			</div>
                        
                        
		
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		<div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
				<p>Here settings can be configured...</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-primary">Save changes</a>
			</div>
		</div>

		<footer>
			<p class="pull-left">&copy; <a href="" target="_blank">ECOMAN</a> 2015</p>
			<p class="pull-right">Powered by: <a href=""></a></p>
		</footer>
		
	</div>

