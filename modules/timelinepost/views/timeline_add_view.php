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
		<li><a href="<?php echo base_url(); ?>enquiry"><i class="fa fa-flask "></i> <span>My Enquiry</span> </a> </li>
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
				 <div class="col-lg-12 topdashboardForm">
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
				if ($userData[0]->profile_image != "") {


                       $img=substr($userData[0]->profile_image, 0,5);
                       
                       if($img=='https'){
                                  /*  echo "string";*/
                                    $img=$userData[0]->profile_image;
                                }

                            else{
                                    $img=base_url().'uploaded_files/profile_img/'.$userData[0]->profile_image;
                                   
                                }
                         /* echo $img; die;*/
                                /*if($img=='https'){

                                 $img=base_url().'uploaded_files/profile_img/'.'$userData[0]->profile_image';
                                }else{
                                    $img=$userData[0]->profile_image;
                                }*/

				/*$img=base_url()."uploaded_files/profile_img/".$userData[0]->profile_image;*/
				} else {
				$img=base_url()."uploaded_files/def_user/dummy.png";
				} ?>
	<div class="imageFrame timeline col-md-6">
	 <span><p><a><img href="<?php echo $img ; ?>" id="profile-image-user" class="group3" src="<?php echo $img ; ?>"></a></p></span>
						
	</div>
<div class=" rightNameDetail col-md-12	 col-sm-12 col-xs-12"> <h4 class="userName"><strong> <?php echo $userData[0]->first_name ;?> <?php echo $userData[0]->last_name ;?> </strong></h4>

 <div class="details2"><i class="fa fa-map-marker"></i>Lives In: <?php echo $userData[0]->country_id ;?></div>
	  <div class="details2"><i class="fa fa-building-o"></i>From: <?php echo $userData[0]->city_id ;?> </div>
	  <?php if($userData[0]->occupation !='')
	  { ?>
	  <div class="details2"><i class="fa fa-university"></i>Occupation: <?php echo $userData[0]->occupation ;?></div>
	  <?php } else { 
	  ?>
	  <div class="details2"><i class="fa fa-university"></i>Occupation: Not Provided</div>
	  <?php } ?>
	  <?php if($userData[0]->mobile !='')
	  {?>
	   <div class="details2"><i class="fa fa-phone-square"></i>Mobile:<?php echo $userData[0]->mobile ;?></div>
		<?php } else 
		{?>
	<div class="details2"><i class="fa fa-phone-square"></i>Mobile: Not Provided </div>
	<?php } ?>
	<div class="details2"><i class="fa fa-envelope"></i>Email:<?php echo $userData[0]->email ;?></div>
	<?php if($userData[0]->gender !='')
	  {
	   if(($userData[0]->gender)=="M"){
			echo '<div class="details2"><i class="fa fa-male"></i>Gender: Male</div>';
	   }
	   else
		{
			echo '<div class="details2"><i class="fa fa-female"></i>Gender: Female</div>';
		} 
		} 
		else 
		{?>
	<div class="details2"><i class="fa fa-male"></i>Gender: Not Provided </div>
	<?php } ?>
		<?php if($total_products>=1)
		{?>
	  <div class="details2"><i class="fa fa-bars"></i><a style="color: #1949AF;font-weight: 600;" href="<?php echo base_url();?>timelinepost/more_products_user">Show all Products
		 </a></div>
		 <?php } ?>
</div>
<div class="clearfix"></div>	
	 	 </div>			
			</div>
				<div class="col-sm-8 col-xs-12 col-md-8 content">
                 <!--header-->
				 <?php 
				 if($this->session->flashdata('item'))
				 {
					 $message= $this->session->flashdata('item');
					 ?>
					 <div class="success timeline" id="postplan" role="alert">				
				<?php 
				echo $message['message'];?></div>
					 <?php
				 }
				 ?>
				 <div class="homeFormArea" style="padding-top: 17px; ">
					<ul class="nav nav-tabs">
					  <li class="active " style="border-left: 1px solid #ccc;"><a   href="<?php echo base_url(); ?>timelinepost/timeline">Post Timeline</a></li>
					 
					</ul>
				<?php echo form_open('timelinepost/timeline','id="form"') ;?>
					<div class="tab-content">
					  <div id="home" class="tab-pane fade in active"> 						 
						<div class="form-group col-lg-12 col-xs-12 something"> 
									<div class="fixArea p-20">
										<textarea class="form-control myform timeLineTextArea" id="description" name="description" maxlength="1000"></textarea>
									 </div>
								</div>
								 <div class="form-group col-lg-12 col-xs-12 something">
								<div class="fixArea">
									<button title="Add Post" class="btn btn-md btn-primary m-l-25" type="submit">Add Post</button> 
								</div>
								</div>  
						</div>
					   
				 </div>
				 <?php echo form_close(); ?>
				 <!--Travel--> 				
				
				<?php 
				if( is_array($res) && !empty($res) )
				{	 
				echo form_open("timelinepost/timeline",'id="data_form"');?>
				
				
				<div class="mail-option timeline-post">
                             <div class="chk-all">
                                 <input type="checkbox" class="mail-checkbox mail-group-checkbox pull-right" onclick="$('input[name*=\'arr_ids\']').attr('checked', this.checked);" title="Select All" > 
                                 <div class="btn-group">
                                     <a class="btn mini all" href="#" data-toggle="dropdown">
                                         &nbsp;&nbsp;All 
                                     </a> 
                                 </div>
                             </div>						
                             <div class="btn-group hidden-phone">
                                 <a class="btn mini blue" href="#" data-toggle="dropdown">
                                     More
                                     <i class="fa fa-angle-down "></i>
                                 </a>
                                 <ul class="dropdown-menu">
										<li> <button class="ProductsButton" name="status_action" type="submit" id="Delete" value="Delete"  onClick="return validcheckstatus('arr_ids[]','delete','Record');" >Delete</button> </li>
                                        <li><button class="ProductsButton" name="status_action" type="submit"  value="Activate" id="Activate" onClick="return validcheckstatus('arr_ids[]','Activate','Record','u_status_arr[]');" >Publish</button> </li>
                                        <li><button class="ProductsButton" name="status_action" type="submit" value="Deactivate" id="Deactivate"  onClick="return validcheckstatus('arr_ids[]','Deactivate','Record','u_status_arr[]');" >Un-Publish</button></li>
                                 </ul>
                             </div> 
                         </div>
				
				
				<div class="rowPOst mytimeline">
				<?php

							foreach($res as $catKey=>$pageVal)
							{						
							?>
				<div class="partnerResult">
				<?php if($userData[0]->profile_image !='')
					{
                        
                       $img=substr($userData[0]->profile_image, 0,5);

                       /*  echo $img;*/
                                if(!$img== 'https' or !$img== 'http' ){
                                 /*  echo "sdgjhsgdjshjgs";*/
                                 $img=base_url().'uploaded_files/profile_img/'.'$userData[0]->profile_image';
                                }else{
                                    $img=$userData[0]->profile_image;
                                }


				  /*  echo $img1 =base_url()."uploaded_files/profile_img/".$userData[0]->profile_image;*/


					}
					else{
					$img =base_url()."uploaded_files/def_user/dummy.png";
					}
					?>
					<div class="partnerPhoto">
						<a href="javascript:void(0);"><img src="<?php echo $img ; ?>" width="75px" height="75px"></a>
					</div>
			
			
					<div class="partnerInfo">
						<a href="javascript:void(0);">
						<div class="partnerName"><?php echo $userData[0]->first_name."&nbsp;".$userData[0]->last_name; ?> </a> 
						</div>
						<?php
						  $posttype = $pageVal['type'];
                                if ($posttype==1)
                                { ?><div class="tourname">Is Traveling From							
						<?php echo $pageVal['travel_from'];?>
						TO 
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
								<?php } ?>
								<div class="partnerDate">
						<?php 
						if($pageVal['created'] !='')
						{
						$originalDate = $pageVal['created'];
						$newDate = date("d F y", strtotime($originalDate));
						echo $newDate ; } ?>					
						<div class="endDate"></div>
					</div> 
						<div class="partnerInterests">
						    <span class="show-read-more"> <?php echo nl2br($pageVal['description']);?></span>
							<!-- Trigger the modal with a button -->						   
						 </div>
						  <div class="adjest pull-right planstyle">
						  <?php if($pageVal['type'] != '1')
						  { ?>
						 <td data-title="Action">
						 <?php if($pageVal['description'] != '')
						 {	 
						 ?>
							<a href="<?php echo "timelinepost/editpost/".$pageVal['travel_id']; ?>">
									  <i class="fa fa-pencil-square-o" title="Edit Post"></i> 
                                    </a>
									<?php } ?>
							</td>|
							<td data-title="All Select">
							<?php echo ($pageVal['status']=='1')?'<i class="fa fa-eye" title="Publish"></i>':'<i class="fa fa-eye-slash" title="Un-Publish"></i>';?>
							</td>|
						 <td data-title="All Select">
							<input type="checkbox" name="arr_ids[]" value="<?php echo $pageVal['travel_id'];?>" class="mail-checkbox mail-group-checkbox">
							</td>
						  <?php } ?>
							</div>
					</div>					
				</div>
				<?php } ?>
				<?php echo $page_links; ?>	
				 </div>
				<?php form_close(); 
							}else{
							echo "<center><strong> No record(s) found !</strong></center>" ;
							}
							?>  
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
		<script  type="text/javascript">
					 $(document).ready(function(){
					 setTimeout(function(){
					  $("#postplan").fadeOut("slow", function () {
					  $("#postplan").remove();
						  }); }, 2000);					 
					 var frmvalidator = new Validator("form");					 
					 frmvalidator.addValidation("description","req","Please Enter Your Post");
					 frmvalidator.addValidation("description","maxlen=1000");
					 });
					 </script>