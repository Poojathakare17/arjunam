<div class="row">
    <div class="col s12">
        <div class="row">
            <div class="col s12 drawchintantable">
                 <?php $this->chintantable->createsearch("List of Users");?>
                <table class="highlight responsive-table">
                    <thead>
                        <tr>
                            <th data-field="id">Id</th>
                            <th data-field="name">Name</th>
                            <th data-field="empno">Empno</th>
                            <th data-field="email">Email</th>
                            <!-- <th data-field="dept">Dept</th> -->
                            <th data-field="mobile">Mobile</th>
                            <th data-field="accesslevel">Accesslevel</th>
                            <th data-field="status">Status</th>
                            <th data-field="">Action</th>
            
                        </tr>
                    </thead>
                    <tbody>
            
                    </tbody>
                </table>
            </div>
        </div>
        <?php $this->chintantable->createpagination();?>



    </div>
     <div class="createbuttonplacement"><a class="btn-floating btn-large waves-effect waves-light blue darken-4 tooltipped" href="<?php echo site_url("site/createuser"); ?>" data-position="top" data-delay="50" data-tooltip="Create"><i class="material-icons">add</i></a></div>
      
</div>
<script>
    function drawtable(resultrow) {
        return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.name + "</td><td>" + resultrow.empno + "</td><td>" + resultrow.email + "</td><td>" + resultrow.mobile + "</td><td>" + resultrow.accesslevel + "</td><td>" + resultrow.status + "</td><td><a class='' href='<?php echo site_url('site/viewonlyuser?id=');?>"+resultrow.id+"' data-position='top' data-delay='50' data-tooltip='Edit'><i class='icon-table fa fa-eye propericon'></i></a><a class='' href='<?php echo site_url('site/edituser?id=');?>"+resultrow.id+"' data-position='top' data-delay='50' data-tooltip='Edit'><i class='green-icon icon-table fa fa-pencil propericon'></i></a><a class='' onclick=\"return confirm('Are you sure you want to delete?');\") href='<?php echo site_url('site/deleteuser?id='); ?>"+resultrow.id+"' data-position='top' data-delay='50' data-tooltip='Delete'><i class='red-icon icon-table material-icons propericon'>delete</i></a></td><tr>";
    }
    generatejquery('<?php echo $base_url;?>');
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