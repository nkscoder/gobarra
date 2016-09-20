<?php $this->load->view("header"); ?>
<div class="subnavbar hidden-xs">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
		<li><a href="<?php echo base_url();?>travelplans/planschedul"><i class="fa fa-dashboard"></i><span>Dashboard</span> </a> </li>
        <li><a href="<?php echo base_url();?>timelinepost/timeline"><i class="icon_clock_alt"></i><span>Timeline</span> </a> </li>
        <li><a href="<?php echo base_url();?>admin_products/add"><i class="icon_folder-add_alt"></i><span>Add Product</span> </a></li>
        <li><a href="<?php echo base_url();?>admin_products"><i class="glyphicon glyphicon-list"></i><span>My Products</span></a></li>
       <li><a href="<?php echo base_url(); ?>messages/display_name"><i class="icon_mail_alt"></i><span> My Inbox</span> </a> </li>
		<li><a href="<?php echo base_url(); ?>enquiry"><i class="fa fa-flask "></i><span>My Enquiry</span> </a> </li>
        <li><a href="<?php echo base_url();?>user/profile"><i class="fa fa-user"></i><span>My Profile</span> </a> </li>
		<li class="active" ><a href="<?php echo base_url();?>user/ChangePassword"><i class="fa fa-unlock"></i><span>Change Password</span> </a> </li>		      
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
<!-- Page Content -->
<div class="page-content ">
   <div class="container profilePage">
      <div class="row topdashboardForm card-gobarra m-20 p-30">
         <!-- full Content -->
         <?php echo form_open_multipart('user/ChangePassword','id="form" ','class="form-horizontal" ','role="form"'); ?>         
         <div class="col-lg-6 ">
            <h3>Change password</h3>
			<?php 
				 if($this->session->flashdata('item'))
				 {
					 $message= $this->session->flashdata('item');
					 ?>
					 <div class="alert alert-success" id="chngpwd" role="alert">				
				<?php 
				echo $message['message'];?></div>
					 <?php
				 }
				 if($this->session->flashdata('item1'))
				 {
					 $message1 = $this->session->flashdata('item1');
					 ?>
					 <div class="alert alert-warning" id="changpwd" role="alert">				
					<?php 
					echo $message1['message1'];?></div>
					 <?php
				 }
				 ?>
					
            <div class="row">
               <div class="col-lg-12 marginBottom15"> <span class="size"> Old Password </span>
                  <input type="password" name="old_password" id="old_password" class="textfield required input-block-level validate[required]" placeholder="Old Password" >
               </div>
			   <span id='message' class="hidemsg"></span>
               <p class="clearfix"></p>
               <div class="col-lg-12 marginBottom15"> <span class="size"> New Password </span>
                  <input type="password" name="new_password" id="new_password" class="textfield required input-block-level validate[required]" placeholder="New Confirm Password" >
               </div>
               <p class="clearfix"></p>
               <div class="col-md-12 ">
                  <span class="size"> Confirm Password</span>
                  <input type="password"  id="confirm_password" name="confirm_password" class="textfield required input-block-level validate[required]" placeholder="Confirm Password"> 
               </div>
               <div class="col-lg-12 marginBottom15"></div>
               <div class="clearfix"></div>
               <div class="col-lg-12 marginBottom15">
                  <button type="submit" name="submit" class="btn btn-md btn-primary" title="Change Passowrd">Submit</button> 
               </div>
            </div>
         </div>
         <div class="col-lg-6 padding-gobarral ">
            <img src="<?php echo theme_url();?>img/EmailKey3.png" alt="" /> 
         </div>
         <div class="clearfix"></div>
         <!-- full Content-->
         <?php echo form_close(); ?>
      </div>
      <!-- /.container -->
   </div>
</div>
<!-- Page Content -->
<?php $this->load->view("footer"); ?>
<script  type="text/javascript">
					$(document).ready(function(){
					 setTimeout(function(){
					  $("#chngpwd").fadeOut("slow", function () {
					  $("#chngpwd").remove();
						  }); }, 5000);					 
					 var frmvalidator = new Validator("form");
					 frmvalidator.addValidation("old_password","req","Please Enter Old Password");
					 frmvalidator.addValidation("old_password","minlength=6","Min Length For Password 6");
					 frmvalidator.addValidation("new_password","req","Please Enter New Password");
					 frmvalidator.addValidation("new_password","minlength=6","Max Length For Password 6");
					 frmvalidator.addValidation("confirm_password","req","Please Enter Confirm Password");
					 frmvalidator.addValidation("confirm_password","minlength=6","Max Length For Password 6");					
					$('#confirm_password').on('keyup', function () {
					if ($(this).val() == $('#new_password').val()) {
						$('#message').html('Password Match').css('color', 'green');
					} else $('#message').html('New Password Not Match').css('color', 'red');
				});	
					});
					setTimeout(function(){
					  $("#changpwd").fadeOut("slow", function () {
					  $("#changpwd").remove();
						  }); 
						  }, 5000);
					 </script>