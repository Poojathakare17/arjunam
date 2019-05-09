<div class="row">
   <div class="col s12 m12">
      <div class="row">
         <div class="col s6 m6 l3">
            <div class="card red white-text pd-28">
               <div class="card-content white-text center-align">
                  <p class="card-title">
                     <i class="material-icons icon-m1">local_phone</i><b> Total Contacts</b>
                  </p>
                  <span class="card-title font-size38"><?php echo $contactcount;?></span>
               </div>
               <div class="card-title center-align white-text">
                  <a style="color: white;" href="<?php echo site_url("site/viewcontact"); ?>">View Contacts</a>
               </div>
            </div>
         </div>
         <div class="col s6 m6 l3">
            <div class="card pd-28 light-blue darken-2 white-text">
               <div class="card-content white-text center-align">
                  <p class="card-title">
                     <i class="material-icons icon-m1">people</i><b> Total Clients</b>
                  </p>
                  <span class="card-title font-size38"><?php echo $clientcount;?></span>
               </div>
               <div class="card-title center-align white-text">
                  <a  style="color: white;" href="<?php echo site_url("site/viewclient"); ?>">View Clients</a>
               </div>
            </div>
         </div>
         <div class="col s6 m6 l3">
            <div class="card pd-28 green accent-3 white-text">
               <div class="card-content white-text center-align">
                  <p class="card-title">
                     <i class="material-icons icon-m1">attach_money</i><b> Total Transactions</b>
                  </p>
                  <span class="card-title font-size38"><?php echo $transactioncount;?></span>
               </div>
               <div class="card-title center-align white-text">
                  <a  style="color: white;" href="<?php echo site_url("site/viewtransaction"); ?>">View Transactions</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<style>
.pd-28 {
    padding-bottom: 28px;

}
</style>