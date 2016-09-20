<?php
 session_start();
class Home extends Public_Controller
{

  public function __construct()
  {
	parent::__construct();        
	$this->load->model(array('home_model','timelinepost/timeline_model','admin_products/products_model','messages/messages_model','enquiry/enquiry_model'));
	$this->load->helper('scroll_pagination/scroll_pagination');	
	 $this->load->library('session');
	/*require_once APPPATH . 'libraries/google-api-php-client-master/src/Google/autoload.php';
	require_once APPPATH . 'libraries/google-api-php-client-master/src/Google/Service/Analytics.php';
	include_once APPPATH . "libraries/google-api-php-client-master/src/Google/Client.php";
	include_once APPPATH . "libraries/google-api-php-client-master/src/Google/Service/Oauth2.php";  */
  }

	public function index() 
	{
		$condition 					= array();
		$where 						= "";
		$condition['status'] 		= '1';
		$pagesize              		=  (int) $this->input->get_post('pagesize');
		$config['limit']			=  ( $pagesize > 0 ) ? $pagesize : $this->config->item('per_page');
		$page_segment          		= 3;
		$offset                		=  $this->uri->segment($page_segment);	
		$base_url              		=  base_url().'home/index';       
		$res_array 					= $this->home_model->get_traveler($config['limit'], $offset, $condition);			 
		$config['total_rows'] 		= get_found_rows();
		$data['res'] 				= $res_array;
		$data['scroll_pagination']    = scroll_pagination($base_url,$config['total_rows'],$config['limit'],$page_segment);


		/*$data['res'] = $this->home_model->get_travelerData();*/
		
		$this->load->view('home',$data);
	}

	 public  function get_traveler_Data(){

      echo json_encode("ok");

		/* $limit=5;
		 $start=5;
		 $data['res'] = $this->home_model->get_traveler_Data($limit,$start);*/

		/* echo "<pre/>";
		 print_r($data['res']);*/

	 }
	function get_trav_plan()
	{	
		$condition = array();
		$where 					= "";
		$condition['status'] 	= '1';
		$pagesize              	=  (int) $this->input->get_post('pagesize');
		$config['limit']		=  ( $pagesize > 0 ) ? $pagesize : $this->config->item('per_page');
		$page_segment          	= 4;
		$offset                	=  $this->uri->segment($page_segment);		
		$base_url              	=  base_url();
		$res_array 				= $this->home_model->get_traveler($config['limit'], $offset, $condition);			 
		$config['total_rows'] 	= get_found_rows();
		$data['res'] 			= $res_array;			
		$data['main_content'] 	= 'home';    
		$this->load->view('home', $data);  
	}	
	public function get_traveler()
	{
		$posted_data 			= array_filter($this->input->get());
		$condition 				= array();
		$where 					= "";
		$condition['status'] 	= '1';
		$pagesize              	=  (int) $this->input->get_post('pagesize');
		$config['limit']		=  ( $pagesize > 0 ) ? $pagesize : $this->config->item('per_page');
		$page_segment          	= 3;
		$offset                	=  $this->uri->segment($page_segment);	  
		$base_url              	=  base_url().'home/index';         
		$travel_from 			= $this->input->get_post('travel_from', TRUE);
		$travel_to 				= $this->input->get_post('travel_to', TRUE);
		$from_date 				= $this->input->get_post('from_date', TRUE);
		$to_date 				= $this->input->get_post('to_date', TRUE);		 
		 if ($from_date != '' and $to_date != '') {
			$where.='wlp.from_date >= "'.$from_date.'" AND wlp.to_date<= "'.$to_date.'"';
			} elseif ($from_date != '') {
			$where.="(wlp.from_date='$from_date') ";
		} elseif ($to_date != '') {
			$where.="(wlp.to_date='$to_date') ";
		}
			$condition['where']=$where;
		if ($travel_from != '') {
			$condition['travel_from'] = $travel_from;
		}
		if ($travel_to != '') {
			$condition['travel_to'] = $travel_to;
		}
		$res_array = $this->home_model->get_traveler($config['limit'], $offset, $condition);
		$config['total_rows'] = get_found_rows();
		$data['res'] = $res_array;
		$data['scroll_pagination']    = scroll_pagination($base_url,$config['total_rows'],$config['limit'],$page_segment);
		$data['page_links']     	  =  pagination_refresh($base_url,$config['total_rows'],$config['limit'],$offset);
		$data['heading_title'] 		  = "Search Result";
		$this->load->view('home', $data);
	}
	
		public function insertmessage()
		{
			
			$sender_id		= $this->input->get_post('sender_id');
			$reciever_id	= $this->input->get_post('reciever_id');
			$ThreadCount 	= $this->messages_model->ThreadCount($sender_id,$reciever_id);
			$countThread	= count($ThreadCount);
			//print_r($countThread); die;
			if($countThread == 0)
			{
				$posted_data = array(
                'sender_id'  	=> $sender_id,
                'reciever_id' 	=> $reciever_id,                
				'thread_date'	=> date('Y-m-d H:i:s'),
                                'active_status'	=> 1
				);
				$this->db->insert('tbl_thread',$posted_data,FALSE);
			}
			else
			{
				$thread_id		= $ThreadCount[0]['thread_id'];
				$posted_data	= array(                
				'thread_date'	=> date('Y-m-d H:i:s'),
                                'active_status'	=> 1
				);
				 $where = "thread_id = '".$thread_id."'"; 						
				$this->messages_model->safe_update('tbl_thread',$posted_data,$where,FALSE);
			}
			
			if( !empty($_FILES) && $_FILES['image']['name']!='' )
				{
				$this->load->library('upload');					
				$uploaded_data =  $this->upload->my_upload('image','message_image');
				if( is_array($uploaded_data)  && !empty($uploaded_data) )
				{ 								
					$uploaded_file = $uploaded_data['upload_data']['file_name'];
				}	
				$sender_id		= $this->input->get_post('sender_id');
				$reciever_id	= $this->input->get_post('reciever_id');				
				$message     	=$this->input->get_post('message');
				 $posted_data = array(
                'sender_id'  	=> $sender_id,
                'reciever_id' 	=> $reciever_id,	
                'message'		=> $message,
				'message_image'	=> $uploaded_file,
				'msg_add_date'	=> date('Y-m-d H:i:s')
				);
				}
				else
				{
				$sender_id		= $this->input->get_post('sender_id');
				$reciever_id	= $this->input->get_post('reciever_id');				
				$message     	=$this->input->get_post('message');
				 $posted_data = array(
                'sender_id'  	=> $sender_id,
                'reciever_id' 	=> $reciever_id,	
                'message'		=> $message,				
				'msg_add_date'	=> date('Y-m-d H:i:s')	
				);
				}
				//print_r($posted_data); die;
				$this->db->insert('tbl_message',$posted_data,FALSE); ?>
                                <img src='<?php echo theme_url(); ?>img/loading.gif'/>					
				 <?php echo "Message Sending" ;
				}

			public function login()
			{
			if(@$this->session->userdata('is_logged_in')):
			
			redirect(site_url('home'));
			else :
			$this->load->library('facebook');
			$this->data['login_url'] =
			$this->facebook->getLoginUrl(array('redirect_uri' => site_url('home/flogin'),
			'scope' => array("email")));
			$this->load->view('login',$this->data);
			endif;
		}
	/* Function For Facebook Login */
	public function flogin(){
		$user = "";
		$this->load->library('facebook');
		$userId = $this->facebook->getUser();        
		if ($userId) {
			try {
				$user = $this->facebook->api('/me');
				//print_r($user); die;
			} catch (FacebookApiException $e) {
				$user = "";
			}
		}else {
			$this->facebook->destroySession();
		}
		if($user!="") :
		   $this->load->model('user/users_model','users');        
		   if(!$this -> users ->validate_email($user['email'])) :
		   $male='';
		   if($user['gender']=='male')
		   {
			   $male='M';
		   }
		  else
		   {
			   $male='F';
		   }
				$user_details = array(
				'first_name'  => $user['first_name'],
				'last_name'  => $user['last_name'],
				'email' => $user['email'], 
				'gender' => $male, 
				'password' => $user['email'],          
				);

				$user_id = $this->db->insert('tbl_users', $user_details);   
			       $users = $this -> users -> getuserInfo($user['email']);
				$data = array(
				'email' => $user['email'],
				'is_logged_in' =>TRUE
			);
			$this->session->set_userdata($data);               
			else :         
				 $data = array(
				'email' => $user['email'],
				'is_logged_in' =>TRUE
			);
			$this->session->set_userdata($data);  
			endif;
		else :
			$data['login_url'] = $this->facebook->getLoginUrl(array(
				'redirect_uri' => site_url('home'), 
				'scope' => array("email") // permissions here
			));
		endif;
		redirect(site_url('home'));
		
	}
	/* Function For Facebook Login End */ 

		/* Home Product Details Start */

		public function product_details()
		{
			if($this->session->userdata('is_logged_in'))
			{			
			
			$condition                     	= array();
			$pagesize                      	= (int) $this->input->get_post('pagesize');
			$config['limit']         		= ( $pagesize > 0 ) ? $pagesize : $this->config->item('per_page');
			$offset                      	=  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;
			$config['total_rows']           = $this->home_model->record_count();			
			$base_url                       = current_url_query_string(array('filter'=>'result'),array('per_page'));
			$data['page_links']            	= pagination_refresh($base_url,$config['total_rows'],$config['limit'],$offset);
			$res 							= $this->home_model->get_traveler($config['limit'], $offset, $condition);
			$data['res']					= $res;
			$res_array              		= $this->home_model->get_products($config['limit'],$offset,$condition);  
			$data['res_array']             	= $res_array; 			
			$this->load->view('home/view_home_products',$data);
			} else {
				redirect(site_url('user/login'));
			}
			}
		/* Home Product Details End */ 

               /* Home Product Search Start */

		public function product_search()
		{
			if($this->session->userdata('is_logged_in'))
			{			
			$condition                     	= array();
			$pagesize                      	= (int) $this->input->get_post('pagesize');
			$config['limit']         		= ( $pagesize > 0 ) ? $pagesize : $this->config->item('per_page');
			$offset                      	=  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;			
			$base_url                       = current_url_query_string(array('filter'=>'result'),array('per_page'));			
			$config['total_rows'] 			= get_found_rows();
			$data['page_links']            	= pagination_refresh($base_url,$config['total_rows'],$config['limit'],$offset);			
			$country                		= $this->input->get_post('country_name');
			$city                			= $this->input->get_post('city_name');	
			//print_r($city); die;			
			if($country!='')
			{
			$condition['country_id']=$country;			
			}
			if($city!='')
			{
			$condition['city_id']=$city;			
			}
			$res_array              		 = $this->home_model->get_products($config['limit'],$offset,$condition);  
			$data['res_array']             	 = $res_array;			
			$res 							 = $this->home_model->get_traveler($config['limit'], $offset);
			$data['res']					 = $res;	
			$this->load->view('home/view_home_products',$data);
			} else {
				redirect(site_url('user/login'));
			}
			}
		/* Home Product Search End */ 


		/*more products form the buyers start here*/
		public function more_products()
		{
			if($this->session->userdata('is_logged_in'))
			{
			$this->load->model('user/Users_model');
			$config			 = array();
			$pagesize        = (int) $this->input->get_post('pagesize');
			$config['limit'] = ( $pagesize > 0 ) ? $pagesize : $this->config->item('per_page');
			$offset          = ($this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;				
			$base_url        =  current_url_query_string(array('filter'=>'result'),array('per_page'));			
			//$user            = $this->input->get_post('user_id');
			$uid = $this->uri->segment(3); 
			
			if($uid!='')
			{
			$condition['user_id']=	$uid;
			}
			
			$res_array				   	   = $this->home_model->get_more_products($config['limit'],$offset,$condition);
			$config['total_rows']		   = $this->home_model->record_count1($uid);
			$user                          =$this->home_model->getUserInfo($uid);	
			$data['page_links']            = pagination_refresh("$base_url",$config['total_rows'],$config['limit'],$offset);	
			$data['res_array']             = $res_array;
			$data['user_data']             = $user;
			//print_r($user); die;
			$this->load->view('home/view_more_products',$data);	
			}
			else
			{
			redirect(site_url('user/login'));	
			}
		}
		/*more products form the buyers end here*/
		
		/*Enquiry for product*/
		public function sendEnquiry()
		{
			$sender_id		= $this->input->get_post('senderId');
			$reciever_id	= $this->input->get_post('recieverId');
			$EnqCount 		= $this->enquiry_model->EnqCount($sender_id,$reciever_id);
			$countThread	= count($EnqCount);
			if($countThread == 0)
			{
				$posted_data = array(
                'sender_id'  		=> $sender_id,
                'reciever_id' 		=> $reciever_id,                
				'enq_thread_date'	=> date('Y-m-d H:i:s')	
				);
				$this->db->insert('tbl_enquiry_thread',$posted_data,FALSE);
				}
				else
				{
				$thread_id			= $EnqCount[0]['enq_thread_id'];
				$posted_data		= array(                
				'enq_thread_date'	=> date('Y-m-d H:i:s')
				);
				$where = "enq_thread_id = '".$thread_id."'";				
				$this->enquiry_model->safe_update('tbl_enquiry_thread',$posted_data,$where,FALSE);	
				}
				$senderId	= $this->input->get_post('senderId');
				$recieverId	= $this->input->get_post('recieverId');
				//print_r($recieverId);
				$msg     =$this->input->get_post('enquiry');
				$posted_data = array(
                'sender_id'  	=> $senderId,
                'reciever_id' 	=> $recieverId,	
                'enquiry'		=> $msg,
				'enquiry_date'	=> date('Y-m-d H:i:s')
				);
				//print_r($posted_data); die;
				$this->db->insert('tbl_enquiry',$posted_data,FALSE);
				echo "Enquiry Sent" ; 
		}
		/*private message send*/
		public function PrivateMessage()
		{
			
			$sender_id		= $this->input->get_post('sender_id');
			$reciever_id	= $this->input->get_post('reciever_id');
			$ThreadCount 	= $this->messages_model->ThreadCount($sender_id,$reciever_id);
			$countThread	= count($ThreadCount);
			//print_r($countThread); die;
			if($countThread == 0)
			{
				$posted_data = array(
                'sender_id'  	=> $sender_id,
                'reciever_id' 	=> $reciever_id,                
				'thread_date'	=> date('Y-m-d H:i:s')	
				);
				$this->db->insert('tbl_thread',$posted_data,FALSE);
			}
			else
			{
				$thread_id		= $ThreadCount[0]['thread_id'];
				$posted_data	= array(                
				'thread_date'	=> date('Y-m-d H:i:s')	
				);
				 $where = "thread_id = '".$thread_id."'"; 						
				$this->messages_model->safe_update('tbl_thread',$posted_data,$where,FALSE);
			}
			
			if( !empty($_FILES) && $_FILES['image']['name']!='' )
				{
					$this->load->library('upload');					
					$uploaded_data =  $this->upload->my_upload('image','message_image');
					if( is_array($uploaded_data)  && !empty($uploaded_data) )
					{ 								
						$uploaded_file = $uploaded_data['upload_data']['file_name'];
					}	
				$sender_id		= $this->input->get_post('sender_id');
				$reciever_id	= $this->input->get_post('reciever_id');				
				$message     	=$this->input->get_post('message');
				 $posted_data = array(
                'sender_id'  	=> $sender_id,
                'reciever_id' 	=> $reciever_id,	
                'message'		=> $message,
				'message_image'	=> $uploaded_file,
				'msg_add_date'	=> date('Y-m-d H:i:s')
				);
				}
				else
				{
				$sender_id		= $this->input->get_post('sender_id');
				$reciever_id	= $this->input->get_post('reciever_id');				
				$message     	=$this->input->get_post('message');
				 $posted_data = array(
                'sender_id'  	=> $sender_id,
                'reciever_id' 	=> $reciever_id,	
                'message'		=> $message,				
				'msg_add_date'	=> date('Y-m-d H:i:s')	
				);
				}
				//print_r($posted_data); die;
				$this->db->insert('tbl_message',$posted_data,FALSE);					
					echo "Message Sent";						
		}
		/* Time Line Post function start Here */
		public function timelinepost()
		{
			if($this->session->userdata('is_logged_in'))
			{
			$email=$this->session->userdata('email');
			  $curudrID=$this->home_model->getUserID($email);		
			  if(!empty($curudrID))
			  {
			  $curID=$curudrID[0]->user_id;			
			  }		
			$this->form_validation->set_rules('description','Description','required|xss_clean|max_lenght[1000]');	
			$descrp = $this->input->post('description',TRUE);
			$textToStore = nl2br(htmlentities($descrp, ENT_QUOTES, 'UTF-8'));
			if($this->form_validation->run() == TRUE)
			{
			$postData = array(
				'user_id'		=> $curID,
				'description'	=> $textToStore,
				'type'			=> '2',	
				'created'		=> date('Y-m-d H:i:s'),
					);	
			$this->db->insert('tbl_travel_plans',$postData,FALSE);
			redirect('home/timelinepost/'.$curID,'');
			}				
			  
			  $condition                = array();
			  $pagesize                 = (int) $this->input->get_post('pagesize');
			  $config['limit']          = ( $pagesize > 0 ) ? $pagesize : $this->config->item('per_page');
			  $offset                   =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;        
			  $base_url                 =  current_url_query_string(array('filter'=>'result'),array('per_page'));			  
			  $uid 						= $this->uri->segment(3);
			  $config['total_rows']		   = $this->home_model->countPlans($uid);
			  $udrID                     =$this->home_model->getUserInfo($uid);			
				if($uid!='')
				{
				$condition['user_id']        =$uid;				
				}				
				$res                             = $this->home_model->get_postTime($config['limit'],$offset,$condition);
				$data['page_links']            = pagination_refresh($base_url,$config['total_rows'],$config['limit'],$offset);	
				//print_r($data['page_links']); die;
				$data['res']					   = $res;			
			  $data["user"]                 	= $udrID;		  
			  $this->load->view('home/timeline_view',$data);
			}
			else
			{
				redirect(site_url('user/login'));
			}
		}
		/* Fetch City Value From Dtabase  */
		 
		public function getState(){
			$this->load->model(array('home/home_model'));
			$id = $this->input->get_post('country_id');
			$data1 = $this->home_model->getStateModel($id);
			if(!empty($data1)){
				$str='';
				$str.= '<option value="0">Select City</option>';
				foreach($data1 as $dat){
					$str.= '<option value="'.$dat->city.'" >'.$dat->city.'</option>';
				}
				echo $str;
			}
		}		
	
	public function SearchHome() {	
        $term = $this->input->get('term');       
        $query = $this->home_model->getCityCountry($term);
        $result= $query->result();
		$return = array();		
		foreach ($result as $row):
        $val=$row->city.'-'.$row->country_name;
			array_push($return, array("id"=>$row->id, "label"=>$val, "value" =>$row->id));
        endforeach;
		echo json_encode($return);
    }
	
	
		public function searchcountry()
		{
		$term 	= $this->input->get('term');
		$query 	= $this->home_model->getCountry($term);		
		$result	= $query->result();
		$return = array();
		foreach ($result as $row):        
		array_push($return, array("id"=>$row->country_name, "label"=>$row->country_name, "value" =>$row->country_id));
        endforeach;
		echo json_encode($return);
		}
		
		public function searchcity()
		{
		$term 	= $this->input->get('term');
		$query 	= $this->home_model->getCity($term);		
		$result	= $query->result();
		$return = array();
		foreach ($result as $row):
        $val=$row->city;
		array_push($return, array("id"=>$row->city, "label"=>$row->city, "value" =>$row->id));
        endforeach;
		echo json_encode($return);
		}
		
		



public function google_login(){

    
require_once ('./Google/autoload.php');

//Insert your cient ID and secret 
//You can get it from : https://console.developers.google.com/
$client_id = '275051798909-hpnc2fr3dpc0ep08p6ddab1nrdbta63m.apps.googleusercontent.com'; 
$client_secret = 'rtp3S8YWzsse2nnISU14jwA_';
$redirect_uri = 'https://gobarra.com/home/google_login/';
/*$redirect_uri = 'https://gobarra.com/home/google_login/';*/

 	


//incase of logout request, just unset the session var
/*if (isset($_GET['logout'])) {
  unset($_SESSION['access_token']);
}*/

/************************************************
  Make an API request on behalf of a user. In
  this case we need to have a valid OAuth 2.0
  token for the user, so we need to send them
  through a login flow. To do this we need some
  information from our API console project.
 ************************************************/

$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope("email");
$client->addScope("profile");


/************************************************
  When we create the service here, we pass the
  client to it. The client then queries the service
  for the required scopes, and uses that when
  generating the authentication URL later.
 ************************************************/
$service = new Google_Service_Oauth2($client);

/*print_r($redirect_uri);
  die;
*/
/************************************************
  If we have a code back from the OAuth 2.0 flow,
  we need to exchange that with the authenticate()
  function. We store the resultant access token
  bundle in the session, and redirect to ourself.
*/
  
if (isset($_GET['code'])) {

  $client->authenticate($_GET['code']);
  /*echo "dsjkhfs";
  print_r($client); die;*/
  $_SESSION['access_token'] = $client->getAccessToken();
  /* echo  $_SESSION['access_token']; die;
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
  exit;*/
}



/************************************************
  If we have an access token, we can make
  requests, else we generate an authentication URL.
 ************************************************/
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);


} else {
  $authUrl = $client->createAuthUrl();
}

if (isset($authUrl)){ 
	//show login url
	

	redirect($authUrl);
	
} else {
	
	$user = $service->userinfo->get(); //get user info 

	  if(!$this->home_model->getGoogleUser($user->id)){

            
              $this->home_model->createGoogleUser($user->id,$user->name,$user->email,$user->picture);

                       set_cookie('userName',$user->email, time()+60*60*24*30 );
                        /*set_cookie('pwd',$this->input->post('password'), time()+60*60*24*30 );*/
                          $data = array(
				              'email' => $user->email,
				              'is_logged_in'=> TRUE
			                    );
			               $this->session->set_userdata($data);
			               $this->session->set_flashdata('item', array('message' => 'Login Successfully','class' => 'success'));
			               redirect('home');

	      }

	      else{

              $data = array(
				              'email' => $user->email,
				              'is_logged_in'=> TRUE
			                    );
			               $this->session->set_userdata($data);
			               $this->session->set_flashdata('item', array('message' => 'Login Successfully','class' => 'success'));
			               redirect('home');

	      }

	
  }
 }


public function set_session($user)
		  {
		     
		       
		    $session_data = array(
		        'username'             => $user['name'],
		        'email'                => $user['email'],
		        'user_id'              => $user['id'] //everyone likes to overwrite id so we'll use user_id
		        
		    );
		     
		    $this->session->set_userdata($session_data);
		    
		    return TRUE;
		  }







public function facebook_login()
{

include_once("./facebook/inc/facebook.php"); //include facebook SDK
######### Facebook API Configuration ##########
$appId = '266150530435918'; //Facebook App ID
$appSecret = '8a40cba44c6c71e03332174a7e60f80c'; // Facebook App Secret
$homeurl = 'https://gobarra.com/facebook/';  //return to home
$fbPermissions = 'email';  //Reomequired facebook permissions

//Call Facebook API
$facebook = new Facebook(array(
  'appId'  => $appId,
  'secret' => $appSecret

));
  $fbuser=null;
$fbuser = $facebook->getUser();
  
 

if(!$fbuser){
	$fbuser = null;
	$loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$homeurl,'scope'=>$fbPermissions));

	  redirect($loginUrl);
	$output = '<a href="'.$loginUrl.'"><img src="images/fb_login.png"></a>'; 	
}

else{
	/*$user_profile = $facebook->api('/me?fields=id,first_name,last_name,email,gender,locale,picture');

	  print_r($user_profile); die;*/

	  redirect('home');

 }




 }
 public function facebook_login_do(){

        

      if(!$this->home_model->getFacebookUser()){
            
          
              
              $this->home_model->createFacebookUser();

                       set_cookie('userName',$_SESSION["email"], time()+60*60*24*30 );
                        /*set_cookie('pwd',$this->input->post('password'), time()+60*60*24*30 );*/
                          $data = array(
				              'email' =>  $_SESSION["email"],
				              'is_logged_in'=> TRUE
			                    );
			               $this->session->set_userdata($data);
			               $this->session->set_flashdata('item', array('message' => 'Login Successfully','class' => 'success'));
			               redirect('home');

       
      }else{

            $data = array(
				              'email' =>  $_SESSION["email"],
				              'is_logged_in'=> TRUE
			                    );
			               $this->session->set_userdata($data);
			               $this->session->set_flashdata('item', array('message' => 'Login Successfully','class' => 'success'));
			               redirect('home');
      }



 }




}
