<div class="row">
<div class="col s12">
<div class="row">
<div class="col s12 drawchintantable">
<?php $this->chintantable->createsearch("List of Jobs to be Closed");?>

<table class="highlight responsive-table">
<thead>
<tr>
    <!-- <th><input type='checkbox' name='chintanselectall' id='chintanselectall' /><label for='chintanselectall' onClick='chintanselectallcall();'></label></th> -->
    <th data-field="id">id</th>
    <th data-field="jobnumber">Job Number</th>
    <th data-field="client_id">Client Name</th>
    <th data-field="personalloted">Person Alloted</th>
    <!-- <th data-field="source">Source</th> -->
    <th data-field="invoicenumber">Invoice Num</th>
    <th data-field="date">Date</th>

</tr>
</thead>
<tbody>
</tbody>
</table>
</div>
</div>
<?php $this->chintantable->createpagination();?>
<!-- <div class="createbuttonplacement"><a class="btn-floating btn-large waves-effect waves-light blue darken-4 tooltipped" href="<?php echo site_url("site/createtransaction"); ?>"data-position="top" data-delay="50" data-tooltip="Create"><i class="material-icons">add</i></a></div> -->
</div>
</div>
<script>
var allData = [];
function drawtable(resultrow) {
    return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.jobnumber + "</td><td>" + resultrow.client_id + "</td><td>" + resultrow.personalloted + "</td><td>" + resultrow.invoicenumber + "</td><td>" + resultrow.date + "</td><td><a class='' href='<?php echo site_url('site/viewonlyjobclosure?id=');?>"+resultrow.id+"' data-position='top' data-delay='50' data-tooltip='Edit'><i class='icon-table fa fa-eye propericon'></i></a><a class='' href='<?php echo site_url('site/editjobclosure?id=');?>"+resultrow.id+"' data-position='top' data-delay='50' data-tooltip='Edit'><i class='icon-table fa fa-pencil propericon green-icon'></i></a></td></tr>";
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

</style>
