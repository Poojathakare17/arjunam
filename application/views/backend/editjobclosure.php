<div class="row">
  <div class="col s12">
    <h4 class="pad-left-15 capitalize">Changing status of Job Closure
    </h4>
  </div>
</div>
<div class="row">
  <form class='col s12' method='post' action='<?php echo site_url("site/edittransactionsubmit");?>' enctype= 'multipart/form-data'>
    <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
    <div class="row">
      <div class="input-field col l3 s12">
        <label for="jobnumber">Job number
        </label>
        <input type="text" id="jobnumber" readonly name="jobnumber" value='<?php echo set_value('jobnumber',$before->jobnumber);?>'>
      </div>
      <div class="input-field col l3 s12" style="pointer-events: none;">
        <?php echo form_dropdown("client_id",$client_id,set_value('client_id',$before->client_id,'disabled=disabled'));?>
        <label>Client Name
        </label>
      </div>
      <div class=" input-field col l3 s12 ">
        <?php echo form_dropdown("status",$status,set_value('status',$before->status));?>
        <label for="Status">Closure
        </label>
      </div>
      <div class="input-field col s12 l3">
        <label for="Date">Date
        </label>
        <input type="date" id="Date" class="datepicker" name="date" value='<?php echo set_value('date',$before->date);?>'>
      </div>
    </div>
    <div class=" row">
      <div class=" input-field col s12 l3">
        <?php echo form_dropdown("personalloted",$personalloted,set_value('personalloted',$before->personalloted));?>
        <label>Person Alloted
        </label>
      </div>
      <!-- <div class="input-field col s12 l3">
        <label for="source">Source
        </label>
        <input type="text" id="source" name="source" value='<?php echo set_value('source',$before->source);?>'>
      </div> -->
      <div class="input-field col s12 l3">
        <label for="invoicenumber">Invoice Number
        </label>
        <input type="text" id="invoicenumber" name="invoicenumber" value='<?php echo set_value('invoicenumber',$before->invoicenumber);?>'>
      </div>
      <!-- <div class="input-field col s12 l3">
        <label for="fees">Fees
        </label>
        <input type="text" id="fees" name="fees" value='<?php echo set_value('fees',$before->fees);?>'>
      </div> -->
    </div>
    <!-- <div class="row">
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
        <label for="invoiceamount">Invoice Amt
        </label>
        <input type="text" id="invoiceamount" name="invoiceamount" value='<?php echo set_value('invoiceamount',$before->invoiceamount);?>'>
      </div>
      <div class="input-field col s12 l3">
        <label for="balance">Balance
        </label>
        <input type="text" id="balance" name="balance" value='<?php echo set_value('balance',$before->balance);?>'>
      </div>
    </div> -->
    <div class="row">
      <div class="col s12 l3">
        <label> Work
        </label>
        <textarea name="typeofwork"  placeholder="Enter text ..." class="materialize-textarea">
          <?php echo set_value( 'typeofwork',$before->typeofwork);?>
        </textarea>
      </div>
      <!-- <div class="col s12 l3">
        <label>Period Of Assignment
        </label>
        <textarea name="periodofassignment" style="margin-left: -28px;" placeholder="Enter text ..." class="materialize-textarea">
          <?php echo set_value( 'periodofassignment',$before->periodofassignment);?>
        </textarea>
      </div> -->
      <div class="col s12 l3">
        <label>Comment
        </label>
        <textarea name="message" style="margin-left: -28px;" class="materialize-textarea" placeholder="Enter text ...">
          <?php echo set_value( 'message',$before->message);?>
        </textarea>
      </div>
    </div>
    <!-- <div class="row">
      <div class="file-field input-field col l4 s12">
        <span class="img-center big">
          <?php if($before->invoice == "") { } else {?>
          <img src="<?php echo base_url('uploads')."/".$before->invoice; ?>">
          <?php } ?>
        </span>
        <div class="btn blue darken-4">
          <span>invoice
          </span>
          <input name="invoice" type="file" multiple>
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate" type="text" placeholder="Upload one or more files" value="<?php echo set_value('invoice',$before->invoice);?>">
        </div>
      </div>
    </div> -->
    <div class="row">
      <div class="col s6">
        <button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save
        </button>
        <a href='<?php echo site_url("site/viewjobclosure"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel
        </a>
      </div>
    </div>
  </form>
</div>
