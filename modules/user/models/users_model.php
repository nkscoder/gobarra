<?php
class Users_model extends MY_Model{

    /**
    * Validate the login's data with the database
    * @param string $user_name
    * @param string $password
    * @return void
    */
    
	public function validate($email, $password)
	{
		$this->db->where('email', $email);
		$this->db->where('password', $password);
		$query = $this->db->get('tbl_users');
              
		
		if($query->num_rows == 1)
		{
			return TRUE;
		}		
	}
	
	public function validate_email($email)
	{	
		$this->db->select('*');
		$this->db->from('tbl_users');
		$this->db->where('email',$email);		
		$query = $this->db->get()->result_array();
        /*echo "<pre/>";
		print_r($query);*/
         if($query) {
			 $google = $query[0]['google_user_id'];
			 $facebook = $query[0]['facebook_user_id'];
		 }

	/*	die;*/

		if(!empty($facebook)  or  !empty($google) )
		{
			if ($facebook){
				$facebook='facebook';
				return $facebook;
			} else{
				return $google='google';
			}
			/*echo  $google; die;
			return false;*/
			
			
		} elseif($query) {

		$data='yes'; 
			return $data;
		} else{
			$data='no';

			return $data;

		}
	}
	
	public function get_user_row($id,$condtion='')
	{
		$id = (int) $id;
		
		if($id!='' && is_numeric($id))
		{
			$condtion = "status !='2' AND user_id=$id $condtion ";
			
			$fetch_config = array(
			  'condition'=>$condtion,							 					 
			  'debug'=>FALSE,
			  'return_type'=>"array"							  
			);
			
			$result = $this->find('tbl_users',$fetch_config);
			return $result;		
		}
	
	}
	
	function update_password($email,$data)
	{
		$this->db->where('email', $email);		
		$this->db->update('tbl_users', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}


	function get_db_session_data()
	{
		$query = $this->db->select('user_data')->get('ci_sessions');
		$user = array(); /* array to store the user data we fetch */
		foreach ($query->result() as $row)
		{
		    $udata = unserialize($row->user_data);
		    /* put data in array using username as key */
	  $user['user_name'] = $udata['user_name']; 
		    $user['is_logged_in'] = $udata['is_logged_in']; 
		}
		return $user;
	}
	
	
	public function create_user()
	{
		$this->db->where('email', $this->input->post('email'));


		$query = $this->db->get('tbl_users');
        if($query->num_rows > 0){			
        	echo '<div class="alert alert-error"><a class="close" data-dismiss="alert"></a><strong>';
			  echo "Username already taken";	
			echo '</strong></div>';			
		 }else{
			 $password = $this->input->post('password');
			 $decript = md5($password);
			 $country = $this->input->post('country_name');
			 $country_name = explode(',',$country);
			 $Mycountry = $country_name[0];
			 $city = $this->input->post('city_name');

			 $city_name = explode(',',$city);
               

			 $Mycity = $city_name[0];
			/* echo $Mycity; die;		*/	 
			$new_member_insert_data = array(
				'first_name' 	=> $this->input->post('first_name'),
				'last_name' 	=> $this->input->post('last_name'),
				'email' 		=> $this->input->post('email'),			
				'gender' 		=> $this->input->post('gender'),
				'country_id'	=> $Mycountry,
				'city_id'		=> $Mycity,
				'occupation' 	=> $this->input->post('occupation'),
				'password' 		=> $decript,
				'added_date'	=> date('Y-m-d H:i:s')		
			);
			//print_r($new_member_insert_data); die;
			$insert = $this->db->insert('tbl_users', $new_member_insert_data);          
		    return $insert;
		}
	      
	}//create_member
public function getStateModel($id){
			$this->db->select('*');
			$this->db->from('tbl_cities');
			$this->db->where('country_id',$id);
			//$this->db->limit(1);
			$result=$this->db->get();
			if($result->num_rows >0){
				return $result->result();	
			}
		}
     public function getuserDetail($id)
    {
		$this->db->select('*');
		$this->db->from('tbl_users');		
		$this->db->where('user_id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
    public function getuserInfo($email)
 
    {
		$this->db->select('*');
		$this->db->from('tbl_users');
		$this->db->where('email', $email);
		$query = $this->db->get();
		return $query->result_array(); 
    }
     function update_product($id, $data)
    {
		$this->db->where('user_id', $id);
		$this->db->update('tbl_users', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return TRUE;
		}else{
			return TRUE;
		}
	}

	public function CheckUser($email){

		$this->db->select('*');
		$this->db->from('tbl_users');
		$this->db->where('email', $email);
		$query = $this->db->get()->result_array();
        $facebook='facebook';
		$google='google';
		$data='no';
      /*    print_r($query);
		echo $query[0]['google_user_id'];
		echo $query[0]['facebook_user_id'];

		die;*/
		if(!$query[0]['google_user_id']==null){

		/*	echo $query[0]['google_user_id']; die;*/

           return $google;

		}elseif (!$query[0]['facebook_user_id']==null){
			 return $facebook;
		} else{
			return $data;
		}

	}
}