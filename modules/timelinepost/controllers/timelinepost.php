<?php
  class Timelinepost extends Public_Controller
  {
    public function __construct()
    {
      parent::__construct();
      $this->load->library('form_validation');
      $this->load->helper(array('form', 'url'));
      $this->load->model(array('timelinepost/timeline_model','home/home_model','admin_products/products_model'));
    }
    public function index() {
      if ($this->session->userdata('is_logged_in')) {  
        redirect('timelinepost/timeline');
      } else {    
        $this->load->view('user/login');  
      }
    }
/*TimeLine function  start here*/

    public function timeline()
    {
			if ($this->session->userdata('is_logged_in')) {
			$this->form_validation->set_rules('description','Description','trim|required|xss_clean|max_length[1000]');    
			$email=$this->session->userdata('email');
			$udrID=$this->timeline_model->get_userid($email);
			$ID=$udrID[0]->user_id; 
			$descrp = $this->input->post('description',TRUE);
			$textToStore = nl2br(htmlentities($descrp, ENT_QUOTES, 'UTF-8'));		  
		  if($this->form_validation->run()==TRUE)
		  {
		   $posted_data=array(
			'description'     	=>  $textToStore,
			'user_id'         	=>  $ID,
			'created'			=>	date('Y-m-d H:i:s'),	
			'type'				=> '2',	
		  );      
		  $this->timeline_model->safe_insert('tbl_travel_plans',$posted_data,FALSE);       
		  $this->session->set_flashdata('item', array('message' => 'Timeline Posted successfully','class' => 'success'));       
		 redirect('timelinepost/timeline');
		 }
		  $condition                =array();
		  $pagesize                 =(int) $this->input->get_post('pagesize');
		  $config['limit']          =( $pagesize > 0 ) ? $pagesize : $this->config->item('per_page');
		  $offset                   =( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;        
		  $base_url                 =current_url_query_string(array('filter'=>'result'),array('per_page'));
		  $email                    =$this->session->userdata('email');
		  $usrID                    =$this->timeline_model->get_userid($email);
		  $ID=$usrID[0]->user_id;
		  if($ID!='')
		  {
			$condition['user_id']   =$ID;
		  }
		  $udrID                    =$this->home_model->getUserInfo($ID);
		  $res                      = $this->timeline_model->get_postTime($config['limit'],$offset,$condition);
		  $config['total_rows']		   = $this->timeline_model->record_count($ID);
		  $data['page_links']            = pagination_refresh("$base_url",$config['total_rows'],$config['limit'],$offset);	
		 if( $this->input->post('status_action')!='')
				{			
					$this->update_status('tbl_travel_plans','travel_id');			
				}
		$data['res']			= $res;
		$data["userData"]       = $udrID;				
		$this->load->view('timelinepost/timeline_add_view',$data);
		}
		else
		{
			redirect(site_url('user/login'));
		}
	}
	
	/*function for editpost  */
	
	public function editpost()
	   {		   
			$email                    =$this->session->userdata('email');
			$usrID                    =$this->timeline_model->get_userid($email);
			$ID=$usrID[0]->user_id;
			$data['heading_title'] = 'Edit Post';
			$Id = (int) $this->uri->segment(4);
			$rowdata=$this->timeline_model->get_plan_by_id($Id);			
		  if( is_object($rowdata) )
		  { 
				$this->form_validation->set_rules('description','Description','trim|required|xss_clean|max_length[1000]');
				$descrp = $this->input->post('description',TRUE);
				$textToStore = nl2br(htmlentities($descrp, ENT_QUOTES, 'UTF-8'));
				if($this->form_validation->run()==TRUE)
				{	
					$posted_data	 		= array(		
					'description'    	 	=>  $textToStore,
					'created'				=>	date('Y-m-d H:i:s')
				                      );
						$where = "travel_id = '".$rowdata->travel_id."'"; 						
						$this->timeline_model->safe_update('tbl_travel_plans',$posted_data,$where,FALSE);	
						$this->session->set_flashdata('item', array('message' => 'Timeline Updated Successfully','class' => 'success'));
						redirect('timelinepost/timeline'.query_string(), '');
				}								
			    $data['res']=$rowdata;
				$udrID                    =$this->home_model->getUserInfo($ID);
				$data["userData"]         = $udrID;
			    $this->load->view('timelinepost/edit_post_view',$data);
		   }else{
			  redirect('timelinepost/timeline', '');	   
		   }
	   }
	
	/*more products form the users start here*/
		public function more_products_user()
		{
			if($this->session->userdata('is_logged_in'))
			{
			$this->load->model('user/Users_model');
			$config			 = array();
			$pagesize        = (int) $this->input->get_post('pagesize');
			$config['limit'] = ( $pagesize > 0 ) ? $pagesize : $this->config->item('per_page');
			$offset          = ($this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;				
			$base_url        =  current_url_query_string(array('filter'=>'result'),array('per_page'));			
			$email           =$this->session->userdata('email');
			$udrID           =$this->timeline_model->get_userid($email);
			$ID=$udrID[0]->user_id; 
			
			if($ID!='')
			{
			$condition['user_id']=	$ID;
			}
			$res_array				   	   = $this->products_model->get_admin_products($config['limit'],$offset,$condition);
			$config['total_rows']		   = $this->home_model->record_count1($ID);
			$data['page_links']            = pagination_refresh("$base_url",$config['total_rows'],$config['limit'],$offset);	
			$data['res_array']             = $res_array;			
			$userifo                       = $this->home_model->getUserInfo($ID);
			$data['userifo']			   = $userifo;	  
			$this->load->view('timelinepost/view_more_products_user',$data);	
			}
			else
			{
			redirect(site_url('user/login'));	
			}
		}
		/*more products form the users end here*/
 }