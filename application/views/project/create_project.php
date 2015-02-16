<?php echo $map['js']; ?>

<div class="container">
	<p class="lead">Create Project</p>

	<?php if(validation_errors() != NULL ): ?>
	    <div class="alert">
	      <button type="button" class="close" data-dismiss="alert">&times;</button>
	      <?php echo validation_errors(); ?>
	    </div>
    <?php endif ?>

	<?php echo form_open('newproject'); ?>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
	    			<label for="projectName">Project Name</label>
	    			<input type="text" class="form-control" id="projectName" placeholder="Enter Project Name" value="<?php echo set_value('projectName'); ?>" name="projectName">
	 			</div>
	 			<div class="form-group">
	 				<label for="datePicker">Start Date</label>
	    			<div class="input-group">
				    	<span class="input-group-btn">
				      		<button class="btn" type="button"><span class="fui-calendar"></span></button>
				    	</span>
				    	<input type="text" class="form-control" value="<?php echo set_value('datepicker'); ?>" id="datepicker-01" name="datepicker">
				  	</div>
	 			</div>
	 			<div class="form-group">
	    			<label for="status">Status</label>
	    			<div>
		    			<select id="status" class="info select-block" name="status">
		  					<?php foreach ($project_status as $status): ?>
								<option value="<?php echo $status['id']; ?>"><?php echo $status['name']; ?></option>
							<?php endforeach ?>
						</select>
					</div>
	 			</div>
	 			<div class="form-group">
	    			<label for="description">Description</label>
	    			<textarea class="form-control" rows="3" name="description" id="description" placeholder="Description" ><?php echo set_value('description'); ?></textarea>
	 			</div>
                                <div class="form-group">
                                    <label for="coordinates">Coordinates</label>
                                    <button type="button" data-toggle="modal" data-target="#myModal2" class="btn btn-sm btn-primary pull-right" id="coordinates" >Select on Map</button>
                                    <div class="row">
                                            <div class="col-md-6">
                                                    <input type="text" class="form-control" id="lat" placeholder="Lat" name="lat" style="color:#333333;" value="<?php /*echo set_value('lat');*/ ?>" readonly/>
                                            </div>
                                            <div class="col-md-6">
                                                    <input type="text" class="form-control" id="long" placeholder="Long" name="long" style="color:#333333;" value="<?php /*echo set_value('long');*/ ?>" readonly/>
                                            </div>
                                            <div class="col-md-6">
                                                    <input type="text" class="form-control" id="zoomlevel" placeholder="Zoom Level" name="zoomlevel" style="color:#333333;" value="<?php /*echo set_value('long');*/ ?>" />
                                            </div>
                                    </div>
	 			</div>
                            
			</div>
			<div class="col-md-4">
	 			<div class="form-group">
	    			<label for="assignedCompanies">Assign Company</label>
	    			<!--  <input type="text" id="companySearch" />	-->
	    			<select multiple="multiple"  title="Choose at least one" class="select-block" id="assignCompany" name="assignCompany[]">

						<?php foreach ($companies as $company): ?>
							<option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
						<?php endforeach ?>
					</select>
	 			</div>
	 			<div class="form-group">
	    			<label for="assignedConsultant">Assign Consultant</label>
	    			<select multiple="multiple"  title="Choose at least one" class="select-block" id="assignConsultant" name="assignConsultant[]">

						<?php foreach ($consultants as $consultant): ?>
							<option value="<?php echo $consultant['id']; ?>"><?php echo $consultant['name'].' '.$consultant['surname'].' ('.$consultant['user_name'].')'; ?></option>
						<?php endforeach ?>
					</select>
	 			</div>
	 			<div class="form-group">
	    			<label for="assignContactPerson">Assign Contact Person</label>
	    			<select  class="select-block" id="assignContactPerson" name="assignContactPerson">


					</select>
	 			</div>

			</div>
			<div class="col-md-4">

			</div>
		</div>
		<button type="submit" class="btn btn-primary">Create Project</button>
	</form>

    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" rendered="<?php echo $map['js']; ?>" >
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title" id="myModalLabel">Click Map</h4>
	        <hr>
	        <div class="row">
	        	<div class="col-md-6">
	        		<input type="text" class="form-control" id="latId" name="lat" style="color:#333333;" readonly/>
	        	</div>
	        	<div class="col-md-6">
	        		<input type="text" class="form-control" id="longId" name="long"  style="color:#333333;" readonly/>
	        	</div>
	        </div>
	      </div>
	      <div class="modal-body">
	       <?php echo $map['html']; ?>
	      </div>
	      <div class="modal-footer">
	      </div>
	    </div>
	  </div>
</div>
        
        
</div>


<script type="text/javascript">
        var marker;
        var lat,lon;

        $('#myModal2').on('shown.bs.modal', function (e) {
            google.maps.event.trigger(map, 'resize'); // modal acildiktan sonra haritanın resize edilmesi gerekiyor.

            map.setZoom(6);
            if(!marker)
                map.setCenter(new google.maps.LatLng(47.3250690187567,18.52065861225128));
            else
                map.setCenter(marker.getPosition());

            google.maps.event.addListener(map, 'click', function(event) {
                $("#latId").val("Lat:" + event.latLng.lat()); $("#longId").val("Long:" + event.latLng.lng());
                $("#lat").val(event.latLng.lat()); $("#long").val(event.latLng.lng());
                placeMarker(event.latLng);
            });

        });



        function placeMarker(location) {
          if ( marker ) {
            marker.setPosition(location);
          } else {
            marker = new google.maps.Marker({
              position: location,
              map: map
            });
          }
        }

    </script>
