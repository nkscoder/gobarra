<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('CI'))
{
	function CI()
	{
		if (!function_exists('get_instance')) return FALSE;
		$CI =& get_instance();
		return $CI;
	}
}



if ( ! function_exists('admin_pagination'))
{
	function admin_pagination($base_uri, $total_rows, $record_per, $uri_segment,$refresh = FALSE)
	{
			$ci = CI();			
			$config['per_page']			= $record_per;
		    $config['num_links']        = 8;	
			$config['next_link']        = 'Next';
			$config['prev_link']        = 'Prev';	 	  
			$config['total_rows']		= $total_rows;
		    $config['uri_segment']		= $uri_segment;		
			$ci->load->library('pagination');		
			$config['cur_tag_open']	= '&nbsp;<strong>';
		    $config['cur_tag_close']	    = '</strong>';
			$config['page_query_string']	= TRUE;
			$config['base_url']             = $base_uri;
			$ci->pagination->initialize($config);
			$data = $ci->pagination->create_links();		
		 
		   return $data;	
		  
	}
}


function display_record_per_page()
{	
$ci = CI();
$post_per_page =  $ci->input->get_post('pagesize');

?>

<select name="pagesize" id="pagesize" class="p1" style="width:60px;" onchange="this.form.submit();">
    <?php
    foreach($ci->config->item('adminPageOpt') as $val)
    {
		
    ?>
    <option value="<?php echo $val;?>" <?php echo $post_per_page==$val ? "selected" : "";?>>
	  <?php echo $val;?></option>
    <?php
    }
    ?>
</select>

<?php
}
if ( ! function_exists('admin_category_breadcrumbs'))
{
	function admin_category_breadcrumbs($catid,$segment='')
	{
		$link_cat=array();	
		$ci = CI();		  
		$sql="SELECT category_name,category_id,parent_id
		FROM wl_categories WHERE category_id='$catid' AND status='1' ";		 
		$query=$ci->db->query($sql);		
		$num_rows     =  $query->num_rows();
		$segment      = $ci->uri->segment($segment,0);
			 
		  if ($num_rows > 0)
		  {
			 			  
				  foreach( $query->result_array() as $row )
				  {
							 
						if ( has_child( $row['parent_id'] ) )
						{
								
								$condtion_pic   =  "AND category_id='".$row['category_id']."'";				
								$pic_count      = count_pic($condtion_pic);
								
								if($pic_count>0)
								{
									$link_url = base_url()."adminzone/gallery_slider/index/".$row['category_id'];
									
								}else
								{							
									$link_url = base_url()."adminzone/category/index/".$row['category_id'];								
								}
								
								if( $segment!='' && ( $row['category_id']==$segment ) )
								{
									
									$link_cat[]=' <span class="pr2 fs14">»</span> '.$row['category_name'];
									
								}else
								{
									
								  $link_cat[]=' <span class="pr2 fs14">»</span> <a href='.$link_url.'>'.$row['category_name'].'</a>';
								  
								}
								
								$link_cat[] = admin_category_breadcrumbs($row['parent_id'],$segment);
							 
						  }else
						  {	
							$link_url = base_url()."adminzone/category/index/".$row['category_id'];				  
							$link_cat[] ='<a href='.$link_url.'>'.$row['category_name'].'</a>';	
									   
						  }     
					}    
		 }else
		 {
			  $link_url = base_url()."adminzone/category";
			  $link_cat[]='<span class="pr2 fs14">»</span> <a href='.$link_url.'>Category</a>';
			
		 }
		 
		 $link_cat = array_reverse($link_cat);
		 $var=implode($link_cat);
		 return $var;
		
	}
	
}

function createMenu($arr_items,$level='top')
{
  $menu_items_count =  count($arr_items);
  if($menu_items_count > 0)
  {
	 foreach($arr_items as $key1=>$val1)
	 {
		 $menu_id = trim(strtolower($key1));
		 ?>
		 <li<?php echo $level=='top' ? ' id="'.$menu_id.'"' : '';?>>
		 <?php
		 if(is_array($val1) && !empty($val1))
		 {
			 
			?>
		   <a class="<?php echo $level;?>"><?php echo $key1; ?></a> <ul><?php createMenu($val1,'parent');?></ul>
		  <?php 
		 }
		 else
		 {
		 ?>
			<a href="<?php echo base_url().$val1; ?>"<?php echo $level=='top' ? ' class="top"' : '';?>><?php echo $key1; ?></a>
			
		 <?php 
		 }
		 ?>
		 </li>
		<?php
	 }
  }
}