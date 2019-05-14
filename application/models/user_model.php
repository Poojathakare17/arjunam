<?php
if ( !defined( 'BASEPATH' ) )
	exit( 'No direct script access allowed' );
class User_model extends CI_Model
{
	protected $id,$username ,$password;
	public function validate($username,$password )
	{
		
		$password=md5($password);
		$query ="SELECT `user`.`id`,`user`.`name` as `name`,`email`,`user`.`accesslevel`,`accesslevel`.`name` as `access` FROM `user`
		INNER JOIN `accesslevel` ON `user`.`accesslevel` = `accesslevel`.`id` 
		WHERE `email` LIKE '$username' AND `password` LIKE '$password' AND `status`=1 AND `accesslevel` IN (1,2) ";
		$row =$this->db->query( $query );
		if ( $row->num_rows() > 0 ) {
			$row=$row->row();
			$this->id       = $row->id;
			$this->name = $row->name;
			$this->email = $row->email;
			$newdata        = array(
				'id' => $this->id,
				'email' => $this->email,
				'name' => $this->name ,
				'accesslevel' => $row->accesslevel ,
				'logged_in' => 'true',
			);
			$this->session->set_userdata( $newdata );
			return true;
		} //count( $row_array ) == 1
		else
			return false;
	}
	
	
	public function create($name,$email,$password,$accesslevel,$status,$phone,$fax,$gender,$mobile,$empno,$dept,$image)
	{
		$data  = array(
			'name' => $name,
			'email' => $email,
			'password' =>md5($password),
			'accesslevel' => $accesslevel,
			'status' => $status,
            'image'=> $image,
			'phone' => $phone,
			'fax' => $fax,
			'gender' => $gender,
			'mobile' => $mobile,
			'dept' => $dept,
			'empno' => $empno
		);
		$query=$this->db->insert( 'user', $data );
		$id=$this->db->insert_id();
        
		if(!$query)
			return  0;
		else
			return  1;
	}
    
	function viewusers($startfrom,$totallength)
	{
		$user = $this->session->userdata('accesslevel');
		$query="SELECT DISTINCT `user`.`id` as `id`,`user`.`firstname` as `firstname`,`user`.`lastname` as `lastname`,`accesslevel`.`name` as `accesslevel`	,`user`.`email` as `email`,`user`.`contact` as `contact`,`user`.`status` as `status`,`user`.`accesslevel` as `access`
		FROM `user`
	   INNER JOIN `accesslevel` ON `user`.`accesslevel`=`accesslevel`.`id`  ";
	   $accesslevel=$this->session->userdata('accesslevel');
	   if($accesslevel==1)
		{
			$query .= " ";
		}
		else if($accesslevel==2)
		{
			$query .= " WHERE `user`.`accesslevel`> '$accesslevel' ";
		}
		
	   $query.=" ORDER BY `user`.`id` ASC LIMIT $startfrom,$totallength";
		$query=$this->db->query($query)->result();
        
        $return=new stdClass();
        $return->query=$query;
        $return->totalcount=$this->db->query("SELECT count(*) as `totalcount` FROM `user`
	   INNER JOIN `accesslevel` ON `user`.`accesslevel`=`accesslevel`.`id`  ")->row();
        $return->totalcount=$return->totalcount->totalcount;
		return $return;
	}
	public function beforeedit( $id )
	{
		$this->db->where( 'id', $id );
		$query=$this->db->get( 'user' )->row();
		return $query;
	}
	
	public function edit($id,$name,$email,$password,$accesslevel,$status,$phone,$fax,$gender,$mobile,$empno,$dept,$image)
	{

		if($image=="")
			{
			$image=$this->user_model->getuserimagebyid($id);
			$image=$image->image;
			}
		$data  = array(
			'name' => $name,
			'email' => $email,
			'password' =>md5($password),
			'accesslevel' => $accesslevel,
			'status' => $status,
            'image'=> $image,
			'phone' => $phone,
			'fax' => $fax,
			'gender' => $gender,
			'mobile' => $mobile,
			'dept' => $dept,
			'empno' => $empno
		);
		if($password != "")
			$data['password'] =md5($password);
		$this->db->where( 'id', $id );
		$query=$this->db->update( 'user', $data );
        
		return 1;
	}
    
	public function getuserimagebyid($id)
	{
		$query=$this->db->query("SELECT `image` FROM `user` WHERE `id`='$id'")->row();
		return $query;
	}
	function deleteuser($id)
	{
		$query=$this->db->query("DELETE FROM `user` WHERE `id`='$id'");
	}
	function changepassword($id,$password)
	{
		$data  = array(
			'password' =>md5($password),
		);
		$this->db->where('id',$id);
		$query=$this->db->update( 'user', $data );
		if(!$query)
			return  0;
		else
			return  1;
	}
    
    public function getuserdropdown()
	{
		$query=$this->db->query("SELECT * FROM `user`  ORDER BY `id` ASC")->result();
		$return=array(
		"" => ""
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
		
		return $return;
	}
    
	public function getaccesslevels()
	{
		$return=array();
		$query=$this->db->query("SELECT * FROM `accesslevel` ORDER BY `id` ASC")->result();
		$accesslevel=$this->session->userdata('accesslevel');
			foreach($query as $row)
			{
				if($accesslevel==1)
				{
					$return[$row->id]=$row->name;
				}
				else if($accesslevel==2)
				{
					if($row->id > $accesslevel)
					{
						$return[$row->id]=$row->name;
					}
				}
				else if($accesslevel==3)
				{
					if($row->id > $accesslevel)
					{
						$return[$row->id]=$row->name;
					}
				}
				else if($accesslevel==4)
				{
					if($row->id == $accesslevel)
					{
						$return[$row->id]=$row->name;
					}
				}
			}
	
		return $return;
	}
    public function getstatusdropdown()
	{
		$query=$this->db->query("SELECT * FROM `statuses`  ORDER BY `id` ASC")->result();
		$return=array(
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
		
		return $return;
	}
	public function getpaymentstatusdropdown()
	{
		$query=$this->db->query("SELECT * FROM `amsri_paymentstatus`  ORDER BY `id` ASC")->result();
		$return=array(
			"0"=>"Select Status"
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
		
		return $return;
	}
	public function getdeptdropdown()
	{
		$query=$this->db->query("SELECT * FROM `amsri_dept`  ORDER BY `id` ASC")->result();
		$return=array(
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
		
		return $return;
	}

	public function getjobclosuredropdown()
	{
		$status= array(
			"" => "Choose Status",
			"1" => "Yes",
			"2" => "No"
		   );
	   return $status;
	}

	public function gettypeofjobdropdown()
	{
		$status= array(
			"" => "Choose Type Of Job",
			"1" => "One Time",
			"2" => "Repeated"
		   );
	   return $status;
	}
	public function getperiodicitydropdown()
	{
		$status= array(
			"" => "Choose Periodicity",
			"1" => "1",
			"2" => "2",
			"3" => "3",
			"4" => "4",
			"5" => "5",
			"6" => "6",
			"7" => "7",
			"8" => "8",
			"9" => "9",
			"10" => "10",
			"11" => "11",
			"12" => "12"
		   );
	   return $status;
	}
    
	function changestatus($id)
	{
		$query=$this->db->query("SELECT `status` FROM `user` WHERE `id`='$id'")->row();
		$status=$query->status;
		if($status==1)
		{
			$status=0;
		}
		else if($status==0)
		{
			$status=1;
		}
		$data  = array(
			'status' =>$status,
		);
		$this->db->where('id',$id);
		$query=$this->db->update( 'user', $data );
		if(!$query)
			return  0;
		else
			return  1;
	}
	function editaddress($id,$address,$city,$pincode)
	{
		$data  = array(
			'address' => $address,
			'city' => $city,
			'pincode' => $pincode,
		);
		
		$this->db->where( 'id', $id );
		$query=$this->db->update( 'user', $data );
		if($query)
		{
			$this->saveuserlog($id,'User Address Edited');
		}
		return 1;
	}
	
	function saveuserlog($id,$status)
	{
		//		$fromuser = $this->session->userdata('id');
		$data2  = array(
			'onuser' => $id,
			'status' => $status
		);
		$query2=$this->db->insert( 'userlog', $data2 );
        $query=$this->db->query("UPDATE `user` SET `status`='$status' WHERE `id`='$user'");
	}
    function signup($email,$password) 
    {
         $password=md5($password);   
        $query=$this->db->query("SELECT `id` FROM `user` WHERE `email`='$email' ");
        if($query->num_rows == 0)
        {
            $this->db->query("INSERT INTO `user` (`id`, `firstname`, `lastname`, `password`, `email`, `website`, `description`, `eventinfo`, `contact`, `address`, `city`, `pincode`, `dob`, `accesslevel`, `timestamp`, `facebookuserid`, `newsletterstatus`, `status`,`logo`,`showwebsite`,`eventsheld`,`topeventlocation`) VALUES (NULL, NULL, NULL, '$password', '$email', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, CURRENT_TIMESTAMP, NULL, NULL, NULL,NULL, NULL, NULL,NULL);");
            $user=$this->db->insert_id();
            $newdata = array(
                'email'     => $email,
                'password' => $password,
                'logged_in' => true,
                'id'=> $user
            );

            $this->session->set_userdata($newdata);
            
          //  $queryorganizer=$this->db->query("INSERT INTO `organizer`(`name`, `description`, `email`, `info`, `website`, `contact`, `user`) VALUES(NULL,NULL,NULL,NULL,NULL,NULL,'$user')");
            
            
           return $user;
        }
        else
         return false;
        
        
    }
    function login($email,$password) 
    {
        $password=md5($password);
        $query=$this->db->query("SELECT `id` FROM `user` WHERE `email`='$email' AND `password`= '$password'");
        if($query->num_rows > 0)
        {
            $user=$query->row();
            $user=$user->id;
            

            $newdata = array(
                'email'     => $email,
                'password' => $password,
                'logged_in' => true,
                'id'=> $user
            );

            $this->session->set_userdata($newdata);
            //print_r($newdata);
            return $user;
        }
        else
        return false;


    }
    function authenticate() {
         $is_logged_in = $this->session->userdata( 'logged_in' );
//        return $is_logged_in;
        if ( $is_logged_in != true) {
            return false;
        } //$is_logged_in !== 'true' || !isset( $is_logged_in )
        else {
		$userid=$this->session->userdata('id');
		$query=$this->db->query("SELECT * FROM `user` WHERE `id`='$userid'")->row();
           // $userid = $this->session->userdata( );
         return $query;
        }
    }
    
    function frontendauthenticate($email,$password) 
    {
        $query=$this->db->query("SELECT `id`, `name`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json` FROM `user` WHERE `email` LIKE '$email' AND `password`='$password' LIMIT 0,1");
        if ($query->num_rows() > 0)
        {
        	$query=$query->row();
            $data['user']=$query;
            $id=$query->id;
            $status=$query->status;
            if($status==3)
            {
//                $updatequery=$this->db->query("UPDATE `user` SET `status`=4 WHERE `id`='$id'");
                $status=4;
//                if($updatequery)
//                {
                    $this->saveuserlog($id,$status);
//                }
            }
            else if($status==1)
            {
                $status=2;
//                $updatequery=$this->db->query("UPDATE `user` SET `status`=2 WHERE `id`='$id'");
//                if($updatequery)
//                {
                    $this->saveuserlog($id,$status);
//                }
            }
            
        $query2=$this->db->query("SELECT `id`, `name`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json` FROM `user` WHERE `id`='$id' LIMIT 0,1")->row();
            
        $newdata        = array(
				'id' => $query2->id,
				'email' => $query2->email,
				'name' => $query2->name ,
				'accesslevel' => $query2->accesslevel ,
				'status' => $query2->status ,
				'logged_in' => 'true',
			);
			$this->session->set_userdata( $newdata );
            
            
            $accesslevel=$query->accesslevel;
            if($accesslevel==2)
            {
            $data['category']=$this->db->query("SELECT `id`,`categoryid`,`operatorid` FROM `operatorcategory` WHERE `operatorid`='$id'")->result();
            }
        	return $data;
        }
        else 
        {
        	return false;
        }
    }
    
    function frontendregister($name,$email,$password,$socialid,$logintype,$json) 
    {
        $data  = array(
			'name' => $name,
			'email' => $email,
			'password' =>md5($password),
			'accesslevel' => 3,
			'status' => 2,
            'socialid'=> $socialid,
            'json'=> $json,
			'logintype' => $logintype
		);
		$query=$this->db->insert( 'user', $data );
		$id=$this->db->insert_id();
        $queryselect=$this->db->query("SELECT * FROM `user` WHERE `id` LIKE '$id' LIMIT 0,1")->row();
        
        $accesslevel=$queryselect->accesslevel;
//        $queryselect=$query;
        $data1['user']=$queryselect;
        if($accesslevel==2)
        {
            $data1['category']=$this->db->query("SELECT `id`,`categoryid`,`operatorid` FROM `operatorcategory` WHERE `operatorid`='$id'")->result();
        }
        return $data1;
    }
    
	function getallinfoofuser($id)
	{
		$user = $this->session->userdata('accesslevel');
		$query="SELECT DISTINCT `user`.`id` as `id`,`user`.`firstname` as `firstname`,`user`.`lastname` as `lastname`,`accesslevel`.`name` as `accesslevel`	,`user`.`email` as `email`,`user`.`contact` as `contact`,`user`.`status` as `status`,`user`.`accesslevel` as `access`
		FROM `user`
	   INNER JOIN `accesslevel` ON `user`.`accesslevel`=`accesslevel`.`id` 
       WHERE `user`.`id`='$id'";
		$query=$this->db->query($query)->row();
		return $query;
	}
    
	public function getlogintypedropdown()
	{
		$query=$this->db->query("SELECT * FROM `logintype`  ORDER BY `id` ASC")->result();
		$return=array(
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
		
		return $return;
	}
	public function getContactCount()
	{
		$query=$this->db->query("SELECT COUNT(*) as `contactcount` FROM `amsri_contact`")->row();
		return $query->contactcount;
	}
	public function getClientCount()
	{
		$query=$this->db->query("SELECT COUNT(*) as `clientcount` FROM `amsri_client`")->row();
		return $query->clientcount;
	}
	public function getTransactionCount()
	{
		$query=$this->db->query("SELECT COUNT(*) as `transactioncount` FROM `amsri_transaction`")->row();
		return $query->transactioncount;
	}
    public function getgenderdropdown()
	{
		$status= array(
			 "" => "Choose Gender",
			 "1" => "Male",
			 "2" => "Female"
			);
		return $status;
	}
	public function getgroupdropdown()
	{
		$query=$this->db->query("SELECT * FROM `amsri_group`  ORDER BY `id` ASC")->result();
		$return=array(
		"" => "Select Group"
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
		
		return $return;
	}
	public function getleadtypedropdown()
	{
		$query=$this->db->query("SELECT * FROM `amsri_leadtype`  ORDER BY `id` ASC")->result();
		$return=array(
		"" => "Select Lead Type"
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
		
		return $return;
		// $status= array(
		// 	 "" => "Choose Lead Type",
		// 	 "1" => "Hot",
		// 	 "2" => "Cold",
		// 	 "3" => "Warm",
		// 	 "4" => "Close"
		// 	);
		// return $status;
	}
	public function frontendlogout($user)
	{
        $query=$this->db->query("SELECT `id`, `name`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json` FROM `user` WHERE `id`='$user' LIMIT 0,1")->row();
        $status=$query->status;
        if($status==4)
        {
            $status=3;
//            $updatequery=$this->db->query("UPDATE `user` SET `status`=3 WHERE `id`='$user'");
//            if($updatequery)
//            {
                $this->saveuserlog($id,$status);
//            }
        }
        else if($status==2)
        {
            $status=1;
//            $updatequery=$this->db->query("UPDATE `user` SET `status`=1 WHERE `id`='$user'");
//            if($updatequery)
//            {
                $this->saveuserlog($id,$status);
//            }
        }
//        $updatequery=$this->db->query("UPDATE `user` SET `status`=5 WHERE `id`='$user'");
        
//        if(!$updatequery)
//            return 0;
//        else
//        {
            
		$this->session->sess_destroy();
            return 1;
//        }
	}
	
     function sociallogin($user_profile,$provider)
    {
        $query=$this->db->query("SELECT * FROM `user` WHERE `user`.`socialid`='$user_profile->identifier'");
        if($query->num_rows == 0)
        {

					$googleid="";
					$facebookid="";
					$twitterid="";
					switch($provider)
					{
						case "Google":
						$googleid=$user_profile->identifier;
						break;
						case "Facebook":
						$facebookid=$user_profile->identifier;
						break;
						case "Twitter":
						$twitterid=$user_profile->identifier;
						break;
					}

            $query2=$this->db->query("INSERT INTO `user` (`id`, `name`, `password`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json`,`facebook`, `google`, `twitter`) VALUES (NULL, '$user_profile->displayName', '', '$user_profile->email', '3', CURRENT_TIMESTAMP, '1', '$user_profile->photoURL', '', '$user_profile->identifier', '$provider', '', '$facebookid', '$googleid', '$twitterid')");
            $id=$this->db->insert_id();
            $newdata = array(
                'email'     => $user_profile->email,
                'password' => "",
                'logged_in' => true,
                'id'=> $id,
                'name'=> $user_profile->displayName,
                'image'=> $user_profile->photoURL,
                'logintype'=>$provider
            );

            $this->session->set_userdata($newdata);
            print_r($newdata);
            return $newdata;

        }
        else
        {
            $query=$query->row();
            $newdata = array(
                'email'     => $user_profile->email,
                'password' => "",
                'logged_in' => true,
                'id'=> $query->id,
                'name'=> $user_profile->displayName,
                'image'=> $user_profile->photoURL,
                'logintype'=>$provider
            );

            $this->session->set_userdata($newdata);
             print_r($newdata);
            return $newdata;
        }
    }
    function registeruser($firstname,$lastname,$email,$password)
    {
    	$newdata=0;
        $password=md5($password);
        //echo $email;
        $query=$this->db->query("SELECT `id` FROM `user` WHERE `email`='$email'");
				$num=$query->num_rows();

        if($num == 0)
        {
             $this->db->query("INSERT INTO `user`(`firstname`, `lastname`, `email`, `password`) VALUE('$firstname','$lastname','$email','$password')");
            $user=$this->db->insert_id();
           
            $newdata = array(
                    'id' => $user,
                    'email' => $email,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'logged_in' => 'true'
            );

            $this->session->set_userdata($newdata);


        }
        else
        {
						$newdata=false;

				}
        return $newdata;

    }
      function loginuser($email,$password)
    {
        $password=md5($password);
        $query=$this->db->query("SELECT `id`,`firstname`,`lastname`,`username`,`name` FROM `user` WHERE `email`='$email' AND `password`= '$password'");
        if($query->num_rows > 0)
        {
            $user=$query->row();
            $userid=$user->id;
            $firstname=$user->firstname;
            $lastname=$user->lastname;
            $username=$user->username;
            $name=$user->name;


            $newdata = array(
                'email'     => $email,
                'firstname'     => $firstname,
                'lastname'     => $lastname,
                'username'     => $username,
                'name'     => $name,
                'logged_in' => 'true',
                'id'=> $userid
            );

            $this->session->set_userdata($newdata);

            return $newdata;
        }
        else
        return false;
    }
        function addToCart($product, $quantity) {
        //$data=$this->cart->contents();

        $sizequery=$this->db->query("SELECT `size`,`name`,`price`,`color`,`image1` FROM `fynx_product` WHERE `id` = '$product' LIMIT 0,1")->row();
        $size=$sizequery->size;
        $productname=$sizequery->name;
        $price=$sizequery->price;
        $color=$sizequery->color;
        $image=$sizequery->image1;
        
        $getsize=$this->db->query("SELECT `id`, `status`, `name` FROM `fynx_size` WHERE `id`='$size'")->row();
        $sizeid=$getsize->id;
        $sizename=$getsize->name;
        $getcolor=$this->db->query("SELECT `id`, `name`, `status`, `timestamp` FROM `fynx_color` WHERE `id`='$color'")->row();
        $colorid=$getcolor->id;
        $colorname=$getcolor->name;
        $data = array(
               'id'      => $product,
               'name'      => '1',
               'qty'     => $quantity,
               'price'   => $price,
               'image'   => $image,
                'options' =>array(
                    'realname' => $productname,
                    'sizeid' => $sizeid,
                    'colorid' => $colorid,
                    'sizename' => $sizename,
                    'colorname' => $colorname
                )
        );
        $userid=$this->session->userdata('id');
        if($userid=="")
        {
            $this->cart->insert($data);
            $returnval=$this->cart->insert($data);
            if(!empty($returnval)){
            return true;
            }
            else{
            return false;
            }
        }
        else
        {
            $query=$this->db->query("INSERT INTO `fynx_cart`(`user`, `product`, `quantity`, `timestamp`,`size`,`color`) VALUES ('$userid','$product','$quantity',NULL,'$size','$color')");
            $this->cart->insert($data);
            if($query)
            return true;
            else
            return false;
        }
         
    }
    function deletecartfromdb($id,$user){
    $query=$this->db->query("DELETE FROM `fynx_cart` WHERE `product`='$id' AND `user`='$user'");
	}
	
	function viewonlyuser($id){
		$query=$this->db->query("SELECT `user`.`id`, `user`.`name`, `user`.`password`, `user`.`email`, `accesslevel`.`name` as `accesslevel`, `user`.`timestamp`, `user`.`status`, `user`.`image`, `user`.`phone`, `user`.`fax`, `user`.`gender`, `user`.`mobile`, `user`.`empno`, `amsri_dept`.`name` as `dept` FROM `user`
		LEFT JOIN `accesslevel` ON `accesslevel`.`id`=`user`.`accesslevel`
		LEFT JOIN `amsri_dept` ON `amsri_dept`.`id`=`user`.`dept`
		WHERE `user`.`id`=$id")->row();
		if($query->status==1){
			$query->status = 'Enable';
		} else {
			$query->status = 'Disable';
		}
		if($query->gender==1){
			$query->gender = 'Male';
		} else {
			$query->gender = 'Female';
		}
		return $query;
	}
}
?>