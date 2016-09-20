<?php
class Enquiry extends Public_Controller
{
		public function __construct() {		
			parent::__construct(); 
			$this->load->helper(array('file'));	 
			$this->load->library(array('Dmailer'));	
			$this->load->model(array('enquiry/enquiry_model','home/home_model'));
			$this->form_validation->set_error_delimiters("<div class='required'>","</div>");		
		}
		public function index()
		{		   
		   	if($this->session->userdata('is_logged_in'))
			{
				redirect('enquiry/display_name');
			}
			else
			{
				redirect(site_url('user/login'));
			}
		}
		/*Function For Display Left Side Sender Name*/
		
		public function display_name()
		{
			if($this->session->userdata('is_logged_in'))
			{
			$offset               	  =  $this->uri->segment(3);
			$senderID = $offset;
			$condition                = array();
			$pagesize                 =(int) $this->input->get_post('pagesize');
			$config['limit']          =( $pagesize > 0 ) ? $pagesize : $this->config->item('per_page');
			$offset                   =( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;        
			$base_url                 = current_url_query_string(array('filter'=>'result'),array('per_page'));			
			$email                    =$this->session->userdata('email');
			$usrID                    =$this->home_model->getUserID($email);
			$ID = $usrID[0]->user_id;
			if($ID!='')
			{
			$condition['user_id']   =$ID;
			}			
			$udrID                     		= $this->home_model->getUserInfo($ID);
			$res                       		= $this->enquiry_model->get_EnquiryList($config['limit'],$offset,$condition);		
			$data['res']					= $res;			
			$data["userData"]         		= $udrID;
			$receiverID = $ID;
			if ($offset =''){
			$this->load->view('enquiry/enquiry_view',$data);	
			}
			else
			{
			$result 						= $this->enquiry_model->get_Enquiry($senderID,$receiverID);
			$data['result']					= $result;
			$this->load->view('enquiry/enquiry_view',$data);
			}
			}else{
				redirect(site_url('user/login'));
			}	
	}
		/*Function for Insert Enquiry */
		
		public function insertEnquiry()
		{	

				$sender_id		= $this->input->get_post('sender_id');
				$reciever_id	= $this->input->get_post('reciever_id');
				$EnqCount 		= $this->enquiry_model->EnqCount($sender_id,$reciever_id);
				$countThread	= count($EnqCount);
			/*	$thread_id		= $EnqCount[0]['enq_thread_id'];*/
				if($EnqCount){$thread_id		= $EnqCount[0]['enq_thread_id'];}
				if($countThread  == 0)
				{
					$posted_data = array(
					'sender_id'  		=> $sender_id,
					'reciever_id' 		=> $reciever_id,                
					'enq_thread_date'	=> date('Y-m-d H:i:s')	
					);
					$this->db->insert('tbl_enquiry_thread',$posted_data,FALSE);
				}
				else
				{
					$posted_data = array(                
					'enq_thread_date'	=> date('Y-m-d H:i:s')	
					);
					 $where = "enq_thread_id = '".$thread_id."'"; 						
					$this->enquiry_model->safe_update('tbl_enquiry_thread',$posted_data,$where,FALSE);
				}
				
				$sender_id		= $this->input->get_post('sender_id');
				$reciever_id	= $this->input->get_post('reciever_id');				
				$enquiry     	=$this->input->get_post('enquiry');
				 $posted_data = array(
                'sender_id'  	=> $sender_id,
                'reciever_id' 	=> $reciever_id,	
                'enquiry'		=> $enquiry,				
				'enquiry_date'	=> date('Y-m-d H:i:s')
				);				
				$this->db->insert('tbl_enquiry',$posted_data,FALSE);
				$this->showEnquiryall ($sender_id,$reciever_id);
		}
		
		public function showEnquiry ()
		{
			if($this->session->userdata('is_logged_in'))
			{
			$senderID = $this->input->post('senderID');
			$receiverID = $this->input->post('receiverID');//in this section receiver id is session user id as well
			$this->showEnquiryall ($receiverID,$senderID );
			}
			else
			{
				redirect(site_url('user/login'));
			}
		}
		/*Function for Show All Enquiry Messages in Inbox */
		
		public function showEnquiryall($receiverID,$senderID ){
			$result = $this->enquiry_model->get_Enquiry($senderID,$receiverID);
			?>
						<div class="bg leftDetailsSecBottom ">					
						  <?php $query = $this->db->query("SELECT * FROM tbl_users WHERE user_id = $senderID"); 
							$qury_result= $query->result_array();
							foreach($qury_result as $keyVal => $Myvalue )
							{ 
							?> 
						  <h3>Enquiry To <a href="<?php echo base_url();?>home/timelinepost/<?php echo $Myvalue['user_id']; ?>"><strong class="mssg-name">
						  <?php echo $Myvalue['first_name']."&nbsp;".$Myvalue['last_name']; ?></strong></a></h3>
						 <?php }?>
						  <form id="replyEnquiry" enctype="multipart/form-data" name="formuploading" role="form" >
							<div class="form-group uploadIcon">
							 <textarea name="enquiry" id="enquiry" title="Write Your Enquiry" placeholder="write Your Enquiry" class="form-control"></textarea>								
								<input name="sender_id" type="hidden" value="<?php echo $receiverID; ?>" />
								<input name="reciever_id" type="hidden" value="<?php echo $senderID ; ?>" />				
							</div>						
								<button onclick="return insertEnquiry()" class="buyer-btn1" type="button">Send Reply</button>
							  </form>
							 </div>
							 <?php if(is_array($result) && !empty($result) )
								{ ?>
							  <form action="" method="post" id="enquiryDelete" >
							  <div class="mail-option">
                             <div class="chk-all">
                                 <input type="checkbox" class="mail-checkbox mail-group-checkbox" onclick="$('input[name*=\'arr_ids\']').attr('checked', this.checked);">
                                 <div class="btn-group">
                                     <a class="btn mini all" href="#" data-toggle="dropdown">
                                         &nbsp;&nbsp;All
                                       
                                     </a> 
                                 </div>
                             </div>
 
                             <div class="btn-group hidden-phone">
                                  <input type="hidden" name="sender_id" value="<?php echo $receiverID ;?>">
								   <input type="hidden" name="reciever_id" value="<?php echo $senderID ;?>">
								 <button type="button" class="pull-right buyer-btn" style="width:108px;" onclick="return DeletetEnquiry()">Delete</button>
                             </div>  
                         </div>
						 
						 <div class="actTimeArea" > 
					 <?php
						foreach($result as $key=>$value)
						{
						if($value['profile_image'] !='')
						{
							$MyImage =base_url()."uploaded_files/profile_img/".$value['profile_image'];									
						}
						else
						{
							$MyImage =base_url()."uploaded_files/def_user/index.jpg";
						}
								if($value['email']==$this->session->userdata('email')){   ?>

							
					 <div class="act-time" id="enquirymain<?php echo $value['sender_id'] ;?>"> 
					<!--  receiver enquiry block -->
<div class="row"><div class="col-md-9 pull-right">
								  <div class="activity-body act-in" style="background-color: #E0DDDD; padding:5px;border-radius:3px;">
									  <span class="arrow"></span>
								<div class="text">
									<input type="checkbox" value="<?php echo $value['enquiry_id']; ?>" name="arr_ids[]" class="checkbox1">
									<br><input type="hidden" name="userid<?php echo $value['enquiry_id']; ?>" value="<?php echo $value['sender_id'];?>">
									<p class="attribution"><a href="<?php echo base_url();?>home/timelinepost/<?php echo $value['user_id']; ?>">
									<img src="<?php echo $MyImage; ?>" alt="" width="30px" height="30px">
									 <?php 
											echo $value['first_name']." ".$value['last_name']; ?>&nbsp;<span class="f-12">(you)</span>
											</a>
										<em> <?php
										$created_time = $value['enquiry_date'];
		//echo $created_time;
		
		date_default_timezone_set('Asia/Calcutta'); //Change as per your default time
        $str = strtotime($created_time);
        $today = strtotime(date('Y-m-d H:i:s'));

        // It returns the time difference in Seconds...
        $time_differnce = $today-$str;

        // To Calculate the time difference in Years...
        $years = 60*60*24*365;

        // To Calculate the time difference in Months...
        $months = 60*60*24*30;

        // To Calculate the time difference in Days...
        $days = 60*60*24;

        // To Calculate the time difference in Hours...
        $hours = 60*60;

        // To Calculate the time difference in Minutes...
        $minutes = 60;

        if(intval($time_differnce/$years) > 1)
        {
            echo intval($time_differnce/$years)." years ago";
        }else if(intval($time_differnce/$years) > 0)
        {
            echo intval($time_differnce/$years)." year ago";
        }else if(intval($time_differnce/$months) > 1)
        {
            echo intval($time_differnce/$months)." months ago";
        }else if(intval(($time_differnce/$months)) > 0)
        {
            echo intval(($time_differnce/$months))." month ago";
        }else if(intval(($time_differnce/$days)) > 1)
        {
            echo intval(($time_differnce/$days))." days ago";
        }else if (intval(($time_differnce/$days)) > 0) 
        {
            echo intval(($time_differnce/$days))." day ago";
        }else if (intval(($time_differnce/$hours)) > 1) 
        {
            echo intval(($time_differnce/$hours))." hours ago";
        }else if (intval(($time_differnce/$hours)) > 0) 
        {
            echo intval(($time_differnce/$hours))." hour ago";
        }else if (intval(($time_differnce/$minutes)) > 1) 
        {
            echo intval(($time_differnce/$minutes))." minutes ago";
        }else if (intval(($time_differnce/$minutes)) > 0) 
        {
            echo intval(($time_differnce/$minutes))." minute ago";
        }else if (intval(($time_differnce)) > 1) 
        {
            echo intval(($time_differnce))." seconds ago";
        }else
        {
            echo "few seconds ago";
        }							
		?></em></p>
										  <p style="font-size:12px; font-weight:300;"><?php echo $value['enquiry']; ?></p>																			 
									  </div>
								  </div></div></div>
								<!--   <div class="notify-arrow-email notify-arrow-blue-email left"></div> -->
					  </div>



					<?php } else{?>
                                    
<div class="row"><div class="col-md-9 pull-left">
									<div class="act-time" id="enquirymain<?php echo $value['sender_id'] ;?>">

										<div class="activity-body act-in" style="background-color: rgba(154,170, 197, 0.58); padding:5px; border-radius:3px;">
											<span class="arrow"></span>
											<div class="text">
												<input type="checkbox" value="<?php echo $value['enquiry_id']; ?>" name="arr_ids[]" class="checkbox1">
												<br><input type="hidden" name="userid<?php echo $value['enquiry_id']; ?>" value="<?php echo $value['sender_id'];?>">
												<p class="attribution"><a href="<?php echo base_url();?>home/timelinepost/<?php echo $value['user_id']; ?>">
														<img src="<?php echo $MyImage; ?>" alt="" width="30px" height="30px">
														<?php
														echo $value['first_name']." ".$value['last_name']; ?>
													</a>
													<em> <?php
														$created_time = $value['enquiry_date'];
														//echo $created_time;

														date_default_timezone_set('Asia/Calcutta'); //Change as per your default time
														$str = strtotime($created_time);
														$today = strtotime(date('Y-m-d H:i:s'));

														// It returns the time difference in Seconds...
														$time_differnce = $today-$str;

														// To Calculate the time difference in Years...
														$years = 60*60*24*365;

														// To Calculate the time difference in Months...
														$months = 60*60*24*30;

														// To Calculate the time difference in Days...
														$days = 60*60*24;

														// To Calculate the time difference in Hours...
														$hours = 60*60;

														// To Calculate the time difference in Minutes...
														$minutes = 60;

														if(intval($time_differnce/$years) > 1)
														{
															echo intval($time_differnce/$years)." years ago";
														}else if(intval($time_differnce/$years) > 0)
														{
															echo intval($time_differnce/$years)." year ago";
														}else if(intval($time_differnce/$months) > 1)
														{
															echo intval($time_differnce/$months)." months ago";
														}else if(intval(($time_differnce/$months)) > 0)
														{
															echo intval(($time_differnce/$months))." month ago";
														}else if(intval(($time_differnce/$days)) > 1)
														{
															echo intval(($time_differnce/$days))." days ago";
														}else if (intval(($time_differnce/$days)) > 0)
														{
															echo intval(($time_differnce/$days))." day ago";
														}else if (intval(($time_differnce/$hours)) > 1)
														{
															echo intval(($time_differnce/$hours))." hours ago";
														}else if (intval(($time_differnce/$hours)) > 0)
														{
															echo intval(($time_differnce/$hours))." hour ago";
														}else if (intval(($time_differnce/$minutes)) > 1)
														{
															echo intval(($time_differnce/$minutes))." minutes ago";
														}else if (intval(($time_differnce/$minutes)) > 0)
														{
															echo intval(($time_differnce/$minutes))." minute ago";
														}else if (intval(($time_differnce)) > 1)
														{
															echo intval(($time_differnce))." seconds ago";
														}else
														{
															echo "few seconds ago";
														}
														?></em></p>
												<p style="font-size:12px; font-weight:300;"><?php echo $value['enquiry']; ?></p>
											</div>
										</div>
										<!-- <div class="notify-arrow-email notify-arrow-blue-email left"></div> -->
									</div></div></div>

				<?php } }?>
				</div>
				</form>
	<?php			
				}
				else
				{
					echo "No Enquiry" ;
				}
						
		}	
		/*Function for Enquiry Messages */
		
		public function deleteEnquiry()	
		{					  
							  $this->load->model('user/users_model'); 
                              $email     =$this->session->userdata('email');
                              $usrinfo   =$this->users_model->getuserInfo($email);                              
							  $senderID = $this->input->post('sender_id');
							  $recieverID = $this->input->post('reciever_id');
							  $id=$usrinfo[0]['user_id'];
							if(isset($_POST['arr_ids'])){
							
							if (is_array($_POST['arr_ids'])) 
							{								
							foreach($_POST['arr_ids'] as $value)
							{
									$userID = $_POST['userid'.$value];
									if ($userID == $id)
									{
										 $data=array(
										 'sender_delete' => '0'
										 );
									}
									else
									{
										$data=array(
										 'reciever_delete' => '0'
										 );
									}
									$this->db->where('enquiry_id',"$value");
								   $this->db->delete('tbl_enquiry');

									/*$this->db->update('tbl_enquiry',$data);*/
								}
							} 
						}
					$this->showEnquiryall($recieverID,$id);
		}
		
		/*Count Function for Header Notification */
		public function EnquiryCount()
		{
			$enquiry	=	$this->enquiry_model->EnquiryCount();			
			if ($enquiry > 0)
			{
			echo ($enquiry);
			}
			
		}
		/*Function for Header Notification */
		public function EnquiryNotification()
		{
			$enquiry	=	$this->enquiry_model->EnquiryCount();			
			?>
			<?php 
						$this->load->model('enquiry/enquiry_model');
						$this->load->model('user/Users_model');
						$User_Arr = $this->Users_model->getuserInfo($this->session->userdata('email'));
						$logUserId =$User_Arr[0]['user_id'];
						$query = $this->db->query("SELECT *, COUNT(*) FROM `tbl_enquiry` WHERE reciever_id=$logUserId AND reciever_status ='1' group by sender_id ");								
						$array = $query->result_array($query);						 
						$msg = count($array);							
						?>
						<a data-toggle="dropdown" data-placement="right" title="Send Enquiry" class="dropdown-toggle" href="#" onClick="return Showenquiry();">
                          <span id="notification-enq" >
						  <?php if ($enquiry > 0)
							{ 
						  echo $enquiry;
							}?></span><i class="fa fa-flask "></i>                          
                        </a>
			<ul class="dropdown-menu extended inbox scroll-menu">
                            <!-- <div class="notify-arrow notify-arrow-blue"></div> -->
							<?php if ($enquiry > 0)
							{ ?>						
                            <li>
                                <p class="blue">You Have <?php echo $enquiry; ?> New Equiry</p>
                            </li>
							<?php
								}							
							foreach($array as $result)
									 {
										$query = $this->db->query("SELECT * FROM tbl_users WHERE user_id = $result[sender_id]"); 
										$qury_result= $query->result_array();
										foreach($qury_result as $keyVal => $Myresult )
										{
										$string = $Myresult['first_name'];										
										$string1 = $Myresult['last_name'];											
									 if($Myresult['profile_image'] !='')										  
										{
										$img=base_url().'uploaded_files/profile_img/'.$Myresult['profile_image'];
										}
										else
										{
										$img=base_url()."uploaded_files/def_user/index.jpg";
										}		
											$sender= $result['sender_id'];											
									 ?>
							<li>								
								  <a class="unread" href="<?php echo base_url();?>enquiry/display_name/<?php echo $sender; ?>">
                                    <span class="photo"><img alt="no image" src="<?php echo $img; ?>"></span>
                                    <span class="subject">
                                    <span class="from"><strong><?php echo $string."&nbsp;".$string1 ;?></strong><p> Sent <?php echo $result['COUNT(*)']; ?> New Enquiry(s)</p></span>
                                    </span>
                                </a>
                            </li>
						
								<?php } } ?>
					 </ul>
		<?php	
			
		}
		
}

/* End of file demo.php */