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

<script type="text/javascript">
	$(document).ready(function() {
	    $("#reference").change(function() { 
	    	var amount = $("#amount").val();
	    	var reference = $("#reference").val();
	    	var bolum = Math.round(amount/reference);
	    	if(amount != ""){
		    	$("#kpi").val(bolum);
	    	}else{
	    		alert("Amount degeri bos olmamali!");
	    	}
	    });
	    $("#unit_reference").change(function() { 
	    	var unit_amount = $("#unit_amount").val();
	    	var unit_reference = $("#unit_reference").val();
	    	if(unit_amount != 0){
		    	$("#unit_kpi").val(unit_amount+"/"+unit_reference);
	    	}else{
	    		alert("Amount unit degeri bos olmamali!");
	    	}
	    });
	});
</script>
<?php if(validation_errors() != NULL ): ?>
    <div class="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4>Form couldn't be saved</h4>
      	<p>
      		<?php echo validation_errors(); ?>
      	</p>
    </div>
<?php endif ?>
<?php echo form_open_multipart('cpscoping/'.$project_id.'/'.$company_id.'/allocation'); ?>
	<div class="container">
		<div class="row">

			<div class="form-group">
				<label for="prcss_name" class="control-label col-md-12">Select Process</label>
				<div class="col-md-12">
					<select name="prcss_name" id="prcss_name" class="btn-group select select-block">
						<option value="">Nothing Selected</option>
						<?php $kontrol = array(); $index = 0;?>
						<?php for($i = 0 ; $i < sizeof($prcss_info) ; $i++): ?>
							<option value="<?php echo $prcss_info[$i]['company_process_id']; ?>"><?php echo $prcss_info[$i]['prcessname']; ?></option>
						<?php endfor ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="flow_name" class="control-label col-md-12">Select Flow</label>
				<div class="col-md-12">
					<select name="flow_name" id="flow_name" class="btn-group select select-block">
						<option value="">Nothing Selected</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="flow_type_name" class="control-label col-md-12">Select Flow Type</label>
				<div class="col-md-12">
					<select name="flow_type_name" id="flow_type_name" class="btn-group select select-block">
						<option value="">Nothing Selected</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-6">Amount Value</label>
				<label class="control-label col-md-6">Allocation(%)</label>
				<div class="col-md-3">
					<input type="text" class="form-control" id="amount" placeholder="1,5" name="amount">
				</div>
				<div class="col-md-3">
					<select name="unit_amount" id="unit_amount" class="btn-group select select-block">
						<option value="">Nothing Selected</option>
						<?php foreach ($unit_list as $u): ?>
							<option value="<?php echo $u['name']; ?>"><?php echo $u['name']; ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="col-md-3">
					<input type="text" class="form-control" id="allocation_amount" placeholder="40" name="allocation_amount">
				</div>
				<div class="col-md-3">
					<select name="importance_amount" id="importance_amount" class="btn-group select select-block">
						<option value="">Nothing Selected</option>
						<option value="High">High</option>
						<option value="Medium">Medium</option>
						<option value="Low">Low</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-6">Cost</label>
				<label class="control-label col-md-6">Allocation(%)</label>
				<div class="col-md-3">
					<input type="text" class="form-control" id="cost" placeholder="210" name="cost">
				</div>
				<div class="col-md-3">
					<select name="unit_cost" id="unit_cost" class="btn-group select select-block">
						<option value="">Nothing Selected</option>
						<option value="Euro">Euro</option>
						<option value="Dolar">Dolar</option>
						<option value="TL">TL</option>
					</select>
				</div>
				<div class="col-md-3">
					<input type="text" class="form-control" id="allocation_cost" placeholder="40" name="allocation_cost">
				</div>
				<div class="col-md-3">
					<select name="importance_cost" id="importance_cost" class="btn-group select select-block">
						<option value="">Nothing Selected</option>
						<option value="High">High</option>
						<option value="Medium">Medium</option>
						<option value="Low">Low</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-6">Env. Impact</label>
				<label class="control-label col-md-6">Allocation(%)</label>
				<div class="col-md-3">
					<input type="text" class="form-control" id="env_impact" placeholder="3000" name="env_impact">
				</div>
				<div class="col-md-3">
					<input type="text" class="form-control" id="unit_env_impact" value="EP" name="unit_env_impact" readonly>
				</div>
				<div class="col-md-3">
					<input type="text" class="form-control" id="allocation_env_impact" placeholder="40" name="allocation_env_impact">
				</div>
				<div class="col-md-3">
					<select name="importance_env_impact" id="importance_env_impact" class="btn-group select select-block">
						<option value="">Nothing Selected</option>
						<option value="High">High</option>
						<option value="Medium">Medium</option>
						<option value="Low">Low</option>
					</select>
				</div>
			</div>

			<div class="for-group">
				<label class="control-label col-md-6">Reference</label>
				<label class="control-label col-md-6">Unit</label>
				<div class="col-md-6">
					<input type="text" class="form-control" id="reference" placeholder="3000" name="reference">
				</div>
				<div class="col-md-6">
					<select name="unit_reference" id="unit_reference" class="btn-group select select-block">
						<option value="">Nothing Selected</option>
						<?php foreach ($unit_list as $u): ?>
							<option value="<?php echo $u['name']; ?>"><?php echo $u['name']; ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>

			<div class="for-group">
				<label class="control-label col-md-3">KPI</label>
				<label class="control-label col-md-3">KPI Unit</label>
				<label class="control-label col-md-6">KPI Error(%)</label>
				<div class="col-md-3">
					<input type="text" class="form-control" id="kpi" placeholder="" name="kpi" readonly>
				</div>
				<div class="col-md-3">
					<input type="text" class="form-control" id="unit_kpi" placeholder="" name="unit_kpi" readonly>
				</div>
				<div class="col-md-6">
					<input type="text" class="form-control" id="kpi_error" placeholder="30" name="kpi_error">
				</div>
				
			</div>
			<div class="col-md-4"><button type="submit" class="btn btn-primary">Save Info</button></div>	
		</div>
	</div>
</form>