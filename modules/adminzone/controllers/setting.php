<?php
class Setting extends Admin_Controller {

	 public function __construct() {
			
			
			parent::__construct(); 
			$this->load->helper('ckeditor');		
			$this->load->model(array('adminzone/setting_model'));  
	 }
	 
	 public  function index($page = null){	
	         
		 $data['heading_title'] = 'Admin Setting';	
		
		 $data['admin_info'] = $this->setting_model->get_admin_info(1);		
		 $this->load->view('dashboard/setting_edit_view',$data);

		
	   }
	   
	   public function edit(){
		   
		       $this->form_validation->set_rules('old_pass', 'Old Password', 'required');
			   $this->form_validation->set_rules('new_pass', 'New Password', 'required|valid_password');
			   $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_pass]');			   
			   $this->form_validation->set_rules('admin_email', 'Email ID',  'required|valid_email');
			   $this->form_validation->set_rules('address', 'Address',  'trim|required');
				
			 if ($this->form_validation->run() == TRUE)
			 {
				  
			     $this->setting_model->update_info( $this->input->post('old_pass'),'1' ) ;				 	
			     redirect('adminzone/setting/','');
			   
			  }
			  
			 $data['heading_title'] = 'Admin Setting'; 
			 $data['admin_info'] = $this->setting_model->get_admin_info(1);		
		     $this->load->view('dashboard/setting_edit_view',$data);  
		
	   }
	   
}
// End of controller