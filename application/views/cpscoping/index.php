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


<div class="container">
	<div class="row">
		<div class="col-md-6">
			<select id="projects" class="btn-group select select-block">
				<option value="0">Nothing Selected</option>
				<?php foreach ($c_projects as $p): ?>
					<option value="<?php echo $p['proje_id']; ?>"><?php echo $p['name']; ?></option>
				<?php	endforeach  ?>
			</select>
		</div>
		<div class="col-md-6">
			<select id="companiess" class="btn-group select select-block">
				<option value="0">Nothing Selected</option>
			</select>
		</div>
		<div class="col-md-12">
			<a href="#" class="btn btn-default btn-sm" id="cpscopinga">New CP potentials identification</a>		
		</div>
	</div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <?php $i = 0; ?>
                <?php foreach ($com_pro as $cp): ?>
                    <tr>
                        <th style="width:50%;"><?php echo $cp['project_name']; ?></th>
                        <th><?php echo $cp['company_name']; ?></th>
                    </tr>                    
                    <?php for($k = 0 ; $k < sizeof($flow_prcss[$i]) ; $k++): ?>
                        <tr>
                            <td><?php echo $flow_prcss[$i][$k]['prcss_name']; ?></td>
                            <td><?php echo $flow_prcss[$i][$k]['flow_name']; ?></td>
                        </tr>   
                    <?php endfor ?>
                    <?php $i++; ?>
                <?php endforeach ?>
            </table>
        </div>
    </div>
</div>
