<?php echo form_open('','name="support_form" id="support_form"') ;
//trace($this->session);
?> 
<div class="mt15">

    <p class="fs22 b shadow-txt brown ttu">Offer Alerts -</p>
    <p class="b fs14 ttu pink shadow-txt">Never miss a great deal</p>
    <p class="mt3 black">Enter your email address to sign up for our special offers and product promotions</p>
    <span id="support_form_error"></span>
    <p class="mt7"><input type="text" name="subscriber_name" id="subscriber_name" class="bdr3 radius-7 w92 p8" placeholder="Name *"><span id="subscriber_name"></span></p>
    <p class="mt6"><input type="text" name="subscriber_email" id="subscriber_email" class="bdr3 radius-7 w92 p8" placeholder="Email Address *"><span id="subscriber_email"></span></p>
    <p class="mt5"><input type="text" name="verification_code" id="verification_code" class="bdr3 radius-7 w35 p8" placeholder="Enter Code">  
   <img src="<?php echo base_url()."captcha/normal"?>"	alt="" class="vam" height="26" id='captchaimage'>&nbsp; <a href="javascript:viod(0);" title="Change Verification Code"  ><img src="<?php echo theme_url(); ?>images/refresh.png"  alt="Refresh"  onclick="document.getElementById('captchaimage').src='<?php echo site_url('captcha/normal'); ?>/<?php echo uniqid(time()); ?>'+Math.random(); document.getElementById('verification_code').focus();" class="vam"></a>
      </p><p><span id="verification_error"></span></p>
    <p class="mt6">
    <input type="image" name="subscribe_me" id="subscribe_me" value="Y" src="<?php echo theme_url(); ?>images/subscribe.jpg" alt="Subscribe" onclick="$('#subscribe_active').val('Y');return form_support_enq_jquery();">
    <input type="image" name="subscribe_me" id="unsubscribe_me" value="N" src="<?php echo theme_url(); ?>images/us-subscribe.jpg" alt="Unsubscribe" onclick="$('#subscribe_active').val('N');return form_support_enq_jquery();"></p>
    </div>
    <input type="hidden" name="subscribe_active" id="subscribe_active" value="" />
    <span id="enq_loader"></span>
<?php echo form_close();?>   