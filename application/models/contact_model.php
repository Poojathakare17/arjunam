<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class contact_model extends CI_Model
{
public function create($contact_id,$name,$designation,$email,$company,$companyaddress,$mobile,$landline,$companywebsite,$dob,$doj,$dom,$fax,$noofemp,$companysector,$leadtype,$passportcopy,$visacopy,$eidcopy,$noofprojects,$nationality,$passportexpirydate,$visaexpirydate,$description,$group,$source,$enquirytype,$gender,$sendsms,$sendemail,$timestamp,$spousename,$spousenumber,$spouseemail,$spousebirthday,$spousepassportnumber,$spousepassportexpirydate,$spouseeidno,$child1,$child2,$child3)
{
$data=array("contact_id" => $contact_id,"name" => $name,"designation" => $designation,"email" => $email,"company" => $company,"companyaddress" => $companyaddress,"mobile" => $mobile,"landline" => $landline,"companywebsite" => $companywebsite,"dob" => $dob,"doj" => $doj,"dom" => $dom,"fax" => $fax,"noofemp" => $noofemp,"companysector" => $companysector,"leadtype" => $leadtype,"passportcopy" => $passportcopy,"visacopy" => $visacopy,"eidcopy" => $eidcopy,"noofprojects" => $noofprojects,"nationality" => $nationality,"passportexpirydate" => $passportexpirydate,"visaexpirydate" => $visaexpirydate,"description" => $description,"group" => $group,"source" => $source,"enquirytype" => $enquirytype,"gender" => $gender,"sendsms" => $sendsms,"sendemail" => $sendemail,"timestamp" => $timestamp,"spousename" => $spousename,"spousenumber" => $spousenumber,"spouseemail" => $spouseemail,"spousebirthday" => $spousebirthday,"spousepassportnumber" => $spousepassportnumber,"spousepassportexpirydate" => $spousepassportexpirydate,"spouseeidno" => $spouseeidno,"child1" => $child1,"child2" => $child2,"child3" => $child3);
$query=$this->db->insert( "amsri_contact", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("contact_id",$id);
$query=$this->db->get("amsri_contact")->row();
return $query;
}
function getsinglecontact($id){
$this->db->where("contact_id",$id);
$query=$this->db->get("amsri_contact")->row();
return $query;
}
function getcontactdetail($id) {
    $this->db->where("contact_id",$id);
    $query=$this->db->get("amsri_contact")->row();
    if($query->group =='1'){
        $query->group = 'Owner';
    } else if($query->group =='2'){
        $query->group = 'Amsri Staff';
    } else if($query->group =='3'){
        $query->group = 'Sales';
    } else if($query->group =='4'){
        $query->group = 'Admin';
    }

    if($query->leadtype =='1'){
        $query->leadtype = 'Hot';
    } else if($query->leadtype =='2'){
        $query->leadtype = 'Cold';
    } else if($query->leadtype =='3'){
        $query->leadtype = 'Warm';
    } else if($query->leadtype =='4'){
        $query->leadtype = 'Close';
    }

    if($query->gender =='1'){
        $query->gender = 'Male';
    } else if($query->gender =='2'){
        $query->gender = 'Female';
    }
    return $query;
}
public function edit($contact_id,$name,$designation,$email,$company,$companyaddress,$mobile,$landline,$companywebsite,$dob,$doj,$dom,$fax,$noofemp,$companysector,$leadtype,$passportcopy,$visacopy,$eidcopy,$noofprojects,$nationality,$passportexpirydate,$visaexpirydate,$description,$group,$source,$enquirytype,$gender,$sendsms,$sendemail,$timestamp,$spousename,$spousenumber,$spouseemail,$spousebirthday,$spousepassportnumber,$spousepassportexpirydate,$spouseeidno,$child1,$child2,$child3)
{
    $updatedtimestamp = date("Y-m-d H:i:s");
    // die();
    if($passportcopy=="")
    {
    $passportcopy=$this->contact_model->getsinglecontact($contact_id);
    $passportcopy=$passportcopy->passportcopy;
    }
    if($visacopy=="")
    {
    $visacopy=$this->contact_model->getsinglecontact($contact_id);
    $visacopy=$visacopy->visacopy;
    }
    if($eidcopy=="")
    {
    $eidcopy=$this->contact_model->getsinglecontact($contact_id);
    $eidcopy=$eidcopy->eidcopy;
    }
    $data=array("contact_id" => $contact_id,"name" => $name,"designation" => $designation,"email" => $email,"company" => $company,"companyaddress" => $companyaddress,"mobile" => $mobile,"landline" => $landline,"companywebsite" => $companywebsite,"dob" => $dob,"doj" => $doj,"dom" => $dom,"fax" => $fax,"noofemp" => $noofemp,"companysector" => $companysector,"leadtype" => $leadtype,"passportcopy" => $passportcopy,"visacopy" => $visacopy,"eidcopy" => $eidcopy,"noofprojects" => $noofprojects,"nationality" => $nationality,"passportexpirydate" => $passportexpirydate,"visaexpirydate" => $visaexpirydate,"description" => $description,"group" => $group,"source" => $source,"enquirytype" => $enquirytype,"gender" => $gender,"sendsms" => $sendsms,"sendemail" => $sendemail,"timestamp" => $timestamp,"spousename" => $spousename,"spousenumber" => $spousenumber,"spouseemail" => $spouseemail,"spousebirthday" => $spousebirthday,"spousepassportnumber" => $spousepassportnumber,"spousepassportexpirydate" => $spousepassportexpirydate,"spouseeidno" => $spouseeidno,"child1" => $child1,"child2" => $child2,"child3" => $child3, "updatedtimestamp"=>$updatedtimestamp);
    $this->db->where( "contact_id", $contact_id );
    $query=$this->db->update( "amsri_contact", $data );
    return 1;
}
public function delete($id)
{
    $query=$this->db->query("DELETE FROM `amsri_contact` WHERE `contact_id`='$id'");
    return $query;
}

public function getdropdown()
{
    $query=$this->db->query("SELECT * FROM `amsri_contact` ORDER BY `contact_id` ASC")->result();
    $return=array(
    "" => "Select Option"
    );
    foreach($query as $row)
    {
    $return[$row->contact_id]=$row->name;
    }
    return $return;
}

}
?>
