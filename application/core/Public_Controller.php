<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Public_Controller extends MY_Controller
{
	public function __construct()
	{
		 
		 parent::__construct();	
		 $this->load->model('utils_model');    
		 	 
		
	}
	public function update_status($table,$auto_field='id')
	{		
		$action                = $this->input->post('status_action',TRUE);	
		$arr_ids               = $this->input->post('arr_ids',TRUE);
		$category_count        = $this->input->post('category_count',TRUE);
		$product_count         = $this->input->post('product_count',TRUE);	
		
		 if( is_array($arr_ids) )
         {
			  $str_ids = implode(',', $arr_ids);
			  
			  if($action=='Activate')
			  {				 
					  foreach($arr_ids as $k=>$v )
					  {
						   $total_category  = ( $category_count!='' ) ?  count_category("AND parent_id='$v' AND status='0'")     : '0';
						   $total_product   = ( $product_count!='' )  ?  count_products("AND category_id='$v' AND status='0'")   : '0';
						
							if( $total_category>0 || $total_product > 0 )
							{
								$this->session->set_userdata(array('msg_type'=>'error'));
								$this->session->set_flashdata('error',lang('child_to_activate'));
							
							}else
							{  
								$data = array('status'=>'1');
								$where = "$auto_field ='$v'";					
								$this->utils_model->safe_update($table,$data,$where,FALSE);
								//echo_sql();
								$this->session->set_flashdata('item', array('message' => 'Publish','class' => 'success'));	
								}	  
					  }	
			  }
			  
			  if($action=='Deactivate')
			  {	  
				      foreach($arr_ids as $k=>$v )
					  {
						 
						   $total_category  = ( $category_count!='' ) ?  count_category("AND parent_id='$v' AND status='1'")     : '0';
						   $total_product   = ( $product_count!='' )  ?  count_products("AND category_id='$v' AND status='1'")   : '0';
						
							if( $total_category>0 || $total_product > 0 )
							{
								$this->session->set_userdata(array('msg_type'=>'error'));
								$this->session->set_flashdata('error',lang('child_to_deactivate'));
							
							}else
							{  
								$data = array('status'=>'0');
								$where = "$auto_field ='$v'";					
								$this->utils_model->safe_update($table,$data,$where,FALSE);
								$this->session->set_flashdata('item', array('message' => 'Un-Publish','class' => 'success'));	
							
							}
						  
					  }	
			  }
			  
			  if($action=='Delete')
			  {
				  
				      foreach($arr_ids as $k=>$v )
					  {
						   $total_category  = ( $category_count!='' ) ?  count_category("AND parent_id='$v' ")     : '0';
						   $total_product   = ( $product_count!='' )  ?  count_products("AND category_id='$v' ")   : '0';
						
							if( $total_category>0 || $total_product > 0 )
							{
								$this->session->set_userdata(array('msg_type'=>'error'));
								$this->session->set_flashdata('error',lang('child_to_delete'));
							
							}else
							{  
							    $where = array($auto_field=>$v);
								$this->utils_model->safe_delete($table,$where,TRUE);
								$this->session->set_flashdata('item', array('message' => 'Deleted','class' => 'success'));	
							
							}						  
					  }	
				
			  }			
			
			  if($action=='Tempdelete')
			  {	
			  			 
				$data = array('status'=>'2');
				$where = "$auto_field IN ($str_ids)";
				$this->utils_model->safe_update($table,$data,$where,FALSE);
				$this->session->set_userdata(array('msg_type'=>'success'));
				$this->session->set_flashdata('success',lang('deleted'));	
				
			  }				 			
			  		 	  
          }
		  
	
		redirect($_SERVER['HTTP_REFERER'], '');
		
	}
	
	
	public function set_as($table,$auto_field='id',$data=array())
	{		
		$arr_ids               = $this->input->post('arr_ids',TRUE);
		
		if( is_array($arr_ids ) )
		{
			
			$str_ids = implode(',', $arr_ids);
			 
			if( is_array($data) && !empty($data) )
			{
				$data = $data;
				$where = "$auto_field IN ($str_ids)";
				$this->utils_model->safe_update($table,$data,$where,FALSE);
				$this->session->set_userdata(array('msg_type'=>'success'));
				$this->session->set_flashdata('success',"Record has been updated/deleted successfully.");			
			}	
			
		   redirect($_SERVER['HTTP_REFERER'], '');
		   
		}
		
	}
	
	
	/*
	
	$tblname = name of table 
	$fldname = order column name  of table 
	$fld_id  =  auto increment column name of table
			
	*/	
	
    public function update_displayOrder($tblname,$fldname,$fld_id)
	{
		$posted_order_data=$this->input->post('ord');
		
		while(list($key,$val)=each($posted_order_data))
		{
			if( $val!='' )
			{
				 $val = (int) $val;
				 $data = array($fldname=>$val);
				 $where = "$fld_id=$key";
				 $this->utils_model->safe_update($tblname,$data,$where,TRUE);			
			}
				
		}
		$this->session->set_userdata(array('msg_type'=>'success'));
		$this->session->set_flashdata('success',lang('order_updated'));		
		redirect($_SERVER['HTTP_REFERER'], '');
	}
}
