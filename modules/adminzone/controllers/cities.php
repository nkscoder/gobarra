<?php
class Cities extends Admin_Controller
{
	public function __construct(){	
			parent::__construct();			
		    $this->config->set_item('menu_highlight','Other management');	
			$this->load->model(array('cities_model'));
	}	
	   public  function index()
	   {		 
			$pagesize               =  (int) $this->input->get_post('pagesize');
			$config['limit']	    =  ( $pagesize > 0 ) ? $pagesize : $this->config->item('pagesize');
			$offset                 =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;	
			$base_url               =  current_url_query_string(array('filter'=>'result'),array('per_page'));
			$res_array              =  $this->cities_model->get_city($offset,$config['limit']);
			$config['total_rows']	= $this->cities_model->total_rec_found;	
			$data['page_links']     =  admin_pagination("$base_url",$config['total_rows'],$config['limit'],$offset);
			$data['heading_title']  =   'Manage Cities';
			$data['res']            =  $res_array;
			if($this->input->post('status_action')!='')
			{
			$this->update_status('tbl_cities','id');
			}		
			$this->load->view('cities/view_cities_list',$data);	
	    }
		public function add()
		{				
			$data['heading_title'] = 'Add City';			
			$this->form_validation->set_rules('city','City Name',"trim|required|max_length[50]|xss_clean|");
			$this->form_validation->set_rules('country_id','Country Id',"trim|required|max_length[50]|xss_clean|");	
			if($this->form_validation->run()==TRUE)
			{				
				$posted_data = array( 'city'				=>	$this->input->post('city',TRUE),
									  'country_id'			=>	$this->input->post('country_id',TRUE),
				                      );
				$this->cities_model->safe_insert('tbl_cities',$posted_data,FALSE);
				$this->session->set_userdata(array('msg_type'=>'success'));
				$this->session->set_flashdata('success',lang('success'));		
				redirect('adminzone/cities', '');
			}
			$this->load->view('cities/view_cities_add',$data);
	   }
	   public function edit()
	   {
		    $data['heading_title'] = 'Edit City';
			$Id = (int) $this->uri->segment(4);
			$rowdata=$this->cities_model->get_city_by_id($Id);			
		  if( is_object($rowdata) )
		  { 
				$this->form_validation->set_rules('city','City Name',"trim|required|xss_clean|max_length[100]");
				$this->form_validation->set_rules('country_id','Country Id',"trim|required|xss_clean|max_length[50]|numeric");
				if($this->form_validation->run()==TRUE)
				{	
					$posted_data = array( 'city'=>$this->input->post('city',TRUE),
										  'country_id'=>$this->input->post('country_id',TRUE),
				                      );
						$where = "id = '".$rowdata->id."'"; 						
						$this->cities_model->safe_update('tbl_cities',$posted_data,$where,FALSE);	
						$this->session->set_userdata(array('msg_type'=>'success'));
						$this->session->set_flashdata('success',lang('successupdate'));		
						redirect('adminzone/cities/'.query_string(), '');
				}								
			    $data['res1']=$rowdata;
			    $this->load->view('cities/view_cities_edit',$data);
		   }else{
			  redirect('adminzone/cities', '');	   
		   }
	   }
}
//controllet end