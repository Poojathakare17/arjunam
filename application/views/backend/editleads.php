<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Edit leads</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/editleadssubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<!-- <div class="row">
<div class="input-field col s6">
<label for="lead_id">lead_id</label>
<input type="text" id="lead_id" name="lead_id" value='<?php echo set_value('lead_id',$before->lead_id);?>'>
</div>
</div> -->
<div class=" row">
<div class=" input-field col s6 l3 m3">
<?php echo form_dropdown("contact_id",$contact_id,set_value('contact_id',$before->contact_id));?>
<label>Contact Name</label>
</div>
<div class=" input-field col s6 l3 m3">
<?php echo form_dropdown("leadtype",$leadtype,set_value('leadtype',$before->leadtype));?>
<label for="Lead type">Lead type</label>
</div>
</div>
<div class="row">
<div class="col s6 l3 m3">
<label>Description</label>
<textarea name="description" class="materialize-textarea" placeholder="Enter text ..."><?php echo set_value( 'description',$before->description);?></textarea>
</div>
</div>

<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/viewleads"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>
