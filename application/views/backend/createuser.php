<div class="row">
	<div class="col s12">
		<h4 class="pad-left-15">Create User</h4>
	</div>
	<div id="emailresult"></div>
	<span class="validation-error"><?php echo $alerterror;?></span>
	<form class="col s12" method="post" action="<?php echo site_url('site/createusersubmit');?>" enctype="multipart/form-data">
		<div class="row">
			<div class="input-field col m3 s12">
				<label for="name">Name *</label>
				<input type="text" id="name" name="name" value="<?php echo set_value('name');?>">
			</div>
		
			<div class="input-field col m3 s12">
				<label for="email">Email *</label>
				<input type="email" id="email" class="form-control" name="email" value="<?php echo set_value('email');?>">
				
			</div>
			
			<div class="input-field col m3 s12">
				<input type="password" name="password" value="" id="password">
				<label for="password">Password *</label>
			</div>
			<div class="input-field col m3 s12">
				<label for="phone">Phone</label>
				<input type="text" id="phone" name="phone" value="<?php echo set_value('phone');?>">
			</div>
			<div class="input-field col m3 s12">
				<label for="mobile">Mobile *</label>
				<input type="text" id="mobile" name="mobile" value="<?php echo set_value('mobile');?>">
			</div>
		
			<div class="input-field col m3 s12">
				<?php echo form_dropdown( 'status',$status,set_value( 'status')); ?>
					<label>Status</label>
			</div>
		
			<div class="input-field col m3 s12">
				<?php echo form_dropdown( 'accesslevel',$accesslevel,set_value( 'accesslevel')); ?>
					<label>Access Level *</label>
			</div>
			<div class="input-field col m3 s12">
				<label for="empno">Employee No</label>
				<input type="text" id="empno" name="empno" value="<?php echo set_value('empno');?>">
			</div>
	
			<div class="input-field col m3 s12">
				<label for="fax">Fax</label>
				<input type="text" id="fax" name="fax" value="<?php echo set_value('fax');?>">
			</div>
		 
	   
			<div class="input-field col m3 s12">
				<?php echo form_dropdown( 'gender',$gender,set_value( 'gender')); ?>
					<label>Gender</label>
			</div>
			<div class="input-field col m3 s12">
				<?php echo form_dropdown( 'dept',$dept,set_value( 'dept')); ?>
					<label>Department *</label>
			</div>
		
			</div>
		<div class="row">
			<div class="file-field input-field col m3 s12">
				<div class="btn blue darken-4">
					<span>Image</span>
					<input name="image" type="file" multiple>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text" placeholder="Upload one or more files" value="<?php echo set_value('image');?>">
				</div>
			</div>
		</div>
		<div class="form-group row">
			<div class="">
				<div class="col m12 s12">
					<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
					<a href="<?php echo site_url('site/viewusers'); ?>" class="waves-effect waves-light btn red">Cancel</a>
				</div>
			</div>
		</div>
	</form>
</div>
<script>
$( document ).ready(function() {
		$('#email').change(function(){
			var email = $('#email').val();
			console.log(email);
			if(email !=''){
			$.ajax({
				type: "POST",
				url: "check_email_avalibility",
				data: {email:email},
				success: function(data){
					$('#emailresult').html(data);
				}
				});
		}
	})
	
});
</script>