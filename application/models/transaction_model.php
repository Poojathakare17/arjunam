<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class transaction_model extends CI_Model
{
public function create($client_id,$created_date,$due_date,$dept,$personalloted,$source,$valueofwork,$invoicenumber,$fees,$claims,$vat,$amount,$balance,$typeofjob,$periodicity,$typeofwork,$periodofassignment,$description)
{
    $data=array("client_id" => $client_id,"created_date" => $created_date,"due_date" => $due_date,"dept" => $dept,"personalloted" => $personalloted,"source" => $source,"valueofwork" => $valueofwork,"personalloted" => $personalloted,"source" => $source,"valueofwork" => $valueofwork,"invoicenumber" => $invoicenumber,"fees" => $fees,"claims" => $claims,"vat" => $vat,"amount" => $amount,"balance" => $balance,"typeofjob" => $typeofjob,"periodicity" => $periodicity,"typeofwork" => trim($typeofwork),"periodofassignment" => $periodofassignment,"description" => trim($description));
    $query=$this->db->insert( "amsri_transaction", $data );
    $mainid=$this->db->insert_id();

    if($typeofjob && $typeofjob == 2) {
        for($i=0; $i<($periodicity-1); $i++) {

            $data=array("client_id" => $client_id,"dept" => $dept,"personalloted" => $personalloted,"source" => $source,"valueofwork" => $valueofwork,"personalloted" => $personalloted,"source" => $source,"valueofwork" => $valueofwork,"invoicenumber" => $invoicenumber,"fees" => $fees,"claims" => $claims,"vat" => $vat,"amount" => $amount,"balance" => $balance,"typeofjob" => $typeofjob,"periodicity" => $periodicity,"typeofwork" => $typeofwork,"periodofassignment" => $periodofassignment,"description" => $description, "parent" => $mainid);
            $query1=$this->db->insert( "amsri_transaction", $data );
        } 
        
    }

    if(!$query)
    return  0;
    else
    return  $mainid;
}
public function beforeedit($id)
{
    $this->db->where("id",$id);
    $query=$this->db->get("amsri_transaction")->row();
    return $query;
}
public function getselectedjobnumberlist($ids) {
    $query = $this->db->query("SELECT `amsri_transaction`.`id`, CONCAT('AM', LPAD(`amsri_transaction`.`id`, '5', '0')) as 'jobnumber', `amsri_transaction`.`created_date`, `amsri_client`.`projectname`, `amsri_transaction`.`due_date`,`amsri_transaction`.`balance`,`amsri_transaction`.`status`, `amsri_contact`.`name` as `personalloted`, `amsri_transaction`.`valueofwork`, `amsri_transaction`.`amount`,`amsri_transaction`.`status` FROM (`amsri_transaction`) 
    LEFT JOIN `amsri_client` ON `amsri_client`.`client_id`=`amsri_transaction`.`client_id` 
    LEFT JOIN `amsri_contact` ON `amsri_contact`.`contact_id`=`amsri_transaction`.`personalloted` 
    WHERE `amsri_transaction`.`id` IN ($ids)")->result();
    if(!$query)
    return  0;
    else
    return  $query;
}

public function getchildtransactions($id) {
    $query = $this->db->query("SELECT `amsri_transaction`.`id`, CONCAT('AM', LPAD(`amsri_transaction`.`id`, '5', '0')) as 'jobnumber', `amsri_transaction`.`created_date`, `amsri_client`.`projectname`, `amsri_transaction`.`due_date`,`amsri_transaction`.`balance`,`amsri_transaction`.`status`, `user`.`name` as `personalloted`, `amsri_transaction`.`valueofwork`, `amsri_transaction`.`amount`,`amsri_transaction`.`status` FROM (`amsri_transaction`) 
    LEFT JOIN `amsri_client` ON `amsri_client`.`client_id`=`amsri_transaction`.`client_id` 
    LEFT JOIN `user` ON `user`.`id`=`amsri_transaction`.`personalloted` 
    WHERE `amsri_transaction`.`id` = $id OR `amsri_transaction`.`parent` = $id")->result();
    return $query;
}

public function getperiodicbefore($id){
    $query = $this->db->query("SELECT * FROM `amsri_transaction` WHERE `id`=$id")->row();
    return $query;
}
public function submitSubJobDetails($id,$created_date,$due_date,$amount,$balance,$description) {
    $data=array("created_date" => $created_date,"due_date" => $due_date,"amount" => $amount,"description" => trim($description),"balance" => $balance);
    $this->db->where( "id", $id );
    $query=$this->db->update( "amsri_transaction", $data );
    if($query){
        return 1;
    } else {
        return 0;
    }
    
}
public function deleteSelected($ids)
{
    if(count($ids) > 0) {
        $str = '';
        foreach($ids as $key=> $value){
            $str.= $value;
            $str.=",";
        }
        $str = rtrim($str,',');
        $query=$this->db->query("DELETE FROM `amsri_transaction` WHERE `id` IN ($str)");
        // print_r($query);
        return $query;
    }
    else{
        return false;
    }
    
}

public function changeperiodicstatus($ids, $getbuttonvalue) {
    // print_r($ids);
    // echo 'status is '.$getbuttonvalue.' %%%%';
    if(count($ids) > 0) {
        $str = '';
        foreach($ids as $key=> $value){
            $str.= $value;
            $str.=",";
        }
        $str = rtrim($str,',');
        $query=$this->db->query("UPDATE `amsri_transaction` SET `status`=$getbuttonvalue WHERE `id` IN ($str)");
        return $query;
    }
    else{
        return false;
    }

}
public function gettransactiondetail($id)
{
    $query = $this->db->query("SELECT `amsri_transaction`.`id`, `amsri_transaction`.`created_date`, `amsri_client`.`projectname` as `client_id`, `amsri_transaction`.`due_date`, `amsri_dept`.`name` as `dept`, `amsri_transaction`.`status`, `amsri_transaction`.`message`, `amsri_transaction`.`timestamp`, `amsri_transaction`.`typeofwork`,`amsri_transaction`.`periodofassignment`, `amsri_contact`.`name`  AS `personalloted` , `amsri_transaction`.`source`, `amsri_transaction`.`invoicenumber`, `amsri_transaction`.`fees`, `amsri_transaction`.`claims`, `amsri_transaction`.`vat`, `amsri_transaction`.`amount`, `amsri_transaction`.`balance`, `amsri_transaction`.`jobnumber`, `amsri_transaction`.`valueofwork`, `amsri_transaction`.`typeofjob`, `amsri_transaction`.`periodicity`, `amsri_transaction`.`description` FROM `amsri_transaction` 
    LEFT JOIN `amsri_client` ON `amsri_client`.`client_id`=`amsri_transaction`.`client_id` 
    LEFT JOIN `amsri_dept` ON `amsri_dept`.`id`=`amsri_transaction`.`dept` 
    LEFT JOIN `amsri_contact` ON `amsri_contact`.`contact_id`=`amsri_transaction`.`personalloted`  
    WHERE  `amsri_transaction`.`id`='$id'")->row();
    if($query->typeofjob == 1){
        $query->typeofjob = 'One time';
    } else{
        $query->typeofjob = 'Repeated';
    }
    return $query;
}
function getsingletransaction($id){
    $this->db->where("id",$id);
    $query=$this->db->get("amsri_transaction")->row();
    return $query;
}
public function edit($id,$client_id,$created_date,$due_date,$dept,$personalloted,$source,$valueofwork,$invoicenumber,$fees,$claims,$vat,$amount,$balance,$typeofjob,$periodicity,$typeofwork,$periodofassignment,$description,$parent)
{
    if($invoice=="")
    {
    $invoice=$this->transaction_model->getsingletransaction($id);
    $invoice=$invoice->invoice;
    }
    $data=array("client_id" => $client_id,"created_date" => $created_date,"due_date" => $due_date,"dept" => $dept,"personalloted" => $personalloted,"source" => $source,"valueofwork" => $valueofwork,"personalloted" => $personalloted,"source" => $source,"valueofwork" => $valueofwork,"invoicenumber" => $invoicenumber,"fees" => $fees,"claims" => $claims,"vat" => $vat,"amount" => $amount,"balance" => $balance,"typeofjob" => $typeofjob,"periodicity" => $periodicity,"typeofwork" => $typeofwork,"periodofassignment" => $periodofassignment,"description" => trim($description),"parent" => $parent);
    $this->db->where( "id", $id );
    $query=$this->db->update( "amsri_transaction", $data );
    return 1;
}
public function delete($id)
{
    $query=$this->db->query("DELETE FROM `amsri_transaction` WHERE `id`='$id' OR `parent` = '$id'");
    if(!$query)
        return  0;
    
}
public function getdropdown()
{
    $query=$this->db->query("SELECT * FROM `amsri_transaction` ORDER BY `id` 
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
public function getamsristaffdropdown()
{
    $query=$this->db->query("SELECT * FROM `user` WHERE `status`=1 AND `accesslevel`=1 ORDER BY `name` ASC")->result();
    $return=array(
    "" => "Select Option"
    );
    foreach($query as $row)
    {
    $return[$row->id]=$row->name;
    }
    return $return;
}

public function getjobnumberdropdown(){
        $query=$this->db->query("SELECT * FROM `amsri_transaction` ORDER BY `timestamp` DESC")->result();
        $return=array(
        "" => "Select Option"
        );
        foreach($query as $row)
        {
        $return[$row->contact_id]=$row->name;
        }
        return $return;
    }
    
    public function getinvoices($id){
        $query = $this->db->query("SELECT `id`, `invoiceupload`, `invoicenumber`, `invoiceamount` FROM `amsri_invoicelist` WHERE `id` IN (SELECT `invoiceid` FROM `amsri_invoicejobnumber` WHERE `jobnumber` = $id)")->result();
        return $query;
    }

    public function invoicesubmit($data,$id)
    {
        foreach($data as $row) {
            $filename = $row['file_name'];
            $query=$this->db->query("INSERT INTO `amsri_invoice`(`transactionid`,`image`) VALUES ('$id','$filename')");
            if(!$query){
                return false;
            } 
        }
        return 1;
    }

    public function deleteinvoices($id){
        $query = $this->db->query("SELECT * FROM `amsri_invoice` WHERE  `id`='$id'")->row();
        $file = $query->image;
        $myFile = base_url('uploads')."/".$file;
        // echo $myFile;
        unlink($myFile);
        // die();
        $query=$this->db->query("DELETE FROM `amsri_invoice` WHERE `id`='$id'");
            if($query){
                return 1;
            } else{
                return 0;
            }
    }

    public function createinvoicelistsubmit($image) {
        $postdata = $_POST;
        // print_r($postdata);
        $invoiceupload = $image;
        if($this->input->get_post('invoiceamount')){
            $invoiceamount = $this->input->get_post('invoiceamount');
        }
        if($this->input->get_post('invoicenumber')){
            $invoicenumber = $this->input->get_post('invoicenumber');
        }
        $data=array("invoiceupload" => $invoiceupload,"invoiceamount" => $invoiceamount,"invoicenumber" => $invoicenumber);
        $query=$this->db->insert( "amsri_invoicelist", $data );
        $invoiceid=$this->db->insert_id();

        foreach($postdata as $key=>$value) {
            if (strpos($key, 'payment') !== false)  {
                //get id from each payment

                $id = substr($key, 8);
                //get balance in maintable
                $getjobdetails=$this->db->query("SELECT `balance`,`valueofwork`,`amount` FROM `amsri_transaction` WHERE `id`=$id")->row();
                if(!$getjobdetails)
                return  0;
                $balance = $getjobdetails->balance;
                $valueofwork =$getjobdetails->valueofwork;
                if($balance != 0){
                    $newbalance = abs($balance- $value); 
                    // echo "new balance : ".$newbalance;
                    // echo "type of new balance : ".gettype($newbalance);
                    // die();
                    if($newbalance == $valueofwork){
                        $status = 1;
                    } else if($newbalance < $valueofwork && $newbalance != 0){
                        $status = 2;
                    } else if($newbalance == 0 || $newbalance == 0.00){
                        $status = 3;
                    } else if($newbalance > $valueofwork){
                        $status = 4;
                    }
                    // die();
                    //update amount in main table
                    $data=array("amount" => $value,"balance" => $newbalance, "status" => $status);
                    $this->db->where( "id", $id );
                    $updatequery=$this->db->update( "amsri_transaction", $data );
                    if(!$updatequery)
                    return  0;

                    $data=array("jobnumber" => $id,"invoiceid" => $invoiceid);
                    $insertjobnumber=$this->db->insert( "amsri_invoicejobnumber", $data );
                    $invoicejobnumberid=$this->db->insert_id();
                    if(!$invoicejobnumberid)
                    return  0;
                }
                
            }   

        }
        // die();


        if(!$query)
        return  0;
        else
        return  $id;
    }
}
?>
