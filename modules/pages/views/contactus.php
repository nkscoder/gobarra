<?php $this->load->view('top_application'); ?>
<div class="container pt12">
<div class="radius-5 bg-white shadow p15">
    
    <h1>Contact Us</h1>
    <p class="tree mt5"><img src="<?php echo theme_url(); ?>images/youarehere.png" alt="" class="vat mr5"> <a href="<?php echo base_url();?>">Home</a> Contact Us</p>
    
    <div class="mt15">
    <div class="fl w40 pr15">
    <?php echo $content;?>
    </div>
    <?php echo form_open('pages/contactus');?>
    <div class="fl w50 radius-5 ml20 rel  p15 shadow bdr2">
    <?php echo validation_message();?>
     <?php echo error_message(); ?>
    <p class="abs" style="right:0px; top:-40px"><img src="<?php echo theme_url(); ?>images/contact-us.png" width="220" height="394" alt="contact"></p>
      <p class="fs28 pink gochihand">Send us your Query. </p>

    <div class="p3 mt10">
        <p class="fl w15 mt4"><label for="Name">Name <span class="star">*</span></label></p>
        <p class="fl w3 mt4">:</p>
        <p class="fl w73">
          <input name="first_name" type="text" class="txtbox w70" value="<?php echo set_value('first_name');?>">
        </p>
        <p class="cb"></p>
        <br /><?php //echo form_error('first_name');?>
      </div>
      <div class="p3">
        <p class="fl w15 mt4"><label for="phone_number">Phone</label>
        </p>
        <p class="fl w3 mt4">:</p>
        <p class="fl w73">
          <input name="phone_number" type="text" class="txtbox w70" value="<?php echo set_value('phone_number');?>">
        </p>
        <p class="cb"></p>
        <br /><?php //echo form_error('phone_number');?>
      </div>
       <div class="p3">
        <p class="fl w15 mt4"><label for="mobile_number">Mobile <span class="star"> *</span></label></p>
        <p class="fl w3 mt4">:</p>
        <p class="fl w73">
          <input name="mobile" type="text" class="txtbox w70" value="<?php echo set_value('mobile');?>">
        </p>
        <p class="cb"></p><br /><?php //echo form_error('mobile');?>
      </div>
      <div class="p3">
        <p class="fl w15 mt4"><label for="email">Email <span class="star">*</span></label></p>
        <p class="fl w3 mt4">:</p>
        <p class="fl w73">
          <input name="email" type="text" class="txtbox w70" value="<?php echo set_value('email');?>">
        </p>
        <p class="cb"></p><br /><?php //echo form_error('email');?>
      </div>
      
      <div class="p3">
        <p class="fl w15 mt4"><label for="description">Message <span class="star">*</span></label></p>
        <p class="fl w3 mt4">:</p>
        <p class="fl w75">
          <textarea name="message"  rows="4" class="txtbox w57"><?php echo set_value('message');?></textarea>
        </p>
        <p class="cb"></p><?php //echo form_error('message');?>
      </div>
      <div class="p3">
      
        <div class="fl w80 ml81">
          <input name="verification_code" id="verification_code" type="text" style="width:65px;" class="txtbox" placeholder="Enter code"> 
<img src="<?php echo site_url('captcha/normal'); ?>" class="vam bdr" alt=""  id="captchaimage"/> 
<a href="javascript:viod(0);" title="Change Verification Code" style="cursor:pointer;"  >
<img src="<?php echo theme_url(); ?>images/refresh.png"  alt="Refresh"  onclick="document.getElementById('captchaimage').src='<?php echo site_url('captcha/normal'); ?>/<?php echo uniqid(time()); ?>'+Math.random(); document.getElementById('verification_code').focus();" class="ml10 vam" style="cursor:pointer;" /></a></div>
        <p class="cb"></p>
        <br /><?php //echo form_error('verification_code');?>           
      </div>
      <p class="mt5 ml82">
        <input name="submit" type="submit" class="button-style" value="Submit">
        <input name="reset" type="reset" class="button-style" value="Reset">
      </p>
    </div>
    <?php echo form_close();?>
    <p class="cb"></p>
  
  </div>
    
</div>    
</div>
<script type="text/javascript">var Page='inner';</script> 
<?php $this->load->view('bottom_application'); ?>