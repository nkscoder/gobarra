<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Welcome to </title>
<link href="<?php echo theme_url(); ?>css/kidstuff-preet.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/developers/css/proj.css" rel="stylesheet" type="text/css" />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]--> 
</head>

<body class="p10">
<?php echo  form_open(''); ?>

<div class="p10 bg-white  shadow bdr2 radius-3">
  <p class="fs11 fr pr16">( <span class="star">* </span>) fields are mandatory.</p>
  <?php echo error_message(); ?>
  <h1>Refer to  Friend</h1>
  <p class="mt10"><label for="your_name">Your Name <span class="star">*</span></label></p>
        <p class="mt3"><input name="your_name" id="your_name" type="text" class="txtbox w95" value="<?php echo set_value('your_name');?>" maxlength="100" /><?php echo form_error('your_name');?></p>
        
        <p class="mt10"><label for="your_email">Your Email <span class="star">*</span></label></p>
        <p class="mt3"><input name="your_email" id="your_email" type="text" class="txtbox w95" value="<?php echo set_value('your_email');?>" maxlength="100" ><?php echo form_error('your_email');?></p>
        
        <p class="mt10"><label for="friend_name">Your Friend's Name <span class="star">*</span></label></p>
        <p class="mt3"><input name="friend_name" id="friend_name" type="text" class="txtbox w95" value="<?php echo set_value('friend_name');?>" maxlength="100" ><?php echo form_error('friend_name');?></p>
        
        <p class="mt10"><label for="friend_email">Your Friend's Email  <span class="star">*</span></label></p>
        <p class="mt3"><input name="friend_email" id="friend_email" type="text" class="txtbox w95" value="<?php echo set_value('friend_email');?>" maxlength="100" ><?php echo form_error('friend_email');?></p>
        
        
        
         <p class="mt10"><label for="WORD">WORD VERIFICATION  <span class="star">*</span></label></p>
        <p class="mt3"><input name="verification_code" id="WORD" type="text" class="txtbox w95" ><br><br>
        <img src="<?php echo site_url('captcha/normal'); ?>" class="vam bdr" alt=""  id="captchaimage"/> <a href="javascript:viod(0);" title="Change Verification Code"  ><img src="<?php echo theme_url(); ?>images/refresh.png"  alt="Refresh"  onclick="document.getElementById('captchaimage').src='<?php echo site_url('captcha/normal'); ?>/<?php echo uniqid(time()); ?>'+Math.random(); document.getElementById('verification_code').focus();" class="ml10 vam"></a><?php echo form_error('verification_code');?>
        
        
        </p>
        
        
        <p class="mt10"><input name="submit" type="submit"  value="Send" class="button-style" /></p>
  </div>
<?php echo form_close();?>
</body>
</html>