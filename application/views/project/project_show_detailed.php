<?php // echo $map['js']; ?>
<?php  
    global $company_ids;
    foreach ($companies as $company) {
        $company_ids.= $company['name'].',';
    }
    $company_ids = rtrim($company_ids,',');
?>
<script>
    console.log('<?php echo $company_ids;  ?>');
    function showMapPanelExpand() {
            //var panelWest = $('#cc').layout('panel','south');
            //var panelSouthNorth = $('#cc2').layout('panel','north');
            //$('#p').panel('expand');  
            document.getElementById('myFrame').setAttribute('width','100%');
            document.getElementById('myFrame').setAttribute('height','500');
        }
        
        function showMapPanelCollapse() {
            //var panelWest = $('#cc').layout('panel','south');
            //var panelSouthNorth = $('#cc2').layout('panel','north');
            //$('#p').panel('expand');  
            document.getElementById('myFrame').setAttribute('width','0');
            document.getElementById('myFrame').setAttribute('height','0');
        }
    
</script>
<div class="container">
	<div class="row">
		<div class="col-md-9">
			<div class="swissheader">
			<?php echo $projects['name']; ?>
				<?php if($this->session->userdata('project_id')==$projects['id']): ?>
					<small class="pull-right" style="font-size:10px;">You are already working on this project</small>
				<?php endif ?>
			</div>
			<div class="clearfix"></div>
			<?php if($is_consultant_of_project): ?>
			<div style="margin-bottom:20px;">
				<?php if($this->session->userdata('project_id')==$projects['id']): ?>
					<a class="btn btn-inverse btn-sm" href="<?php echo base_url('closeproject'); ?>"><i class="fa fa-times-circle"></i> Close this project</a>
				<?php else: ?>
					<?php echo form_open('openproject'); ?>
						<input type="hidden" name="projectid" value="<?php echo $projects['id']; ?>">
						<button type="submit" class="btn btn-sm btn-primary pull-left" style="margin-right:5px;"><i class="fa fa-plus-square-o"></i> Open Project</button>
					</form>
				<?php endif ?>
			<a class="btn btn-info btn-sm pull-right" href="<?php echo base_url("update_project/".$projects['id']); ?>">Update Project Info</a>
			    <!--<a onclick="event.preventDefault();window.open('../../IS_OpenLayers/map_prj.php?cmpny=<?php echo $company_ids; ?>','mywindow','width=900,height=900');" style = 'margin-right: 20px;' class="btn btn-info btn-sm pull-right" >See Project Companies On map</a>-->
<!-- 			    <a onclick="showMapPanelExpand();document.getElementById('myFrame').setAttribute('src','../../IS_OpenLayers/map_prj_prj.php?prj_id=<?php echo $prj_id; ?>');event.preventDefault();"  class="btn btn-inverse btn-sm" >See Project Companies On map</a>
			    <a class="btn btn-inverse btn-sm" href="#" onclick="showMapPanelCollapse();event.preventDefault();">Close Companies Map</a> -->
			    
			 </div>
			<?php endif ?>
						 <div class="clearfix"></div>

			<table class="table table-bordered">
				<tr>
					<td style="width:150px;">
					Start Date
					</td>
					<td>
					<?php echo $projects['start_date']; ?>
					</td>
				</tr>
				<tr>
					<td>
					End Date
					</td>
					<td>
					<?php echo $projects['end_date']; ?>
					</td>
				</tr>
				<tr>
					<td>
					Status
					</td>
					<td>
					<?php echo $status['name']; ?>
					</td>
				</tr>
				<tr>
					<td>
					Description
					</td>
					<td>
					<?php echo $projects['description']; ?>
					</td>
				</tr>
        <tr>
					<td>
					Project on map
					</td>
					<td>
					<iframe src="../../IS_OpenLayers/map_prj_prj.php?prj_id=<?php echo $prj_id; ?>" id="myFrame"  marginwidth="0" width='100%' height='500' marginheight="0"  align="middle" scrolling="auto"></iframe>
					<?php //echo $map['html']; ?>
					</td>
				</tr>
			</table>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<div class="swissheader" style="font-size:15px;">Project Consultants</div>
					<ul class="nav nav-list">
				<?php foreach ($constant as $cons): ?>
					<li><a style="text-transform:capitalize;" href="<?php echo base_url('user/'.$cons['user_name']); ?>"> <?php echo $cons['name'].' '.$cons['surname']; ?></a></li>
				<?php endforeach ?>
				</ul>
			</div>

			<div class="form-group">
				<div class="swissheader" style="font-size:15px;">Project Companies</div>
					<ul class="nav nav-list">
				<?php foreach ($companies as $company): ?>
					<li><a style="text-transform:capitalize;" href="<?php echo base_url('company/'.$company['id']); ?>"> <?php echo $company['name'];?></a></li>
				<?php endforeach ?>
				</ul>
			</div>

			<div class="form-group">
				<div class="swissheader" style="font-size:15px;">Contact Person</div>
					<ul class="nav nav-list">
				<?php foreach ($contact as $con): ?>
					<li><a style="text-transform:capitalize;" href="<?php echo base_url('user/'.$con['user_name']); ?>"> <?php echo $con['name'].' '.$con['surname'];?></a></li>
				<?php endforeach ?>
				</ul>
			</div>

		</div>
	</div>
</div>
