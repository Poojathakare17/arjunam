<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class client_model extends CI_Model
{
public function create($contact_id,$projectname,$details,$description,$timestamp)
{
$data=array("contact_id" => $contact_id,"projectname" => $projectname,"details" => $details,"description" => $description,"timestamp" => $timestamp);
$query=$this->db->insert( "amsri_client", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("client_id",$id);
$query=$this->db->get("amsri_client")->row();
return $query;
}
function getsingleclient($id){
$this->db->where("client_id",$id);
$query=$this->db->get("amsri_client")->row();
return $query;
}
function getsingleclientdetails ($id) {
    $query = $this->db->query("SELECT  `amsri_client`.*,`amsri_contact`.`name` as `contactname`
    FROM `amsri_client`
    LEFT JOIN `amsri_contact` ON `amsri_contact`.`contact_id`=`amsri_client`.`contact_id`
    WHERE  `amsri_client`.`contact_id`='$id'")->row();
    return $query;
}
public function edit($id,$contact_id,$projectname,$details,$description,$timestamp)
{
$data=array("contact_id" => $contact_id,"projectname" => $projectname,"details" => $details,"description" => $description);
$this->db->where( "client_id", $id );
$query=$this->db->update( "amsri_client", $data );

return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `amsri_client` WHERE `client_id`='$id'");
return $query;
}

public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `amsri_client` ORDER BY `client_id` 
                    ASC")->result();
$return=array(
"" => "Select Option"
);
foreach($query as $row)
{
$return[$row->client_id]=$row->projectname;
}
return $return;
}
}
?>
