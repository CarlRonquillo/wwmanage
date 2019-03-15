<?php include('header.php'); ?>

<main>
    <div class="container-fluid">
    	<div class="card">
    		<h4 class="card-header blue-gradient white-text text-center py-3">Projects</h4>
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
	  			<div class="table-responsive">
	  			<div class="card-group">
				  <table id="tblProjects"  class="table table table-responsive text-wrap table-hover table-striped" cellspacing="0" width="100%">
				    <thead>
				      <tr>
				        <th scope="col" class="font-weight-bold dark-grey-text">#</th>
				        <!--<th scope="col" class="font-weight-bold dark-grey-text"></th>-->
				        <th scope="col" class="font-weight-bold dark-grey-text">Project Name</th>
				        <th scope="col" class="font-weight-bold dark-grey-text">Short Description</th>
				        <th scope="col" class="font-weight-bold dark-grey-text">Country</th>
				        <th scope="col" class="font-weight-bold dark-grey-text">Field</th>
				        <th scope="col" class="font-weight-bold dark-grey-text">Site-Coordinator</th>
				        <th scope="col" class="font-weight-bold dark-grey-text">Status</th>
				      </tr>
				    </thead>
				    <tbody>
				    <?php $i = 0;
				    	if(isset($projects)):  ?>
				    	<?php foreach($projects as $project) { $StatusColor ='text-dark';?>
				    		<?php if($project->Status == 0)
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
						    }
					     ?>
					      <tr class="<?php echo ($project->Active ? '' : 'table-danger' ) ?>">
					        <td scope="row"><?php echo $i += 1; ?></td>
					        <!--<td scope="row"><img src="<?php echo base_url('uploads/'.((!isset($project->FileName)) ? 'alt_logo.jpg' : $project->FileName))?>" alt="thumbnail" class="img-thumbnail" style="width: 120px"></td>-->
					        <td style="max-width: 20%;"><?php echo anchor("project/view/{$project->ProjectID}",$project->ProjectName,["class"=>"text-info"]); ?>
					        </td>
					        <td class="text-justify" style="max-width: 30%;" ><?php echo substr($project->Description,0,120).((strlen($project->Description) < 120) ? '' : '...') ?></td>
					        <td><?php echo $project->country_name ?></td>
					        <td><?php echo $project->FieldName ?></td>
					        <td><?php echo $project->GivenName.' '.$project->FamilyName ?></td>
					        <td><i class="<?php echo ($project->Active ? $StatusColor : 'badge badge-danger'); ?>"><?php echo  ($project->Active ? $project->Title : 'Inactive') ?></i></td>
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

<script type="text/javascript">
	$(document).ready(function () {
		$('#tblProjects').DataTable();
		$('.dataTables_length').addClass('bs-select');
	});
</script>


