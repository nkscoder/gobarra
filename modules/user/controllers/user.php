<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class User extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();
        {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation','email');
            $this->load->model(array('user/users_model'));
            $this->form_validation->set_error_delimiters("<div class='required'>","</div>");
        }
    }	
	public function index()
	{
		if($this->session->userdata('is_logged_in')){
			redirect('home');
        }else{
        	$this->load->view('user/login');	
        }
	}    
         public function test(){
         print_r($this->session->all_userdata());
     }	
	public function login()
	{
		if($this->session->userdata('is_logged_in')){
			redirect('home');
        }else{
               $this->load->view('login');  	
        }
	}
	/*Function for Generate Random password */
	
	public function generate_password( $length = 8 ) {
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
	$password = substr( str_shuffle( $chars ), 0, $length );
	return $password;
	}
	/*Function for Gorget password */
		public function forgotpassword()
	{	  	  
	   $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
	    if($this->form_validation->run() == TRUE)
		{
			$password =$this->generate_password();
			 $mail =$this->input->post('email');
             $encript = md5($password);
             $data = array(
                    'email' => $mail,
                    'password' =>  $encript,                    
                    'modified' => date('Y-m-d H:i:s')                   
                );
				$data1 = array(                   
                    'password' =>  $encript,                    
                    'modified' => date('Y-m-d H:i:s')                   
                );  
				$validate = $this->users_model->validate_email($mail);
				/*print_r($validate); die;*/
				 if($validate=='yes')
				 {			
					$this->users_model->update_password($data['email'],$data1);				
					// Set your email information	

					$to=$mail;
					$subject="Forgot Password";
					$from = 'social@gobarra.com';
					$body='Hi, <br/> <br/>Your Password Is:&nbsp;<strong>'.$password.' </strong><br>And Email Id:<strong>'.$data['email'].'</strong><br>Please change Your Password after Login your account   <br/> <br/>';
					$headers = "From: " . strip_tags($from) . "\r\n";				
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";	 
					if(mail($to,$subject,$body,$headers)) {
						// Raise error message

						$this->session->set_flashdata('item', array('message' => 'Kindly check your email to reset password', 'class' => 'alert alert-success'));
						redirect('user/forgotpassword');
					}else {

						$this->session->set_flashdata('item', array('message' => 'Some error occurred', 'class' => 'alert alert-error'));
						redirect('user/forgotpassword');
					}


					} else{

					 if($validate=='google') {
						 $this->session->set_flashdata('item', array('message' => 'Your account has been registered, Please Login with Google account', 'class' => 'alert alert-danger'));
						 redirect('user/login');

					 } elseif($validate=='facebook'){
						 $this->session->set_flashdata('item', array('message' => 'Your account has been registered, Please Login with Facebook account', 'class' => 'alert alert-danger'));
						 redirect('user/login');

					 }
					 else{

						 $this->session->set_flashdata('item', array('message' => 'Your account has been not registered', 'class' => 'alert alert-danger'));
						 redirect('user/login');
					    }





				}
		} else{
               $this->load->view('forgotpassword');
          }
	}
	/*Function for validate_email */
	/*
	public function validate_email($email){
	    $data =array();	 
	    $data['userData'] = $this->Users_model->validate_email($email);
	    if($data['userData']){
	    return TRUE;
	    }
        else
        {
            return FALSE;
        }	   
	} */
        public function account() {
        	if ($this->session->userdata('is_logged_in')){
            redirect('home');
        } else {
            $this->load->view('profile');
        }
    }
/*Function for profile */  

   public function profile() 
    {
        if ($this->session->userdata('is_logged_in')) 
        {   
			
            $this->load->model('Users_model');
			$User_Arr = $this->Users_model->getuserInfo($this->session->userdata('email'));
            $UserId = $User_Arr[0]['user_id'];                                    
            $data['userData'] = $this->Users_model->getuserDetail($UserId);				
            $this->load->view('profile',$data);
            }
            else 
            {
            $this->load->view('login');
        }
    }
  /*Function for update_profile*/  
  
   public function update_profile(){
        if($this->session->userdata('is_logged_in')){           
            $this->load->model('Users_model');
            $User_Arr = $this->Users_model->getuserInfo($this->session->userdata('email'));
            $UserId = $User_Arr[0]['user_id'];                                         
            if($this->input->server('REQUEST_METHOD') == 'POST')
        	{
         $this->load->library('form_validation');		            
		// field name, error message, validation rules
		$this->form_validation->set_rules('first_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('country_name', 'Country', 'trim|required');
		$this->form_validation->set_rules('city_name', 'City', 'trim|required');		
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|numeric');
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a></div>');           
		//if the form has passed through the validation		   
            if ($this->form_validation->run())
            {   
				if( !empty($_FILES) && $_FILES['image']['name']!='' )
				{
                $this->load->library('upload');	
				$uploaded_data =  $this->upload->my_upload('image','profile_img');
				if( is_array($uploaded_data)  && !empty($uploaded_data) )
				{ 
				$uploaded_file = $uploaded_data['upload_data']['file_name'];
				} else{

                         $this->session->set_flashdata('item', array('message' => 'Please upload Image Size less than 5mb.','class' =>'alert alert-danger'));
                             redirect('user/profile');
				}






				 $country = $this->input->post('country_name');
				 $country_name = explode(',',$country);
				 $Mycountry = $country_name[0];
				 $city = $this->input->post('city_name');
				 $city_name = explode(',',$city);
				 $Mycity = $city_name[0];
                $data_to_store = array(
                    'first_name' 	=> $this->input->post('first_name'),
                    'last_name' 	=> $this->input->post('last_name'),
                    'couple' 		=> $this->input->post('couple'),
                    'gender' 		=> $this->input->post('gender'),
                    'country_id'	=> $Mycountry,
                    'city_id'		=> $Mycity,
                    'occupation' 	=> $this->input->post('occupation'),
					'mobile' 		=> $this->input->post('mobile'),
					'profile_image' => $uploaded_file,	
                    'status' 		=> 1,
                    'modified' 		=> date('Y-m-d H:i:s')                   
                );
				}
				else
				{
					$country = $this->input->post('country_name');
					 $country_name = explode(',',$country);
					 $Mycountry = $country_name[0];
					 $city = $this->input->post('city_name');
					 $city_name = explode(',',$city);
					 $Mycity = $city_name[0];

					 $data_to_store = array(
                    'first_name' 	=> $this->input->post('first_name'),
                    'last_name' 	=> $this->input->post('last_name'),
                    'couple' 		=> $this->input->post('couple'),
                    'gender' 		=> $this->input->post('gender'),
                    'country_id'	=> $Mycountry,
                    'city_id'		=> $Mycity,
                    'occupation' 	=> $this->input->post('occupation'),
					'mobile' 		=> $this->input->post('mobile'),					
                    'status' 		=> 1,
                    'modified' 		=> date('Y-m-d H:i:s')                   
                );
				}
                //if the insert has returned true then we show the flash message
                $this->Users_model->update_product($UserId, $data_to_store);
                $this->session->set_flashdata('item', array('message' => 'Profile Updated Successfully','class' => 'success'));
                redirect('user/profile');
            }
			//validation run
        }
            $data['userData'] = $this->Users_model->getuserDetail($UserId);			
            $this->load->view('profile',$data);
        } else {
            $this->load->view('login');
        }
    }	
		/*Function for encrip_password */
		
    public function __encrip_password($password) {
        return md5($password);
    }
	/*Function for validate credentials for login */ 
	
	public function validate_credentials()
	{
		$this->load->model('Users_model');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$decript = md5($password);
		$rember = ($this->input->post('remember') != "") ? TRUE : FALSE;
		$is_valid = $this->Users_model->validate($email, $decript);

		if ($this->input->post('remember') == "Y") {
			set_cookie('userName', $this->input->post('email'), time() + 60 * 60 * 24 * 30);
			set_cookie('pwd', $this->input->post('password'), time() + 60 * 60 * 24 * 30);
		} else {
			delete_cookie('userName');
			delete_cookie('pwd');
		}

		$userData=$this->Users_model->CheckUser($email);
		/*echo $userData; die;*/
		if ($userData=='no') {

		if ($is_valid) {


			$data = array(
				'email' => $email,
				'is_logged_in' => TRUE
			);
			$this->session->set_userdata($data);
			$this->session->set_flashdata('item', array('message' => 'Login Successfully', 'class' => 'success'));
			redirect('home');


		} else // incorrect username or password
		{
			$this->session->set_flashdata('item', array('message' => 'Invalid Email Or Password', 'class' => 'alert alert-danger'));
			redirect('user/login');
		}
	}
	else{

		  if($userData=='google') {
			  $this->session->set_flashdata('item', array('message' => 'Your account has been registered, Please Login with Google account', 'class' => 'alert alert-danger'));
			  redirect('user/login');

		  } else{
			  $this->session->set_flashdata('item', array('message' => 'Your account has been registered, Please Login with Facebook account', 'class' => 'alert alert-danger'));
			  redirect('user/login');

		  }

	}

	}
	public function signup()
	{
		$this->load->view('register');  
	}
/*Function For Registring User */
	
	public function create_member()
	{
		/*echo base_url();
		die;*/
		$this->load->library('form_validation');		            
		// field name, error message, validation rules
		$this->form_validation->set_rules('first_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');		
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('cpassword', 'Password Confirmation', 'trim|required|matches[password]');
		$this->form_validation->set_rules('country_name', 'Country', 'trim|required');
		$this->form_validation->set_rules('city_name', 'City', 'trim|required');		
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a><strong>','</strong></div>');		
		if($this->form_validation->run() == FALSE)
		{
            $this->load->view('register');  
		} else {			
		//$this->load->model('Users_model');
		if($query = $this->users_model->create_user())
		{ 
			$mail = $this->input->post('email');			
			$password = $this->input->post('password');			
			$to=$mail;
			$subject="Welcome To Gobarra";
			$from = 'social@gobarra.com';
            $massage=$this->load->view('registration_message',$mail,true);
		    $body=$massage;
			$headers = "From: " . strip_tags($from) . "\r\n";				
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";	 
			mail($to,$subject,$body,$headers);
			
			$this->session->set_flashdata('item', array('message' => 'Your Account Has Been Created','class' => 'alert alert-success'));
			redirect('user/login');
                //$this->load->view('signup_successful');						
		} else {
          $this->load->view('register');  		
		}
 	  }	
	}		
	public function getState(){			
		$this->load->model(array('user/Users_model'));
		$id = $this->input->post('country_id');
		$data1 = $this->Users_model->getStateModel($id);			
		if(!empty($data1)){
			$str='';
			$str.= '<option value="0">Select City</option>';
			foreach($data1 as $dat){
				
				$str.= '<option value="'.$dat->id.'" >'.$dat->city.'</option>';
			}
			echo $str;
		}
	}
	/*Change User Password Function*/
	
		public function ChangePassword()
		{
			if($this->session->userdata('is_logged_in')){		  
			$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|min_length[6]');
			$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|valid_password');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[new_password]');
			$this->load->model('user/users_model');
            $User_Arr = $this->users_model->getuserInfo($this->session->userdata('email'));
            $UserId =$User_Arr[0]['user_id'];
			if ($this->form_validation->run() == TRUE)
			{
					$pass1= $this->input->post('old_password');
				    $password_old   =  md5($pass1);
				    $res           =  $this->users_model->get_user_row($UserId," AND password='$password_old' ");					
					if( is_array($res) && !empty($res) )
					{						
						$password = md5($this->input->post('new_password',TRUE));				
						$data = array(
						'password'=>$password
						);			
						$where = "user_id=".$UserId." ";
						$this->users_model->safe_update('tbl_users',$data,$where,FALSE);
						$this->session->set_flashdata('item', array('message' => 'Your Password Has Been Changed','class' => 'alert alert-success'));
						redirect('user/ChangePassword','');
					}
					else
					{						
						$this->session->set_flashdata('item1', array('message1' => ' Old Password Does Not Match With Enterd Password','class' => 'alert alert-warning'));
						redirect('user/ChangePassword');
					}
			}
				$this->load->view('user/change_password_view');
		}
		else 
		{
            $this->load->view('user/login');
        }
		}
	
	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('item', array('message' => 'User Log Out ','class' => 'success'));
		redirect('home','');
	}
}