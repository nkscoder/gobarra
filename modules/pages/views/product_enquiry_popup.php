<?php $this->load->view('top_application'); ?>
<body class="bg4">
<div class="p10" style="width:450px;">
<h1>Send Your Query</h1>

<?php echo form_open('pages/contactus');?>
<div class="p10 mt10">

<p class="ttu"><label for="first_name">First Name</label><span class="red">* </span></p>
<p class="mt5"><input type="text" name="first_name" id="first_name" class="input-bdr2" style="width:400px;"></p> 

<p class="ttu mt5"><label for="last_name">Last Name</label><span class="red">* </span></p>
<p class="mt5"><input type="text" name="last_name" id="last_name" class="input-bdr2" style="width:400px;"></p>

<p class="ttu mt5"><label for="email">Email Id</label> <span class="red">* </span></p>
<p class="mt5"><input type="text" name="email" id="email" class="input-bdr2" style="width:400px;"></p> 

<p class="mt5 ttu"><label for="position">Phone No</label> <span class="red">* </span></p>
<p class="mt5">
  <input type="text" name="email2" id="email2" class="input-bdr2" style="width:400px;">
</p> 
 
<p class="ttu mt5"><label for="image1">Country</label> <span class="red">* </span></p>
<p class="mt5">
  <select name="country" id="country" class="input-bdr2" style="width:410px;">
    <option>Select</option>
  </select>
</p> 
 

<p class="mt5"><label for="description">MESSAGE</label> <span class="red">* </span></p>
<p class="mt5"><textarea name="description" id="description" cols="45" rows="3" class="input-bdr2" style="width:400px;"></textarea></p>


<p class="mt5"><span class="grey tahoma fs12"><label for="verification _code">WORD VERIFICATION</label> <strong class="red">*</strong></span></p>
<p class="mt5"><input type="text" name="verification _code" id="verification _code" class="input-bdr2" style="width:250px;"> <img src="images/capt.gif" alt="" class="vam"> <a href="#"><img src="images/ref12.png" alt="" class="ml10 vam"></a></p>

<p class="mt10"><input type="submit" name="button" id="button" value="Submit" class="submit-but" ></p>
      
</div>
 <?php echo form_close();?>   
</div>
</body>
</html>
