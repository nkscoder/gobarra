<?php
class Candidate_file extends Admin_Controller
{

	public function __construct(){
	
			parent::__construct();
			
		    $this->config->set_item('menu_highlight','candidate management');	
			$this->load->model(array('candidate_file_model')); 	
	
	}
	
	   public  function index()
	   {		 
			$pagesize               =  (int) $this->input->get_post('pagesize');
			
			$config['limit']	    =  ( $pagesize > 0 ) ? $pagesize : $this->config->item('pagesize');
			//$config['overwrite']	= FALSE;			
			$offset                 =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;	
			
			$base_url               =  current_url_query_string(array('filter'=>'result'),array('per_page'));
										
			$res_array              =  $this->candidate_file_model->get_candidate($offset,$config['limit']);
			
			$config['total_rows']	= $this->candidate_file_model->total_rec_found;	
			
			$data['page_links']     =  admin_pagination("$base_url",$config['total_rows'],$config['limit'], $offset);
			
			$data['heading_title']  =   'Manage Candidate';
			
			$data['res']            =  $res_array;

			//print_r($res_array); die(); 
			//echo_sql($res_array); die();
			
			if($this->input->post('status_action')!='')
			{
			
			$this->update_status('wl_candidate','candidate_id');
			
			}		
			
			$this->load->view('candidate/view_candidate_list',$data);	
		      
			
		
	    }
		
		
		public function add()
		{				
			$data['heading_title'] = 'Add Candidate';			
			$this->form_validation->set_rules('candidate_name','Candidate Name',"trim|required|max_length[50]|xss_clean");
			$this->form_validation->set_rules('email_id','Email',"trim|required|valid_email|max_length[100]|callback_email_check");
			$this->form_validation->set_rules('contact','Contact No.',"trim|required|max_length[50]|xss_clean");
			$this->form_validation->set_rules('gender','Gender',"trim|required|max_length[50]|xss_clean");
			$this->form_validation->set_rules('designation','Designation Name',"trim|required|max_length[50]|xss_clean");
			$this->form_validation->set_rules('experience','Experience',"trim|required|max_length[50]|xss_clean");
			$this->form_validation->set_rules('salary','Salary',"trim|required|max_length[50]|xss_clean");
			//$this->form_validation->set_rules('current_education','Education',"trim|required|max_length[50]|xss_clean");
			$this->form_validation->set_rules('state','State',"trim|required|max_length[50]|xss_clean");
			$this->form_validation->set_rules('city','City',"trim|required|max_length[50]|xss_clean");
			$this->form_validation->set_rules('created_date','Created Date',"trim|required|max_length[50]|xss_clean");
			$this->form_validation->set_rules('modified_date','Modified Date',"trim|required|max_length[50]|xss_clean");
			
			
			if($this->form_validation->run()==TRUE)
			{
			$posted_data = array( 	'candidate_name'		=>	$this->input->post('candidate_name',TRUE),
				                    'email_id'				=>	$this->input->post('email_id',TRUE),
				                    'contact'				=>	$this->input->post('contact', TRUE),
				                    'gender'				=>	$this->input->post('gender',TRUE),
				                    'designation'			=>	$this->input->post('designation',TRUE),
				                    'experience'			=>	$this->input->post('experience',TRUE),
				                    'salary'				=>	$this->input->post('salary',TRUE),
				                    //'current_education'		=>	$this->input->post('current_education',TRUE),
				                    'state'					=>	$this->input->post('state',TRUE),
				                    'city'					=>	$this->input->post('city',TRUE),              		
				                    'created_date'			=>	$this->input->post('created_date',TRUE),
				                    'modified_date'			=>	$this->input->post('modified_date',TRUE),
				                      		
				                      );
				
				$this->candidate_file_model->safe_insert('wl_candidate',$posted_data,FALSE);
				$this->session->set_userdata(array('msg_type'=>'success'));
				$this->session->set_flashdata('success',lang('success'));		
				redirect('adminzone/candidate_file', '');
			}
							   
			$this->load->view('candidate/view_candidate_add',$data);		
	   
	   }
	   		public function valid_start_date()
		{		
			$start_date = $this->input->post('created_date');	
			$cdt        = $this->config->item('UTC');			
			$curdtsuv   = strtotime($cdt);
			$startdtsuv = strtotime($start_date);			
			
			if( $startdtsuv <  $curdtsuv )
			{			
				$this->form_validation->set_message("valid_start_date","Created date should not be less than current date.");
				return FALSE;
			
			}else
			{
				
			  return TRUE;	
			  
			}
		
		}
		
		
		public function valid_end_date()
		{
		
			$start_date = $this->input->post('created_date');
			$end_date   = $this->input->post('modified_date');
			
			$curdtsuv   = strtotime($start_date);
			$startdtsuv = strtotime($end_date);
			
			if( $startdtsuv <  $curdtsuv )
			{			
				$this->form_validation->set_message("valid_end_date","Modified date should not be less than created date.");
				return FALSE;
			
			}else
			{				
				return TRUE;
				
			}
		
		}
 
	   
	   public function edit()
	   {
		    $data['heading_title'] = 'Edit Candidate';
			$Id = (int) $this->uri->segment(4);
			$rowdata=$this->candidate_file_model->get_candidate_by_id($Id);
			
		  if( is_object($rowdata) )
		  { 
				$this->form_validation->set_rules('candidate_name','Candidate Name',"trim|required|max_length[50]|xss_clean");
				$this->form_validation->set_rules('email_id','Email',"trim|required|valid_email|max_length[100]|callback_email_check");
				$this->form_validation->set_rules('contact','Contact No.',"trim|required|max_length[50]|xss_clean");
				$this->form_validation->set_rules('gender','Gender',"trim|required|max_length[50]|xss_clean");
				$this->form_validation->set_rules('designation','Designation Name',"trim|required|max_length[50]|xss_clean");
				$this->form_validation->set_rules('experience','Experience',"trim|required|max_length[50]|xss_clean");
				$this->form_validation->set_rules('salary','Salary',"trim|required|max_length[50]|xss_clean");
				//$this->form_validation->set_rules('current_education','Education',"trim|required|max_length[50]|xss_clean");
				$this->form_validation->set_rules('state','State',"trim|required|max_length[50]|xss_clean");
				$this->form_validation->set_rules('city','City',"trim|required|max_length[50]|xss_clean");
				$this->form_validation->set_rules('created_date','Created Date',"trim|required|max_length[50]|xss_clean");
				$this->form_validation->set_rules('modified_date','Modified Date',"trim|required|max_length[50]|xss_clean");

				if($this->form_validation->run()==TRUE)
				{
					
					$posted_data = array( 	'candidate_name'		=>	$this->input->post('candidate_name',TRUE),
				                    		'email_id'				=>	$this->input->post('email_id',TRUE),
				                      		'contact'				=>	$this->input->post('contact', TRUE),
				                      		'gender'				=>	$this->input->post('gender',TRUE),
				                      		'designation'			=>	$this->input->post('designation',TRUE),
				                      		'experience'			=>	$this->input->post('experience',TRUE),
				                      		'salary'				=>	$this->input->post('salary',TRUE),
				                      		//'current_education'		=>	$this->input->post('current_education',TRUE),
				                      		'state'					=>	$this->input->post('state',TRUE),
				                      		'city'					=>	$this->input->post('city',TRUE),              		
				                      		'created_date'			=>	$this->input->post('created_date',TRUE),
				                      		'modified_date'			=>	$this->input->post('modified_date',TRUE),
				                      		
				                      );
						
						$where = "candidate_id = '".$rowdata->candidate_id."'"; 						
						$this->candidate_file_model->safe_update('wl_candidate',$posted_data,$where,FALSE);	
						$this->session->set_userdata(array('msg_type'=>'success'));
						$this->session->set_flashdata('success',lang('successupdate'));		
						redirect('adminzone/candidate_file/'.query_string(), ''); 	
				
				}
								
			    $data['res']=$rowdata;
			    $this->load->view('candidate/view_candidate_edit',$data);
				
		   }else{
			   
			  redirect('adminzone/candidate_file', ''); 	 
			   
		   }
		   
	   }

	   /*---------Bulk Upload Location---------*/
	public function uploads_candidate()
	{
		$data['heading_title']	=	'Bulk Upload Candidate';
		if($this->input->post('action')=='excel_file')
		{
			$this->form_validation->set_rules('excel_file','Upload Excel File','required|file_allowed_type[xls]');
			
			if($this->form_validation->run()==TRUE)
			{
				require_once FCPATH.'apps/third_party/Excel/reader.php';
				$data = new Spreadsheet_Excel_Reader();
				$data->setOutputEncoding('CP1251');
				
				//$data->setUTFEncoder('');
				chmod($_FILES["excel_file"]["tmp_name"], 0777);
				$data->read($_FILES["excel_file"]["tmp_name"]);
				$worksheet=$data->sheets[0]['cells'];
				//trace($worksheet);die();
				if(is_array($worksheet) && !empty($worksheet))
				{
					for($i=2;$i<=count($worksheet);$i++)
					{
										$candidate_name		=	(!isset($worksheet[$i][1])) ? '' : addslashes(trim($worksheet[$i][1]));
										$email_id			=	(!isset($worksheet[$i][2])) ? '' : addslashes(trim($worksheet[$i][2]));
										$contact			=	(!isset($worksheet[$i][3]))	? '' : addslashes(trim($worksheet[$i][3]));
										$gender				=	(!isset($worksheet[$i][4])) ? '' : addslashes(trim($worksheet[$i][4]));
										$designation		=	(!isset($worksheet[$i][5])) ? '' : addslashes(trim($worksheet[$i][5]));
										$experience			=	(!isset($worksheet[$i][6])) ? '' : addslashes(trim($worksheet[$i][6]));
										$salary				=	(!isset($worksheet[$i][7])) ? '' : addslashes(trim($worksheet[$i][7]));
										//$current_education	=	(!isset($worksheet[$i][8])) ? '' : addslashes(trim($worksheet[$i][8]));
										$city				=	(!isset($worksheet[$i][8])) ? '' : addslashes(trim($worksheet[$i][8]));
										$state				=	(!isset($worksheet[$i][9]))? '' : addslashes(trim($worksheet[$i][9]));
						
						
						$check_exist="SELECT * FROM wl_candidate WHERE candidate_name='".$candidate_name."' AND email_id='".$email_id."' ";
						$query_num=$this->db->query($check_exist);
						if($query_num->num_rows === 0)
						{
							$data = array(
										'candidate_name'			=>	$candidate_name,
										'email_id'					=>	$email_id,
										'contact'					=>	$contact,
										'gender'					=>	$gender,
										'designation'				=>	$designation,
										'experience'				=>	$experience,
										'salary'					=>	$salary,
										//'current_education'			=>	$current_education,
										'city'						=>	$city,
										'state'						=>	$state,
										'created_date'				=>	date_default_timezone_set("Asia/Kolkata"),
										'created_date'				=>	date_default_timezone_set("Asia/Kolkata"), 
										'status' 					=>  '1',
										'xls_type' 					=>  'Y',
									);
							 $this->candidate_file_model->safe_insert('wl_candidate',$data,FALSE);
					}
					}
					$this->session->set_userdata(array('msg_type'=>'success'));
					$this->session->set_flashdata('success',lang('success')); 
					redirect('adminzone/candidate_file/uploads_candidate', '');
					
				}
				else
				{
					$this->form_validation->_error_array['image']='Uploading Failed.Please Try Again';	  
				}				
			}
		}
		$this->load->view('candidate/view_bulk_upload',$data);
	}
	/*---------End Bulk Upload Location---------*/
}
//controllet end