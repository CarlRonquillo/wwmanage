<?php include('header.php'); ?>

<main>
    <div class="container-fluid">
    	<div class="card">
    		<h4 class="card-header blue-gradient white-text text-center py-3"><?php echo $team->TeamName;?></h4>
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

				Current Project:<h4><?php echo (isset($team->FKProjectID) ? anchor("project/view/{$team->FKProjectID}",$team->ProjectName,["class"=>"text-default"]) : 'None'); ?></h4><br>
				<div class="card">
					<div class="card-body">
						<h4 class="text-warning card-title">Team Members</h4><hr>
			  			<div class="table-responsive text-wrap table-hover table-striped">
			  			<div class="card-group">
						  <table class="table">
						    <thead>
						      <tr>
						        <th scope="col" class="font-weight-bold dark-grey-text">#</th>
						        <th scope="col" class="font-weight-bold dark-grey-text">Full Name</th>
						        <th scope="col" class="font-weight-bold dark-grey-text">Email Address</th>
						      </tr>
						    </thead>
						    <tbody>
						    <?php $i = 0;
						    	if(isset($members)):  ?>
						    	<?php foreach($members as $member) {?>
							      <tr class="text-danger">
							        <td scope="row"><?php echo $i += 1; ?></td>
							        <td><?php echo anchor("Users/view/{$member->PersonID}",$member->GivenName.' '.$member->FamilyName,["class"=>"text-info"]) ?></td>
							        <td><?php echo $member->EmailAddress;?></td>
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
  		</div>
  	</div>
</main>

<?php include('footer.php'); ?>