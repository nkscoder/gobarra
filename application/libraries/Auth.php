<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Auth
{
	
	public function __construct()
	{
	   if (!isset($this->ci))
	   {
			$this->ci =& get_instance();
	   }		
	   $this->ci->load->library('session','safe_encrypt');
	   $this->ci->load->helper('cookie');
	  
	}	
	
	public function is_user_logged_in()
	{
		if ($this->ci->session->userdata('logged_in') == TRUE)
		{
			 $user_data = array(
			   'user_name'=>$this->ci->session->userdata('username'),			  
			   'status'=>'1'	
			   );						 
			 $num = $this->ci->db->get_where('tbl_user',$user_data)->num_rows();
			 return ($num) ? true : false;
			
		}
		else
		{
			return false;
		}
	}
	
	public function is_auth_user()
	{
		if ($this->is_user_logged_in()!= TRUE)
		{
			$this->logout();
			redirect('donation', '');
			
		}
	}
	
    public function update_last_login($login_data)
	{		
		
		$data = array('last_login'=>$login_data['current_login'],'current_login'=>$this->ci->config->item('Ashia/Kolkata') );
		$this->ci->db->where('user_id', $this->ci->session->userdata('user_id'));
		$this->ci->db->update('tbl_user', $data);
	}
		
	
   public function verify_user($username,$password,$status='1')
   {	   		
   
        $password = $this->ci->safe_encrypt->encode($password);	
		$this->ci->db->select("user_id,user_name,country,
		name,mobile,address,is_blocked,
		last_login,current_login,blocked_time",FALSE);
		
		$this->ci->db->where('user_name', $username);
		$this->ci->db->where('password', $password);
		$this->ci->db->where('status', $status);	
		$this->ci->db->where('is_verified','1');		
		$query = $this->ci->db->get('tbl_user');
		//echo $this->ci->db->last_query();
		
		if ($query->num_rows() == 1)
		{
			
			$row  = $query->row_array();
            $name = $row['name'];		
			$data = array(
							'user_id'=>$row['user_id'],
							'login_type'=>$row['login_type'],
							'username'=>$row['user_name'],							
							'address'=>$row['address'],
							'name'=>$row['name'],
							'country'=>$row['country'],
							'mobile'=>$row['mobile'],							
							'is_blocked'=>$row['is_blocked'],	
							'blocked_time'=>$row['blocked_time'],						
							'logged_in' => TRUE
						);
						
			$login_data = array('current_login'=>$row['current_login']);
			print_r($login_data); die;			
			$this->ci->session->set_userdata($data);			
			$this->update_last_login($login_data);	
			
		}
		else
		{
			$this->ci->session->set_flashdata('message', 'Invalid Username/Password');
		}
		
	}
	
	
	/** 
	* Logout - logs a user out
	* @access public
	*/
	
	 public function logout()
	 {		
		 
				
			$userId = $this->ci->session->userdata('user_id');
				
			if($userId!='' && $userId > 0 )
			{
				if ($this->ci->db->table_exists('tbl_user_online'))
				{   

			      $this->ci->db->query("DELETE FROM tbl_user_online WHERE user_id =".$userId." ");
			   
				}
			}
			
			$data = array('user_id' => 0,
						  'type'=> 0,
						  'login_type'=>0,
						  'username' => 0,
						  'name'=>0,
						  'mkey'=>0,
						  'is_blocked'=>0,
						  'blocked_time'=>0,						  
						  'logged_in' => FALSE
						);
			 $this->ci->session->unset_userdata($data);
			//$this->ci->session->sess_destroy();           
			
		 
	 }	 
	 
	 
	  
 	
	
}