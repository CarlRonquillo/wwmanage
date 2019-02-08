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
				<div class="input-group">
					<div class="form-group col-lg-6">
						<label>Email</label>
						<?php echo form_input(['type' => 'email','name' => 'EmailAddress', 'class' => 'form-control mb-4',
	                                                    'autocomplete' => 'off','maxlength' => 50]); ?>
	                    <span><?php echo form_error('EmailAddress') ?></span>
					</div>
					<div class="form-group col-lg-6">
						<label for="CMS" class="control-label">Role<i class="text-warning">*</i></label>
						<?php
							$_Roles = array();
							foreach($Roles as $role)
							{
								$_Roles[$role->RoleID]=$role->Title;
							}
						echo form_dropdown(['id' => 'Role','name' => 'Role', 'class' => 'browser-default custom-select','autocomplete' => 'off'],$_Roles); ?>
						<span> <?php echo form_error('Role') ?> </span>
					</div>
				</div>
				<div class="input-group">
					<div class="form-group col-lg-6">
						<label>Region<i class="text-warning">*</i></label>
						<?php $region_array = array();
							foreach($Regions as $Region)
                            {
                                $region_array[$Region->RegionID]=$Region->RegionName;
                            }
							echo form_dropdown(['id' => 'FKRegionID','name' => 'FKRegionID', 'class' => 'browser-default custom-select','autocomplete' => 'off','onChange' => 'changecat(this.value);'],$region_array); ?>
						<span><?php echo form_error('FKRegionID') ?></span>
					</div>
					<div class="form-group col-lg-6">
						<label>Field/World Area<i class="text-warning">*</i></label>
						<?php echo form_dropdown(['id' => 'FKFieldID','name' => 'FKFieldID', 'class' => 'browser-default custom-select','autocomplete' => 'off']); ?>
						<span><?php echo form_error('FKFieldID') ?></span>
					</div>
				</div>
				<div class="input-group">
					<div class="form-group col-lg-6">
						<label>Country<i class="text-warning">*</i></label>
						<?php $country_array = array();
							foreach($Countries as $Country)
                            {
                                $country_array[$Country->id]=$Country->country_name;
                            }
							echo form_dropdown(['id' => 'Country','name' => 'FKCountryID', 'class' => 'browser-default custom-select','autocomplete' => 'off'],$country_array); ?>
						<span><?php echo form_error('Country') ?></span>
					</div>
					<div class="form-group col-lg-6">
						<label>District<i class="text-warning">*</i></label>
						<?php $district_array = array();
							foreach($Districts as $District)
                            {
                                $district_array[$District->id]=$District->district_name;
                            }
							echo form_dropdown(['id' => 'FKDistrictID','name' => 'FKDistrictID', 'class' => 'browser-default custom-select','autocomplete' => 'off'],$district_array); ?>
						<span><?php echo form_error('FKDistrictID') ?></span>
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

<?php 
	$field_array = array();
	if(isset($field_array))
	{
		foreach($Fields as $Field)
	    {
	    	$field_array[$Field->region_id][$Field->id]=[$Field->name];
	    }
	}
?>

<script>
	var availableTags = <?php if(isset($field_array)) {echo json_encode($field_array);} ?>;

	function changecat(value) {
	  if (value.length == 0) document.getElementById("FKFieldID").innerHTML = "<option></option>";
	  else {
	    var catOptions = "";
	    for (categoryId in availableTags[value]) {
	      catOptions += "<option value="+ categoryId +">" + availableTags[value][categoryId] + "</option>";
	    }
	    document.getElementById("FKFieldID").innerHTML = catOptions;
	  }
	}

	$( document ).ready(function() {
		var value =  document.getElementById("FKRegionID").value;
		changecat(value);
    });
</script>