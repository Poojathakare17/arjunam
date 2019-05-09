<div class="row">
  <div class="col s12">
    <h4 class="pad-left-15 capitalize">Leads Details
    </h4>
  </div>
</div>
<div class="row">
  <form class='col s12' method='post' action='<?php echo site_url("site/edittransactionsubmit");?>' enctype= 'multipart/form-data'>
    <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
 
    <div class="row">
      <div class="input-field col l3 s12">
        <label for="contactname">Contact Name
        </label>
        <input type="text" id="contactname" style="border-bottom: 0px;" readonly name="contactname" value='<?php echo set_value('contactname',$before->contactname);?>'>
      </div>
      <div class="input-field col l3 s12">
        <label for="leadtype">Lead Type
        </label>
        <input type="text" id="leadtype" style="border-bottom: 0px;" readonly name="leadtype" value='<?php echo set_value('leadtype',$before->leadtype);?>'>
      </div>
    </div>
    <div class="row">
  <div class="col s6 l3 m3">
  <label>Description</label>
  <textarea name="description" class="materialize-textarea" style="border-bottom: 0px;" placeholder="Enter text ..."><?php echo set_value( 'description',$before->description);?></textarea>
  </div>
</div>
    <div class="row">
      <div class="col s6">
        <a href='<?php echo site_url("site/viewleads"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel
        </a>
      </div>
    </div>
  </form>
</div>
