<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Messages_model extends MY_Model
{	
/*Function for Left Sender Name List */

		public function get_MessageList($limit='10',$offset='0',$param=array())
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
		$this->db->order_by('tbl_thread.thread_date','desc');		
		$this->db->select('SQL_CALC_FOUND_ROWS tbl_thread.*,wlu.first_name,wlu.last_name,wlu.email,wlu.profile_image',FALSE);
		$this->db->from('tbl_thread as tbl_thread');
		$this->db->join('tbl_users AS wlu','tbl_thread.sender_id=wlu.user_id','left');				
		$q=$this->db->get();	
        $result = $q->result_array(); 			
		$result = ($limit=='1') ? @$result[0]: $result;
$data=array(
		 'active_status' => '0'
		 );
		$this->db->where('sender_id',$logUserId);
		$this->db->or_where('reciever_id',$logUserId);	
		$this->db->update('tbl_thread', $data);	
		return $result;
		}
/*Function for inbox Messsages*/

	public function get_Messages($senderID,$receiverID){		
		$this->db->order_by('tbl_msg.message_id','desc');
		$this->db->select('SQL_CALC_FOUND_ROWS tbl_msg.*,wlu1.*',FALSE);
		$this->db->from('tbl_message as tbl_msg');
		$this->db->join('tbl_users AS wlu1','tbl_msg.sender_id=wlu1.user_id','left');
		$this->db->where('tbl_msg.reciever_id',"$senderID");
		$this->db->where('tbl_msg.sender_id',"$receiverID");
		$this->db->where('tbl_msg.sender_delete',"1");
		$this->db->or_where('tbl_msg.reciever_id',"$receiverID");
		$this->db->where('tbl_msg.sender_id',"$senderID");
		$this->db->where('tbl_msg.reciever_delete',"1");

		$q=$this->db->get();
		$result = $q->result_array();
		 $data=array(
		 'reciever_status' => '0'
		 );
		$this->db->where('sender_id',"$senderID");
		$this->db->where('reciever_id',"$receiverID");	
		$this->db->update('tbl_message', $data);	
		return $result;		
	}
	/*Header Message Count*/
	
	function total_msg()		   
			{		
			$this->load->model('user/Users_model');
			$User_Arr = $this->Users_model->getuserInfo($this->session->userdata('email'));
			$logUserId =$User_Arr[0]['user_id'];			
        	$this->db->where('tbl_message.reciever_id',"$logUserId");
			$this->db->where('tbl_message.reciever_status','1');
			$this->db->from('tbl_message');
			$q=$this->db->get();
			$result = $q->result_array();					 
			return $result;
			
   }
   /*Message Count */
   
   function MessageCount()		   
			{		
			$this->load->model('user/Users_model');
			$User_Arr = $this->Users_model->getuserInfo($this->session->userdata('email'));
			$logUserId =$User_Arr[0]['user_id'];
				
        	$this->db->where('tbl_message.reciever_id',"$logUserId");
			$this->db->where('tbl_message.reciever_status','1');
			$this->db->from('tbl_message');
			$result = $this->db->count_all_results();				 
			return $result;
			
   }
   /* Tread Conty function */
   
    function ThreadCount($sender,$reciever)		   
			{
			$this->db->select('SQL_CALC_FOUND_ROWS tbl_thread.*',FALSE);		
        	$this->db->where('tbl_thread.sender_id',$sender);
			$this->db->where('tbl_thread.reciever_id',$reciever);
			$this->db->or_where('tbl_thread.sender_id',$reciever);
			$this->db->where('tbl_thread.reciever_id',$sender);
			$this->db->from('tbl_thread');
			$q=$this->db->get();
			$result = $q->result_array();				
			return $result;
			
   }
}