<?php include('header.php'); ?>

<main>
    <div class="container-fluid">
    	<div class="card">
           	<h4 class="card-header peach-gradient white-text text-center py-3">Manage Coordinator of <b><?php echo $project->ProjectName; ?></b></h4>
  			<div class="card-body">

  			<?php echo form_open("project/SaveCoordinator/{$project->ProjectID}",['method' => 'post','id' => 'frm_project']); ?>
			<h4 class="text-warning">Site Coordinator <i class="text-warning">*</i></h4><hr>
			<p>If you do not see a specific sire coordinator on this list please write to <b>nazww@nazarene.org</b> with the site coordinator's name, email address and phone number and a note to add them as a site coordinator.</p>
			<p><i>Note: This field does not populate until you have specified what district a project is located on.</i></p>
			<div class="input-group">
				<div class="form-group col-lg-6">
					<label>Coordinator<i class="text-warning">*</i></label>
					<?php $coordinator_array = array('');
						if(isset($Coordinators))
						{
							foreach($Coordinators as $Coordinator)
	                        {
	                            $coordinator_array[$Coordinator->PersonID]=$Coordinator->GivenName.' '.$Coordinator->FamilyName;
	                        }
                        }
						echo form_dropdown(['id' => 'FKSiteCoordinatorID','name' => 'FKSiteCoordinatorID', 'class' => 'browser-default custom-select col-lg-8'],$coordinator_array,$project->FKSiteCoordinatorID); ?>
					<span><?php echo form_error('FKSiteCoordinatorID') ?></span>
				</div>
			</div>
			<div class="form-group">
				<?php echo form_submit(['value' => 'SAVE','class' => 'btn btn-sm btn-primary']); ?>
			</div>
			<?php echo form_close(); ?>

			</div>
		</div>
	</div>
</main>

<?php include('footer.php'); ?>