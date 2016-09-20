<?php
 class users extends Admin_Controller
 {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model(array('users_model'));
 		$this->config->set_item('menu_highlight','panel management');
 	}
 	public  function index()
	   {		 
			$pagesize               =  (int) $this->input->get_post('pagesize');
			$config['limit']	    =  ( $pagesize > 0 ) ? $pagesize : $this->config->item('pagesize');
			$offset                 =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;	
			$base_url               =  current_url_query_string(array('filter'=>'result'),array('per_page'));
			$res_array              =  $this->users_model->get_users($offset,$config['limit']);
			$config['total_rows']	= $this->users_model->total_rec_found;	
			$data['page_links']     =  admin_pagination("$base_url",$config['total_rows'],$config['limit'],$offset);
			$data['heading_title']  =   'Manage Users';
			$data['res']            =  $res_array;
			if($this->input->post('status_action')!='')
			{
			$this->update_status('users','ui_id');
			}		
			$this->load->view('users/list_users_view',$data);	
	    }
 } 