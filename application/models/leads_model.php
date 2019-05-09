<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class leads_model extends CI_Model
{
public function create($id,$contact_id,$leadtype,$description,$timestamp)
{
$data=array("id" => $id,"contact_id" => $contact_id,"leadtype" => $leadtype,"description" => $description,"timestamp" => $timestamp);
$query=$this->db->insert( "amsri_leads", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("amsri_leads")->row();
return $query;
}
function getsingleleads($id){
$this->db->where("id",$id);
$query=$this->db->get("amsri_leads")->row();
return $query;
}
public function edit($id,$contact_id,$leadtype,$description,$timestamp)
{

$data=array("id" => $id,"contact_id" => $contact_id,"leadtype" => $leadtype,"description" => $description,"timestamp" => $timestamp);
$this->db->where( "id", $id );
$query=$this->db->update( "amsri_leads", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `amsri_leads` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
{
$query=$this->db->query("SELECT `image` FROM `amsri_leads` WHERE `id`='$id'")->row();
return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `amsri_leads` ORDER BY `id` 
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
    $query = $this->db->query("SELECT  `amsri_leads`.`description`,`amsri_leads`.`leadtype`,`amsri_contact`.`name` as `contactname`
    FROM `amsri_leads`
    LEFT JOIN `amsri_contact` ON `amsri_contact`.`contact_id`=`amsri_leads`.`contact_id`
    WHERE  `amsri_leads`.`id`='$id'")->row();
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
