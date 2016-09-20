<?php $this->load->view('header');?>
<?php //$this->load->view('top_ads');?>
<div class="subnavbar hidden-xs">
        <div class="clearfix"></div>
        <!-- /subnavbar-inner -->
    </div>
 <!-- Page Content -->
    <div class="page-content ">
        <div class="container">
            <div class="row">
                <!-- full Content -->
                <div class="col-md-12 ">
				 <div class="col-lg-12">
				 <div class="col-lg-12">  <h3><?php echo $user[0]->first_name; ?> Timeline Page</h3></div>
				<!--timeline-->			
			  
			 
			  <!-- Right Sidebar Content -->
			  	<div class="col-sm-4 col-xs-12 col-md-4 ">
				 <div class="bg leftDetailsSec">				
				<div class="imageFrame timeline col-md-6">		
		<?php 
			 $this->load->model('admin_products/products_model');
			 $id = $user[0]->user_id;
			 //print_r($id);
			 $products = $this->products_model->record_count($id);
			 $total_products = count($products);				 
			if ($user[0]->profile_image != "")
			{


			/*$img=base_url()."uploaded_files/profile_img/".$user[0]->profile_image;*/
                         $img=substr($user[0]->profile_image,0,5);
                        if($img=='https'){
                                  
                              $img=$user[0]->profile_image;

                                }else{
                                    $img=base_url().'uploaded_files/profile_img/'.$user[0]->profile_image ;
                                   
                                }

			}
			else
			{
			$img=base_url()."uploaded_files/def_user/dummy.png";
			}
			//print_r($user[0]);
			 
				 ?>
	 <a href="<?php echo base_url();?>home/timelinepost/<?php echo $user[0]->user_id; ?>">
	 <span><p><img id="profile-image-user" class="group3" href="<?php echo $img; ?>" src="<?php echo $img ; ?>"></a></p></span>						 
	</div>
<div class=" rightNameDetail col-md-12	 col-sm-12 col-xs-12"> <h4> <?php echo $user[0]->first_name ;?> <?php echo $user[0]->last_name ;?> </h4>

 <div class="details2"><i class="fa fa-map-marker"></i>Lives in: <?php echo $user[0]->country_id ;?></div>
	  <div class="details2"><i class="fa fa-building-o"></i>From: <?php echo $user[0]->city_id ;?> </div>
	  <?php if($user[0]->occupation !='')
	  { ?>
		 <div class="details2"><i class="fa fa-university"></i>Occupation: <?php echo $user[0]->occupation ;?></div> 
	 <?php } else
	 { ?>
	  <div class="details2"><i class="fa fa-university"></i>Occupation: Not Provided</div>
	  <?php } ?>
	  <?php if($user[0]->mobile !='')
	  {?>
	   <div class="details2"><i class="fa fa-phone-square"></i>Mobile: <?php echo $user[0]->mobile ;?></div>
	  <?php } else
			{ ?>
		<div class="details2"><i class="fa fa-phone-square"></i>Mobile: Not Available</div>
			<?php } ?>
		<div class="details2"><i class="fa fa-envelope-o"></i>Email: <?php echo $user[0]->email ;?></div>	
			<?php if($user[0]->gender !='' )
			{
				if($user[0]->gender =='M')
				{ ?>
				<div class="details2"><i class="fa fa-male"></i>Gender: Male</div>
				<?php }
				else{ ?>
					<div class="details2"><i class="fa fa-female"></i>Gender: Female</div>
				 <?php }				
				 } else{ ?>
					<div class="details2"><i class="fa fa-male"></i>Gender: Not Provided </div>
				<?php } ?>
		<?php if( $total_products >= 1)
		{?>
	 <div class="details2"><i class="fa fa-bars"></i><a href="<?php echo base_url();?>home/more_products/<?php echo $user[0]->user_id; ?>" style="color: #1949AF;font-weight: 600;">Products From <?php echo $user[0]->first_name; ?></a></div>
	 <?php } ?>
</div>

<div class="clearfix text-center"></div>
	
	 	 </div>		 			
			  <?php $this->load->model('user/users_model'); 
                              $email     	= $this->session->userdata('email');
                              $usrinfo   	= $this->users_model->getuserInfo($email);
                              $senderId		= $usrinfo[0]['user_id'];
							  $recieverId	= $user[0]->user_id;
							  //print_r($senderId); die;
							  if($senderId != $recieverId)								  
							  {								  
							?>
							<div class="card-gobarra">
				<h3>Send Message </h3>
			  <form class="uploadSecForm" id="insertMessage" name="insertMessage" role="form" accept-charset="utf-8">
				<div class="form-group">
				<div class="media-body uploadAndText"> 	
				 <textarea id="message" name="message" placeholder="Enter Your Message" class="form-control "></textarea>
				 <img class="uploadSection" onclick="document.getElementById('upload').click(); return false" src="<?php echo theme_url();?>img/camera.png"> 
				<input type="file" name="image" id="upload" class="hidden image">
				 <input type="hidden" name="sender_id" value="<?php echo $senderId; ?>" >
				 <input type="hidden" name="reciever_id" value="<?php echo $recieverId; ?>" >
					</div>
				</div>
				<div class="preview">
				<div id="upload-file-container">
				<img id="imgpreview" src="" alt="" style="height: auto !important; max-width: 200px; width:auto;"/>				
				<a class="" href="javascript:void(0)" onclick="removeImagePreview()" >
				<span class="glyphicon glyphicon-remove" id="cross" aria-hidden="true" style="display:none"></span></a>
				</div>
				</div>
				<button onclick="return insertMessages()" class="btn btn-success" type="button">Send</button></div>
			  </form>
			   <?php } ?>
		<div class="clearfix"></div>	 
			<div class="sentmessage" id="sendmessage">								
				</div>		 
			</div>
				<div class="col-sm-8 col-xs-12 col-md-8 content">				
                 <!--header-->				
				 <div class="homeFormArea">
				 <?php 				
				if(is_array($res) && !empty($res))
				{	
				$this->load->model('user/users_model'); 
				$email     =$this->session->userdata('email');
				$usrinfo   =$this->users_model->getuserInfo($email);
				$senderId=$usrinfo[0]['user_id'];
					?>
					<ul class="nav nav-tabs">
					  <li class="active m-t-15"><a href="<?php echo base_url(); ?>timelinepost/timeline">Post Timeline</a></li>
					 
					</ul>
					<?php if($senderId == $user[0]->user_id) {?>
					<?php echo form_open('home/timelinepost','id="form"') ;?>
				 <div class="tab-content p-30">
					  <div id="home" class="tab-pane fade in active"> 
						 
						<div class="form-group col-lg-12 col-xs-12 something"> 
									<div class="fixArea">
										<textarea class="form-control myform timeLineTextArea" id="description" name="description"></textarea>
									 </div>
								</div>
								 <div class="form-group col-lg-12 col-xs-12 something">
								<div class="fixArea">
									<button title="Add" class="btn btn-md btn-primary" type="submit">Add Post</button> 
								</div>
								</div>
						</div>
				 </div>
				 <?php echo form_close(); ?>
					<?php } ?>
				 <!--Travel--> 
				 <div class="col-lg-12 rightside" id="travelpost">
				 <?php 
				 foreach($res as $row=> $kvalue)
					{
						?>
				 	<div class="rowPOst">					
				<div class="partnerResult">
				<?php 
				
				if ($kvalue['profile_image'] != "")
				{
                       $img=substr($kvalue['profile_image'],0,5);
                        if($img=='https'){
                                  
                              $img=$kvalue['profile_image'];

                                }else{
                                    $img=base_url().'uploaded_files/profile_img/'.$kvalue['profile_image'];
                                   
                                }

				/*$img=base_url()."uploaded_files/profile_img/".$kvalue['profile_image'];*/
				}
				else
				{
				$img=base_url()."uploaded_files/def_user/dummy.png";
				}
				 
				 ?>
					<div class="partnerPhoto">
					<a href="javascript:void(0);">
						<img src="<?php echo $img ;?>" width="75px" height="75px"></a>
					</div>
				<div class="partnerInfo">
						<a href="javascript:void(0);"><div class="partnerName"><?php echo $kvalue['first_name']; ?>&nbsp; <?php echo $kvalue['last_name']; ?> </a>
						<?php
						$posttype = $kvalue['type'];
						if ($posttype==1)
						{ ?>
						Is Traveling From
						<?php echo $kvalue['travel_from'];?>
						To
						<?php echo $kvalue['travel_to'];?>						
						</div>
							<div class="partnerDate">
						<?php 
						$originalDate = $kvalue['from_date'];
						$newDate = date("d F y", strtotime($originalDate));
						echo $newDate ; ?>				
						<div class="endDate"> To <?php 
						$originalDate = $kvalue['to_date'];
						$newDate = date("d F y", strtotime($originalDate));
						echo $newDate ; ?></div>
					</div> 
								<?php }?>
					<div class="partnerDate">
					<?php 
					if($kvalue['created'] !='')
					{
						$originalDate = $kvalue['created'];
						$newDate = date("d F y", strtotime($originalDate));
						echo $newDate ; } ?>
						</div>
						  <div class="partnerInterests">
					 <span class="show-read-more"> <?php echo $kvalue['description'];?></span>
						   <!-- Trigger the modal with a button --> 						 
						 </div>						 					
					</div>						
				</div>									
				 </div>	
				<?php }
					echo $page_links;
					} ?>
					</div>					
                </div>				
			 <!-- Right Sidebar Content end-->			
            </div>
				<!--timeline-->								
				 </div> 
                </div>				
                <!-- full Content-->
            </div>         
        </div>
		</div>
		</div>
		</div>
        <!-- Page Content -->
		<?php $this->load->view('footer');?>
<?php $this->load->view("scroll_pagination/scroll_pagination");?>	
	<script>
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
					$('#imgpreview').attr('src','');
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
		$('#imgpreview').css("display", "block");
			reader.onload = function (e) {
				$('#imgpreview').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
		}

		$("#upload").change(function(){
			readURL(this);
		});	
	function removeImagePreview() {
	$('#imgpreview').attr('src','');
	$('#imgpreview').css("display", "none");
	$('#cross').hide();
	}
	
	$(document).ready(function() { 
	 
	  $('#upload-file-container input').click(function() { 
		if($('.uploadSecForm img').val() != "") {
			//alert('yes');
		}
		else{
			 //alert('no');
			 $('.uploadSecForm a.hidden').removeClass('hidden')
		}
	  });
	});	
		</script>