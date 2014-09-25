<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="form-group" style="width: 100%; height: 400px; border:2px solid #f0f0f0;">
				<?php echo form_open_multipart('cpscoping/file_upload/'.$this->uri->segment('2').'/'.$this->uri->segment('3')); ?>
				    <input type="text" class="form-control" id="file_name" placeholder="file_name.pdf or file_name.xlsx or file_name.docx etc." name="file_name">
				    <input type="file" name="userfile" id="userfile" size="20" />
					<br/>
				    <button type="submit" class="btn btn-info">Save File</button>
			    </form>
			    <table class="table table-bordered">
			    	<tr>
			    		<th>Index</th>
			    		<th>File Name</th>
			    	</tr>
				    <?php $sayac = 1;foreach ($cp_files as $file): ?>
				    	<tr>
				    		<td>
				    			<?php echo $sayac; $sayac++; ?>
				    		</td>
				    		<td>
				    			<button onclick="open_document(<?php echo $file['id']; ?>)" id="<?php echo $file['id']; ?>"
			    						style="width:100%;background-color: Transparent;
										    background-repeat:no-repeat;
										    border: none;
										    cursor:pointer;
										    overflow: hidden;
										    outline:none;">
									<?php echo $file['file_name']; ?>
								</button>
				    		</td>
				    	</tr>
				    <?php endforeach ?>
			    </table>
			</div>
			<?php echo form_open_multipart('search_result/'.$this->uri->segment(2).'/'.$this->uri->segment(3)); ?>
			    <input type="text" class="form-control" id="search" placeholder="Search" name="search">
		    </form>
		</div>
	</div>
</div>