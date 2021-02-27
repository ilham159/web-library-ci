<!-- Begin Page Content -->

<div class="container-fluid">
	
	<!-- Page Heading -->
		<h1 class="h3 mb-4 text-gray-800"><?php echo $judul;?></h1>


		<div class="row">
			<div class="col-lg-6">
				<?php echo $this->session->flashdata('message'); ?>
				<form action="<?php echo base_url('auth/change_password');?>" method="post">
					<div class="form-group">
						<label class="control-label col-xs-3" for="current_password">Current Password</label>
						<div class="col-xs-8">
							<input type="password" class="form-control" id="current_password" name="current_password" placeholder="your current password ..."><?php echo form_error('current_password', '<small class="text-danger pl-3">', '</small>');?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3" for="new_password1">New Password</label>
						<div class="col-xs-8">
							<input type="password" class="form-control" id="new_password1" name="new_password1" placeholder="your new password ..."><?php echo form_error('new_password1', '<small class="text-danger pl-3">', '</small>');?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3" for="new_password2">Confirm Password</label>
						<div class="col-xs-8">
							<input type="password" class="form-control" id="new_password2" name="new_password2" placeholder="confirm password ..."><?php echo form_error('new_password2', '<small class="text-danger pl-3">', '</small>');?>
						</div>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Change Password</button>
					</div>
				</form>
			</div>
		</div>

</div>
<script type="text/javascript">
	$('.alert').alert().delay(10000).slideUp('slow');
</script>