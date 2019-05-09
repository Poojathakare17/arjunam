<div class="row">
  <div class="col s12">
    <h4 class="pad-left-15 capitalize">Periodic Jobs
    </h4>
  </div>
</div>
<?php
if($before->parent){
  $redirectionid =$before->parent;
} else{
  $redirectionid =$before->id;
}
$cancel_url = 'site/createperiodicjobs?id='.$redirectionid;
// print_r($before);
?>
<div class="row">
  <form class='col s12' method='post' action='<?php echo site_url("site/edittransactionsubmit?flag=1");?>' enctype= 'multipart/form-data'>
    <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
    <input type="text" id="normal-field" class="form-control" name="parent" value="<?php echo set_value('parent',$before->parent);?>" style="display:none;">
    <div class="row">
      <div class="input-field col l3 s12">
        <?php echo form_dropdown("client_id",$client_id,set_value('client_id',$before->client_id));?>
        <label>Client Name
        </label>
      </div>
      <div class="input-field col s12 l3">
        <label for="created_date">Date of Creation
        </label>
        <input type="date" id="created_date" class="datepicker" name="created_date" value='<?php echo set_value('created_date',$before->created_date);?>'>
      </div>
      <div class="input-field col s12 l3">
        <label for="due_date">Due Date
        </label>
        <input type="date" id="due_date" class="datepicker" name="due_date" value='<?php echo set_value('due_date',$before->due_date);?>'>
      </div>
      <div class="input-field col s12 l3">
        <?php echo form_dropdown("dept",$dept,set_value('dept',$before->dept));?>
        <label>Department
        </label>
      </div>
      <div class="input-field col s12 l3">
        <?php echo form_dropdown("personalloted",$personalloted,set_value('personalloted',$before->personalloted));?>
        <label>Assigned to
        </label>
      </div>
      <div class="input-field col s12 l3">
        <label for="valueofwork">Value Of Work
        </label>
        <input type="text" id="valueofwork" name="valueofwork" value='<?php echo set_value('valueofwork',$before->valueofwork);?>'>
      </div>
      <div class="input-field col s12 l3">
        <label for="source">Source
        </label>
        <input type="text" id="source" name="source" value='<?php echo set_value('source',$before->source);?>'>
      </div>
      <div class="input-field col s12 l3">
        <label for="invoicenumber">Invoice number
        </label>
        <input type="text" id="invoicenumber" name="invoicenumber" value='<?php echo set_value('invoicenumber',$before->invoicenumber);?>'>
      </div>
      <div class="input-field col s12 l3">
        <label for="fees">Fees
        </label>
        <input type="text" id="fees" name="fees" value='<?php echo set_value('fees',$before->fees);?>'>
      </div>
      <div class="input-field col s12 l3">
        <label for="claims">Claims
        </label>
        <input type="text" id="claims" name="claims" value='<?php echo set_value('claims',$before->claims);?>'>
      </div>
      <div class="input-field col s12 l3">
        <label for="vat">Vat
        </label>
        <input type="text" id="vat" name="vat" value='<?php echo set_value('vat',$before->vat);?>'>
      </div>
      <div class="input-field col s12 l3">
        <label for="amount">Amount
        </label>
        <input type="text" id="amount" name="amount" value='<?php echo set_value('amount',$before->amount);?>'>
      </div>
      <div class="input-field col s12 l3">
        <label for="balance">Balance
        </label>
        <input type="text" id="balance" name="balance" value='<?php echo set_value('balance',$before->balance);?>'>
      </div>
      <div class="input-field col s12 l3 " id="typeofjob">
        <label for="typeofjob">Type Of Job
        </label>
        <input type="text" id="typeofjob" readonly name="typeofjob" value='<?php if($before->typeofjob == 1){
          $before->typeofjob ="One Time";
        }else { $before->typeofjob ="Repeated"; } echo set_value('typeofjob',$before->typeofjob);?>'>
      </div>
      <div class="input-field col s12 l3">
        <label for="periodicity">Periodicity
        </label>
        <input type="text" id="periodicity" name="periodicity" value='<?php echo set_value('periodicity',$before->periodicity);?>'>
      </div>
    </div>
  
    <div class="row">
      <div class="col s12 l3">
        <label>Work
        </label>
        <textarea name="typeofwork"  placeholder="Enter text ..." class="materialize-textarea">
          <?php echo set_value( 'typeofwork',$before->typeofwork);?>
        </textarea>
      </div>
      <div class="col s12 l3">
        <label>Period Of Assignment
        </label>
        <textarea name="periodofassignment"  placeholder="Enter text ..." class="materialize-textarea">
          <?php echo set_value( 'periodofassignment',$before->periodofassignment);?>
        </textarea>
      </div>
      <div class="col s12 l3">
        <label>Description
        </label>
        <textarea name="description"  class="materialize-textarea" placeholder="Enter text ...">
          <?php echo set_value( 'description',$before->description);?>
        </textarea>
      </div>
    </div>
  
    <div class="row">
      <div class="col s6">
        <button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save
        </button>
        <a href='<?php echo  site_url($cancel_url); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel
        </a>
      </div>
    </div>
  </form>
</div>
<script>
$(".shjobtype").hide();
  $("#typeofjob").change(function () {
    var valueSelected = $("#typeofjob :selected").val();
    console.log(valueSelected);
    if(valueSelected == 1){
      $(".shjobtype").hide();
    } else if(valueSelected == 2){
      $(".shjobtype").show();
    } else {
      $(".shjobtype").hide();
    }
 
  });
</script>
