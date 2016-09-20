<?php $this->load->view('includes/header'); ?>  
  <div id="content">
  
  <div class="breadcrumb">
  
       <?php echo anchor('adminzone/dashbord','Home'); ?> &raquo; <?php echo $heading_title; ?> </a>   
             
   </div>      
       
 <div class="box">
 
    <div class="heading">
    
      <h1><img src="<?php echo base_url(); ?>assets/adminzone/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
      
      <div class="buttons">  <?php echo anchor("adminzone/candidate_file/add/",'<span>Add Candidate</span>','class="button" ' );?></div>
      
    </div>
      
     <div class="content">   
     
     <?php echo validation_message();?>
     <?php echo error_message(); ?>
     
      <?php 
	
	       echo form_open("adminzone/candidate_file/",'id="search_form" method="get" ');?>
             <div align="right" class="breadcrumb"> Records Per Page : <?php echo display_record_per_page();?> </div>
			<table width="100%"  border="0" cellspacing="3" cellpadding="3" >
				<tr>
					<td align="center" >Search [ candidate Name] 
					  <input type="text" name="keyword" value="<?php echo $this->input->get_post('keyword');?>"  />&nbsp;
					<a  onclick="$('#search_form').submit();" class="button"><span> GO </span></a>
					
					 <?php if($this->input->get_post('keyword')!='')
					   {
						    
					     echo anchor("adminzone/candidate_file/",'<span>Clear Search</span>');
						
					   }
					   ?>
					</td>
				</tr>
			</table>
            
	 <?php echo form_close();?>	
     
      
	 <?php 
	   if( is_array($res) && !empty($res) )
	  {
	 
	    echo form_open("adminzone/candidate_file/",'id="data_form"');?>
     
	  <table class="list" width="100%" id="my_data">
     
        <thead>
          <tr>
            <td width="21" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'arr_ids\']').attr('checked', this.checked);" /></td>
            <td width="405" class="left">Candidate Name</td>
			<td width="343" align="center">Email</td>
			<td width="405" align="center">Contact No.</td>
			<td width="343" align="center">Gender</td>
			<td width="343" align="center">Designation</td>
			<td width="343" align="center">Experience</td>
			<td width="343" align="center">Salary</td>
			<!--<td width="343" align="center">Current Education</td>-->
			<td width="343" align="center">City</td>
			<td width="343" align="center">State</td>
			<td width="343" align="center">Created Date</td>
			<td width="343" align="center">Modified Date</td>
            <td width="73" class="center">Status</td>
            <td width="92" class="center">Action</td>
          </tr>
        </thead>
		
        <tbody>
          <?php
		  $j=1; 
			foreach($res as $catKey=>$pageVal)
			{
				
		   ?> 
          <tr>
            <td style="text-align: center;">
            <input type="checkbox" name="arr_ids[]" value="<?php echo $pageVal['candidate_id'];?>" /></td>
            <td class="left"><?php echo $pageVal['candidate_name'];?></td>
            <td class="left"><?php echo $pageVal['email_id'];?></td>
            <td class="left"><?php echo $pageVal['contact'];?></td>
            <td class="left"><?php echo $pageVal['gender'];?></td>
            <td class="left"><?php echo $pageVal['designation'];?></td>
            <td class="left"><?php echo $pageVal['experience'];?></td>
            <td class="left"><?php echo $pageVal['salary'];?></td>
            <!--<td class="left"><?php //echo $pageVal['current_education'];?></td>-->
            <td class="left"><?php echo $pageVal['city'];?></td>
            <td class="left"><?php echo $pageVal['state'];?></td>
            <td class="left"><?php echo $pageVal['created_date'];?></td>
            <td class="left"><?php echo $pageVal['modified_date'];?></td>      
            <td class="center"><?php echo ($pageVal['status']==1)?"Active":"In-active";?></td>
            <td class="center"><?php echo anchor("adminzone/candidate_file/edit/$pageVal[candidate_id]/".query_string(),'Edit'); ?></td>
          </tr>
          <?php
		   $j++;}		  
		  ?> 
          <tr><td colspan="16" align="right" height="30"><?php echo $page_links; ?></td></tr>     
        </tbody>
    	<tr>
			<td align="left" colspan="16" style="padding:2px" height="35">
				<input name="status_action" type="submit"  value="Activate" class="button2" id="Activate" onClick="return validcheckstatus('arr_ids[]','Activate','Record','u_status_arr[]');"/>
				<input name="status_action" type="submit" class="button2" value="Deactivate" id="Deactivate"  onClick="return validcheckstatus('arr_ids[]','Deactivate','Record','u_status_arr[]');"/>
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