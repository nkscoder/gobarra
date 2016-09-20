 <?php $this->load->view('header'); ?>
 <!-- Page Content -->
    <div class="registerbg">    
	<div class="page-content logopage">
        <div class="container ">
      	<section class="main">
		<?php echo validation_errors(); ?>
		<form onsubmit="return emailVerify()" class="form-2 register card-gobarra p-30" id="createform" name="createform" method="post" action="<?php echo base_url(); ?>user/create_member">
					<h1 class=" text-center"><span class="log-in f-18" style="color:#91C181;">Register With Gobarra</span></h1>
					<p class="float"> 
						<input type="text" name="first_name" placeholder="First Name" id="fname" >
						
					</p>
					<p class="float"> 
						<input type="text" name="last_name" placeholder="Last Name" id="lname" >
					</p>
					<p class="float full"> 
					
						<input type="text" name="email" placeholder="Email ID" id="useremail" >
						 
					</p>
					<p class="float"> 
						<input type="password" name="password" placeholder="password" id="password" >
						 
					</p>
					<p class="float">
					<span id='message' class="hidemsg"></span>	
						<input type="password" name="cpassword" placeholder="Re-enter Password" id="cpassword" >
						 
					</p>
					<p class="float"> 
						 <input type="text" name="country_name" placeholder="Enter Country" id="country1" title="Select Your Country">
					</p>
					<p class="float"> 
					 <input type="text" name="city_name" id="cities" placeholder="Enter City" >
					</p>
					<p class="float"> 
							 <select class="textfield2 marginBottomNone" name="occupation" id="occupation" >
                            <option value="">Select Occupation</option>
											<option value="Student">Student</option>
                                            <option value="Business"> Business</option>
                                            <option value="Employee"> Employee</option>
<option value="Other">Other</option>
                                                        </select> 
														</p>
					<p class="float full"> 
						<div class="form-group text-center">
                                   
                                    <label class="">
            <input type="radio" class="required f-14" name="gender" id="gender1" value="1" checked> Male
                                    </label>
                                    <label class="">
                                        <input type="radio" class="required f-14" name="gender" id="gender2" value="2"> Female
                                    </label>
                                </div> 	</p>

                               <!--  <h5 id='emailError' style="color:red"></h5>
					<p class="clearfix text-center submit"> 
						 <button type="submit" class="login-btn" name="submit" value="REGISTER "> <span class="white-c">REGISTER</span>
					</p> -->

					<h5 id='emailError' style="color:red"></h5>
					<p class="clearfix text-center submit"> 
						 <input type="submit" name="submit" value="REGISTER "> 
					</p>
					
					 	<div class="clearfix"></div>
                                <div class="row m-t-20">
					<div class = "col-xs-12 col-md-6 col-sm-6 p-0 p-r-10 text-center">
<!-- 				<div class="account text-center">
 -->
<!-- 						<div class="span">
 -->							<a href="<?php echo site_url(); ?>home/facebook_login" class=" facebook-btn m-l-40">
							<!-- <img src="<?php echo theme_url();?>img/facebook.png" alt=""> -->

							<i class="fa fa-facebook "></i>&nbsp;<span>Sign In with Facebook</span>
<!-- 							<div class="clear"></div>
 -->					</a>
<!-- 					</div>
 -->				</div>
 
						
					<div class = "col-xs-12 col-md-6 col-sm-6 p-0 p-l-10 text-center">
<!-- 						<div class="span2">
 -->							<a href="<?php echo base_url();?>home/google_login" class=" google-btn p-l-20">
								<!-- <img src="<?php echo theme_url();?>img/gplus.png" alt=""> -->
							<i class="fa fa-google-plus "></i>&nbsp;&nbsp; <span>Sign In with Google+</span> 
								<!-- <div class="clear"></div> -->
							</a>
<!-- 						</div>
 -->					</div>
						</div>
		
				
		          	
					

					 <!-- 	<div class="clearfix"></div> -->

					 	
			
				</form>​​
			</section>
		 
	</div>
		</div>
        </div>
	<?php $this->load->view('footer'); ?>
	 <script>
  /*$(document).ready(function(){
		  var frmvalidator = new Validator("createform");
					frmvalidator.addValidation("fname","req","Please Enter Your First Name");
					frmvalidator.addValidation("lname","req","Please Enter Your Last Name");
					frmvalidator.addValidation("useremail","req","Please Enter Your Email");
					frmvalidator.addValidation("password","req","Please Enter Your Password");
					frmvalidator.addValidation("password","maxlen=16","Password Lenght 16 Charecter");	
					frmvalidator.addValidation("cpassword","req","Please Enter Your Confirm Password");
					frmvalidator.addValidation("cpassword","maxlen=16","Password Lenght 16 Charecter");
					frmvalidator.addValidation("country","req","Please Select Your Country");
					frmvalidator.addValidation("cities","dontselect=0","Please Select Your City Name");

					$('#cpassword').on('keyup', function () {
					if ($(this).val() == $('#password').val()) {
						$('#message').html('Password Match').css('color', 'green');
					} else $('#message').html('Password Not Match').css('color', 'red');
				});
					});	 */
</script>  
      <script type="text/javascript">
        google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(document.getElementById('country1'));
            google.maps.event.addListener(places, 'place_changed', function () {
                var place = places.getPlace();
                var address = place.formatted_address;
            });
        });
    </script>
      <script type="text/javascript">
        google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(document.getElementById('cities'));
            google.maps.event.addListener(places, 'place_changed', function () {
                var place = places.getPlace();
                var address = place.formatted_address;
            });
        });
    </script>


 <script>

	 function emailVerify() {

		/*  alert(3245451578);*/
		 var fname =document.getElementById("fname").value;
		 var lname=document.getElementById("lname").value;
		 var useremail=document.getElementById("useremail").value;


		 var password =document.getElementById("password").value;
		 var cpassword=document.getElementById("cpassword").value;

		 var gender1=document.getElementById("gender1").value;
		 var gender2 =document.getElementById("gender2").value;


		 var occupation=document.getElementById("occupation").value;

		 var country1=document.getElementById("country1").value;
		 var cities=document.getElementById("cities").value;

		/* var email = document.getElementById("username").value;*/
		 var emailreg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		 var email_error = document.getElementById("email_error");

     /*console.log(password.length);
      alert(password.length);*/

		 if(!fname=='') {
			/* alert(5465);*/

			 if(!lname=='') {


			 if (document.getElementById("useremail").value.match(emailreg)) {
				 if(!password=='') {

				 	 if(password.length >4) {

                     if(password==cpassword)
					    {
                         if (!country1 == '' && !cities == ''){
                         	if(!occupation==''){
                              if (gender1.checked==false && gender2.checked==false) {
                                   document.getElementById("emailError").innerHTML = " Please select gender";
									return false;
                                        } else {
  							                     return true;
												}
								}else {
                               	document.getElementById("emailError").innerHTML = "Please select Occupation";
										return false;
								    	}


							 } else {
								 document.getElementById("emailError").innerHTML = " Please select Country and Cities";
								   return false;
								  }

								 }else{
								 document.getElementById("emailError").innerHTML = " Password does not match the confirm password";
								 return false;
							 }

							  }else{
					 document.getElementById("emailError").innerHTML = "password must be at least 5 characters";
					 return false;
				 }

				 }else{
					 document.getElementById("emailError").innerHTML = " Please enter a password";
					 return false;
				 }


			 } else {
				 document.getElementById("emailError").innerHTML = "Your email address is invalid. Please enter a valid address. ";
				 return false;
			 }
		 }

		 else	{

			 document.getElementById("emailError").innerHTML = " Please enter last name . ";
			 return false;
		 }

		 }else	{

			 document.getElementById("emailError").innerHTML = " Please enter first name . ";
			 return false;
		 }


		 return false;
	 }
 </script>