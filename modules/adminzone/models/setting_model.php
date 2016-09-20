<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Setting_model extends MY_Model{

   public function __construct()
   {
   
     parent::__construct();
     
    }

	public function get_admin_info($id){
		
		$id = (int) $id;
		
		if($id!='' && is_numeric($id)){
			
		    $condtion = "admin_id = $id";			
			$fetch_config = array(
							  'condition'=>$condtion,							 					 
							  'debug'=>FALSE,
							  'return_type'=>"object"							  
							  );
			
			$result = $this->find('tbl_admin',$fetch_config);
			return $result;	
			
		}
		
	}
	
	
	
	public function update_info($old_pass,$id){
		
		 $cond = "admin_id =$id AND admin_password ='$old_pass' ";
		 $num_row = $this->findCount('tbl_admin',$cond);		
		
		if( $num_row > 0 ) { 
		
			$data     = array('admin_password'=>$this->input->post('new_pass',TRUE),
							  'admin_email'=>$this->input->post('admin_email',TRUE),
							   'address'=>$this->input->post('address',TRUE),
							 );	
			
			$where = "admin_id=".$id." ";
			$this->safe_update('tbl_admin',$data,$where,FALSE);		
			$this->session->set_userdata('msg_type',"success" ); 
			$this->session->set_flashdata('success',lang('successupdate') ); 
		   
		
		 }else{			
			
		   $this->session->set_userdata(array('msg_type'=>'error'));
		   $this->session->set_flashdata('error',lang('password_incorrect'));		
			
		 }	
		 
	
	}
	
	
	
	

}
// model end here