<?php include('header.php'); ?>

<main>
    <div class="container-fluid">
    	<div class="card">
           	<h4 class="card-header peach-gradient white-text text-center py-3"><b><?php echo $project->ProjectName; ?></b></h4>
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
			<?php echo form_open("project/update/{$project->ProjectID}",['method' => 'post','id' => 'frm_project']); ?>
			<fieldset>
				<h4 class="text-warning">Project Details</h4><hr>
				<div class="form-group col-lg-6">
					<label>Project Name<i class="text-warning">*</i></label>
					<?php echo form_input(['type' => 'text','name' => 'ProjectName', 'class' => 'form-control mb-4',
                                                    'autocomplete' => 'off','maxlength' => 50],$project->ProjectName); ?>
                    <span><?php echo form_error('ProjectName') ?></span>
				</div>
				<div class="input-group">
					<div class="form-group col-lg-6">
						<label>Vision<i class="text-warning">*</i></label>
						<?php echo form_textarea(['type' => 'text','name' => 'VisionObjective', 'class' => 'form-control mb-4','autocomplete' => 'off','rows' => 4, 'placeholder' => "What's the objective of your project?"],$project->VisionObjective); ?>
						<span><?php echo form_error('VisionObjective') ?></span>
					</div>
					<div class="form-group col-lg-6">
						<label>Description<i class="text-warning">*</i></label>
						<?php echo form_textarea(['type' => 'text','name' => 'Description', 'class' => 'form-control mb-4','autocomplete' => 'off','rows' => 4, 'placeholder' => "Describe your project here..."],$project->Description); ?>
						<span><?php echo form_error('Description') ?></span>
					</div>
				</div>
				<hr>

				<div class="input-group">
					<div class="form-group col-lg-6">
						<label>Region<i class="text-warning">*</i></label>
						<?php $region_array = array();
						if(isset($Regions))
						{
							foreach($Regions as $Region)
                            {
                                $region_array[$Region->RegionID]=$Region->RegionName;
                            }
                        }
							echo form_dropdown(['id' => 'FKRegionID','name' => 'FKRegionID', 'class' => 'browser-default custom-select col-lg-6','autocomplete' => 'off','onChange' => 'changecat(this.value);'],$region_array,$project->FKRegionID); ?>
						<span><?php echo form_error('FKRegionID') ?></span>
					</div>
					<div class="form-group col-lg-6">
						<label>Arrival City</label>
						<?php echo form_input(['type' => 'text','name' => 'ArrivalCity', 'class' => 'form-control mb-4',
                                                    'autocomplete' => 'off','maxlength' => 50],$project->ArrivalCity); ?>
                    	<span><?php echo form_error('ArrivalCity') ?></span>
					</div>
				</div>
				<div class="input-group">
					<div class="form-group col-lg-6">
						<label>Field/World Area<i class="text-warning">*</i></label>
						<?php $field_array = array();
							echo form_dropdown(['id' => 'FKFieldID','name' => 'FKFieldID', 'class' => 'browser-default custom-select col-lg-6','autocomplete' => 'off'],$field_array,$project->FKFieldID); ?>
						<span><?php echo form_error('FKFieldID') ?></span>
					</div>
					<div class="form-group col-lg-6">
						<label>Estimated Cost<i class="text-warning">*</i></label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
	    						<span class="input-group-text">$</span>
	  						</div>
	  						<?php echo form_input(['type' => 'number','name' => 'EstimatedCost', 'class' => 'form-control col-lg-6','maxlength' => 6,'step' => 0.01],$project->EstimatedCost); ?>
                            <span><?php echo form_error('EstimatedCost') ?></span>
						</div>
					</div>
				</div>
				<div class="input-group">
					<div class="form-group col-lg-6">
						<label>District<i class="text-warning">*</i></label>
						<?php $district_array = array();
						if(isset($Districts))
						{
							foreach($Districts as $District)
                            {
                                $district_array[$District->id]=$District->district_name;
                            }
                        }
							echo form_dropdown(['id' => 'FKDistrictID','name' => 'FKDistrictID', 'class' => 'browser-default custom-select col-lg-6','autocomplete' => 'off'],$district_array,$project->FKDistrictID); ?>
						<span><?php echo form_error('FKDistrictID') ?></span>
					</div>
					<div class="form-group col-lg-6">
						<label>Requested Project Funds<i class="text-warning">*</i></label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
	    						<span class="input-group-text">$</span>
	  						</div>
	  						<?php echo form_input(['type' => 'number','name' => 'RequestedProjectFunds', 'class' => 'form-control col-lg-6','maxlength' => 6,'step' => 0.01],$project->RequestedProjectFunds); ?>
                            <span><?php echo form_error('RequestedProjectFunds') ?></span>
						</div>
					</div>
				</div>
				<div class="input-group">
					<div class="form-group col-lg-6">
						<label>Country<i class="text-warning">*</i></label>
						<?php $country_array = array(0 => "");
						if(isset($Countries))
						{
							foreach($Countries as $Country)
                            {
                                $country_array[$Country->id]=$Country->country_name;
                            }
                        }
							echo form_dropdown(['id' => 'Country','name' => 'FKCountryID', 'class' => 'browser-default custom-select col-lg-6','autocomplete' => 'off'],$country_array,$project->FKCountryID); ?>
						<span><?php echo form_error('Country') ?></span>
					</div>
					<div class="form-group col-lg-6">
						<label>Individual Cost per Day</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
	    						<span class="input-group-text">$</span>
	  						</div>
	  						<?php echo form_input(['type' => 'number','name' => 'IndividualCostPerDay', 'class' => 'form-control col-lg-6','autocomplete' => 'off','maxlength' => 6,'step' => 0.01],$project->IndividualCostPerDay); ?>
                            <span><?php echo form_error('IndividualCostPerDay') ?></span>
						</div>
					</div>
				</div>
				<div class="input-group">
					<div class="form-group col-lg-6">
						<label>City<i class="text-warning">*</i></label>
						<?php echo form_input(['type' => 'text','name' => 'City', 'class' => 'form-control mb-4','autocomplete' => 'off','maxlength' => 50],$project->City); ?>
                    	<span><?php echo form_error('City') ?></span>
					</div>
					<div class="custom-control custom-checkbox col-lg-5">
						<?php echo form_checkbox(['name' => 'YouthTeamsAccepted','value' => '1','maxlength' => 1, 'checked' => $project->YouthTeamsAccepted, 'id' => 'YouthTeamsAccepted', 'class' => 'custom-control-input']); ?>
						<label for="YouthTeamsAccepted" class="custom-control-label">Youth Teams Accepted?</label>
						<span> <?php echo form_error('YouthTeamsAccepted') ?> </span>
					</div>
				</div>

				<br><h4 class="text-warning">Project Categories <i class="text-warning">*</i></h4><hr>

				<?php foreach($projectCategories as $cat) { ?>
					<div class='custom-control custom-checkbox'>
						<?php echo form_checkbox(['name' => '','value' => $cat->CategoryID, 'checked' => ((isset($cat->FKCategoryID)) ? TRUE: FALSE), 'id' => $cat->Category, 'class' => 'custom-control-input','name' => 'FKCategoryID[]']); ?>
						<label for="<?php echo $cat->Category; ?>" class="custom-control-label"><?php echo $cat->Category; ?></label>
					</div>
				<?php } ?>
				<span><?php echo form_error('FKCategoryID') ?></span>
				<br>
				<div class="form-group">
					<?php echo form_submit(['value' => "UPDATE",'class' => 'btn peach-gradient']); ?>
				</div>
				<?php echo form_close(); ?>
			</fieldset>

		</div>
	</div>
	</div>
</main>

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

<?php include('footer.php'); ?>

<script>
	var availableTags = <?php if(isset($field_array)) {echo json_encode($field_array);} ?>;
	/*var fieldsCategory = {
	  1: ["Soup", "Juice", "Tea", "Others"],
	  2: ["Soup", "Juice", "Water", "Others"],
	  4: ["Soup", "Juice", "Coffee", "Tea", "Others"]
	}*/

	function changecat(value) {
	  if (value.length == 0) document.getElementById("FKFieldID").innerHTML = "<option></option>";
	  else {
	    var catOptions = "";
	    for (categoryId in availableTags[value]) {
	    	if(categoryId == <?php echo $project->FKFieldID; ?>)
	    	{
	    		catOptions += "<option value="+ categoryId +" selected='selected' " +">" + availableTags[value][categoryId] + "</option>";
	    	}
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