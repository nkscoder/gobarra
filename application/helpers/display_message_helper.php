<?php
function validation_message($style="")// by default On Page - set 'alert' for pop-up
{	
  
	$processing_result=validation_errors();
	
	if($processing_result!='')
	{	
	
	   if($style=="alert")
	   {	   
		  ?>
           <div id="alert_box"><div class="alert-danger">
            <div class="close">
                <span onclick="$('#alert_box').fadeOut(100);"; class="txt">Close [x]</span>
            </div>
            <div style=" width:100%; text-align:left;">        
		  <?php
	      }
         ?>
             <div class="alert alert-danger" role="alert" ><?php echo $processing_result; ?></div>
		<?php 
		
		if($style=="alert")
		{
		  ?>
              </div>
             </div>
            </div>
		  <?php
		}
		
     } 
	 
 }
 
 function error_message($style="")// by default On Page - set 'alert' for pop-up
 {  
 
  $ci = &get_instance();
  $msgtype = $ci->session->userdata('msg_type');
  
   if( $msgtype )
   {	 
   
	 if($style=="alert")
	  {
		 
		  ?>
          <div id="alert_box"><div class="alert_area">
            <div class="close">
                <span onclick="$('#alert_box').fadeOut(100);"; class="txt">Close [x]</span>
            </div>
            <div style=" width:100%; text-align:left;">      
		  <?php
	  }
 ?>
 
 <div class="<?php echo $msgtype;?>" >
 
	   <?php echo $ci->session->flashdata($msgtype);  $ci->session->unset_userdata(array('msg_type'=>0) ); ?>
  </div>  
   <?php if($style=="alert")
		{
			
		  ?>
              </div>
             </div>
            </div>
		  <?php
		}
  
    }   
  } 
 ?>