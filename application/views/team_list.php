<?php include('header.php'); ?>

<main>
    <div class="container-fluid">
    	<div class="card">
    		<h4 class="card-header blue-gradient white-text text-center py-3">Teams</h4>
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
	  			<div class="table-responsive text-wrap table-hover table-striped">
	  			<div class="card-group">
				  <table class="table">
				    <thead>
				      <tr>
				        <th scope="col" class="font-weight-bold dark-grey-text">#</th>
				        <th scope="col" class="font-weight-bold dark-grey-text">Team Name</th>
				        <th scope="col" class="font-weight-bold dark-grey-text">Current Project</th>
				        <th scope="col" class="font-weight-bold dark-grey-text">Members Count</th>
				        <th scope="col" class="font-weight-bold dark-grey-text">Date Created</th>
				      </tr>
				    </thead>
				    <tbody>
				    <?php $i = 0;
				    	if(isset($teams)):  ?>
				    	<?php foreach($teams as $team) {?>
					      <tr class="text-danger">
					        <td scope="row"><?php echo $i += 1; ?></td>
					        <td><?php echo anchor("teams/view/{$team->TeamID}",$team->TeamName,["class"=>"text-info"]) ?></td>
					        <td style="max-width: 200px;"><?php echo (isset($team->FKProjectID) ? anchor("project/view/{$team->FKProjectID}",$team->ProjectName,["class"=>"text-default"]) : 'None'); ?>
					        </td>
					        <td><?php echo $team->members;?></td>
					        <td><?php echo date("M j, Y", strtotime($team->DateCreated)) ?></td>
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