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
    <select id="projects" class="btn-group select select-block">
        <option value="0">Nothing Selected</option>
        <?php foreach ($c_projects as $p): ?>
            <option value="<?php echo $p['proje_id']; ?>"><?php echo $p['name']; ?></option>
        <?php   endforeach  ?>
    </select>
    <select id="companiess" class="btn-group select select-block">
        <option value="0">Nothing Selected</option>
    </select>
    <a href="#" class="btn btn-default btn-sm" id="cpscopinga">New CP potentials identification</a>
</div>

<div class="col-md-9">
    <p>View and Edit Allocated CP Potentials Identifications</p>
    <?php $i = 0; ?>
    <?php foreach ($com_pro as $cp): ?>
        <?php // print_r($cp); ?>
        <div class="cp-heading">
            <a style="margin-left:10px;" href="<?php echo base_url('cpscoping/'.$cp['project_id'].'/'.$cp['company_id'].'/show'); ?>" class="btn btn-sm btn-info pull-right">View and Edit Cp Potentials Identifications</a>
            <a style="margin-left:10px;" href="<?php echo base_url('kpi_calculation/'.$cp['project_id'].'/'.$cp['company_id']); ?>" class="btn btn-sm btn-info pull-right">View and Edit KPI Calculation</a>
            <a href="<?php echo base_url('cost_benefit/'.$cp['project_id'].'/'.$cp['company_id']); ?>" class="btn btn-sm btn-info pull-right">New Cost-Benefit Analysis</a>
            <b>Company Name:</b> <?php echo $cp['company_name']; ?><br>
            <b>Project Name:</b> <?php echo $cp['project_name']; ?>
        </div>                    
        <table class="table table-striped" style="font-size:12px;">
        <?php if(sizeof($flow_prcss[$i])>0): ?>
            <tr>
                <th>Process Name</th>
                <th>Flow Name</th>
                <th>Flow Type</th>
            </tr>
        <?php endif ?>
        <?php for($k = 0 ; $k < sizeof($flow_prcss[$i]) ; $k++): ?>
            <tr>
                <td><?php echo $flow_prcss[$i][$k]['prcss_name']; ?></td>
                <td><?php echo $flow_prcss[$i][$k]['flow_name']; ?></td>
                <td><?php echo $flow_prcss[$i][$k]['flow_type_name']; ?></td>
            </tr>   
        <?php endfor ?>
        </table>
        <?php $i++; ?>
    <?php endforeach ?>
</div>