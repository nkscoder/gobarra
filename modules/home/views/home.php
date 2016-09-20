<?php $this->load->view('header');?>

<!--........................................................................................-->
<!-- <link href="<?php echo theme_url();?>emoji/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo theme_url();?>emoji/css/cover.css" rel="stylesheet">


<link href="<?php echo theme_url();?>emoji/lib/css/nanoscroller.css" rel="stylesheet">
<link href="<?php echo theme_url();?>emoji/lib/css/emoji.css" rel="stylesheet"> -->
<!--.....................................................................................................-->


<?php /*$this->load->view('include_emoji');*/?>
	<div class="subnavbar hidden-xs">
        <div class="clearfix"></div>
        <!-- /subnavbar-inner -->
    </div>
    <!-- /.intro-header -->
	
 <!-- Page Content -->
     <div class="page-content ">
        <div class="container"> 
        	<div class="row">
        		<div class="col-md-12">
        			 <div class="successmessage text-center">
				 <?php 
				 if($this->session->flashdata('item'))
				 {
					 $message= $this->session->flashdata('item');
					 ?>
					 <div class="success timeline" id="postplan" role="alert">				
				<?php 
				echo $message['message'];?>
			</div>
					 <?php
				 }
				 ?>
				 </div>
        		</div>
        	</div>
            <div class="row">
				<div class="col-md-12 ">
					<div class="col-lg-12 topdashboardForm">
					<div class="col-lg-12">
                            <h2 class="element">
                                <!-- <img src="<?php echo theme_url();?>images/Dollar-sign.png" style="width: 25px;" /> --><i class="fa fa-plane" style="color:#FFE763" aria-hidden="true"></i>&nbsp;<span style="color:#91C181">Earn While You Fly</span>&nbsp;<i class="fa fa-plane" style="color:#FFE763" aria-hidden="true"></i><!-- <img src="<?php echo theme_url();?>images/Dollar-sign.png" style="width: 25px;" /> -->
                            </h2>
                        </div>
						
			 <!-- left Sidebar Content -->
               
			 <!-- left Sidebar Content end-->
			 
			  <!-- Right Sidebar Content -->
				<div class="col-sm-8 col-xs-12 col-md-8 content">
                 <!--header-->

				 <div class="homeFormArea">
					<ul class="nav nav-tabs">
					  <li class="active"><a   href="<?php echo base_url(); ?>home">Search Travelers</a></li>
					  <li><a   href="<?php echo base_url();?>home/product_details">Ready Buyers</a>

<div class="button-wrap">
                                            <div>
                                                <a href="#">
                                                    <img alt="" src="<?php echo theme_url();?>images/help-icon.png" class="button-wrap" height="30" width="30" style="left: 116%;
                                            margin-left: 60px;
                                            margin-top: 5px;">
                                                </a>
                                            </div>
                                            <div class="tool-tip">
                                                These are Buyers who are Ready to purchase goods<br />
                                                on regular basis. Simply select your Buyer<br />
                                                from country/state to find one!!
                                            </div>
                                        </div>
					</li> 
					</ul>

					<div class="tab-content">
					  <div id="home" class="tab-pane fade in active"> 
						 <?php 
							$attributes = array('id'=>'search','method'=>"get");
							echo  form_open('home/get_traveler',$attributes);
							?>					
						 <div class="col-lg-12" style="background: url('../map2.png') no-repeat ;">
								<div class="row m-t-20">
								<div class="form-group col-lg-5 col-xs-6 col-sm-5 something"><label class="size">Leaving from</label> 
									<div class="fixArea"> 
										  <input  class="form-control" name="travel_from" id="travelFrom" type="text" title="Type Your Leaving Source" placeholder="Type Your Leaving Source"> 

										   <!--<input name="travel_from" id="city_id1" type="hidden"> -->
									</div>
								</div> 
							   <div class="form-group col-lg-2 col-xs-2 col-sm-2 hidden-xs dividericon"> 
									<div class="fixArea">
									 <img alt="" src="<?php echo theme_url(); ?>img/left-right.png">
								    </div>
								</div>  
								<div class="form-group col-lg-5 col-xs-6 col-sm-5 something"><label class="size">Going to</label>
									<div class="fixArea"> 
										  <input class="form-control" id="travelTo" name="travel_to" type="text" title="Type Your Destination Source" placeholder="Type Your Destination Source"> 
										  <!--<input name="travel_to" id="city_id2" type="hidden" > -->
									</div>
								</div>
								</div> 
								<div class="row">
								<div class="form-group col-lg-5 col-xs-6 col-sm-5 something"><label class="size">Departure Date</label> 
									<div class="fixArea">
										<input type="text" name="from_date" data-placement="left" title="Select From Date" autocomplete="off" class=" form-control" placeholder="Select Date" id="travel_from" >
									</div>
								 </div> 
							   <div class="form-group col-lg-2  col-xs-2 col-sm-2 hidden-xs dividericon"> 
									<div class="fixArea">
									 <img alt="" src="<?php echo theme_url(); ?>img/left-right.png">
								    </div>
								</div>  
								<div class="form-group col-lg-5 col-sm-5 col-xs-6 something"><label class="size">Return Date</label>
									<div class="fixArea">
										<input type="text" name="to_date" data-placement="left" title="Select To Date" autocomplete="off" class=" form-control" placeholder="Select Date" id="travel_to" name="travel_from" >
									 </div>
								</div>
								</div> 
								<div class="fixArea">
									<button title="Click To Search" id="button" class="buyer-btn m-b-20" type="submit">Search</button> 
								</div> 
								</div> 
								<?php echo form_close(); ?>
									 
						<div class="clearFix"></div>
						 
						</div>
					   
				 </div>
				 <div class="col-lg-12 p-0 rightside" id="travelpost">










				 <!--Travel--> 
				 <?php
				/*  print_r($res);*/
				if( is_array($res) && !empty($res) )
				{ ?>
				<div class="rowPOst">
				<?php
				 $cont =1;
				foreach($res as $catKey=>$pageVal)
				{
					$cont ++;
					 /*echo $cont;*/
					?>

				<div class="partnerResult">
					<?php if($pageVal['profile_image'] !='')
					{


						 $img=substr($pageVal['profile_image'],0,5);

                               

                                if($img=='https'){
                                  
                                    $img=$pageVal['profile_image'];
                                }else{
                                    $img=base_url().'uploaded_files/profile_img/'.$pageVal['profile_image'];
                                   
                                }

					/*$img =base_url()."uploaded_files/profile_img/".$pageVal['profile_image'];*/
					}
					else{
					$img =base_url()."uploaded_files/def_user/dummy.png";
					}
					?>
					<?php if(@$this->session->userdata('is_logged_in')){ ?>
					
					<div class="partnerPhoto">
						<a href="<?php echo base_url();?>home/timelinepost/<?php echo $pageVal['user_id']; ?>"><img src="<?php echo $img ; ?>" width="75px" height="75px"></a>
					</div>
					<?php }else{?>
					<div class="partnerPhoto">
						<img src="<?php echo $img ; ?>" width="75px" height="75px" >
					</div>
					<?php }?>
			
					<div class="partnerInfo">
					<?php if(@$this->session->userdata('is_logged_in')){ ?> 
					<div class="partnerName">				
					<a href="<?php echo base_url();?>home/timelinepost/<?php echo $pageVal['user_id']; ?>"><?php echo $pageVal['first_name'] ;?> <?php echo $pageVal['last_name'] ; ?></a> 					
					&nbsp;Is Traveling From <span class="colors"> 		
					<?php echo $pageVal['travel_from'];?></span>&nbsp;To&nbsp;<span class="colors"><?php echo $pageVal['travel_to'];?></span>
					</div>
						<div class="partnerDate">
						<?php 
						$originalDate = $pageVal['from_date'];
						$newDate = date("d F y", strtotime($originalDate));
						echo $newDate ; ?>			
						<div class="endDate"> <b>to</b> <?php 
						$originalDate = $pageVal['to_date'];
						$newDate = date("d F y", strtotime($originalDate));
						echo $newDate ; ?>	</div>
					</div>
					
						  <div class="partnerInterests">
						<span class="show-read-more">
						<?php echo $pageVal['description'];?></span>
						   <!-- Trigger the modal with a button --> 						 
						 </div>						
								<?php 
					$this->load->model('user/users_model');
					$email = $this->session->userdata('email');
					$userifo = $this->users_model->getuserInfo($email);
					$userId = $userifo[0]['user_id'];
					//print_r($userId);
					if($userifo[0]['profile_image'] !='')
					{

                        $userImage=substr($userifo[0]['profile_image'],0,5);

                               

                                if($userImage=='https'){
                                  
                                    $userImage=$userifo[0]['profile_image'];
                                }else{
                                    $userImage=base_url().'uploaded_files/profile_img/'.$userifo[0]['profile_image'];
                                   
                                }

						/*$userImage = base_url()."uploaded_files/profile_img/".$userifo[0]['profile_image'];*/
					}
					else
					{
						$userImage = base_url()."uploaded_files/def_user/dummy.png";
						}
						$recieverID = $pageVal['user_id'];
						if($userId != $recieverID)
						{							
					?>
					<div class="sentmessage" id="sentmessage<?php echo $pageVal['travel_id']; ?>" >
						</div>
					<form class="uploadSecForm" name="imaguploading" id="myimg<?php echo $pageVal['travel_id']; ?>" role="form">	
					<div class="media-left">
					<img src="<?php echo $userImage ; ?>" title="User Name" class="clsimg" border="0" width="60px" height="30px">
					  </div>					 					
					<div class="media-body uploadAndText m-b-10 ">
				  <!--	<p class="lead emoji-picker-container">   data-emojiable="true" -->
						<textarea  name="message" id="message<?php echo $pageVal['travel_id'];?>" class="form-control message"   class="discussPopupHome col-lg-12" placeholder="Your Message"  ></textarea>
                       <!--   </p> -->
						<img class="uploadSection" onclick="document.getElementById('uploadimg<?php echo $pageVal['travel_id']; ?>').click(<?php echo $pageVal['travel_id']; ?>); return false" src="<?php echo theme_url(); ?>img/camera.png">
						<div id="upload-file-container">
						<input type="file" class="hidden" name="image" id="uploadimg<?php echo $pageVal['travel_id']; ?>" onchange="readURL(this,'<?php echo $pageVal['travel_id']; ?>');">	
						<input  type="hidden" id="sender_id<?php echo $userId ; ?>" name="sender_id" value="<?php echo $userId; ?>" />
						<input  type="hidden" id="reciever_id<?php echo $pageVal['user_id']; ?>" name="reciever_id" value="<?php echo $pageVal['user_id']; ?>" />
						</div>
<button type="button" title="Send" class="buyer-btn1" onclick="return sendmessage('<?php echo $pageVal["travel_id"]; ?>')" style="margin-top:15px;">Send</button>
						</div>
						<div class="preview">
						<img id="prvimg<?php echo $pageVal['travel_id'];?>" src="" alt="" style="height: auto !important; max-width: 200px; width:auto;" >
						<a class="hidden" href="javascript:void(0)" onclick="removeImagePreview('<?php echo $pageVal['travel_id']; ?>')" ><span class="glyphicon glyphicon-remove" id="cross<?php echo $pageVal['travel_id']; ?>" aria-hidden="true" style="display:none">&nbsp;						
						</span></a>
						 <span class="add_pdt_img_nc"></span>
						</div>
						</form>
						
						
					 <?php }}else {?>
					 
					 
						<div class="partnerName"><a> <?php echo $pageVal['first_name'] ;?> <?php echo $pageVal['last_name'] ; ?></a>  Is Traveling From					
							&nbsp;<?php echo $pageVal['travel_from'];?>&nbsp;To&nbsp;														
							<?php echo $pageVal['travel_to'];?>
						</div>
						 <div class="partnerDate">
						<?php 
						$originalDate = $pageVal['from_date'];
						$newDate = date("d F y", strtotime($originalDate));
						echo $newDate ; ?>				
						<div class="endDate"> To <?php 
						$originalDate = $pageVal['to_date'];
						$newDate = date("d F y", strtotime($originalDate));
						echo $newDate ; ?></div>
					</div>
					
					<div class="partnerInterests">
						<span class="show-read-more"> <?php echo $pageVal['description'];?></span>
						   <!-- Trigger the modal with a button --> 
						 					                                     
					</div>
						
						<div class="partnerSupport">
						<a class="link btn btn-success" rel="nofollow" href="<?php echo base_url(); ?>user/login">Send Message</a>
						</div>
						<?php } ?>					
						</div>
						</div>	
					<?php

				      /* if($cont==5){  */?><!--

						      <samp> Read More</samp>
					    --><?php /* }*/

				} ?>
				   </div>
					 <input	 type="hidden" value="">
				<?php } else
				{?>
				
				<?php echo "No records Found"; } ?>




					<!--  <samp id="reload" onclick="loadamount(this)"> Read More </samp> -->








				</div>
                </div>
			 <!-- Right Sidebar Content end-->
            </div>
			<?php //$this->load->view('left_ads');?>
			<?php if(@$this->session->userdata('is_logged_in')){ ?> 
			<div class="col-sm-4 col-xs-12 col-md-4 ">
				<div class="bg leftDetailsSec" style="margin-top: 46px; padding-bottom: 70px; text-align:center; box-shadow: 0 2px 4px 0 rgba(0,0,0,.23),inset 1px 1px 0 0 hsla(0,0%,100%,.2); padding-top: 35px;">
					<h4 style="font-size: x-large; font-weight: 600; color: #FE0034; margin-top:20px;">Ready Buyers </h4>
					<p>You Can Find Your Search</p>
					<div class="fixArea">
						<button title="Buyers" id="button" onclick="location.href='<?php echo base_url();?>home/product_details'; " class="buyer-btn" type="submit">Buyers</button>
					</div>
					<div class="clearfix"></div>
					<div class="clearfix"></div>
					<div class="button-wrap">
						<div>
							<a href="#">
								<img alt="" src="<?php echo theme_url();?>images/help-icon.png" class="button-wrap" height="30" width="30">
							</a>
						</div>
						<div class="tool-tip">These are Buyers who are Ready to purchase goods<br />on regular basis. Simply select your Buyer<br /> from country/state to find one!!</div>
					</div>
				</div>
			</div> <!-- End col4 buyer-->
			<?php } else { ?>
			<div class="col-sm-4 col-xs-12 col-md-4 ">
				<div class="bg leftDetailsSec" style="margin-top: 46px; height: 150px; text-align:center;  padding-bottom: 74px;">
					<h4 style="font-size: x-large; font-weight: 600; color: #FE0034;">Ready Buyers </h4>
					<p>Please Login after you can search</p>
					<div class="fixArea">
						<button title="Login" id="button" onclick="location.href='<?php echo base_url();?>user/login';" class="buyer-btn" type="submit">Login</button>
					</div>
					<div class="clearfix"></div>
					<div class="clearfix"></div>
					<div class="button-wrap">
						<div>
							<a href="#">
								<img alt="" src="<?php echo theme_url();?>images/help-icon.png" class="button-wrap" height="30" width="30">
							</a>
						</div>
						<div class="tool-tip">These are Buyers who are Ready to purchase goods<br />on regular basis. Simply select your Buyer<br /> from country/state to find one!!</div>
					</div>
				</div>
			</div> <!-- End col4 buyer-->
			<?php } ?>
			<?php if(@$this->session->userdata('is_logged_in')){ ?> 
			<div class="col-sm-4 col-xs-12 col-md-4 readybuyers">
				<div class="bg leftDetailsSec">
					<h4 style="font-size: larger; color: #100101; font-weight: 600; text-align:center;">New Connected Members</h4>
					<?php $this->load->model('home/home_model');
					$connect_user = $this->home_model->getMembers();
					?>
					<div class='oh'>
					<?php foreach($connect_user as $row_connect => $Connected_user)
					{ 
					?>
						<div class='abox'>
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
								<img src="<?php echo $img; ?>" width="100px" height="80px" title="<?php echo $name; ?>" >
							</a>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php } else { ?>
			<div class="col-sm-4 col-xs-12 col-md-4 readybuyers">
				<div class="bg leftDetailsSec">
					<h4 style="font-size: larger; color: #100101; font-weight: 600;  text-align:center;">New Connected Members</h4>
					<div class='oh'>
					<?php 
					 $this->load->model('home/home_model');
					$connect_user = $this->home_model->getMembers();
					foreach($connect_user as $row_connect => $Connected_user)
					{ 
					?>
						<div class='abox'>
						<?php if($Connected_user->profile_image !='') 
						{
						$img = base_url()."uploaded_files/profile_img/".$Connected_user->profile_image;
						}
						else
						{
						$img = base_url()."uploaded_files/def_user/dummy.png";
						}
						$userId = $Connected_user->user_id ;
						$name = $Connected_user->first_name."&nbsp;".$Connected_user->last_name;
						?>
							<a href="javascript:void(0);">
								<img src="<?php echo $img?>" width="100px" height="80px" title="<?php echo $name; ?>">
							</a>
						</div>
						<?php } ?>
					</div>
					
				</div>
			</div>
			<?php } ?>
			<!-- End col 4 connected members-->
			<?php if(@$this->session->userdata('is_logged_in')){ ?> 
				<div class="col-sm-4 col-xs-12 col-md-4 readybuyers">
                            <div class="bg leftDetailsSec">
                                <h4 style="font-size: x-large; font-weight: 600; color: #52504E; text-align:center;">Top 10 Travellers!</h4>
                                <div class="list-container">
                                    <h1>Recent visited Travellers!</h1>									
                                    <ul class="scale-up-hover-list">
                                       <marquee behavior="scroll" direction="down" scrolldelay="250" class="marq-clss" onmouseover="this.stop();" onmouseout="this.start();">
										<?php 
										foreach($res as $catKey=>$pageVal)
										{						
										?>
                                            <li>											
                                                <a href="<?php echo base_url();?>home/timelinepost/<?php echo $pageVal['user_id']; ?>" target="_blank">
                                                    <div class="date">
													<p class="day">
													<?php 
													$originalDate = $pageVal['from_date'];
													$newDate = date("d", strtotime($originalDate));
													echo $newDate ; ?>
                                                     </p>
                                                      <p class="month"><?php 
													$originalDate = $pageVal['from_date'];
													$newDate = date("F", strtotime($originalDate));
													echo $newDate ; ?></p>
                                                    </div>
                                                    <div class="item-info-container">
													<h1><?php echo $pageVal['first_name'] ;?> <?php echo $pageVal['last_name'] ; ?> Is Traveling From
													<?php echo $pageVal['travel_from'];?></h1>
                                                        <p class="item-description" style="width: 250px;">
                                                            <img src="<?php echo theme_url(); ?>images/email-icon.png" width="50" style="margin-left: -14px;" /><?php echo $pageVal['email']; ?><br />
                                                            <img src="<?php echo theme_url(); ?>images/phone-icon.png" width="20" />&nbsp Call us  <?php echo $pageVal['mobile'];?>
                                                        </p>
                                                    </div>
                                                </a>
                                            </li>
											<?php } ?>
                                            </hr>
                                    </ul> 
									</marquee>
                                </div>
                            </div>
                        </div>
			<?php } else { ?>
			<div class="col-sm-4 col-xs-12 col-md-4 readybuyers">
                            <div class="bg leftDetailsSec">
                                <h4 style="font-size: x-large; font-weight: 600; color: #52504E;  text-align:center;">Top 10 Travellers!</h4>
                                <div class="list-container">
                                    <h1 class="text-center">Recent visited Travellers!</h1>

                                   <ul class="scale-up-hover-list">
                                        <marquee behavior="scroll" direction="down" scrolldelay="250" class="marq-clss" onmouseover="this.stop();" onmouseout="this.start();">
										<?php 
											foreach($res as $catKey=>$pageVal)
											{						
										?>
                                            <li>
                                                <a href="javascript:void(0);" target="_blank">
                                                    <div class="date">
													<p class="day">
													<?php 
													$originalDate = $pageVal['from_date'];
													$newDate = date("d", strtotime($originalDate));
													echo $newDate ; ?>
                                                     </p>
                                                      <p class="month"><?php 
													$originalDate = $pageVal['from_date'];
													$newDate = date("F", strtotime($originalDate));
													echo $newDate ; ?></p>
                                                    </div>
                                                    <div class="item-info-container">
													<h1><?php echo $pageVal['first_name'] ;?> <?php echo $pageVal['last_name'] ; ?> Is Traveling From													
													<?php echo $pageVal['travel_from'];?></h1>
                                                        <p class="item-description" style="width: 250px;">

                                                            <img src="<?php echo theme_url(); ?>images/email-icon.png" width="50" style="margin-left: -14px;" /><?php echo $pageVal['email']; ?><br />
                                                            <img src="<?php echo theme_url(); ?>images/phone-icon.png" width="20" />&nbsp Call us:  <?php if($pageVal['mobile'] !=''){
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
            </div><!-- col 12 topdashboard -->
			</div><!-- End col 12 -->
        </div><!--end row -->
        <!-- /.container -->

    </div>
</div>
 
	<!-- Page Content -->
	<script type="text/javascript">function serialize_form() { return $('#myform').serialize();   } </script>
	<?php $this->load->view('footer');?>
	<?php $this->load->view("scroll_pagination/scroll_pagination");?>
	<script type="text/javascript" >
 $(document).ready(function(){
  setTimeout(function(){
  $("#postplan").fadeOut("slow", function () {
  $("#postplan").remove();
      });
	  }, 9000);
 });
</script>
<script>
				function readURL(input, postID) 
				{  
				  $('#cross'+postID).show();  
					if (input.files && input.files[0]) 
					{
						var reader = new FileReader();
						$('#prvimg'+postID).css("display", "block");
						//$('#cross'+postid).fadein();
						reader.onload = function (e) 
						{
						$('#prvimg'+postID)
						.attr('src', e.target.result)						
						.width(150)
						.height(200);
						};
						reader.readAsDataURL(input.files[0]);
					}
				}
				function removeImagePreview(postid) 
				{
					$('#prvimg'+postid).attr('src','');
					$('#prvimg'+postid).css("display", "none");	
					$('#cross'+postid).hide();
				}
				if (!String.prototype.trim) {
    (function() {
        // Make sure we trim BOM and NBSP
        var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
        String.prototype.trim = function() {
            return this.replace(rtrim, '');
        };
    })();
}
	
	function sendmessage(postid) 
	{      
		//var key = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;        
		setTimeout(function(){
		  $("#sentmessage"+postid).fadeOut("slow", function () {
		  $("#sentmessage"+postid).remove();
			  });
			  },5000);
		var imagepath = $('#uploadimg' + postid).val();
		var msgvalue = $('#message' + postid).val();
		//alert(msgvalue);
		var str = $('#message'+ postid).val();
			function trim(str) {
        return str.replace(/^\s+|\s+$/g,"");
		}	
        //if (key == 13) 
		//{	
		//event.preventDefault();
      /*   alert(514684894);*/
		/*var emoji=$('#message' + postid).emojiarea();

		alert(emoji);*/
		
		if ((str =='')&& ($('#uploadimg'+postid).val()==''))
			{
				$('#message'+ postid).val('');
				alert ("please enter message or image");
				return false;
			}
			else {
				 $('#cross'+postid).hide();
				 $('#prvimg'+postid).css("display", "none");						
				var data = new FormData($('#myimg'+postid)[0]);
					$('#message'+ postid).val('');
					

					 $('#uploadimg'+postid).val('');
					 $('#prvimg'+postid).attr('src','');
					$.ajax({
						type: "POST",               
						processData: false, // important
						contentType: false, // important
						data: data,
						url: "<?php echo site_url('home/insertmessage');?>",
						dataType : 'html',  
						success: function(output)
						{
						$('#sentmessage'+postid).html(output);		
						}
					});
			}					
        //}

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
        google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(document.getElementById('travelFrom',{types: ['(cities)'],region:['(country)']}));
            google.maps.event.addListener(places, 'place_changed', function () {
                var place = places.getPlace();          
            });
        });
        google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(document.getElementById('travelTo',{types: ['(cities)'],region:['(country)']}));
            google.maps.event.addListener(places, 'place_changed', function () {
                var place = places.getPlace();
                var address = place.formatted_address;
            });
        });
    </script>
    

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->

<script  type="text/javascript">
	function loadamount(obj) {

		var data1=document.getElementById("reload");
		/* alert(15455);*/


		var dd ={"data":data1};
		/* alert(dd);*/
		$.ajax({
			'url' : "<?php echo base_url().'home/get_traveler_Data'; ?>",
			'type' : 'POST',  //the way you want to send data to your URL
			dataType: "json",
			'data':dd,

			 'success' : function(data){
				  alert(data);
				  console.log(data);
			 },
			'error': function(data){
				/* console.log(data);*/
				 alert(data);
				/* alert('Some Error Occurred');*/
			}
		});


	}

</script>



<!--<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>-->

<!-- Begin emoji-picker JavaScript -->
<!-- <script src="<?php echo theme_url();?>emoji/lib/js/nanoscroller.min.js"></script>
<script src="<?php echo theme_url();?>emoji/lib/js/tether.min.js"></script>
<script src="<?php echo theme_url();?>emoji/lib/js/config.js"></script>
<script src="<?php echo theme_url();?>emoji/lib/js/util.js"></script>
<script src="<?php echo theme_url();?>emoji/lib/js/jquery.emojiarea.js"></script>
<script src="<?php echo theme_url();?>emoji/lib/js/emoji-picker.js"></script> -->
<!-- End emoji-picker JavaScript -->

<script>
	/*$(function() {
		// Initializes and creates emoji set from sprite sheet
		window.emojiPicker = new EmojiPicker({
			emojiable_selector: '[data-emojiable=true]',
			assetsPath: '<?php echo theme_url();?>emoji/lib/img/',
			popupButtonClasses: 'fa fa-smile-o'
		});*/
		// Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
		// You may want to delay this step if you have dynamically created input fields that appear later in the loading process
		// It can be called as many times as necessary; previously converted input fields will not be converted again
		/*window.emojiPicker.discover();
	});*/
</script>