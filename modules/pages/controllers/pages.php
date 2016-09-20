<?php
class Pages extends Public_Controller
{

		public function __construct() {
		
				parent::__construct(); 				
				$this->load->library(array('Dmailer'));	
				$this->load->model(array('pages/pages_model'));
				$this->form_validation->set_error_delimiters("<div class='required'>","</div>");
		
		}
		
		public function index()
		{
							 			 			 
			 $friendly_url = $this->uri->rsegments[3];	
			 		 
		     $condition       = array('friendly_url'=>$friendly_url,'status'=>'1');			 
			 $content         =  $this->pages_model->get_cms_page( $condition );				 
			 $data['content'] = $content;			 
			 $this->load->view('pages/cms_page_view',$data);	
			
		}			
		
		
		public function contactus()
		{			    
		 			
			$this->form_validation->set_rules('first_name','First Name','trim|alpha|required|max_length[30]');
			$this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[80]');
			$this->form_validation->set_rules('phone_number','Phone','trim|max_length[20]');	
			$this->form_validation->set_rules('mobile','Mobile','trim|required|max_length[20]');			
			$this->form_validation->set_rules('message','Message','trim|required|max_length[8500]');		
			$this->form_validation->set_rules('verification_code','Verification code','trim|required|valid_captcha_code');
			
			if($this->form_validation->run()==TRUE)
			{			
			  				
				$posted_data=array(				
				'first_name'    => $this->input->post('first_name'),
				'email'         => $this->input->post('email'),
				'phone_number'  => $this->input->post('phone_number'),
				'mobile'		=> $this->input->post('mobile'),		
				'message'       => $this->input->post('message'),				
				'receive_date'     =>$this->config->item('config.date.time')
				);
				
				$this->pages_model->safe_insert('wl_enquiry',$posted_data,FALSE); 
				
				/*---User Mail ---*/
				$mail_to      = $this->input->post('email');
				$mail_subject = 'Contact Us'; 				
				$from_email   = $this->admin_info->admin_email;
				$from_name    =  $this->config->item('site_name');				
				$body = "Dear ".$this->input->post('first_name').",<br /><br />	";					
				$body .= 'Thanks for Enquiry in '.$this->config->item('site_name');				
				$body .= "<br /> <br />						   
									Thanks and Regards,<br />						   
									".$this->config->item('site_name')." Team ";		
				$this->email->from($from_email,$from_name);
				$this->email->to($mail_to);			
				$this->email->subject($mail_subject);				
				$this->email->message($body);
				$this->email->set_mailtype('html');
				$this->email->send();
				/*---End USER Mail ---*/
				
				/*---Admin Mail ---*/
				$mail_to      = $this->admin_info->admin_email;
				$mail_subject = 'Contact Us'; 				
				$from_email   = $this->input->post('email');
				$from_name    =  $this->config->item('site_name');				
				$body = "Dear Admin,<br /><br />	";	
				$body .= "Enquiry  has been submitted with following info : <br /><br />	";					
				$body .= 'Name : '.$this->input->post('first_name');
				$body .= '<br /><br />Phone : '.$this->input->post('phone_number');	
				$body .= '<br /><br />Mobile : '.$this->input->post('mobile');	
				$body .= '<br /><br />Email : '.$this->input->post('email');	
				$body .= '<br /><br />Message : '.$this->input->post('message');	
				$body .= "<br /> <br />						   
									Thanks and Regards,<br />						   
									".$this->config->item('site_name')." Team ";
											
				$this->email->from($from_email,$from_name);
				$this->email->to($mail_to);			
				$this->email->subject($mail_subject);				
				$this->email->message($body);
				$this->email->set_mailtype('html');
				$this->email->send();
				/*---End Admin Mail ---*/
				
				
				$this->session->set_userdata(array('msg_type'=>'success'));
				$this->session->set_flashdata('success', 'Your feedback has been added successfully.We will get back to you soon.'); 
				redirect('pages/contactus', ''); 
				
			}
			 $friendly_url = $this->uri->segment(2);			
			 $condition       = array('friendly_url'=>$friendly_url,'status'=>'1');			 
			 $content         =  $this->pages_model->get_cms_page( $condition );
			 $data['content'] = $content['page_description'];				
			 $data['title'] = "Contact Us";
			 $this->load->view('contactus',$data);	
		
		}
		
		
		public function sitemap()
		{			
			$data['title'] = "Contact Us";
			$this->load->view('sitemap',$data);	
		}
				
	   public function subscribe_newsletter()
	   {
		  
			$subscriber_name	=	$this->input->post('name');
			$subscriber_email	=	$this->input->post('email');
			$subscribe_me		=	$this->input->post('subscribe');
			
			if(strtolower($this->input->post('varification_code'))==strtolower($this->session->userdata('securimage_code_value')))
			{
				$query = $this->db->query("SELECT subscriber_email,status FROM  wl_newsletters 
											WHERE subscriber_email='$subscriber_email'");
			
				if( $query->num_rows() > 0 )
				{
						$row = $query->row_array();
										  
					if( $row['status']=='0' && ($subscribe_me=='Y') )
					{
						$where = "subscriber_email = '".$row['subscriber_email']."'"; 						
						$this->pages_model->safe_update('wl_newsletters',array('status'=>'1'),$where,FALSE);					
						echo $msg =  $this->config->item('newsletter_subscribed');
					}
					else if($row['status']=='0' && ($subscribe_me=='N'))
					{
						echo $msg =  $this->config->item('newsletter_not_subscribe');
						
					}
					else if($row['status']=='1' && ($subscribe_me=='Y'))
					{
						echo $msg =  $this->config->item('newsletter_already_subscribed');
						
					}
					else if($row['status']=='1' && ($subscribe_me=='N'))
					{										
						$where = "subscriber_email = '".$row['subscriber_email']."'"; 						
						$this->pages_model->safe_update('wl_newsletters',array('status'=>'0'),$where,FALSE);					  	
						echo $msg =  $this->config->item('newsletter_unsubscribed');
					}			
				}
				else
				{
					 $data =  array('status'	=>'1',
									 'subscriber_name'	=>$subscriber_name,
									 'subscriber_email'	=>$subscriber_email,
									 'subscribe_date'	=>$this->config->item('config.date.time'));					 			
									  $this->pages_model->safe_insert('wl_newsletters',$data); 
									  echo $msg =  $this->config->item('newsletter_subscribed');
				}
			}
			else
			{
				echo "Word verification code is invalid.";	
				return FALSE;
			}
	}
		
	  public function join_newsletter()
	  {
		 	 echo $subscriber_name        = $this->input->post('subscriber_name',TRUE);
			 $subscriber_email       = $this->input->post('subscriber_email',TRUE);
			 $subscribe_me           = $this->input->post('subscribe_me',TRUE);		
			 		 
			 $this->form_validation->set_rules('subscriber_name', 'Name', "trim|required|alpha|max_lenght[32]");			 
			 $this->form_validation->set_rules('subscriber_email', 'Email ID', "trim|required|valid_email|max_lenght[80]");
			 
			  if ($this->form_validation->run() == TRUE)
			  {					
					$posted_data = array('subscriber_name'=>$subscriber_name,
					                     'subscriber_email'=>$subscriber_email,
										  'subscribe_me'=>$subscribe_me
										 );					
				    $result      =  $this->subscribe_newsletter($posted_data);
				
					if( $result )
					{
					  	
					   echo '<div style="color:#FF0000">'.$result.'</div>';
					   
					}
					
					 
				 }else
				 {
					  echo '<div style="color:#FF0000"><font size="-1">'.validation_errors().'</font></div>';
					  
				 }				 
			
		
	  }
	  
	  
	public function refer_to_friends()
	{		
	
	  		
		$productId        = (int) $this->uri->segment(3);
		$product_link_url =  base_url()."products/detail/$productId";
						
		$data['heading_title'] = "Refer to a Friend";			
		$this->form_validation->set_rules('your_name','Name','trim|required|alpha|xss_clean|max_length[100]');
		$this->form_validation->set_rules('your_email','Email','trim|required|valid_email|xss_clean|max_length[100]');
		$this->form_validation->set_rules('friend_name','Friend\'s Name','trim|required|alpha|xss_clean|max_length[100]');
		$this->form_validation->set_rules('friend_email','Friend\'s Email','trim|required|valid_email|xss_clean|max_length[100]');
		
		$this->form_validation->set_rules('verification_code','Verification code','trim|required|valid_captcha_code');
	   
	   
		if($this->form_validation->run()==TRUE)
		{
			
			
				$your_name     = $this->input->post('your_name',TRUE);
				$your_email    =  $this->input->post('your_email',TRUE);
				$friend_name   = $this->input->post('friend_name',TRUE);
				$friend_email  = $this->input->post('friend_email',TRUE);
				
				$conditions   = "your_email ='$your_email' AND friend_email ='$friend_email' ";
				$count_result = $this->pages_model->findCount('wl_invite_friends',$conditions);
					
				if( !$count_result )
				{
					$posted_data =  array('your_name'=>$your_name,
					'your_email'=>$your_email,
					'friend_name'=>$friend_name,
					'friend_email'=>$friend_email,
					'receive_date'=>$this->config->item('config.date.time')
					);									
					$this->pages_model->safe_insert('wl_invite_friends',$posted_data); 	
				}
			
		   $content    =  get_content('wl_auto_respond_mails','3');	
		   $body       =  $content->email_content;	
			
			if($productId > 0 )
			{
				$link_url = $product_link_url;	
				$link_url= "<a href=".$link_url.">Click here </a>";
				$text ="Product";
				$this->session->set_userdata(array('msg_type'=>'success'));			
			    $this->session->set_flashdata('success',$this->config->item('product_referred_success'));
				
			}else
			{
				$link_url = base_url();
				$link_url= "<a href=".$link_url.">Click here </a>";
				$text ="Site";	
				$this->session->set_userdata(array('msg_type'=>'success'));			
			    $this->session->set_flashdata('success',$this->config->item('site_referred_success'));
				
			}
			
			
			
			$body			=	str_replace('{friend_name}',$friend_name,$body);
			$body			=	str_replace('{your_name}',$your_name,$body);			
			$body			=	str_replace('{site_name}',$this->config->item('site_name'),$body);	
			$body			=	str_replace('{text}',$text,$body);				
			$body			=	str_replace('{site_link}',$link_url,$body);	
							
			$mail_conf =  array(
			'subject'=>"Invitation from ".$your_name." to see",
			'to_email'=>$friend_email,
			'from_email'=>$your_email,
			'from_name'=>$your_name,
			'body_part'=>$body
			);				
			$this->dmailer->mail_notify($mail_conf);			
			redirect('pages/refer_to_friends', ''); 			
			$this->load->view('pages/view_refer_to_friend',$data);			
			
		}
		
		$this->load->view('pages/view_refer_to_friend',$data);
		
	}
	
	
	
	
		

}

/* End of file pages.php */