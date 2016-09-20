 <?php $this->load->view('top_application');?>
 <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
        <div class="container topnav">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand topnav" href="<?php echo base_url();?>home"><img src="<?php echo theme_url();?>img/logotop.png" class="img-responsive" alt=""/></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
             <!-- Collect the nav links, forms, and other content for toggling -->
			 <?php if(@$this->session->userdata('is_logged_in'))
			 {?>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			 <div class="top-nav notification-row "> 

			 
                <!-- notificatoin dropdown start-->
                <ul class="nav pull-right top-menu visible-md visible-lg visible-sm ">
                     <!-- alert notification end-->
                    <!-- user name-->
					<?php 
					$this->load->model('enquiry/enquiry_model');
					$enquiry	=	$this->enquiry_model->EnquiryCount();
                                        if($enquiry<=0)
					{
					?>
                                  <li id="task_notificatoin_bar1" class="dropdown inquiry">
						<a data-toggle="dropdown" data-placement="right" title="Enquiry Inbox" class="dropdown-toggle" onclick="location.href='<?php echo base_url(); ?>enquiry/display_name'">
						  <span id="notification-enq1"></span><img src="<?php echo theme_url();?>/img/Enquiry.png">                          
                        </a>
						 <ul class="dropdown-menu extended inbox scroll-menu" >
                            <div class="notify-arrow notify-arrow-blue"  ></div>
														
                            
					 </ul>
                    </li>
<?php }else
					{ ?>
	                
                    <!-- task notificatoin start -->
                    <li id="task_notificatoin_bar1" class="dropdown inquiry">
						<a data-toggle="dropdown" data-placement="right" title="Enquiry Inbox" class="dropdown-toggle" href="#" onClick="return Showenquiry();">
                          <?php if($enquiry >0) { ?>
						  <span id="notification-enq"><?php echo $enquiry; } ?></span><i class="fa fa-flask "></i>                          
                        </a>
					
						  <ul class="dropdown-menu extended inbox scroll-menu" >
                            <div class="notify-arrow notify-arrow-blue"  ></div>
														
                            
					 </ul>
                    </li>		
			<?php } ?>		
                    <!-- enquiry notificatoin end -->
					<?php 
					 $this->load->model('messages/messages_model');
					$message	=	$this->messages_model->MessageCount();
					if($message<=0)
					{
					?>
<!-- inbox notificatoin start-->									
					<li id="task_notificatoin_bar" class="dropdown dropdown2">
						<a data-toggle="dropdown" data-placement="right" title="Message Inbox" class="dropdown-toggle" onClick="location.href='<?php echo base_url(); ?>messages/display_name'">							
						   <span id="notification-msg1">						   
						   </span><i class="icon_mail_alt"></i>
                        </a>
						<ul class="dropdown-menu extended inbox scroll-menu">
                            <div class="notify-arrow notify-arrow-blue"></div>							
                        </ul>									 
                    </li>
					<?php } else
					{ ?>
				   <!-- inbox notificatoin start-->									
							<li id="task_notificatoin_bar" class="dropdown dropdown2">
							<a data-toggle="dropdown" data-placement="right" title="Message Inbox" class="dropdown-toggle" href="#" onClick="return ShowMessageNotification();">
							<?php  if($message >0) { ?>
						   <span id="notification-msg">
						   <?php  echo $message; } ?>
						   </span><i class="icon_mail_alt"></i>
                        </a>
						<ul class="dropdown-menu extended inbox scroll-menu">
                            <div class="notify-arrow notify-arrow-blue"></div>
							
                           
                        </ul>									 
                    </li>
				<?php } ?>
					
					  <!-- message notification end-->					 				
                    <!-- user login dropdown start-->
					
                 <li id="alert_notificatoin_bar" class="dropdown">
					<?php 
                              $this->load->model('user/users_model'); 
                              $email     =$this->session->userdata('email');
                              $usrinfo   =$this->users_model->getuserInfo($email);

                                $img=substr($usrinfo[0]['profile_image'],0,5);

                               

                                if($img=='https'){
                                  
                                    $img=$usrinfo[0]['profile_image'];
                                }else{
                                    $img=base_url().'uploaded_files/profile_img/'.$usrinfo[0]['profile_image'];
                                   
                                }
                            
                              $name=$usrinfo[0]['first_name'];
                              $name1=$usrinfo[0]['last_name'];
                              if($usrinfo[0]['profile_image']!='')
                              {?>
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="
    margin-top: -7px;">
					<span class="profile-ava">
					<img src="<?php echo $img ;?>" alt="">
                    </span>
                            <span class="username"><?php echo $name."&nbsp;".$name1;?></span>
							<img src="<?php echo theme_url();?>/images/down-arrow.png" />
                        </a>
						 <?php }else{
							 $img=base_url().'uploaded_files/def_user/dummy.png';
							 ?>
							 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<span class="profile-ava">
							<img src="<?php echo $img ;?>" alt="">
							</span>
                            <span class="username"><?php echo $name."&nbsp;".$name1;?></span> 
                        </a>
						 <?php }
					 ?>
                        <ul class="dropdown-menu extended logout">
                           <div class="notify-arrow notify-arrow-blue"></div>
                            <li>
                                <a href="<?php echo base_url();?>travelplans/planschedul"><i class="fa fa-dashboard"></i> Dashboard</a>
                            </li> 
							<li>
                                <a href="<?php echo base_url();?>timelinepost/timeline"><i class="icon_clock_alt"></i> Timeline</a>
                            </li> 
							<li>
                                <a href="<?php echo base_url();?>admin_products/add"><i class="icon_folder-add_alt"></i>Add Product</a>
                            </li> 
							<li>
                                <a href="<?php echo base_url(); ?>admin_products"><i class="glyphicon glyphicon-list"></i>My Products</a>
                            </li>
							
                            <li>
                                <a href="<?php echo base_url();?>messages/display_name"><i class="icon_mail_alt"></i> My Inbox</a>
                            </li>
							 <li>
                                <a href="<?php echo base_url();?>enquiry/display_name"><i class="fa fa-flask "></i>My Enquiry</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>user/profile"><i class="fa fa-user"></i> My Profile</a>
                            </li>
                             <li>
                               <a href="<?php echo base_url();?>user/ChangePassword"><i class="fa fa-unlock"></i><span>Change Password</span> </a> 
                            </li>
                            <li class="eborder-top">
                                <a href="<?php echo base_url();?>user/logout"><i class="fa fa-sign-in"></i> Log Out</a>
                            </li>
                            
                        </ul>
                    </li>
							 
					                    <!-- user login dropdown end -->
                </ul>
                <!-- notificatoin dropdown end-->
            </div>
						   <ul class="nav navbar-nav  visible-md visible-lg visible-sm">
							  <li><a href="<?php echo base_url();?>home">Home</a></li>
							  <li><a href="<?php echo base_url();?>pages/aboutgobarra">About Gobarra</a></li>  
						   </ul>
			   <!--only for mobile menu -->
						<ul class=" extended logout hidden-md hidden-lg nav navbar-nav hidden-sm">                        
							<li class="eborder-top"><a href="<?php echo base_url(); ?>home"><i class="fa fa-home"></i>Home</a></li>
							<li class="eborder-top"><a href="<?php echo base_url(); ?>pages/aboutgobarra"><i class="fa fa-paper-plane-o"></i>About Gobarra</a></li> 
<li> <a href="<?php echo base_url(); ?>timelinepost/timeline"><i class="icon_clock_alt"></i>Timeline</a> </li> 
							<li class="eborder-top"><a href="<?php echo base_url(); ?>travelplans/planschedul"><i class="fa fa-dashboard"></i>Dashboard</a> </li> 
							<li> <a href="<?php echo base_url(); ?>admin_products/add"><i class="icon_folder-add_alt"></i>Add Product</a></li> 
							<li> <a href="<?php echo base_url(); ?>admin_products"><i class="glyphicon glyphicon-list"></i>My Products</a></li>
							
                            <li> <a href="<?php echo base_url(); ?>messages"><?php if($message>0) { ?><span id="notification-msg"><?php echo $message; } ?></span><i class="icon_mail_alt"></i>My Inbox</a></li>
		            <li> <a href="<?php echo base_url(); ?>enquiry"><?php if($enquiry>0) { ?><span id="notification-enq"><?php echo $enquiry; } ?></span><i class="fa fa-flask "></i>My Enquiry</a></li>                           
                            <li> <a href="<?php echo base_url(); ?>user/profile"><i class="fa fa-user"></i>My Profile</a></li> 
 <li><a href="<?php echo base_url();?>user/ChangePassword"><i class="fa fa-unlock"></i><span>Change Password</span> </a> </li>                           
                            <li> <a href="<?php echo base_url(); ?>user/logout"><i class="fa fa-sign-in"></i>Log Out</a></li>						                            
                        </ul>
                <!--only for mobile menu -->
            </div>
			<?php }else {?>
			 <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="<?php echo base_url();?>pages/aboutgobarra">About</a>
                    </li>                   
                    <li>
                        <a href="<?php echo base_url();?>pages/contact">Contact</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>user/login">Login</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>user/signup">Register</a>
                    </li>
					
                </ul>
            </div>
			<?php }?>
            <!-- /.navbar-collapse -->
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
	
	<script>
	
	var interval = 15000;  // 1000 = 1 second, 3000 = 3 seconds
function doAjax() {
	var data = '';
    $.ajax({
            type: 'POST',
            url: '<?php echo site_url('messages/messageCount'); ?>',
            data: data,
            dataType: 'html',
            success: function (output) {
                    $('#notification-msg').html(output);// first set the value   
            },
            complete: function (data) {                   
                    setTimeout(doAjax, interval);
            }
    });
}
setTimeout(doAjax, interval);



	var interval1 = 10000;  // 1000 = 1 second, 3000 = 3 seconds
	function getAjax() {
	var data = '';
    $.ajax({
            type: 'POST',
            url: '<?php echo site_url('enquiry/EnquiryCount'); ?>',
            data: data,
            dataType: 'html',
            success: function (output) {
                    $('#notification-enq').html(output);// first set the value
                    //alert (output);   				
            },
            complete: function (data) {                   
                    setTimeout(getAjax, interval1);
            }
    });
}
setTimeout(getAjax, interval1);

	</script>
<!--Ajax Code For Header Notification-->
	<script>
	function Showenquiry()
	{
		var data = '';
		$.ajax({
			type:'POST',
			url:'<?php echo site_url('enquiry/EnquiryNotification');?>',
			data:data,
			dataType:'html',
			success:function(output){
				$('#task_notificatoin_bar1').html(output);
			}
		});
	}
	
	function ShowMessageNotification()
	{
		var data = '';
		$.ajax({
			type:'POST',
			url:'<?php echo site_url('messages/messageNotification');?>',
			data:data,
			dataType:'html',
			success:function(output){
				$('#task_notificatoin_bar').html(output);
			}
		});
	}
	
	</script>
	