<?php include('header.php'); ?>

<main>
    <div class="container-fluid">
    	<div class="card">
           	<h4 class="card-header peach-gradient white-text text-center py-3">Images of <b><?php echo $ProjectName->ProjectName;?></b></h4>
  			<div class="card-body">
  				<?php if($error = $this->session->flashdata('response')): ?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<span class ="glyphicon glyphicon-info-sign"></span>
						<?php echo $error; ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    						<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php endif ?>

				<?php echo form_open_multipart('project/do_upload/'.$ProjectName->ProjectID);?>
  				<div class="form-group col-lg-6">
					<input type="file" name="userfile" size="20" />
				</div>

				<div class="form-group col-lg-6">
					<label>Image Title<i class="text-warning">*</i></label>
					<?php echo form_input(['type' => 'text','id' => 'Title','name' => 'Title', 'class' => 'form-control mb-4',
                                                    'autocomplete' => 'off','maxlength' => 50,'placeholder' => 'Write something about the image here..']); ?>
                    <span><?php echo form_error('Title') ?></span>
				</div>

				<div class="form-group">
					<?php echo form_submit(['value' => 'UPLOAD','class' => 'btn btn-sm btn-primary']); ?>
				</div>
				</form>

				<!-- Grid row -->
<div class="row">
	<?php if(count($images)): ?>
		<?php foreach($images as $image):?>
  <!-- Grid column -->
  <div class="col-lg-4 col-md-12 mb-4">

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

    <!-- Card Wider -->
<div class="card card-cascade wider">

  <!-- Card image -->
  <div class="view view-cascade overlay">
    <a><img class="img-fluid z-depth-1 hoverable" src="<?php echo base_url('uploads/'.$image->FileName)?>"
        data-toggle="modal" data-target="#modal<?php echo $image->MediaID ?>"></a>
  </div>

  <!-- Card content -->
  <div class="card-body card-body-cascade text-center">

    <!-- Title -->
    <h5 class="card-title"><strong><?php echo $image->Title; ?></strong></h5>

    <?php if($image->is_thumbnail): ?>
    	<?php echo anchor("project/setThumbnail/{$image->MediaID}/{$image->FKProjectID}","<i class='fas fa-star amber-text'></i>",["class"=>"px-2 fa-lg tw-ic"]); ?>
	<?php else: ?>
		<?php echo anchor("project/setThumbnail/{$image->MediaID}/{$image->FKProjectID}","<i class='far fa-star amber-text'></i>",["class"=>"px-2 fa-lg tw-ic"]); ?>
	<?php endif; ?>

	<?php echo anchor("project/view/{$ProjectName->ProjectID}","<i class='fas fa-pencil-alt green-text'></i>",["class"=>"px-2 fa-lg tw-ic"]); ?>
	<?php echo anchor("project/deleteImage/{$image->MediaID}/{$ProjectName->ProjectID}","<i class='fas fa-times red-text'></i>",["class"=>"px-2 fa-lg tw-ic","onclick" => "return confirm('Are you sure you want to DELETE this image?')"]); ?>

  </div>

</div>
<!-- Card Wider -->

  </div>
		<?php endforeach; ?>
	<?php endif; ?>
  <!-- Grid column -->

</div>
<!-- Grid row -->

				<?php echo anchor("project/view/{$ProjectName->ProjectID}",'back to view',["class"=>"text-info"]); ?>


			</div>
		</div>
	</div>
</main>

<?php include('footer.php'); ?>