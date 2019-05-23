<div class="row">
	<div class="col s12">
		<h4 class="pad-left-15">Edit User</h4>
	</div>
</div>
<span class="validation-error"><?php echo $alerterror;?></span>
<div class="row">
	<form class="col s12" method="post" action="<?php echo site_url('site/editusersubmit');?>" enctype="multipart/form-data">
		<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">

	
			<div class="input-field col m3 s12">
				<label>Name *</label>
				<input type="text" name="name" value="<?php echo set_value('name',$before->name);?>">
			</div>
	
		
			<div class="input-field col m3 s12">
				<label for="email">Email *</label>
				<input type="email" id="normal-field" class="form-control" name="email" value="<?php echo set_value('email',$before->email);?>">
			</div>
	
			<div class="input-field col m3 s12">
				<input type="password" name="password" value="" id="password">
				<label for="password">Password *</label>
			</div>
	
			<!-- <div class="input-field col m3 s12">
				<input type="password" name="confirmpassword" value="" id="confirmpassword">
				<label for="confirmpassword">Confirm Password</label>
			</div> -->
	
	
       
			<div class="input-field col m3 s12">
				<label for="phone">Phone</label>
				<input type="text" id="phone" name="phone" value="<?php echo set_value('phone',$before->phone);?>">
			</div>

			<div class="input-field col m3 s12">
				<label for="mobile">Mobile *</label>
				<input type="text" id="mobile" name="mobile" value="<?php echo set_value('mobile',$before->mobile);?>">
			</div>
		
			<div class="input-field col m3 s12">
				<?php echo form_dropdown( 'status',$status,set_value( 'status',$before->status)); ?>
					<label>Status</label>
			</div>
		
			<div class="input-field col m3 s12">
				<?php echo form_dropdown( 'accesslevel',$accesslevel,set_value( 'accesslevel',$before->accesslevel)); ?>
					<label>Access Level  *</label>
			</div>
	
		
	
			<div class="input-field col m3 s12">
				<label for="empno">Employee No</label>
				<input type="text" id="empno" name="empno" value="<?php echo set_value('empno',$before->empno);?>">
			</div>
	
			<div class="input-field col m3 s12">
				<label for="fax">Fax</label>
				<input type="text" id="fax" name="fax" value="<?php echo set_value('fax',$before->fax);?>">
			</div>
	
			<div class="input-field col m3 s12">
				<?php echo form_dropdown( 'gender',$gender,set_value( 'gender',$before->gender)); ?>
					<label>Gender</label>
			</div>
			<div class="input-field col m3 s12">
				<?php echo form_dropdown( 'dept',$dept,set_value( 'dept',$before->dept)); ?>
					<label>Department *</label>
			</div>
			</div>
			<div class="row">
			<div class="file-field input-field col m3 s12 row">
				<span class="img-center big">
				<?php if($before->image == "") { } else {
				?><img src="<?php echo base_url('uploads')."/".$before->image; ?>">
					<?php } ?>
					</span>
				<div class="btn blue darken-4">
					<span>Image</span>
					<input name="image" type="file" multiple>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text" placeholder="Upload one or more files" value="<?php echo set_value('image',$before->image);?>">
				</div>
			</div>
			</div>
			

	<div class=" form-group">
		<div class="row">
			<div class="col m12">
				<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
				<a href="<?php echo site_url('site/viewUsers'); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
			</div>
		</div>
	</div>
	</form>
</div>