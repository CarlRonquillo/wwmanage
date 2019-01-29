<?php include('header.php'); ?>

<main>
    <div class="container-fluid ">
    	<!-- Card -->
		<div class="card card-cascade wider reverse">

		  <!-- Card image -->
		  <div class="view view-cascade overlay">
		    <!--Carousel Wrapper-->
			<div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel" style="height:300px">
			  <!--Indicators-->
			  <ol class="carousel-indicators">
			    <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
			    <li data-target="#carousel-example-1z" data-slide-to="1"></li>
			    <li data-target="#carousel-example-1z" data-slide-to="2"></li>
			  </ol>
			  <!--/.Indicators-->
			  <!--Slides-->
			  <div class="carousel-inner" role="listbox">
			    <!--First slide-->
			    <div class="carousel-item active">
			      <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(130).jpg" alt="First slide">
			    </div>
			    <!--/First slide-->
			    <!--Second slide-->
			    <div class="carousel-item">
			      <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(129).jpg" alt="Second slide">
			    </div>
			    <!--/Second slide-->
			    <!--Third slide-->
			    <div class="carousel-item">
			      <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(70).jpg" alt="Third slide">
			    </div>
			    <!--/Third slide-->
			  </div>
			  <!--/.Slides-->
			  <!--Controls-->
			  <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
			  <!--/.Controls-->
			</div>
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
		    <h6><i>(<?php echo $project->Title ?>)</i></h6>
		    <h6 class="font-weight-bold text-warning">Compassionate Ministries • Construction • Evangelism</h6>
		    <ul class="list-unstyled list-inline font-small">
		      <li class="list-inline-item pr-2"><i class="fa fa-clock-o pr-1"></i><?php echo date("M j, Y", strtotime($project->CreatedDate))." - ".date("M j, Y", strtotime($project->ExpirationDate)) ?></li>
		      <li class="list-inline-item pr-2"><abbr title="Arrival City" class="initialism"><i class="fa fa-map-marker pr-1"></i></abbr><?php echo $project->ArrivalCity ?></li>
		      <li class="list-inline-item pr-2"><abbr title="Created By" class="initialism"><i class="fas fa-user-tie pr-1"></i></abbr><?php echo $project->GivenName.' '.$project->FamilyName; ?></li>
		      <li class="list-inline-item pr-2">|</li>
		      <li class="list-inline-item"><b><abbr title="Estimated Cost" class="initialism">EC </abbr></b><?php echo "$".$project->EstimatedCost ?></li>
		      <li class="list-inline-item"><b><abbr title="Requested Fund" class="initialism">RF </abbr></b><?php echo "$".$project->RequestedProjectFunds ?></li>
		      <li class="list-inline-item"><b><abbr title="Individual Cost Per Day" class="initialism">ICD </abbr></b><?php echo "$".$project->IndividualCostPerDay ?></li>
		    </ul>
		    <?php if($project->YouthTeamsAccepted == '1'){ ?>
		    	<p class="card-text"><i>Youth Teams Welcome</i></p>
			<?php } ?>
		    <br>

		    <h6 class="font-weight-bold indigo-text ">Vision</h6>
		    <p class="card-text text-justify"><?php echo $project->VisionObjective ?></p>
		    <h6 class="font-weight-bold indigo-text">Description</h6>
		    <p class="card-text text-justify"><?php echo $project->Description ?></p>
		    <br>

		    <?php echo anchor("","<i class='fa fa-phone mr-1'></i>Contact Coordinator",["class"=>"btn btn-primary btn-sm"]); ?>
		    <?php 
			if($this->session->userdata('CanApprove') and $project->Status != 4)
		    	{
		    		if($this->session->userdata('Role') == 3 and $project->Status == 1)
		    		{
						echo anchor("Project/ChangeStatus/{$project->ProjectID}/2","<i class='fas fa-thumbs-up'></i> Submit to Region",["class"=>"btn btn-success btn-sm","onclick" => "return alert('This project will now proceed for Regional Approval, do you wish you to continue?')"]);
						echo anchor("Project/ChangeStatus/{$project->ProjectID}/4","<i class='fas fa-thumbs-down'></i> Disapprove",["class"=>"btn btn-danger btn-sm","onclick" => "return alert('Are you sure you want to Approve this Project?')"]);
		    		}
		    		elseif($this->session->userdata('Role') == 4 and $project->Status == 2)
		    		{
		    			echo anchor("Project/ChangeStatus/{$project->ProjectID}/3","<i class='fas fa-thumbs-up'></i> Approve",["class"=>"btn btn-success btn-sm","onclick" => "return alert('Are you sure you want to Approve this project?')"]);
		    			echo anchor("Project/ChangeStatus/{$project->ProjectID}/4","<i class='fas fa-thumbs-down'></i> Disapprove",["class"=>"btn btn-danger btn-sm","onclick" => "return alert('Are you sure you want to Approve this Project?')"]);
		    		}
		    	}
		    if(($project->Status == 1 or $project->Status == 4) and ($this->session->userdata('PersonID') == $project->FKCreatedByID))
		    {
		    	echo anchor("Project/ChangeStatus/{$project->ProjectID}/0","<i class='fas fa-undo-alt'></i> Return to Draft",["class"=>"btn btn-default btn-sm","onclick" => "return alert('This project is being reviewed, Do you wish to continue?')"]);
		    }
		    else
		    {
		    	if($this->session->userdata('PersonID') == $project->FKCreatedByID and $project->Status == 0)
		    	{
					echo anchor("Project/ChangeStatus/{$project->ProjectID}/1","<i class='fas fa-check'></i> Submit",["class"=>"btn btn-info btn-sm","onclick" => "return confirm('Are you sure you want to submit this project? Project cannot be editted once submitted.')"]);
					echo anchor("Project/edit/{$project->ProjectID}","<i class='fas fa-pencil-alt'></i> Edit",["class"=>"btn btn-warning btn-sm"]);
					echo anchor("Project/delete/{$project->ProjectID}","<i class='fas fa-trash mr-1'></i>Delete",["class"=>"btn btn-danger btn-sm","onclick" => "return confirm('Are you sure you want delete?')"]);
				}
		    } ?>
		  </div>

		</div>
  	</div>
</main>

<?php include('footer.php'); ?>