<div class="row">
  <div class="col s12">
    <div class="row">
      <div class="col s12 drawchintantable">
        <?php $this->chintantable->createsearch("List of Contacts");?>
        <table class="highlight responsive-table">
          <thead>
            <tr>
              <th data-field="contact_id">Sr no
              </th>
              <th data-field="name">Name
              </th>
              <th data-field="email">Email
              </th>
              <th data-field="designation">Designation
              </th>
         
              <th data-field="company">Company
              </th>
          
              <th data-field="mobile">Mobile
              </th>
              
              <th data-field="group">Group
              </th>
              <th data-field="leadtype">Lead Type
              </th>
          
           
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
    <?php $this->chintantable->createpagination();?>
    <div class="createbuttonplacement">
      <a class="btn-floating btn-large waves-effect waves-light blue darken-4 tooltipped" href="<?php echo site_url("site/createcontact"); ?>"data-position="top" data-delay="50" data-tooltip="Create">
        <i class="material-icons">add
        </i>
      </a>
    </div>
  </div>
</div>
<script>
  function drawtable(resultrow) {
  
    return "<tr><td>" + resultrow.contact_id + "</td><td>" + resultrow.name + "</td><td>" + resultrow.email + "</td><td>" + resultrow.designation + "</td><td>" + resultrow.company + "</td><td>" + resultrow.mobile + "</td><td>" + resultrow.group + "</td><td>" + resultrow.leadtype + "</td><td><a class='' href='<?php echo site_url('site/viewonlycontact?id=');?>"+resultrow.contact_id+"' data-position='top' data-delay='50' data-tooltip='Edit'><i class='icon-table fa fa-eye propericon '></i></a><a class='' href='<?php echo site_url('site/editcontact?id=');?>"+resultrow.contact_id+"' data-position='top' data-delay='50' data-tooltip='Edit'><i class='fa fa-pencil propericon icon-table green-icon'></i></a><a class='' onclick=\"return confirm('Are you sure you want to delete?');\") href='<?php echo site_url('site/deletecontact?id='); ?>"+resultrow.contact_id+"' data-position='top' data-delay='50' data-tooltip='Delete'><i class='material-icons red-icon propericon icon-table'>delete</i></a></td></tr>";
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
