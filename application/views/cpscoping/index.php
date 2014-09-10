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
		<div class="col-md-4">
			<a href="#" class="btn btn-default btn-sm" id="cpscopinga">New CP potentials identification</a>		
		</div>
	</div>
</div>
