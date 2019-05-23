<div class="row">
<div class="col s12">
<div class="row">
<div class="col s12 drawchintantable highrow">
<?php $this->chintantable->createsearch("Job Numbers");?>

<div class="row col l6 s6 m6" style="float: right;
    margin-right: -230px;">
    <!-- <div class="col l2"> -->
       <button class="btn btn-primary waves-effect waves-light  blue darken-4" id="create-invoice" >Create Invoice</button>
       <button class="btn btn-primary waves-effect waves-light  blue darken-4" id="delete-selected" >Delete Selected</button>
    <!-- </div> -->
</div>

<table class="highlight responsive-table">
<thead>
<tr>
    <th><input type='checkbox' name='chintanselectall' id='chintanselectall' /><label for='chintanselectall' onClick='chintanselectallcall();'></label></th>
    <th data-field="id">id</th>
    <th data-field="jobnumber">Job No</th>
    <th data-field="client_id">Client</th>
    <th data-field="personalloted">Assigned to</th>
    <th data-field="created_date">Start Date</th>
    <th data-field="due_date">Due Date</th>
    <th data-field="valueofwork">Value of Work</th>
    <th data-field="balance">Balance</th>
    <th data-field="status">Status</th>

</tr>
</thead>
<tbody>
</tbody>
</table>
</div>
</div>
<?php $this->chintantable->createpagination();?>
<div class="createbuttonplacement"><a class="btn-floating btn-large waves-effect waves-light blue darken-4 tooltipped" href="<?php echo site_url("site/createtransaction"); ?>"data-position="top" data-delay="50" data-tooltip="Create"><i class="material-icons">add</i></a></div>
</div>
</div>
<script>
var allData = [];
function drawtable(resultrow) {
    var listpage = '';
    if(resultrow.typeofjob == 2) {
         listpage = "<a class='tooltipped' href='<?php echo site_url('site/createperiodicjobs?id=');?>"+resultrow.id+"' data-position='top' data-delay='50' data-tooltip='Periodic Jobs'><i class='icon-table darkblue fa fa-list-ul propericon'></i></a>";
    }
    if(resultrow.status == 1) {
        resultrow.status ="Open";
        resultrow.class ="deep-orange lighten-3";
    } else if(resultrow.status == 2){
        resultrow.status ="Partial";
        resultrow.class ="lime accent-2";
    } else if(resultrow.status == 3){
        resultrow.status ="Close";
        resultrow.class ="green accent-1";
    }
    
    return "<tr><td><input type='checkbox' value='" + resultrow.id + "' name='chintansideselect' onclick='chintanselectsingle()' id='" + resultrow.id + "' /><label for='" + resultrow.id + "'></label></td><td>" + resultrow.id + "</td><td>" + resultrow.jobnumber + "</td><td>" + resultrow.client_id + "</td><td>" + resultrow.personalloted + "</td><td>" + resultrow.created_date + "</td><td>" + resultrow.due_date + "</td><td>" + resultrow.valueofwork + "</td><td>" + resultrow.balance + "</td><td class="+ resultrow.class +">" + resultrow.status + "</td><td><a class='tooltipped' href='<?php echo site_url('site/viewonlytransaction?id=');?>"+resultrow.id+"' data-position='top' data-delay='50' data-tooltip='View'><i class='icon-table fa fa-eye propericon'></i></a><a class='tooltipped' href='<?php echo site_url('site/edittransaction?id=');?>"+resultrow.id+"' data-position='top' data-delay='50' data-tooltip='Edit'><i class='icon-table fa fa-pencil propericon green-icon'></i></a><a class='tooltipped' onclick=\"return confirm('Are you sure you want to delete?');\") href='<?php echo site_url('site/deletetransaction?id='); ?>"+resultrow.id+"' data-position='top' data-delay='50' data-tooltip='Delete'><i class='icon-table material-icons propericon red-icon '>delete</i></a><a class='tooltipped' href='<?php echo site_url('site/createinvoice?id=');?>"+resultrow.id+"' data-position='top' data-delay='50' data-tooltip='View Invoice'><i class='icon-table brown-icon fa fa-file-text propericon'></i></a>" + listpage + "</td></tr>";
}
generatejquery("<?php echo $base_url;?>"); 
var inputCheckArray = [];
var ids = [];
var selectallid = [];
function chintanselectsingle(){
    inputCheckArray = $('input[type=checkbox]:checked');
}
    $("#delete-selected").click(function() {
        if(inputCheckArray.length!=0) {
             if(confirm("Are you sure you want to delete this?")) {
                for(var i=0;i<inputCheckArray.length; i++){
                ids.push(inputCheckArray[i]['id']);
            }
            ajaxCall(ids);
            }
            else{
                return false;
            }
        } else if(selectallid.length !=0) {
            if(confirm("Are you sure you want to delete this?")) {
                ajaxCall(selectallid);
            }
            else{
                    return false;
                }
            }
    });
    $("#create-invoice").click(function() {
        if(inputCheckArray.length!=0) {
                for(var i=0;i<inputCheckArray.length; i++){
                ids.push(inputCheckArray[i]['id']);
            }
            window.location.href = "redirectToInvoice?id="+ ids;
        } else if(selectallid.length !=0){
            window.location.href = "redirectToInvoice?id="+ selectallid;

        }
    });
    $("#chintanselectall").click(function() {
        var singleid = 0;
        var allids = $('input:checkbox').not(this).prop('checked', this.checked);
        for(var i=0;i<allids.length; i++) {
            singleid = allids[i]['id']
            selectallid.push(singleid);
         }
    });
 
function ajaxCall(ids) {
    console.log("ids "+ids);
    $.ajax({
            url: 'deleteSelected',
            data: {'ids': ids}, 
            type: "post",
            success: function(data){
            console.log(data);
                if(data == 1) {
                    location.reload();
                    alert("Successfully Deleted");
                    
                }else {
                    alert("Some error occured while deletion");
                }
            }
        });
}
</script>
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
        color: #8bc34a;
    }
    .brown-icon{
        color:brown;
    }
    .darkblue{
        color: #0102f6;
       
    }

</style>
