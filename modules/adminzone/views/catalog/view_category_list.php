<?php $this->load->view('includes/header'); ?>  
	<div id="content">
		<div class="breadcrumb">
			<?php echo anchor('adminzone/dashbord','Home'); 
			$segment=4;	
			$catid    = (int) $this->uri->segment(4,0);		
			if($catid )
			{
				echo admin_category_breadcrumbs($catid,$segment);
			}else
			{
				echo '<span class="pr2 fs14">»</span> Category';
			}   
			?>
		</div>      
		<div class="box">
			<div class="heading">
				<h1><img src="<?php echo base_url(); ?>assets/adminzone/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
				<div class="buttons"><?php echo anchor("adminzone/category/add/$parent_id","<span>Add $heading_title</span>",'class="button" ' );?></div>
			</div>
			<div class="content">
				<?php  echo error_message(); ?>
				<?php echo form_open("adminzone/category/index/$parent_id",'id="search_form" method="get" '); ?>
				<div align="right" class="breadcrumb"> Records Per Page : <?php echo display_record_per_page();?> </div>
				<table width="100%"  border="0" cellspacing="3" cellpadding="3" >
					<tr>
						<td align="center" >Search [ Category Name ] 
							<input type="text" name="keyword" value="<?php echo $this->input->get_post('keyword');?>"  />&nbsp;
							<select name="status">
								<option value="">Status</option>
								<option value="1" <?php echo $this->input->get_post('status')==='1' ? 'selected="selected"' : '';?>>Active</option>
								<option value="0" <?php echo $this->input->get_post('status')==='0' ? 'selected="selected"' : '';?>>In-active</option>
							</select>
							<a  onclick="$('#search_form').submit();" class="button"><span> GO </span></a>                
							<?php 
							if( $this->input->get_post('keyword')!='' || $this->input->get_post('status')!='' )
							{ 
								$parentid = (int) $this->input->get_post('parent_id');
								if($parentid > 0 )
								{					   
									echo anchor("adminzone/category/index/$parentid",'<span>Clear Search</span>'); 
								}else
								{
									echo anchor("adminzone/category/",'<span>Clear Search</span>');
								}				  
							} 
							?>
							<input type="hidden" name="parent_id" value="<?php echo $parent_id;?>"  />
						</td>
					</tr>        
				</table>
			<?php echo form_close();?>
				<?php
				if(is_array($res) && ! empty($res))
				{
					?>
					<?php echo form_open("adminzone/category/",'id="data_form"');?>
					<table class="list" width="100%" id="my_data">
						<thead>
							<tr>
								<td width="20" style="text-align: center;">

									<input type="checkbox" onclick="$('input[name*=\'arr_ids\']').attr('checked', this.checked);" />
								</td>
								<td width="239" class="left">Name </td>
								<td width="174" align="center">Image</td>
								<!--<td width="94" class="center">Display Order</td>-->
								<td width="118" align="center" >Status</td>
								<td width="131" align="center">Action</td>
							</tr>
						</thead>
						<tbody>
							<?php 	
							foreach($res as $catKey=>$pageVal)
							{ 
								$imgdisplay=FALSE;		
								$displayorder       = ($pageVal['sort_order']!='') ? $pageVal['sort_order']: "0";								
								$total_subcategory  =  $pageVal['total_subcategories'];
								$condtion_pic   =  "AND category_id='".$pageVal['category_id']."'";
								$total_pic     =  count_pic($condtion_pic);
								?> 
								<tr>
									<td style="text-align: center;">
										<input type="checkbox" name="arr_ids[]" value="<?php echo  $pageVal['category_id'];?>" />
										<input type="hidden" name="category_count" value="Y" />
										<input type="hidden" name="pic_count" value="Y" />
									</td>
									<td class="left">
										<?php echo $pageVal['category_name'];?>
										<?php
										if($total_subcategory>0)
										{
											echo "<br><br>".anchor("adminzone/category/index/".$pageVal['category_id'],'Subcategory ['. $total_subcategory.']','class="refSection" ' );
										}elseif($total_pic>0)
										{
											echo "<br><br>".anchor("adminzone/gallery_slider/index/".$pageVal['category_id'],'Gallery ['. $total_pic.']','class="refSection" ' );
										}else
										{
											echo "<br><br>".anchor("adminzone/category/index/".$pageVal['category_id'],'Subcategory ['. $total_subcategory.']','class="refSection" ');
											echo " | ".anchor("adminzone/gallery_slider/index/".$pageVal['category_id'],'Gallery ['. $total_pic.']','class="refSection" ');
										}
										?>
									</td>
									<td align="center">
										<img src="<?php echo get_image('category',$pageVal['category_image'],50,50,'AR');?>" />
									</td>
									<!--<td align="center">
										<input type="text" name="ord[<?php //echo $pageVal['category_id'];?>]" value="<?php //echo $displayorder;?>" size="2" />
									</td>-->
									<td align="center" ><?php echo ($pageVal['status']==1)? "Active":"In-active";?></td>
									<td align="center" >
										<?php echo anchor("adminzone/category/edit/$pageVal[category_id]/".query_string(),'Edit'); ?> 
									</td>
								</tr>
								<?php
							}		   
							?> 
							<tr><td colspan="6" align="right" height="30"><?php echo $page_links; ?></td></tr>     
						</tbody>
						<tr>
							<td align="left" colspan="6" style="padding:2px" height="35">
								<input name="status_action" type="submit"  value="Activate" class="button2" id="Activate" onClick="return validcheckstatus('arr_ids[]','Activate','Record','u_status_arr[]');"/>
								<input name="status_action" type="submit" class="button2" value="Deactivate" id="Deactivate"  onClick="return validcheckstatus('arr_ids[]','Deactivate','Record','u_status_arr[]');"/>
								<input name="status_action" type="submit" class="button2" id="Delete" value="Delete"  onClick="return validcheckstatus('arr_ids[]','delete','Record');"/>
								<!--<input name="update_order" type="submit"  value="Update Order" class="button2" />-->
							</td>
						</tr>
					</table>
					<?php
					echo form_close();
				}else{
					echo "<center><strong> No record(s) found !</strong></center>" ;
				}
				?> 
			</div>
			</div>
		<?php $this->load->view('includes/footer'); ?>