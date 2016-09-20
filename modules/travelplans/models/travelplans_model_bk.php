<?php
class travelplans_model extends MY_Model{
		function __construct(){
			parent::__construct();
		}
	/*Functions For fetch Tabls From Database*/		
	
	public function get_dashbord_pln($limit='10',$offset='0',$param=array())
	 {
		$id					=   @$param['travel_id'];		
		$userid				=   @$param['user_id'];
		$orderby			=	@$param['orderby'];	
		$where			    =	@$param['where'];
		if($id!='')
		{
			$this->db->where("travel_id ","$id");
		}
		
		if($userid!='')
		{
			$this->db->where("user_id  ","$userid");
		}	
		if($where!='')
		{
			$this->db->where($where);
			
		}
		if($orderby!='')
		{		
			$this->db->order_by($orderby);
			
		}
		else
		{
			$this->db->order_by('travel_id ','desc');
		}
		
	    $this->db->group_by("travel_id"); 	
		$this->db->limit($limit,$offset);
		$this->db->select('*',FALSE);
		$this->db->from('tbl_travel_plans');
		$this->db->where('type =', '1');
		$q=$this->db->get();		
		$result = $q->result_array();	
		$result = ($limit=='1') ? @$result[0]: $result;	
		return $result;
				
	}
		    public function record_count($ID){
			$this->db->select('*');
			$this->db->from('tbl_travel_plans');
			$this->db->where('user_id',$ID);
			$result=$this->db->get();			
			if($result->num_rows > 0){
				return $result->num_rows();	
			}
		}	
	public function getCityCountry($term){
  		$this->db->select("tbl_country.*,tbl_cities.*");
  		$this->db->from('tbl_country');
  		$this->db->join('tbl_cities','tbl_cities.country_id = tbl_country.country_id');
                $this->db->where('tbl_cities.status','A');		
		$this->db->like('city', $term);  		
  		$this->db->or_like('country_name',$term);
		$this->db->limit(5);
  		$query = $this->db->get();
  		return $query;
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
		
		public function getCity($city){
			$this->db->select('id');
			$this->db->from('tbl_cities');
			$this->db->where('city',$city);
                        $this->db->where('tbl_cities.status','A');		
			$result=$this->db->get();			
			if($result->num_rows >0){			
				return $result->result_array();	
			}
		}
		
		public function get_plans($limit='10',$offset='0',$param=array())
		{
		$travelid			=   @$param['travel_id'];		
		$status			    =   @$param['status'];	
		$userid				=   @$param['user_id'];
		$orderby			=	@$param['orderby'];	
		$where			    =	@$param['where'];
		if($travelid!='')
		{
			$this->db->where("tblplan.travel_id ","$travelid");
		}		
		if($userid!='')
		{
			$this->db->where("tblplan.user_id  ","$userid");
		}	
		if($where!='')
		{
			$this->db->where($where);
			
		}
		if($orderby!='')
		{		
			$this->db->order_by($orderby);
			
		}
		else
		{
			$this->db->order_by('tblplan.travel_id ','desc');
		}
		
	    $this->db->group_by("tblplan.travel_id"); 	
		$this->db->limit($limit,$offset);
		$this->db->select('*',FALSE);
		$this->db->from('tbl_travel_plans as tblplan');
		$q=$this->db->get();		
		$result = $q->result_array();	
		$result = ($limit=='1') ? @$result[0]: $result;	
		return $result;
				
	}
		public function get_plan_by_id($id)
		{
		$id = applyFilter('NUMERIC_GT_ZERO',$id);	
		if($id>0)
		{
			$condtion = "status !='2' AND travel_id=$id";
			$fetch_config = array(
			'condition'=>$condtion,							 					 
			'debug'=>FALSE,
			'return_type'=>"object"							  
			);
			$result = $this->find('tbl_travel_plans',$fetch_config);
			return $result;		
		}
	}
}