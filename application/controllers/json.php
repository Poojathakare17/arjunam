<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Json extends CI_Controller 
{function getallcontact()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`amsri_contact`.`contact_id`";
$elements[0]->sort="1";
$elements[0]->header="contact_id";
$elements[0]->alias="contact_id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`amsri_contact`.`name`";
$elements[1]->sort="1";
$elements[1]->header="Name";
$elements[1]->alias="name";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`amsri_contact`.`designation`";
$elements[2]->sort="1";
$elements[2]->header="Designation";
$elements[2]->alias="designation";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`amsri_contact`.`email`";
$elements[3]->sort="1";
$elements[3]->header="Email";
$elements[3]->alias="email";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`amsri_contact`.`company`";
$elements[4]->sort="1";
$elements[4]->header="Company";
$elements[4]->alias="company";

$elements=array();
$elements[5]=new stdClass();
$elements[5]->field="`amsri_contact`.`companyaddress`";
$elements[5]->sort="1";
$elements[5]->header="Company Address";
$elements[5]->alias="companyaddress";

$elements=array();
$elements[6]=new stdClass();
$elements[6]->field="`amsri_contact`.`mobile`";
$elements[6]->sort="1";
$elements[6]->header="Mobile";
$elements[6]->alias="mobile";

$elements=array();
$elements[7]=new stdClass();
$elements[7]->field="`amsri_contact`.`landline`";
$elements[7]->sort="1";
$elements[7]->header="Landline";
$elements[7]->alias="landline";

$elements=array();
$elements[8]=new stdClass();
$elements[8]->field="`amsri_contact`.`companywebsite`";
$elements[8]->sort="1";
$elements[8]->header="Company Website";
$elements[8]->alias="companywebsite";

$elements=array();
$elements[9]=new stdClass();
$elements[9]->field="`amsri_contact`.`dob`";
$elements[9]->sort="1";
$elements[9]->header="DOB";
$elements[9]->alias="dob";

$elements=array();
$elements[10]=new stdClass();
$elements[10]->field="`amsri_contact`.`doj`";
$elements[10]->sort="1";
$elements[10]->header="DOJ";
$elements[10]->alias="doj";

$elements=array();
$elements[11]=new stdClass();
$elements[11]->field="`amsri_contact`.`dom`";
$elements[11]->sort="1";
$elements[11]->header="DOM";
$elements[11]->alias="dom";

$elements=array();
$elements[12]=new stdClass();
$elements[12]->field="`amsri_contact`.`fax`";
$elements[12]->sort="1";
$elements[12]->header="fax";
$elements[12]->alias="fax";

$elements=array();
$elements[13]=new stdClass();
$elements[13]->field="`amsri_contact`.`noofemp`";
$elements[13]->sort="1";
$elements[13]->header="Number of Employee in Company";
$elements[13]->alias="noofemp";

$elements=array();
$elements[14]=new stdClass();
$elements[14]->field="`amsri_contact`.`companysector`";
$elements[14]->sort="1";
$elements[14]->header="Company Sector";
$elements[14]->alias="companysector";

$elements=array();
$elements[15]=new stdClass();
$elements[15]->field="`amsri_contact`.`leadtype`";
$elements[15]->sort="1";
$elements[15]->header="Lead Type";
$elements[15]->alias="leadtype";

$elements=array();
$elements[16]=new stdClass();
$elements[16]->field="`amsri_contact`.`passportcopy`";
$elements[16]->sort="1";
$elements[16]->header="Passport Copy";
$elements[16]->alias="passportcopy";

$elements=array();
$elements[17]=new stdClass();
$elements[17]->field="`amsri_contact`.`visacopy`";
$elements[17]->sort="1";
$elements[17]->header="Visa Copy";
$elements[17]->alias="visacopy";

$elements=array();
$elements[18]=new stdClass();
$elements[18]->field="`amsri_contact`.`eidcopy`";
$elements[18]->sort="1";
$elements[18]->header="Emirates id Copy";
$elements[18]->alias="eidcopy";

$elements=array();
$elements[19]=new stdClass();
$elements[19]->field="`amsri_contact`.`noofprojects`";
$elements[19]->sort="1";
$elements[19]->header="Number of Projects";
$elements[19]->alias="noofprojects";

$elements=array();
$elements[20]=new stdClass();
$elements[20]->field="`amsri_contact`.`nationality`";
$elements[20]->sort="1";
$elements[20]->header="Nationality";
$elements[20]->alias="nationality";

$elements=array();
$elements[21]=new stdClass();
$elements[21]->field="`amsri_contact`.`passportexpirydate`";
$elements[21]->sort="1";
$elements[21]->header="Passport expiry date";
$elements[21]->alias="passportexpirydate";

$elements=array();
$elements[22]=new stdClass();
$elements[22]->field="`amsri_contact`.`visaexpirydate`";
$elements[22]->sort="1";
$elements[22]->header="Visa expiry date";
$elements[22]->alias="visaexpirydate";

$elements=array();
$elements[23]=new stdClass();
$elements[23]->field="`amsri_contact`.`description`";
$elements[23]->sort="1";
$elements[23]->header="Description";
$elements[23]->alias="description";

$elements=array();
$elements[24]=new stdClass();
$elements[24]->field="`amsri_contact`.`group`";
$elements[24]->sort="1";
$elements[24]->header="Group";
$elements[24]->alias="group";

$elements=array();
$elements[25]=new stdClass();
$elements[25]->field="`amsri_contact`.`source`";
$elements[25]->sort="1";
$elements[25]->header="Source";
$elements[25]->alias="source";

$elements=array();
$elements[26]=new stdClass();
$elements[26]->field="`amsri_contact`.`enquirytype`";
$elements[26]->sort="1";
$elements[26]->header="Enquiry type";
$elements[26]->alias="enquirytype";

$elements=array();
$elements[27]=new stdClass();
$elements[27]->field="`amsri_contact`.`gender`";
$elements[27]->sort="1";
$elements[27]->header="Gender";
$elements[27]->alias="gender";

$elements=array();
$elements[28]=new stdClass();
$elements[28]->field="`amsri_contact`.`sendsms`";
$elements[28]->sort="1";
$elements[28]->header="Send Sms";
$elements[28]->alias="sendsms";

$elements=array();
$elements[29]=new stdClass();
$elements[29]->field="`amsri_contact`.`sendemail`";
$elements[29]->sort="1";
$elements[29]->header="Send Email";
$elements[29]->alias="sendemail";

$elements=array();
$elements[30]=new stdClass();
$elements[30]->field="`amsri_contact`.`timestamp`";
$elements[30]->sort="1";
$elements[30]->header="timestamp";
$elements[30]->alias="timestamp";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `amsri_contact`");
$this->load->view("json",$data);
}
public function getsinglecontact()
{
$id=$this->input->get_post("id");
$data["message"]=$this->contact_model->getsinglecontact($id);
$this->load->view("json",$data);
}
function getallclient()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`amsri_client`.`client_id`";
$elements[0]->sort="1";
$elements[0]->header="Client id";
$elements[0]->alias="client_id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`amsri_client`.`contact_id`";
$elements[1]->sort="1";
$elements[1]->header="Contact id";
$elements[1]->alias="contact_id";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`amsri_client`.`projectname`";
$elements[2]->sort="1";
$elements[2]->header="Project Name";
$elements[2]->alias="projectname";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`amsri_client`.`details`";
$elements[3]->sort="1";
$elements[3]->header="Details";
$elements[3]->alias="details";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`amsri_client`.`description`";
$elements[4]->sort="1";
$elements[4]->header="Description";
$elements[4]->alias="description";

$elements=array();
$elements[5]=new stdClass();
$elements[5]->field="`amsri_client`.`timestamp`";
$elements[5]->sort="1";
$elements[5]->header="timestamp";
$elements[5]->alias="timestamp";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `amsri_client`");
$this->load->view("json",$data);
}
public function getsingleclient()
{
$id=$this->input->get_post("id");
$data["message"]=$this->client_model->getsingleclient($id);
$this->load->view("json",$data);
}
function getallassociatedcontact()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`amsri_associatedcontact`.`associatedcontact_id`";
$elements[0]->sort="1";
$elements[0]->header="Associated contact id";
$elements[0]->alias="associatedcontact_id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`amsri_associatedcontact`.`contact_id`";
$elements[1]->sort="1";
$elements[1]->header="contact_id";
$elements[1]->alias="contact_id";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`amsri_associatedcontact`.`client_id`";
$elements[2]->sort="1";
$elements[2]->header="client_id";
$elements[2]->alias="client_id";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`amsri_associatedcontact`.`timestamp`";
$elements[3]->sort="1";
$elements[3]->header="timestamp";
$elements[3]->alias="timestamp";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `amsri_associatedcontact`");
$this->load->view("json",$data);
}
public function getsingleassociatedcontact()
{
$id=$this->input->get_post("id");
$data["message"]=$this->associatedcontact_model->getsingleassociatedcontact($id);
$this->load->view("json",$data);
}
function getalltransaction()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`amsri_transaction`.`transaction_id`";
$elements[0]->sort="1";
$elements[0]->header="transaction_id";
$elements[0]->alias="transaction_id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`amsri_transaction`.`contact_id`";
$elements[1]->sort="1";
$elements[1]->header="Contact id";
$elements[1]->alias="contact_id";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`amsri_transaction`.`client_id`";
$elements[2]->sort="1";
$elements[2]->header="client_id";
$elements[2]->alias="client_id";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`amsri_transaction`.`amount`";
$elements[3]->sort="1";
$elements[3]->header="Amount";
$elements[3]->alias="amount";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`amsri_transaction`.`invoice`";
$elements[4]->sort="1";
$elements[4]->header="invoice";
$elements[4]->alias="invoice";

$elements=array();
$elements[5]=new stdClass();
$elements[5]->field="`amsri_transaction`.`date`";
$elements[5]->sort="1";
$elements[5]->header="Date";
$elements[5]->alias="date";

$elements=array();
$elements[6]=new stdClass();
$elements[6]->field="`amsri_transaction`.`status`";
$elements[6]->sort="1";
$elements[6]->header="Status";
$elements[6]->alias="status";

$elements=array();
$elements[7]=new stdClass();
$elements[7]->field="`amsri_transaction`.`message`";
$elements[7]->sort="1";
$elements[7]->header="Message";
$elements[7]->alias="message";

$elements=array();
$elements[8]=new stdClass();
$elements[8]->field="`amsri_transaction`.`timestamp`";
$elements[8]->sort="1";
$elements[8]->header="timestamp";
$elements[8]->alias="timestamp";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `amsri_transaction`");
$this->load->view("json",$data);
}
public function getsingletransaction()
{
$id=$this->input->get_post("id");
$data["message"]=$this->transaction_model->getsingletransaction($id);
$this->load->view("json",$data);
}
function getallleads()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`amsri_leads`.`lead_id`";
$elements[0]->sort="1";
$elements[0]->header="lead_id";
$elements[0]->alias="lead_id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`amsri_leads`.`contact_id`";
$elements[1]->sort="1";
$elements[1]->header="contact_id";
$elements[1]->alias="contact_id";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`amsri_leads`.`leadtype`";
$elements[2]->sort="1";
$elements[2]->header="Lead type";
$elements[2]->alias="leadtype";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`amsri_leads`.`description`";
$elements[3]->sort="1";
$elements[3]->header="Description";
$elements[3]->alias="description";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`amsri_leads`.`timestamp`";
$elements[4]->sort="1";
$elements[4]->header="timestamp";
$elements[4]->alias="timestamp";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `amsri_leads`");
$this->load->view("json",$data);
}
public function getsingleleads()
{
$id=$this->input->get_post("id");
$data["message"]=$this->leads_model->getsingleleads($id);
$this->load->view("json",$data);
}

public function deleteinvoices(){
    $query = $this->db->query("SELECT * FROM `amsri_invoice` WHERE  `id`=8")->row();
    $file = $query->image;
    $myFile = base_url('uploads')."/".$file;
    unlink($myFile);
    $query=$this->db->query("DELETE FROM `amsri_invoice` WHERE `id`=8");
        if($query){
            return 1;
        } else{
            return 0;
        }
}

public function test()
{
    $periodicity = 3;
    $month_created_date = '2019-05-06';
    $month_due_date = '2020-05-06';
        for($i=0; $i<($periodicity-1); $i++) {
            $month_created_date=date_create($month_created_date);
            date_add($month_created_date,date_interval_create_from_date_string($periodicity." month"));
            $month_created_date =  date_format($month_created_date,"Y-m-d");

            $month_due_date=date_create($month_due_date);
            date_add($month_due_date,date_interval_create_from_date_string($periodicity." month"));
            $month_due_date =  date_format($month_due_date,"Y-m-d");

            echo "i = ".$i." created date ".$month_created_date." due date ".$month_due_date.'<br>';
        }
}
public function sub()
{
    $balance = 0.00;
    if($balance == 0 || $balance == 0.00){
        echo 'match';
    }
    echo gettype($balance);
}
} ?>