<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Work & Witness Manage</title>
  <link rel="stylesheet" href="<?php echo base_url("assets/stylesheets/bootstrap.min.css"); ?>"/>
  <link rel="stylesheet" href="<?php echo base_url("assets/stylesheets/mdb.min.css"); ?>">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  
</head>
<br><br>

<main>
<div class="container-fluid">
<center>

<div class="panel panel-primary" style="width: 30rem;">
	<div class="panel-heading">
		<h4><p>Work & Witness <strong class="text-warning">Manage</strong></p></h4><hr>
		<h3>Sign In</h3>
	</div>
	<div class="panel-body"><br>
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
		<?php echo form_open("users/login_validation",['method' => 'post','id' => 'frm_login']); ?>
			<fieldset>
				<div class="form-group">
					<label>Username</label>
					<?php echo form_input(['type' => 'text','name' => 'username', 'class' => 'form-control mb-4 col-lg-9',
                                                    'autocomplete' => 'off','maxlength' => 50]); ?>
                    <span><?php echo form_error('username') ?></span>
				</div>
				<div class="form-group">
					<label>Password</label>
					<?php echo form_input(['type' => 'password','name' => 'password', 'class' => 'form-control mb-4 col-lg-9',
                                                    'autocomplete' => 'off','maxlength' => 50]); ?>
                    <span><?php echo form_error('password') ?></span>
				</div><br>
				<div class="form-group col-lg-9">
					<?php echo form_submit(['value' => 'Submit','class' => 'btn btn-primary btn-block']); ?>
				</div>
			</fieldset>
		<?php echo form_close(); ?>
	</div>
</div><br><br><br>

</center>
</div>
</main>

<?php include('footer.php'); ?>