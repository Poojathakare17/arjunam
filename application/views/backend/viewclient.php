<div class="row">
<div class="col s12">
<div class="row">
<div class="col s12 drawchintantable">
<?php $this->chintantable->createsearch("List of Clients");?>
<table class="highlight responsive-table">
<thead>
<tr>
<th data-field="client_id">Client id</th>
<th data-field="contact_id">Contact Name</th>
<th data-field="projectname">Project Name</th>
<th data-field="details">Details</th>
<th data-field="description">Description</th>
<!-- <th data-field="timestamp">timestamp</th> -->
</tr>
</thead>
<tbody>
</tbody>
</table>
</div>
</div>
<?php $this->chintantable->createpagination();?>
<div class="createbuttonplacement"><a class="btn-floating btn-large waves-effect waves-light blue darken-4 tooltipped" href="<?php echo site_url("site/createclient"); ?>"data-position="top" data-delay="50" data-tooltip="Create"><i class="material-icons">add</i></a></div>
</div>
</div>
<script>
function drawtable(resultrow) {
return "<tr><td>" + resultrow.client_id + "</td><td>" + resultrow.name + "</td><td>" + resultrow.projectname + "</td><td>" + resultrow.details + "</td><td>" + resultrow.description + "</td><td><a class='' href='<?php echo site_url('site/viewonlyclient?id=');?>"+resultrow.client_id+"' data-position='top' data-delay='50' data-tooltip='Edit'><i class='icon-table fa fa-eye propericon '></i></a><a class='' href='<?php echo site_url('site/editclient?id=');?>"+resultrow.client_id+"' data-position='top' data-delay='50' data-tooltip='Edit'><i class='green-icon icon-table fa fa-pencil propericon'></i></a><a class='' onclick=\"return confirm('Are you sure you want to delete?');\") href='<?php echo site_url('site/deleteclient?id='); ?>"+resultrow.client_id+"' data-position='top' data-delay='50' data-tooltip='Delete'><i class='red-icon icon-table material-icons propericon'>delete</i></a></td></tr>";
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
