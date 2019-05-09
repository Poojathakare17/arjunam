<div class="row">
  <div class="col s12">
    <h4 class="pad-left-15 capitalize">Job Number Details
    </h4>
  </div>
</div>
<div class="row">
  <form class='col s12' method='post' action='<?php echo site_url("site/edittransactionsubmit");?>' enctype= 'multipart/form-data'>
    <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
    <div class="row">
      <div class="input-field col l3 s12">
        <label>Client Name
        </label>
        <input type="text" id="client_id" style="border-bottom: 0px;" readonly name="client_id" value='<?php echo set_value('client_id',$before->client_id);?>'>
      </div>
      <div class="input-field col s12 l3">
        <label for="created_date">Date of Creation
        </label>
        <input type="date" id="created_date" class="datepicker" style="border-bottom: 0px;" readonly name="created_date" value='<?php echo set_value('created_date',$before->created_date);?>'>
      </div>
      <div class="input-field col s12 l3">
        <label for="due_date">Due Date
        </label>
        <input type="date" id="due_date" class="datepicker" style="border-bottom: 0px;" readonly name="due_date" value='<?php echo set_value('due_date',$before->due_date);?>'>
      </div>
      <div class="input-field col s12 l3">
        <label>Department
        </label>
        <input type="text" id="dept" style="border-bottom: 0px;" readonly name="dept" value='<?php echo set_value('dept',$before->dept);?>'>
      </div>
      <div class="input-field col s12 l3">
        <label>Assigned to
        </label>
        <input type="text" id="personalloted" style="border-bottom: 0px;" readonly name="personalloted" value='<?php echo set_value('personalloted',$before->personalloted);?>'>
      </div>
      <div class="input-field col s12 l3">
        <label for="valueofwork">Value Of Work
        </label>
        <input type="text" id="valueofwork" style="border-bottom: 0px;" readonly name="valueofwork" value='<?php echo set_value('valueofwork',$before->valueofwork);?>'>
      </div>
      <div class="input-field col s12 l3">
        <label for="source">Source
        </label>
        <input type="text" id="source" style="border-bottom: 0px;" readonly name="source" value='<?php echo set_value('source',$before->source);?>'>
      </div>
      <div class="input-field col s12 l3">
        <label for="invoicenumber">Invoice number
        </label>
        <input type="text" id="invoicenumber" style="border-bottom: 0px;" readonly name="invoicenumber" value='<?php echo set_value('invoicenumber',$before->invoicenumber);?>'>
      </div>
      <div class="input-field col s12 l3">
        <label for="fees">Fees
        </label>
        <input type="text" id="fees" style="border-bottom: 0px;" readonly name="fees" value='<?php echo set_value('fees',$before->fees);?>'>
      </div>
      <div class="input-field col s12 l3">
        <label for="claims">Claims
        </label>
        <input type="text" id="claims" style="border-bottom: 0px;" readonly name="claims" value='<?php echo set_value('claims',$before->claims);?>'>
      </div>
      <div class="input-field col s12 l3">
        <label for="vat">Vat
        </label>
        <input type="text" id="vat" style="border-bottom: 0px;" readonly name="vat" value='<?php echo set_value('vat',$before->vat);?>'>
      </div>
      <div class="input-field col s12 l3">
        <label for="amount">Amount
        </label>
        <input type="text" id="amount" style="border-bottom: 0px;" readonly name="amount" value='<?php echo set_value('amount',$before->amount);?>'>
      </div>
      <div class="input-field col s12 l3">
        <label for="balance">Balance
        </label>
        <input type="text" id="balance" style="border-bottom: 0px;" readonly name="balance" value='<?php echo set_value('balance',$before->balance);?>'>
      </div>
      <div class="input-field col s12 l3 " id="typeofjob">
   
        <label for="typeofjob">Type Of Job
        </label>
        <input type="text" id="typeofjob" style="border-bottom: 0px;" readonly name="typeofjob" value='<?php echo set_value('typeofjob',$before->typeofjob);?>'>
      </div>
      <div class="input-field col s12 l3 shjobtype">
        <label for="periodicity">Periodicity
        </label>
        <input type="text" id="periodicity" style="border-bottom: 0px;" readonly name="periodicity" value='<?php echo set_value('periodicity',$before->periodicity);?>'>
      </div>
    </div>
  
    <div class="row">
      <div class="col s12 l3">
        <label>Work
        </label>
        <textarea style="border-bottom: 0px;" readonly name="typeofwork"  placeholder="Enter text ..." class="materialize-textarea">
          <?php echo set_value( 'typeofwork',$before->typeofwork);?>
        </textarea>
      </div>
      <div class="col s12 l3">
        <label>Period Of Assignment
        </label>
        <textarea style="border-bottom: 0px;" readonly name="periodofassignment"  placeholder="Enter text ..." class="materialize-textarea">
          <?php echo set_value( 'periodofassignment',$before->periodofassignment);?>
        </textarea>
      </div>
      <div class="col s12 l3">
        <label>Description
        </label>
        <textarea style="border-bottom: 0px;" readonly name="description"  class="materialize-textarea" placeholder="Enter text ...">
          <?php echo set_value( 'description',$before->description);?>
        </textarea>
      </div>
    </div>
  
    <div class="row">
      <div class="col s6">
        <!-- <button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save -->
        </button>
        <a href='<?php echo site_url("site/viewtransaction"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel
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
