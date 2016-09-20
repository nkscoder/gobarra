<?php
class Messages extends Public_Controller
{
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('file'));
		$this->load->library(array('Dmailer'));
		$this->load->model(array('messages/messages_model','home/home_model'));
		$this->form_validation->set_error_delimiters("<div class='required'>","</div>");
	}
	public function index()
	{
		if($this->session->userdata('is_logged_in'))
		{
			redirect('messages/display_name');
		}
		else
		{
			redirect(site_url('user/login'));
		}
	}

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
			$res                       		= $this->messages_model->get_MessageList($config['limit'],$offset,$condition);
			$data['res']					= $res;
			$data["userData"]        		= $udrID;
			$receiverID = $ID;
			if ($offset =''){
				$this->load->view('messages/messages_view',$data);
			}
			else
			{
				$result 						= $this->messages_model->get_Messages($senderID,$receiverID);
				$data['result']					= $result;
				$this->load->view('messages/messages_view',$data);
			}
		}else{
			redirect(site_url('user/login'));
		}
	}

	public function insertMessages()
	{
		$sender_id		= $this->input->get_post('sender_id');
		$reciever_id	= $this->input->get_post('reciever_id');
		$ThreadCount 	= $this->messages_model->ThreadCount($sender_id,$reciever_id);
		$countThread	= count($ThreadCount);
		$thread_id		= $ThreadCount[0]['thread_id'];
		if($countThread  == 0)
		{
			$posted_data = array(
				'sender_id'  	=> $sender_id,
				'reciever_id' 	=> $reciever_id,
				'thread_date'	=> date('Y-m-d H:i:s')
			);
			$this->db->insert('tbl_thread',$posted_data,FALSE);
		}
		else
		{
			$posted_data = array(
				'thread_date'	=> date('Y-m-d H:i:s')
			);
			$where = "thread_id = '".$thread_id."'";
			$this->messages_model->safe_update('tbl_thread',$posted_data,$where,FALSE);
		}
		try{
			if( !empty($_FILES) && $_FILES['image']['name']!='' )
			{
				$this->load->library('upload');
				$uploaded_data =  $this->upload->my_upload('image','message_image');
				if( is_array($uploaded_data)  && !empty($uploaded_data) )
				{
					$uploaded_file = $uploaded_data['upload_data']['file_name'];
				}
				$sender_id		= $this->input->get_post('sender_id');
				$reciever_id	= $this->input->get_post('reciever_id');
				$message     	=$this->input->get_post('message');
				$posted_data = array(
					'sender_id'  	=> $sender_id,
					'reciever_id' 	=> $reciever_id,
					'message'		=> $message,
					'message_image'	=> $uploaded_file,
					'msg_add_date'	=> date('Y-m-d H:i:s')
				);
			}
			else
			{
				$sender_id		= $this->input->get_post('sender_id');
				$reciever_id	= $this->input->get_post('reciever_id');
				$message     	=$this->input->get_post('message');
				$posted_data = array(
					'sender_id'  	=> $sender_id,
					'reciever_id' 	=> $reciever_id,
					'message'		=> $message,
					'msg_add_date'	=> date('Y-m-d H:i:s')
				);
			}
			$this->db->insert('tbl_message',$posted_data,FALSE);
		}catch (Exception $e)
		{
			$e->_error_message();
		}
		$this->showMessagesall ($reciever_id ,$sender_id);
	}

	public function showMessages ()
	{
		if($this->session->userdata('is_logged_in'))
		{
			$senderID = $this->input->post('senderID');
			$receiverID = $this->input->post('receiverID');//in this section receiver id is session user id as well
			$this->showMessagesall ($senderID, $receiverID );
		}
		else
		{
			redirect(site_url('user/login'));
		}
	}

	public function showMessagesall($senderID, $receiverID ){
		$result = $this->messages_model->get_Messages($senderID,$receiverID);
		?>
		<div class="bg leftDetailsSecBottom ">
			<?php $query = $this->db->query("SELECT * FROM tbl_users WHERE user_id = $senderID");
			$qury_result= $query->result_array();
			foreach($qury_result as $keyVal => $Myvalue )
			{ ?>
				<h3>Message To<a href="<?php echo base_url();?>home/timelinepost/<?php echo $Myvalue['user_id']; ?>"> <strong class="mssg-name"><?php echo $Myvalue['first_name']."&nbsp;".$Myvalue['last_name']; ?></strong></a></h3>
			<?php }?>
			<form id="replyMessage" enctype="multipart/form-data" name="imaguploading" role="form">
				<div class="form-group uploadIcon">
					<div class="media-body uploadAndText">
						<textarea name="message" id="message" title="Write Your Message" placeholder="Write Your Message" class="form-control"></textarea>
						<img class="uploadSection" onclick="document.getElementById('image').click(); return false" src="<?php echo theme_url();?>img/camera.png">
						<input class="hidden" type="file" id="image" name="image" onchange="readURL(this);">
						<input name="sender_id" type="hidden" value="<?php echo $receiverID ;?>" />
						<input name="reciever_id" type="hidden" value="<?php echo $senderID ;?>"  />

					</div>
				</div>
				<div class="preview">
					<div id="upload-file-container">
						<img id="blah" src="" alt="" style="height: auto !important; max-width: 200px; width:auto;"/>
						<a id="remove" class="" href="javascript:void(0)" onclick="removeImagePreview('')" >
							<span class="glyphicon glyphicon-remove" id="cross" aria-hidden="true" style="display:none"></span></a>
						<span class="add_pdt_img_nc"></span>
						<div class="clearfix"></div>
					</div>
				</div>
				<button onclick="return insertMessage()" class="buyer-btn1" type="button">Send Reply</button>
			</form>
			<hr>
		</div>
		<?php if(is_array($result) && !empty($result) )
		{
			?>
			<form action="" method="post" id="messagedelete" >
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
						<input type="hidden" name="reciever_id" value="<?php echo $senderID ;?>"  />
						<button type="button" class="pull-right buyer-btn" style="width:108px;" onclick="return DeletetMessage()">Delete</button>
					</div>
				</div>
				<div class="actTimeArea" >
					<?php

					$i=1;
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
						?>

						<?php
						if($value['email']==$this->session->userdata('email')){   ?>

						<div class="act-time" id="messagemain<?php echo $value['sender_id'] ;?>">
<!-- sender receiver code of messaging --><div class="row"><div class="col-md-9 pull-right"> 
							<div class="activity-body act-in" style="background-color: #E0DDDD; padding:5px;border-radius:3px;">
								<span class="arrow"></span>
								<div class="text">
									<input type="checkbox" value="<?php echo $value['message_id']; ?>" name="arr_ids[]" class="checkbox1">
									<br><input type="hidden" name="userid<?php echo $value['message_id']; ?>" value="<?php echo $value['user_id'];?>">
									<p class="attribution">
										<a href="<?php echo base_url();?>home/timelinepost/<?php echo $value['user_id']; ?>">
											<img src="<?php echo $MyImage; ?>" alt="" width="30px" height="30px">
											<?php
											echo $value['first_name']." ".$value['last_name'];?></a>
										<em><span class="f-12">(you)</span> &nbsp; <?php
											$created_time = $value['msg_add_date'];
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
									<p><?php
										if($value['message_image'] =='')
										{?>
									<p style="font-size:12px; font-weight:300;"><?php echo $value['message'];?> </p>
									<?php }
									else
									{
									?></p>
									<?php  echo $value['message'];
									$Image =base_url()."uploaded_files/message_image/".$value['message_image'];
									?>
									<div class="preview prouductDisplay">

										<span><p><a><img class="group2" width="40%" href="<?php echo $Image; ?>" src="<?php echo $Image; ?>"></a></p></span>

										
									</div>
									<?php
									} ?>
								</div>
							</div>
						</div></div>

							<?php } else {?>


							<div class="act-time" id="messagemain<?php echo $value['sender_id'] ;?>">

								<div class="row"><div class="col-md-9 pull-left">
								<div class="activity-body act-in" style="background-color: rgba(154,170, 197, 0.58); padding:5px; border-radius:3px;">
									<span class="arrow"></span>
									<div class="text">
										<input type="checkbox" value="<?php echo $value['message_id']; ?>" name="arr_ids[]" class="checkbox1">
										<br><input type="hidden" name="userid<?php echo $value['message_id']; ?>" value="<?php echo $value['user_id'];?>">
										<p class="attribution">
											<a href="<?php echo base_url();?>home/timelinepost/<?php echo $value['user_id']; ?>">
												<img src="<?php echo $MyImage; ?>" alt="" width="30px" height="30px">
												<?php
												echo $value['first_name']." ".$value['last_name'];?></a>
											<em>&nbsp; <?php
												$created_time = $value['msg_add_date'];
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
										<p><?php
											if($value['message_image'] =='')
											{?>
										<p style="font-size:12px; font-weight:300;"><?php echo $value['message'];?> </p>
										<?php }
										else
										{
										?></p>
										<?php  echo $value['message'];
										$Image =base_url()."uploaded_files/message_image/".$value['message_image'];
										?>
										<div class="preview prouductDisplay">
											<span><p><a><img class="group2" width="40%" href="<?php echo $Image; ?>" src="<?php echo $Image; ?>">/a></p></span>
										</div>
										<?php
										} ?>														


									</div>
								</div>
	                          </div>





                           


                           </div>
							<?php } ?>
<!-- 
							<div class="notify-arrow-email notify-arrow-blue-email left"></div> -->
						</div>
					<?php } ?>
				</div>
			</form>
			<?php
		}
		else
		{
			echo "No Message";
		}
	}

	/*Delete Inbox Messages*/
	public function deleteMessages()
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
					$this->db->where('message_id',"$value");
					$this->db->update('tbl_message',$data);
				}
			}
		}
		$this->showMessagesall ($recieverID,$id);
	}

	public function messageCount()
	{
		$message	=	$this->messages_model->MessageCount();
		if ($message > 0)
		{
			echo ($message);
		}

	}
	public function messageNotification()
	{
		$message	=	$this->messages_model->MessageCount();
		?>
		<?php
		$this->load->model('messages/messages_model');
		$this->load->model('user/Users_model');
		$User_Arr = $this->Users_model->getuserInfo($this->session->userdata('email'));
		$logUserId =$User_Arr[0]['user_id'];
		$query = $this->db->query("SELECT *, COUNT(*) FROM `tbl_message` WHERE reciever_id=$logUserId AND reciever_status ='1' group by sender_id ");
		$arra = $query->result_array($query);
		$msg = count($arra);
		?>
		<a data-toggle="dropdown" data-placement="right" title="Send Message" class="dropdown-toggle" href="#" onClick="return ShowMessageNotification();">
								<span id="notification-msg"> <?php if ($message > 0)
									{
										echo $message;
									}?></span><i class="icon_mail_alt"></i>
		</a>
		<ul class="dropdown-menu extended inbox scroll-menu">
			<div class="notify-arrow notify-arrow-blue"></div>
			<?php if($message >0)
			{ ?>
				<li>
					<p class="blue">You Have <?php echo $message; ?> New Messages</p>
				</li>
				<?php
			}
			foreach($arra as $result)
			{
				$query = $this->db->query("SELECT * FROM tbl_users WHERE user_id = $result[sender_id]");
				$qury_result= $query->result_array();
				foreach($qury_result as $keyVal => $Myvalue )
				{

					if($Myvalue['profile_image'] !='')
					{

						$MyImage=substr($Myvalue['profile_image'],0,5);



						if($MyImage=='https'){

							$MyImage=$Myvalue['profile_image'];
						}else{
							$MyImage=base_url().'uploaded_files/profile_img/'.$Myvalue['profile_image'];

						}


						/*$MyImage =base_url()."uploaded_files/profile_img/".$Myvalue['profile_image']*/;
					}
					else
					{
						$MyImage =base_url()."uploaded_files/def_user/index.jpg";
					}
					$senderID = $result['sender_id'];
					?>
					<li>
						<a class="unread " href="<?php echo base_url();?>messages/display_name/<?php echo $senderID ;?>">
							<span class="photo"><img alt="avatar" src="<?php echo $MyImage; ?>"></span>
                                    <span class="subject">
                                    <span class="from"><strong><?php echo $Myvalue['first_name']." ".$Myvalue['last_name'] ;?></strong><p> Sent <?php echo $result['COUNT(*)']; ?> New Message(s)</p></span>
                                    </span>
						</a>
					</li>
				<?php }}?>
		</ul>
		<?php
	}

}




/* End of file demo.php */