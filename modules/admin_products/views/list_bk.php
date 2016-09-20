<?php $this->load->view('header');?>
<div class="subnavbar hidden-xs">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
		<li><a href="<?php echo base_url();?>travelplans/planschedul"><i class="fa fa-dashboard"></i><span>Dashboard</span> </a> </li>
        <li><a href="<?php echo base_url();?>timelinepost/timeline"><i class="icon_clock_alt"></i><span>Timeline</span> </a> </li>
        <li ><a href="<?php echo base_url();?>admin_products/add"><i class="icon_folder-add_alt"></i><span>Add Product</span> </a></li>
        <li class="active"><a href="<?php echo base_url();?>admin_products"><i class="glyphicon glyphicon-list"></i><span>My Products</span></a></li>
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
		<div class="topdashboardForm ">
            <div class="row">
			<?php 
				 if($this->session->flashdata('item'))
				 {
					 $message= $this->session->flashdata('item');
					 ?>
					 <div class="success" id="sucsessproduct" role="alert">				
				<?php 
				echo $message['message'];?></div>
					 <?php
				 }
				 ?>
                <!-- full Content -->
	<?php 
		   if( is_array($res_array) && !empty($res_array) )
		  {			
			echo form_open("admin_products/",'id="data_form"');?>			
				<div class="col-md-12 ">
				 <div class="col-lg-12  ">
				 <h3>My Products</h3>
				 <div class="mail-option">
                             <div class="chk-all">
                                 <input type="checkbox" class="mail-checkbox mail-group-checkbox" onclick="$('input[name*=\'arr_ids\']').attr('checked', this.checked);" title="Select All">
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
				 <div id="no-more-tables col-lg-12">
			<?php foreach ($res_array as $key => $pageVal)
			{
				?>
				 <div class="partnerResult Productpage">
					<div class="partnerPhoto">
					<?php if($userData[0]['profile_image'] !='')
					{
                            $img=substr($userData[0]['profile_image'],0,5);

                                /* echo $img;*/ /*die;*/

                                if($img=='https'){
                                  /*  echo "string";*/
                                    $img=$userData[0]['profile_image'];
                                }else{
                                    $img=base_url().'uploaded_files/profile_img/'.$userData[0]['profile_image'];
                                   
                                }

						/*$img=base_url()."uploaded_files/profile_img/".$userData[0]['profile_image'];*/
					}
					else{
					$img=base_url()."uploaded_files/def_user/index.jpg";
					}
					?>
						<a href="<?php echo base_url();?>timelinepost/timeline/<?php echo $pageVal['user_id'];?>"><img src="<?php echo $img;?>" width="75px" height="75px"></a>
					</div>
					<div class="partnerInfo ">
						<div class="pull-right">
								
									<a href="<?php echo "admin_products/edit/".$pageVal['product_id']; ?>">
									  <i class="fa fa-pencil-square-o" title="Edit"></i>
                                    </a>|
									<?php echo ($pageVal['status']=='1')?'<i class="fa fa-eye" title="Publish"></i>':'<i class="fa fa-eye-slash" title="Un-Publish"></i>';?>|
								  <input type="checkbox" name="arr_ids[]" value="<?php echo $pageVal['product_id'];?>" class="mail-checkbox mail-group-checkbox" title="Select">								 
					</div>
						<div class="col-md-6">
						<div class="partnerName"><?php echo $pageVal['product_name'];?> <em class="smallText">Added By</em><a href="<?php echo base_url();?>timelinepost/timeline/<?php echo $pageVal['user_id'];?>"> <?php echo $userData[0]['first_name'];?></a> <br>
						 <span><?php echo $pageVal['country_name'];?> ( <?php echo $pageVal['city'];?> )</span>
					 </div>
						
						<div class="partnerInterests">
					 <span class="show-read-more"> <?php echo str_replace('<br/>',"\n",$pageVal['description'] );?></span>
						   <!-- Trigger the modal with a button --> 
						 					                                     
						 </div>
						</div>
						<div class="col-md-6">
						
						<div class="partnerSupport">
						 	<div class="cellSub">
											<?php
											if($pageVal['img1']!='')
											{
                                             $target_path = base_url()."uploaded_files/product_image1/".$pageVal['img1'];
											}
											else
                                            {
                                              $target_path= base_url()."uploaded_files/def_user/index.jpg";
                                            }
                                            ?>
										<?php
											if($pageVal['img2']!='')
											{
                                             $target_path1 = base_url()."uploaded_files/product_image2/".$pageVal['img2'];
											}
											else
                                            {
                                              $target_path1= base_url()."uploaded_files/def_user/index.jpg";
                                            }
                                            ?>  		
									<div class="preview prouductDisplay">
									<span><p><a><img src="<?php echo $target_path ;?>" alt="" class="group3" href="<?php echo $target_path; ?>"></a></p></span> 
									<span><p><a><img src="<?php echo $target_path1 ; ?>" alt="" class="group4" href="<?php echo $target_path1 ; ?>"></a></p></span>
									</div>
								</div>
					
						</div>
					   </div>
					   	<div class="clearfix"></div>
					</div> 
				</div>
						<?php }?>
				<?php echo $page_links; ?>		
				<div class="clearfix"></div>
					</div>
				 </div> 								
				</div> 
				<?php echo form_close();
					}else{
			echo "<center><strong> No Product(s) found !</strong></center>" ;
	 }
					?>
				
                <!-- full Content-->
 
            </div>
            <!-- /.container -->
		</div>
        </div>
        <!-- Page Content -->
		<?php $this->load->view('footer');?>
		<script>
		$(document).ready(function(){
			 setTimeout(function(){
			  $("#sucsessproduct").fadeOut("slow", function () {
			  $("#sucsessproduct").remove();
				  }); }, 10000);
		})
		</script>