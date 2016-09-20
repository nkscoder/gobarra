<?php $this->load->view('header');?>
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
        <li class="active"><a href="<?php echo base_url();?>user/profile"><i class="fa fa-user"></i><span>My Profile</span> </a> </li>
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
			<div id="successaply"></div>
			<?php echo form_open_multipart('user/update_profile','id=uploadPic');?>
                <!-- full Content -->
				<div class="col-md-12 ">
				 
			
				 
			<div class="col-sm-4 mycol-md-4">
				<div class="bg leftDetailsSec">
					<div class="right_coloumn_box">
						<div class="card__content">
							<h1 class="card__title">My Profile</h1>

						</div>

					</div>
				<div class="right_coloumn_box">
					<div class="right-column-heading center-header-new">
						<h3 style="width: 250px; margin-left: 0px;" class="btn btn-md btn-primary">
							</h3><h4><?php echo $userData[0]['first_name'];?></h4>
					</div>
					<div data-ride="carousel" class="carousel slide" id="carousel-example-generic">
					<div role="listbox" class="">
					<div class="item active">
					<div class="container-fluid rightpost ">
					<?php
					if ($userData[0]['profile_image'] != "")
						{
						$img=base_url()."uploaded_files/profile_img/".$userData[0]['profile_image'];
						}
						else
						{
						$img=base_url()."uploaded_files/def_user/index.jpg";
						}
						?>				  								
					 					
					<div class="member-profile">
                    <div class="imageFrame"> 
					 <img id="profile-image-user"  src="<?php echo $img ; ?>" width="75px" height="75px">
					<input type="file" name="image" id="upload" class="hidden image">		
					 					
					
					</div>
					<a class="changePic" onclick="document.getElementById('upload').click(); return false" href="#">Change Profile </a>
					</div>
					<P class="pull-left"><em>   <?php 
				 if($this->session->flashdata('item'))
				 {
					 $message= $this->session->flashdata('item');
					 ?>
					 <div class="success" id="updateprofile" role="alert">				
				<?php 
				echo $message['message'];?></div>
					 <?php
				 }
				 ?></em></P>
				 </div>
				 </div>
				 </div>
				 </div>
				 </div>
				 </div>
			</div>
				 
	
		<div class="col-md-8"> 
		<div class="col-lg-12 topdashboardTextArea">

                                <div class="row">

                                    <div class="clearfix"></div>
                                    <div class="row">
                                        <div class="col-md-12 profilePage">
      <div id="home" class="tab-pane fade active in tabContainer">
        <div class="row">        
        <div class="col-lg-4 marginBottom15"> 
		<span class="size"> First Name </span>
              <input type="text" class="textfield required input-block-level validate[required]" value="<?php echo $userData[0]['first_name'];?>" title="First Name" placeholder="First Name" id="first_name" name="first_name"></div>               
               <div class="col-lg-4 marginBottom15"> <span class="size"> Last Name </span>
            <input type="text" class="textfield required input-block-level validate[required]" value="<?php echo $userData[0]['last_name'];?>" title="Last Name" placeholder="Last Name" id="last_name" name="last_name"></div>
              
                <div class="col-lg-4 marginBottom15">  <span class="size"> Email ID  </span>
              <input type="text" class="textfield input-block-level validate[required,custom[email]]" readonly="readonly" value="<?php echo $userData[0]['email'];?>" title="Email ID" placeholder="Email ID" id="email" name="email"></div>
               <script type="text/javascript">
                        function getState(id){
                        //alert(id.value);
                        var country_id = id.value;
                        $.ajax({
                            url:'getState',
                            type:'post',
                            data:{country_id : country_id},
                            success: function(data){
                               // alert(data);
                               $('#citi').html(data);
                           },
                           error:function(){
                            alert('Something Went Wrong');
                        }
                    });
                    }
                </script>
			<div class="col-lg-4 marginBottom15"> 
			<span class="size"> Country </span>
			<select title="Select Your Country" onchange="getState(this);" name="country_id" id="country_id" class="textfield2 marginBottomNone">
				<?php $country=("SELECT * FROM tbl_country WHERE status='1' GROUP BY country_name");
                      $co_query=$this->db->query($country);
                      if($co_query->num_rows()>0)
                      {
                          $list_co=$co_query->result_array();

                          ?>   
		<option value="">Select country</option>
				<?php foreach ($list_co as $key_co => $val_co) {
                                if ($userData[0]['country_id'] == $val_co['country_id'])
								{
									$selectedcountry = "selected='selected'";
								}
								else
								{
									$selectedcountry = "";
								}
								
                              ?>
	 <option <?php echo $selectedcountry; ?> value="<?php echo $val_co['country_id']; ?>">
                <?php echo $val_co['country_name']; ?></option>
                              <?php 
							  
							  }
							  ?>                            
                        </select>
                        <?php } ?>                            
                      </div>
              <div class="col-lg-4 marginBottom15">  
				<span class="size"> City </span>			  
            
                      <select title="Select Your City" name="city_id" class="textfield2 marginBottomNone " id="citi">
                          							 <?php
						  if ($userData[0]['city_id'] != "")
						  {
							  ?>
						<option value="<?php echo $userData[0]['city_id']; ?>"><?php echo $userData[0]['city']; ?></option>
						  <?php
						  }
						  else{
							  ?>	  
						<option value="">Select City</option> 
						  <?php }?>						
                      </select>
                                          
                  </div>
                 <div class="col-lg-4 marginBottom15">  
					<span class="size"> Occupation </span>
                   
                      <select title="Select Your Occupation" name="occupation" class="textfield2 marginBottomNone " id="occupation">
                         <?php
						  if ($userData[0]['occupation'] == "Employee")
						  {
							  ?>
						 <option value="<?php echo $userData[0]['occupation']; ?>" selected="selected"><?php echo $userData[0]['occupation']; ?></option>	  
							<option value="">Select Occupation</option>
						 <option value="Student">Student</option>
                          <option value="Business">Business</option>
						  <?php }
						   if ($userData[0]['occupation'] == "Business")
						  {
						  ?>
						<option value="<?php echo $userData[0]['occupation']; ?>" selected="selected"><?php echo $userData[0]['occupation']; ?></option>
						
						<option value="">Select Occupation</option>
						<option value="Employee">Employee</option>
                        <option value="Student">Student</option>
						<?php
						  }
						  
						   if ($userData[0]['occupation'] == "Student")
						  {
							  ?>
						<option value="<?php echo $userData[0]['occupation']; ?>" selected="selected"><?php echo $userData[0]['occupation']; ?></option>
						<option value="">Select Occupation</option>
						<option value="Employee">Employee</option>
                        <option value="Business">Business</option>
						<?php
						  }?>
						<?php						  
						  if ($userData[0]['occupation'] == '')
						  {
							  ?>						
						<option value="">Select Occupation</option>
						<option value="Employee">Employee</option>
						<option value="Student">Student</option>
                        <option value="Business">Business</option>
						<?php
						  }?>
                      </select>
                  </div>   
<div class="col-md-4 marginBottom15">

            <span class="size"> Phone Number</span>
             <input type="text" class="textfield required input-block-level validate[required]" value="<?php echo $userData[0]['mobile'];?>" title="Mobile Number" placeholder="Mobile Number" id="mobile" name="mobile" pattern="[7-9]{1}[0-9]{9}" maxlength="10"> 
        </div>				  
<div class="col-md-4 padding15" style="display: none;">
<span class="size"> Are you Couple - &nbsp;&nbsp;</span>
            <label class="radio-inline">
              <input type="radio" value="1" <?php if($userData[0]['couple']==1){echo "checked";} ?> id="couple1" name="couple" class="required"> Yes
            </label>
            <label class="radio-inline">
             <input type="radio" value="0" <?php if($userData[0]['couple']==0){echo "checked";} ?>  id="couple2" name="couple" class="required"> No
           </label>
        </div>
		<div class="col-md-4 padding15"> 
          <span class="size"> Gender - &nbsp;&nbsp;</span>
          <label class="radio-inline">
           <input type="radio" value="M" <?php if($userData[0]['gender']=="M"){echo "checked";} ?> id="gender1" name="gender" class="required"> Male
         </label>
         <label class="radio-inline">
           <input type="radio" value="F" <?php if($userData[0]['gender']=="F"){echo "checked";} ?> id="gender2" name="gender" class="required"> Female
         </label>
</div> 
<div class="clearfix"></div>
<div class="col-lg-12">
 <input type="submit" style="margin-right:71px;margin-top:30px;margin-bottom:15px;" class="btn btn-md btn-primary" value="Update">
    </div> 

</div>
   
     </div>
        
     <!--</form>-->
 
   </div>
   </div>
   </div>
   </div>
   </div>

				 </div> 
					<?php echo form_close();?>	
			</div> 
				
				
                <!-- full Content-->
 
            </div>
            <!-- /.container -->

        </div>


        <!-- Page Content -->
<?php $this->load->view('footer');?>
<script>
$(document).ready(function(){
					 setTimeout(function(){
					  $("#updateprofile").fadeOut("slow", function () {
					  $("#updateprofile").remove();
						  }); }, 2000);	
						  
		function updateUserPhoto(){
		
		var data = new FormData($('#uploadPic')[0]);					
					$('#upload').val('');
					$.ajax({
						type: "POST",               
						processData: false, // important
						contentType: false, // important
						data: data,
						url: "<?php echo site_url('user/updatephoto');?>",
						dataType : 'html',  
						success: function(output){
								$('#successaply').html(output);							
						}
					}); 
		
	}	   
	
		function readURL(input) {

		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#profile-image-user').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
		}

		$("#upload").change(function(){
			readURL(this);
		});	
});		
		</script>
		 <script>
  $(document).ready(function(){
		  var frmvalidator = new Validator("uploadPic");
					frmvalidator.addValidation("first_name","req","Please Enter Your First Name");
					frmvalidator.addValidation("last_name","req","Please Enter Your Last Name");
					frmvalidator.addValidation("email","req","Please Enter Your Email");
					frmvalidator.addValidation("country_id","req","Please Select Your Country");
					frmvalidator.addValidation("citi","dontselect=0","Please Select Your City Name");
					frmvalidator.addValidation("mobile","maxlen=10","Mobile Lenght Id 10 Digit");					
});
  </script>