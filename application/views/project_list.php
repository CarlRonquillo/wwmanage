<?php include('header.php'); ?>

<main>
    <div class="container-fluid">
    	<div class="card">
    		<h4 class="card-header blue-gradient white-text text-center py-3">My Project</h4>
  			<div class="card-body">
	  			<div class="table-responsive text-wrap table-hover table-striped">
	  			<div class="card-group">
				  <table class="table">
				    <thead>
				      <tr>
				        <th scope="col" class="font-weight-bold dark-grey-text">#</th>
				        <th scope="col" class="font-weight-bold dark-grey-text">Project Name</th>
				        <th scope="col" class="font-weight-bold dark-grey-text">Short Description</th>
				        <th scope="col" class="font-weight-bold dark-grey-text">Arrival City</th>
				        <th scope="col" class="font-weight-bold dark-grey-text">Est Cost</th>
				        <th scope="col" class="font-weight-bold dark-grey-text">Req Funds</th>
				        <th scope="col" class="font-weight-bold dark-grey-text">Status</th>
				        <th scope="col" class="font-weight-bold dark-grey-text">Created Date</th>
				        <th scope="col" class="font-weight-bold dark-grey-text">Exp Date</th>
				      </tr>
				    </thead>
				    <tbody>
				    <?php $i = 0;
				    	if(count($projects)): ?>
				    	<?php foreach($projects as $project) { ?>
					      <tr>
					        <th scope="row"><?php echo $i += 1; ?></th>
					        <td class="text-truncate" style="max-width: 200px;"><?php echo anchor("project/view/{$project->ProjectID}",$project->ProjectName); ?></td>
					        <td class="text-truncate" style="max-width: 250px;" ><?php echo $project->Description?></td>
					        <td><?php echo $project->ArrivalCity ?></td>
					        <td><?php echo "$".$project->EstimatedCost ?></td>
					        <td><?php echo "$".$project->RequestedProjectFunds ?></td>
					        <td><?php echo "Active" ?></td>
					        <td><?php echo date("M j, Y", strtotime($project->CreatedDate)) ?></td>
					        <td><?php echo $project->ExpirationDate ?></td>
					      </tr>
					    <?php } else: ?>
					    <td>No record(s) Found!</td>
					<?php endif; ?>
				    </tbody>
				  </table>
				</div>
				</div>
  			</div>
  		</div>
  	</div>
</main>

<?php include('footer.php'); ?>