<?php $this->load->view('includes/header'); ?>  
 <div id="content">
  <div class="breadcrumb">
      <?php echo anchor('adminzone/dashbord','Home'); ?>
 &raquo; <?php echo anchor('adminzone/left_panel','Back To Listing'); ?> &raquo;  <?php echo $heading_title; ?> 
   </div>      
 <div class="box">
    <div class="heading">
      <h1><img src="<?php echo base_url(); ?>assets/adminzone/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons">&nbsp;</div>
    </div>
	<div class="content">
		<?php
		echo validation_message();?>
        <?php echo error_message(); ?>
		<?php echo form_open_multipart('adminzone/left_panel/add/');?>  
		<div id="tab_pinfo">
			<table width="90%"  class="form"  cellpadding="3" cellspacing="3">
			<tr>
				<th colspan="2" align="center" > </th>
			</tr>
			<tr class="trOdd">
			  <td height="26" align="right" >Name : <span class="required">*</span></td>
			  <td align="left"><input type="text" name="name" size="50" value="<?php echo set_value('name',$this->input->post('name'));?>" /></td>
			  </tr>
			<tr class="trOdd">
				<td width="28%" height="26" align="right" >Image : <span class="required">*</span> </td>
				<td align="left">
					<input type="file" name="image" id="image" />
					<br />
				</td>
			</tr>
				<tr class="trOdd">
			  <td height="26" align="right" >Iframe Url: <span class="required">*</span></td>
			  <td align="left"><input name="url" size="50" class="url" type="text" value="<?php echo set_value('url', $this->input->post('url'));?>">
			  </tr>
			<tr class="trOdd">
				<td align="left">&nbsp;</td>
				<td align="left">
					<input type="submit" name="sub" value="Add Image" class="button2" />
					<input type="hidden" name="action" value="addimage" />
				</td>
			</tr>
			</table>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
<?php $this->load->view('includes/footer'); ?>