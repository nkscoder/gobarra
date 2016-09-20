<?php
class Country extends Admin_Controller
{

	public function __construct(){
	
			parent::__construct();
			
		    $this->config->set_item('menu_highlight','Other management');	
			$this->load->model(array('country_model')); 	
	
	}
	
	   public  function index()
	   {		 
			$pagesize               =  (int) $this->input->get_post('pagesize');
			
			$config['limit']	    =  ( $pagesize > 0 ) ? $pagesize : $this->config->item('pagesize');
			
			$offset                 =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;	
			
			$base_url               =  current_url_query_string(array('filter'=>'result'),array('per_page'));
										
			$res_array              =  $this->country_model->get_country($offset,$config['limit']);
			
			$config['total_rows']	= $this->country_model->total_rec_found;	
			
			$data['page_links']     =  admin_pagination("$base_url",$config['total_rows'],$config['limit'],$offset);
			
			$data['heading_title']  =   'Manage Country';
			
			$data['res']            =  $res_array; 
			
			
			if($this->input->post('status_action')!='')
			{
			
			$this->update_status('tbl_country','country_id');
			
			}		
			
			$this->load->view('country/view_country_list',$data);	
		      
			
		
	    }
		
		
		public function add()
		{				
			$data['heading_title'] = 'Add country';			
			$this->form_validation->set_rules('country_name','Country Name',"trim|required|max_length[50]|xss_clean|unique[tbl_country.country_name='".$this->db->escape_str($this->input->post('country_name'))."' AND status!='2']");
			$this->form_validation->set_rules('country_name','Country Name',"trim|required|max_length[50]|xss_clean|unique");			
			if($this->form_validation->run()==TRUE)
			{	
				$posted_data = array( 'country_name'		=>	$this->input->post('country_name',TRUE),
									  'sortname'			=>	$this->input->post('sortname',TRUE)
				                      );
				
				$this->country_model->safe_insert('tbl_country',$posted_data,FALSE);
				$this->session->set_userdata(array('msg_type'=>'success'));
				$this->session->set_flashdata('success',lang('success'));		
				redirect('adminzone/country', '');
			}
			$this->load->view('country/view_country_add',$data);		
	   }
	   public function edit()
	   {
		    $data['heading_title'] = 'Edit Country';
			$Id = (int) $this->uri->segment(4);
			$rowdata=$this->country_model->get_country_by_id($Id);
		  if( is_object($rowdata) )
		  { 
				$this->form_validation->set_rules('country_name','Country Name',"trim|required|xss_clean|max_length[50]|[tbl_country.country_name='".$this->db->escape_str($this->input->post('country_name'))."' AND status!='2' AND country_id!='".$Id."']");
				$this->form_validation->set_rules('country_name','Country Name',"trim|required|xss_clean|max_length[50]");
				if($this->form_validation->run()==TRUE)
				{
					$posted_data = array( 'country_name'=>$this->input->post('country_name',TRUE),
						 				   'sortname'=>$this->input->post('sortname',TRUE),
										 	);						
						$where = "country_id = '".$rowdata->country_id."'"; 						
						$this->country_model->safe_update('tbl_country',$posted_data,$where,FALSE);	
						$this->session->set_userdata(array('msg_type'=>'success'));
						$this->session->set_flashdata('success',lang('successupdate'));		
						redirect('adminzone/country/'.query_string(), '');				
				}								
			    $data['res']=$rowdata;
			    $this->load->view('country/view_country_edit',$data);				
		   }else{			   
			  redirect('adminzone/country', '');			   
		   }		   
	   }
	  public function uploads_country()
	{
		$data['heading_title']	=	'Bulk Upload Country';
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
						$check_exist="SELECT * FROM tbl_country WHERE country_name='".$country_name."' ";
						$query_num=$this->db->query($check_exist);
						if($query_num->num_rows === 0)
						{
							$data = array(
										'country_name'				=>	$country_name,										
										'status' 					=>  '1',
										'xls_type' 					=>  'Y',
									);
							 $this->country_model->safe_insert('tbl_country',$data,FALSE);
					}
					}
					$this->session->set_userdata(array('msg_type'=>'success'));
					$this->session->set_flashdata('success',lang('success')); 
					redirect('adminzone/country/uploads_country', '');
					
				}
				else
				{
					$this->form_validation->_error_array['image']='Uploading Failed.Please Try Again';	  
				}				
			}
		}
		$this->load->view('country/view_bulk_upload',$data);
	} 	
}
//controllet end