<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<p class="lead">Login User</p>

			<?php if(validation_errors() != NULL ): ?>
		    	<div class="alert">
		      		<button type="button" class="close" data-dismiss="alert">&times;</button>
		    		<?php echo validation_errors(); ?>
		    	</div>
		    <?php endif ?>
		    <?php echo form_open('login'); ?>
		    	<div class="form-group">
					<label for="username">Username</label>
					<input type="text" class="form-control" id="username" value="<?php echo set_value('username'); ?>" placeholder="Username" name="username">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" id="password" placeholder="Password" name="password">
				</div>
				<button type="submit" class="btn btn-primary">Login</button>
		    </form>
		</div>
	</div>	
</div>