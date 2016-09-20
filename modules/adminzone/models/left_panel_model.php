<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Left_panel_model extends MY_Model{
	public function __construct()
	{
		parent::__construct();
	}
	public function get_image($offset=FALSE,$per_page=FALSE)
	{	
		$keyword = $this->db->escape_str(trim($this->input->get_post('keyword',TRUE)));		
		$condtion = ($keyword!='') ? "status !='2' AND ( name LIKE '%".$keyword."%') ":"status !='2'";		
		$fetch_config = array(
		'condition'=>$condtion,
		'order'=>"id DESC",
		'limit'=>$per_page,
		'start'=>$offset,							 
		'debug'=>FALSE,
		'return_type'=>"array"							  
		);		
		$result = $this->findAll('tbl_left_ads',$fetch_config);
		return $result;	
	}
	public function get_image_by_id($id)
	{		
		$id = applyFilter('NUMERIC_GT_ZERO',$id);
		if($id>0)
		{
			$condtion = "status !='2' AND id=$id";
			$fetch_config = array(
			'condition'=>$condtion,							 					 
			'debug'=>FALSE,
			'return_type'=>"object"							  
			);
			$result = $this->find('tbl_left_ads',$fetch_config);
			return $result;		
		}		
	}
}
// model end here