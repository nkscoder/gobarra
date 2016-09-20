<?php
class Admin_products extends Public_Controller {
	
		public function __construct() {
			parent::__construct(); 
			$this->load->model(array('admin_products/products_model'));
			$this->load->library('form_validation');
			$this->load->library('pagination');
			$this->load->helper(array('form','url'));
			$this->form_validation->set_error_delimiters("<div class='required'>","</div>");	
		}
		/*Function For Product Listing*/
		public function index() {	
			if($this->session->userdata('is_logged_in')){
				$this->load->model('user/Users_model');
				$config						   = array();
				$pagesize        = (int) $this->input->get_post('pagesize');
				$config['limit'] = ( $pagesize > 0 ) ? $pagesize : $this->config->item('per_page');
				$offset          = ($this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;				
				$base_url               	   =  current_url_query_string(array('filter'=>'result'),array('per_page'));
			if( $this->input->post('status_action')!='') {			
				$this->update_status('tbl_products','product_id');			
			}
				$email=$this->session->userdata('email');
				$udrID=$this->products_model->getUserID($email);
				$ID=$udrID[0]->user_id;
			if($ID!='') {
				$condition['user_id']=$ID;
			}
				$res_array		   	   = $this->products_model->get_products($config['limit'],$offset,$condition);
				$config['total_rows']		   = $this->products_model->record_count($ID);	
				$data['page_links']            = pagination_refresh("$base_url",$config['total_rows'],$config['limit'],$offset);	
				$data['res_array']             = $res_array;
				$data['userData']			   = $this->Users_model->getuserDetail($ID); 
				$this->load->view('admin_products/list',$data);
			}else {
				$this->load->view('user/login');	
			}
		}
		/*Function For Product Adding*/	
		public function add(){	
			if($this->session->userdata('is_logged_in')){
				$this->form_validation->set_rules('description','Description','trim|required|xss_clean|max_length[1500]');
				$this->form_validation->set_rules('product_name','Product Name','trim|required|xss_clean|max_length[500]');
				$this->form_validation->set_rules('country_name','Country','trim|required|xss_clean|max_length[80]');
				$this->form_validation->set_rules('city_name','City','trim|required|xss_clean|max_length[500]');	
				$email=$this->session->userdata('email');
				$udrID=$this->products_model->getUserID($email);
				$ID=$udrID[0]->user_id;
				//print_r($ID); die;
			if($this->form_validation->run()==TRUE) {			
				$target_path1="uploaded_files/product_image1/";
				$target_dir1 = $target_path1 . basename( $_FILES['img1']['name']);			
			if(move_uploaded_file($_FILES['img1']['tmp_name'], $target_dir1)) {
				$data['product_image1']=$target_dir1;
			}
				$target_path2="uploaded_files/product_image2/";
				$target_dir2 = $target_path2 . basename( $_FILES['img2']['name']);
			if(move_uploaded_file($_FILES['img2']['tmp_name'], $target_dir2)) {
				$data['product_image2']=$target_dir2;
			}
				$descrp = $this->input->post('description',TRUE);
				$country = $this->input->post('country_name');
				$Mycoutry = explode(',',$country);
				$countryName = $Mycoutry[0];
				$city = $this->input->post('city_name');
				$Mycity = explode(',',$city);
				$cityName = $Mycity[0];			
				$textToStore = nl2br(htmlentities($descrp, ENT_QUOTES, 'UTF-8'));
				
				$posted_data =array(				
					'user_id'					=> $ID,
					'description'      			=> $textToStore,
					'product_name'             	=> $this->input->post('product_name'),
					'country_id' 				=> $countryName,						
					'city_id'            		=> $cityName,
					'img1'						=> $_FILES['img1']['name'],
					'img2'						=> $_FILES['img2']['name'],
					'product_added_date'		=> date("Y-m-d H:i:s") );
				$this->products_model->safe_insert('tbl_products',$posted_data,FALSE);			
				$this->session->set_flashdata('item', array('message' => 'Product Added Successfully','class' => 'alert alert-success'));
				redirect('admin_products/add'); 			
				}		
				$data['heading_title'] = "Add Products";		
				$this->load->view('admin_products/add',$data);
			}else{
				$this->load->view('user/login');
			}
		}
		
		/*Function For Product edting*/

		public function edit() {
			if($this->session->userdata('is_logged_in')) {
				$data['heading_title'] = 'Edit Products';
				$Id = (int) $this->uri->segment(3);
				$res = $this->products_model->get_admin_products(1,0,array('product_id'=>$Id));				
			if(is_array($res) && !empty($res) ) { 		    
				$this->form_validation->set_rules('description','Description','trim|required|xss_clean|max_length[1500]');
				$this->form_validation->set_rules('product_name','Product Name','trim|required|xss_clean|max_length[500]');
				$this->form_validation->set_rules('country_name','Country Name','trim|required|xss_clean|max_length[80]');
				$this->form_validation->set_rules('city_name','City Name','trim|required|xss_clean|max_length[8500]');
				$email=$this->session->userdata('email');
				$udrID=$this->products_model->getUserID($email);
				$ID=$udrID[0]->user_id;
			if($this->form_validation->run()==TRUE) {
			if(($_FILES['img1']['name'] !='') || ($_FILES['img2']['name'] !='')) {
				$target_path1="uploaded_files/product_image1/";
				$target_dir1 = $target_path1 . basename( $_FILES['img1']['name']);
			if(move_uploaded_file($_FILES['img1']['tmp_name'], $target_dir1)) {
				$data['product_image1']=$target_dir1;
			}
				$target_path2="uploaded_files/product_image2/";
				$target_dir2 = $target_path2 . basename( $_FILES['img2']['name']);
			if(move_uploaded_file($_FILES['img2']['tmp_name'], $target_dir2)) {
				$data['product_image2']=$target_dir2;
			}
				$descrp = $this->input->post('description',TRUE);
				$textToStore = nl2br(htmlentities($descrp, ENT_QUOTES, 'UTF-8'));
				$country = $this->input->post('country_name');
				$Mycoutry = explode(',',$country);
				$countryName = $Mycoutry[0];
				$city = $this->input->post('city_name');
				$Mycity = explode(',',$city);
				$cityName = $Mycity[0];
			
				$posted_data = array(
					'description'      			=> $textToStore,
					'product_name'             	=> $this->input->post('product_name'),					
					'country_id' 				=> $countryName,						
					'city_id'            		=> $cityName,
					'img1'						=> $_FILES['img1']['name'],
					'img2'						=> $_FILES['img2']['name'],
					'product_update_date'		=> date("Y-m-d H:i:s") );
			}else {
				$country = $this->input->post('country_name');
				$Mycoutry = explode(',',$country);
				$countryName = $Mycoutry[0];
				$city = $this->input->post('city_name');
				$Mycity = explode(',',$city);
				$cityName = $Mycity[0];
				
				$posted_data = array(
					'description'      			=> $this->input->post('description',TRUE),
					'product_name'             	=> $this->input->post('product_name'),					
					'country_id' 				=> $countryName,						
					'city_id'            		=> $cityName,			
					'product_update_date'		=> date("Y-m-d H:i:s") );
			}
				$where = "product_id = '".$res['product_id']."'"; 						
				$this->products_model->safe_update('tbl_products',$posted_data,$where,FALSE);				
				$this->session->set_flashdata('item', array('message' => 'Product Updated Successfully','class' => 'success'));	
				 redirect('admin_products/'.query_string(), ''); 	
			}				
				$data['res']=$res;			   			   
				$this->load->view('admin_products/edit',$data);
		
			} else {
				redirect('admin_products/', ''); 	 
			} } else {
				$this->load->view('user/login');
			}
		}
	}
/* End of file pages.php */