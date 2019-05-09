<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Edit associatedcontact</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/editassociatedcontactsubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="associatedcontact_id" value="<?php echo set_value('associatedcontact_id',$before->associatedcontact_id);?>" style="display:none;">

<div class="row">
    <div class=" input-field col s6 l3 m3">
        <?php echo form_dropdown("contact_id",$contact_id,set_value('contact_id',$before->contact_id));?>
        <label>Contact Name</label>
    </div>
    <div class=" input-field col s6 l3 m3">
        <?php echo form_dropdown("client_id",$client_id,set_value('client_id',$before->client_id));?>
        <label>Client Name</label>
    </div>
</div>
<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/viewassociatedcontact"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>
