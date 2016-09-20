<?php $this->load->view('includes/header'); ?>  
	<div class="content">
		<div id="content">
			<div class="breadcrumb">
				<?php echo anchor('adminzone/dashbord','Home'); ?>
				&raquo; <?php echo $heading_title; ?> </a>
			</div>
			<div class="box">
				<div class="heading">
					<h1><img src="<?php echo base_url(); ?>assets/adminzone/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
					<div class="buttons">
						<a href="javascript:void(0);" onclick="history.back();" class="button">Cancel</a>  
					</div>
				</div>
				<div class="content">
					<?php echo validation_message('alert');?>
					<?php echo error_message(); ?>  
					<?php echo form_open_multipart("adminzone/category/add/".$parent_id);?>  
					<div id="tab_pinfo">
						<table width="90%"  class="form"  cellpadding="3" cellspacing="3">
							<tr>
								<th colspan="2" align="center" > </th>
							</tr>
							<tr class="trOdd">
								<td width="28%" height="26" align="right" > Name : <span class="required">*</span></td>
								<td width="72%" align="left"><input type="text" name="category_name" size="40" value="<?php echo set_value('category_name');?>"></td>
							</tr>
							<tr class="trOdd">
								<td width="28%" height="26" align="right" >Image :</td>
								<td align="left">
									<input type="file" name="category_image" />
									<br />
									<br />
									[ <?php echo $this->config->item('category.best.image.view');?> ]
								</td>
							</tr>
	            <tr class="trOdd">
	            	<td align="left">&nbsp;</td>
	            	<td align="left">
	            		<input type="submit" name="sub" value="Add" class="button2" />
	            		<input type="hidden" name="action" value="addcategory" />
	            		<?php
	            		if(is_array($parentData))
	            		{
	            			?>
	            			<input type="hidden" name="parent_id" value="<?php echo $parentData['category_id'];?>" />
	            			<?php
	            		}
	            		?>
	            	</td>
	            </tr>
	        </table>
	    </div>
	    <?php echo form_close(); ?>
	</div>
	</div>
<?php $this->load->view('includes/footer'); ?>