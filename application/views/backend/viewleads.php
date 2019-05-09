<div class="row">
<div class="col s12">
<div class="row">
<div class="col s12 drawchintantable">
<?php $this->chintantable->createsearch("List of Leads");?>
<table class="highlight responsive-table">
<thead>
<tr>
<th data-field="id">id</th>
<th data-field="contact_id">contact_id</th>
<th data-field="leadtype">Lead type</th>
<th data-field="description">Description</th>
</tr>
</thead>
<tbody>
</tbody>
</table>
</div>
</div>
<?php $this->chintantable->createpagination();?>
<div class="createbuttonplacement"><a class="btn-floating btn-large waves-effect waves-light blue darken-4 tooltipped" href="<?php echo site_url("site/createleads"); ?>"data-position="top" data-delay="50" data-tooltip="Create"><i class="material-icons">add</i></a></div>
</div>
</div>
<script>
function drawtable(resultrow) {
    if(resultrow.leadtype == 1){
        resultrow.leadtype = "Hot"
    }
    if(resultrow.leadtype == 2){
        resultrow.leadtype = "Cold"
    }
    if(resultrow.leadtype == 3){
        resultrow.leadtype = "Warm"
    }
    if(resultrow.leadtype == 4){
        resultrow.leadtype = "Close"
    }
return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.contact_id + "</td><td>" + resultrow.leadtype + "</td><td>" + resultrow.description + "</td><td><a class='' href='<?php echo site_url('site/viewonlylead?id=');?>"+resultrow.id+"' data-position='top' data-delay='50' data-tooltip='Edit'><i class='icon-table fa fa-eye propericon '></i></a><a class='' href='<?php echo site_url('site/editleads?id=');?>"+resultrow.id+"' data-position='top' data-delay='50' data-tooltip='Edit'><i class='fa fa-pencil propericon icon-table green-icon'></i></a><a class='' onclick=\"return confirm('Are you sure you want to delete?');\") href='<?php echo site_url('site/deleteleads?id='); ?>"+resultrow.id+"' data-position='top' data-delay='50' data-tooltip='Delete'><i class='icon-table red-icon material-icons propericon'>delete</i></a></td></tr>";
}
generatejquery("<?php echo $base_url;?>");
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
