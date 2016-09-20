<?php $this->load->view('header'); ?>
<div class="subnavbar hidden-xs">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
		<li><a href="<?php echo base_url();?>travelplans/planschedul"><i class="fa fa-dashboard"></i><span>Dashboard</span> </a> </li>
        <li><a href="<?php echo base_url();?>timelinepost/timeline"><i class="icon_clock_alt"></i><span>Timeline</span> </a> </li>
        <li><a href="<?php echo base_url();?>admin_products/add"><i class="icon_folder-add_alt"></i><span>Add Product</span> </a></li>
        <li><a href="<?php echo base_url();?>admin_products"><i class="glyphicon glyphicon-list"></i><span>My Products</span></a></li>
        <li><a href="<?php echo base_url(); ?>messages/display_name"><i class="icon_mail_alt"></i><span> My Inbox</span> </a> </li>
		<li class="active"><a href="<?php echo base_url(); ?>enquiry/display_name"><i class="fa fa-flask "></i><span>My Enquiry</span> </a> </li>
        <li ><a href="<?php echo base_url();?>user/profile"><i class="fa fa-user"></i><span>My Profile</span> </a> </li>
		<li><a href="<?php echo base_url();?>user/ChangePassword"><i class="fa fa-unlock"></i><span>Change Password</span> </a> </li>
		 
        
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
 
    <!-- Page Content -->
    <div class="page-content ">
        <div class="container">
            <div class="row">
                <!-- full Content -->
                
				
				<div class="col-md-12 ">
				 <div class="col-lg-12 topdashboardForm">
				 <h3>My Enquiry</h3>
				 <div id="no-more-tables col-lg-12">
				  <!--mail inbox start-->
								  
				  <div class="mobile-nav hidden-md hidden-sm hidden-lg">
				  
						 <div class="menu-btn" id="menu-btn pull-left">
						 
						<div></div>
						<span></span>
						<span></span>
						<span></span> 
						
						 </div>
						<span class="pull-left nameheading">Mail name list</span>
							<span class="clearfix"> </span>						
						 <div class="responsive-menu">
						 <?php 
							if(is_array($res) && !empty($res))
							{
							foreach($res as $row=> $pageValue)
							{
								if($pageValue['profile_image'] !='')
								{

									 $userImage=substr($pageValue['profile_image'],0,5);

                               

                                if($userImage=='https'){
                                  
                                    $userImage=$pageValue['profile_image'];

                                }else{

                               $userImage=base_url().'uploaded_files/profile_img/'.$pageValue['profile_image'];
                                   
                                }

									/*$userImage =base_url()."uploaded_files/profile_img/".$pageValue['profile_image'];*/									
								}
								else
								{
									$userImage =base_url()."uploaded_files/def_user/index.jpg";
								}
								$this->load->model('user/Users_model');
									$User_Arr = $this->Users_model->getuserInfo($this->session->userdata('email'));
									$logUserId =$User_Arr[0]['user_id'];
								?>
							<ul>
							<?php if($pageValue['sender_id'] == $logUserId)
								  { 

								   /**/?>
							   <li>
							     <div class="user-head">
								  <?php $query = $this->db->query("SELECT * FROM tbl_users WHERE user_id = $pageValue[reciever_id]");
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

									}
									else
									{
										$MyImage =base_url()."uploaded_files/def_user/index.jpg";
									}											
									?>
                          <a href="javascript:void(0);" class="inbox-avatar" onclick="return messageById('<?php echo $pageValue['reciever_id']; ?>','<?php echo $pageValue['sender_id']; ?>')">
                              <img src="<?php echo $MyImage; ?>" alt="">
                          </a>&nbsp;&nbsp;
                          <div class="user-name">
                              <h5><a href="javascript:void(0);" onclick="return messageById('<?php echo $pageValue['reciever_id']; ?>','<?php echo $pageValue['sender_id']; ?>')"><?php echo $Myvalue['first_name'].'&nbsp;'.$Myvalue['last_name']; ?></a></h5>
                          </div>
									<?php } ?>
                      </div>  </li>
								  <?php } else
								  {?>
							  <li>
							     <div class="user-head">
                          <a href="javascript:void(0);" class="inbox-avatar" onclick="return messageById('<?php echo $pageValue['sender_id']; ?>','<?php echo $pageValue['reciever_id']; ?>')">
                              <img src="<?php echo $userImage; ?>" alt="" width="60" height="60" class="img-circle">
                          </a>&nbsp;&nbsp;
                          <div class="user-name">
                              <h5><a href="javascript:void(0);" onclick="return messageById('<?php echo $pageValue['sender_id']; ?>','<?php echo $pageValue['reciever_id']; ?>')"><?php echo $pageValue['first_name'].'&nbsp;'.$pageValue['last_name']; ?></a></h5>
                          </div>
                      </div>  </li>
							</ul> 
							<?php } } } else
							{
								echo "Member List Empty";
							}?>
						 </div>						  
					</div>
				  
              <div class="mail-box ">
                  <aside class="sm-side col-lg-4 hidden-xs card-gobarra text-center">
                  	<div class="m-t-20 f-18 w-800">
				  <?php 
					if(is_array($res) && !empty($res))
					{
					foreach($res as $row=> $pageValue)
					{
						if($pageValue['profile_image'] !='')
						{



										 $userImage=substr($pageValue['profile_image'],0,5);

                               

		                                if($userImage=='https'){
		                                  
		                                    $userImage=$pageValue['profile_image'];

		                                }else{

		                             $userImage=base_url().'uploaded_files/profile_img/'.$pageValue['profile_image'];
		                              }
							/*$userImage =base_url()."uploaded_files/profile_img/".$pageValue['profile_image'];*/									
						}
						else
						{
							$userImage =base_url()."uploaded_files/def_user/index.jpg";
						}
                      /* print_r($pageValue);*/

						$this->load->model('user/Users_model');
									$User_Arr = $this->Users_model->getuserInfo($this->session->userdata('email'));
									$logUserId =$User_Arr[0]['user_id'];
									/*echo $logUserId;
									echo $pageValue['sender_id'];*/
						?>
                      <?php if($pageValue['sender_id'] == $logUserId)
						{ 
						/**/?><!--</div>
					  <div class="user-head">
					   <?php /*$query = $this->db->query("SELECT * FROM tbl_users WHERE user_id = $pageValue[reciever_id]");
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

																
									}
									else
									{
										$MyImage =base_url()."uploaded_files/def_user/index.jpg";
									}											
									*/?>
                          <a href="javascript:void(0);" class="inbox-avatar" onclick="return messageById('<?php /*echo $pageValue['reciever_id']; */?>','<?php /*echo $pageValue['sender_id']; */?>')">
                              <img src="<?php /*echo $MyImage; */?>" alt="">
                          </a>
                          <div class="user-name m-t-20">
                              <h5><a href="javascript:void(0);" onclick="return messageById('<?php /*echo $pageValue['reciever_id']; */?>','<?php /*echo $pageValue['sender_id']; */?>')"><?php /*echo $Myvalue['first_name'].'&nbsp;'.$Myvalue['last_name']; */?></a></h5>
                          </div>
						<?php /*} */?>
                      </div>
					  --><?php } else
					  { 
						?>
					   <div class="user-head ">					 
                          <a href="javascript:void(0);" class="inbox-avatar" onclick="return messageById('<?php echo $pageValue['sender_id']; ?>','<?php echo $pageValue['reciever_id']; ?>')">
                              <img src="<?php echo $userImage; ?>" alt="">
                          </a>&nbsp;&nbsp;
                          <div class="user-name">
                              <h5><a href="javascript:void(0);" onclick="return messageById('<?php echo $pageValue['sender_id']; ?>','<?php echo $pageValue['reciever_id']; ?>')"><?php echo $pageValue['first_name'].'&nbsp;'.$pageValue['last_name']; ?></a></h5>
                          </div>						 
                      </div> 
						<?php }} }else
					{
						echo "Member List Empty";
						
					}?>
                  </aside>
				  
				  <!--loop-->			
				 
                  <aside class="lg-side card-gobarra col-lg-6" style="overflow-y:scroll;"> 
                      <div class="inbox-body" id="enquiryBox">  
					
						<?php
							if(is_array($result) && !empty($result) )
								{
								$receiverID = $this->uri->segment(3);
								$this->load->model('user/Users_model');
								$User_Arr = $this->Users_model->getuserInfo($this->session->userdata('email'));
								$senderID =$User_Arr[0]['user_id'];
								?>
						<div class="bg leftDetailsSecBottom ">					
						 <?php $query = $this->db->query("SELECT * FROM tbl_users WHERE user_id = $receiverID"); 
							$qury_result= $query->result_array();							
							foreach($qury_result as $keyVal => $Myvalue )
							{ ?> 
						  <h3>Enquiry To <a href="<?php echo base_url();?>home/timelinepost/<?php echo $Myvalue['user_id']; ?>"><strong class="mssg-name"><?php echo $Myvalue['first_name']."&nbsp;".$Myvalue['last_name']; ?></strong></a></h3>
						 <?php }?>
						  <form id="replyEnquiry" enctype="multipart/form-data" name="formuploading" role="form" >
							<div class="form-group uploadIcon">
							   <textarea name="enquiry" id="message" title="Write Your Enquiry" placeholder="write Your Enquiry" class="form-control"></textarea>								
								<input name="reciever_id" type="hidden" value="<?php echo $receiverID; ?>" />
								<input name="sender_id" type="hidden" value="<?php echo  $senderID ; ?>" />				
							</div>						
								<button onclick="return insertEnquiry()" class="buyer-btn1" style="width:108px;" type="button">Send Reply</button>
							  </form>
							 </div>
				
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
                                  <input type="hidden" name="reciever_id" value="<?php echo $receiverID ;?>">
								   <input type="hidden" name="sender_id" value="<?php echo $senderID ;?>">
								 <button type="button" class="pull-right buyer-btn" style="width:108px;" onclick="return DeletetEnquiry()">Delete</button>
                             </div>  
                         </div>
						 
						 <div class="actTimeArea" > 
					 <?php
						foreach($result as $key=>$value)
							
						{
						if($value['profile_image'] !='')
						{
                             $MyImage=substr($value['profile_image'],0,5);

                               

		                                if($MyImage=='https'){
		                                  
		                                    $MyImage=$value['profile_image'];

		                                }else{

		                             $MyImage=base_url().'uploaded_files/profile_img/'.$value['profile_image'];
		                              }
		                              



							/*$MyImage =base_url()."uploaded_files/profile_img/".$value['profile_image'];	*/								
						}
						else
						{
							$MyImage =base_url()."uploaded_files/def_user/index.jpg";
						}		


					?>

					 <div class="act-time" id="enquirymain<?php echo $value['sender_id'] ;?>"> 
					 
								  <div class="activity-body act-in">
									  <span class="arrow"></span>
								<div class="text">
									<input type="checkbox" value="<?php echo $value['enquiry_id']; ?>" name="arr_ids[]" class="checkbox1">
									<input type="hidden" name="userid<?php echo $value['enquiry_id']; ?>" value="<?php echo $value['sender_id'];?>">
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
										  <p><?php echo $value['enquiry']; ?></p>																			 
									  </div>
								  </div>
								 <!--  <div class="notify-arrow-email notify-arrow-blue-email left"></div> -->
					  </div>




				<?php } ?>					  
				</div>
				</form>
	<?php			
				}
				else
				{ ?>
					
					<div class="actTimeArea"> 
				
					 <div class="act-time1 hidden-xs gender-m-l1 m-t-200gobarra p-65">

						<div class="activity-body act-in">
						<span class="arrow"></span>
						<div class="text">									  
						<p class="attribution"><a href="javascript:void(0)" class="white-c text-center m-l-25">Click Left To See Enquiry </a></p>
						</div>


						</div>
					  </div>									
				</div>		
					
			<?php	}
				?>					  
					  <!--loop-->
					  </div>
                  </aside>
              </div>
              <!--mail inbox end-->
				 
					</div>
				 </div> 								
				</div> 
				
				
                <!-- full Content-->
 
            </div>
            <!-- /.container -->

        </div>
</div>

        <!-- Page Content -->
		<?php $this->load->view('footer'); ?>
		<!--Ajax Function For Show, Insert, Delete Enquiry-->
		<script>
				function messageById(senderID,receiverID)
						{
						var data = "senderID="+senderID+ "&receiverID="+receiverID;		
							$.ajax({
								url:"<?php echo site_url('enquiry/showEnquiry'); ?>",
								type:"POST",
								data:data,
								success:function(output){
											$('#enquiryBox').html(output);
										}
								});	
						}
						
				function insertEnquiry()
				{
					var x = document.forms["formuploading"]["enquiry"].value;
					if (x == null || x == "") {
						alert("Enquiry must be filled out");
						return false;
					}
				var data = new FormData($('#replyEnquiry')[0]);
					
					$.ajax({
						type: "POST",               
						processData: false, // important
						contentType: false, // important
						data: data,
						url: "<?php echo site_url('enquiry/insertEnquiry');?>",
						dataType : 'html',  
						success: function(output){
								$('#enquiryBox').html(output);							
						}
					}); 
				}
					
					function DeletetEnquiry(){
					var r = confirm('Are You Sure want to Delete');
					if(r === false){
					return false;
					} else {
					var data = new FormData($('#enquiryDelete')[0]);				
					$.ajax({
						type: "POST",               
						processData: false, // important
						contentType: false, // important
						data: data,
						url: "<?php echo site_url('enquiry/deleteEnquiry');?>",
						dataType : 'html',  
						success: function(output){
								$('#enquiryBox').html(output);							
						}
					}); 
				}		
	}
						
				</script>