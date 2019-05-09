<div class="row">
<div class="col s12">
<div class="row">
<div class="col s12 drawchintantable">
<?php $this->chintantable->createsearch("Associated contacts");?>
<table class="highlight responsive-table">
<thead>
<tr>
<th data-field="associatedcontact_id">Associated contact id</th>
<th data-field="name">Contact Name</th>
<th data-field="projectname">Project Name</th>
<!-- <th data-field="timestamp">timestamp</th> -->
</tr>
</thead>
<tbody>
</tbody>
</table>
</div>
</div>
<?php $this->chintantable->createpagination();?>
<div class="createbuttonplacement"><a class="btn-floating btn-large waves-effect waves-light blue darken-4 tooltipped" href="<?php echo site_url("site/createassociatedcontact"); ?>"data-position="top" data-delay="50" data-tooltip="Create"><i class="material-icons">add</i></a></div>
</div>
</div>
<script>
function drawtable(resultrow) {
return "<tr><td>" + resultrow.associatedcontact_id + "</td><td>" + resultrow.name + "</td><td>" + resultrow.projectname + "</td><td><a class='' href='<?php echo site_url('site/viewonlyassociated?id=');?>"+resultrow.associatedcontact_id+"' data-position='top' data-delay='50' data-tooltip='Edit'><i class='icon-table fa fa-eye propericon '></i></a><a class='' href='<?php echo site_url('site/editassociatedcontact?id=');?>"+resultrow.associatedcontact_id+"' data-position='top' data-delay='50' data-tooltip='Edit'><i class='icon-table green-icon fa fa-pencil propericon'></i></a><a class='' onclick=\"return confirm('Are you sure you want to delete?');\") href='<?php echo site_url('site/deleteassociatedcontact?id='); ?>"+resultrow.associatedcontact_id+"' data-position='top' data-delay='50' data-tooltip='Delete'><i class='icon-table red-icon material-icons propericon'>delete</i></a></td></tr>";
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
