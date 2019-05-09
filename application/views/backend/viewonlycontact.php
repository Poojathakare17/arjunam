<div class="row">
  <div class="col s12">
    <h4 class="pad-left-15 capitalize">Contact Details
    </h4>
  </div>
</div>
<div class="row">
  <form class='col s12' method='post' action='<?php echo site_url("site/edittransactionsubmit");?>' enctype= 'multipart/form-data'>
    <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
 
    <div class="row">
      <div class="input-field col l3 s12">
        <label for="name">Name
        </label>
        <input type="text" id="name" style="border-bottom: 0px;" readonly name="name" value='<?php echo set_value('name',$before->name);?>'>
      </div>
      <div class="input-field col l3 s12">
        <label for="designation">Designation
        </label>
        <input type="text" id="designation" style="border-bottom: 0px;" readonly designation="designation" value='<?php echo set_value('designation',$before->designation);?>'>
      </div>
  
      <div class="input-field col l3 s12">
        <label for="email">Email
        </label>
        <input type="text" id="email" style="border-bottom: 0px;" readonly email="email" value='<?php echo set_value('email',$before->email);?>'>
      </div>
      <div class="row">
        <div class="input-field col l3 s12">
        <label for="Company">Company</label>
        <input type="text" id="Company" name="company" style="border-bottom: 0px;" readonly value='<?php echo set_value('company',$before->company);?>'>
        </div>
      </div>
    </div>
    <div class="input-field col s12 l3">
        <label for="mobile">Tel 1
        </label>
        <input type="text" id="mobile" style="border-bottom: 0px;" readonly name="mobile" value='<?php echo set_value('mobile',$before->mobile);?>'>
      </div>
  
      <div class="input-field col s12 l3">
        <label for="landline">Tel 2
        </label>
        <input type="text" id="landline" style="border-bottom: 0px;" readonly name="landline" value='<?php echo set_value('landline',$before->landline);?>'>
      </div>
      <div class="input-field col s12 l3">
        <label for="companywebsite">Company Website
        </label>
        <input type="text" id="companywebsite" style="border-bottom: 0px;" readonly name="companywebsite" value='<?php echo set_value('companywebsite',$before->companywebsite);?>'>
      </div>
      <div class="row">
        <div class="input-field col s12 l3">
        <label for="DOB">DOB</label>
        <input type="date" id="DOB" class="datepicker" style="border-bottom: 0px;" readonly name="dob" value='<?php echo set_value('dob',$before->dob);?>'>
        </div>
      </div>
  
  
        <div class="input-field col s12 l3">
        <label for="doj">DOJ</label>
        <input type="date" id="doj" class="datepicker" style="border-bottom: 0px;" readonly name="doj" value='<?php echo set_value('doj',$before->doj);?>'>
        </div>
        <div class="input-field col s12 l3">
        <label for="dom">DOM</label>
        <input type="date" id="dom" class="datepicker" style="border-bottom: 0px;" readonly name="dom" value='<?php echo set_value('dom',$before->dom);?>'>
        </div>
        <div class="input-field col s12 l3">
        <label for="fax">Fax
        </label>
        <input type="text" id="fax" style="border-bottom: 0px;" readonly name="fax" value='<?php echo set_value('fax',$before->fax);?>'>
      </div>
      <div class="input-field col s12 l3">
        <label for="Number of Employee in Company">Number of Employee in Company</label>
        <input type="number" style="border-bottom: 0px;" readonly id="Number of Employee in Company" name="noofemp" value='<?php echo set_value('noofemp',$before->noofemp);?>'>
      </div>
 
      <div class="col s12 l3">
        <label>Company Address
        </label>
        <textarea name="companyaddress" readonly style="border-bottom: 0px;margin-left: -28px;" placeholder="Enter text ..." class="materialize-textarea">
          <?php echo set_value( 'companyaddress',$before->companyaddress);?>
        </textarea>
      </div>
      <div class="col s12 l3">
        <label>Description
        </label>
        <textarea name="description" readonly style="border-bottom: 0px;margin-left: -28px;" placeholder="Enter text ..." class="materialize-textarea">
          <?php echo set_value( 'description',$before->description);?>
        </textarea>
      </div>
     

      <div class="input-field col s12 l3">
        <label for="Company Sector">Company Sector</label>
        <input type="text" id="Company Sector" style="border-bottom: 0px;" readonly name="companysector" value='<?php echo set_value('companysector',$before->companysector);?>'>
      </div>
      <div class="input-field col s12 l3">
        <label for="leadtype">Lead Type</label>
        <input type="text" id="Lead Type" style="border-bottom: 0px;" readonly name="leadtype" value='<?php echo set_value('leadtype',$before->leadtype);?>'>
      </div>
      <div class="input-field col s12 l3">
        <label for="noofprojects">Number of projects</label>
        <input type="text" id="noofprojects" style="border-bottom: 0px;" readonly name="noofprojects" value='<?php echo set_value('noofprojects',$before->noofprojects);?>'>
      </div>
      <div class="input-field col s12 l3">
        <label for="nationality">Nationality</label>
        <input type="text" id="nationality" style="border-bottom: 0px;" readonly name="nationality" value='<?php echo set_value('nationality',$before->nationality);?>'>
      </div>
 
      <div class="input-field col s12 l3">
          <label for="passportexpirydate">Passport expiry date</label>
          <input type="text" id="passportexpirydate" style="border-bottom: 0px;" readonly name="passportexpirydate" value='<?php echo set_value('passportexpirydate',$before->passportexpirydate);?>'>
        </div>
        <div class="input-field col s12 l3">
          <label for="visaexpirydate">Visa expiry date</label>
          <input type="text" id="visaexpirydate" style="border-bottom: 0px;" readonly name="visaexpirydate" value='<?php echo set_value('visaexpirydate',$before->visaexpirydate);?>'>
        </div>
        <div class="input-field col s12 l3">
          <label for="group">Group</label>
          <input type="text" id="group" style="border-bottom: 0px;" readonly name="group" value='<?php echo set_value('group',$before->group);?>'>
        </div>
        <div class="input-field col s12 l3">
          <label for="source">Source</label>
          <input type="text" id="source" style="border-bottom: 0px;" readonly name="source" value='<?php echo set_value('source',$before->source);?>'>
        </div>
 
      <div class="input-field col s12 l3">
          <label for="enquirytype">Enquiry type</label>
          <input type="text" id="enquirytype" style="border-bottom: 0px;" readonly name="enquirytype" value='<?php echo set_value('enquirytype',$before->enquirytype);?>'>
        </div>
        <div class="input-field col s12 l3">
          <label for="gender">Gender</label>
          <input type="text" id="gender" style="border-bottom: 0px;" readonly name="gender" value='<?php echo set_value('gender',$before->gender);?>'>
        </div>
      
    </div>
    <div class="row">
    <div class="file-field input-field col l4 s12">
        <span class="img-center big">
          <?php if($before->passportcopy == "") { } else {?>
          <img src="<?php echo base_url('uploads')."/".$before->passportcopy; ?>">
          <?php } ?>
        </span>
        <div class="file-path-wrapper">
          <input class="file-path validate" style="border-bottom: 0px;" type="text" placeholder="Upload one or more files" value="<?php echo set_value('passportcopy',$before->passportcopy);?>">
        </div>
      </div>
      <div class="file-field input-field col l4 s12">
        <span class="img-center big">
          <?php if($before->visacopy == "") { } else {?>
          <img src="<?php echo base_url('uploads')."/".$before->visacopy; ?>">
          <?php } ?>
        </span>
        <div class="file-path-wrapper">
          <input class="file-path validate" style="border-bottom: 0px;" type="text" placeholder="Upload one or more files" value="<?php echo set_value('visacopy',$before->visacopy);?>">
        </div>
      </div>
      <div class="file-field input-field col l4 s12">
        <span class="img-center big">
          <?php if($before->eidcopy == "") { } else {?>
          <img src="<?php echo base_url('uploads')."/".$before->eidcopy; ?>">
          <?php } ?>
        </span>
        <div class="file-path-wrapper">
          <input class="file-path validate" style="border-bottom: 0px;" type="text" placeholder="Upload one or more files" value="<?php echo set_value('eidcopy',$before->eidcopy);?>">
        </div>
      </div>
      
    </div>
    <h4>Spouse Details</h4>
    <div class="row">
    <div class="input-field col s6 l3 m3">
    <label for="spousename">Name</label>
    <input type="text" id="spousename" style="border-bottom: 0px;" name="spousename" value='<?php echo set_value('spousename',$before->spousename);?>'>
    </div>
    <div class="input-field col s6 l3 m3">
    <label for="spousenumber">Phone</label>
    <input type="text" id="spousenumber" style="border-bottom: 0px;" name="spousenumber" value='<?php echo set_value('spousenumber',$before->spousenumber);?>'>
    </div>
    <div class="input-field col s6 l3 m3">
    <label for="spouseemail">Email</label>
    <input type="email" id="spouseemail" style="border-bottom: 0px;" name="spouseemail" value='<?php echo set_value('spouseemail',$before->spouseemail);?>'>
    </div>
    <div class="input-field col s6 l3 m3">
    <label for="spousebirthday">Birthday</label>
    <input type="date" id="spousebirthday" class="datepicker" style="border-bottom: 0px;" name="spousebirthday" value='<?php echo set_value('spousebirthday',$before->spousebirthday);?>'>
    </div>
   

    <div class="input-field col s6 l3 m3">
    <label for="spousepassportnumber">Passport Number</label>
    <input type="text" id="spousepassportnumber" style="border-bottom: 0px;" name="spousepassportnumber" value='<?php echo set_value('spousepassportnumber',$before->spousepassportnumber);?>'>
    </div>

    <div class="input-field col s6 l3 m3">
        <label for="spousepassportexpirydate">Passport Expiry Date</label>
        <input type="date" id="spousepassportexpirydate" class="datepicker" style="border-bottom: 0px;" name="spousepassportexpirydate" value='<?php echo set_value('spousepassportexpirydate',$before->spousepassportexpirydate);?>'>
        </div>

        <div class="input-field col s6 l3 m3">
        <label for="spouseeidno">EID no</label>
        <input type="text" id="spouseeidno" style="border-bottom: 0px;" name="spouseeidno" value='<?php echo set_value('spouseeidno',$before->spouseeidno);?>'>
        </div>
        <div class="input-field col s6 l3 m3">
        <label for="child1">Child 1</label>
        <input type="text" id="child1"  style="border-bottom: 0px;" name="child1" value='<?php echo set_value('child1',$before->child1);?>'>
        </div>
        <div class="input-field col s6 l3 m3">
        <label for="child2">Child 2</label>
        <input type="text" id="child2" style="border-bottom: 0px;" name="child2" value='<?php echo set_value('child2',$before->child2);?>'>
        </div>
        <div class="input-field col s6 l3 m3">
        <label for="child3">Child 3</label>
        <input type="text" id="child3" style="border-bottom: 0px;" name="child3" value='<?php echo set_value('child3',$before->child3);?>'>
        </div>
</div>
    <div class="row">
      <div class="col s6">
        <a href='<?php echo site_url("site/viewcontact"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel
        </a>
      </div>
    </div>
  </form>
</div>
