<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class invoicelist_model extends CI_Model
{
public function create($id,$contact_id,$leadtype,$description,$timestamp)
{
$data=array("id" => $id,"contact_id" => $contact_id,"leadtype" => $leadtype,"description" => $description,"timestamp" => $timestamp);
$query=$this->db->insert( "amsri_invoice", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("amsri_invoice")->row();
return $query;
}
function getsingleleads($id){
$this->db->where("id",$id);
$query=$this->db->get("amsri_invoice")->row();
return $query;
}
public function edit($id,$contact_id,$leadtype,$description,$timestamp)
{

$data=array("id" => $id,"contact_id" => $contact_id,"leadtype" => $leadtype,"description" => $description,"timestamp" => $timestamp);
$this->db->where( "id", $id );
$query=$this->db->update( "amsri_invoice", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `amsri_invoice` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `amsri_invoice` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `amsri_invoice` ORDER BY `id` 
                    ASC")->result();
$return=array(
"" => "Select Option"
);
foreach($query as $row)
{
$return[$row->id]=$row->name;
}
return $return;
}
public function getleadsdetail($id)
{
    $query = $this->db->query("SELECT  `amsri_invoice`.`description`,`amsri_invoice`.`leadtype`,`amsri_contact`.`name` as `contactname`
    FROM `amsri_invoice`
    LEFT JOIN `amsri_contact` ON `amsri_contact`.`contact_id`=`amsri_invoice`.`contact_id`
    WHERE  `amsri_invoice`.`id`='$id'")->row();
    if($query->leadtype =='1'){
        $query->leadtype = 'Hot';
    } else if($query->leadtype =='2'){
        $query->leadtype = 'Cold';
    } else if($query->leadtype =='3'){
        $query->leadtype = 'Warm';
    } else if($query->leadtype =='4'){
        $query->leadtype = 'Close';
    }
    return $query;
}
}
?>
