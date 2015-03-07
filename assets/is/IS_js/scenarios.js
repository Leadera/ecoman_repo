
      
      function deleteISScenario(target) {
                //console.warn($('#tt_grid_dynamic5').datagrid('getSelections'));
                $.messager.confirm('Confirm','Are you sure? Selected row will be deleted...',function(r){
                    if (r){
                        var rows = $('#tt_grid_scenarios').datagrid('getRows');
                        var tr = $(target).closest('tr.datagrid-row');
			var rowIndex = parseInt(tr.attr('datagrid-row-index'));
                        var row = rows[rowIndex];
                        console.log(row);
                        $.ajax({
                            url : '../../../Proxy/SlimProxy.php',   
                            data : {
                                    url : 'deleteScenario_scn',
                                    id : row.id
                            },
                            type: 'GET',
                            dataType : 'json',
                            success: function(data, textStatus, jqXHR) {
                                $('#tt_grid_scenarios').datagrid('reload');
                                if(!data['notFound']) {
                                    
                                } else {
                                    /*console.warn('data notfound-->'+textStatus);
                                    $.messager.alert('Pick sub flow and company','Please select  a sub flow from flow tree!','warning');*/
                                }
                            },
                            error: function(jqXHR , textStatus, errorThrown) {
                              console.warn('error text status-->'+textStatus);
                            }
                        });
                    }
                });
        }
        
        function updateActions(index){
            console.log(index);
            console.log('updateActions');
            /*var row = $('#tt_grid_scenarios').datagrid('getSelected');
            console.log('updateActions');
            console.log(row);*/
                $('#tt_grid_scenarios').datagrid('updateRow',{
                        index: index,
                        row:{}
                });
        }
        function getRowIndex(target){
                var tr = $(target).closest('tr.datagrid-row');
                return parseInt(tr.attr('datagrid-row-index'));
        }
        function editrow(target){
        console.log('editrow');
        var rows = $('#tt_grid_scenarios').datagrid('getRows'); 
        var row = rows[getRowIndex(target)];
        console.log(row);
        //$('#tt').datagrid('selectRow',getRowIndex(target));
                $('#tt_grid_scenarios').datagrid('beginEdit', getRowIndex(target));

        }
        function deleterow(target){
                /*$.messager.confirm('Confirm','Are you sure?',function(r){
                        if (r){
                                $('#tt_grid_scenarios').datagrid('deleteRow', getRowIndex(target));
                        }
                });*/
            $.messager.confirm('Confirm','Are you sure? Selected row will be deleted...',function(r){
                if (r){
                    var rows = $('#tt_grid_scenarios').datagrid('getRows');
                    var tr = $(target).closest('tr.datagrid-row');
                    var rowIndex = parseInt(tr.attr('datagrid-row-index'));
                    var row = rows[rowIndex];
                    console.log(row);
                    $.ajax({
                        url : '../../../Proxy/SlimProxy.php',   
                        data : {
                                url : 'deleteScenario_scn',
                                id : row.id
                        },
                        type: 'GET',
                        dataType : 'json',
                        success: function(data, textStatus, jqXHR) {
                            $('#tt_grid_scenarios').datagrid('reload');
                            if(!data['notFound']) {

                            } else {
                                /*console.warn('data notfound-->'+textStatus);
                                $.messager.alert('Pick sub flow and company','Please select  a sub flow from flow tree!','warning');*/
                            }
                        },
                        error: function(jqXHR , textStatus, errorThrown) {
                          console.warn('error text status-->'+textStatus);
                        }
                    });
                }
            });
        }
        function saverow(target){

                $('#tt_grid_scenarios').datagrid('endEdit', getRowIndex(target));
                var rows = $('#tt_grid_scenarios').datagrid('getRows'); 
                var row = rows[getRowIndex(target)];
                console.log(row);
                //console.error(getRowIndex(target));
        }
        function cancelrow(target){
                $('#tt_grid_scenarios').datagrid('cancelEdit', getRowIndex(target));
        }
        function insert(){
                var row = $('#tt_grid_scenarios').datagrid('getSelected');
                if (row){
                        var index = $('#tt_grid_scenarios').datagrid('getRowIndex', row);
                } else {
                        index = 0;
                }
                /*$('#tt_grid_scenarios').datagrid('insertRow', {
                        index: index,
                        row:{
                                status:'P'
                        }
                });*/
                $('#tt_grid_scenarios').datagrid('selectRow',index);
                $('#tt_grid_scenarios').datagrid('beginEdit',index);
        }

        

        
        
        
        
        
        
    
    
    
    $(function() { 
        
    $('#tt_grid_scenarios').datagrid({
                toolbar:'#tb',
                collapsible:true,
                url : '../../../Proxy/SlimProxy.php',
                queryParams : {
                        url : 'ISScenarios'      
                },
                method:'get',
                idField:'id',
                remoteSort:false,
                multiSort:false,
                rownumbers: "true",
                pagination: "true",
                fit:true,
                pagePosition : "both",
                columns:[[
                            {field:'prj_name',title:'IS Table Name',width:300,editor:'text'},
                            /*{field:'prj_name',title:'IS Table Name',width:300,editor:{
							type:'text',
							options:{
								required:true
							}}
                            },*/
                            {field:'syn_name',title:'Synergy Type',width:300},
                            {field:'date',title:' Project Date',width:300},
                            {field:'detail',title:' Details',width:100},
                            {field:'action',title:'Action',width:80,align:'center',
                                    formatter:function(value,row,index){
                                            if (row.editing){
                                                    var s = '<a href="javascript:void(0)" onclick="saverow(this)">Save</a> ';
                                                    var c = '<a href="javascript:void(0)" onclick="cancelrow(this)">Cancel</a>';
                                                    return s+c;
                                            } else {
                                                    var e = '<a href="javascript:void(0)" onclick="editrow(this)">Edit</a> ';
                                                    //var d = '<a href="javascript:void(0)" onclick="deleteISScenario(this);">Delete</a>';
                                                    var d = '<a href="javascript:void(0)" onclick="deleterow(this);">Delete</a>';
                                                    return e+d;
                                            }
                                    }
                            }
                        ]],
                        onBeforeEdit:function(index,row){
					row.editing = true;
					updateActions(index);
				},
				onAfterEdit:function(index,row){
                                    console.log(row);
                                    console.log('onAfterEdit');
                                    if(row.prj_name==''){
                                       $.messager.alert('Warning','Fill Scenario Name!','warning');
                                    } 
                                    else {
                                        row.editing = false;
                                        $.messager.confirm('Confirm','Are you sure? Scenario name will be updated...',function(r){
                                            if (r){
                                                
                                                console.log(row);
                                                $.ajax({
                                                    url : '../../../Proxy/SlimProxy.php',   
                                                    data : {
                                                            url : 'updateScenario_scn',
                                                            id : row.id,
                                                            scenario : row.prj_name
                                                    },
                                                    type: 'GET',
                                                    dataType : 'json',
                                                    success: function(data, textStatus, jqXHR) {
                                                        
                                                        
                                                        if(!data['notFound']) {
                                                            if(data['id']>0) $.messager.alert('Scenario Updated','Updated succesfully!','info');
                                                            //if(data['id']==0) $.messager.alert('Scenario Updated','Updated succesfully!','info');
                                                        } else {
                                                            $.messager.alert('Update Failure','Update failure!','error');
                                                            /*console.warn('data notfound-->'+textStatus);
                                                            $.messager.alert('Pick sub flow and company','Please select  a sub flow from flow tree!','warning');*/
                                                        }
                                                        $('#tt_grid_scenarios').datagrid('reload');
                                                    },
                                                    error: function(jqXHR , textStatus, errorThrown) {
                                                      console.warn('error text status-->'+textStatus);
                                                      $.messager.alert('Update Failure','Update failure!','error');
                                                    }
                                                });
                                            }
                                        });
                                        //updateActions(index);
                                    }	
				},
				onCancelEdit:function(index,row){
				console.log('onCancelEdit');
					row.editing = false;
					updateActions(index);
				},
                        singleSelect : false,
                        onDblClickRow: function(rowIndex, rowData){ 
                            $('#tt_grid_scenarios_details').datagrid({
   
                            url:'../../../Proxy/SlimProxy.php',
                            queryParams : { url:'getScenarioDetails_scn',
                                            id : rowData.id}, 
                            });
                            $('#tt_grid_scenarios_details').datagrid('loadData');
                        },
                        //closed:true,
                        //minimized:true,
        });
        
        
        $('#tt_grid_scenarios_details').datagrid({
                singleSelect:true,
                url:'../../../Proxy/SlimProxy.php',
                queryParams : { url:'getScenarioDetails_scn'},
                collapsible:true,
                method:'get',
                idField:'id',
                toolbar:'#tb5',
                remoteSort:false,
                multiSort:false,
                columns:
                        [[
                            //{field:'sirket_id',title:'ID',width:300},
                            //{field: 'ck',title: 'From Company',checkbox:true},
                            {field: 'company',title: 'From Company'},
                            {field: 'flow',title: 'Flow'/*,sortable:true*/},
                            {field: 'qntty',title: 'Quantity'},
                            {field: 'qnttyunit',title: 'Unit'},
                            {field: 'fromflowtype',title: 'Flow Type'},
                            {field: 'tocompany',title: ' To Company'},
                            {field: 'qntty2',title: 'Quantity'},
                            {field: 'qntty2unit',title: 'Unit'},
                            {field: 'toflowtype',title: 'Flow Type'},
                        ]],
                fit:true,
                fitColumns : true,
               
        });


});  





