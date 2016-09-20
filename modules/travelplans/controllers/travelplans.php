<?php
class Travelplans extends Public_Controller
{
  public function __construct()
  {
    parent::__construct();        
    $this->load->model(array('travelplans/travelplans_model','user/users_model'));
    $this->load->helper(array('form','url'));
    $this->load->library('pagination');
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters("<div class='required'>","</div>");
  }

  public function index() {
    if ($this->session->userdata('is_logged_in')) {              
      redirect('travelplans/planschedul');
    } else {
      $data['main_content'] = 'home';    
      $this->load->view('home', $data);  
    }
  }
  
  /*functions for add ,edit and Plan Listing*/
  
  public function planschedul()
  {
	if ($this->session->userdata('is_logged_in')) {
	$this->load->model('user/users_model');
    $this->form_validation->set_rules('travel_from','Travel From','trim|required|xss_clean|max_length[80]');
    $this->form_validation->set_rules('travel_to','Travel To','trim|required|xss_clean|max_length[100]');
    $this->form_validation->set_rules('from_date','From Date','trim|required|xss_clean|max_length[80]');
    $this->form_validation->set_rules('to_date','To Date','trim|required|xss_clean|max_length[500]');      
    $email=$this->session->userdata('email');
      $udrID=$this->travelplans_model->getUserID($email);
      $ID=$udrID[0]->user_id;
	  
	  //$travel_from = $this->input->post('travel_from');	  
	  //$travel_form_city = explode("-", $travel_from);
	  //$cityfromId = $this->travelplans_model->getCity($travel_form_city[0]);
	  //$fromId =	$cityfromId[0]['id'] ;
	  
	  // $travel_to = $this->input->post('travel_to');
	  // $travel_to_city = explode("-", $travel_to);
	  // $citytoId = $this->travelplans_model->getCity($travel_to_city[0]);
	  // $toId =	$citytoId[0]['id'] ;
	  $descrp = $this->input->post('description',TRUE);
	  $textToStore = nl2br(htmlentities($descrp, ENT_QUOTES, 'UTF-8'));	
   if($this->form_validation->run()==TRUE)
    {
		
      $posted_data =array(
        'travel_from'     =>  $this->input->post('travel_from'),
        'travel_to'       =>  $this->input->post('travel_to'),
        'from_date'       =>  $this->input->post('from_date'),
        'to_date'         =>  $this->input->post('to_date'),
        'description'     =>  $textToStore,		
        'user_id'         => $ID,
        );
	 // print_r($posted_data); die;
      $this->travelplans_model->safe_insert('tbl_travel_plans',$posted_data,FALSE);
      $this->session->set_flashdata('item', array('message' => 'Plan Added successfully','class' => 'success'));
      redirect('travelplans/planschedul');
    }
      $condition                     = array();
      $pagesize                      = (int) $this->input->get_post('pagesize');
      $config['limit']         = ( $pagesize > 0 ) ? $pagesize : $this->config->item('per_page');
      $offset                 	   =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;				
	    $base_url               	   =  current_url_query_string(array('filter'=>'result'),array('per_page'));
		if( $this->input->post('status_action')!='')
				{			
					$this->update_status('tbl_travel_plans','travel_id');			
				}
	  $email                         =$this->session->userdata('email');
      $udrID                         =$this->travelplans_model->getUserID($email);
      $ID=$udrID[0]->user_id;
      if($ID!='')
      {
        $condition['user_id']        =$ID;
      }
      $results       				= $this->travelplans_model->get_dashbord_pln($config['limit'],$offset,$condition);
      $config['total_rows']		   	= $this->travelplans_model->record_count($ID);		 
      $data['page_links']           = pagination_refresh("$base_url",$config['total_rows'],$config['limit'],$offset);
      $data["results"]              = $results;	     
      $data['userData']			   	= $this->users_model->getuserDetail($ID);
	  $data['plan']					= $this->travelplans_model->userPlan($ID);
		//print_r($data['plan']); die;
	  $this->load->view('travelplans/travelplans_add_view',$data);
  } else
  {
  $this->load->view('user/login');	
  }
  }
  
	public function editPlan()
	{
		if($this->session->userdata('is_logged_in'))
		{
		$TravelId = (int) $this->uri->segment(3);
		$res = $this->travelplans_model->get_plans(1,0,array('travel_id'=>$TravelId));	
		if(  is_array($res) && !empty($res) )
		{ 
		$this->form_validation->set_rules('travel_from','Travel From','trim|required|xss_clean|max_length[80]');
		$this->form_validation->set_rules('travel_to','Travel To','trim|required|xss_clean|max_length[100]');
		$this->form_validation->set_rules('from_date','From Date','trim|required|xss_clean|max_length[80]');
		$this->form_validation->set_rules('to_date','To Date','trim|required|xss_clean|max_length[500]');
		
	  // $travel_from = $this->input->post('travel_from');
	  // $travel_form_city = explode("-", $travel_from);
	  // $cityfromId = $this->travelplans_model->getCity($travel_form_city[0]);
	  // $fromId =	$cityfromId[0]['id'] ;
	  
	  // $travel_to = $this->input->post('travel_to');
	  // $travel_to_city = explode("-", $travel_to);
	  // $citytoId = $this->travelplans_model->getCity($travel_to_city[0]);
	  // $toId =	$citytoId[0]['id'] ;
	  $descrp = $this->input->post('description',TRUE);
	  $textToStore = nl2br(htmlentities($descrp, ENT_QUOTES, 'UTF-8'));	
		if($this->form_validation->run()==TRUE)
		{
		$posted_data = array(
		'travel_from'     =>  $this->input->post('travel_from'),
        'travel_to'       =>  $this->input->post('travel_to'),
        'from_date'       =>  $this->input->post('from_date'),
        'to_date'         =>  $this->input->post('to_date'),
        'description'     =>  $textToStore,
			);
		$where = "travel_id = '".$res['travel_id']."'";
		$this->travelplans_model->safe_update('tbl_travel_plans',$posted_data,$where,FALSE);		
		$this->session->set_flashdata('item', array('message' => 'Plan Updated Successfully','class' => 'success'));	
		redirect('travelplans/planschedul'.query_string(), '');
		}
		$data['res']=$res;	
		$this->load->view('travelplans/edit_plan_view',$data);
		}
	 else
	   {
		  redirect('travelplans/', ''); 	 
	   }
		}
		else
		{
		$this->load->view('user/login');	
		}
	}
  
  	public function autocomplete() {
        $term = $this->input->get('term');       
        $query = $this->travelplans_model->getCityCountry($term);
        $result= $query->result();
		$return = array();
		foreach ($result as $row):
        $val=$row->city.'-'.$row->country_name;
			array_push($return, array("id"=>$row->city,"label"=>$val, "value" =>$val));           		
        endforeach;
		echo json_encode($return);
    }
}