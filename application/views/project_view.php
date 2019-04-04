<?php include('header.php'); ?>

<main>
    <div class="container-fluid ">
    	<!-- Card -->
		<div class="card card-cascade wider reverse">

		  <!-- Card image -->
		  <div class="view view-cascade overlay">

<!--Carousel Wrapper-->
<?php if(isset($images)): ?>
<div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel" style="max-height:500px">
  <!--Indicators-->

  <ol class="carousel-indicators">
  	<?php foreach($images as $image):
  		if($image->is_thumbnail):?>
    		<li data-target="#carousel-example-2" data-slide-to="<?php echo $image->MediaID; ?>" class="active"></li>
    	<?php else: ?>
    		<li data-target="#carousel-example-2" data-slide-to="<?php echo $image->MediaID; ?>"></li>
    	<?php endif; ?>
		<?php endforeach; ?>
  </ol>
  <!--/.Indicators-->
  <!--Slides-->
  <div class="carousel-inner d-flex justify-content-center" role="listbox">
  	<?php foreach($images as $image):
		if($image->is_thumbnail):?>

			 <!--Modal: Name-->
    <div class="modal fade" id="modal<?php echo $image->MediaID ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document" >

        <!--Content-->
        <div class="modal-content">

          <!--Body-->
          <div class="modal-body mb-0 p-0">

            <div class="embed-responsive z-depth-1-half text-center">
             <img src="<?php echo base_url('uploads/'.$image->FileName)?>" class="img-fluid z-depth-1 img-thumbnail" alt="Responsive image">
            </div>

          </div>

        </div>
        <!--/.Content-->

      </div>
    </div>
    <!--Modal: Name-->


	    <div class="carousel-item active" style="max-height:500px">
	      <div class="view">
	        <img class="d-block w-100" src="<?php echo base_url('uploads/'.$image->FileName)?>" >
	        <div class="mask flex-center waves-effect rgba-black-light"></div>
	      </div>
	      <div class="carousel-caption">
        	<h3 class="h3-responsive"><?php echo $image->Title?></h3>
      	  </div>
	    </div>
	    <?php else: ?>
	    <div class="carousel-item" style="max-height:500px">
	      <!--Mask color-->
	      <div class="view">
	        <img class="d-block w-100" src="<?php echo base_url('uploads/'.$image->FileName)?>">
	        <div class="mask flex-center waves-effect rgba-black-light"></div>
	      </div>
	      <div class="carousel-caption">
        	<h3 class="h3-responsive"><?php echo $image->Title?></h3>
      	  </div>
	    </div>
	    <?php endif; ?>
		<?php endforeach; ?>
  </div>
  <!--/.Slides-->
  <!--Controls-->
  <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  <!--/.Controls-->
</div>
<?php endif; ?>
<!--/.Carousel Wrapper-->
		  </div>

		  <!-- Card content -->
		  <div class="card-body card-body-cascade text-center">
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
		    <h3 class="card-title"><strong><?php echo $project->ProjectName ?></strong></h3>
				<?php $StatusColor ='text-dark'; 
				if($project->Status == 0)
				{
					$StatusColor = "badge badge-default";
				}
				elseif($project->Status == 1)
				{
					$StatusColor = "badge badge-secondary";
				}
				elseif($project->Status == 2)
				{
					$StatusColor = "badge badge-warning";
				}
				elseif($project->Status == 3)
				{
					$StatusColor = "badge badge-success";
				}
				elseif($project->Status == 4)
				{
					$StatusColor = "badge badge-danger";
				} ?>
		    <h6 class="<?php echo $StatusColor ?>"><i>(<?php echo $project->Title ?>)</i></h6>
		    <h6 class="font-weight-bold text-warning">
		    	<?php $cats = '';
		    	foreach($projectCategories as $category)
               	{
                    if(isset($category->FKCategoryID))
                    {
                        $cats .= $category->Category." • ";
                    }
                }
                echo rtrim($cats," • ");
                ?>
			</h6>
		    <?php if($project->YouthTeamsAccepted == '1'){ ?>
		    	<p class="card-text"><i>Youth teams are welcome</i></p>
			<?php } 
			else { ?>
				<p class="card-text text-danger"><i>Not appropriate for Youth teams</i></p>
			<?php } ?>
		    <br>

		    <h6 class="font-weight-bold indigo-text ">Vision</h6>
		    <p class="text-justify"><?php echo $project->VisionObjective ?></p>
		    <h6 class="font-weight-bold indigo-text">Description</h6>
		    <p class="text-justify"><?php echo $project->Description ?></p>
		    <br>

			<div class="container">
			  <div class="row">
			    <div class="col-sm">
			      <h6 class="font-weight-bold indigo-text ">Project Details</h6>
			      <div class="row">
			        <div class="col-8 col-sm-6">
			          	<div class="row">
					        <div class="col-8 col-sm-6 text-right">
					          <b><p class="list-inline-item pr-2">Created:</p></b>
					        </div>
					        <div class="col-4 col-sm-6 text-left">
					          <?php echo date("M j, Y", strtotime($project->CreatedDate)); ?>
					        </div>
			      		</div>
			      		<div class="row">
					        <div class="col-8 col-sm-6 text-right">
					          <b><p class="list-inline-item pr-2">Expiration:</p></b>
					        </div>
					        <div class="col-4 col-sm-6 text-left">
					          <?php echo date("M j, Y", strtotime($project->ExpirationDate)); ?>
					        </div>
			      		</div>
			      		<div class="row">
					        <div class="col-8 col-sm-6 text-right">
					          <b><p class="list-inline-item pr-2">Region:</p></b>
					        </div>
					        <div class="col-4 col-sm-6 text-left">
					          <?php echo $project->RegionName; ?>
					        </div>
			      		</div>
			      		<div class="row">
					        <div class="col-8 col-sm-6 text-right">
					          <b><p class="list-inline-item pr-2">Field/World Area:</p></b>
					        </div>
					        <div class="col-4 col-sm-6 text-left">
					          <?php echo $project->FieldName; ?>
					        </div>
			      		</div>
			      		<div class="row">
					        <div class="col-8 col-sm-6 text-right">
					          <b><p class="list-inline-item pr-2">District:</p></b>
					        </div>
					        <div class="col-4 col-sm-6 text-left">
					          <?php echo $project->district_name; ?>
					        </div>
			      		</div>
			      		<div class="row">
					        <div class="col-8 col-sm-6 text-right">
					          <b><p class="list-inline-item pr-2">Country:</p></b>
					        </div>
					        <div class="col-4 col-sm-6 text-left">
					          <?php echo $project->country_name; ?>
					        </div>
			      		</div>
			      		<div class="row">
					        <div class="col-8 col-sm-6 text-right">
					          <b><p class="list-inline-item pr-2">Province/Region City:</p></b>
					        </div>
					        <div class="col-4 col-sm-6 text-left">
					          <?php echo $project->City; ?>
					        </div>
			      		</div>
			        </div>
			        <div class="col-8 col-sm-6">
			          	<div class="row">
					        <div class="col-8 col-sm-6 text-right">
					          <b><p class="list-inline-item pr-2">Arrival City:</p></b>
					        </div>
					        <div class="col-4 col-sm-6 text-left">
					          <?php echo $project->ArrivalCity; ?>
					        </div>
			      		</div>
			      		<div class="row">
					        <div class="col-8 col-sm-6 text-right">
					          <b><p class="list-inline-item pr-2">Estimated Cost:</p></b>
					        </div>
					        <div class="col-4 col-sm-6 text-left">
					          <?php echo "$".$project->EstimatedCost; ?>
					        </div>
			      		</div>
			      		<div class="row">
					        <div class="col-8 col-sm-6 text-right">
					          <b><p class="list-inline-item pr-2">Requested Project Funds:</p></b>
					        </div>
					        <div class="col-4 col-sm-6 text-left">
					          <?php echo "$".$project->RequestedProjectFunds; ?>
					        </div>
			      		</div>
			      		<div class="row">
					        <div class="col-8 col-sm-6 text-right">
					          <b><p class="list-inline-item pr-2">Individual Cost Per Day:</p></b>
					        </div>
					        <div class="col-4 col-sm-6 text-left">
					          <?php echo "$".$project->IndividualCostPerDay; ?>
					        </div>
			      		</div>
			      		<div class="row">
					        <div class="col-8 col-sm-6 text-right">
					          <b><p class="list-inline-item pr-2">Site Coordinator:</p></b>
					        </div>
					        <div class="col-4 col-sm-6 text-left">
					          <?php echo $project->SiteCoordinator; ?>
					        </div>
			      		</div>
			        </div>
			      </div>
			    </div>
			  </div>
			</div>
		    <hr>

		    <!--Accordion wrapper-->
			<div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

			 <!-- Accordion card -->
			  <div class="card text-justify">

			    <!-- Card header -->
			    <div class="card-header" role="tab" id="headingTwo2">
			      <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo2"
			        aria-expanded="false" aria-controls="collapseTwo2">
			        <p class="mb-0">
			          Project Logs
			        </p>
			      </a>
			    </div>

			    <!-- Card body -->
			    <div id="collapseTwo2" class="collapse" role="tabpanel" aria-labelledby="headingTwo2" data-parent="#accordionEx">
			      <div class="card-body">
			        <?php if(isset($logs)):  ?>
				    	<?php foreach($logs as $log) { ?>
				    		<p>• <?php echo $log->DateCreated. ' ' .$log->Title. ' by ' .$log->CreatedBy. '. ' .$log->Notes;?></p>

				    	<?php } else: ?>
				    <?php endif; ?>


			      </div>
			    </div>

			  </div>
			  <!-- Accordion card -->

			</div>
			<!-- Accordion wrapper -->

		    <?php if($project->FKSiteCoordinatorID != 0)
		    {
		    	echo anchor("","<i class='fa fa-phone mr-1'></i>Contact Coordinator",["class"=>"btn btn-primary btn-sm", "data-toggle"=>"modal", "data-target"=>"#modalLoginAvatar"]);
		    }

		    if($this->session->userdata('Role') == 3 and $project->Status == 1)
		    {
		    	echo anchor("Project/coordinator/{$project->ProjectID}","<i class='fas fa-user-cog'></i> Manage Coordinator",["class"=>"btn btn-primary btn-sm"]);
		    }

		    if($this->session->userdata('Role') == 1)
		    {
		    	echo anchor("Project/coordinator/{$project->ProjectID}","<i class='fas fa-user-cog'></i> Manage Coordinator",["class"=>"btn btn-primary btn-sm"]);
		    	echo anchor("Project/edit/{$project->ProjectID}","<i class='fas fa-pencil-alt'></i> Edit",["class"=>"btn btn-warning btn-sm"]);
				echo anchor("Project/images/{$project->ProjectID}","<i class='fas fa-file-image'></i> Images",["class"=>"btn btn-unique btn-sm"]);
				echo anchor("Project/delete/{$project->ProjectID}","<i class='fas fa-trash mr-1'></i>Delete",["class"=>"btn btn-danger btn-sm","onclick" => "return confirm('Are you sure you want delete?')"]);
				echo anchor("Project/ChangeStatus/{$project->ProjectID}/0","<i class='fas fa-undo-alt'></i> Return to Draft",["class"=>"btn btn-default btn-sm","onclick" => "return confirm('This project is being reviewed, Do you wish to continue?')"]);
		    }

		    	if($project->Status == 1)
		    	{
		    		if($this->session->userdata('Role') == 3)
		    		{
			    		echo anchor(($project->FKSiteCoordinatorID != 0 ? "Project/ChangeStatus/{$project->ProjectID}/2": "Project/coordinator/{$project->ProjectID}"),"<i class='fas fa-thumbs-up'></i> Submit to Region",["class"=>"btn btn-success btn-sm","onclick" => ($project->FKSiteCoordinatorID != 0 ? "return confirm('This project will now proceed for Regional Approval, do you wish you to continue?')" : "return alert('Please assign a SITE COORDINATOR before proceeding to this action.')")]);
						echo anchor("","<i class='fas fa-thumbs-down'></i> Disapprove",["data-toggle" => "modal","data-target" => "#mdlDisapprove","class"=>"btn btn-danger btn-sm"]);
						echo anchor("Project/ChangeStatus/{$project->ProjectID}/0","<i class='fas fa-undo-alt'></i> Return to Draft",["class"=>"btn btn-default btn-sm","onclick" => "return confirm('This project is being reviewed, Do you wish to continue?')"]);
		    		}
		    		elseif($this->session->userdata('Role') == 1)
		    		{
						echo anchor(($project->FKSiteCoordinatorID != 0 ? "Project/ChangeStatus/{$project->ProjectID}/2": "Project/coordinator/{$project->ProjectID}"),"<i class='fas fa-thumbs-up'></i> Submit to Region",["class"=>"btn btn-success btn-sm","onclick" => ($project->FKSiteCoordinatorID != 0 ? "return confirm('This project will now proceed for Regional Approval, do you wish you to continue?')" : "return alert('Please assign a SITE COORDINATOR before proceeding to this action.')")]);
						echo anchor("","<i class='fas fa-thumbs-down'></i> Disapprove",["data-toggle" => "modal","data-target" => "#mdlDisapprove","class"=>"btn btn-danger btn-sm"]);
		    		}

		    	}
		    	elseif(($this->session->userdata('Role') == 4 or $this->session->userdata('Role') == 1 ) and $project->Status == 2)
		    	{
		    		echo anchor("Project/ChangeStatus/{$project->ProjectID}/3","<i class='fas fa-thumbs-up'></i> Approve",["class"=>"btn btn-success btn-sm","onclick" => "return confirm('Are you sure you want to Approve this project?')"]);
		    		echo anchor("","<i class='fas fa-thumbs-down'></i> Disapprove",["data-toggle" => "modal","data-target" => "#mdlDisapprove","class"=>"btn btn-danger btn-sm"]);
		    	}
		    	elseif($project->Status == 0)
		    	{
				    if($this->session->userdata('PersonID') == $project->FKCreatedByID)
				    {
					    echo anchor("Project/ChangeStatus/{$project->ProjectID}/1","<i class='fas fa-check'></i> Submit",["class"=>"btn btn-info btn-sm","onclick" => "return confirm('Are you sure you want to submit this project? Project cannot be editted once submitted.')"]);
			    		echo anchor("Project/edit/{$project->ProjectID}","<i class='fas fa-pencil-alt'></i> Edit",["class"=>"btn btn-warning btn-sm"]);
						echo anchor("Project/images/{$project->ProjectID}","<i class='fas fa-file-image'></i> Images",["class"=>"btn btn-unique btn-sm"]);
						echo anchor("Project/delete/{$project->ProjectID}","<i class='fas fa-trash mr-1'></i>Delete",["class"=>"btn btn-danger btn-sm","onclick" => "return confirm('Are you sure you want delete?')"]);
				    }
				    elseif($this->session->userdata('Role') == 1)
				    {
				    	echo anchor("Project/ChangeStatus/{$project->ProjectID}/1","<i class='fas fa-check'></i> Submit",["class"=>"btn btn-info btn-sm","onclick" => "return confirm('Are you sure you want to submit this project? Project cannot be editted once submitted.')"]);
				    }
		    	}
		    	elseif(($this->session->userdata('PersonID') == $project->FKCreatedByID or $this->session->userdata('Role') == 1) and $project->Status == 4)
		    	{
					echo anchor("Project/ChangeStatus/{$project->ProjectID}/0","<i class='fas fa-undo-alt'></i> Return to Draft",["class"=>"btn btn-default btn-sm","onclick" => "return confirm('This project is being reviewed, Do you wish to continue?')"]);
		    	}

			/*if($this->session->userdata('CanApprove') and $project->Status != 4)
		    	{
		    		if($this->session->userdata('Role') == 3 and $project->Status == 1)
		    		{
						echo anchor(($project->FKSiteCoordinatorID != 0 ? "Project/ChangeStatus/{$project->ProjectID}/2": "Project/coordinator/{$project->ProjectID}"),"<i class='fas fa-thumbs-up'></i> Submit to Region",["class"=>"btn btn-success btn-sm","onclick" => ($project->FKSiteCoordinatorID != 0 ? "return confirm('This project will now proceed for Regional Approval, do you wish you to continue?')" : "return alert('Please assign a SITE COORDINATOR before proceeding to this action.')")]);
						echo anchor("","<i class='fas fa-thumbs-down'></i> Disapprove",["data-toggle" => "modal","data-target" => "#mdlDisapprove","class"=>"btn btn-danger btn-sm"]);
		    		}
		    		elseif($this->session->userdata('Role') == 1 and $project->Status == 0)
		    		{
						echo anchor("Project/ChangeStatus/{$project->ProjectID}/1","<i class='fas fa-check'></i> Submit",["class"=>"btn btn-info btn-sm","onclick" => "return confirm('Are you sure you want to submit this project? Project cannot be editted once submitted.')"]);
		    		}
		    		elseif($this->session->userdata('Role') == 4 and $project->Status == 2)
		    		{
		    			echo anchor("Project/ChangeStatus/{$project->ProjectID}/3","<i class='fas fa-thumbs-up'></i> Approve",["class"=>"btn btn-success btn-sm","onclick" => "return confirm('Are you sure you want to Approve this project?')"]);
		    			echo anchor("","<i class='fas fa-thumbs-down'></i> Disapprove",["data-toggle" => "modal","data-target" => "#mdlDisapprove","class"=>"btn btn-danger btn-sm"]);
		    		}
		    	}
		    if(($project->Status == 1 or $project->Status == 4) and ($this->session->userdata('PersonID') == $project->FKCreatedByID))
		    {
		    	echo anchor("Project/ChangeStatus/{$project->ProjectID}/0","<i class='fas fa-undo-alt'></i> Return to Draft",["class"=>"btn btn-default btn-sm","onclick" => "return confirm('This project is being reviewed, Do you wish to continue?')"]);
		    }
		    else
		    {
		    	if(($this->session->userdata('PersonID') == $project->FKCreatedByID and $project->Status == 0)  or ($this->session->userdata('Role') == 1))
		    	{
		    		echo anchor("Project/ChangeStatus/{$project->ProjectID}/1","<i class='fas fa-check'></i> Submit",["class"=>"btn btn-info btn-sm","onclick" => "return confirm('Are you sure you want to submit this project? Project cannot be editted once submitted.')"]);
					echo anchor("Project/edit/{$project->ProjectID}","<i class='fas fa-pencil-alt'></i> Edit",["class"=>"btn btn-warning btn-sm"]);
					echo anchor("Project/images/{$project->ProjectID}","<i class='fas fa-file-image'></i> Images",["class"=>"btn btn-unique btn-sm"]);
					echo anchor("Project/delete/{$project->ProjectID}","<i class='fas fa-trash mr-1'></i>Delete",["class"=>"btn btn-danger btn-sm","onclick" => "return confirm('Are you sure you want delete?')"]);
				}
		    }*/ ?>
		  </div>

			<!--Modal: Login with Avatar Form-->
			<div class="modal fade" id="modalLoginAvatar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
			  aria-hidden="true">
			  <div class="modal-dialog cascading-modal modal-avatar" role="document">
			    <!--Content-->
			    <div class="modal-content">

			      <!--Header-->
			      <div class="modal-header">
			        <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(27).jpg" alt="avatar" class="rounded-circle img-responsive">
			      </div>
			     <div class="modal-body mx-3">
			     	<h5 class="mt-1 mb-2 text-center">say something to <b><?php echo $project->SiteCoordinator; ?></b></h5>

		        <div class="md-form mb-5">
		          <input type="text" id="form32" class="form-control validate">
		          <label data-error="wrong" data-success="right" for="form32">Subject</label>
		        </div>

		        <div class="md-form">
		          <textarea type="text" id="form8" class="md-textarea form-control" rows="4"></textarea>
		          <label data-error="wrong" data-success="right" for="form8">Your message</label>
		        </div>

		      </div>
		      <div class="modal-footer d-flex justify-content-center">
		        <button class="btn btn-unique">Send</button>
		      </div>
		    </div>

			    </div>
			    <!--/.Content-->
			  </div>
			</div>
			<!--Modal: Login with Avatar Form-->

		</div>
  	</div>
</main>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="mdlDisapprove" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Disapprove Project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    	<?php echo form_open("Project/ChangeStatus/{$project->ProjectID}/4",['method' => 'post','id' => 'frm_project']); ?>
      <div class="modal-body">
	        <div class="form-group">
				<label>Please state your reason here:</label>
				<?php echo form_textarea(['type' => 'text','name' => 'Notes', 'class' => 'form-control','autocomplete' => 'off','rows' => 4]); ?>
			</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-secondary">DISAPPROVE</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<?php include('footer.php'); ?>