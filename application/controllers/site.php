<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Site extends CI_Controller 
{
	public function __construct( )
	{
		parent::__construct();
		
		$this->is_logged_in();
	}
	function is_logged_in( )
	{
		$is_logged_in = $this->session->userdata( 'logged_in' );
		if ( $is_logged_in !== 'true' || !isset( $is_logged_in ) ) {
			redirect( base_url() . 'index.php/login', 'refresh' );
		} //$is_logged_in !== 'true' || !isset( $is_logged_in )
	}
	function checkaccess($access)
	{
		$accesslevel=$this->session->userdata('accesslevel');
		if(!in_array($accesslevel,$access))
			redirect( base_url() . 'index.php/site?alerterror=You do not have access to this page. ', 'refresh' );
	}
    public function getOrderingDone()
    {
        $orderby=$this->input->get("orderby");
        $ids=$this->input->get("ids");
        $ids=explode(",",$ids);
        $tablename=$this->input->get("tablename");
        $where=$this->input->get("where");
        if($where == "" || $where=="undefined")
        {
            $where=1;
        }
        $access = array(
            '1',
        );
        $this->checkAccess($access);
        $i=1;
        foreach($ids as $id)
        {
            //echo "UPDATE `$tablename` SET `$orderby` = '$i' WHERE `id` = `$id` AND $where";
            $this->db->query("UPDATE `$tablename` SET `$orderby` = '$i' WHERE `id` = '$id' AND $where");
            $i++;
            //echo "/n";
        }
        $data["message"]=true;
        $this->load->view("json",$data);
        
    }
	public function index()
	{
		$access = array("1","2");
		$this->checkaccess($access);
        $data[ 'page' ] = 'dashboard';
        $data['contactcount']=$this->user_model->getContactCount();
        $data['clientcount']=$this->user_model->getClientCount();
        $data['transactioncount']=$this->user_model->getTransactionCount();
		$data[ 'title' ] = 'Welcome';
		$this->load->view( 'template', $data );	
	}
	public function createuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
        $data['gender']=$this->user_model->getgenderdropdown();
        $data[ 'dept' ] =$this->user_model->getdeptdropdown();
//        $data['category']=$this->category_model->getcategorydropdown();
		$data[ 'page' ] = 'createuser';
		$data[ 'title' ] = 'Create User';
		$this->load->view( 'template', $data );	
	}
	function createusersubmit()
	{
		$access = array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('password','Password','trim|required');
        $this->form_validation->set_rules('mobile','Mobile','trim|required');
        $this->form_validation->set_rules('accesslevel','Access Level','trim|required');
        $this->form_validation->set_rules('dept','Department','trim|required');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
            $data['gender']=$this->user_model->getgenderdropdown();
            $data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'dept' ] =$this->user_model->getdeptdropdown();
            $data[ 'status' ] =$this->user_model->getstatusdropdown();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
            $data[ 'page' ] = 'createuser';
            $data[ 'title' ] = 'Create User';
            // $data['alerterror']="New user could not be created.";
            $this->load->view( 'template', $data );	
		}
		else
		{
            $name=$this->input->post('name');
            $email=$this->input->post('email');
            $password=$this->input->post('password');
            $accesslevel=$this->input->post('accesslevel');
            $status=$this->input->post('status');
            $phone=$this->input->post('phone');
            $fax=$this->input->post('fax');
            $gender=$this->input->post('gender');
            $mobile=$this->input->post('mobile');
            $empno=$this->input->post('empno');
            $dept=$this->input->post('dept');
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $this->load->library('upload', $config);
                $filename = "image";
                $image = "";
                if ($this->upload->do_upload($filename)) {
                    $uploaddata = $this->upload->data();
                    $image = $uploaddata['file_name'];
                    $config_r['source_image'] = './uploads/' . $uploaddata['file_name'];
                    $config_r['maintain_ratio'] = TRUE;
                    $config_t['create_thumb'] = FALSE; ///add this
                    $config_r['width'] = 800;
                    $config_r['height'] = 800;
                    $config_r['quality'] = 100;
                    //end of configs
                    $this->load->library('image_lib', $config_r);
                    $this->image_lib->initialize($config_r);
                    if (!$this->image_lib->resize()) {
                        echo "Failed." . $this->image_lib->display_errors();
                        
                    } else {
                        $image = $this->image_lib->dest_image;
                        
                    }
                }
            // print_r($_POST);
            // die();
			if($this->user_model->create($name,$email,$password,$accesslevel,$status,$phone,$fax,$gender,$mobile,$empno,$dept,$image)==0)
			$data['alerterror']="New user could not be created.";
			else
			$data['alertsuccess']="User created Successfully.";
			$data['redirect']="site/viewusers";
			$this->load->view("redirect",$data);
		}
    }
    function check_email_avalibility(){
        $email = $this->input->get_post('email');
        $emailstatus=$this->user_model->check_email_avalibility($email);
        if($emailstatus){
            echo "<span style='color:red; padding-left: 15px;'>Email already exist</span>";
        } else {
            echo "<span style='color:green; padding-left: 15px;'>Email available</span>";
        }
    }
    function viewusers()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['page']='viewusers';
        $data['base_url'] = site_url("site/viewusersjson");
        
		$data['title']='View Users';
		$this->load->view('template',$data);
	} 
    function viewusersjson()
	{
		$access = array("1");
		$this->checkaccess($access);
        
        
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`user`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        
        $elements[1]=new stdClass();
        $elements[1]->field="`user`.`name`";
        $elements[1]->sort="1";
        $elements[1]->header="Name";
        $elements[1]->alias="name";
        
        $elements[2]=new stdClass();
        $elements[2]->field="`user`.`email`";
        $elements[2]->sort="1";
        $elements[2]->header="Email";
        $elements[2]->alias="email";
        
        $elements[3]=new stdClass();
        $elements[3]->field="`amsri_dept`.`name`";
        $elements[3]->sort="1";
        $elements[3]->header="Dept";
        $elements[3]->alias="dept";
        
        $elements[4]=new stdClass();
        $elements[4]->field="`user`.`empno`";
        $elements[4]->sort="1";
        $elements[4]->header="Empno";
        $elements[4]->alias="empno";
        
        $elements[5]=new stdClass();
        $elements[5]->field="`user`.`mobile`";
        $elements[5]->sort="1";
        $elements[5]->header="Mobile";
        $elements[5]->alias="mobile";
       
        $elements[6]=new stdClass();
        $elements[6]->field="`accesslevel`.`name`";
        $elements[6]->sort="1";
        $elements[6]->header="Accesslevel";
        $elements[6]->alias="accesslevel";
       
        $elements[7]=new stdClass();
        $elements[7]->field="`statuses`.`name`";
        $elements[7]->sort="1";
        $elements[7]->header="Status";
        $elements[7]->alias="status";
       
        
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
       
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `user`  LEFT OUTER JOIN `accesslevel` ON `accesslevel`.`id`=`user`.`accesslevel` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`user`.`status` LEFT OUTER JOIN `amsri_dept` ON `amsri_dept`.`id`=`user`.`dept`");
        
		$this->load->view("json",$data);
	} 
    
    
	function edituser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data['gender']=$this->user_model->getgenderdropdown();
        $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
        $data[ 'dept' ] =$this->user_model->getdeptdropdown();
		$data['before']=$this->user_model->beforeedit($this->input->get('id'));
		$data['page']='edituser';
		$data['page2']='block/userblock';
		$data['title']='Edit User';
		$this->load->view('template',$data);
	}
	function editusersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
        $this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('password','Password','trim|required');
        $this->form_validation->set_rules('mobile','Mobile','trim|required');
        $this->form_validation->set_rules('accesslevel','Access Level','trim|required');
        $this->form_validation->set_rules('dept','Department','trim|required');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->user_model->getstatusdropdown();
            $data['accesslevel']=$this->user_model->getaccesslevels();
            $data['gender']=$this->user_model->getgenderdropdown();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
            $data[ 'dept' ] =$this->user_model->getdeptdropdown();
			$data['before']=$this->user_model->beforeedit($this->input->post('id'));
			$data['page']='edituser';
//			$data['page2']='block/userblock';
			$data['title']='Edit User';
			$this->load->view('template',$data);
		}
		else
		{
            
            $id=$this->input->get_post('id');
            $name=$this->input->post('name');
            $email=$this->input->post('email');
            $password=$this->input->post('password');
            $accesslevel=$this->input->post('accesslevel');
            $status=$this->input->post('status');
            $phone=$this->input->post('phone');
            $fax=$this->input->post('fax');
            $gender=$this->input->post('gender');
            $mobile=$this->input->post('mobile');
            $empno=$this->input->post('empno');
            $dept=$this->input->post('dept');
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $filename = "image";
            $image = "";
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $image = $uploaddata['file_name'];
                $config_r['source_image'] = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE; ///add this
                $config_r['width'] = 800;
                $config_r['height'] = 800;
                $config_r['quality'] = 100;
                //end of configs
                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if (!$this->image_lib->resize()) {
                    echo "Failed." . $this->image_lib->display_errors();
                    
                } else {
                    $image = $this->image_lib->dest_image;
                    
                }
            }
            
			if($this->user_model->edit($id,$name,$email,$password,$accesslevel,$status,$phone,$fax,$gender,$mobile,$empno,$dept,$image)==0)
			$data['alerterror']="User Editing was unsuccesful";
			else
			$data['alertsuccess']="User edited Successfully.";
			
			$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			
		}
	}
	
	function deleteuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->deleteuser($this->input->get('id'));
//		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="User Deleted Successfully";
		$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
		$this->load->view("redirect",$data);
	}
	function changeuserstatus()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->changestatus($this->input->get('id'));
		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="Status Changed Successfully";
		$data['redirect']="site/viewusers";
        $data['other']="template=$template";
        $this->load->view("redirect",$data);
    }
    public function viewonlyContact()
{
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="viewonlycontact";
    $data["title"]="View Contact";
    $data["before"]=$this->contact_model->getcontactdetail($this->input->get("id"));
    $this->load->view("template",$data);
}
public function viewonlyuser()
{
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="viewonlyuser";
    $data["title"]="View Users";
    $data['before']=$this->user_model->viewonlyuser($this->input->get('id'));
    $this->load->view("template",$data);
}
    
public function viewcontact()
{
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="viewcontact";
    $data["base_url"]=site_url("site/viewcontactjson");
    $data["title"]="View contact";
    $this->load->view("template",$data);
}
function viewcontactjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`amsri_contact`.`contact_id`";
$elements[0]->sort="1";
$elements[0]->header="Sr no";
$elements[0]->alias="contact_id";
$elements[1]=new stdClass();
$elements[1]->field="`amsri_contact`.`name`";
$elements[1]->sort="1";
$elements[1]->header="Name";
$elements[1]->alias="name";
$elements[2]=new stdClass();
$elements[2]->field="`amsri_contact`.`designation`";
$elements[2]->sort="1";
$elements[2]->header="Designation";
$elements[2]->alias="designation";
$elements[3]=new stdClass();
$elements[3]->field="`amsri_contact`.`email`";
$elements[3]->sort="1";
$elements[3]->header="Email";
$elements[3]->alias="email";
$elements[4]=new stdClass();
$elements[4]->field="`amsri_contact`.`company`";
$elements[4]->sort="1";
$elements[4]->header="Company";
$elements[4]->alias="company";
$elements[5]=new stdClass();
$elements[5]->field="`amsri_contact`.`companyaddress`";
$elements[5]->sort="1";
$elements[5]->header="Company Address";
$elements[5]->alias="companyaddress";
$elements[6]=new stdClass();
$elements[6]->field="`amsri_contact`.`mobile`";
$elements[6]->sort="1";
$elements[6]->header="Mobile";
$elements[6]->alias="mobile";
$elements[7]=new stdClass();
$elements[7]->field="`amsri_contact`.`landline`";
$elements[7]->sort="1";
$elements[7]->header="Landline";
$elements[7]->alias="landline";
$elements[8]=new stdClass();
$elements[8]->field="`amsri_contact`.`companywebsite`";
$elements[8]->sort="1";
$elements[8]->header="Company Website";
$elements[8]->alias="companywebsite";
$elements[9]=new stdClass();
$elements[9]->field="`amsri_contact`.`dob`";
$elements[9]->sort="1";
$elements[9]->header="DOB";
$elements[9]->alias="dob";
$elements[10]=new stdClass();
$elements[10]->field="`amsri_contact`.`doj`";
$elements[10]->sort="1";
$elements[10]->header="DOJ";
$elements[10]->alias="doj";
$elements[11]=new stdClass();
$elements[11]->field="`amsri_contact`.`dom`";
$elements[11]->sort="1";
$elements[11]->header="DOM";
$elements[11]->alias="dom";
$elements[12]=new stdClass();
$elements[12]->field="`amsri_contact`.`fax`";
$elements[12]->sort="1";
$elements[12]->header="fax";
$elements[12]->alias="fax";
$elements[13]=new stdClass();
$elements[13]->field="`amsri_contact`.`noofemp`";
$elements[13]->sort="1";
$elements[13]->header="Number of Employee in Company";
$elements[13]->alias="noofemp";
$elements[14]=new stdClass();
$elements[14]->field="`amsri_contact`.`companysector`";
$elements[14]->sort="1";
$elements[14]->header="Company Sector";
$elements[14]->alias="companysector";
$elements[15]=new stdClass();
$elements[15]->field="`amsri_leadtype`.`name`";
$elements[15]->sort="1";
$elements[15]->header="Lead Type";
$elements[15]->alias="leadtype";
$elements[16]=new stdClass();
$elements[16]->field="`amsri_contact`.`passportcopy`";
$elements[16]->sort="1";
$elements[16]->header="Passport Copy";
$elements[16]->alias="passportcopy";
$elements[17]=new stdClass();
$elements[17]->field="`amsri_contact`.`visacopy`";
$elements[17]->sort="1";
$elements[17]->header="Visa Copy";
$elements[17]->alias="visacopy";
$elements[18]=new stdClass();
$elements[18]->field="`amsri_contact`.`eidcopy`";
$elements[18]->sort="1";
$elements[18]->header="Emirates id Copy";
$elements[18]->alias="eidcopy";
$elements[19]=new stdClass();
$elements[19]->field="`amsri_contact`.`noofprojects`";
$elements[19]->sort="1";
$elements[19]->header="Number of Projects";
$elements[19]->alias="noofprojects";
$elements[20]=new stdClass();
$elements[20]->field="`amsri_contact`.`nationality`";
$elements[20]->sort="1";
$elements[20]->header="Nationality";
$elements[20]->alias="nationality";
$elements[21]=new stdClass();
$elements[21]->field="`amsri_contact`.`passportexpirydate`";
$elements[21]->sort="1";
$elements[21]->header="Passport expiry date";
$elements[21]->alias="passportexpirydate";
$elements[22]=new stdClass();
$elements[22]->field="`amsri_contact`.`visaexpirydate`";
$elements[22]->sort="1";
$elements[22]->header="Visa expiry date";
$elements[22]->alias="visaexpirydate";
$elements[23]=new stdClass();
$elements[23]->field="`amsri_contact`.`description`";
$elements[23]->sort="1";
$elements[23]->header="Description";
$elements[23]->alias="description";
$elements[24]=new stdClass();
$elements[24]->field="`amsri_group`.`name`";
$elements[24]->sort="1";
$elements[24]->header="Group";
$elements[24]->alias="group";
$elements[25]=new stdClass();
$elements[25]->field="`amsri_contact`.`source`";
$elements[25]->sort="1";
$elements[25]->header="Source";
$elements[25]->alias="source";
$elements[26]=new stdClass();
$elements[26]->field="`amsri_contact`.`enquirytype`";
$elements[26]->sort="1";
$elements[26]->header="Enquiry type";
$elements[26]->alias="enquirytype";
$elements[27]=new stdClass();
$elements[27]->field="`amsri_contact`.`gender`";
$elements[27]->sort="1";
$elements[27]->header="Gender";
$elements[27]->alias="gender";
$elements[28]=new stdClass();
$elements[28]->field="`amsri_contact`.`sendsms`";
$elements[28]->sort="1";
$elements[28]->header="Send Sms";
$elements[28]->alias="sendsms";
$elements[29]=new stdClass();
$elements[29]->field="`amsri_contact`.`sendemail`";
$elements[29]->sort="1";
$elements[29]->header="Send Email";
$elements[29]->alias="sendemail";
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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `amsri_contact` LEFT JOIN `amsri_group` ON `amsri_group`.`id`=`amsri_contact`.`group` LEFT JOIN `amsri_leadtype` ON `amsri_leadtype`.`id`=`amsri_contact`.`leadtype`");
$this->load->view("json",$data);
}
public function createinvoice()
{
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="createinvoice";
    $data["title"]="Create invoice";
    $data["before"]=$this->transaction_model->gettransactiondetail($this->input->get("id"));
    $data["invoices"]=$this->transaction_model->getinvoices($this->input->get("id"));
    // print_r($data["invoices"]);
    $this->load->view("template",$data);
}

public function createinvoicesubmit(){
    $access=array("1");
    $this->checkaccess($access);
    $id = $this->input->get('id');
    $this->load->library('upload');
    $dataInfo = array();
    $files = $_FILES;
    
    $cpt = count($_FILES['userfile']['name']);
    for($i=0; $i<$cpt; $i++)
    {           
        $_FILES['userfile']['name']= $files['userfile']['name'][$i];
        $_FILES['userfile']['type']= $files['userfile']['type'][$i];
        $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
        $_FILES['userfile']['error']= $files['userfile']['error'][$i];
        $_FILES['userfile']['size']= $files['userfile']['size'][$i];    

        $this->upload->initialize($this->set_upload_options());
        $this->upload->do_upload();
        $dataInfo[] = $this->upload->data();
    }
    $result_set = $this->transaction_model->invoicesubmit($dataInfo,$id);
    if($result_set)
    $data["alerterror"]="New invoices could not be created.";
    else
    $data["alertsuccess"]="Invoices created Successfully.";
    $data["redirect"]="site/viewtransaction";
    $this->load->view("redirect",$data);
}

private function set_upload_options()
{   
    //upload an image options
    $config = array();
    $config['upload_path'] = './uploads/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    return $config;
}

public function createcontact()
{
$access=array("1");
$this->checkaccess($access);
$data['group']=$this->user_model->getgroupdropdown();
$data['leadtype']=$this->user_model->getleadtypedropdown();
$data['gender']=$this->user_model->getgenderdropdown();
$data["page"]="createcontact";
$data["title"]="Create contact";
$this->load->view("template",$data);
}
public function createcontactsubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("contact_id","contact_id","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("designation","Designation","trim");
$this->form_validation->set_rules("email","Email","trim");
$this->form_validation->set_rules("company","Company","trim");
$this->form_validation->set_rules("companyaddress","Company Address","trim");
$this->form_validation->set_rules("mobile","Mobile","trim");
$this->form_validation->set_rules("landline","Landline","trim");
$this->form_validation->set_rules("companywebsite","Company Website","trim");
$this->form_validation->set_rules("dob","DOB","trim");
$this->form_validation->set_rules("doj","DOJ","trim");
$this->form_validation->set_rules("dom","DOM","trim");
$this->form_validation->set_rules("fax","fax","trim");
$this->form_validation->set_rules("noofemp","Number of Employee in Company","trim");
$this->form_validation->set_rules("companysector","Company Sector","trim");
$this->form_validation->set_rules("leadtype","Lead Type","trim");
$this->form_validation->set_rules("passportcopy","Passport Copy","trim");
$this->form_validation->set_rules("visacopy","Visa Copy","trim");
$this->form_validation->set_rules("eidcopy","Emirates id Copy","trim");
$this->form_validation->set_rules("noofprojects","Number of Projects","trim");
$this->form_validation->set_rules("nationality","Nationality","trim");
$this->form_validation->set_rules("passportexpirydate","Passport expiry date","trim");
$this->form_validation->set_rules("visaexpirydate","Visa expiry date","trim");
$this->form_validation->set_rules("description","Description","trim");
$this->form_validation->set_rules("group","Group","trim");
$this->form_validation->set_rules("source","Source","trim");
$this->form_validation->set_rules("enquirytype","Enquiry type","trim");
$this->form_validation->set_rules("gender","Gender","trim");
$this->form_validation->set_rules("sendsms","Send Sms","trim");
$this->form_validation->set_rules("sendemail","Send Email","trim");
$this->form_validation->set_rules("timestamp","timestamp","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createcontact";
$data["title"]="Create contact";
$this->load->view("template",$data);
}
else
{
$contact_id=$this->input->get_post("contact_id");
$name=$this->input->get_post("name");
$designation=$this->input->get_post("designation");
$email=$this->input->get_post("email");
$company=$this->input->get_post("company");
$companyaddress=$this->input->get_post("companyaddress");
$mobile=$this->input->get_post("mobile");
$landline=$this->input->get_post("landline");
$companywebsite=$this->input->get_post("companywebsite");
$dob=$this->input->get_post("dob");
$doj=$this->input->get_post("doj");
$dom=$this->input->get_post("dom");
$fax=$this->input->get_post("fax");
$noofemp=$this->input->get_post("noofemp");
$companysector=$this->input->get_post("companysector");
$leadtype=$this->input->get_post("leadtype");
$noofprojects=$this->input->get_post("noofprojects");
$nationality=$this->input->get_post("nationality");
$passportexpirydate=$this->input->get_post("passportexpirydate");
$visaexpirydate=$this->input->get_post("visaexpirydate");
$description=$this->input->get_post("description");
$group=$this->input->get_post("group");
$source=$this->input->get_post("source");
$enquirytype=$this->input->get_post("enquirytype");
$gender=$this->input->get_post("gender");
$sendsms=$this->input->get_post("sendsms");
$sendemail=$this->input->get_post("sendemail");

$spousename=$this->input->get_post("spousename");
$spousenumber=$this->input->get_post("spousenumber");
$spouseemail=$this->input->get_post("spouseemail");
$spousebirthday=$this->input->get_post("spousebirthday");
$spousepassportnumber=$this->input->get_post("spousepassportnumber");
$spousepassportexpirydate=$this->input->get_post("spousepassportexpirydate");
$spouseeidno=$this->input->get_post("spouseeidno");
$child1=$this->input->get_post("child1");
$child2=$this->input->get_post("child2");
$child3=$this->input->get_post("child3");

$config['upload_path'] = './uploads/';
$config['allowed_types'] = 'gif|jpg|png|jpeg';
$this->load->library('upload', $config);
            $filename = "passportcopy";
            $passportcopy = "";
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $passportcopy = $uploaddata['file_name'];
                $config_r['source_image'] = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE; ///add this
                $config_r['width'] = 800;
                $config_r['height'] = 800;
                $config_r['quality'] = 100;
                //end of configs
                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if (!$this->image_lib->resize()) {
                    echo "Failed." . $this->image_lib->display_errors();
                    
                } else {
                    $passportcopy = $this->image_lib->dest_image;
                    
                }
            }
            $filename = "visacopy";
            $visacopy = "";
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $visacopy = $uploaddata['file_name'];
                $config_r['source_image'] = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE; ///add this
                $config_r['width'] = 800;
                $config_r['height'] = 800;
                $config_r['quality'] = 100;
                //end of configs
                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if (!$this->image_lib->resize()) {
                    echo "Failed." . $this->image_lib->display_errors();
                    
                } else {
                    $visacopy = $this->image_lib->dest_image;
                    
                }
            }
            $filename = "eidcopy";
            $eidcopy = "";
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $eidcopy = $uploaddata['file_name'];
                $config_r['source_image'] = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE; ///add this
                $config_r['width'] = 800;
                $config_r['height'] = 800;
                $config_r['quality'] = 100;
                //end of configs
                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if (!$this->image_lib->resize()) {
                    echo "Failed." . $this->image_lib->display_errors();
                    
                } else {
                    $eidcopy = $this->image_lib->dest_image;
                    
                }
            }
          
if($this->contact_model->create($contact_id,$name,$designation,$email,$company,$companyaddress,$mobile,$landline,$companywebsite,$dob,$doj,$dom,$fax,$noofemp,$companysector,$leadtype,$passportcopy,$visacopy,$eidcopy,$noofprojects,$nationality,$passportexpirydate,$visaexpirydate,$description,$group,$source,$enquirytype,$gender,$sendsms,$sendemail,$timestamp,$spousename,$spousenumber,$spouseemail,$spousebirthday,$spousepassportnumber,$spousepassportexpirydate,$spouseeidno,$child1,$child2,$child3)==0)
$data["alerterror"]="New contact could not be created.";
else
$data["alertsuccess"]="contact created Successfully.";
$data["redirect"]="site/viewcontact";
$this->load->view("redirect",$data);
}
}
public function editcontact()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editcontact";
$data['group']=$this->user_model->getgroupdropdown();
$data['leadtype']=$this->user_model->getleadtypedropdown();
$data['gender']=$this->user_model->getgenderdropdown();
$data["title"]="Edit contact";
$data["before"]=$this->contact_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editcontactsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("contact_id","contact_id","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("designation","Designation","trim");
$this->form_validation->set_rules("email","Email","trim");
$this->form_validation->set_rules("company","Company","trim");
$this->form_validation->set_rules("companyaddress","Company Address","trim");
$this->form_validation->set_rules("mobile","Mobile","trim");
$this->form_validation->set_rules("landline","Landline","trim");
$this->form_validation->set_rules("companywebsite","Company Website","trim");
$this->form_validation->set_rules("dob","DOB","trim");
$this->form_validation->set_rules("doj","DOJ","trim");
$this->form_validation->set_rules("dom","DOM","trim");
$this->form_validation->set_rules("fax","fax","trim");
$this->form_validation->set_rules("noofemp","Number of Employee in Company","trim");
$this->form_validation->set_rules("companysector","Company Sector","trim");
$this->form_validation->set_rules("leadtype","Lead Type","trim");
$this->form_validation->set_rules("passportcopy","Passport Copy","trim");
$this->form_validation->set_rules("visacopy","Visa Copy","trim");
$this->form_validation->set_rules("eidcopy","Emirates id Copy","trim");
$this->form_validation->set_rules("noofprojects","Number of Projects","trim");
$this->form_validation->set_rules("nationality","Nationality","trim");
$this->form_validation->set_rules("passportexpirydate","Passport expiry date","trim");
$this->form_validation->set_rules("visaexpirydate","Visa expiry date","trim");
$this->form_validation->set_rules("description","Description","trim");
$this->form_validation->set_rules("group","Group","trim");
$this->form_validation->set_rules("source","Source","trim");
$this->form_validation->set_rules("enquirytype","Enquiry type","trim");
$this->form_validation->set_rules("gender","Gender","trim");
$this->form_validation->set_rules("sendsms","Send Sms","trim");
$this->form_validation->set_rules("sendemail","Send Email","trim");
$this->form_validation->set_rules("timestamp","timestamp","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editcontact";
$data["title"]="Edit contact";
$data["before"]=$this->contact_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$contact_id=$this->input->get_post("contact_id");
$name=$this->input->get_post("name");
$designation=$this->input->get_post("designation");
$email=$this->input->get_post("email");
$company=$this->input->get_post("company");
$companyaddress=$this->input->get_post("companyaddress");
$mobile=$this->input->get_post("mobile");
$landline=$this->input->get_post("landline");
$companywebsite=$this->input->get_post("companywebsite");
$dob=$this->input->get_post("dob");
$doj=$this->input->get_post("doj");
$dom=$this->input->get_post("dom");
$fax=$this->input->get_post("fax");
$noofemp=$this->input->get_post("noofemp");
$companysector=$this->input->get_post("companysector");
$leadtype=$this->input->get_post("leadtype");
$passportcopy=$this->input->get_post("passportcopy");
$visacopy=$this->input->get_post("visacopy");
$eidcopy=$this->input->get_post("eidcopy");
$noofprojects=$this->input->get_post("noofprojects");
$nationality=$this->input->get_post("nationality");
$passportexpirydate=$this->input->get_post("passportexpirydate");
$visaexpirydate=$this->input->get_post("visaexpirydate");
$description=$this->input->get_post("description");
$group=$this->input->get_post("group");
$source=$this->input->get_post("source");
$enquirytype=$this->input->get_post("enquirytype");
$gender=$this->input->get_post("gender");
$sendsms=$this->input->get_post("sendsms");
$sendemail=$this->input->get_post("sendemail");
$timestamp=$this->input->get_post("timestamp");
$spousename=$this->input->get_post("spousename");
$spousenumber=$this->input->get_post("spousenumber");
$spouseemail=$this->input->get_post("spouseemail");
$spousebirthday=$this->input->get_post("spousebirthday");
$spousepassportnumber=$this->input->get_post("spousepassportnumber");
$spousepassportexpirydate=$this->input->get_post("spousepassportexpirydate");
$spouseeidno=$this->input->get_post("spouseeidno");
$child1=$this->input->get_post("child1");
$child2=$this->input->get_post("child2");
$child3=$this->input->get_post("child3");

$config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $filename = "passportcopy";
            $passportcopy = "";
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $passportcopy = $uploaddata['file_name'];
                $config_r['source_image'] = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE; ///add this
                $config_r['width'] = 800;
                $config_r['height'] = 800;
                $config_r['quality'] = 100;
                //end of configs
                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if (!$this->image_lib->resize()) {
                    echo "Failed." . $this->image_lib->display_errors();
                } else {
                    $passportcopy = $this->image_lib->dest_image;
                }
            } 
            // $config['upload_path'] = './uploads/';
            // $config['allowed_types'] = 'gif|jpg|png|jpeg';
            // $this->load->library('upload', $config);
            $filename = "visacopy";
            $visacopy = "";
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $visacopy = $uploaddata['file_name'];
                $config_r['source_image'] = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE; ///add this
                $config_r['width'] = 800;
                $config_r['height'] = 800;
                $config_r['quality'] = 100;
                //end of configs
                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if (!$this->image_lib->resize()) {
                    echo "Failed." . $this->image_lib->display_errors();
                    
                } else {
                    $visacopy = $this->image_lib->dest_image;
                    
                }
            }      
            $filename = "eidcopy";
            $eidcopy = "";
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $eidcopy = $uploaddata['file_name'];
                $config_r['source_image'] = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE; ///add this
                $config_r['width'] = 800;
                $config_r['height'] = 800;
                $config_r['quality'] = 100;
                //end of configs
                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if (!$this->image_lib->resize()) {
                    echo "Failed." . $this->image_lib->display_errors();
                    
                } else {
                    $eidcopy = $this->image_lib->dest_image;
                    
                }
            }  
// print_r($_POST);
// die();
            if($this->contact_model->edit($contact_id,$name,$designation,$email,$company,$companyaddress,$mobile,$landline,$companywebsite,$dob,$doj,$dom,$fax,$noofemp,$companysector,$leadtype,$passportcopy,$visacopy,$eidcopy,$noofprojects,$nationality,$passportexpirydate,$visaexpirydate,$description,$group,$source,$enquirytype,$gender,$sendsms,$sendemail,$timestamp,$spousename,$spousenumber,$spouseemail,$spousebirthday,$spousepassportnumber,$spousepassportexpirydate,$spouseeidno,$child1,$child2,$child3)==0)
$data["alerterror"]="New contact could not be Updated.";
else
$data["alertsuccess"]="contact Updated Successfully.";
$data["redirect"]="site/viewcontact";
// die();
$this->load->view("redirect",$data);
}
}

public function deleteinvoices()
{
$access=array("1");
$this->checkaccess($access);
$response = $this->transaction_model->deleteinvoices($this->input->get("id"));
if(!$response){
    $result['status'] = 'error';
    $result['message'] = 'Whoops! Incorrect Email & Password. Please try again';
} else {
    $result['status'] = 'success';
    $result['message'] = 'Yeah! You have successfully logged in.';
    $result['redirect_url'] = base_url();
}
$this->output->set_content_type('application/json');
$this->output->set_output(json_encode($result));
$string = $this->output->get_output();
    echo $string;
    exit();
// $data["redirect"]="site/vieweventimages";
// $this->load->view("redirect",$data);
}
public function deletecontact()
{
$access=array("1");
$this->checkaccess($access);
$this->contact_model->delete($this->input->get("id"));
$data["redirect"]="site/viewcontact";
$this->load->view("redirect",$data);
}
public function viewOnlyClient()
{
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="viewonlyclient";
    $data["title"]="View Client";
    $data["before"]=$this->client_model->getsingleclientdetails($this->input->get("id"));
    $this->load->view("template",$data);
}
public function viewclient()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewclient";
$data["base_url"]=site_url("site/viewclientjson");
$data["title"]="View client";
$this->load->view("template",$data);
}
function viewclientjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`amsri_client`.`client_id`";
$elements[0]->sort="1";
$elements[0]->header="Client id";
$elements[0]->alias="client_id";
$elements[1]=new stdClass();
$elements[1]->field="`amsri_contact`.`name`";
$elements[1]->sort="1";
$elements[1]->header="Contact Name";
$elements[1]->alias="name";
$elements[2]=new stdClass();
$elements[2]->field="`amsri_client`.`projectname`";
$elements[2]->sort="1";
$elements[2]->header="Project Name";
$elements[2]->alias="projectname";
$elements[3]=new stdClass();
$elements[3]->field="`amsri_client`.`details`";
$elements[3]->sort="1";
$elements[3]->header="Details";
$elements[3]->alias="details";
$elements[4]=new stdClass();
$elements[4]->field="`amsri_client`.`description`";
$elements[4]->sort="1";
$elements[4]->header="Description";
$elements[4]->alias="description";
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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `amsri_client` LEFT JOIN `amsri_contact` ON `amsri_contact`.`contact_id`=`amsri_client`.`contact_id`");
$this->load->view("json",$data);
}

public function createclient()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createclient";
$data["title"]="Create client";
$data["contact_id"]=$this->contact_model->getdropdown();
$this->load->view("template",$data);
}
public function createclientsubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("client_id","Client id","trim");
$this->form_validation->set_rules("contact_id","Contact id","trim");
$this->form_validation->set_rules("projectname","Project Name","trim");
$this->form_validation->set_rules("details","Details","trim");
$this->form_validation->set_rules("description","Description","trim");
$this->form_validation->set_rules("timestamp","timestamp","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createclient";
$data["title"]="Create client";
$this->load->view("template",$data);
}
else
{
// $client_id=$this->input->get_post("client_id");
$contact_id=$this->input->get_post("contact_id");
$projectname=$this->input->get_post("projectname");
$details=$this->input->get_post("details");
$description=$this->input->get_post("description");
if($this->client_model->create($contact_id,$projectname,$details,$description,$timestamp)==0)
$data["alerterror"]="New client could not be created.";
else
$data["alertsuccess"]="client created Successfully.";
$data["redirect"]="site/viewclient";
$this->load->view("redirect",$data);
}
}
public function editclient()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editclient";
$data["title"]="Edit client";
$data["contact_id"]=$this->contact_model->getdropdown();
$data["before"]=$this->client_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editclientsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("client_id","Client id","trim");
$this->form_validation->set_rules("contact_id","Contact id","trim");
$this->form_validation->set_rules("projectname","Project Name","trim");
$this->form_validation->set_rules("details","Details","trim");
$this->form_validation->set_rules("description","Description","trim");
$this->form_validation->set_rules("timestamp","timestamp","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editclient";
$data["title"]="Edit client";
$data["before"]=$this->client_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("client_id");
$contact_id=$this->input->get_post("contact_id");
$projectname=$this->input->get_post("projectname");
$details=$this->input->get_post("details");
$description=$this->input->get_post("description");
$timestamp=$this->input->get_post("timestamp");

if($this->client_model->edit($id,$contact_id,$projectname,$details,$description,$timestamp)==0)
$data["alerterror"]="New client could not be Updated.";
else
$data["alertsuccess"]="client Updated Successfully.";
$data["redirect"]="site/viewclient";
$this->load->view("redirect",$data);
}
}
public function deleteclient()
{
$access=array("1");
$this->checkaccess($access);
$this->client_model->delete($this->input->get("id"));
$data["redirect"]="site/viewclient";
$this->load->view("redirect",$data);
}
public function viewonlyAssociated()
{
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="viewonlyassociated";
    $data["title"]="View Associated";
    $data["before"]=$this->associatedcontact_model->getassociatedcontactdetail($this->input->get("id"));
    $this->load->view("template",$data);
}
public function viewassociatedcontact()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewassociatedcontact";
$data["base_url"]=site_url("site/viewassociatedcontactjson");
$data["title"]="View associatedcontact";
$this->load->view("template",$data);
}
function viewassociatedcontactjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`amsri_associatedcontact`.`associatedcontact_id`";
$elements[0]->sort="1";
$elements[0]->header="Associated contact id";
$elements[0]->alias="associatedcontact_id";

$elements[1]=new stdClass();
$elements[1]->field="`amsri_contact`.`name`";
$elements[1]->sort="1";
$elements[1]->header="Contact Name";
$elements[1]->alias="name";

$elements[2]=new stdClass();
$elements[2]->field="`amsri_client`.`projectname`";
$elements[2]->sort="1";
$elements[2]->header="Project Name";
$elements[2]->alias="projectname";

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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `amsri_associatedcontact` LEFT JOIN `amsri_contact` ON `amsri_contact`.`contact_id`=`amsri_associatedcontact`.`contact_id` 
LEFT JOIN `amsri_client` ON `amsri_client`.`client_id`=`amsri_associatedcontact`.`client_id`");
$this->load->view("json",$data);
}

public function createassociatedcontact()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createassociatedcontact";
$data["title"]="Create associatedcontact";
$data["client_id"]=$this->client_model->getdropdown();
$data["contact_id"]=$this->contact_model->getdropdown();
$this->load->view("template",$data);
}
public function createassociatedcontactsubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("associatedcontact_id","Associated contact id","trim");
$this->form_validation->set_rules("contact_id","contact_id","trim");
$this->form_validation->set_rules("client_id","client_id","trim");
$this->form_validation->set_rules("timestamp","timestamp","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createassociatedcontact";
$data["title"]="Create associatedcontact";
$this->load->view("template",$data);
}
else
{
$associatedcontact_id=$this->input->get_post("associatedcontact_id");
$contact_id=$this->input->get_post("contact_id");
$client_id=$this->input->get_post("client_id");

if($this->associatedcontact_model->create($associatedcontact_id,$contact_id,$client_id,$timestamp)==0)
$data["alerterror"]="New associatedcontact could not be created.";
else
$data["alertsuccess"]="associatedcontact created Successfully.";
$data["redirect"]="site/viewassociatedcontact";
$this->load->view("redirect",$data);
}
}
public function editassociatedcontact()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editassociatedcontact";
$data["client_id"]=$this->client_model->getdropdown();
$data["contact_id"]=$this->contact_model->getdropdown();
$data["title"]="Edit associatedcontact";
$data["before"]=$this->associatedcontact_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editassociatedcontactsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("associatedcontact_id","Associated contact id","trim");
$this->form_validation->set_rules("contact_id","contact_id","trim");
$this->form_validation->set_rules("client_id","client_id","trim");
$this->form_validation->set_rules("timestamp","timestamp","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editassociatedcontact";
$data["title"]="Edit associatedcontact";
$data["before"]=$this->associatedcontact_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$associatedcontact_id=$this->input->get_post("associatedcontact_id");
$contact_id=$this->input->get_post("contact_id");
$client_id=$this->input->get_post("client_id");
$timestamp=$this->input->get_post("timestamp");
if($this->associatedcontact_model->edit($associatedcontact_id,$contact_id,$client_id,$timestamp)==0)
$data["alerterror"]="New associatedcontact could not be Updated.";
else
$data["alertsuccess"]="associatedcontact Updated Successfully.";
$data["redirect"]="site/viewassociatedcontact";
$this->load->view("redirect",$data);
}
}
public function deleteassociatedcontact()
{
$access=array("1");
$this->checkaccess($access);
$this->associatedcontact_model->delete($this->input->get("id"));
$data["redirect"]="site/viewassociatedcontact";
$this->load->view("redirect",$data);
}
public function viewonlyjobclosure()
{
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="viewonlyjobclosure";
    $data["title"]="View transaction";
    $data[ 'status' ] =$this->user_model->getstatusdropdown();
    $data[ 'jobnumber' ] =$this->transaction_model->getjobnumberdropdown();
    $data["client_id"]=$this->client_model->getdropdown();
    $data["personalloted"]=$this->transaction_model->getamsristaffdropdown();
    $data["before"]=$this->transaction_model->gettransactiondetail($this->input->get("id"));
    $this->load->view("template",$data);
}
public function viewjobclosure()
{
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="viewjobclosure";
    $data["base_url"]=site_url("site/viewtransactionjson");
    
    $data["title"]="View transaction";
    $this->load->view("template",$data);
}
public function viewonlytransaction()
{
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="viewonlytransaction";
    $data["title"]="View transaction";
    $data[ 'status' ] =$this->user_model->getstatusdropdown();
    $data["client_id"]=$this->client_model->getdropdown();
    $data["personalloted"]=$this->transaction_model->getamsristaffdropdown();
    $data["before"]=$this->transaction_model->gettransactiondetail($this->input->get("id"));
    $this->load->view("template",$data);
}
public function createperiodicjobs()
{
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="createperiodicjobs";
    $data["title"]="View transaction";
    $data[ 'status' ] =$this->user_model->getpaymentstatusdropdown();
    $data["client_id"]=$this->client_model->getdropdown();
    $data["personalloted"]=$this->transaction_model->getamsristaffdropdown();
    $data["child"]=$this->transaction_model->getchildtransactions($this->input->get("id"));
    $data["before"]=$this->transaction_model->getperiodicbefore($this->input->get("id"));
    $this->load->view("onlytemplate",$data);
}
public function getsingleperiodicjobs()
{
    $id=$this->input->get_post("id");
    $data["before"]=$this->transaction_model->getperiodicbefore($id);
    $jsonData = json_encode($data["before"]);
    echo $jsonData;
}
public function submitSubJobDetails()
{
    $id=$this->input->get_post("id");
    $created_date=$this->input->get_post("created_date");
    $due_date=$this->input->get_post("due_date");
    $amount=$this->input->get_post("amount");
    $balance=$this->input->get_post("balance");
    $description=$this->input->get_post("description");
    $data["jobdata"]=$this->transaction_model->submitSubJobDetails($id,$created_date,$due_date,$amount,$balance,$description);
    echo $data["jobdata"];
    // $jsonData = json_encode($data["before"]);
    // echo $jsonData;
}
public function editperiodicjobs()
{
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="editperiodicjobs";
    $data["title"]="View transaction";
    $data["client_id"]=$this->client_model->getdropdown();
    $data["personalloted"]=$this->transaction_model->getamsristaffdropdown();
    $data["dept"]=$this->user_model->getdeptdropdown();
    $data[ 'status' ] =$this->user_model->getstatusdropdown();
    $data[ 'typeofjob' ] =$this->user_model->gettypeofjobdropdown();
    $data[ 'periodicity' ] =$this->user_model->getperiodicitydropdown();
    $data["before"]=$this->transaction_model->beforeedit($this->input->get("id"));
    $this->load->view("template",$data);
}
public function changeperiodicstatus()
{
    $ids = $this->input->get_post("ids");
    $getbuttonvalue = $this->input->get_post("getbuttonvalue");
    $periodicstatus=$this->transaction_model->changeperiodicstatus($ids,$getbuttonvalue);
    echo $periodicstatus;
    
}
public function deleteSelected()
{
    $ids = $this->input->get_post("ids");
    $deleteStatus=$this->transaction_model->deleteSelected($ids);
    echo $deleteStatus;
}
public function viewtransaction()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewtransaction";
$data["base_url"]=site_url("site/viewtransactionjson");
$data["title"]="View transaction";
$this->load->view("template",$data);
}
function viewtransactionjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="CONCAT('AM',LPAD(`amsri_transaction`.`id`,5,0))";
$elements[0]->sort="1";
$elements[0]->header="Jobs";
$elements[0]->alias="jobnumber";

$elements[1]=new stdClass();
$elements[1]->field="`amsri_client`.`projectname`";
$elements[1]->sort="1";
$elements[1]->header="Client";
$elements[1]->alias="client_id";

$elements[2]=new stdClass();
$elements[2]->field="`amsri_transaction`.`created_date`";
$elements[2]->sort="1";
$elements[2]->header="Start Date";
$elements[2]->alias="created_date";

$elements[3]=new stdClass();
$elements[3]->field="`user`.`name`";
$elements[3]->sort="1";
$elements[3]->header="Assigned to";
$elements[3]->alias="personalloted";

$elements[4]=new stdClass();
$elements[4]->field="`amsri_transaction`.`due_date`";
$elements[4]->sort="1";
$elements[4]->header="Due Date";
$elements[4]->alias="due_date";

$elements[5]=new stdClass();
$elements[5]->field="`amsri_transaction`.`valueofwork`";
$elements[5]->sort="1";
$elements[5]->header="Value of Work";
$elements[5]->alias="valueofwork";

$elements[6]=new stdClass();
$elements[6]->field="`amsri_transaction`.`amount`";
$elements[6]->sort="1";
$elements[6]->header="Amt";
$elements[6]->alias="amount";

$elements[7]=new stdClass();
$elements[7]->field="`amsri_transaction`.`id`";
$elements[7]->sort="1";
$elements[7]->header="ID";
$elements[7]->alias="id";

$elements[8]=new stdClass();
$elements[8]->field="`amsri_transaction`.`typeofjob`";
$elements[8]->sort="1";
$elements[8]->header="typeofjob";
$elements[8]->alias="typeofjob";

$elements[9]=new stdClass();
$elements[9]->field="`amsri_transaction`.`status`";
$elements[9]->sort="1";
$elements[9]->header="Status";
$elements[9]->alias="status";

$elements[10]=new stdClass();
$elements[10]->field="`amsri_transaction`.`balance`";
$elements[10]->sort="1";
$elements[10]->header="Balance";
$elements[10]->alias="balance";


$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `amsri_transaction` LEFT JOIN `amsri_client` ON `amsri_client`.`client_id`=`amsri_transaction`.`client_id` LEFT JOIN `user` ON `user`.`id`=`amsri_transaction`.`personalloted`","WHERE `parent` IS NULL OR `parent` =0");
$this->load->view("json",$data);
}

public function createtransaction()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createtransaction";
$data["title"]="Create transaction";
$data["client_id"]=$this->client_model->getdropdown();
$data["personalloted"]=$this->transaction_model->getamsristaffdropdown();
$data["dept"]=$this->user_model->getdeptdropdown();
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data[ 'typeofjob' ] =$this->user_model->gettypeofjobdropdown();
$data[ 'periodicity' ] =$this->user_model->getperiodicitydropdown();
$this->load->view("template",$data);
}
public function createtransactionsubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("client_id","Client Name","trim|required");
$this->form_validation->set_rules("dept","Department","trim|required");
$this->form_validation->set_rules("personalloted","Assigned to","trim|required");
$this->form_validation->set_rules("typeofjob","Type of Job","trim|required");
$this->form_validation->set_rules("fees","Fees","trim|required");
$this->form_validation->set_rules("claims","Claims","trim|required");
$this->form_validation->set_rules("vat","Vat","trim|required");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createtransaction";
$data["title"]="Create transaction";
$data["client_id"]=$this->client_model->getdropdown();
$data["personalloted"]=$this->transaction_model->getamsristaffdropdown();
$data["dept"]=$this->user_model->getdeptdropdown();
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data[ 'typeofjob' ] =$this->user_model->gettypeofjobdropdown();
$data[ 'periodicity' ] =$this->user_model->getperiodicitydropdown();
$this->load->view("template",$data);
}
else
{
    $client_id=$this->input->get_post("client_id");
    $created_date=$this->input->get_post("created_date");
    $due_date=$this->input->get_post("due_date");
    $dept=$this->input->get_post("dept");
    $personalloted=$this->input->get_post("personalloted");
    $source=$this->input->get_post("source");
    $valueofwork=$this->input->get_post("valueofwork");
    $invoicenumber=$this->input->get_post("invoicenumber");
    $fees=$this->input->get_post("fees");
    $claims=$this->input->get_post("claims");
    $vat=$this->input->get_post("vat");
    $amount=$this->input->get_post("amount");
    $balance=$this->input->get_post("balance");
    $typeofjob=$this->input->get_post("typeofjob");
    $periodicity=$this->input->get_post("periodicity");
    $typeofwork=$this->input->get_post("typeofwork");
    $periodofassignment=$this->input->get_post("periodofassignment");
    $description=$this->input->get_post("description");

    $config['upload_path'] = './uploads/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $this->load->library('upload', $config);
            $filename = "invoice";
            $invoice = "";
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $invoice = $uploaddata['file_name'];
                $config_r['source_image'] = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE; ///add this
                $config_r['width'] = 800;
                $config_r['height'] = 800;
                $config_r['quality'] = 100;
                //end of configs
                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if (!$this->image_lib->resize()) {
                    echo "Failed." . $this->image_lib->display_errors();
                    
                } else {
                    $invoice = $this->image_lib->dest_image;
                    
                }
            }
if($this->transaction_model->create($client_id,$created_date,$due_date,$dept,$personalloted,$source,$valueofwork,$invoicenumber,$fees,$claims,$vat,$amount,$balance,$typeofjob,$periodicity,$typeofwork,$periodofassignment,$description)==0)
$data["alerterror"]="New transaction could not be created.";
else
$data["alertsuccess"]="transaction created Successfully.";
$data["redirect"]="site/viewtransaction";
$this->load->view("redirect",$data);
}
}
public function edittransaction()
{
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="edittransaction";
    $data["title"]="Edit transaction";
    $data["flag"]=false;
    if($this->input->get('flag') && $this->input->get('flag') !='') {
        $data["flag"]=true;
    }
    $data[ 'status' ] =$this->user_model->getstatusdropdown();
    $data["dept"]=$this->user_model->getdeptdropdown();
    $data["client_id"]=$this->client_model->getdropdown();
    $data["personalloted"]=$this->transaction_model->getamsristaffdropdown();
    $data[ 'typeofjob' ] =$this->user_model->gettypeofjobdropdown();
    $data[ 'periodicity' ] =$this->user_model->getperiodicitydropdown();
    $data["before"]=$this->transaction_model->beforeedit($this->input->get("id"));
    $this->load->view("template",$data);
}
public function editjobclosure()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editjobclosure";
$data["title"]="Edit Job Closure";
$data[ 'status' ] =$this->user_model->getjobclosuredropdown();
$data["client_id"]=$this->client_model->getdropdown();
$data["personalloted"]=$this->transaction_model->getamsristaffdropdown();
$data["before"]=$this->transaction_model->beforeedit($this->input->get("id"));

$this->load->view("template",$data);
}
public function edittransactionsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("client_id","Client Name","trim|required");
$this->form_validation->set_rules("dept","Department","trim|required");
$this->form_validation->set_rules("personalloted","Assigned to","trim|required");
$this->form_validation->set_rules("typeofjob","Type of Job","trim|required");
$this->form_validation->set_rules("fees","Fees","trim|required");
$this->form_validation->set_rules("claims","Claims","trim|required");
$this->form_validation->set_rules("vat","Vat","trim|required");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="edittransaction";
$data["title"]="Edit transaction";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["dept"]=$this->user_model->getdeptdropdown();
$data["client_id"]=$this->client_model->getdropdown();
$data["personalloted"]=$this->transaction_model->getamsristaffdropdown();
$data[ 'typeofjob' ] =$this->user_model->gettypeofjobdropdown();
$data[ 'periodicity' ] =$this->user_model->getperiodicitydropdown();
$data["before"]=$this->transaction_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
    // print_r($_POST);
    // die();
    $flag=false;
    if($this->input->get('flag') && $this->input->get('flag') !='') {
        $flag=true;
    }
    $id=$this->input->get_post("id");
    $parent=$this->input->get_post("parent");
    $client_id=$this->input->get_post("client_id");
    $created_date=$this->input->get_post("created_date");
    $due_date=$this->input->get_post("due_date");
    $dept=$this->input->get_post("dept");
    $personalloted=$this->input->get_post("personalloted");
    $source=$this->input->get_post("source");
    $valueofwork=$this->input->get_post("valueofwork");
    $invoicenumber=$this->input->get_post("invoicenumber");
    $fees=$this->input->get_post("fees");
    $claims=$this->input->get_post("claims");
    $vat=$this->input->get_post("vat");
    $amount=$this->input->get_post("amount");
    $balance=$this->input->get_post("balance");
    $typeofjob=$this->input->get_post("typeofjob");
    $periodicity=$this->input->get_post("periodicity");
    $typeofwork=$this->input->get_post("typeofwork");
    $periodofassignment=$this->input->get_post("periodofassignment");
    $description=$this->input->get_post("description");
    $config['upload_path'] = './uploads/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $this->load->library('upload', $config);
            $filename = "invoice";
            $invoice = "";
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $invoice = $uploaddata['file_name'];
                $config_r['source_image'] = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE; ///add this
                $config_r['width'] = 800;
                $config_r['height'] = 800;
                $config_r['quality'] = 100;
                //end of configs
                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if (!$this->image_lib->resize()) {
                    echo "Failed." . $this->image_lib->display_errors();
                    
                } else {
                    $invoice = $this->image_lib->dest_image;
                    
                }
            }
if($this->transaction_model->edit($id,$client_id,$created_date,$due_date,$dept,$personalloted,$source,$valueofwork,$invoicenumber,$fees,$claims,$vat,$amount,$balance,$typeofjob,$periodicity,$typeofwork,$periodofassignment,$description,$parent)==0)
$data["alerterror"]="New transaction could not be Updated.";
// else
// $data["alertsuccess"]="transaction Updated Successfully.";
    if($parent){
        $redirectid = $parent;
    } else{
        $redirectid = $id;
    }
    if($flag) {
        $data["redirect"]="site/createperiodicjobs?id=".$redirectid;
        $this->load->view("redirect2",$data);
    } else {
        $data["redirect"]="site/viewtransaction";
        $this->load->view("redirect",$data);
    }
    }
}
public function deletetransaction()
{
    $access=array("1");
    $this->checkaccess($access);
    $this->transaction_model->delete($this->input->get("id"));
    if($this->input->get("flag") && $this->input->get("flag") !='') {
        $data["redirect"]="site/createperiodicjobs?id=".$this->input->get("flag");
        $this->load->view("redirect2",$data);
    } else{
        $data["redirect"]="site/viewtransaction";
        $this->load->view("redirect",$data);    
    }
}
public function viewonlylead()
{
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="viewonlyleads";
    $data["title"]="View Leads";
    $data["before"]=$this->leads_model->getleadsdetail($this->input->get("id"));
    $this->load->view("template",$data);
}
public function viewleads()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewleads";
$data["base_url"]=site_url("site/viewleadsjson");
$data["title"]="View leads";
$this->load->view("template",$data);
}
function viewleadsjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`amsri_leads`.`id`";
$elements[0]->sort="1";
$elements[0]->header="id";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`amsri_contact`.`name`";
$elements[1]->sort="1";
$elements[1]->header="Contact Name";
$elements[1]->alias="contact_id";
$elements[2]=new stdClass();
$elements[2]->field="`amsri_leads`.`leadtype`";
$elements[2]->sort="1";
$elements[2]->header="Lead type";
$elements[2]->alias="leadtype";
$elements[3]=new stdClass();
$elements[3]->field="`amsri_leads`.`description`";
$elements[3]->sort="1";
$elements[3]->header="Description";
$elements[3]->alias="description";
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
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `amsri_leads` LEFT JOIN `amsri_contact` ON `amsri_contact`.`contact_id`=`amsri_leads`.`contact_id`");
$this->load->view("json",$data);
}

public function createleads()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createleads";
$data["title"]="Create leads";
$data['leadtype']=$this->user_model->getleadtypedropdown();
$data["contact_id"]=$this->contact_model->getdropdown();
$this->load->view("template",$data);
}
public function createleadssubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("lead_id","lead_id","trim");
$this->form_validation->set_rules("contact_id","contact_id","trim");
$this->form_validation->set_rules("leadtype","Lead type","trim");
$this->form_validation->set_rules("description","Description","trim");
$this->form_validation->set_rules("timestamp","timestamp","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createleads";
$data["title"]="Create leads";
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$contact_id=$this->input->get_post("contact_id");
$leadtype=$this->input->get_post("leadtype");
$description=$this->input->get_post("description");
if($this->leads_model->create($id,$contact_id,$leadtype,$description,$timestamp)==0)
$data["alerterror"]="New leads could not be created.";
else
$data["alertsuccess"]="leads created Successfully.";
$data["redirect"]="site/viewleads";
$this->load->view("redirect",$data);
}
}
public function editleads()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editleads";
$data['leadtype']=$this->user_model->getleadtypedropdown();
$data["contact_id"]=$this->contact_model->getdropdown();
$data["title"]="Edit leads";
$data["before"]=$this->leads_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editleadssubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","id","trim");
$this->form_validation->set_rules("contact_id","contact_id","trim");
$this->form_validation->set_rules("leadtype","Lead type","trim");
$this->form_validation->set_rules("description","Description","trim");
$this->form_validation->set_rules("timestamp","timestamp","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editleads";
$data["title"]="Edit leads";
$data["before"]=$this->leads_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$contact_id=$this->input->get_post("contact_id");
$leadtype=$this->input->get_post("leadtype");
$description=$this->input->get_post("description");
$timestamp=$this->input->get_post("timestamp");
if($this->leads_model->edit($id,$contact_id,$leadtype,$description,$timestamp)==0)
$data["alerterror"]="New leads could not be Updated.";
else
$data["alertsuccess"]="leads Updated Successfully.";
$data["redirect"]="site/viewleads";
$this->load->view("redirect",$data);
}
}
public function deleteleads()
{
$access=array("1");
$this->checkaccess($access);
$this->leads_model->delete($this->input->get("id"));
$data["redirect"]="site/viewleads";
$this->load->view("redirect",$data);
}

public function createinvoicelist()
{
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="createinvoicelist";
    $data["title"]="Create invoicelist";
    $this->load->view("onlytemplate",$data);
}

public function createinvoicelistsubmit()
{
    $access=array("1");
    $this->checkaccess($access);
    $config['upload_path'] = './uploads/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $this->load->library('upload', $config);
                $filename = "image";
                $image = "";
                if ($this->upload->do_upload($filename)) {
                    $uploaddata = $this->upload->data();
                    $image = $uploaddata['file_name'];
                    $config_r['source_image'] = './uploads/' . $uploaddata['file_name'];
                    $config_r['maintain_ratio'] = TRUE;
                    $config_t['create_thumb'] = FALSE; ///add this
                    $config_r['width'] = 800;
                    $config_r['height'] = 800;
                    $config_r['quality'] = 100;
                    //end of configs
                    $this->load->library('image_lib', $config_r);
                    $this->image_lib->initialize($config_r);
                    if (!$this->image_lib->resize()) {
                        echo "Failed." . $this->image_lib->display_errors();
                        
                    } else {
                        $image = $this->image_lib->dest_image;
                        
                    }
                }
                
    $data['addinvoice'] = $this->transaction_model->createinvoicelistsubmit($image);
    $data["redirect"]="site/viewinvoicelist";
    $this->load->view("redirect",$data);
    
}

public function viewinvoicelist()
{
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="viewinvoicelist";
    $data["title"]="View invoicelist";
    $data["invoicelist"]=$this->invoicelist_model->getinvoicelist();
    $this->load->view("template",$data);
}

public function redirectToInvoice()
{
    $access=array("1");
    $this->checkaccess($access);
    $data["page"]="createinvoicelist";
    $data["title"]="Create invoicelist";
    $jobnumid = $this->input->get_post('id');
    $data["jobnumberlist"]=$this->transaction_model->getselectedjobnumberlist($jobnumid);
    // print_r($data["jobnumberlist"]);
    $this->load->view("onlytemplate",$data);
}



}
?>
