<div class="row">
  <div class="col s12">
    <h4 class="pad-left-15 capitalize">Create Job Number
    </h4>
  </div>
</div>
<span class="validation-error"><?php echo $alerterror;?></span>
<div class="row">
  <form class='col s12' method='post' action='<?php echo site_url("site/createtransactionsubmit");?>' enctype= 'multipart/form-data'>
    <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
    <div class="row">
      <div class="input-field col l3 s12">
        <?php echo form_dropdown("client_id",$client_id,set_value('client_id'));?>
        <label>Client Name *
        </label>
      </div>
      <div class="input-field col s12 l3">
        <label for="created_date">Date of Creation
        </label>
        <input type="date" id="created_date" class="datepicker" name="created_date" value='<?php echo set_value('created_date');?>'>
      </div>
      <div class="input-field col s12 l3">
        <label for="due_date">Due Date
        </label>
        <input type="date" id="due_date" class="datepicker" name="due_date" value='<?php echo set_value('due_date');?>'>
      </div>
      <div class="input-field col s12 l3">
        <?php echo form_dropdown("dept",$dept,set_value('dept'),'required="required"');?>
        <label>Department *
        </label>
      </div>
      <div class="input-field col s12 l3">
        <?php echo form_dropdown("personalloted",$personalloted,set_value('personalloted'));?>
        <label>Assigned to *
        </label>
      </div>
     
      <div class="input-field col s12 l3">
        <label for="source">Source
        </label>
        <input type="text" id="source" name="source" value='<?php echo set_value('source');?>'>
      </div>
      
      
      <div class="input-field col s12 l3 " id="typeofjob">
        <!-- <div id="typeofjob"> -->
          <?php echo form_dropdown("typeofjob",$typeofjob,set_value('typeofjob'));?>
        <!-- </div> -->
        <label for="typeofjob">Type Of Job *
        </label>
     
      </div>
      <div class="input-field col s12 l3 shjobtype">
        <?php echo form_dropdown("periodicity",$periodicity,set_value('periodicity'));?>
        <label for="periodicity">Periodicity
        </label>
        <span style="font-size: 11px;
        color:red;
    position: absolute;
    margin-top: -12px;">Note : Please Enter Periodicity If Type Of Job Is Periodic</span>
      </div>
    </div>
  
    <div class="row">
      <div class="col s12 l3">
        <label>Work
        </label>
        <textarea name="typeofwork"  placeholder="Enter text ..." class="materialize-textarea">
          <?php echo set_value( 'typeofwork');?>
        </textarea>
      </div>
      <div class="col s12 l3">
        <label>Period Of Assignment
        </label>
        <textarea name="periodofassignment"  placeholder="Enter text ..." class="materialize-textarea">
          <?php echo set_value( 'periodofassignment');?>
        </textarea>
      </div>
      <div class="col s12 l3">
        <label>Description
        </label>
        <textarea name="description"  class="materialize-textarea" placeholder="Enter text ...">
          <?php echo set_value( 'description');?>
        </textarea>
      </div>
    </div>
    <h4>Amount Details</h4>
    <div class="row">
    <!-- <div class="input-field col s12 l3">
        <label for="invoicenumber">Invoice number
        </label>
        <input type="text" id="invoicenumber" name="invoicenumber" value='<?php echo set_value('invoicenumber');?>'>
      </div> -->
      <div class="input-field col s12 l3">
        <label for="fees">Fees *
        </label>
        <input type="text" id="fees" class="getTotalValue" name="fees" value='<?php echo set_value('fees');?>' >
      </div>
      <div class="input-field col s12 l3">
        <label for="claims">Claims *
        </label>
        <input type="text" id="claims" class="getTotalValue" name="claims" value='<?php echo set_value('claims');?>' >
      </div>
      <div class="input-field col s12 l3">
        <label for="vat">Vat *
        </label>
        <input type="text" id="vat" class="getTotalValue" name="vat" value='<?php echo set_value('vat');?>' >
      </div>
      <div class="input-field col s12 l3">
        <input type="text" id="valueofwork" name="valueofwork" value='<?php echo set_value('valueofwork');?>'>
        <span style="font-size: 11px;
    position: absolute;
    margin-top: -12px;">Value Of Work</span>
      </div>
      <div class="input-field col s12 l3">
        <!-- <label for="balance">Balance
        </label> -->
        <input type="text" id="balance" name="balance" value='<?php echo set_value('balance');?>'>
        <span style="font-size: 11px;
    position: absolute;
    margin-top: -12px;">Balance</span>
      </div>
    </div>
    <div class="row">
      <div class="col s6">
        <button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save
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
    } else {
      $(".shjobtype").show();
    }
 
  });
  $( ".getTotalValue" ).change(function() {
    var fees = $('#fees').val();
    var claims = $('#claims').val();
    var vat = $('#vat').val();
    var totalvalue = parseFloat(fees) + parseFloat(claims) + parseFloat(vat);
    $('#valueofwork').val(totalvalue);
    $('#balance').val(totalvalue);
  
});
</script>