<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Invoice List</h4>
</div>

  <div class="pad-left-15">
 
 
  <table class="table table-hover">
    <thead>
      <tr>
        <!-- <th scope="col">#</th> -->
        <th scope="col">Sr no</th>
        <th scope="col">System Inv</th>
        <th scope="col">Job Nos</th>
        <th scope="col">Inv no</th>
        <th scope="col">Inv Copy</th>
        <th scope="col">Inv Amt</th>
        <!-- <th scope="col">Action</th> -->
      </tr>
    </thead>
    <tbody>
    <?php $k=1; for($i=0; $i < count($invoicelist); $i++) {  
      ?>
      <tr>
        <td scope="row"><?php echo $k;?></td>
        <td><?php echo $invoicelist[$i]->id;?></td>
        <td><?php echo $invoicelist[$i]->Jobnumber;?></td>
         <td><?php echo $invoicelist[$i]->invoicenumber;?></td>
        <!-- <td><?php echo $invoicelist[$i]->invoiceupload;?></td> -->
        <td><a class='img-center' style="padding-top: 30px;" href='<?php echo base_url('uploads').'/'.$invoicelist[$i]->invoiceupload; ?>' ><?php echo $invoicelist[$i]->invoiceupload;?></a></td>
        <td><?php echo $invoicelist[$i]->invoiceamount;?></td>

        <!-- <td><a class='tooltipped getid1' id="<?php echo $invoicelist[$i]->id;?>"  data-toggle="modal" data-target="#stdate"  data-position='top' data-delay='50' data-tooltip='Quick Edit'><i class='icon-table fa fa-bolt propericon blue-color'></i></a><a class='tooltipped' href='<?php echo site_url('site/edittransaction?id=').$invoicelist[$i]->id."&flag=1";?>' data-position='top' data-delay='50' data-tooltip='Edit'><i class='icon-table fa fa-pencil propericon green-icon'></i></a><a class='tooltipped' href='<?php echo site_url('site/deletetransaction?id=').$invoicelist[$i]->id."&flag=".$this->input->get('id'); ?>' data-position='top' data-delay='50' data-tooltip='Delete'><i class='icon-table material-icons propericon red-icon '>delete</i></a></td> -->
      </tr>
    <?php $k++; }?>
    </tbody>
</table>
  </div>
</div>
<style>
 .highlight-row{
        background-color:#10ffe9;
    }
    .icon-table{
        font-size: 19px;
        padding: 5px;
    }
    .red-icon{
        color: red;
    }
    .green-icon{
        color: #1b5e20;
    }
    .brown-icon{
        color:brown;
    }
    .darkblue{
        color: #0102f6;
       
    }
    .blue-color{
      color:#0d47a1;
    }
  
</style>