<?php include('header.php'); ?>

<main>
    <div class="container-fluid">
    	<div class="card">
    		<h4 class="card-header blue-gradient white-text text-center py-3">Users</h4>
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
				        <th scope="col" class="font-weight-bold dark-grey-text">User Name</th>
				        <th scope="col" class="font-weight-bold dark-grey-text">Given Name</th>
				        <th scope="col" class="font-weight-bold dark-grey-text">Family Name</th>
				        <th scope="col" class="font-weight-bold dark-grey-text">Email</th>
				        <th scope="col" class="font-weight-bold dark-grey-text">Role</th>
				      </tr>
				    </thead>
				    <tbody>
				    <?php $i = 0;
				    	if(isset($Users)): ?>
				    	<?php foreach($Users as $User) { ?>
					      <tr>
					        <th scope="row"><?php echo $i += 1; ?></th>
					        <td class="text-truncate" style="max-width: 200px;"><?php echo anchor("users/view/{$User->PersonID}",$User->Username,["class"=>"text-info"]); ?></td>
					        <td class="text-truncate" style="max-width: 250px;" ><?php echo $User->GivenName?></td>
					        <td><?php echo $User->FamilyName ?></td>
					        <td><?php echo $User->EmailAddress ?></td>
					        <td><?php echo $User->Title ?></td>
					        <td> <?php echo ($this->session->userdata('Role') != 1 ? "" : anchor("Users/delete/{$User->PersonID}","<i class='fas fa-times'></i>",["class"=>"text-danger","onclick" => "return confirm('Are you sure you want delete?')"])); ?></td>
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