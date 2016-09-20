<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Products_model extends MY_Model
 {	 
	 	 /*Fetch Data For listing from tbl product */
 public function get_products($limit='10',$offset='0',$param=array())
	 {
		$country_name		=   @$param['country_name'];
		$city_name			=   @$param['city_name'];
		//$status			=   @$param['status'];	
		$userid				=   @$param['user_id'];
		$orderby			=	@$param['orderby'];	
		$where			    =	@$param['where'];	
		$keyword			=   trim($this->input->get_post('keyword',TRUE));						
		$keyword			=   $this->db->escape_str($keyword);		
		if($country_name!='') {
			$this->db->where("wlp.country_id ","$country_name");
		}
		if($city_name!='') {
			$this->db->where("wlp.city_id ","$city_name");
		}
		if($userid!='') {
			$this->db->where("wlp.user_id  ","$userid");
		}	
		if($where!='') {
			$this->db->where($where);
		}
		if($keyword!=''){
			$this->db->where("(wlp.country_id LIKE '%".$keyword."%')");
			$this->db->or_where("(wlp.city_id LIKE '%".$keyword."%')");
		}
		if($orderby!=''){		
			$this->db->order_by($orderby);	
		} else {
			$this->db->order_by('wlp.product_id ','desc');
		}
		$this->db->limit($limit,$offset);
		$this->db->select('SQL_CALC_FOUND_ROWS wlp.product_id,wlp.user_id,wlp.country_id,wlp.city_id,wlp.product_name,wlp.description,wlp.status,wlp.img1,wlp.img2',FALSE);
		$this->db->from('tbl_products as wlp');
		$this->db->group_by("wlp.product_id");
		$q=$this->db->get();		
		$result = $q->result_array();	
		$result = ($limit=='1') ? @$result[0]: $result;	
		return $result;
	}

	public function get_admin_products($limit='10',$offset='0',$param=array())
	 {
		$productId			=   @$param['product_id'];
		$cityname			=   @$param['city_id'];
		$status			    =   @$param['status'];	
		$userid				=   @$param['user_id'];
		$orderby			=	@$param['orderby'];	
		$where			    =	@$param['where'];
		if($productId!='') {
			$this->db->where("tblproduct.product_id ","$productId");
		}
		if($cityname !='') {
			$this->db->where('tblproduct.city_id','$cityname');
		}
		if($userid!='') {
			$this->db->where("tblproduct.user_id  ","$userid");
		}	
		if($where!='') {
			$this->db->where($where);			
		}
		if($orderby!='') {		
			$this->db->order_by($orderby);
		} else {
			$this->db->order_by('tblproduct.product_id','desc');
		}
			$this->db->group_by("tblproduct.product_id"); 	
			$this->db->limit($limit,$offset);
			$this->db->select('tblproduct.product_id,tblproduct.user_id,tblproduct.country_id,tblproduct.city_id,tblproduct.product_name,tblproduct.description,tblproduct.status,tblproduct.img1,tblproduct.img2',FALSE);
			$this->db->from('tbl_products as tblproduct');			
			$q=$this->db->get();			
			$result = $q->result_array();	
			$result = ($limit=='1') ? @$result[0]: $result;	
			return $result;	
	}
	/*Record Count */
	public function record_count($ID){
			$this->db->select('*');
			$this->db->from('tbl_products');
			$this->db->where('user_id',$ID);
			$result=$this->db->get();
			if($result->num_rows > 0){
				return $result->num_rows();	
			}
		}
		
	public function get_product_by_id($id)
	{
	$id = applyFilter('NUMERIC_GT_ZERO',$id);	
		if($id>0)
		{
			$condtion = "status !='2' AND product_id=$id";
			$fetch_config = array(
			'condition'=>$condtion,							 					 
			'debug'=>FALSE,
			'return_type'=>"object"							  
			);
			$result = $this->find('tbl_products',$fetch_config);
			return $result;		
		}
	}

	public function getStateModel($id){
			$this->db->select('*');
			$this->db->from('tbl_cities');
			$this->db->where('country_id',$id);
			$result=$this->db->get();
			if($result->num_rows >0){
				return $result->result();	
			}
		}
		public function getUserID($email){
			$this->db->select('user_id');
			$this->db->from('tbl_users');
			$this->db->where('email',$email);
			$result=$this->db->get();
			if($result->num_rows >0){			
				return $result->result();	
			}
		}
}