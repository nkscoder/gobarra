<?php
		class Left_panel extends Admin_Controller
		{

			public function __construct()
			{
				parent::__construct(); 				
				$this->load->model(array('left_panel_model'));  			
				$this->config->set_item('menu_highlight','Panel Management');	
			}
			public  function index($page = NULL)
			{		
				$pagesize               =  (int) $this->input->get_post('pagesize');		
				$config['limit']		=  ( $pagesize > 0 ) ? $pagesize : $this->config->item('pagesize');			
				$offset                 =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;					
				$base_url               =  current_url_query_string(array('filter'=>'result'),array('per_page'));				
				$res_array              =  $this->left_panel_model->get_image($offset,$config['limit']);			
				$config['base_url']     =  base_url().'adminzone/left_panel/'; 		
				$config['total_rows']	=  $this->left_panel_model->total_rec_found;	
				$data['page_links']     =  admin_pagination($base_url,$config['total_rows'],$config['limit'],$offset);				
				$data['heading_title'] = 'Left Panel Ads';
				$data['res'] = $res_array; 		
				//print_r($res_array); die();
				//echo_sql($res_array); die();
				if( $this->input->post('status_action')!='')
				{			
					$this->update_status('tbl_left_ads','id');			
				}
				$this->load->view('left_panel/view_left_ads_list',$data);	
			} 
			/*
			public function add()
			{		  
				$data['heading_title'] = 'Add Image';
				$this->form_validation->set_rules('name','Name',"required|max_length[200]");
				$this->form_validation->set_rules('image','Image',"required|file_allowed_type[image]");
				$this->form_validation->set_rules('url','Iframe_url',"required|trim|max_length[256]|xss_clean|prep_url|valid_url_format|url_exists|callback_duplicate_URL_check||callback_checkwebsiteurl");
				$this->form_validation->set_rules('created_date','Created Date',"max_length[200]");
				$this->form_validation->set_rules('modified_date','Modified Date',"max_length[200]");
				if($this->form_validation->run()==TRUE)
				{
					$uploaded_file = "";	
					if( !empty($_FILES) && $_FILES['image']['name']!='' )
					{			  
						$this->load->library('upload');	
						$uploaded_data =  $this->upload->my_upload('image','left_panel');						
						if( is_array($uploaded_data)  && !empty($uploaded_data) )
						{ 								
							$uploaded_file = $uploaded_data['upload_data']['file_name'];							
						}
					}
					$posted_data = array(	
						'name'			=>$this->input->post('name'),
						'url'			=>$this->input->post('url'),				
						'created_date'	=>date('Y-m-d'),
						'modified_date'	=>date('Y-m-d'),
						'image'			=>$uploaded_file				
						);
						//print_r($posted_data); die();
					$this->left_panel_model->safe_insert('tbl_left_ads',$posted_data,FALSE);									
					$this->session->set_userdata(array('msg_type'=>'success'));			
					$this->session->set_flashdata('success',lang('success'));			
					redirect('adminzone/left_panel', '');				
				}				
				$this->load->view('left_panel/view_left_panel_add',$data);		  
			}
*/
			public function edit()
			{
				$Id = (int) $this->uri->segment(4);		   
				$data['heading_title'] = 'Update Images';			
				$rowdata=$this->left_panel_model->get_image_by_id($Id);
				if( is_object($rowdata) )
				{	$this->form_validation->set_rules('name','Name',"required|max_length[200]");			
					$this->form_validation->set_rules('image','Image',"required|file_allowed_type[image]");
					$this->form_validation->set_rules('url','Iframe Url',"required|trim|max_length[256]|xss_clean|prep_url|valid_url_format|url_exists|callback_duplicate_URL_check|callback_checkwebsiteurl");
					$this->form_validation->set_rules('created_date','Created Date',"max_length[200]");
					$this->form_validation->set_rules('modified_date','Modified Date',"max_length[200]");
					if($this->form_validation->run()==TRUE)
					{
						$uploaded_file = $rowdata->image;				 
						$unlink_image = array('source_dir'=>"left_panel",'source_file'=>$rowdata->image);
						if( !empty($_FILES) && $_FILES['image']['name']!='' )
						{			  
							$this->load->library('upload');					
							$uploaded_data =  $this->upload->my_upload('image','left_panel');
							if( is_array($uploaded_data)  && !empty($uploaded_data) )
							{ 								
								$uploaded_file = $uploaded_data['upload_data']['file_name'];
								removeImage($unlink_image);	
							}							
						}	
						$posted_data = array(					
							'name'			=>$this->input->post('name'),
							'url'			=>$this->input->post('url'),
							//'created_date'	=>date('Y-m-d H:i:s'),
							'modified_date'	=>date('Y-m-d'),
							'image'			=>$uploaded_file				
							);
						$where = "id = '".$rowdata->id."'"; 				
						$this->left_panel_model->safe_update('tbl_left_ads',$posted_data,$where,FALSE);						
						$this->session->set_userdata(array('msg_type'=>'success'));				
						$this->session->set_flashdata('success',lang('successupdate'));	
						redirect('adminzone/left_panel/'.query_string(), ''); 
					}
					$data['res']=$rowdata;
					$this->load->view('left_panel/view_left_panel_edit',$data);	
				}else
				{
					redirect('adminzone/left_panel', ''); 	 
				}			
			}	
			public function checkwebsiteurl($string_url)
			{
				$reg_exp = "@^(http\:\/\/|https\:\/\/)?([a-z0-9][a-z0-9\-]*\.)+[a-z0-9][a-z0-9\-]*$@i";
				if(preg_match($reg_exp, $string_url) == TRUE){
					return TRUE;
				}
				else{
					$this->form_validation->set_message('checkwebsiteurl', 'URL is invalid format');
					return FALSE;
				}
			}		
		}
		// End of controller