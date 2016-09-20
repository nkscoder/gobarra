<?php $this->load->view('includes/header'); ?>  
	<div id="content">
		<div class="breadcrumb">
			<?php echo anchor('adminzone/dashbord','Home'); ?>
			&raquo; <?php echo $heading_title; ?> </a>
		</div>
		<div class="box">
			<div class="heading">
				<h1><img src="<?php echo base_url(); ?>assets/adminzone/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
				<div class="buttons"><?php echo anchor("adminzone/category/",'<span>Cancel</span>','class="button" ' );?></div>
			</div>
			<div class="content">
				<?php echo validation_message();?>
				<?php echo error_message(); ?>  
				<?php echo form_open_multipart(current_url_query_string());?>  
				<div id="tab_pinfo">
					<table width="90%"  class="form"  cellpadding="3" cellspacing="3">
						<tr>
							<th colspan="2" align="center" > </th>
						</tr>
						<tr class="trOdd">
							<td width="28%" height="26" align="right" > <?php echo $heading_title; ?> Name : <span class="required">*</span></td>
							<td width="72%" align="left">
								<input type="text" name="category_name" size="40" value="<?php echo set_value('category_name',$catresult['category_name']);?>"></td>
							</tr>
							<tr class="trOdd">
								<td width="28%" height="26" align="right" >Image :</td>
								<td align="left">
									<input type="file" name="category_image" />
									<?php
									if($catresult['category_image']!='' && file_exists(UPLOAD_DIR."/category/".$catresult['category_image']))
									{ 
										?>
										<a href="#"  onclick="$('#dialog').dialog();">View</a>
										| <input type="checkbox" name="cat_img_delete" value="Y" />Delete
										<?php	
									}
									?>
									<br />
									<br />
									[ <?php echo $this->config->item('category.best.image.view');?> ]
									<div id="dialog" title="Category Image" style="display:none;">
										<img src="<?php echo base_url().'uploaded_files/category/'.$catresult['category_image'];?>"  /> </div>
									</td>
									</tr>
	            <tr class="trOdd">
	            	<td align="left">&nbsp;</td>
	            	<td align="left">
	            		<input type="submit" name="sub" value="Update" class="button2" />
	            		<input type="hidden" name="action" value="editcategory" />
	            		<input type="hidden" name="category_id" value="<?php echo $catresult['category_id'];?>">
	            	</td>
	            </tr>
	        </table>
	    </div>
	    <?php echo form_close(); ?>
	</div>
</div>
<?php $this->load->view('includes/footer'); ?>