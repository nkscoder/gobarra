  <?php $this->load->view("top_application"); ?>
  <?php $this->load->view("header"); ?>
  <div class="fromsuccess" >
        <div class="container" id="profile-edit-page">
		  <div class="form-signin">
    <h1>Congrats!</h1>
	<p>Your account has now been created. <?php echo anchor('user/login', 'Login Now');?></p>
  </div>
		 
</div>
</div>
<?php $this->load->view("footer"); ?>