<?php $this->load->view('includes/header'); 
$block_path=$inq_type=='Wholesale' ? "enquiry/wholesale/" : "enquiry/";
?>  

 <div id="content">
  <div class="breadcrumb">
     <?php echo anchor('adminzone/dashbord','Home'); ?> &raquo; <?php echo $heading_title;?>        
      </div>
      
      <div class="box">
    <div class="heading">
      <h1><img src="<?php echo base_url(); ?>assets/adminzone/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons">&nbsp;</div>
    </div>
    <div class="content">
     <?php  echo error_message(); ?>
        
		<?php echo form_open("adminzone/enquiry/",'id="search_form"');?>
        <div align="right" class="breadcrumb"> Records Per Page : <?php echo display_record_per_page();?> </div>
		<table width="100%"  border="0" cellspacing="3" cellpadding="3" >
		 <?php 
                if(error_message() !=''){
               	   echo error_message();
                }
                ?> 
         <tr>
			<td align="center" ><strong>Search</strong> [  Name,Email ] 
			  <input type="text" name="keyword" value="<?php echo $this->input->get_post('keyword');?>"  />&nbsp;			
			<a  onclick="$('#search_form').submit();" class="button"><span> GO </span></a>			
			<?php
			if($this->input->get_post('keyword')!='')
			{ 
				echo anchor("adminzone/enquiry/",'<span>Clear Search</span>');
			} 
			?>
		   </td>
		</tr>
		</table>
		<?php echo form_close();?>
		<?php 
		if( is_array($res) && !empty($res) )
		{
		?>
			<?php echo form_open("adminzone/enquiry/",'id="data_form"');?>
          
			<table class="list" width="100%" id="my_data">
			<thead>
			<tr>
				<td width="22" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'arr_ids\']').attr('checked', this.checked);" /></td>
				<td width="188" class="left">User info</td>
				<td width="163" class="left"> Email</td>
				<td width="424" class="left">Password</td>
				<td width="424" class="left">Message</td>
			</tr>
			</thead>
			<tbody>
			<?php
			$atts = array(
										'width'      => '600',
										'height'     => '365',
										'scrollbars' => 'yes',
										'status'     => 'yes',
										'resizable'  => 'yes',
										'screenx'    => '0',
										'screeny'    => '0'
									 );
			
			foreach($res as $catKey=>$res)
			{
				$address_details=array();
			?> 
				<tr>
					<td style="text-align: center;" valign="top">
                    <input type="checkbox" name="arr_ids[]" value="<?php echo $res['id'];?>" /></td>
					<td class="left" valign="top">Name:
					<?php echo $res['first_name'];?> <?php echo $res['last_name'];?> <br>
					<?php 					
					
					if($res['mobile']!="" && $res['mobile']!='0')
					{ 
						$address_details[]="<b>Mobile : </b>".$res['mobile'];  
					}
					
					if(!empty($address_details))
					{
						echo implode("<br>",$address_details)."<br /><br />"; 
					}
					
					?>
					
					<?php echo anchor_popup('adminzone/enquiry/send_reply/'.$res['id'], 'Send Reply To:', $atts); echo $res['email'];?>
					</td>
					<td class="left" valign="top"><?php echo $res['email'];?></td>
					<td class="left" valign="top"><?php echo $res['password'];?></td>
					<td class="left" valign="top"><?php echo strip_tags($res['message']); ?> </td>            
				</tr>
			<?php
			}		  
			?> 
			<tr><td colspan="6" align="right" height="30"><?php echo $page_links; ?></td></tr>     
			</tbody>
			<tr>
				<td align="left" colspan="6" style="padding:2px" height="35">
					<input name="status_action" type="submit" class="button2" id="Delete" value="Delete"  onClick="return validcheckstatus('arr_ids[]','delete','Record');"/>
				</td>
			</tr>
			</table>
			<?php echo form_close();
		}else{
			echo "<center><strong> No record(s) found !</strong></center>" ;
		}
		?> 
	</div>
</div>
<?php $this->load->view('includes/footer'); ?>