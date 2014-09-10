<script type="text/javascript">
var pathname = window.location.pathname;
var prj_id = pathname.split("/")[3];
var cmpny_id = pathname.split("/")[4];
$(document).ready(function() {
    $("#prcss_name").change(function() { 
    	var prcss_id = $( "#prcss_name").val();
        $('#flow_name').children().remove();
        $('#flow_type_name').children().remove();
        $.ajax({ 
            type: "POST",
            dataType:'json',
            url: '<?php echo base_url('cp_allocation_array');?>/'+cmpny_id, 
            success: function(data)
            {
            	$('#flow_name').append('<option value="0">Nothing Selected</option>');
           		for(var k = 0 ; k < data.length ; k++){
           			if(data[k].company_process_id == prcss_id){
                    	$('#flow_name').append('<option value="'+data[k].flow_id+'">'+data[k].flowname+'</option>');
                    }
                }
                $('#flow_type_name').append('<option value="0">Nothing Selected</option>');
           		for(var k = 0 ; k < data.length ; k++){
           			if(data[k].company_process_id == prcss_id){
                    	$('#flow_type_name').append('<option value="'+data[k].flow_type_id+'">'+data[k].flow_type_name+'</option>');
                    }
                }
            }
        });
    });
});
</script>
<?php echo form_open_multipart('cpscoping/'.$project_id.'/'.$company_id.'/allocation'); ?>
	<div class="container">
		<div class="row">

			<div class="form-group">
				<label for="prcss_name" class="control-label col-md-12">Select Process Name</label>
				<div class="col-md-12">
					<select name="prcss_name" id="prcss_name" class="btn-group select select-block">
						<option value="0">Nothing Selected</option>
						<?php for($i = 0 ; $i < sizeof($prcss_info) ; $i++): ?>
							<option value="<?php echo $prcss_info[$i]['company_process_id']; ?>"><?php echo $prcss_info[$i]['prcessname']; ?></option>
						<?php endfor ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="flow_name" class="control-label col-md-12">Select Flow Name</label>
				<div class="col-md-12">
					<select name="flow_name" id="flow_name" class="btn-group select select-block">
						<option value="0">Nothing Selected</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="flow_type_name" class="control-label col-md-12">Select Flow Type Name</label>
				<div class="col-md-12">
					<select name="flow_type_name" id="flow_type_name" class="btn-group select select-block">
						<option value="0">Nothing Selected</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4">Amount Value</label>
				<label class="control-label col-md-4">Allocation</label>
				<label class="control-label col-md-4">Importance</label>
				<div class="col-md-4">
					<input type="text" class="form-control" id="amount" placeholder="1,5 kg/year" name="amount">
				</div>
				<div class="col-md-4">
					<input type="text" class="form-control" id="allocation_amount" placeholder="40 %" name="allocation_amount">
				</div>
				<div class="col-md-4">
					<select name="importance_amount" id="importance_amount" class="btn-group select select-block">
						<option value="0">Nothing Selected</option>
						<option value="High">High</option>
						<option value="Medium">Medium</option>
						<option value="Low">Low</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-4">Cost</label>
				<label class="control-label col-md-4">Allocation</label>
				<label class="control-label col-md-4">Importance</label>
				<div class="col-md-4">
					<input type="text" class="form-control" id="cost" placeholder="$210/pc" name="cost">
				</div>
				<div class="col-md-4">
					<input type="text" class="form-control" id="allocation_cost" placeholder="40 %" name="allocation_cost">
				</div>
				<div class="col-md-4">
					<select name="importance_cost" id="importance_cost" class="btn-group select select-block">
						<option value="0">Nothing Selected</option>
						<option value="High">High</option>
						<option value="Medium">Medium</option>
						<option value="Low">Low</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-4">Env. Impact</label>
				<label class="control-label col-md-4">Allocation</label>
				<label class="control-label col-md-4">Importance</label>
				<div class="col-md-4">
					<input type="text" class="form-control" id="env_impact" placeholder="3000 EP" name="env_impact">
				</div>
				<div class="col-md-4">
					<input type="text" class="form-control" id="allocation_env_impact" placeholder="40 %" name="allocation_env_impact">
				</div>
				<div class="col-md-4">
					<select name="importance_env_impact" id="importance_env_impact" class="btn-group select select-block">
						<option value="0">Nothing Selected</option>
						<option value="High">High</option>
						<option value="Medium">Medium</option>
						<option value="Low">Low</option>
					</select>
				</div>
			</div>
			<div class="col-md-4"><button type="submit" class="btn btn-primary">Create Company</button></div>	
		</div>
	</div>
</form>