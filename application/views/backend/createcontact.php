<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Create contact</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createcontactsubmit");?>' enctype= 'multipart/form-data'>

<div class="row">
<div class="input-field col s6 l3 m3">
<label for="Name">Name</label>
<input type="text" id="Name" name="name" value='<?php echo set_value('name');?>'>
</div>
<div class="input-field col s6 l3 m3">
<label for="Designation">Designation</label>
<input type="text" id="Designation" name="designation" value='<?php echo set_value('designation');?>'>
</div>
<div class="input-field col s6 l3 m3">
<label for="Email">Email</label>
<input type="email" id="Email" name="email" value='<?php echo set_value('email');?>'>
</div>
<div class="input-field col s6 l3 m3">
<label for="Company">Company</label>
<input type="text" id="Company" name="company" value='<?php echo set_value('company');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6 l3 m3">
<label for="Mobile">Tel 1</label>
<input type="text" id="Mobile" name="mobile" value='<?php echo set_value('mobile');?>'>
</div>
<div class="input-field col s6 l3 m3">
<label for="Landline">Tel 2</label>
<input type="text" id="Landline" name="landline" value='<?php echo set_value('landline');?>'>
</div>
<div class="input-field col s6 l3 m3">
<label for="Company Website">Company Website</label>
<input type="text" id="Company Website" name="companywebsite" value='<?php echo set_value('companywebsite');?>'>
</div>
<div class="input-field col s6 l3 m3">
<label for="DOB">DOB</label>
<input type="date" id="DOB" class="datepicker" name="dob" value='<?php echo set_value('dob');?>'>
</div>
</div>

<div class="row">
    <div class="input-field col s6 l3 m3">
        <label for="DOJ">DOJ</label>
        <input type="date" id="DOJ" class="datepicker" name="doj" value='<?php echo set_value('doj');?>'>
    </div>
    <div class="input-field col s6 l3 m3">
        <label for="DOM">DOM</label>
        <input type="date" id="DOM" class="datepicker" name="dom" value='<?php echo set_value('dom');?>'>
    </div>
    <div class="input-field col s6 l3 m3">
        <label for="fax">Fax</label>
        <input type="text" id="fax" name="fax" value='<?php echo set_value('fax');?>'>
    </div>
    <div class="input-field col s6 l3 m3">
        <label for="Number of Employee in Company">Number of Employee in Company</label>
        <input type="number" id="Number of Employee in Company" name="noofemp" value='<?php echo set_value('noofemp');?>'>
    </div>
</div>

<div class="row">
<div class="input-field col s6 l3 m3">
<label for="Company Sector">Company Sector</label>
<input type="text" id="Company Sector" name="companysector" value='<?php echo set_value('companysector');?>'>
</div>
<div class=" input-field col s6 l3 m3">
<?php echo form_dropdown("leadtype",$leadtype,set_value('leadtype'));?>
<label>Lead Type</label>
</div>
<div class="input-field col s6 l3 m3">
<label for="Number of Projects">Number of Projects</label>
<input type="number" id="Number of Projects" name="noofprojects" value='<?php echo set_value('noofprojects');?>'>
</div>
<div class="input-field col s6 l3 m3">
<label for="Nationality">Nationality</label>
<input type="text" id="Nationality" name="nationality" value='<?php echo set_value('nationality');?>'>
</div>
</div>


<div class="row">
    <div class="file-field input-field col s6 l3 m3">
    <div class="btn blue darken-4">
    <span>Passport Copy</span>
    <input type="file" name="passportcopy" multiple>
    </div>
    <div class="file-path-wrapper">
    <input class="file-path validate" type="text" placeholder="Upload one or more files" value='<?php echo set_value('passportcopy');?>'>
    </div>
    </div>

    <div class="file-field input-field col s6 l3 m3">
    <div class="btn blue darken-4">
    <span>Visa Copy</span>
    <input type="file" name="visacopy" multiple>
    </div>
    <div class="file-path-wrapper">
    <input class="file-path validate" type="text" placeholder="Upload one or more files" value='<?php echo set_value('visacopy');?>'>
    </div>
    </div>
    <div class="file-field input-field col s6 l3 m3">
    <div class="btn blue darken-4">
    <span>Emirates id Copy</span>
    <input type="file" name="eidcopy" multiple>
    </div>
    <div class="file-path-wrapper">
    <input class="file-path validate" type="text" placeholder="Upload one or more files" value='<?php echo set_value('eidcopy');?>'>
    </div>
    </div>
</div>

<div class="row">
<div class="input-field col s6 l3 m3">
<label for="Passport expiry date">Passport expiry date</label>
<input type="date" id="Passport expiry date" class="datepicker" name="passportexpirydate" value='<?php echo set_value('passportexpirydate');?>'>
</div>

<div class="input-field col s6 l3 m3">
<label for="Visa expiry date">Visa expiry date</label>
<input type="date" id="Visa expiry date" class="datepicker" name="visaexpirydate" value='<?php echo set_value('visaexpirydate');?>'>
</div>

<div class=" input-field col s6 l3 m3">
<?php echo form_dropdown("group",$group,set_value('group'));?>
<label>Group</label>
</div>
<div class="input-field col s6 l3 m3">
<label for="Source">Source</label>
<input type="text" id="Source" name="source" value='<?php echo set_value('source');?>'>
</div>
</div>

<div class="row">
    <div class="input-field col s6 l3 m3">
    <label for="Enquiry type">Enquiry type</label>
    <input type="text" id="Enquiry type" name="enquirytype" value='<?php echo set_value('enquirytype');?>'>
    </div>
    <div class=" input-field col s6 l3 m3">
    <?php echo form_dropdown("gender",$gender,set_value('gender'));?>
    <label>Gender</label>
    </div>
    <!-- <div class="input-field col s6 l3 m3">
    <input type="checkbox" name="sendsms" id="sendsms" value='1'>
    <label for="sendsms">Send Sms</label>
    </div>
    <div class="input-field col s6 l3 m3">
    <input type="checkbox" name='sendemail' id="sendemail" value='1'>
    <label for="sendemail">Send Email</label>
    </div> -->
</div>
<div class="row">
    <div class="input-field col s6 l3 m3">
    <textarea name="description" class="materialize-textarea" length="400"><?php echo set_value( 'description');?></textarea>
    <label>Description</label>
    </div>
    <div class="input-field col s6 l3 m3">
    <textarea name="companyaddress" class="materialize-textarea" length="400"><?php echo set_value( 'companyaddress');?></textarea>
    <label>Company Address</label>
    </div>
</div>
<h4>Spouse Details</h4>
<div class="row">
    <div class="input-field col s6 l3 m3">
    <label for="spousename">Name</label>
    <input type="text" id="spousename" name="spousename" value='<?php echo set_value('spousename');?>'>
    </div>
    <div class="input-field col s6 l3 m3">
    <label for="spousenumber">Phone</label>
    <input type="text" id="spousenumber" name="spousenumber" value='<?php echo set_value('spousenumber');?>'>
    </div>
    <div class="input-field col s6 l3 m3">
    <label for="spouseemail">Email</label>
    <input type="email" id="spouseemail" name="spouseemail" value='<?php echo set_value('spouseemail');?>'>
    </div>
    <div class="input-field col s6 l3 m3">
    <label for="spousebirthday">Birthday</label>
    <input type="date" id="spousebirthday" class="datepicker" name="spousebirthday" value='<?php echo set_value('spousebirthday');?>'>
    </div>

    <div class="input-field col s6 l3 m3">
    <label for="spousepassportnumber">Passport Number</label>
    <input type="text" id="spousepassportnumber" name="spousepassportnumber" value='<?php echo set_value('spousepassportnumber');?>'>
    </div>

        <div class="input-field col s6 l3 m3">
        <label for="spousepassportexpirydate">Passport expiry date</label>
        <input type="date" id="spousepassportexpirydate" class="datepicker" name="spousepassportexpirydate" value='<?php echo set_value('spousepassportexpirydate');?>'>
        </div>

        <div class="input-field col s6 l3 m3">
        <label for="spouseeidno">EID no</label>
        <input type="text" id="spouseeidno"  name="spouseeidno" value='<?php echo set_value('spouseeidno');?>'>
        </div>
        <div class="input-field col s6 l3 m3">
        <label for="child1">Child 1</label>
        <input type="text" id="child1"  name="child1" value='<?php echo set_value('child1');?>'>
        </div>
        <div class="input-field col s6 l3 m3">
        <label for="child2">Child 2</label>
        <input type="text" id="child2" name="child2" value='<?php echo set_value('child2');?>'>
        </div>
        <div class="input-field col s6 l3 m3">
        <label for="child3">Child 3</label>
        <input type="text" id="child3" name="child3" value='<?php echo set_value('child3');?>'>
        </div>
</div>


<div class="row">
<div class="col s12 m6">
<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
<a href="<?php echo site_url("site/viewcontact"); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
