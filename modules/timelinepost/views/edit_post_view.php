<?php $this->load->view('header');?>
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
 <!-- Page Content -->
    <div class="page-content ">
        <div class="container">
            <div class="row">
                <!-- full Content -->
                <div class="col-md-12 ">
				 <div class="col-lg-12">
				 <div class="col-lg-12">  <h3>My Timeline Page</h3></div>
				<!--timeline-->			
			  
			 
			  <!-- Right Sidebar Content -->
			  	<div class="col-sm-4 col-xs-12 col-md-4 ">
				 <div class="bg leftDetailsSec">
				 <?php 
					 $this->load->model('admin_products/products_model');
					 $id = $userData[0]->user_id;				 
					 $products = $this->products_model->record_count($id);
					 $total_products = count($products);
				if ($userData[0]->profile_image!= "") {
                          
                                $img=substr($userData[0]->profile_image,0,5);

                                /* echo $img;*/ /*die;*/

                                if($img=='https'){
                                  /*  echo "string";*/
                                    $img=$userData[0]->profile_image;
                                }else{
                                    $img=base_url().'uploaded_files/profile_img/'.$userData[0]->profile_image;
                                   
                                }
                            
					   /*$img=substr($userData[0]->profile_image, 0,5);
                      
                                if(!$img=='https'){

                                   $img=base_url().'uploaded_files/profile_img/'.'$userData[0]->profile_image';
                                }else{
                                    $img=$userData[0]->profile_image;
                                }*/

					      /*$img=base_url()."uploaded_files/profile_img/".$userData[0]->profile_image;*/

				} else {
					$img=base_url()."uploaded_files/def_user/dummy.png";
				} ?>
	<div class="imageFrame profileImages timeline col-md-6">
	 <div class="imageFrame profileImages"> <img id="profile-image-user" src="<?php echo $img ; ?>">
						  </div>
	</div>
<div class=" rightNameDetail col-md-12	 col-sm-12 col-xs-12"> <h4> <?php echo $userData[0]->first_name ;?> <?php echo $userData[0]->last_name ;?> </h4>

 <div class="details2"><i class="fa fa-map-marker"></i>Lives In: <?php echo $userData[0]->country_id ;?></div>
	  <div class="details2"><i class="fa fa-building-o"></i>From: <?php echo $userData[0]->city_id ;?> </div>
	  <?php if($userData[0]->occupation !='')
	  {?>
	  <div class="details2"><i class="fa fa-university"></i>Occupation: <?php echo $userData[0]->occupation ;?></div>
	   <?php } else
	   {?>
     <div class="details2"><i class="fa fa-university"></i>Occupation:Not Provided</div>
   <?php } ?>
   <?php if($userData[0]->mobile !='')
   {?>
	   <div class="details2"><i class="fa fa-phone-square"></i>Mobile:<?php echo $userData[0]->mobile ;?></div>
		<?php } else 
			{ ?>
		<div class="details2"><i class="fa fa-phone-square"></i>Mobile:Not Provided</div>
		<?php } ?>
	<div class="details2"><i class="fa fa-phone-square"></i>Email:<?php echo $userData[0]->email ;?></div>	
		<?php if($total_products>=1)
		{?>
	  <div class="details2"><i class="fa fa-bars"></i><a href="<?php echo base_url();?>timelinepost/more_products_user" style="color: #1949AF;font-weight: 600;">Show all Products
		 </a></div>
		 <?php } ?>
</div>
<div class="clearfix"></div>	
	 	 </div>			
			</div>
				<div class="col-sm-8 col-xs-12 col-md-8 content">
                 <!--header-->
				 <div class="homeFormArea">
					<ul class="nav nav-tabs">
					  <li class="active"><a   href="<?php echo base_url(); ?>timelinepost/timeline">Post Timeline</a></li>
					 
					</ul>
		<?php echo form_open_multipart(current_url_query_string(),'id="form"');		
		?> 
					<div class="tab-content">
					  <div id="home" class="tab-pane fade in active"> 
						 
						<div class="form-group col-lg-12 col-xs-12 something"> 
									<div class="fixArea">
										<textarea class="form-control timeLineTextArea" id="description" name="description"><?php echo set_value('description',$res->description);?></textarea>
									 </div>
								</div>
								 <div class="form-group col-lg-12 col-xs-12 something">
								<div class="fixArea">
									<button title="Update Post" class="btn btn-md btn-primary" type="submit">Update Post</button> 
								</div>
								</div>  
						</div>
					   
				 </div>
				 <?php echo form_close(); ?>
				 <!--Travel--> 								 					
                </div>
			 <!-- Right Sidebar Content end-->
            </div>
				<!--timeline-->								
				 </div> 
                </div>				
                <!-- full Content-->
            </div>         
        </div>
        <!-- Page Content -->
		<?php $this->load->view('footer');?>