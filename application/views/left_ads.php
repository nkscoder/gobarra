 <!-- left Sidebar Ads Content -->
  <?php $query=$this->db->query("SELECT * FROM tbl_left_ads WHERE status='1' ");
        if($query->num_rows()>0)
        {
            $list=$query->result_array();
        ?>
                <div class="col-sm-4 leftSidebar visible-lg visible-md">
				  <div class="bg leftbanner">  
                   <?php 
					foreach ($list as $key => $value) {


                        $img=substr($value['image'],0,5);



                        if($img=='https'){

                            $img=$value['image'];
                        }else{
                            $img=base_url().'uploaded_files/profile_img/'.$value['image'];

                        }

						/*$img=base_url().'uploaded_files/left_panel/'.$value['image'];*/



					?>
				       
                   <div class="col-sm-4 col-xs-4 col-md-4"><a href="<?php echo $value['url'];?>"><img src="<?php echo $img; ?>" class="img-responsive " style="margin:2px;"></a></div>                   
				
					<?php } ?>
                </div>
				</div> 
				
		<?php } ?>
			 <!-- left Sidebar Content end-->