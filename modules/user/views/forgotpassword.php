<?php $this->load->view('header');?>
    <!-- Page Content -->
    <div class="page-content logopage">
        <div class="container">		
      	<section class="main">
		<?php 
				 if($this->session->flashdata('item'))
				 {
					 $message= $this->session->flashdata('item');
					 ?>
					 <div class="success error" id="forgetpswd" role="alert">				
				<?php 
				echo $message['message'];?></div>
					 <?php
				 }
				 ?>				 
				<form onsubmit="return emailVerify() " class="form-2" id="formular" name="formular" method="post" action="<?php echo base_url(); ?>user/forgotpassword">
					<h1><span class="log-in">Forgot<span class="sign-up">Password</span></h1>
					<p class="float full">
						<label for="login"><i class="fa icon-user"></i>Email Id</label>
							<input type="text" name="email"  placeholder="Email" class="Email" id='emailForgot' >
					</p>
					<h5 id='emailError' style="color:red"></h5>
					<p class="clearfix text-center submit"> 
					<input type="submit" name="submit" value="submit">
					</p>
					<p><a href="<?php echo base_url();?>user/login">Login Now</a></p>
				</form>​​
			</section> 
			<div class="account text-center">
						<h2> Don' have an account? Log in with! </h2>
						<div class="span"><a href="<?php echo base_url(); ?>home/facebook_login"><img src="<?php echo theme_url();?>img/facebook.png" alt=""><i>Sign In with Facebook</i><div class="clear"></div></a></div>	
						<!--<div class="span1"><a href="#"><img src="<?php /*echo theme_url();*/?>img/twitter.png" alt=""><i>Sign In with Twitter</i><div class="clear"></div></a></div>-->
						<div class="span2"><a href="<?php echo base_url();?>home/google_login"><img src="<?php echo theme_url();?>img/gplus.png" alt=""><i>Sign In with Google+</i><div class="clear"></div></a></div>
					</div>
					</div>

	</div>
	
	
	
	<?php $this->load->view('footer'); ?>
	<script>
  $(document).ready(function(){
					setTimeout(function(){
					  $("#forgetpswd").fadeOut("slow", function () {
					  $("#forgetpswd").remove();
      }); }, 6000);
					});
  </script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
<script type="text/javascript">
/*
	function validateEmail(email) {
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(email);
	}

	function validate() {
		$("#result").text("");
		var email = $("#email").val();
		if (validateEmail(email)) {
			/!*$("#result").text(email + " is valid :)");
			$("#result").css("color", "green");*!/
			/!*$("#formular").submit();*!/

			/!*submitHandler: function(form) {
				$("#validate").button('loading');
				setTimeout(function() { $("#validate").button('reset'); }, 3000);
				success2.show();
				error2.hide();
				form.submit();
			}*!/


		} else {
			$("#result").text( " Email is not valid ");
			$("#result").css("color", "red");
		}
		return false;
	}*/

/*	$("form").bind("submit", validate);*/
</script>


<script>

  function emailVerify() {

	 /* alert(3245451578);*/

	  var email = document.getElementById("emailForgot").value;
	  var emailreg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	  var email_error = document.getElementById("email_error");
	  if(!email=='') {
		  if (document.getElementById("emailForgot").value.match(emailreg)) {
             /* alert(548);
			  return true;*/
			  return true;
		  } else {
			  document.getElementById("emailError").innerHTML = "Your email address is invalid. Please enter a valid address. ";
			  return false;
		  }

	  }else	{

		  document.getElementById("emailError").innerHTML = " Please enter an Email address. ";
		  return false;
	  }

	  document.getElementById("emailForgot").focus();
	  return false;
  }

</script>