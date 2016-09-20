<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Enquiry_model extends MY_Model
{	
	
	/*Function For Fetch Receiver Name from Tbl Enquiry*/
	public function get_EnquiryList($limit='10',$offset='0',$param=array())
	{
		$this->load->model('user/Users_model');
        $User_Arr = $this->Users_model->getuserInfo($this->session->userdata('email'));
        $logUserId =$User_Arr[0]['user_id'];
        $memID				=   @$param['reciever_id'];
        if($logUserId !='')
        {
        	$this->db->where('tbl_thread.reciever_id',"$logUserId");
			$this->db->or_where('tbl_thread.sender_id',"$logUserId");	
        }
		$this->db->order_by('tbl_thread.enq_thread_date','desc');
		$this->db->select('SQL_CALC_FOUND_ROWS tbl_thread.*,wlu.first_name,wlu.last_name,wlu.email,wlu.profile_image',FALSE);
		$this->db->from('tbl_enquiry_thread as tbl_thread');
		$this->db->join('tbl_users AS wlu','tbl_thread.sender_id=wlu.user_id','left');		
		$q=$this->db->get();	
        $result = $q->result_array();
		$result = ($limit=='1') ? @$result[0]: $result;	
		return $result;
		}
		/*Function For Fetch All Messages from table Enquiry*/
		
	public function get_Enquiry($senderID,$receiverID){
		$this->db->order_by('tbl_enqry.enquiry_id','desc');
		$this->db->select('SQL_CALC_FOUND_ROWS tbl_enqry.*,wlusr.*',FALSE);
		$this->db->from('tbl_enquiry as tbl_enqry');
		$this->db->join('tbl_users AS wlusr','tbl_enqry.sender_id=wlusr.user_id','left');
		$this->db->where('tbl_enqry.reciever_id',"$senderID");
		$this->db->where('tbl_enqry.sender_id',"$receiverID");
		$this->db->where('tbl_enqry.sender_delete',"1");
		$this->db->or_where('tbl_enqry.reciever_id',"$receiverID");
		$this->db->where('tbl_enqry.sender_id',"$senderID");
		$this->db->where('tbl_enqry.reciever_delete',"1");

		$q=$this->db->get();
		$result = $q->result_array();
		 $data=array(
		 'reciever_status' => '0'
		 );
		$this->db->where('sender_id',"$senderID");
		$this->db->where('reciever_id',"$receiverID");	
		$this->db->update('tbl_enquiry', $data);	 
		return $result;
	}
	/*Function for Count Number Of Message*/
	
	function total_enq()		   
			{		
			$this->load->model('user/Users_model');
			$User_Arr = $this->Users_model->getuserInfo($this->session->userdata('email'));
			$logUserId =$User_Arr[0]['user_id'];	
        	$this->db->where('tbl_enquiry.reciever_id',"$logUserId");
			$this->db->where('tbl_enquiry.reciever_status','1');
			$this->db->from('tbl_enquiry');
			$q=$this->db->get();
			$result = $q->result_array();			
			
			return $result;
			
   }
   /*Function for Count Number Of Message*/
   
   function EnquiryCount()		   
			{		
			$this->load->model('user/Users_model');
			$User_Arr = $this->Users_model->getuserInfo($this->session->userdata('email'));
			$logUserId =$User_Arr[0]['user_id'];
				
        	$this->db->where('tbl_enquiry.reciever_id',"$logUserId");
			$this->db->where('tbl_enquiry.reciever_status','1');
			$this->db->from('tbl_enquiry');
			$result = $this->db->count_all_results();		 
			return $result;
			
   }
   /*Function for Count Number Of threads*/
   
    function EnqCount($sender,$reciever)		   
			{
			$this->db->select('SQL_CALC_FOUND_ROWS tbl_enquiry_thread.*',FALSE);		
        	$this->db->where('tbl_enquiry_thread.sender_id',$sender);
			$this->db->where('tbl_enquiry_thread.reciever_id',$reciever);
			$this->db->or_where('tbl_enquiry_thread.sender_id',$reciever);
			$this->db->where('tbl_enquiry_thread.reciever_id',$sender);
			$this->db->from('tbl_enquiry_thread');
			$q=$this->db->get();
			$result = $q->result_array();	 
			return $result;
			
   }

}