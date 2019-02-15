<?php include('header.php'); ?>

<main>
    <div class="container-fluid">
    	<div class="card">
           	<h4 class="card-header peach-gradient white-text text-center py-3">Edit <b><?php echo $image->Title;?></b></h4>
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

				<?php echo form_open_multipart('project/updateImage/'.$image->MediaID.'/'.$image->FKProjectID.'/'.$image->FileName);?>
  				<div class="form-group col-lg-6">
					<input type="file" id="userfile" name="userfile" size="20" /><br><br>
					<img id="imgPreview" src="<?php echo base_url('uploads/'.$image->FileName)?>" class="img-fluid z-depth-1 img-thumbnail" alt="Responsive image" />
				</div>

				<div class="form-group col-lg-6">
					<label>Image Title<i class="text-warning">*</i></label>
					<?php echo form_input(['type' => 'text','id' => 'Title','name' => 'Title', 'class' => 'form-control mb-4',
                                                    'autocomplete' => 'off','maxlength' => 50,'placeholder' => 'Write something about the image here..'],$image->Title); ?>
                    <span><?php echo form_error('Title') ?></span>
				</div>

				<div class="form-group">
					<?php echo form_submit(['value' => 'SAVE','class' => 'btn btn-sm btn-primary']); ?>
				</div>
				</form>

				<?php echo anchor("project/images/{$image->FKProjectID}",'back to images',["class"=>"text-info"]); ?>

			</div>
		</div>
	</div>
</main>

<?php include('footer.php'); ?>

<script>
	function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#imgPreview').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#userfile").change(function(){
        readURL(this);
    });
</script>