
<?php echo $map['js']; ?>

<div class="container">
	<p class="lead">Update Company</p>

	<?php if(validation_errors() != NULL ): ?>
    <div class="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
      <p>
      	<?php echo validation_errors(); ?>
      </p>
    </div>
  <?php endif ?>

	<?php echo form_open_multipart('update_company/'.$companies['id']);?>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
	  				<div class="fileinput fileinput-new" data-provides="fileinput">
	    				<div class="fileinput-new thumbnail">
	      					<img class="img-rounded" style="max-width: 200px; max-height: 150px;" src="<?php echo asset_url("company_pictures/".$companies['logo']);?>">
	    				</div>
	    				<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
	    				<div>
	      					<span class="btn btn-primary  btn-file">
						        <span class="fileinput-new"><span class="fui-image"></span>  Select image</span>
						        <span class="fileinput-exists"><span class="fui-gear"></span>  Change</span>
						        <input type="file" name="userfile">
	      					</span>
	      					<a href="#" class="btn btn-primary fileinput-exists" data-dismiss="fileinput"><span class="fui-trash"></span>  Remove</a>
	    				</div>
	  				</div>
				</div>
				<div class="form-group">
	    			<label for="companyName">Company Name</label>
	    			<input type="text" class="form-control" id="companyName" placeholder="Enter Company Name" value="<?php echo set_value('companyName',$companies['name']); ?>" name="companyName">
	 			</div>
	 			<div class="form-group">
					<label for="naceCode">Nace Code</label>
					<select id="selectize" name="naceCode">
						<?php foreach ($all_nace_codes as $anc): ?>
							<?php if($nace_code['code']==$anc['code']) {$d=TRUE;} else {$d=FALSE;} ?>
							<option value="<?php echo $anc['code']; ?>" <?php echo set_select('naceCode', $anc['code'], $d); ?> ><?php echo $anc['code']; ?> - <?php echo $anc['name_tr']; ?></option>
						<?php endforeach ?>
					</select>
					<a target="_blank" href="http://tobb.org.tr/faaliyet/Sayfalar/nace-sorgulama.php">Nace Codes</a>
	 			</div>



			</div>
			<div class="col-md-4">
				<div class="form-group">
	    			<label for="email">E-mail</label>
	    			<input type="text" class="form-control" id="email" placeholder="E-mail" value="<?php echo set_value('email',$companies['email']); ?>"  name="email">
	 			</div>
	 			<div class="form-group">
	    			<label for="cellPhone">Cell Phone</label>
	    			<input type="text" class="form-control" id="cellPhone" placeholder="Cell Phone" value="<?php echo set_value('cellPhone',$companies['phone_num_1']); ?>" name="cellPhone">
	 			</div>
	 			<div class="form-group">
	    			<label for="workPhone">Work Phone</label>
	    			<input type="text" class="form-control" id="workPhone" placeholder="Work Phone" value="<?php echo set_value('workPhone',$companies['phone_num_2']); ?>" name="workPhone">
	 			</div>
	 			<div class="form-group">
	    			<label for="fax">Fax Number</label>
	    			<input type="text" class="form-control" id="fax" placeholder="Fax Number" value="<?php echo set_value('fax',$companies['fax_num']); ?>" name="fax">
	 			</div>

			</div>
			<div class="col-md-4">
				<div class="form-group">
	    			<label for="coordinates">Coordinates</label>
	    			<button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-primary pull-right" id="coordinates" >Select on Map</button>
	    			<div class="row">
		    			<div class="col-md-6">
		    				<input type="text" class="form-control" id="lat" placeholder="Lat" name="lat" style="color:#333333;" value="<?php echo set_value('lat',$companies['latitude']); ?>" readonly/>
		    			</div>
		    			<div class="col-md-6">
		    				<input type="text" class="form-control" id="long" placeholder="Long" name="long" style="color:#333333;" value="<?php echo set_value('long',$companies['longitude']); ?>" readonly/>
		    			</div>
	    			</div>
	 			</div>

	 			<div class="form-group">
	    			<label for="address">Address</label>
	    			<textarea class="form-control" rows="3" name="address" id="address" placeholder="Address"><?php echo set_value('address',$companies['address']); ?></textarea>
	 			</div>
	 			<div class="form-group">
	    			<label for="companyDescription">Company Description</label>
	    			<textarea class="form-control" rows="3" name="companyDescription" id="companyDescription" placeholder="Company Description"><?php echo set_value('companyDescription',$companies['description']); ?></textarea>
	 			</div>
			</div>
		</div>
		<button type="submit" class="btn btn-primary pull-right">Update Company</button>
	</form>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" rendered="<?php echo $map['js']; ?>">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" onclick="getCountryIdName();alert('test');" data-dismiss="modal" aria-hidden="true">&times;</button>
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
	$('#selectize').selectize({
    create: false
  });
  
  
  function getCountryIdName() {
      //alert($('#latId').val());
      //alert($('#longId').val());
      
      if($('#latId').val()!=""  && $('#longId').val()!="") {
          //alert($('#latId').val());
          $.ajax({
            url : '../../../Proxy/SlimProxy.php',   
            data : {
                    url : 'deleteScenario_scn',
                    lat : $('#latId').val(),
                    long : $('#longId').val()
            },
            type: 'GET',
            dataType : 'json',
            success: function(data, textStatus, jqXHR) {
                $('#tt_grid_scenarios').datagrid('reload');
                if(!data['notFound']) {

                } else {
                    console.warn('data notfound-->'+textStatus);

                }
            },
            error: function(jqXHR , textStatus, errorThrown) {
              console.warn('error text status-->'+textStatus);
            }
    });
          
      }
      
      

      
  }
</script>