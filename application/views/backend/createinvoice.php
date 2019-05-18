<div class="row">
<div class="col s12">
<!-- <h4 class="pad-left-15 capitalize"> Add Invoices</h4> -->
</div>
<!-- <form class='col s12' method='post' action='<?php echo site_url("site/createinvoicesubmit?id=".$this->input->get('id'));?>' enctype= 'multipart/form-data'>
<div class="row">
    <div class="file-field input-field col s12 l3">
    <div class="btn blue darken-4">
    <span>Invoices</span>
    <input type="file" name="userfile[]" multiple>
    </div>
    <div class="file-path-wrapper">
        <input class="file-path validate" type="text" placeholder="Upload one or more files" value='<?php echo set_value('image');?>'>
        </div>
    </div>
</div>
<div class="row">
<div class="col s12 m6">
<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
<a href="<?php echo site_url("site/viewtransaction"); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form> -->
</div>
<!-- <div class="col s12 l3 ">
      <h5 class="pad-left-15 ">View Invoices</h5>
   </div>
   <div class="row pad-left-15 ">
   <?php foreach($invoices as $row){ ?>
    <div class="col s12 m6 l2">
      <div class="card">
        <div class="card-image">
          <img src="<?php echo base_url('uploads')."/".$row->image; ?>" height="160px" width="297px">
        </div>
      </div>
    </div>
   <?php }?>
  </div> -->
  <div class="col s12 l3 pad-left-15 ">
      <h5>Invoices</h5>
   </div>
   <div class="row pad-left-15 ">
   <?php if(!empty($invoices)){?>
      <?php $i=1; foreach($invoices as $row){ ?>
      <div class="col s12 m6 l2">
         <div class="card">
         <div class="card-image">
         <a class="img-center1" href="<?php echo base_url('uploads')."/".$row->invoiceupload; ?>">
            <img src="<?php echo base_url('uploads')."/".$row->invoiceupload; ?>" height="160px" width="297px">
            </a>
         </div>
         <div class="card-action">
         <span><b>Invoice No.</b> <?php echo $row->invoicenumber;?></span>
         </div>
         <div class="card-action" style="text-align: center">
          <a href="<?php echo base_url('uploads')."/".$row->invoiceupload; ?>" class="tooltipped" data-position="top" data-delay="50" data-tooltip="Open in new tab" style="color: #0D47A1;padding-right: 5px;padding-left: 5px;" target="_blank"><i class="material-icons">launch</i></a>
          <a href="<?php echo base_url('uploads')."/".$row->invoiceupload; ?>" class="tooltipped" data-position="top" data-delay="50" data-tooltip="Download Invoice" download="invoice_<?php echo $before->id;?>_<?php echo $i?>" style="color: #45c445;padding-right: 5px;padding-left: 5px;"><i class="material-icons">file_download</i></a>
          <span id="<?php echo $row->id;?>" class="tooltipped" data-position="top" data-delay="50" data-tooltip="Delete Invoice" style="color: #F44336;padding-right: 5px;padding-left: 5px;" onclick="deleteImage(this)"><i class="material-icons">delete</i></span>
        </div>
         </div>
      </div>
     
      <?php $i++; }?>
      <?php } else {?>
      <div style="    text-align: center;
    padding-top: 50px;
    padding-bottom: 50px;"> <span>No Invoices Uploaded</span></div>
        
         <?php }?>

     
  </div>
   <div class="row pad-left-15 ">
      <div class="col s12 m6">
       <a href="<?php echo site_url("site/viewtransaction"); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
      </div>
   </div>
   <style>
   .card .card-action {
    padding: 3px !important
}
   </style>
     <script type="text/javascript">
   function deleteImage(item) {
      console.log(item);
      console.log($(item).attr("id"));
      var Id = $(item).attr("id");
      var result = confirm("Are you sure want to delete?");
      if (result) {
         //Logic to delete the item
         $.ajax({
         url: "<?php echo site_url("site/deleteinvoices"); ?>" + '?' + $.param({"id": Id}),
         type: 'DELETE',
         success: function(resp){
            location.reload(); 
            // if (resp.status == "success")
            
            // else
            //     $('#error-msg').html('<div class="alert alert-danger">' + resp.message + '</div>');
            //    // if(response == 1){
               
            //    // }else{
            //    // alert('Invalid ID.');
            //    // }
            }
      });
      }
     
   }
  </script>
