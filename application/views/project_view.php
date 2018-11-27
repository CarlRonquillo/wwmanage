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
		    <h3 class="card-title"><strong><?php echo $project->ProjectName ?></strong></h3>
		    <h6 class="font-weight-bold text-warning">Compassionate Ministries • Construction • Evangelism</h6>
		    <ul class="list-unstyled list-inline font-small">
		      <li class="list-inline-item pr-2"><i class="fa fa-clock-o pr-1"></i><?php echo date("M j, Y", strtotime($project->CreatedDate))." - ".date("M j, Y", strtotime($project->ExpirationDate)) ?></li>
		      <li class="list-inline-item pr-2"><i class="fa fa-map-marker pr-1"></i><?php echo $project->ArrivalCity ?></li>
		      <li class="list-inline-item pr-2"><i class="fa fa-user pr-1"> </i>Juan dela Cruz</li>
		      <li class="list-inline-item pr-2">|</li>
		      <li class="list-inline-item"><b><abbr title="Estimated Cost" class="initialism">EC </abbr></b><?php echo "$".$project->EstimatedCost ?></li>
		      <li class="list-inline-item"><b><abbr title="Requested Fund" class="initialism">RF </abbr></b><?php echo "$".$project->RequestedProjectFunds ?></li>
		      <li class="list-inline-item"><b><abbr title="Individual Cost Per Day" class="initialism">ICD </abbr></b><?php echo "$".$project->IndividualCostPerDay ?></li>
		    </ul>
		    <p class="card-text"><i>Team Opportunity | Youth Teams Welcome</i></p>
		    <br>

		    <h6 class="font-weight-bold indigo-text ">Vision</h6>
		    <p class="card-text text-justify"><?php echo $project->VisionObjective ?></p>
		    <h6 class="font-weight-bold indigo-text">Description</h6>
		    <p class="card-text text-justify"><?php echo $project->Description ?></p>
		    <br>

		    <?php echo anchor("","<i class='fa fa-phone mr-1'></i>Contact Coordinator",["class"=>"btn btn-primary btn-sm"]); ?>
		    <?php echo anchor("Project/edit/{$project->ProjectID}","<i class='fa fa-pencil mr-1'></i>Edit",["class"=>"btn btn-light-green btn-sm"]); ?>
		    <?php echo anchor("","<i class='fa fa-close mr-1'></i>Delete",["class"=>"btn btn-danger btn-sm"]); ?>

		  </div>

		</div>
  	</div>
</main>

<?php include('footer.php'); ?>