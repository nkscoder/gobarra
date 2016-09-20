<?php
class Users_model extends My_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function get_users($offset=FALSE,$per_page=FALSE)
	{   
	    $keyword = $this->db->escape_str(trim($this->input->get_post('keyword',TRUE)));  
		$condtion = ($keyword!='')?"status !='2' AND first_name  like '%".$keyword."%' ":"status !='2'";
		$fetch_config = array(
							  'condition'=>$condtion,
							  'order'=>"user_id DESC",
							  'limit'=>$per_page,
							  'start'=>$offset,							 
							  'debug'=>FALSE,
							  'return_type'=>"array"							  
							  );		
		$result = $this->findAll('tbl_users',$fetch_config);
		return $result;
	}
}