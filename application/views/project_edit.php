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
						<?php $Region = array('');
							echo form_dropdown(['id' => 'FKRegionID','name' => 'FKRegionID', 'class' => 'browser-default custom-select col-lg-6','autocomplete' => 'off'],$Region,$project->FKRegionID); ?>
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
						<?php $_Field = array('');
							//foreach($Field as $field)
							//{
							//	$_Field[$field->ListKey]=$field->Value;
							//}
							echo form_dropdown(['id' => 'FKFieldID','name' => 'FKFieldID', 'class' => 'browser-default custom-select col-lg-6','autocomplete' => 'off'],$_Field,$project->FKFieldID); ?>
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
						<label>Distict<i class="text-warning">*</i></label>
						<?php $District = array('');
							echo form_dropdown(['id' => 'FKDistrictID','name' => 'FKDistrictID', 'class' => 'browser-default custom-select col-lg-6','autocomplete' => 'off'],$District,$project->FKDistrictID); ?>
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
						<?php $Country = array('');
							echo form_dropdown(['id' => 'Country','name' => 'FKCountryID', 'class' => 'browser-default custom-select col-lg-6','autocomplete' => 'off'],$Country,$project->FKCountryID); ?>
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
						<?php echo form_checkbox(['name' => 'YouthTeamsAccepted','value' => '1','maxlength' => 1, 'checked' => $project->YouthTeamsAccepted, 'id' => 'YouthAccepted', 'class' => 'custom-control-input']); ?>
						<label for="YouthAccepted" class="custom-control-label">Youth Teams Accepted?</label>
						<span> <?php echo form_error('YouthAccepted') ?> </span>
					</div>
				</div>


				<br><h4 class="text-warning">Site Coordinator <i class="text-warning">*</i></h4><hr>
				<p>If you do not see a specific sire coordinator on this list please write to <b>nazww@nazarene.org</b> with the site coordinator's name, email address and phone number and a note to add them as a site coordinator.</p>
				<p><i>Note: This field does not populate until you have specified what district a project is located on.</i></p>
				<div class="input-group">
					<div class="form-group col-lg-6">
						<label>Coordinator<i class="text-warning">*</i></label>
						<?php $Coordinator = array('');
							echo form_dropdown(['id' => 'FKSiteCoordinatorID','name' => 'FKSiteCoordinatorID', 'class' => 'browser-default custom-select col-lg-8'],$Coordinator,$project->FKSiteCoordinatorID); ?>
						<span><?php echo form_error('FKSiteCoordinatorID') ?></span>
					</div>
				</div>

				<br><h4 class="text-warning">Project Categories <i class="text-warning">*</i></h4><hr>

				<?php foreach($Categories as $cat) { ?>
					<div class='custom-control custom-checkbox'>
						<?php echo form_checkbox(['name' => '','value' => $cat->CategoryID, 'checked' => FALSE, 'id' => $cat->Category, 'class' => 'custom-control-input','name' => 'FKCategoryID[]']); ?>
						<label for="<?php echo $cat->Category; ?>" class="custom-control-label"><?php echo $cat->Category; ?></label>
					</div>
				<?php } ?>
				<span><?php echo form_error('FKCategoryID') ?></span>

				<br>
				<div class="form-group">
					<?php echo form_submit(['value' => "UPDATE",'class' => 'btn peach-gradient']); ?>
				</div>
			</fieldset>
		<?php echo form_close(); ?>
		</div>
	</div>
	</div>
</main>

<?php include('footer.php'); ?>