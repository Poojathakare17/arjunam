<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class invoicelist_model extends CI_Model
{
    public function getinvoicelist($id){
        $query = $this->db->query("SELECT  CONCAT('IN',LPAD(`amsri_invoicelist`.`id`,5,0)) as `id`,`amsri_invoicelist`.`invoiceupload`,`amsri_invoicelist`.`invoicenumber`,`amsri_invoicelist`.`invoiceamount`,`amsri_transaction`.`amount`,GROUP_CONCAT(CONCAT('AM',LPAD(`amsri_invoicejobnumber`.`jobnumber`,5,0))) as `Jobnumber`,`amsri_invoicejobnumber`.`invoiceid` FROM `amsri_invoicejobnumber`
        LEFT JOIN `amsri_invoicelist` ON `amsri_invoicelist`.`id`=`amsri_invoicejobnumber`.`invoiceid`
        LEFT JOIN `amsri_transaction` ON `amsri_transaction`.`id`=`amsri_invoicejobnumber`.`jobnumber`
        GROUP BY `amsri_invoicejobnumber`.`invoiceid`")->result();
        return $query;
    }


}
?>
