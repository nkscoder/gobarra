<?php $this->load->view('includes/header'); ?>  
 <div id="content">
  
  <div class="breadcrumb">
  
      <?php echo anchor('adminzone/dashbord','Home'); ?>
 &raquo; <?php echo anchor('adminzone/staticpages','Back To Listing'); ?> &raquo;  <?php echo $heading_title; ?> 
             
   </div>      
       
 <div class="box">
 
    <div class="heading">
    
      <h1><img src="<?php echo base_url(); ?>assets/adminzone/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
      
      <div class="buttons">&nbsp;</div>
      
    </div>
    
    
	<div class="content">
		<?php
		//$slid_arr = $this->config->item('slider1');
		echo validation_message();?>
        <?php echo error_message(); ?>
		
		<?php echo form_open_multipart('adminzone/staticpages/add/');?>  
		<div id="tab_pinfo">
			<table width="90%"  class="form"  cellpadding="3" cellspacing="3">
			<tr>
				<th colspan="2" align="center" > </th>
			</tr>

			<tr class="trOdd">
			  <td height="26" align="right" >Page Name : <span class="required">*</span></td>
			  <td align="left"><input type="text" name="page_name" size="50" value="<?php echo set_value('page_name',$this->input->post('page_name'));?>" /></td>
			  </tr>
			<tr class="trOdd">
			  <td height="26" align="right" >Short Description: <span class="required">*</span></td>
			  <td align="left">
			  <textarea name="page_short_description" rows="5" cols="50" > <?php echo set_value('page_short_description',$this->input->post('page_short_description'));?></textarea></td>
			  </tr>

			<tr class="trOdd">
			  <td width="23%" align="right" >Description :</td>
				
				<td align="left">
<textarea name="page_description" rows="5" cols="50" id="description" ><?php echo set_value('page_description');?></textarea> <?php  echo display_ckeditor($ckeditor); ?></td>
			</tr>

			<tr class="trOdd">
				<td align="left">&nbsp;</td>
				<td align="left">
					<input type="submit" name="sub" value="Add Page" class="button2" />
					<input type="hidden" name="action" value="addpage" />
				</td>
			</tr>
			</table>
		<?php echo form_close(); ?>
		</div>
		
	</div>
</div>
<?php $this->load->view('includes/footer'); ?>