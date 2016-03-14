<script>
    function updateReport() {
        if(false) {
            
        }  else {
            $.messager.progress();
        var checkedArray = Array("");
        checkedArray = $("#tt_tree").tree("getChecked");
        console.log(checkedArray);
        var attrStr="";
        $.each(checkedArray, function( index, obj ) {
            
            attrStr+=obj.id+','
            //attrStr='6,7,';
          });
        var row = $('#tt_grid').datagrid('getSelected');
        console.log(attrStr);
        $('#ff').form({
            ajax : true,
            //url:'../../../../slim2_ecoman_admin/',
            url: '../../../../slim2_ecoman_admin/report.php/updateReport_rpt',
            queryParams : {
                //url : 'insertReport_rpt',
                attr : attrStr,
                name : $('#tt_textReportName').textbox('getText'),
                consultant_id : document.getElementById('consultant_id').value,
                company_id : $('#company_dropdown').combobox('getValue'),
                id : row.id
                //'row='+JSON.stringify($('#tt_grid_dynamic5').datagrid('getRows'))+'&text='+$('#tt_textReportName').textbox('getText')
            },
            onSubmit:function(){
                var isValid = $(this).form('validate');
                if (!isValid){
                        $.messager.progress('close');
                }
                //$.messager.alert('is valid ');
                return isValid;	// return false will stop the form submission
            },
            success:function(data){
                var jsonObj = $.parseJSON(data);
                if(jsonObj['found']==true)
                {
                    if(jsonObj["id"]>0) {
                         noty({text: 'Report updated succesfully', type: 'success'});
                         $('#tt_grid').datagrid('reload');
                         $.messager.progress('close');
                     } else {
                         noty({text: 'Cluster name has been inserted before, please enter another cluster name', type: 'warning'});
                         $('#tt_grid').datagrid('reload');
                         $.messager.progress('close');
                     }

                } else if(data["found"]==false){
                    //$.messager.alert('Save Error', 'Error occured');
                    noty({text: 'Report could not be  updated ', type: 'error'}); 
                    $.messager.progress('close');	// hide progress bar while submit successfully
                }

            }
            });
            $('#ff').submit();
        } 
    }
    
    
    function resetFormReport() {
        $('#tt_tree').tree({
                url: '../../../../Proxy/SlimProxyAdmin.php',
                queryParams : { url:'reportAttributes_rpt' },
                method:'get',
                animate:true,
                checkbox:true,
                cascadeCheck : false,
            });
         $("#tt_tree").tree('reload');
         $("#tt_textReportName").textbox('setText', '');
         $("#company_dropdown").combobox('select', '');
         $("#saveReport").linkbutton({
            //text: 'Update Report'
            disabled: false
        });
        $("#updateReport").linkbutton({
            //text: 'Update Report'
            disabled: true
        });
    }
    
     function reportEditView(report_name, report_id, company_name, company_id) {
         console.log(report_name);
         console.log(report_id);
         console.log(company_name);
         console.log(company_id);
         $('#tt_tree').tree({
                url: '../../../../Proxy/SlimProxyAdmin.php',
                queryParams : { url:'reportAttributesForEdit_rpt',
                                report_id: report_id },
                method:'get',
                animate:true,
                checkbox:true,
                cascadeCheck : false,
            });
         $("#tt_tree").tree('reload');
         $("#tt_textReportName").textbox('setText', report_name);
         $("#company_dropdown").combobox('select', company_id);
         $("#saveReport").linkbutton({
            //text: 'Update Report'
            disabled: true
        });
        $("#updateReport").linkbutton({
            //text: 'Update Report'
            disabled: false
        });
     }
    
     function saveReport() {

            $('#ff').form({
                ajax : true,
                //url:'../../../../slim2_ecoman_admin/',
                url: '../../../slim2_ecoman_admin/report.php/insertReport_rpt',
                queryParams : {
                    //url : 'insertReport_rpt',
                    //attr : attrStr,
                    name : $('#tt_textReportName').textbox('getText'),
                    consultant_id : document.getElementById('consultant_id').value,
                    //company_id : $('#company_dropdown').combobox('getValue'),
                    //'row='+JSON.stringify($('#tt_grid_dynamic5').datagrid('getRows'))+'&text='+$('#tt_textReportName').textbox('getText')
                },
                onSubmit:function(){
                    $.messager.progress();
                    var isValid = $(this).form('validate');
                    if (!isValid){
                            $.messager.progress('close');
                    }
                    //$.messager.alert('is valid ');
                    return isValid;	// return false will stop the form submission
                },
                success:function(data){
                    var jsonObj = $.parseJSON(data);
                    if(jsonObj['found']==true)
                    {
                        if(jsonObj["id"]>0) {
                             noty({text: 'Cluster inserted succesfully', type: 'success'});
                             $('#tt_grid').datagrid('reload');
                             $.messager.progress('close');
                         } else {
                             noty({text: 'Cluster has been inserted before, please enter another cluster name', type: 'warning'});
                             $('#tt_grid').datagrid('reload');
                             $.messager.progress('close');
                         }

                    } else if(data["found"]==false){
                        //$.messager.alert('Save Error', 'Error occured');
                        noty({text: 'Cluster could not be  inserted ', type: 'error'}); 
                        $.messager.progress('close');	// hide progress bar while submit successfully
                    }

                }
                });
                $('#ff').submit();
       
         
        
    }
    
    
    function submitFormFlowFamily(){  
            console.log($('#flowFamily').val()); 
            $.ajax({
                //url: '../../../../slim2_ecoman_admin/report.php/insertReport',
                url: '../../../slim2_ecoman_admin/report.php/insertReport',
                type: 'POST',
                dataType : 'json',
                data: 'flow='+$('#flowFamily').val(),
                success: function(data, textStatus, jqXHR) {
                  console.warn('success text status-->'+textStatus);
                  if(data["found"]==true) {
                      //$.messager.alert('Success','Success inserted Flow family!','info');
                      if(data["id"]>0) {
                          noty({text: 'Report inserted succesfully', type: 'success'});
                          $('#tt_tree').tree('reload');
                      } else {
                          noty({text: 'Report has been inserted before, please enter another cluster name', type: 'warning'});
                          $('#tt_tree').tree('reload');
                      }
                      
                  } else if(data["found"]==false) {         
                      //$.messager.alert('Insert failed','Failed to insert Flow Family !','error');
                      noty({text: 'Report could not be  inserted ', type: 'error'});  
                      $('#tt_tree').tree('reload');
                  }   
                },
                error: function(jqXHR , textStatus, errorThrown) {
                  //console.warn('error text status-->'+textStatus);
                  noty({text: 'Report could not be  inserted ', type: 'error'});  
                }
            });
        }
    
    
    jQuery(document).ready(function() {
        
        
         $('#tt_grid').datagrid({
            url :'../../../Proxy/SlimProxyAdmin.php',
            queryParams : { url : 'getReports_rpt',
                            //flows : JSON.stringify(arrayLeaf),
                            //prj_id : $('#prj_id').val()
                        },
            sortName : 'r_date',
            collapsible:true,
            idField:'id',
            //toolbar:'#tb',
            rownumbers: "true",
            pagination: "true",
            remoteSort : true,
            multiSort : true,
            singleSelect : true,
            scroll : true,
            columns:[[
                  {field:'report_name',title:'Cluster Name',width:100,sortable:true},
                  {field:'r_date',title:'Report Date',width:100,sortable:true},
                  {field:'company_name',title:'Company',width:100,sortable:true},
                  {field:'company_id',title:'Company ID',width:100,sortable:true,hidden:true},
                  {field:'user_name',title:'User Name',width:100},
                  {field:'name',title:'Name',width:100},
                  {field:'surname',title:'Surname',width:100},
                  {field:'report',title:'Report',width:100,align:'center',
                    formatter:function(value,row,index){
                        //console.log('row satır id bilgileri'+row.id);

                        var x = '<a href="#add" class="easyui-linkbutton" \n\
                                    iconCls="icon-save" \n\
                                    onclick="document.getElementById(\'myFrame\').setAttribute(\'src\',\n\
                                    \'http://88.249.18.205:8445/jasperPhpEcoman/master/index.php?Configuration_ID='+row.id+'&Rapor_ID=1\')"> See Report</a>';
                        //return e+d;
                        return x;        
                        
                    }  
                },
                /*{field:'flow_details',title:'Flow Details',width:100,align:'center',
                    formatter:function(value,row,index){
                        //console.log('row satır id bilgileri'+row.id);

                        var y = '<a href="#add" class="easyui-linkbutton" \n\
                                    iconCls="icon-save" \n\
                                    onclick="document.getElementById(\'myFrame\').setAttribute(\'src\',\n\
                                    \'http://88.249.18.205:8445/jasperPhpEcoman/master/index.php?Configuration_ID='+row.id+'&Rapor_ID=2\')"> See Flow Details</a>';
                        //return e+d;
                        return y;
                        
                    }
                },*/ 
                {field:'edit',title:'Edit',width:50,align:'center',
                    formatter:function(value,row,index){
                        //console.log('row satır id bilgileri'+row.id);
                        //console.log('row satır name bilgileri'+row.report_name);
                        var x = '<a href="" class="easyui-linkbutton" \n\
                                    iconCls="icon-save" \n\
                                    onclick="reportEditView(\''+row.report_name+'\','+row.id+', \''+row.company_name+'\', '+row.company_id+' );event.preventDefault();"> Edit</a>';
                        //return e+d;
                        return x;
                        
                    }
                },
                

                  ]],
                });
            //$('#tt_grid2').datagrid('loadData', data);
            $('#tt_grid').datagrid({
               url :'../../../Proxy/SlimProxyAdmin.php',
               queryParams : { url : 'getReports_rpt',
                               //flows : JSON.stringify(arrayLeaf),
                               //prj_id : $('#prj_id').val()
                           }
            });
        
        
 
          $('#tt_tree').tree({
                url: '../../../../Proxy/SlimProxyAdmin.php',
                queryParams : { url:'reportAttributes_rpt' },
                method:'get',
                animate:true,
                checkbox:true,
                cascadeCheck : false,
            });
            
            
            var treeValue;
            var parentnode;
        $("#tt_tree").tree({
                    onCheck: function(node, checked) {
                        var parentnode=$("#tt_tree").tree("getParent", node.target);
                        if(parentnode) {
                            $("#tt_tree").tree('check',parentnode.target);
                            
                        } /*else {
                            //console.log('parent node bulunamadı');
                        }*/
                       
                    },
                    onClick: function(node){
                    console.log(node);
                    console.log(node.attributes.notroot);
                    /*parentnode=$("#tt_tree").tree("getParent", node.target);
                    console.log(parentnode);
                    if(parentnode==null) {
                        console.log('parent node null');
                    } else {
                        console.log('parent node null değil');
                    }
                    var roots=$("#tt_tree").tree("getRoots");
                    console.log(parentnode.attributes);*/
                    /*if() {
                        
                    } else {
                        
                    }*/
                    var treeValue;
                    if(node.state==undefined) {
                            var de=parentnode.text;
                            var test_array=de.split("/");
                            treeValue=test_array[1];
                    } else {
                            //treeValue=parentnode.text;
                    }
    
                    //var imagepath=parentnode.text+"/"+node.text;
                },
                onDblClick: function(node){
                var deneme="test";
                    var parent=$("#tt_tree").tree("getParent",node.target);
                    if(parent) {
                    
                    } else {
                    }
                }
            });
            
            $.ajax({
                url: '../../../../Proxy/SlimProxyAdmin.php',
                type: 'GET',
                dataType : 'json',
                data: { url:'totalProjects' },
                success: function(data, textStatus, jqXHR) {
                  //console.warn('success text status-->'+textStatus);
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
                  //console.warn('success text status-->'+textStatus);
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
                  //console.warn('success text status-->'+textStatus);
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
                  //console.warn('success text status-->'+textStatus);
                  //console.warn(data);
                  $('#totalProducts').html(data['totalProducts']);
                }
            });
            
            

            
                    
             
        });
    
    
</script>
<input type ="hidden" value='<?php echo $userID; ?>' id ='consultant_id' name='consultant_id'></input>
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
        
        <div class="container-fluid" style="background: #E0EDDF">
		<div class="row-fluid">
				
			<!-- left menu starts -->
			<div class="span2 main-menu-span">
				<div class="well nav-collapse sidebar-nav">
                                    
                                    
                                    <ul class="nav nav-tabs nav-stacked main-menu">
                                            <li class="nav-header hidden-tablet">Admin Menu</li>
                                            <li><a class="ajax-link" href="<?php echo base_url('admin/newFlow'); ?>"><i class="icon-edit"></i><span class="hidden-tablet">Flows</span></a></li>
                                            <li><a class="ajax-link" href="<?php echo base_url('admin/newProcess'); ?>"><i class="icon-edit"></i><span class="hidden-tablet">Processes</span></a></li>
                                            <li><a class="ajax-link" href="<?php echo base_url('admin/newEquipment'); ?>"><i class="icon-edit"></i><span class="hidden-tablet">Equipments</span></a></li>
                                            <li><a class="ajax-link" href="<?php echo base_url('admin/clusters'); ?>"><i class="icon-edit"></i><span class="hidden-tablet">Clusters</span></a></li>
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
						<a href="<?php echo base_url(); ?>">Main Page</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo base_url('admin/reports'); ?>">Reports</a>
					</li>
				</ul>
			</div>
                        
                        
                        
                        
                        
			<div class="sortable row-fluid">
                            <a  id='toplam_anket_link' data-rel="" title="" class="well span3 top-block" href="<?php echo base_url('admin/rpEmployeesList'); ?>">
					<span class="icon32 icon-red icon-user"></span>
					<div>Industrial Zone Employees List</div>
					<div id=''></div>
					<span id ='' class="notification"></span>
				</a> 

				<a data-rel="tooltip" title="" class="well span3 top-block" href="<?php echo base_url('admin/rpConsultantsList'); ?>">
					<span class="icon32 icon-color icon-user"></span>
					<div>Industrial Zone Consultants List</div>
					<div id=''></div>
					<span id='' class="notification green"></span>
				</a>

				<a data-rel="tooltip" title="" class="well span3 top-block" href="<?php echo base_url('admin/rpCompaniesInClustersList'); ?>">
					<span class="icon32 icon-color icon-globe"></span>
					<div>Companies In Clusters</div>
					<div id=""></div>
					<span class="notification yellow"></span>
				</a>
				
				<a data-rel="tooltip" href="<?php echo base_url('admin/rpEquipmentList'); ?>" title="" class="well span3 top-block" >
					<span class="icon32 icon-color icon-wrench"></span>
					<div>Industrial Zone Equipment List</div>
					<div id=""></div>
					<span class="notification red"></span>
				</a>
			</div>
                        
                        <div class="sortable row-fluid">
                            <a  id='toplam_anket_link' data-rel="" title="" class="well span3 top-block" href="<?php echo base_url('admin/rpCompaniesNotInClustersList'); ?>">
					<span class="icon32 icon-red icon-globe"></span>
					<div>Companies Not In Clusters</div>
					<div id=''></div>
					<span id ='totalUsers_by_today' class="notification"></span>
				</a> 

				<a data-rel="tooltip" title="" class="well span3 top-block" href="<?php echo base_url('admin/rpCompaniesWasteEmissionList'); ?>">
					<span class="icon32 icon-color icon-inbox"></span>
					<div>Companies Waste /Emission</div>
					<div id=''></div>
					<span id='' class="notification green"></span>
				</a>

				<a data-rel="tooltip" title="" class="well span3 top-block" href="<?php echo base_url('admin/rpCompaniesProductionList'); ?>">
					<span class="icon32 icon-color icon-cart"></span>
					<div>Industrial Zone Company Products</div>
					<div id=""></div>
					<span class="notification yellow"></span>
				</a>
				
				<a data-rel="tooltip" title="" class="well span3 top-block" href="<?php echo base_url('admin/rpCompaniesProcessesList'); ?>">
					<span class="icon32 icon-color icon-wrench"></span>
					<div>Industrial Zone Company Processes</div>
					<div id=""></div>
					<span class="notification red"></span>
				</a>
			</div>
                        
                        <div class="sortable row-fluid">
                            <a data-rel="tooltip" title="" class="well span3 top-block" href="<?php echo base_url('admin/rpCompaniesInfoList'); ?>">
					<span class="icon32 icon-yellow icon-users"></span>
					<div>Industrial Zone Company Info</div>
					<div id=""></div>
					<span class="notification red"></span>
				</a>

				<a data-rel="tooltip" title="" class="well span3 top-block" href="<?php echo base_url('admin/rpCompaniesList'); ?>">
					<span class="icon32 icon-orange icon-inbox"></span>
					<div>Industrial Zone Company List</div>
					<div id=''></div>
					<span id='' class="notification green"></span>
				</a>

				<a data-rel="tooltip" title="" class="well span3 top-block" href="<?php echo base_url('admin/rpCompaniesProjectsList'); ?>">
					<span class="icon32 icon-orange icon-inbox"></span>
					<div>Industrial Zone Company Projects</div>
					<div id=''></div>
					<span id='' class="notification green"></span>
				</a>
				
				<a data-rel="tooltip" title="" class="well span3 top-block" href="<?php echo base_url('admin/rpCompaniesProjectDetailsList'); ?>">
					<span class="icon32 icon-color icon-wrench"></span>
					<div>Ind. Zone Company Projects Det.</div>
					<div id=""></div>
					<span class="notification red"></span>
				</a>
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
			<p class="pull-left">&copy; <a href="" target="_blank">CELERO</a> 2015</p>
			
		</footer>
		
	</div>

