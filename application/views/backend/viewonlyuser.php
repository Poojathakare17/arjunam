<div class="row">
	<div class="col s12">
		<h4 class="pad-left-15">User Details</h4>
	</div>
</div>
<div class="row">
	<form class="col s12" method="post" action="<?php echo site_url('site/editusersubmit');?>" enctype="multipart/form-data">
		<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">

	
			<div class="input-field col m3 s12">
				<label>Name</label>
				<input type="text" style="border-bottom: 0px;" name="name" value="<?php echo set_value('name',$before->name);?>">
			</div>
	
		
			<div class="input-field col m3 s12">
				<label for="email">Email</label>
				<input type="email" id="normal-field" class="form-control" style="border-bottom: 0px;" name="email" value="<?php echo set_value('email',$before->email);?>">
			</div>
	
			<div class="input-field col m3 s12">
				<label for="phone">Phone</label>
				<input type="text" id="phone" style="border-bottom: 0px;" name="phone" value="<?php echo set_value('phone',$before->phone);?>">
			</div>

			<div class="input-field col m3 s12">
				<label for="mobile">Mobile</label>
				<input type="text" id="mobile" style="border-bottom: 0px;" name="mobile" value="<?php echo set_value('mobile',$before->mobile);?>">
			</div>
		
			<div class="input-field col m3 s12">
			<label for="status">Status</label>
				<input type="text" id="status" style="border-bottom: 0px;" name="status" value="<?php echo set_value('status',$before->status);?>">
			</div>
		
			<div class="input-field col m3 s12">
			<label for="accesslevel">Accesslevel</label>
				<input type="text" id="accesslevel" style="border-bottom: 0px;" name="accesslevel" value="<?php echo set_value('accesslevel',$before->accesslevel);?>">
			</div>
	
		
	
			<div class="input-field col m3 s12">
				<label for="empno">Employee No</label>
				<input type="text" id="empno" style="border-bottom: 0px;" name="empno" value="<?php echo set_value('empno',$before->empno);?>">
			</div>
	
			<div class="input-field col m3 s12">
				<label for="fax">Fax</label>
				<input type="text" id="fax" style="border-bottom: 0px;" name="fax" value="<?php echo set_value('fax',$before->fax);?>">
			</div>
	
			<div class="input-field col m3 s12">
			<label for="gender">Gender</label>
				<input type="text" id="gender" style="border-bottom: 0px;" name="gender" value="<?php echo set_value('gender',$before->gender);?>">
			</div>
			<div class="input-field col m3 s12">
			<label for="dept">Department</label>
				<input type="text" id="dept" style="border-bottom: 0px;" name="dept" value="<?php echo set_value('dept',$before->dept);?>">
			</div>
			</div>
			<div class="row">
			<div class="file-field input-field col m3 s12 row">
				<span class="img-center big">
				<?php if($before->image == "") { } else {
				?><img src="<?php echo base_url('uploads')."/".$before->image; ?>">
					<?php } ?>
					</span>
				<!-- <div class="btn blue darken-4">
					<span>Image</span>
					<input name="image" type="file" multiple>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text" placeholder="Upload one or more files" value="<?php echo set_value('image',$before->image);?>">
				</div> -->
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