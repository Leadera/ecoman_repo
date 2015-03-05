
        /*
        function getRowIndexAuto(target){
            var tr = $(target).closest('tr.datagrid-row');
            return parseInt(tr.attr('datagrid-row-index'));
        }
       */

        function getColumnsDynamic() {	
            console.warn($("#tt_tree").tree("getChecked"));
            var checkedArray = Array("");
            checkedArray = $("#tt_tree").tree("getChecked");
            var columnArray = [];
            columnArray.push({field: 'ck',title: 'From Company',width:200,checkbox:true});
            columnArray.push({field: 'company',title: 'From Company',width:100});
            columnArray.push({field: 'flow',title: 'Flow',width:100, sortable:true});
            columnArray.push({field: 'qntty',title: 'Quantity',width:100});
            columnArray.push({field: 'qnttyunit',title: 'Unit',width:100});
            columnArray.push({field: 'fromflowtype',title: 'Flow Type',width:100});
            columnArray.push({field: 'tocompany',title: ' To Company',width:200});
            columnArray.push({field: 'qntty2',title: 'Quantity',width:100});
            columnArray.push({field: 'qntty2unit',title: 'Unit',width:100});
            columnArray.push({field: 'toflowtype',title: 'Flow Type',width:100});
            $.each(checkedArray, function( index, obj ) {
                if(obj.attributes.notroot) {
                }                
              });
            /*$('#tt_grid_dynamic').datagrid({
                
                columns:[
                        columnArray
                ], 
            });*/
        }
        
        function getCompaniesISPotentials() {
            
            checkedArray = $("#tt_tree").tree("getChecked");
            gridCheckedArray = $("#tt_grid").datagrid("getSelections");
            console.warn(checkedArray.length);
            console.warn(gridCheckedArray.length);
            if (gridCheckedArray.length==0 && checkedArray.length==0){
                $.messager.alert('Pick flow and company ','Please select sub flow and company !','warning');
            } else if(gridCheckedArray.length==0) {
                $.messager.alert('Pick flow ','Please select  company !','warning');
            } 
            else if (checkedArray.length==0) {
                $.messager.alert('Pick flow ','Please select sub flow!','warning');
            }
            else if(checkedArray.length>0 && gridCheckedArray.length>0) {
                var flowStr="";
                var companyStr="";
                $.each(checkedArray, function( index, obj ) {
                    if(obj.attributes.notroot) {
                        flowStr += obj.id+',';
                    }                
                  });
                $.each(gridCheckedArray, function( index, obj ) {
                    console.warn(obj);
                    companyStr += obj.id+',';                
                  });  


                /**
                *  @todo buras� dinamik kolon yap�s� i�in denenecek
                 */
                $.ajax({
                    url : '../../../Proxy/SlimProxy.php',   
                    data : {
                            //url : 'ISPotentialsNew_json_test',
                            url : 'ISPotentialsNew_json_test_by_project_prj',
                            selectedFlows : flowStr,
                            companies : companyStr,
                            IS : $('#IS_search').combobox('getValue'),
                            //prjId : $('#IS_project').combobox('getValue')
                            prj_id : $('#prj_id').val()
                    },
                    type: 'GET',
                    dataType : 'json',
                    success: function(data, textStatus, jqXHR) {
                        if(!data['notFound']) {
                            $('#tt_grid_dynamic').datagrid('loadData', data);
                            /*$('#tt_grid_dynamic').datagrid({
                                    view: detailview,
                                   detailFormatter:function(index,row){
                                       return '<div class="ddv" style="padding:5px 0">\n\
                                                   <div id="oneri1">sssss</div>\n\
                                                   <div id="oneri2">sss</div>\n\
                                                   <div id="oneri3">sssss</div>\n\
                                               </div>';
                                   },
                                   onExpandRow: function(index,row){
                                       alert('test');
                                       var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
                                       ddv.panel({
                                           height:80,
                                           border:false,
                                           cache:false,
                                           href:'',
                                           onLoad:function(){
                                               $('#tt_grid_dynamic').datagrid('fixDetailRowHeight',index);
                                           }
                                       });
                                       $('#tt_grid_dynamic').datagrid('fixDetailRowHeight',index);
                                   }

                       });*/
                        } else {
                            console.warn('data notfound-->'+textStatus);
                            $.messager.alert('Pick sub flow and company','Please select  a sub flow from flow tree!','warning');
                        }
                    },
                    error: function(jqXHR , textStatus, errorThrown) {
                      console.warn('error text status-->'+textStatus);
                    }
                });
            }
            
            
             
        }
        
        function beginISPotential() {
            $('#tt_grid_dynamic5').datagrid('loadData',[]);
            $('#tt_grid_dynamic5').datagrid('loading');
            $('#tt_grid_dynamic5').datagrid('getPanel').panel('setTitle','Companies by specific flow');
            if($('#tt_grid').datagrid('getSelections').length==1) {
            }else if($('#tt_grid').datagrid('getSelections').length>1){
                getCompaniesISPotentials($('#tt_grid2').datagrid('getSelections')[0].id, $('#tt_grid2').datagrid('getSelections')[0].company);
            } else {
                $.messager.alert('Pick a company','Please select  company!','warning');
            }
        }
        
        
        
        
    
    
    
    $(function() { 
        

      $('#tt_grid_dynamic').datagrid({
                singleSelect:true,
                url:'../../../Proxy/SlimProxy.php',
                queryParams : { url:'ISPotentialsNew_json_test_by_project_prj'},
                collapsible:true,
                method:'get',
                idField:'id',
                toolbar:'#tb5',
                remoteSort:false,
                multiSort:false,
                view: detailview,
                detailFormatter:function(index,row){
                    return '<div class="ddv" style="padding:5px 0">\n\
                                <div id="oneri1">sssss</div>\n\
                                <div id="oneri2">sss</div>\n\
                                <div id="oneri3">sssss</div>\n\
                            </div>';
                },
                onExpandRow: function(index,row){
                    alert('test');
                    var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
                    ddv.panel({
                        height:80,
                        border:false,
                        cache:false,
                        href:'',
                        onLoad:function(){
                            $('#tt_grid_dynamic').datagrid('fixDetailRowHeight',index);
                        }
                    });
                    $('#tt_grid_dynamic').datagrid('fixDetailRowHeight',index);
                },
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
                            {field:'prj_name',title:'IS Table Name',width:300},
                            {field:'syn_name',title:'Synergy Type',width:300},
                            {field:'date',title:' Project Date',width:300},
                            {field:'detail',title:' Details',width:100}
                        ]],
                singleSelect : true,
                //closed:true,
                //minimized:true,
        });
        
        
        $('#tt_grid_scenarios_details').datagrid({
        columns:[[
            {field:'company1',title:'Company',width:100},
            {field:'qntty1',title:'Quantity',width:100},
            {field:'company2',title:'Company',width:100},
            {field:'qntty2',title:'Quantity',width:100},
            {field:'flow',title:'Flow',width:100},
            //{field:'quality',title:'Quality',width:100},
            {field:'flowtype',title:'Flow Type',width:100},
            /*{field:'action',title:'Action',width:150,align:'center',
                formatter:function(value,row,index){
                    if (row.editing){
                        var s = '<a href="#" onclick="saverow(this)">Save</a> ';
                        var c = '<a href="#" onclick="cancelrow(this)">Cancel</a>';
                        return s+c;
                    } else {
                         var d = '<button class="btn btn-mini rn_btnDelete" onclick="deleteISPotential(this)">Delete</button>';
                        return d;
                    }
                }
            }*/,
            /*{field:'map',title:'Map',width:200,align:'center',
                formatter:function(value,row,index){
                    if (row.editing){
                        var s = '<a href="#" onclick="saverow(this)">Save</a> ';
                        var c = '<a href="#" onclick="cancelrow(this)">Cancel</a>';
                        return s+c;
                    } else {
                        //var e = '<a href="#" onclick="editrow(this)">Edit</a> ';
                        //var d = '<a href="#" onclick="deleteISPotential(this)" >Delete</a>';
                        console.log('row satır id bilgileri'+row.id);
                        var arrSplit = row.id.split(",");
                         var d = '<button class="btn btn-mini rn_btnDelete" onclick="window.open(\'../IS_OpenLayers/map.php?to_company='+arrSplit[1]+'&from_company='+arrSplit[0]+'\',\'mywindow\',\'width=900,height=900\')">See on Map</button>';
                        //return e+d;
                        return d;
                    }
                }
            }*/
        ]],
         idField:'id',
         singleSelect:true,
         collapsible:true,
         fitColumns : true,
         //toolbar:'#tb4',
         onDblClickRow: function(rowIndex, rowData){
                      console.warn(rowData); 
              }
    });


});  



