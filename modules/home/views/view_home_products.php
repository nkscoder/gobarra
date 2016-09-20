<?php $this->load->view('header');?>
    <!-- Header -->
   <div class="subnavbar hidden-xs">
        <div class="clearfix"></div>
        <!-- /subnavbar-inner -->
    </div>
    <!-- /.intro-header -->

    <!-- Page Content -->
	
	<!-- Trigger the modal with a button -->
    <div class="page-content adjest">
        <div class="container">
            <div class="row">
				<div class="col-md-12 ">
                    <div class="col-lg-12 topdashboardForm">
						<div class="col-lg-12">
                            <h2 class="element">
                               <i class="fa fa-plane" style="color:#FFE763" aria-hidden="true"></i>&nbsp;<span style="color:#91C181">Earn While You Fly</span>&nbsp;<i class="fa fa-plane" style="color:#FFE763" aria-hidden="true"></i>
                            </h2>
                        </div>
                <!-- left Sidebar Content -->
                <?php //$this->load->view('left_ads');?>
                <!-- left Sidebar Content end-->

                <!-- Right Sidebar Content -->
                <div class="col-sm-12 col-xs-12 col-md-8 content">
                    <!--header-->
                    <div class="homeFormArea">
                        <ul class="nav nav-tabs">
							<li><a   href="<?php echo base_url(); ?>home">Search Travelers</a></li>
                            <li class="active">
							<a href="<?php echo base_url();?>home/product_details">Ready Buyers</a>
                            </li>
                        </ul>
					<?php
                            $path = current_url_query_string();
                            echo form_open('home/product_search', array('name' => "frmbuy", 'method' => 'get'),$path);
                            ?>
                        <div class="tab-content">
                            <div id="home" class="tab-pane fade in active">
                                <div class="col-lg-12">

                                    <div class="row m-t-20">
                                        <div class="form-group col-lg-5 col-xs-6 col-sm-5 something">
                                            <label class="size">By Country</label>
                                            <div class="fixArea">
                                                <input type="text" data-placement="left" name="country_name" title="Search By Country" autocomplete="off" class="form-control" placeholder="Type Your Country" id="bycountry">
												<!--<input type="hidden" id="country_id" name="country_id">-->
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-2  col-xs-2 col-sm-2 hidden-xs dividericon">
                                            <div class="fixArea">
                                                <img alt="" src="<?php echo theme_url(); ?>img/left-right.png">
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-5 col-xs-6  col-sm-5 something">
                                            <label class="size">By City</label>
                                            <div class="fixArea">
                                             <input type="text" data-placement="left" name="city_name" title="Search By City" autocomplete="off" class="form-control" placeholder="Type Your City" id="bycity">
												<!--<input type="hidden" id="city_id" name="city_id">-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fixArea">
                                        <button title="Click To Search" class="buyer-btn m-b-20" id="button" type="submit">Search</button>
                                    </div>
                                </div>
                                <div class="clearFix"></div>
                            </div>
                        </div>
						<?php echo form_close();?>
			<!--product listing start here -->
                        <!--Travel-->
					<?php if(!empty($res_array))
					{	
					//print_r($res_array);
						foreach($res_array as $key => $product_value)	
						{	
						if( $product_value['profile_image'] !='')
						{
                                $img=substr($product_value['profile_image'],0,5);

                               

                                if($img=='https'){
                                  
                                    $img=$product_value['profile_image'];

                                }else{

                               $img=base_url().'uploaded_files/profile_img/'.$product_value['profile_image'];
                                   
                                }

						/*$img=base_url().'uploaded_files/profile_img/'.$product_value['profile_image'];*/



						}
						else
						{
						$img=base_url().'uploaded_files/def_user/dummy.png';	
						}
							?>
                        <div class="rowPOst"> 
						
				 <div class="partnerResult">
					<div class="partnerPhoto">
						<a href="<?php echo base_url();?>home/timelinepost/<?php echo $product_value['user_id']; ?>"><img src="<?php echo $img; ?>" width="75px" height="75px">
					</div>
					
							<?php $this->load->model('user/users_model'); 
                              $email     =$this->session->userdata('email');
                              $usrinfo   =$this->users_model->getuserInfo($email);
                              $senderId=$usrinfo[0]['user_id'];
							  //print_r($senderId); die;
							  ?>
					<div class="partnerInfo">
						<div class="partnerName"><?php echo $product_value['product_name']; ?> &nbsp;<em class="smallText">Added by</em>&nbsp;<a href="<?php echo base_url();?>home/timelinepost/<?php echo $product_value['user_id']; ?>"> <?php echo $product_value['first_name'].'&nbsp'.$product_value['last_name']; ?></a> <br>
						 <span><?php echo $product_value['country_id']; ?>(<?php echo $product_value['city_id']; ?>)</span>
					 </div>
							<?php 
							$recieverId = $product_value['user_id'];
							if($senderId != $recieverId)
							{
							?>
							<div class="partnerDate inquiry">							
							 <a href="#" data-toggle="modal" data-target="#myModal<?php echo $product_value['product_id']; ?>">
									  <i class="fa fa-envelope-o"></i> Enquiry 
                                    </a>								
							<div id="myModal<?php echo $product_value['product_id']; ?>" class="modal fade" role="dialog">
								<div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
								  <div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title pull-left">Send Your Enquiry</h4>
								  </div>								 
								  <div class="modal-body">								  
								   <div class="modal-footer">
								    <form role="form" class="form-group" name="replyEnquiry" id="replyEnquiry<?php echo $product_value['product_id']; ?>">								  									
									<textarea name="enquiry" id="enquiry<?php echo $product_value['product_id']; ?>" class="form-control enquirymsg"></textarea>
									<input type="hidden" name="senderId" value="<?php echo $senderId ; ?>" >	
									<input type="hidden" name="recieverId" value="<?php echo $product_value['user_id'] ; ?>" >
									<button type="button" class="btn btn-default" onclick="return insertenquiry('<?php echo $product_value['product_id']; ?>')">Send</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<div class="sentmessage" id="enquirysuccess<?php echo $product_value['product_id']; ?>"></div>
									</form>
									</div>									
									</div>
								</div>

							  </div>
							</div>						
					</div>
					<?php } ?>
						<div class="partnerInterests">
					 <span class="show-read-more"> <?php echo $product_value['description'];?></span>
						   <!-- Trigger the modal with a button --> 
						 					                                     
						 </div>
						<div class="partnerSupport">
						 	<div class="cellSub">
							 <?php
											if($product_value['img1']!='')
											{
                                             $target_path = base_url()."uploaded_files/product_image1/".$product_value['img1'];
											}
											else
                                            {
                                              $target_path= base_url()."uploaded_files/def_user/dummy.png";
                                            }
                                            ?>
										<?php
											if($product_value['img2']!='')
											{
                                             $target_path1 = base_url()."uploaded_files/product_image2/".$product_value['img2'];
											}
											else
                                            {
                                              $target_path1= base_url()."uploaded_files/def_user/dummy.png";
                                            }
                                            ?>
									<div class="preview prouductDisplay">
									<span><p><a><img src="<?php echo $target_path; ?>" alt="" class="group3" href="<?php echo $target_path; ?>"></a></p></span> 
									<span><p><a><img src="<?php echo $target_path1;?>" alt="" class="group4" href="<?php echo $target_path1; ?>"></a></p></span>
									</div>
								</div>
								<?php
								$this->load->model('home/home_model');								
								 $userid = $product_value['user_id'] ;
								 //print_r($id);
								 $query = $this->db->query("SELECT COUNT(*) FROM `tbl_products` WHERE user_id=$userid");								
								$arra = $query->result_array($query);					
								foreach($arra as $result)
								{
								if($result['COUNT(*)']>1)
								{
								?>
						<a href="<?php echo base_url();?>home/more_products/<?php echo $product_value['user_id'] ;?>">More products from this buyer</a>
<?php }} ?>					
						</div>
					</div>
				</div>
				 </div>
					<?php }?>					
				<!--product listing end here-->					
				<?php echo $page_links; ?>
					<?php }
						else
						{
							echo "Sorry No Products Found";
						}?>
				<div class="clearfix"></div>
                    </div>
                    <!-- Right Sidebar Content end-->
                </div>
				<?php if(@$this->session->userdata('is_logged_in')){ ?> 
				<div class="col-sm-4 col-xs-12 col-md-4 readybuyers">
                            <div class="bg leftDetailsSec">
                                <h4 style=" font-size: x-large; font-weight: 600; color: #52504E; text-align:center;   ">Connected Members</h4>
								<?php $this->load->model('home/home_model');
								$connect_user = $this->home_model->getMembers();
								?>
											<div class='oh'>
											<?php foreach($connect_user as $row_connect => $Connected_user)
											{ 
											?>
                                    <div class='abox b1'>
									<?php if($Connected_user->profile_image !='') 
									{
                                           $img=substr($Connected_user->profile_image,0,5);

                                     if($img=='https'){
                                  
                                    $img=$Connected_user->profile_image;

                                       }else{

                                      $img=base_url().'uploaded_files/profile_img/'.$Connected_user->profile_image;
                                   
                                        }
                                           


									/*$img = base_url()."uploaded_files/profile_img/".$Connected_user->profile_image;*/
									}
									else
									{
									$img = base_url()."uploaded_files/def_user/dummy.png";
									}
									$userId = $Connected_user->user_id ;
									$name = $Connected_user->first_name."&nbsp;".$Connected_user->last_name;
									?>
                                        <a href="<?php echo base_url();?>home/timelinepost/<?php echo $userId;?>">
                                            <img src="<?php echo $img; ?>" width="100px" height="80px">
                                        </a>
                                    </div>
                                <?php } ?>
                                </div>

                            </div>
                        </div>
						<?php } else { ?>
						<div class="col-sm-4 col-xs-12 col-md-4 readybuyers">
                            <div class="bg leftDetailsSec">
                                <h4 style="font-size: larger; color: #100101; font-weight: 600;">Connected Members</h4>
								<?php $this->load->model('home/home_model');
								$connect_user = $this->home_model->getMembers();
								?>
											<div class='oh'>
											<?php foreach($connect_user as $row_connect => $Connected_user)
											{ 
											?>
                                    <div class='abox b1'>
									<?php if($Connected_user->profile_image !='') 
									{
                                     
                                      $img=substr($Connected_user->profile_image,0,5);

                                     if($img=='https'){
                                  
                                         $img=$Connected_user->profile_image;

                                       }else{

                                  $img=base_url().'uploaded_files/profile_img/'.$Connected_user->profile_image;
                                   
                                        }


									/*$img = base_url()."uploaded_files/profile_img/".$Connected_user->profile_image;
*/

									}
									else
									{
									$img = base_url()."uploaded_files/def_user/dummy.png";
									}
									$userId = $Connected_user->user_id ;
									$name = $Connected_user->first_name."&nbsp;".$Connected_user->last_name;
									?>
                                        <a href="javascript:void(0);">
                                            <img src="<?php echo $img; ?>" width="100px" height="80px">
                                        </a>
                                    </div>
                                <?php } ?>
                                </div>

                            </div>
                        </div>
						<?php } ?>
						<?php if(@$this->session->userdata('is_logged_in')) { ?>
						<div class="col-sm-4 col-xs-12 col-md-4 readybuyers">
                            <div class="bg leftDetailsSec">
                                <h4 style="font-size: x-large; font-weight: 600; color: #52504E; text-align:center;">Top 10 Travellers!</h4>
                                <div class="list-container">
                                    <h1>Recent visited Travellers!</h1>

                                    <ul class="scale-up-hover-list">
                                        <marquee behavior="scroll" direction="down" scrolldelay="250" onmouseover="this.stop();" onmouseout="this.start();">
										<?php 
											 foreach($res as $catKey=>$pageVal)
											 {						
										?>
                                            <li>
                                                <a href="<?php echo base_url();?>home/timelinepost/<?php echo $pageVal['user_id']; ?>" target="_blank">
                                                    <div class="date">
                                                        <p class="day"><?php 
													$originalDate = $pageVal['from_date'];
													$newDate = date("d", strtotime($originalDate));
													echo $newDate ; ?></p>
                                                        <p class="month"><?php 
													$originalDate = $pageVal['from_date'];
													$newDate = date("F", strtotime($originalDate));
													echo $newDate ; ?></p>
                                                    </div>
                                                    <div class="item-info-container">
                                                        <h1><?php echo $pageVal['first_name'] ;?> <?php echo $pageVal['last_name'] ; ?>  Is Traveling From 
														<?php echo $pageVal['travel_from'];?></h1>
                                                        <p class="item-description" style="width: 250px;">

                                                            <img src="<?php echo theme_url();?>/images/email-icon.png" width="50" style="margin-left: -14px;" /><?php echo $pageVal['email']; ?><br />
                                                            <img src="<?php echo theme_url();?>/images/phone-icon.png" width="20" />&nbsp Call us  <?php echo $pageVal['mobile'];?>
                                                        </p>
                                                    </div>
                                                </a>
                                            </li>
											<?php } ?>
                                            <hr />
									 </marquee>
                                    </ul>
                                </div>
                            </div>
                        </div>
				<?php } else { ?>
				<div class="col-sm-4 col-xs-12 col-md-4 readybuyers">
                            <div class="bg leftDetailsSec">
                                <h4 style="font-size: x-large; font-weight: 600; color: #52504E;">Top 10 Travellers!</h4>
                                <div class="list-container">
                                    <h1>Recent visited Travellers!</h1>

                                    <ul class="scale-up-hover-list">
                                        <marquee behavior="scroll" direction="down" scrolldelay="250" onmouseover="this.stop();" onmouseout="this.start();">
										<?php 
											foreach($res as $catKey=>$pageVal)
											{						
											?>
                                            <li>
                                                <a href="javascript:void(0);" target="_blank">
                                                    <div class="date">
                                                        <p class="day"><?php 
													$originalDate = $pageVal['from_date'];
													$newDate = date("d", strtotime($originalDate));
													echo $newDate ; ?></p>
                                                        <p class="month"><?php 
													$originalDate = $pageVal['from_date'];
													$newDate = date("F", strtotime($originalDate));
													echo $newDate ; ?></p>
                                                    </div>
                                                    <div class="item-info-container">
                                                        <h1><?php echo $pageVal['first_name'] ;?> <?php echo $pageVal['last_name'] ; ?> Is Traveling From
													<?php echo $pageVal['travel_from'];?></h1>
                                                        <p class="item-description" style="width: 250px;">

                                                            <img src="<?php echo theme_url();?>/images/email-icon.png" width="50" style="margin-left: -14px;" /><?php echo $pageVal['email']; ?><br />
                                                            <img src="<?php echo theme_url();?>/images/phone-icon.png" width="20" />&nbsp Call us  <?php if($pageVal['mobile'] !=''){
															echo $pageVal['mobile']; } else{
															echo "No Contact"; }
															?>
                                                        </p>
                                                    </div>
                                                </a>
                                            </li>
											<?php } ?>
                                            <hr />
										 </marquee>
                                    </ul>
                                   
                                </div>
                            </div>
                        </div>
				<?php } ?>
				
            </div>
            </div>
            </div>
            <!-- /.container -->
        </div>
    </div>
        <!-- Page Content -->
       <?php $this->load->view('footer'); ?>
	   <script>
				function insertenquiry(postId)
				{	
				setTimeout(function(){
				  $("#enquirysuccess"+postId).fadeOut("slow", function () {
				  $("#enquirysuccess"+postId).remove();
					  });
					  },5000);
					  
				var str = $('#enquiry'+postId).val();
				function trim(str) {
				return str.replace(/^\s+|\s+$/g,"");
				}
					if ((str ==''))
					{
					$('#enquiry'+postId).val('');
					alert ("Please Enter Enquiry");
					return false;
				}
				else
				{		
				var data = new FormData($('#replyEnquiry'+postId)[0]);
					$('#enquiry'+postId).val('');
					$.ajax({
						type: "POST",               
						processData: false, // important
						contentType: false, // important
						data: data,
						url: "<?php echo site_url('home/sendEnquiry');?>",
						dataType : 'html',  
						success: function(output)
						{
						$('#enquirysuccess'+postId).html(output);							
						}
					}); 
				}
				}
				</script>
      <script type="text/javascript">
        google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(document.getElementById('bycountry'));
            google.maps.event.addListener(places, 'place_changed', function () {
                var place = places.getPlace();
                var address = place.formatted_address;              
            });
        });
    </script>
      <script type="text/javascript">
        google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(document.getElementById('bycity'));
            google.maps.event.addListener(places, 'place_changed', function () {
                var place = places.getPlace();
                var address = place.formatted_address;              
            });
        });
    </script>				