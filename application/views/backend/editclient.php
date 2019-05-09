<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Edit client</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/editclientsubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="client_id" value="<?php echo set_value('client_id',$before->client_id);?>" style="display:none;">

<div class=" row">
    <div class=" input-field col s6 l3 m3">
        <?php echo form_dropdown("contact_id",$contact_id,set_value('contact_id',$before->contact_id));?>
        <label>Contact Name</label>
    </div>
    <div class="input-field col s6 l3 m3">
        <label for="Project Name">Project Name</label>
        <input type="text" id="Project Name" name="projectname" value='<?php echo set_value('projectname',$before->projectname);?>'>
    </div>
</div>

<div class="row">
    <div class="input-field col s6 l3 m3">
        <textarea name="details" class="materialize-textarea" length="400"><?php echo set_value( 'details',$before->details);?></textarea>
        <label>Details</label>
    </div>
    <div class="input-field col s6 l3 m3">
        <textarea name="description" class="materialize-textarea" length="400"><?php echo set_value( 'description',$before->description);?></textarea>
        <label>Description</label>
    </div>
</div>

<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/viewclient"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>
