<script type="text/javascript">
$(document).ready(function() {
    $("#projects").change(function() {         
        var secim = $( "#projects" ).val();
        $('#companiess').children().remove();
        $.ajax({ 
            type: "POST",
            dataType:'json',
            url: '<?php echo base_url('cpscoping/pro'); ?>/'+secim, 
            success: function(data)
            {
            	$('#companiess').append('<option value="0">Nothing Selected</option>');
                for(var k = 0 ; k < data.length ; k++){
                    $('#companiess').append('<option value="'+data[k].id+'">'+data[k].name+'</option>');
                }
            }
        });
    });
    $("#companiess").change(function() {         
        var pro = $( "#projects" ).val();
        var com = $( "#companiess" ).val();
        $("#cpscopinga").attr("href", '<?php echo base_url('cpscoping'); ?>/'+pro+'/'+com+'/allocation');
    });
});

</script>


<div class="col-md-3">
    <p>Create new cp potentials identification</p>
    <!--
    <select id="projects" class="btn-group select select-block">
        <option value="0">Nothing Selected</option>
        <?php foreach ($c_projects as $p): ?>
            <option value="<?php echo $p['proje_id']; ?>"><?php echo $p['name']; ?></option>
        <?php   endforeach  ?>
    </select>
    <select id="companiess" class="btn-group select select-block">
        <option value="0">Nothing Selected</option>
    </select>
    <a href="#" class="btn btn-default btn-sm" id="cpscopinga">New CP potentials identification</a>-->
    <div>Companies under <?php echo $this->session->userdata('project_name'); ?></div><br>
    <?php foreach ($com_pro as $cp): ?>
            <a href="<?php echo base_url('cpscoping/'.$this->session->userdata('project_id').'/'.$cp['company_id'].'/allocation'); ?>/" class="btn btn-inverse btn-sm btn-block" id="cpscopinga"><?php echo $cp['company_name']; ?></a>
    <?php endforeach ?><br>
    <div>Please select the company you want to create allocation for.</div>
</div>

<div class="col-md-9">
    <p>View and Edit Allocated CP Potentials Identifications</p>
    <?php $i = 0; ?>
    <?php foreach ($com_pro as $cp): ?>
        <?php // print_r($cp); ?>
        <?php if(sizeof($flow_prcss[$i])>0): ?>
        <div class="cp-heading">
            <div class="row">
                <div class="col-md-6"><b>Company</b><br><a href="<?php echo base_url('company/'.$cp['company_id']); ?>"><?php echo $cp['company_name']; ?></a></div>
                <div class="col-md-6" style="border-left: 1px solid #C3C3C3;"><b>Project</b><br><a href="<?php echo base_url('project/'.$cp['project_id']); ?>"><?php echo $cp['project_name']; ?></a></div>
            </div>
        </div>
        <div class="cp-bar">
            <a style="margin-right:10px;" href="<?php echo base_url('cpscoping/'.$cp['project_id'].'/'.$cp['company_id'].'/show'); ?>" class=" btn-sm btn-info">View and Edit Cp Potentials Identifications</a>
            <a style="margin-right:10px;" href="<?php echo base_url('kpi_calculation/'.$cp['project_id'].'/'.$cp['company_id']); ?>" class=" btn-sm btn-success">View and Edit KPI Calculation</a>
            <a href="<?php echo base_url('cost_benefit/'.$cp['project_id'].'/'.$cp['company_id']); ?>" class=" btn-sm btn-warning">Cost-Benefit Analysis</a>
        </div>
        <table class="table table-striped" style="font-size:12px;">
            <tr>
                <th>Process Name</th>
                <th>Flow Name</th>
                <th>Flow Type</th>
                <th>Manage</th>
            </tr>
        <?php endif ?>
        <?php for($k = 0 ; $k < sizeof($flow_prcss[$i]) ; $k++): ?>
            <?php //print_r($flow_prcss[$i][$k]); ?>
            <tr>
                <td><?php echo $flow_prcss[$i][$k]['prcss_name']; ?></td>
                <td><?php echo $flow_prcss[$i][$k]['flow_name']; ?></td>
                <td><?php echo $flow_prcss[$i][$k]['flow_type_name']; ?></td>
                <td><a class="label label-danger" href="<?php echo base_url('cpscoping/delete/'.$flow_prcss[$i][$k]['allocation_id'].'/'.$flow_prcss[$i][$k]['project_id'].'/'.$flow_prcss[$i][$k]['company_id']); ?>">Delete Allocation</a></td>
            </tr>   
        <?php endfor ?>
        </table>
        <?php $i++; ?>
    <?php endforeach ?>
</div>