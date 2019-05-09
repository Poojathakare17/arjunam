<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class associatedcontact_model extends CI_Model
{
public function create($associatedcontact_id,$contact_id,$client_id,$timestamp)
{
    $data=array("associatedcontact_id" => $associatedcontact_id,"contact_id" => $contact_id,"client_id" => $client_id,"timestamp" => $timestamp);
    $query=$this->db->insert( "amsri_associatedcontact", $data );
    $id=$this->db->insert_id();
    if(!$query)
    return  0;
    else
    return  $id;
}
public function beforeedit($id)
{
    $this->db->where("associatedcontact_id",$id);
    $query=$this->db->get("amsri_associatedcontact")->row();
    return $query;
}
function getsingleassociatedcontact($id){
    $this->db->where("associatedcontact_id",$id);
    $query=$this->db->get("amsri_associatedcontact")->row();
    return $query;
}
public function edit($associatedcontact_id,$contact_id,$client_id,$timestamp)
{
    $data=array("associatedcontact_id" => $associatedcontact_id,"contact_id" => $contact_id,"client_id" => $client_id);
    $this->db->where( "associatedcontact_id", $associatedcontact_id );
    $query=$this->db->update( "amsri_associatedcontact", $data );
    return 1;
}
public function delete($id)
{
    $query=$this->db->query("DELETE FROM `amsri_associatedcontact` WHERE `associatedcontact_id`='$id'");
    return $query;
}
public function getimagebyid($id)
{
    $query=$this->db->query("SELECT `image` FROM `amsri_associatedcontact` WHERE `associatedcontact_id`='$id'")->row();
    return $query;
}
public function getdropdown()
{
$query=$this->db->query("SELECT * FROM `amsri_associatedcontact` ORDER BY `associatedcontact_id` 
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
public function getassociatedcontactdetail($id)
{
    $query = $this->db->query("SELECT  `amsri_client`.`projectname` as `clientname`,`amsri_contact`.`name` as `contactname`
    FROM `amsri_associatedcontact`
    LEFT JOIN `amsri_contact` ON `amsri_contact`.`contact_id`=`amsri_associatedcontact`.`contact_id`
    LEFT JOIN `amsri_client` ON `amsri_client`.`client_id`=`amsri_associatedcontact`.`client_id`
    WHERE  `amsri_associatedcontact`.`associatedcontact_id`='$id'")->row();
    return $query;
}
}
?>
