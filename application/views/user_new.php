<?php include('header.php'); ?>

<main>
    <div class="container-fluid">
    	<center>
    	<div class="card" style="width:60%">
           	<h4 class="card-header blue-gradient white-text text-center py-3">Add User</h4>
  			<div class="card-body">
  				<?php 
					if($error = $this->session->flashdata('response')):
					{						
				?>
					<div class="alert alert-success">
						<span class ="glyphicon glyphicon-info-sign"></span>
						<?php echo $error; ?>
					</div>
				<?php 
					}
					endif
				?>
			<?php echo form_open("users/save",['method' => 'post','id' => 'frm_user']); ?>
			<fieldset>
				<div class="input-group">
					<div class="form-group col-lg-6">
						<label>Given Name<i class="text-warning">*</i></label>
						<?php echo form_input(['type' => 'text','name' => 'GivenName', 'class' => 'form-control mb-4',
	                                                    'autocomplete' => 'off','maxlength' => 50]); ?>
	                    <span><?php echo form_error('GivenName') ?></span>
					</div>
					<div class="form-group col-lg-6">
						<label>Family Name</label>
						<?php echo form_input(['type' => 'text','name' => 'FamilyName', 'class' => 'form-control mb-4',
	                                                    'autocomplete' => 'off','maxlength' => 50]); ?>
	                    <span><?php echo form_error('FamilyName') ?></span>
					</div>
				</div>
				<div class="input-group">
					<div class="form-group col-lg-6">
						<label>User Name<i class="text-warning">*</i></label>
						<?php echo form_input(['type' => 'text','name' => 'Username', 'class' => 'form-control mb-4',
	                                                    'autocomplete' => 'off','maxlength' => 50]); ?>
	                    <span><?php echo form_error('Username') ?></span>
					</div>
					<div class="form-group col-lg-6">
						<label>Password<i class="text-warning">*</i></label>
						<?php echo form_input(['type' => 'password','name' => 'Password', 'class' => 'form-control mb-4',
	                                                    'autocomplete' => 'off','maxlength' => 50]); ?>
	                    <span><?php echo form_error('Password') ?></span>
					</div>
				</div>
				<div class="form-group col-lg-6">
						<label>Email</label>
						<?php echo form_input(['type' => 'email','name' => 'EmailAddress', 'class' => 'form-control mb-4',
	                                                    'autocomplete' => 'off','maxlength' => 50]); ?>
	                    <span><?php echo form_error('EmailAddress') ?></span>
					</div>
				<br>
				<div class="form-group">
					<?php echo form_submit(['value' => 'Submit','class' => 'btn blue-gradient']); ?>
				</div>
			</fieldset>
		<?php echo form_close(); ?>
		</div>
	</div>
	</div>
</center>
</main>

<?php include('footer.php'); ?>