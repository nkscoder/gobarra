<?php
class timeline_model extends MY_Model{
		function __construct(){
			parent::__construct();
		}
		public function get_userid($email)
		{
			$this->db->select('user_id');
			$this->db->from('tbl_users');
			$this->db->where('email',$email);
			$result=$this->db->get();
			if($result->num_rows()>0)
			{
				return $result->result();
			}

		}
	function getuserInfo($email){
			$this->db->select('*');
			$this->db->from('tbl_users');
			//$this->db->join('tbl_country','tbl_country.country_id=users.country_id');
			$this->db->where('email',$email);
			$result=$this->db->get();
			if($result->num_rows > 0){
				return $result->result();
					
			}
		} 
	/*Time Line User Details End */
		
		public function record_count($ID){
			$this->db->select('*');
			$this->db->from('tbl_travel_plans');
			$this->db->where('user_id',$ID);
			$result=$this->db->get();			
			if($result->num_rows > 0){
				return $result->num_rows();	
			}
		}		
       public function get_postTime($limit = '10', $offset = '0', $param = array()) 
       {
			$email=$this->session->userdata('email');
			$udrID=$this->timeline_model->get_userid($email);
			$ID=$udrID[0]->user_id;
			$userID  = @$param['user_id'];
		    $where = @$param['where'];
        if ($ID != '') {
			$this->db->where("wlt.user_id ","$ID");
        }
			if ($where != '') {

            $this->db->where($where);
        }
		$this->db->order_by('wlt.travel_id','desc');
		$this->db->group_by("wlt.travel_id");
        $this->db->select('SQL_CALC_FOUND_ROWS wlt.*,wlusr.first_name,wlusr.last_name,wlusr.city_id,wlusr.occupation,wlusr.mobile,wlusr.profile_image', FALSE);
        $this->db->from('tbl_travel_plans as wlt');		
		$this->db->join('tbl_users AS wlusr','wlt.user_id=wlusr.user_id','left');		
        $q = $this->db->get();
		 $result = $q->result_array();
        $result = ($limit == '1') ? $result[0] : $result;      
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