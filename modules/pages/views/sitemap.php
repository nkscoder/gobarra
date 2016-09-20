<?php $this->load->view('top_application'); ?>
<div class="container pt12">
<div class="radius-5 bg-white shadow p15">
    
    <h1>Site Map</h1>
    <p class="tree mt5"><img src="<?php echo theme_url(); ?>images/youarehere.png" alt="" class="vat mr5"> <a href="<?php echo base_url();?>">Home</a> Site Map</p>
    
    <div class="mt10 lh18px aj">
    
    <div class="shadow1 fl w30 p14">
    <p class="abel fs20 b">Quick Links</p>
	<p class="link mt10"><a href="<?php echo base_url();?>">Home</a> <a href="<?php echo base_url();?>pages/aboutus">About Us</a> <a href="<?php echo base_url();?>pages/contactus">Contact Us</a> <a href="<?php echo base_url();?>faq">FAQ's</a> <a href="<?php echo base_url();?>testimonials">Testimonials</a> <?php if($this->session->userdata('user_id') > 0 ){?><a href="<?php echo base_url();?>users/logout" >Logout</a> <a href="<?php echo base_url();?>members/myaccount" >My Account</a><?php }else{?><a href="<?php echo base_url();?>users/login">Login</a> <a href="<?php echo base_url();?>/users/register">Register</a> <?php }?> <a href="#' " onmouseover="return addthis_open(this, '', '[URL]', '[TITLE]')" onmouseout="addthis_close()" onclick="return addthis_sendto()" >Bookmark Us</a></p>
    </div>
    
    
    <div class="shadow1 w30 fl p14">
    <p class="abel fs20 b">Categories</p>
	<?php
    $cat_limit = 7;
    $this->load->model(array('category/category_model'));
    $condtion_array = array(
    'field' =>"*,(  SELECT COUNT(category_id) FROM wl_categories AS b
            		WHERE b.parent_id=a.category_id ) AS total_subcategories",
            		'condition'=>"AND parent_id = '0' AND status='1' ",
    				'condition'=>"AND parent_id = '0' AND status='1' ",
    				'limit'=>$cat_limit,
    				'offset'=>0,
    				'debug'=>FALSE
    );	
    $cat_res            = $this->category_model->getcategory($condtion_array);
    $total_cat_found	= $this->category_model->total_rec_found;	
    
		?>
    
    
	<p class="link mt10">
    <?php
        if( is_array($cat_res) && !empty($cat_res))
        {
			$i=0;
			foreach($cat_res as $v)
			{
				
			   $total_subcategories = $v['total_subcategories'];
			   
				if($total_subcategories>0)
				{				
				  $link_url = base_url()."category/index/".$v['category_id'];	
				
				}else
				{			
				   $link_url = base_url()."products/index/".$v['category_id'];	
				}
        
        ?>
   <a href="<?php echo $link_url;?>" title="<?php echo $v['category_name'];?>" ><?php echo character_limiter(strip_tags($v['category_name']),15);?></a>
           
   <?php
    $i++;
	}
}
else
{
	?>
    <strong>Sorry, No Records Here.</strong>
    <?php
}
?>
    
    <?php if( $total_cat_found > count($cat_res) ) 
	{
?>
    <span class="pink b"><a href="<?php echo base_url();?>category">View All</a></span>
    <?php }?>
    </p>
    </div>
    
    <div class="shadow1 w30 fl p14">
    <p class="abel fs20 b">Policy Info</p>
	<p class="link mt10"><a href="<?php echo base_url();?>pages/privacy_policy">Privacy Policy</a><a href="<?php echo base_url();?>pages/terms_conditions">Terms &amp; Conditions</a><a href="cart.htm">My Shopping Cart</a><a href="<?php echo base_url();?>pages/payment_method">Payment Options</a><a href="<?php echo base_url();?>pages/refer_to_friends" class="p0-3 refer">Refer To Friend</a></p>
    </div>
    <div class="cb"></div>
    
    </div>
    
</div>    
</div>
<script type="text/javascript">var Page='inner';</script> 
<?php $this->load->view('bottom_application'); ?>