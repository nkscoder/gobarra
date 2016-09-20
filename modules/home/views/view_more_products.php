<?php $this->load->view('header');?>
<div class="subnavbar hidden-xs">
        <div class="clearfix"></div>
        <!-- /subnavbar-inner -->
    </div>  
  <!-- Header -->   
    <!-- /.intro-header -->
    <!-- Page Content -->
    <div class="page-content ">
        <div class="container">
            <div class="row">			
                <!-- left Sidebar Content -->
				<?php 
				if(is_array($user_data) && !empty($user_data))
				{
					foreach($user_data as $UserInfo)
					{					
				?>
                <div class="col-sm-4 leftSidebar hidden-xs">
                 
				 <div class="bg leftDetailsSec">
	<div class="imageFrame timeline col-md-6 p-r-10">
	<?php if($UserInfo->profile_image !='')
	{


		/*$userImage = base_url()."uploaded_files/profile_img/".$UserInfo->profile_image;*/

            $userImage=substr($UserInfo->profile_image,0,5);

                               

                                if($userImage=='https'){
                                  
                                    $userImage=$UserInfo->profile_image;
                                }else{
                                    $userImage=base_url().'uploaded_files/profile_img/'.$UserInfo->profile_image;
                                   
                                }

	}else{
		$userImage = base_url()."uploaded_files/def_user/dummy.png" ;
	}		?>
	 <div class="imageFrame "> 

	 <a><span><p><img id="profile-image-user" href="<?php echo $userImage ;?>" class="group3" src="<?php echo $userImage ;?>"></span></p></a>
						  </div>
	</div>
<div class=" rightNameDetail col-md-12	 col-sm-12 col-xs-12"> <h4> <?php echo $UserInfo->first_name ;?>&nbsp;<?php echo $UserInfo->last_name ;?> </h4>

 <div class="details2"><i class="fa fa-map-marker"></i>Lives In: <?php echo $UserInfo->country_id ; ?></div>
	  <div class="details2"><i class="fa fa-building-o"></i>From: <?php echo $UserInfo->city_id; ?> </div>
		<?php if($UserInfo->occupation !='')
		{ ?>	
	 <div class="details2"><i class="fa fa-university"></i>Occupation: <?php echo $UserInfo->occupation ; ?></div>
		  <?php } else
		  {?>
  <div class="details2"><i class="fa fa-university"></i>Occupation: Not Provided</div>
		  <?php 		} ?>
		  <?php if($UserInfo->mobile !='')
		  {?>	
	   <div class="details2"><i class="fa fa-phone-square"></i>Mobile: <?php echo $UserInfo->mobile ;?></div>
			<?php } else 
			{ ?>
		<div class="details2"><i class="fa fa-phone-square"></i>Mobile: Not Provided</div>		
			<?php } ?>
		<div class="details2"><i class="fa fa-phone-square"></i>Email: <?php echo $UserInfo->email ;?></div>	
			<?php if($UserInfo->gender !='')
			{
			if(($UserInfo->gender)=="M"){
			echo '<div class="details2"><i class="fa fa-male"></i>Gender: Male</div>';
		   }
		   else
			{
				echo '<div class="details2"><i class="fa fa-female"></i>Gender: Female</div>';
			} 
			} 
			else 
			{ ?>
			<div class="details2"><i class="fa fa-male"></i>Gender: Not Provided </div>
					<?php } ?>			
	   </div>							
<div class="clearfix"></div>
		
	 	 </div>
							<?php $this->load->model('user/users_model'); 
                              $email     =$this->session->userdata('email');
                              $usrinfo   =$this->users_model->getuserInfo($email);
                              $senderId=$usrinfo[0]['user_id'];
							  //print_r($senderId); die;
							  if($senderId != $UserInfo->user_id)
							  {
							?>
		 <div class="bg leftDetailsSec">			 
 			  <h3>Send Message </h3>
			  <form id="insertMessage" name="insertMessage" role="form">
				<div class="form-group">
				<div class="media-body uploadAndText"> 
				 <textarea id="message" name="message" placeholder="Enter Your Message" class="form-control"></textarea>
				 <img class="uploadSection" onclick="document.getElementById('upload').click(); return false" src="<?php echo theme_url();?>img/camera.png"> 
				 <input type="file" name="image" id="upload" class="hidden image">	
				<input type="hidden" name="sender_id" value="<?php echo $senderId ;?>" >
				 <input type="hidden" name="reciever_id" value="<?php echo $UserInfo->user_id ; ?>" >
				</div>
				</div>
				<div class="preview">
				<div id="upload-file-container">
				<img id="blah" src="" alt="" style="height: auto !important; max-width: 200px; width:auto;"/>
				<a id="remove" href="javascript:void(0)" onclick="removeImagePreview()" >
				<span class="glyphicon glyphicon-remove" id="cross" aria-hidden="true" style="display:none"></span></a>
				<span class="add_pdt_img_nc"></span>
				<div class="clearfix"></div>
				</div>
				</div>
				<button onclick="return insertMessages()" class="btn btn-default" type="button">Submit</button>
			  </form>
			   <div class="sentmessage" id="sendmessage">								
				</div>
<div class="clearfix"></div>
	 	 </div>
		 <?php } else{?>
			 <ul class="nav nav-tabs">
							<li><a   href="<?php echo base_url(); ?>home">Search Travelers</a></li>
                            <li class="active">
							<a href="<?php echo base_url();?>home/product_details">Ready Buyers</a>
                            </li>
                        </ul>
		 <?php }?>
				 </div>
				 
				<?php }} ?>
                <!-- left Sidebar Content end-->

                <!-- user product listing start from here -->
				
				<?php 
				   if( is_array($res_array) && !empty($res_array) )
				  {	
					?>
                <div class="col-sm-8 col-md-8 content">                    
                    <div class="homeFormArea">                       
                     <div class="rowPOst">
						
					<?php foreach ($res_array as $key => $pageVal)
					{
						
						?>
					<div class="partnerResult m-t-15">
					<div class="partnerPhoto">
					<?php if($pageVal['profile_image'] !='')
					{

						  $img=substr($pageVal['profile_image'],0,5);

                               

                                if($img=='https'){
                                  
                                    $img=$pageVal['profile_image'];
                                }else{
                                    $img=base_url().'uploaded_files/profile_img/'.$pageVal['profile_image'];
                                   
                                }
						/*$img=base_url()."uploaded_files/profile_img/".$pageVal['profile_image'];*/
					}
					else{
					$img=base_url()."uploaded_files/def_user/dummy.png";
					}
					?>
						<a href="<?php echo base_url();?>home/timelinepost/<?php echo $pageVal['user_id']; ?>"><img src="<?php echo $img ;?>" width="75px" height="75px"></a>
					</div>					
					<div class="partnerInfo">
						<div class="partnerName"><?php echo $pageVal['product_name'];?> <em class="smallText">Added by</em><a href="<?php echo base_url();?>home/timelinepost/<?php echo $pageVal['user_id']; ?>"> <?php echo $pageVal['first_name'];?></a> <br>
						 <span><?php echo $pageVal['country_id'];?>(<?php echo $pageVal['city_id'];?>)</span>
					 </div>
					 
					 <?php $recieverId = $pageVal['user_id']; 
						if($senderId != $recieverId)
						{?>
							<div class="partnerDate inquiry">
							  <a href="#" data-toggle="modal" data-target="#myModal<?php echo $pageVal['product_id']; ?>">
									  <i class="fa fa-envelope-o"></i> Enquiry 
                                    </a>								
							<div id="myModal<?php echo $pageVal['product_id']; ?>" class="modal fade" role="dialog">
								<div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
								  <div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title pull-left">Send Your Enquiry</h4>
								  </div>
								  <?php 
								  //print_r($product_value['user_id']); ?>
								  <div class="modal-body">								  
								   <div class="modal-footer">
								    <form role="form" class="form-group" name="replyEnquiry" id="replyEnquiry<?php echo $pageVal['product_id']; ?>">								  									
									<textarea name="enquiry" id="enquiry<?php echo $pageVal['product_id']; ?>" class="form-control enquirymsg"></textarea>
									<input type="hidden" name="senderId" value="<?php echo $senderId ; ?>" >	
									<input type="hidden" name="recieverId" value="<?php echo $pageVal['user_id'] ; ?>" >
									<button type="button" class="btn btn-default" onclick="return insertenquiry('<?php echo $pageVal['product_id']; ?>')">Send</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<div class="sentmessage" id="enquirysuccess<?php echo $pageVal['product_id']; ?>"></div>
									</form>
									</div>									
									</div>
								</div>

							  </div>
							</div>
					</div>
					<?php } ?>
					
					
						<div class="partnerInterests">
					 <span class="show-read-more"> <?php echo $pageVal['description'];?></span>
						   <!-- Trigger the modal with a button --> 
						 					                                     
						 </div>
						<div class="partnerSupport">
						 	<div class="cellSub">
							 <?php
											if($pageVal['img1']!='')
											{
                                             $target_path = base_url()."uploaded_files/product_image1/".$pageVal['img1'];
											}
											else
                                            {
                                              $target_path= base_url()."uploaded_files/def_user/dummy.png";
                                            }
                                            ?>
										<?php
											if($pageVal['img2']!='')
											{
                                             $target_path1 = base_url()."uploaded_files/product_image2/".$pageVal['img2'];
											}
											else
                                            {
                                              $target_path1= base_url()."uploaded_files/def_user/dummy.png";
                                            }
                                            ?> 
									<div class="preview prouductDisplay">
									<span><a><p><img src="<?php echo $target_path ;?>" alt="" class="group3" href="<?php echo $target_path ;?>"></a></p></span> 
									<span><a><p><img src="<?php echo $target_path1 ;?>" alt="" class="group4" href="<?php echo $target_path1 ;?>"></a></p> </span>
									</div>
								</div>						
					 
						</div>

					</div>
				
				</div>
					<?php }?>
						<?php echo $page_links; ?>	
                        </div>

                    </div>
                    <!-- Right Sidebar Content end-->
                </div>
				  <?php 
				  }else{
			echo "<center><strong> No record(s) found !</strong></center>" ;
	 }
				  ?>
            </div>
            <!-- /.container -->

        </div>


        <!-- Page Content -->


        <!-- Footer -->
     <?php $this->load->view('footer');?>
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
	
					/*Send Message */
		function insertMessages(){
		setTimeout(function(){
				  $("#sendmessage").fadeOut("slow", function () {
				  $("#sendmessage").remove();
					  });
					  },5000);
		 var str = $('#message').val();
			function trim(str) {
			return str.replace(/^\s+|\s+$/g,"");
			}
				if ((str =='')&& ($('.image').val()==''))
				{
					$('#message').val('');
					alert ("please enter message or image");
					return false;
				}
				else
				{				
		var data = new FormData($('#insertMessage')[0]);
					$('#message').val('');
					$('.image').val('');
					$('#blah').attr('src','');
					$.ajax({
						type: "POST",               
						processData: false, // important
						contentType: false, // important
						data: data,
						url: "<?php echo site_url('home/PrivateMessage');?>",
						dataType : 'html',  
						success: function(output){
								$('#sendmessage').html(output);							
						}
					}); 
				}
		
	}	   
	
		function readURL(input) {
		$('#cross').show();
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			$('#blah').css("display", "block");
			reader.onload = function (e) {
				$('#blah').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
		}

		$("#upload").change(function(){
			readURL(this);
		});
			
			function removeImagePreview() {
			$('#blah').attr('src','');
			$('#blah').css("display", "none");
			$('#cross').hide();
			}
			
			$(document).ready(function() { 	 
		  $('#upload-file-container input').click(function() { 
			if($('#insertMessage img').val() != "") {
				//alert('yes');
			}
			else{
				 //alert('no');
				 $('#insertMessage a.hidden').removeClass('hidden')
			}
		  });
		});	
		</script> 