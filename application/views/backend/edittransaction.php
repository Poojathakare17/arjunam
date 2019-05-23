<div class="row">
  <div class="col s12">
    <h4 class="pad-left-15 capitalize">Edit Job Number
    </h4>
  </div>
</div>
<span class="validation-error"><?php echo $alerterror;?></span>
<div class="row">
<?php
if($before->parent){
  $redirectionid =$before->parent;
} else{
  $redirectionid =$before->id;
}

if($flag){
  $site_url = 'site/edittransactionsubmit?flag='.$redirectionid;
  $cancel_url = 'site/createperiodicjobs?id='.$redirectionid;
} else {
  $site_url = 'site/edittransactionsubmit';
  $cancel_url = 'site/viewtransaction';
}

?>




  <form class='col s12' method='post' action='<?php echo site_url($site_url);?>' enctype= 'multipart/form-data'>
    <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
    <input type="hidden" id="normal-field" class="form-control" name="parent" value="<?php echo set_value('parent',$before->parent);?>" style="display:none;">

  

    <div class="row">
      <div class="input-field col l3 s12">
        <?php echo form_dropdown("client_id",$client_id,set_value('client_id',$before->client_id));?>
        <label>Client Name *
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
        <label>Department *
        </label>
      </div>
      <div class="input-field col s12 l3">
        <?php echo form_dropdown("personalloted",$personalloted,set_value('personalloted',$before->personalloted));?>
        <label>Assigned to *
        </label>
      </div>
      
      <div class="input-field col s12 l3">
        <label for="source">Source
        </label>
        <input type="text" id="source" name="source" value='<?php echo set_value('source',$before->source);?>'>
      </div>
      <div class="input-field col s12 l3 " id="typeofjob">
        <label for="typeofjob">Type Of Job *
        </label>
        <input type="text" readonly  value='<?php if($before->typeofjob == 1){
          $before->typeofjob ="One Time";
        }else { $before->typeofjob ="Repeated"; } echo set_value('typeofjob',$before->typeofjob);?>'>

      </div>
      <!-- hidden input starts -->
        <input type="hidden" id="typeofjob" name="typeofjob" value='<?php if($before->typeofjob == "One Time"){
          $before->typeofjob =1;
        }else { $before->typeofjob =2; } echo set_value('typeofjob',$before->typeofjob);?>'>
      <!-- hidden input ends -->
      <div class="input-field col s12 l3">
        <label for="periodicity">Periodicity
        </label>
        <input type="text" id="periodicity" readonly name="periodicity" value='<?php echo set_value('periodicity',$before->periodicity);?>'>
      </div>
      
      </div>
      <div class="row">
        <div class="col s12 l3">
          <label>Work
          </label>
          <textarea name="typeofwork"  placeholder="Enter text ..." class="materialize-textarea">
            <?php echo set_value( 'typeofwork',ltrim($before->typeofwork,''));?>
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
  
    <h4>Amount Details</h4>


       <div class="row">
       <!-- <div class="input-field col s12 l3">
              <label for="invoicenumber">Invoice number
              </label>
              <input type="text" id="invoicenumber" name="invoicenumber" value='<?php echo set_value('invoicenumber',$before->invoicenumber);?>'>
            </div> -->
            <div class="input-field col s12 l3">
              <label for="fees">Fees *
              </label>
              <input type="text" id="fees" name="fees" class="addTotalAmount" value='<?php echo set_value('fees',$before->fees);?>'>
            </div>
            <div class="input-field col s12 l3">
              <label for="claims">Claims *
              </label>
              <input type="text" id="claims" name="claims" class="addTotalAmount" value='<?php echo set_value('claims',$before->claims);?>'>
            </div>
            <div class="input-field col s12 l3">
              <label for="vat">Vat *
              </label>
              <input type="text" id="vat" name="vat" class="addTotalAmount"  value='<?php echo set_value('vat',$before->vat);?>'>
            </div>
            <div class="input-field col s12 l3">
              <label for="valueofwork">Value Of Work
              </label>
              <input type="text" id="valueofwork" name="valueofwork" value='<?php echo set_value('valueofwork',$before->valueofwork);?>'>
            </div>
            <!-- <div class="input-field col s12 l3">
              <label for="amount">Amount
              </label>
              <input type="text" id="amount" name="amount" value='<?php echo set_value('amount',$before->amount);?>'>
            </div> -->
            <div class="input-field col s12 l3">
              <label for="balance">Balance
              </label>
              <input type="text" id="balance" name="balance" value='<?php echo set_value('balance',$before->balance);?>'>
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
 document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.collapsible');
    var instances = M.Collapsible.init(elems, options);
  });

  // Or with jQuery

  $(document).ready(function(){
    $('.collapsible').collapsible();
  });
        
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
  var valueofwork = 0;
  $( ".addTotalAmount" ).change(function() {
    valueofwork = parseInt($('#fees').val())+ parseInt($('#claims').val())+parseInt($('#vat').val())
    $('#valueofwork').val(valueofwork);
    $('#balance').val(valueofwork);
});
</script>
