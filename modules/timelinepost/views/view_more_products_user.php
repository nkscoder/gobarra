<?php $this->load->view('header'); ?>
<div class="subnavbar hidden-xs">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
		<li><a href="<?php echo base_url();?>travelplans/planschedul"><i class="fa fa-dashboard"></i><span>Dashboard</span> </a> </li>
        <li class="active" ><a href="<?php echo base_url();?>timelinepost/timeline"><i class="icon_clock_alt"></i><span>Timeline</span> </a> </li>
        <li><a href="<?php echo base_url();?>admin_products/add"><i class="icon_folder-add_alt"></i><span>Add Product</span> </a></li>
        <li><a href="<?php echo base_url();?>admin_products"><i class="glyphicon glyphicon-list"></i><span>My Products</span></a></li>
        <li><a href="<?php echo base_url(); ?>messages/display_name"><i class="icon_mail_alt"></i><span> My Inbox</span> </a> </li>
		<li><a href="<?php echo base_url(); ?>enquiry"><i class="fa fa-flask "></i><span>My Enquiry</span> </a> </li>
        <li><a href="<?php echo base_url();?>user/profile"><i class="fa fa-user"></i><span>My Profile</span> </a> </li>
		<li><a href="<?php echo base_url();?>user/ChangePassword"><i class="fa fa-unlock"></i><span>Change Password</span> </a> </li>
		 
        
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
    <!-- Header -->   
    <!-- /.intro-header -->

    <!-- Page Content -->
    <div class="page-content ">
        <div class="container">
            <div class="row">
                <!-- left Sidebar Content -->
                <div class="col-sm-4 leftSidebar hidden-xs">                 
				 <div class="bg leftDetailsSec">
				 <?php 
				if ($userifo[0]->profile_image != "") {

                       $img=substr($userifo[0]->profile_image, 0,5);
                         /* echo $img; die;*/

                                  if($img=='https'){
                                  /*  echo "string";*/
                                    $img=$userifo[0]->profile_image;
                                }else{
                                    $img=base_url().'uploaded_files/profile_img/'.$userifo[0]->profile_image;
                                   
                                }
                               /* if(!$img='https'){

                                   $img=base_url().'uploaded_files/profile_img/'.'$userifo[0]->profile_image';
                                }else{
                                    $img=$userifo[0]->profile_image;
                                }*/

					/*$img=base_url()."uploaded_files/profile_img/".$userifo[0]->profile_image;*/
				} else {
					$img=base_url()."uploaded_files/def_user/dummy.png";
				} ?>
	<div class="imageFrame profileImages timeline col-md-6">
	 <div class="imageFrame profileImages"> <img id="profile-image-user" src="<?php echo $img ; ?>">
						  </div>
	</div>
<div class=" rightNameDetail col-md-12	 col-sm-12 col-xs-12"> <h4 class="userName"><strong> <?php echo $userifo[0]->first_name ;?> <?php echo $userifo[0]->last_name ;?> </strong></h4>

 <div class="details2"><i class="fa fa-map-marker"></i>Lives In: <?php echo $userifo[0]->country_id ;?></div>
	  <div class="details2"><i class="fa fa-building-o"></i>From: <?php echo $userifo[0]->city_id ;?> </div>
	  <?php if($userifo[0]->occupation !='')
	  { ?>
	  <div class="details2"><i class="fa fa-university"></i>Occupation: <?php echo $userifo[0]->occupation ;?></div>
	   <?php } else
	   {?>
		<div class="details2"><i class="fa fa-university"></i>Occupation:Not Provided</div> 
   <?php }   
	   ?>
	   <?php if($userifo[0]->mobile !=''){ ?>
	   <div class="details2"><i class="fa fa-phone-square"></i>Mobile:<?php echo $userifo[0]->mobile ;?></div>
	   <?php } else
	   { ?><div class="details2"><i class="fa fa-phone-square"></i>Mobile:Not Provided</div><?php } ?>
	  <div class="details2"><i class="fa fa-phone-square"></i>Email:<?php echo $userifo[0]->email ;?></div>
	<?php if($userifo[0]->gender !='') {
			if(($userifo[0]->gender)=="M"){?>
			<div class="details2"><i class="fa fa-male"></i>Gender: Male</div>
		   <?php } else
			{ ?>
			<div class="details2"><i class="fa fa-female"></i>Gender: Female</div>
			<?php } } 
			else { ?>
			<div class="details2"><i class="fa fa-male"></i>Gender: Not Provided </div>
			<?php } ?>
			</div>
	 	 </div>
		 <div class="clearfix"></div>
	
				 </div>
                <!-- left Sidebar Content end-->
		<?php 
		   if( is_array($res_array) && !empty($res_array) ) {	?> 
                <!-- Right Sidebar Content -->
                <div class="col-sm-12 col-xs-12 col-md-8 content">
                    <!--header-->
                    <div class="homeFormArea">                        
                        <!--Travel-->
                        <div class="rowPOst"> 
			<?php foreach ($res_array as $key => $pageVal) { ?>	
				 <div class="partnerResult">
					<div class="partnerPhoto">
					<?php if($userifo[0]->profile_image !='') {
						$img=base_url()."uploaded_files/profile_img/".$userifo[0]->profile_image;
					} else {
					$img=base_url()."uploaded_files/def_user/dummy.png";
					} ?>
				<img src="<?php echo $img;?>" width="75px" height="75px">
				</div>			
					<div class="partnerInfo">
						<div class="partnerName"><?php echo $pageVal['product_name'];?> <em class="smallText"> Added by </em><a href="#"><?php echo $userifo[0]->first_name;?></a> <br>
						 <span><?php echo $pageVal['country_id'];?> (<?php echo $pageVal['city_id'];?>)</span>
					 </div>							
						<div class="partnerInterests">
					 <span class="show-read-more"> <?php echo $pageVal['description'];?></span>
						   <!-- Trigger the modal with a button --> 
						 					                                     
					</div>
			<div class="partnerSupport">
			<div class="cellSub">
			<?php
				if($pageVal['img1']!='') {
				 $target_path = base_url()."uploaded_files/product_image1/".$pageVal['img1'];
				} else {
				  $target_path= base_url()."uploaded_files/def_user/dummy.png";
				} ?>
			<?php
				if($pageVal['img2']!='') {
				 $target_path1 = base_url()."uploaded_files/product_image2/".$pageVal['img2'];
				} else {
				  $target_path1= base_url()."uploaded_files/def_user/dummy.png";
				} ?>
			<div class="preview prouductDisplay">
			<span><p><a><img  src="<?php echo $target_path ;?>" alt="" class="group3 img-responsive" href="<?php echo $target_path; ?>"></a></p></span> 
			<span><p><a><img src="<?php echo $target_path1 ; ?>" alt="" class="group4 img-responsive" href="<?php echo $target_path1 ; ?>"></a></p></span>
			</div>
		</div>
			</div>
		</div>
	</div>						
		  <?php } ?>
                     </div>
                    </div>
                    <!-- Right Sidebar Content end-->
                </div>
		  <?php } else{
					echo "NO More Product(s)" ;
				} ?>
            </div>
            <!-- /.container -->
        </div>
        <!-- Page Content -->
        <!-- Footer -->
      <?php $this->load->view('footer');?>