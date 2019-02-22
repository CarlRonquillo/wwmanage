<?php include('header.php'); ?>

<main>
    <div class="container-fluid">
    	<center>
    	<div class="card" style="width:50%">
           	<h4 class="card-header blue-gradient white-text text-center py-3">Create Team</h4>
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
			<?php echo form_open("teams/save",['method' => 'post','id' => 'frm_user']); ?>
			<fieldset>
				<div class="input-group">
					<div class="form-group col-lg-12">
						<label>Team Name<i class="text-warning">*</i></label>
						<?php echo form_input(['type' => 'text','name' => 'TeamName', 'class' => 'form-control',
	                                                    'autocomplete' => 'off','maxlength' => 50]); ?>
	                    <span><?php echo form_error('TeamName') ?></span>
					</div>
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